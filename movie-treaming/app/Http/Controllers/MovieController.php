<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use App\Models\Movie;
use App\Rules\YearOnly;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

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
        //dd($request);
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'realased_date' => ['required'],
            'server_link' => ['required', 'url'],
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
        //dd($request);
        $movie = new Movie;
        $movie->name = $validatedData['name'];
        $movie->realased_date = $validatedData['realased_date'];
        $movie->server_link = $validatedData['server_link'];
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
    public function update(Request $request, string $id)
    {
        $movie= Movie::find($id);
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'realased_date' => ['required'],
            'server_link' => ['required', 'url'],
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

        $movie->name = $validatedData['name'];
        $movie->realased_date = $validatedData['realased_date'];
        $movie->server_link = $validatedData['server_link'];
        $movie->description = $validatedData['description'];
        $movie->duration = $validatedData['duration'];
        $movie->trailer_video = $validatedData['trailer_video'];
        $movie->languages = $validatedData['languages'];
        $movie->directorId = $validatedData['directorId'];

        if ($request->hasFile('poster_image')) {
            $url = $movie->poster_image;
            $basename = basename($url);
            $pathinfo = pathinfo($basename);
            $public_id = $pathinfo['filename'];
            Cloudinary::destroy($public_id);
            $result = Cloudinary::upload($request->file('poster_image')->getRealPath(), [
                "folder" => "movies/",
                "public_id" => "poster_" . time(),
                "overwrite" => true
            ]);
            $movie->poster_image = $result->getSecurePath();
        }

        if ($request->hasFile('cover_image')) {
            $url = $movie->cover_image;
            $basename = basename($url);
            $pathinfo = pathinfo($basename);
            $public_id = $pathinfo['filename'];
            Cloudinary::destroy($public_id);
            $result = Cloudinary::upload($request->file('cover_image')->getRealPath(), [
                "folder" => "movies/",
                "public_id" => "cover_" . time(),
                "overwrite" => true
            ]);
            $movie->cover_image = $result->getSecurePath();
        }

        DB::transaction(function () use ($movie, $validatedData) {
            $movie->categories()->sync($validatedData['categories']);
            $movie->actors()->sync($validatedData['actors']);
        });

        $movie->save();

        return redirect()->route('findMovie', ['id' => $id])->with(['success' => "Movie updated successfully"]);
    }

    public function updateTotalView(string $id)
    {
        try {
            $movie = Movie::findOrFail($id);

            // Update movie attributes
            $movie->totalView=$movie->totalView+1;
            $movie->save();

            return response()->json(['success' => 'view has been added']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

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
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }

}
