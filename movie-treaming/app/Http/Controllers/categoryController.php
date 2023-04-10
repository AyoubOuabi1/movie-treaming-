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
        $category=Category::all();
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
        //
        $category=new Category;
        $category->name = $request->input('name');
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
