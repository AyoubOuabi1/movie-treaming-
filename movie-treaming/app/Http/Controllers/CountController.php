<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Movie;

class CountController extends Controller
{
    public static function countUsers()
    {
        $count = User::count();
        return $count;
    }

    public static function countViews()
    {
        $count = Movie::sum('totalView');
        return $count;
    }

    public static function countMovies()
    {
        $count = Movie::count();
        return $count;
    }
}
