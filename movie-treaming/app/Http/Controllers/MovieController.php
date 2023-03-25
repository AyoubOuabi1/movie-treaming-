<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

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
        //
        $movies=Movie::all();
        return response()->json($movies);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $movie=new Movie;
        $movie= $this->requestMovie($request, $movie);
        $movie->save();
        return response()->json($movie);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $movie= Movie::find($id);
        return response()->json($movie);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $movie = Movie::find($id);
        $movie= $this->requestMovie($request, $movie);
        $movie->save();
        return response()->json($movie);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $genre =  Movie::find($id);
        $genre->delete();
        return response()->json(['messqge','Movie Deleted']);
    }

    /**
     * @param Request $request
     * @param $movie
     */
    public function requestMovie(Request $request, $movie): Movie
    {
        $movie->name = $request->input('name');
        $movie->realased_date = $request->input('realased_date');
        $movie->server_link = $request->input('server_link');
        $movie->type = $request->input('type');
        $movie->description = $request->input('description');
        $movie->duration = $request->input('duration');
        $movie->cover_image = $request->input('cover_image');
        $movie->trailer_video = $request->input('trailer_video');
        $movie->languages = $request->input('languages');
       return $movie;
    }
}
