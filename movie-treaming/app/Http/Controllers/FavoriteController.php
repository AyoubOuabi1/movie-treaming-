<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FavoriteController extends Controller
{
    //
    //
    public function __construct()
    {
        // $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $favorites = Favorite::where('user_id', Auth::id())->get();
        $movies = collect();
        foreach ($favorites as $favorite) {
            $movie = Movie::with('actors', 'categories')->find($favorite->movie_id);
            $movies->push($movie);
        }
        return response()->json($movies);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $favorite=new Favorite;
        return $this->requestFav($request,$favorite);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $idOrTitle)
    {
        //
        $movies = Movie::where('id', $idOrTitle)
            ->orWhere('title', 'LIKE', '%'.$idOrTitle.'%')
            ->with(['actors', 'category'])
            ->get();

        return response()->json($movies);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): \Illuminate\Http\JsonResponse
    {
        $favorite=DB::table('favorites')->where('movie_id', $id)->where('user_id', Auth::id())->delete();

        if ($favorite) {
            return response()->json(['message' => 'Movie has been deleted from favorites']);
        } else {
            return response()->json(['error' => 'Favorite not found'], 404);
        }
    }
    public function requestFav(Request $request, $favorite): \Illuminate\Http\JsonResponse
    {
        if($this->checkMovie($request->input('movie_id'))){
            return response()->json(['message' =>'Movie Already added to favorites']);
        }else {
            $favorite->movie_id = $request->input('movie_id');
            $favorite->user_id = Auth::id();
            $favorite->save();
            return response()->json($favorite);
        }

    }

    public function checkMovie(string $id)
    {
        $favorite = Favorite::where('movie_id', $id)
            ->where('user_id', Auth::id())
            ->first();

        return (bool)$favorite;
    }
}
