<?php

use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
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

Route::post('/refresh', [AuthController::class, 'refresh']);
Route::post('/logout', [AuthController::class, 'logout']);
//users routes
Route::get('/admin/users/{role}', [UserController::class, 'index'])->name('get-users');
Route::delete('/admin/users/{id}', [UserController::class, 'destroy'])->name('delete-users');

// Actor routes
Route::get('/actors', [ActorController::class, 'index']);
Route::get('/actor/{name}', [ActorController::class, 'show'])->name('find-actor');
Route::post('/actor', [ActorController::class, 'store']);
Route::put('/actor/{id}', [ActorController::class, 'update']);
Route::delete('/actor/{id}', [ActorController::class, 'destroy'])->name('delete-actor');

// Category routes
Route::get('/categories', [CategoryController::class, 'index'])->name('load-categories');
Route::get('/category/{name}', [CategoryController::class, 'show'])->name('find-category');
Route::post('/category', [CategoryController::class, 'store'])->name('add-category');
Route::put('/category/{id}', [CategoryController::class, 'update'])->name('update-category');
Route::delete('/category/{id}', [CategoryController::class, 'destroy'])->name('delete-category');

// Favorite routes
Route::get('/favorites', [FavoriteController::class, 'index']);
Route::get('/favorite/{id}', [FavoriteController::class, 'show']);
Route::post('/favorite', [FavoriteController::class, 'store']);
Route::delete('/favorite/{id}', [FavoriteController::class, 'destroy']);

// Home routes
Route::get('/home', [HomeController::class, 'index']);

// Movie routes
Route::get('/movies', [MovieController::class, 'index']);
Route::get('/movie/{idOrName}', [MovieController::class, 'show']);
Route::get('/admin/movies/movie/{id}', [MovieController::class, 'findMovieApi'])->name("findMovieApi");
Route::post('/movie', [MovieController::class, 'store']);
Route::put('/movie/{id}', [MovieController::class, 'update']);
Route::delete('/movie/{id}', [MovieController::class, 'destroy']);

// Rating routes
Route::get('/ratings', [RatingController::class, 'index']);
Route::get('/rating/{id}', [RatingController::class, 'show']);
Route::post('/rating', [RatingController::class, 'store']);
Route::put('/update-rating', [RatingController::class, 'update']);
Route::delete('/delete-rating/{id}', [RatingController::class, 'destroy']);

////////permissions
Route::put('admin/users/assignRole/{id}', [RoleController::class,'assignRole'])->name('assignRole');
Route::post('admin/users/getPermission', [RoleController::class,'getPermissions'])->name('getPermissions');
