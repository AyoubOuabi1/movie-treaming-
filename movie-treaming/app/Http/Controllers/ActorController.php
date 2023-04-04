<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use Illuminate\Http\Request;

class ActorController extends Controller
{
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
        $actors=Actor::all();
        return response()->json($actors);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $actor=new Actor;
        return $this->requestActor($request, $actor);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $actor= Actor::find($id);
        return response()->json($actor);
    }
    public function showView(string $id)
    {

        $actor= Actor::find($id);
        $movies = Actor::findOrFail($id)->movies;
        return view('components/actor',compact('actor','movies'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $actor = Actor::find($id);
        return $this->requestActor($request, $actor);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $genre =  Actor::find($id);
        $genre->delete();
        return response()->json(['messqge','Genre Deleted']);
    }

    /**
     * @param Request $request
     * @param $actor
     * @return \Illuminate\Http\JsonResponse
     */
    public function requestActor(Request $request, $actor): \Illuminate\Http\JsonResponse
    {
        $actor->full_name = $request->input('full_name');
        $actor->born_in = $request->input('born_in');
        $actor->nationality = $request->input('nationality');
        $actor->description = $request->input('description');
        $actor->role = $request->input('role');
        $actor->save();
        return response()->json($actor);
    }
}
