<?php

use App\Http\Controllers\ActorController;
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
Route::get('/actor/{id}', [ActorController::class, 'showView']);

Route::get('/movie/{id}', [MovieController::class, 'showView']);
Route::get('admin/movies', function (){
    return view('Admin/Movies/Movies');
})->name('getMovies');

Route::get('favorites', [favoriteController::class, 'index']);

Route::get('/movies',function(){
    return view('home');
});


Route::get('/admin/add-Movie',function(){
    return view('Admin/Movies/add_movie');
})->name("addMovie");


 Route::get('/', function () {
    return view('Admin/layouts/baseLayout');
});


