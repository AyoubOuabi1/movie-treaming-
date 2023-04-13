<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //

    public function index(){
         try {
            $users=  DB::table('users')->where('id','<>',1)
                ->get();
            return response()->json($users);
        }catch(Exception $ex){
            return response()->json($ex->getMessage());
        }

    }
}
