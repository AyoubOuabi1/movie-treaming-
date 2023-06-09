<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Movie;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FavoriteController extends Controller
{


    public function __construct()
    {

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $favorites = Favorite::where('user_id',auth()->id())->get();
        $movies = collect();
        foreach ($favorites as $favorite) {
            $movie = Movie::with('actors', 'categories')->find($favorite->movie_id);
            $movies->push($movie);
        }
        return view('User/favorite',compact('movies'));
    }
    public static function getFavMovies()
    {
        //
        $favorites = Favorite::where('user_id',auth()->id())->get();
        $movies = collect();
        foreach ($favorites as $favorite) {
            $movie = Movie::with('actors', 'categories')->find($favorite->movie_id);
            $movies->push($movie);
        }
        return $movies;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user_id = auth()->id();
        $movie_id = $request->input('movie_id');

        try {
            if ($this->checkMovie($movie_id)) {
                return redirect()->route('movieDetail', ['id' => $movie_id])->with('message', 'Movie already added to favorites');
            } else {
                $favorite = new Favorite;
                $favorite->movie_id = $movie_id;
                $favorite->user_id = $user_id; // or Auth::id();
                $favorite->save();
                return redirect()->route('movieDetail', ['id' => $movie_id])->with('success', 'Movie has been added to favorites');
            }
        } catch (Exception $ex) {
            return redirect()->route('movieDetail', ['id' => $movie_id])->with('message', $ex->getMessage());
        }
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
    public function destroy(string $id)
    {
        try{
            $favorite=DB::table('favorites')->where('movie_id', $id)->where('user_id', auth()->id())->delete();

            if ($favorite) {

                return redirect()->route('movieDetail', ['id' => $id])->with('success', 'Movie has been deleted from favorites');

            } else {
                return redirect()->route('movieDetail', ['id' => $id])->with('message', 'Favorite not found');
            }
        }catch (Exception $e) {
            return redirect()->route('movieDetail', ['id' => $id])->with('message', $e->getMessage());
        }

    }


    public static function checkMovie( $movie_id)

    {
        $user_id=auth()->id();
        $favorite = DB::table('favorites')->where('movie_id', $movie_id)->where('user_id', $user_id)->get();

        return $favorite->isNotEmpty();
    }
}
