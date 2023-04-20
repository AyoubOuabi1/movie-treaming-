<?php

namespace App\Http\Controllers;

use App\Models\Movie;
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
        //
        $ratings = Rating::where('user_id',auth()->id())->get();
        $movies = collect();
        foreach ($ratings as $rating) {
            $movie = Movie::with('actors', 'categories')->find($rating->movie_id);
            $movies->push($movie);
        }
        return view('User/rate',compact('movies'));
    }

    public static  function  getOldReview($id){
        $user_id = auth()->id();
        $movie_id = $id;
        if(RatingController::checkRate($id)){
            $rating = Rating::where('user_id', $user_id)
                ->where('movie_id', $movie_id)
                ->first();
            return $rating->stars;
        }
        return  null;


    }
    public function show(string $id)
    {
        $rating = Rating::with(['movie.categories', 'movie.actors'])->where('user_id', Auth::id())->find($id);
        return $rating;
    }

    public static function getRatingWithAvg(string $id)
    {
        $rating = Rating::all()->where('movie_id',$id)->avg('stars');
        $rating1 = Rating::all()->where('movie_id',$id);
        $countRating=$rating1->count();
        $userRate = Rating::where('user_id', auth()->id())
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
        $user_id = auth()->id();
        $movie_id = $request->input('movie_id');
        $rating_value = $request->input('rating_value');

        try {
            if (!$this::checkRate($movie_id)) {
                $rating = new Rating;
                $rating->movie_id = $movie_id;
                $rating->user_id = $user_id;
                $rating->stars = $rating_value;
                //dd($rating);
                $rating->save();

                return redirect()->route('movieDetail', ['id' => $movie_id])->with('success', 'Rating has been added');
            } else {
                return redirect()->route('movieDetail', ['id' => $movie_id])->with('message', 'You have already rated this movie');
            }
        } catch (Exception $ex) {
            return redirect()->route('movieDetail', ['id' => $movie_id])->with('message', $ex->getMessage());
        }
    }



    // Update the specified resource in storage.
    public function update(Request $request)
    {
        $id=$request->input('movie_id');

        $rating=DB::table('ratings')->where('movie_id',$id )->where('user_id', auth()->id())->update(['stars'=>$request->input('stars')]);
        if (!$rating) {
            return redirect()->route('movieDetail', ['id' => $id])->with('error', 'You can only updqte your own rating for this movie');
        }
        return redirect()->route('movieDetail', ['id' => $id])->with('success', 'Rating updated successfully');

     }


    // Remove the specified resource from storage.
    public function destroy($id)
    {
         try{
            $rating=DB::table('ratings')->where('movie_id', $id)->where('user_id', auth()->id())->delete();

            if (!$rating) {
                return redirect()->route('movieDetail', ['id' => $id])->with('message', 'You can only delete your own rating for this movie');

             }
            return redirect()->route('movieDetail', ['id' => $id])->with('success', 'Rating deleted successfully');

         }catch(Exception $ex){
            return redirect()->route('movieDetail', ['id' => $id])->with('message', $ex->getMessage());
        }

    }



    public static function checkRate(string $movie_id){
        $rating = DB::table('ratings')->where('movie_id', $movie_id)->where('user_id', auth()->id())->get();
        return $rating->isNotEmpty();
    }


}
