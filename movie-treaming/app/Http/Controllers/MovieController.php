<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use App\Models\Movie;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class MovieController extends Controller
{
    //
    public function __construct()
    {
        //$this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = 10; // Set the number of movies to show per page
        $currentPage = $request->input('page', 1); // Get the current page from the query string
        $movies = Movie::with('actors', 'categories')->paginate($perPage, ['*'], 'page', $currentPage); // Get the paginated movies for the current page

        return response()->json($movies);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        try {
            $movie = new Movie;
            $movie = $this->requestMovie($request, $movie);
            $movie->totalView=0;
            $movie->save();
            $categoryIds = $request->input('categoryIds');
            $actorsIds = $request->input('actorsIds');

            DB::transaction(function () use ($movie, $categoryIds, $actorsIds) {
                $movie->save();
                $movie->categories()->attach($categoryIds);
                $movie->actors()->attach($actorsIds);
            });
            return response()->json($movie);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $idOrName)
    {

        $movie = Movie::with('categories', 'actors')
            ->where(function ($query) use ($idOrName) {
                $query->where('id', $idOrName)
                    ->orWhere('name', 'like', '%' . $idOrName . '%');
            })
            ->get();

        return response()->json($movie);
    }
    public function showView(string $id)
    {
        //
        $movie = Movie::with('categories', 'actors')
            ->where('id', $id)
            ->get()->first();

        return view('components/movie_page',compact('movie'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $movie = Movie::findOrFail($id);

            // Update movie attributes
            $movie = $this->requestMovie($request, $movie);
            $movie->save();
            $categoriesIds = $request->input('categoryIds');
            $actorsIds = $request->input('actorsIds');

            DB::transaction(function () use ($movie, $categoriesIds, $actorsIds) {
                $movie->save();
                $movie->categories()->sync($categoriesIds);
                $movie->actors()->sync($actorsIds);
            });
            return response()->json($movie);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }

    public function updateTotalView(string $id)
    {
        try {
            $movie = Movie::findOrFail($id);

            // Update movie attributes
            $movie->totalView=$movie->totalView+1;
            $movie->save();

            return response()->json(['success' => 'view has been added']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        try {
            $movie = Movie::findOrFail($id);
            $movie->delete();
            return response()->json(['message' => 'Movie deleted']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }

    /**
     * @param Request $request
     * @param $movie
     */
    public function requestMovie(Request $request, $movie):Movie
    {

        $movie->name = $request->input('name');
        $movie->realased_date = $request->input('realased_date');
        $movie->server_link = $request->input('server_link');
        $movie->type = $request->input('type');
        $movie->description = $request->input('description');
        $movie->duration = $request->input('duration');
        $movie->cover_image = $request->input('cover_image');
        $movie->trailer_video = $request->input('trailer_video');
        $movie->languages = $request->input('languages');
        $movie->directorId = $request->input('directorId');

       return $movie;
    }


}
