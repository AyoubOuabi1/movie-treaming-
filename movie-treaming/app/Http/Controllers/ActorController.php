<?php

namespace App\Http\Controllers;




use App\Models\Actor;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
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
        $validatedData = $request->validate([
            'full_name' => 'required',
            'born_in' => 'required',
            'nationality' => 'required',
            'description' => 'required',
            'role' => 'required',
            'actor_image' => 'required|image|mimes:png,jpg,jpeg,jfif|max:2048'
        ]);
        $actor=new Actor;
        $actor->full_name = $validatedData['full_name'];
        $actor->born_in = $validatedData['born_in'];
        $actor->nationality = $validatedData['nationality'];
        $actor->description = $validatedData['description'];
        $actor->role = $validatedData['role'];

        if ($request->hasFile('actor_image')) {
            $file = $request->file('actor_image');
            $allowedTypes = ['jpg', 'jpeg', 'png','jfif'];
            $fileType = $file->getClientOriginalExtension();
            if (!in_array($fileType, $allowedTypes)) {
                return redirect()->back()->withInput()->withErrors(['actor_image' => 'Invalid file type. Allowed types are jpg, jpeg, png, and jfif.']);
            }
            $result = Cloudinary::upload($request->file('actor_image')->getRealPath(), [
                "folder" => "actors/",
                "public_id" => uniqid(),
                "overwrite" => true
            ]);
            $actor->actor_image = $result->getSecurePath();
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

    public function findActorForUpdate(string $id)
    {
        $actor= Actor::find($id);
        return view('Admin/Actors/update_actor',compact('actor'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $actor = Actor::find($id);
        $validatedData = $request->validate([
            'full_name' => 'required',
            'born_in' => 'required',
            'nationality' => 'required',
            'description' => 'required',
            'role' => 'required',
            'actor_image' => 'nullable|image|mimes:png,jpg,jpeg,jfif|max:2048'
        ]);

        $actor->full_name = $validatedData['full_name'];
        $actor->born_in = $validatedData['born_in'];
        $actor->nationality = $validatedData['nationality'];
        $actor->description = $validatedData['description'];
        $actor->role = $validatedData['role'];

        if ($request->hasFile('actor_image')) {
            $file = $request->file('actor_image');
            $allowedTypes = ['jpg', 'jpeg', 'png','jfif'];
            $fileType = $file->getClientOriginalExtension();
            if (!in_array($fileType, $allowedTypes)) {
                return redirect()->back()->withInput()->withErrors(['actor_image' => 'Invalid file type. Allowed types are jpg, jpeg, png, and jfif.']);
            }
            $url = $actor->actor_image;
            $basename = basename($url);
            $pathinfo = pathinfo($basename);
            $public_id = $pathinfo['filename']; // "6433ebf9d72c2"
            Cloudinary::destroy($public_id);

            $result = Cloudinary::upload($request->file('actor_image')->getRealPath(), [
                "folder" => "actors/",
                "public_id" => uniqid(),
                "overwrite" => true
            ]);

            $actor->actor_image = $result->getSecurePath();
        }

        $actor->save();
        return redirect()->route('update-actor', ['id' => $id])->with('success', 'Actor updated successfully.');
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


}
