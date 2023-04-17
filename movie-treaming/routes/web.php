<?php

use App\Http\Controllers\ActorController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//////////Auth//////////
Route::get('/login', function (){
    return view('Auth/login');
})->name('login');
Route::post('/save-register', [AuthController::class, 'register'])->name('save-register');

Route::post('/login', [AuthController::class, 'login'])->name('save-login');

Route::get('/register', function (){
    return view('Auth/register');
})->name('register');

//Users ///////////////////////////
Route::middleware('authJWT')->group(function () {

    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::post('/logout', [AuthController::class, 'logout']);

    //dashboard
    Route::get('/', function () {
        return view('Admin/home');
    })->name('dashboard');
    //users

    Route::get('admin/users/users', function (){
        return view('Admin/Users/Users');
    })->name('getUsers');

//actors ///////////////////////////
    Route::get('/actor/{id}', [ActorController::class, 'showView']);
    Route::post('admin/actors/save-actor', [ActorController::class, 'store'])->name('save-actor');
    Route::put('admin/actors/save-update-actor/{id}', [ActorController::class, 'update'])->name('save-update-actor');

    Route::get('admin/actors/add-actor', function (){
        return view('Admin/Actors/add_actor');
    })->name('add-actor');

    Route::get('admin/actors/update-actor/{id}',[ActorController::class,'findActorForUpdate'])->name('update-actor');

    Route::get('admin/actors/actors', function (){
        return view('Admin/Actors/Actors');
    })->name('getActors');

//Movie///////////////////////////

    Route::get('/admin/movies/update-movie/{id}', [MovieController::class, 'findMovie'])->name('findMovie');
    Route::put('/admin/movies/save-update-movie/{id}', [MovieController::class, 'update'])->name('save-update-movie');
    Route::post('/admin/movie/save-Movie',[MovieController::class, 'store'])->name('save-movie');

    Route::get('admin/movies', function (){
        return view('Admin/Movies/Movies');
    })->name('getMovies');




    Route::get('/admin/add-Movie',function(){

        return view('Admin/Movies/add_movie');

    })->name("addMovie");




 //////////favorite
    Route::get('favorites', [favoriteController::class, 'index']);
//////////////////////////////////////Categories////////////////////////////////
    Route::get('/admin/categories',function(){

        return view('Admin/Categories/Categories');

    })->name("loadCategories");
});

Route::get('/movie/{id}', [MovieController::class, 'movieDetail']);



