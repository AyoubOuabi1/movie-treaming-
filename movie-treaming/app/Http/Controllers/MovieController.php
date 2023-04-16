<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use App\Models\Movie;
use App\Rules\YearOnly;
 use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
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

    function test(){
        /*$file_path  =  $request->file('file')->getClientOriginalName();
       $s3= \Storage::disk('s3¹'); $filePath = $file name; $s3->put($fileath, file_get_contents($file_path)); return $file url = $s3->url($filepath); = $request->file('file')->getPathName(); file_get_contents($file_path);
       /ame = time().'.mp4';
       Storage::disk('s3')->put('videos/'.$name, base_path(Storage::path('app/vedeo.mp4')));
       $url = Storage::disk('s3')->url('video/'.$name);
      // dump($url);
       dd($url);*/
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->file('server_link'));
      /*  $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'realased_date' => ['required'],
           // 'server_link' => ['required','mimes:mp4'],
             'description' => ['required', 'string'],
            'duration' => ['required', 'numeric'],
            'poster_image' => ['required', 'image', 'max:2048', 'mimes:jpg,jpeg,png,jfif'],
            'cover_image' => ['required', 'image', 'max:2048', 'mimes:jpg,jpeg,png,jfif'],
            'trailer_video' => ['required', 'url'],
            'languages' => ['required', 'string', 'max:255'],
            'directorId' => ['required', 'numeric'],
            'categories' => ['required'],
             'actors' => ['required'],
         ]);*/
        //

        $name = time().'mp4';
        $url = $request->file('server_link')->storeAs('/',$name,'s3');
        dd($url);


        $movie = new Movie;
        $movie->name = $validatedData['name'];
        $movie->realased_date = $validatedData['realased_date'];
        $movie->server_link = $this->upload($request->file('server_link'));
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
        } catch (Exception $e) {
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
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }
    public function upload(Request $request)
    {
       /* if (!$request->file('server_link')) {
            return redirect()->back()->withErrors(['video' => 'The video failed to upload.']);
        }

        $s3 = new S3Client([
            'version' => 'latest',
            'region' => env('AWS_DEFAULT_REGION'),
            'credentials' => [
                'key' => env('AWS_ACCESS_KEY_ID'),
                'secret' => env('AWS_SECRET_ACCESS_KEY'),
            ],
        ]);

        $fileName = $request->file('server_link')->getClientOriginalName();
        if (empty($fileName)) {
            //dd("empty");
            return redirect()->back()->withErrors(['video' => 'The video file name cannot be empty.']);
        }

        $filePath = 'videos/' . $fileName;
       // dd($filePath);
        if (empty($filePath)) {
            //dd("file path");
            return redirect()->back()->withErrors(['video' => 'The video file path cannot be empty.']);
        }
        dd($request->file('server_link')->getClientOriginalName());
        $s3->putObject([
            'Bucket' => env('AWS_BUCKET'),
            'Key' => $filePath,
            'Body' => file_get_contents( $request->file('server_link')),
            'ACL' => 'public-read',
        ]);

        $url = $s3->getObjectUrl(env('AWS_BUCKET'), $filePath, '+10 minutes', [
            'ResponseContentDisposition' => 'attachment; filename="' . $fileName . '"',
        ]);

        // Save the URL to the database here*/
        /*$name = time().'mp4';
        Storage::disk('s3')->put('videos/'.$name, base_path(Storage::path('app/vedeo.mp4')));
        $url = Storage::disk('s3')->url($name);
        dump($url);
        dd($url);
        $file_path = $request->file('server_link')->getPathName();
        $contents = file_get_contents($file_path);
        $file_name = 'test/'.$request->file('server_link')->getClientOriginalName();
        $s3= Storage::disk('s3');
        $filePath = $file_name;
        $s3->put($filePath, $contents);
       $url= $s3->url($filePath);*/
        $filenamewithextension = $request->file('server_link')->getClientoriginalName();
    //get filename without extension
    $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
        //get file extension
        $extension = $request->file('server_link')->getClientoriginalExtension();
//filename to store
        $filenametostore = $filename.'_'.time().'.'.$extension;
//Upload File to $3
        Storage::disk('s3')->put($filenametostore, fopen($request->file('server_link'), 'r+'), 'public');
        $url = Storage::disk('s3')->url($filenametostore);

       dd($url);
        return $url;
    }
}
