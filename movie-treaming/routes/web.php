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

Route::get('favorites', [favoriteController::class, 'index']);


 Route::get('/', function () {
    return view('home');
});


