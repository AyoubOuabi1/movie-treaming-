<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    //
    public function __construct()
    {
        //$this->middleware('auth:api');
    }
    public function index()
    {
        $ratings = Rating::all();
        return response()->json($ratings);
    }

    // Show the form for creating a new resource.
    public function create()
    {
        // not applicable
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $rating = new Rating;
        return $this->requestRating($request, $rating);
    }

    // Display the specified resource.
    public function show($id)
    {
        $rating = Rating::find($id);
        return response()->json($rating);
    }

    // Show the form for editing the specified resource.
    public function edit($id)
    {
        // not applicable
    }

    // Update the specified resource in storage.
    public function update(Request $request, $id)
    {
        $rating = Rating::find($id);

        return $this->requestRating($request, $rating);
    }

    // Remove the specified resource from storage.
    public function destroy($id)
    {
        $rating = Rating::find($id);
        $rating->delete();
        return response()->json(['message' => 'Rating deleted successfully']);
    }

    public function requestRating(Request $request, $rating):\Illuminate\Http\JsonResponse
    {
        $rating->movie_id = $request->input('movie_id');
        $rating->user_id = $request->input('user_id');
        $rating->starts = $request->input('starts');
        $rating->save();
        return response()->json($rating);
    }
}
