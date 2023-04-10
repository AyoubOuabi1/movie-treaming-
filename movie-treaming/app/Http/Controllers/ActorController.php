<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public static function getActors()
    {
        //
        $actors=Actor::All();
        return $actors;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $actor=new Actor;
        //$actor = $this->requestActor($request, $actor);
        $actor->full_name = $request->input('full_name');
        $actor->born_in = $request->input('born_in');
        $actor->nationality = $request->input('nationality');
        $actor->description = $request->input('description');
        $actor->role = $request->input('role');
        if ($request->hasFile('actor_image')) {

                $file = $request->file('actor_image');
                 $extension = $file->getClientOriginalExtension();
                $newName = time() . '_' . uniqid() . '.' . $extension;
                $file->move(public_path('images/actors'), $newName);
                $actor->actor_image = $newName;

        }

        $actor->save();
        return redirect()->route('add-actor')->with('success', 'User Added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $name)
    {
        //
        try {
            $actor=  DB::table('actors')->where('full_name','LIKE','%'.$name.'%')
                ->get();
            return response()->json($actor);
        }catch(Exception $ex){
            return response()->json($ex->getMessage());
        }

    }

    public static function getDirectors(){
        //
        try {
            $actor=  DB::table('actors')->where('role','=','director')
                ->get();
            return $actor;
        }catch(Exception $ex){
            return $ex->getMessage();
        }
    }
    public function showView(string $id)
    {

        $actor= Actor::find($id);
        $movies = Actor::findOrFail($id)->movies;
        return view('User/actor',compact('actor','movies'));
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
    public function requestActor(Request $request, $actor): Actor

    {

        $actor->full_name = $request->input('full_name');
        $actor->born_in = $request->input('born_in');
        $actor->nationality = $request->input('nationality');
        $actor->description = $request->input('description');
        $actor->role = $request->input('role');

        return $actor;
    }
}
