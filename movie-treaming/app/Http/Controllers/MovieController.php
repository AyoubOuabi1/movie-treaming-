<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use App\Models\Category;
use App\Models\Movie;
use App\Rules\YearOnly;
 use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Aws\S3\S3Client;

class MovieController extends Controller
{
    //
    public function __construct()
    {
        //$this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $movies = Movie::with('actors', 'categories')->orderBy('id','desc')->get();

        return response()->json($movies);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->file('server_link'));
       $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'realased_date' => ['required'],
            'server_link' => ['required','mimes:mp4'],
             'description' => ['required', 'string'],
            'duration' => ['required', 'numeric'],
            'poster_image' => ['required', 'image', 'max:2048', 'mimes:jpg,jpeg,png,jfif'],
            'cover_image' => ['required', 'image', 'max:2048', 'mimes:jpg,jpeg,png,jfif'],
            'trailer_video' => ['required', 'url'],
            'languages' => ['required', 'string', 'max:255'],
            'directorId' => ['required', 'numeric'],
            'categories' => ['required'],
             'actors' => ['required'],
         ]);
        //

        $movie = new Movie;
        $movie->name = $validatedData['name'];
        $movie->realased_date = $validatedData['realased_date'];
        $movie->server_link = $this->upload($request);
        $movie->description = $validatedData['description'];
        $movie->duration = $validatedData['duration'];
        $movie->trailer_video = $validatedData['trailer_video'];
        $movie->languages = $validatedData['languages'];
        $movie->directorId = $validatedData['directorId'];
        $movie->totalView = 0;

        $result = Cloudinary::upload($request->file('poster_image')->getRealPath(), [
            "folder" => "movies/",
            "public_id" => "poster_" . time(),
            "overwrite" => true
        ]);
        $movie->poster_image = $result->getSecurePath();

        $result = Cloudinary::upload($request->file('cover_image')->getRealPath(), [
            "folder" => "movies/",
            "public_id" => "cover_" . time(),
            "overwrite" => true
        ]);
        $movie->cover_image = $result->getSecurePath();

        $movie->save();

        $categoryIds = $validatedData['categories'];
        $actorsIds = $validatedData['actors'];

        DB::transaction(function () use ($movie, $categoryIds, $actorsIds) {
            $movie->categories()->attach($categoryIds);
            $movie->actors()->attach($actorsIds);
        });

        return redirect()->route('addMovie')->with(['success' => "Movie added successfully"]);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $idOrName)
    {

        $movie = Movie::with('categories', 'actors')
            ->where(function ($query) use ($idOrName) {
                $query->where('id', $idOrName)
                    ->orWhere('name', 'like', '%' . $idOrName . '%');
            })
            ->get();

        return response()->json($movie);
    }
    public function movieDetail(string $id)
    {
        //

        $movie = Movie::with('categories', 'actors')
            ->where('id', $id)
            ->get()->first();

        return view('User/movie_detail',compact('movie'));
    }

    public function findMovie(string $id)
    {
        //

        $movie = Movie::with('categories', 'actors')
            ->where('id', $id)
            ->get()->first();

        return view('Admin/Movies/update_Movie', compact('movie'));
    }
    public function findMovieApi(string $id)
    {
        //
        $movie = Movie::with('categories', 'actors')
            ->where('id', $id)
            ->get()->first();

        return response()->json($movie);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        try {
            $validatedData = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'realased_date' => ['required'],
                'server_link' => ['nullable', 'mimes:mp4'],
                'description' => ['required', 'string'],
                'duration' => ['required', 'numeric'],
                'poster_image' => ['nullable', 'image', 'max:2048', 'mimes:jpg,jpeg,png,jfif'],
                'cover_image' => ['nullable', 'image', 'max:2048', 'mimes:jpg,jpeg,png,jfif'],
                'trailer_video' => ['required', 'url'],
                'languages' => ['required', 'string', 'max:255'],
                'directorId' => ['required', 'numeric'],
                'categories' => ['required'],
                'actors' => ['required'],
            ]);

            $movie = Movie::findOrFail($id);

            $movie->name = $validatedData['name'];
            $movie->realased_date = $validatedData['realased_date'];
            $movie->description = $validatedData['description'];
            $movie->duration = $validatedData['duration'];
            $movie->trailer_video = $validatedData['trailer_video'];
            $movie->languages = $validatedData['languages'];
            $movie->directorId = $validatedData['directorId'];


            if ($request->hasFile('server_link')) {
                Storage::disk('s3')->delete($movie->server_link); // delete old video from S3
                $movie->server_link = $this->upload($request);
            }

            if ($request->hasFile('poster_image')) {
                $result = Cloudinary::upload($request->file('poster_image')->getRealPath(), [
                    "folder" => "movies/",
                    "public_id" => "poster_" . time(),
                    "overwrite" => true
                ]);
                $movie->poster_image = $result->getSecurePath();
            }

            if ($request->hasFile('cover_image')) {
                $result = Cloudinary::upload($request->file('cover_image')->getRealPath(), [
                    "folder" => "movies/",
                    "public_id" => "cover_" . time(),
                    "overwrite" => true
                ]);
                $movie->cover_image = $result->getSecurePath();
            }

            $movie->save();

            $categoryIds = $validatedData['categories'];
            $actorsIds = $validatedData['actors'];

            DB::transaction(function () use ($movie, $categoryIds, $actorsIds) {
                $movie->categories()->sync($categoryIds);
                $movie->actors()->sync($actorsIds);
            });

            return redirect()->route('findMovie', ['id' => $id])->with(['success' => "Movie updated successfully"]);
        } catch (Exception $e) {
            return redirect()->route('findMovie', $id)->with(['error' => "An error occurred while updating the movie"]);
        }
    }

    //  return redirect()->route('findMovie', ['id' => $id])->with(['success' => "Movie updated successfully"]);
    //}

    public function updateTotalView(string $id)
    {

            $movie = Movie::findOrFail($id);

            // Update movie attributes
            $movie->totalView=$movie->totalView+1;
            $movie->save();
            return view('User/watch_movie',  compact('movie'));

    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        try {
            $movie = Movie::findOrFail($id);
            $movie->delete();
            return response()->json(['message' => 'Movie deleted']);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }
    public function upload(Request $request)
    {

        $extension = $request->file('server_link')->getClientoriginalExtension();
        $filenamewithextension = $request->file('server_link')->getClientoriginalName();
          $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
        $filenametostore = 'movies/'.$filename.'_'.time().'.'.$extension;
        Storage::disk('s3')->put($filenametostore, file_get_contents($request->file('server_link')));
        $url = Storage::disk('s3')->url($filenametostore);
        return $url;
    }

    public static function getMoviesByCategory($categoryIdentifier)
    {
        $category = Category::where('id', $categoryIdentifier)
            ->orWhere('name', $categoryIdentifier)
            ->firstOrFail();

        $movies = $category->movies()
            ->inRandomOrder()
            ->take(15)
            ->get();

        return $movies;
    }


    public static function  getTopMovies()
    {
        $topMovies = Movie::with(['categories', 'actors'])
            ->orderBy('totalView', 'desc')
            ->take(15)
            ->get();
        return $topMovies;
    }

    public static function getTopActors()
    {
        $actors = Actor::withCount('movies')
            ->orderBy('movies_count', 'desc')
            ->take(10)
            ->get();

        return $actors;
    }



}
