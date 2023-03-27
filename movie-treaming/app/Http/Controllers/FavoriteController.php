<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;

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
        $favorite=Favorite::all();
        return response()->json($favorite);
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
    public function show(string $id)
    {
        //
        $favorite= Favorite::find($id);
        return response()->json($favorite);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $favorite = Favorite::find($id);
        return $this->requestFav($request,$favorite);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $favorite =  Favorite::find($id);
        $favorite->delete();
        return response()->json(['messqge','movie has been Deleted from Favorite']);
    }
    public function requestFav(Request $request, $favorite): \Illuminate\Http\JsonResponse
    {
        $favorite->movie_id = $request->input('movie_id');
        $favorite->user_id = $request->input('user_id');
        $favorite->save();
        return response()->json($favorite);
    }
}
