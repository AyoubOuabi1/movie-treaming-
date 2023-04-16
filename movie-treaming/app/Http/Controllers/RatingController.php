<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Exception;
use Illuminate\Http\JsonResponse;
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

    public static function getRatingWithAvg(string $id)
    {
        $rating = Rating::all()->where('movie_id',$id)->avg('stars');
        $rating1 = Rating::all()->where('movie_id',$id);
        $countRating=$rating1->count();
        $userRate = Rating::where('user_id', 1)
            ->where('movie_id', $id)
            ->pluck('stars')->first();
        if($rating==0){
            return array(0,0,0);
        }else{
            return array($rating,$userRate,$countRating);
        }

    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        try{
            if(!$this::checkRate($request->input('movie_id'))){
                $rating = new Rating;
                return $this->requestRating($request, $rating);
            }else{
                return response()->json('Already Rated');
            }

        }catch(Exception $ex){
            return response()->json($ex->getMessage());
        }


    }


    // Update the specified resource in storage.
    public function update(Request $request)
    {
        $this->validate($request, [
            'movie_id' => 'required|integer',
            'stars' => 'required|integer|min:1|max:5',
        ]);
        $rating=DB::table('ratings')->where('movie_id', $request->input('movie_id'))->where('user_id', 1)->update(['stars'=>$request->input('stars')]);
        if (!$rating) {
            return response()->json(['error' => 'You can only update your own rating for this movie.'], 403);
        }
        return response()->json($rating);
    }


    // Remove the specified resource from storage.
    public function destroy($id)
    {
        try{
            $rating=DB::table('ratings')->where('movie_id', $id)->where('user_id', 1)->delete();

            if (!$rating) {
                return response()->json(['error' => 'You can only delete your own rating for this movie.'], 403);
            }
            return response()->json(['message' => 'Rating deleted successfully']);
        }catch(Exception $ex){
            return response()->json($ex->getMessage());
        }

    }

    public function requestRating(Request $request, $rating): JsonResponse
    {
        $this->validate($request, [
            'movie_id' => 'required|integer',
            'stars' => 'required|integer|min:1|max:5',
        ]);
        $rating->movie_id = $request->input('movie_id');
        $rating->user_id =1;//Auth::id();
        $rating->stars = $request->input('stars');
        $rating->save();
        return response()->json($rating);
    }

    public static function checkRate(string $movie_id){
        $rating = DB::table('ratings')->where('movie_id', $movie_id)->where('user_id', 1)->get();
        return $rating->isNotEmpty();
    }


}
