<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class categoryController extends Controller
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
        $category=Category::orderBy('id', 'desc')->get();
        return response()->json($category);
    }

    public static function getCategories()
    {
        //
        $category=Category::All();
        return $category;
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

         $category = Category::where('name', $validatedData['name'])->first();

        if ($category) {
             return response()->json(['error' => 'Category already exists'], 409);
        }

         $category = new Category;
        $category->name = $validatedData['name'];
        $category->save();

        return response()->json($category);
    }

    /**
     * Display the specified resource.
     */

    public function show(string $name)
    {
        //
        try {
            $category=  DB::table('categories')->where('name','LIKE','%'.$name.'%')
                ->get();
            return response()->json($category);
        }catch(Exception $ex){
            return response()->json($ex->getMessage());
        }

    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $category = Category::find($id);
        $category->name = $request->input('name');
        $category->save();
        return response()->json($category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $category =  Category::find($id);
        $category->delete();
        return response()->json(['messqge','Category Deleted']);
    }


}
