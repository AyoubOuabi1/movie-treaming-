<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RatingController extends Controller
{
    //
    public function __construct()
    {
        //$this->middleware('auth:api');
    }
    public function index()
    {
        $ratings = Rating::with(['movie.categories', 'movie.actors'])->where('user_id', Auth::id())->get();
        return response()->json($ratings);
    }

    public function show(string $id)
    {
        $rating = Rating::with(['movie.categories', 'movie.actors'])->where('user_id', Auth::id())->find($id);
        if(!$rating){
            return response()->json('undefined');
        }
        return response()->json($rating);
    }



    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        if(!$this::checkRate($request->input('movie_id'))){
            $rating = new Rating;
            return $this->requestRating($request, $rating);
        }else {
            return response()->json('Already Rated');
        }

    }


    // Update the specified resource in storage.
    public function update(Request $request)
    {
        $this->validate($request, [
            'movie_id' => 'required|integer',
            'stars' => 'required|integer|min:1|max:5',
        ]);
        $rating=DB::table('ratings')->where('movie_id', $request->input('movie_id'))->where('user_id', Auth::id())->update(['starts'=>$request->input('stars')]);
        if (!$rating) {
            return response()->json(['error' => 'You can only update your own rating for this movie.'], 403);
        }
        return response()->json($rating);
    }


    // Remove the specified resource from storage.
    public function destroy($id)
    {
        $rating=DB::table('ratings')->where('movie_id', $id)->where('user_id', Auth::id())->delete();

        if (!$rating) {
            return response()->json(['error' => 'You can only delete your own rating for this movie.'], 403);
        }
        return response()->json(['message' => 'Rating deleted successfully']);
    }

    public function requestRating(Request $request, $rating):\Illuminate\Http\JsonResponse
    {
        $this->validate($request, [
            'movie_id' => 'required|integer',
            'stars' => 'required|integer|min:1|max:5',
        ]);
        $rating->movie_id = $request->input('movie_id');
        $rating->user_id =1;//Auth::id();
        $rating->starts = $request->input('stars');
        $rating->save();
        return response()->json($rating);
    }

    public static function checkRate(string $movie_id){
        $rating=DB::table('ratings')->where('movie_id', $movie_id)->where('user_id', 1);
        if($rating){
            return true;
        }else {
            return false;
        }
    }
}
