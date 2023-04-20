<?php

use App\Http\Controllers\ActorController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\RatingController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
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

Route::post('/save-login', [AuthController::class, 'login'])->name('save-login');

Route::get('/register', function (){
    return view('Auth/register');
})->name('register');

Route::get('/user-id', function (){
    $user_id = request()->cookie('user_id');

// Check if the cookie exists
    if ($user_id !== null) {
        // Do something with the user ID
        echo "User ID: " . $user_id;
    } else {
        // Create a new cookie with a 4-hour expiry time
        Cookie::queue('user_id', auth()->id(), 60 * 4);
        echo "User ID cookie created with a 4-hour expiry time.";
    }

})->name('getId')->middleware('authJWT');

//Users ///////////////////////////
Route::middleware('authJWT')->group(function () {

    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::group(['middleware' => ['role:super-admin|moderator']], function () {
        //dashboard
        Route::get('/dashboard', function () {
            return view('Admin/home');
        })->name('dashboard');
        //actors ///////////////////////////
        Route::post('admin/actors/save-actor', [ActorController::class, 'store'])->name('save-actor');
        Route::put('admin/actors/save-update-actor/{id}', [ActorController::class, 'update'])->name('save-update-actor');

        Route::get('admin/actors/add-actor', function (){
           // dd(auth()->user());
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

//////////////////////////////////////Categories////////////////////////////////
        Route::get('/admin/categories',function(){

            return view('Admin/Categories/Categories');

        })->name("loadCategories");
    });
        //// favorite
        Route::get('/favorites', [FavoriteController::class, 'index'])->name('get-favorites');
        Route::get('/favorite/{id}', [FavoriteController::class, 'show'])->name('find-favorite');
        Route::post('/favorite', [FavoriteController::class, 'store'])->name('add-favorite');
        Route::delete('/favorite/{id}', [FavoriteController::class, 'destroy'])->name('delete-favorite');
        //rating
        Route::get('/rated', [RatingController::class, 'index'])->name('get-rated');
        Route::post('/rating', [RatingController::class, 'store'])->name('add-rate');
        Route::delete('/delete-rating/{id}', [RatingController::class, 'destroy'])->name('remove-rate');
        Route::put('/update-rating', [RatingController::class, 'update'])->name('update-rate');
    Route::group(['middleware' => ['role:super-admin|moderator']], function () {
        //
        //users
        Route::get('admin/users/users', function (){
            return view('Admin/Users/Users');
        })->name('getUsers');
    });
    Route::get('/actor/{id}', [ActorController::class, 'showView'])->name('showActor');

    Route::get('/movie/{id}', [MovieController::class, 'movieDetail'])->name('movieDetail');
    Route::get('/movie/watch/{id}', [MovieController::class, 'updateTotalView'])->name('watchMovie');


 //////////favorite
    Route::get('favorites', [favoriteController::class, 'index']);
});


/////////////
Route::get('/',function(){
    return view('home');
})->name('home-page');



