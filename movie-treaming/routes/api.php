<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ActorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\RatingController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Auth routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/refresh', [AuthController::class, 'refresh']);
Route::post('/logout', [AuthController::class, 'logout']);

// Actor routes
Route::get('/actors', [ActorController::class, 'index']);
Route::get('/actor/{id}', [ActorController::class, 'show']);
Route::post('/actor', [ActorController::class, 'store']);
Route::put('/actor/{id}', [ActorController::class, 'update']);
Route::delete('/actor/{id}', [ActorController::class, 'delete']);

// Category routes
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/category/{id}', [CategoryController::class, 'show']);
Route::post('/category', [CategoryController::class, 'store']);
Route::put('/category/{id}', [CategoryController::class, 'update']);
Route::delete('/category/{id}', [CategoryController::class, 'delete']);

// Favorite routes
Route::get('/favorites', [FavoriteController::class, 'index']);
Route::get('/favorite/{id}', [FavoriteController::class, 'show']);
Route::post('/favorites', [FavoriteController::class, 'store']);
Route::delete('/favorites/{id}', [FavoriteController::class, 'delete']);

// Home routes
Route::get('/home', [HomeController::class, 'index']);

// Movie routes
Route::get('/movies', [MovieController::class, 'index']);
Route::get('/movie/{idOrName}', [MovieController::class, 'show']);
Route::post('/movie', [MovieController::class, 'store']);
Route::put('/movie/{id}', [MovieController::class, 'update']);
Route::delete('/movie/{id}', [MovieController::class, 'destroy']);

// Rating routes
Route::get('/ratings', [RatingController::class, 'index']);
Route::get('/rating/{id}', [RatingController::class, 'show']);
Route::post('/ratings', [RatingController::class, 'store']);
Route::put('/ratings/{id}', [RatingController::class, 'update']);
Route::delete('/ratings/{id}', [RatingController::class, 'delete']);
