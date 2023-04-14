<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //

    public function index(string $role,request $request){
        $name = $request->input('name');
        $query = User::role($role);

        if ($name) {
            $keywords = preg_split('/\s+/', trim($name));
            foreach ($keywords as $keyword) {
                $query->where(function ($query) use ($keyword) {
                    $query->where('name', 'like', '%' . $keyword . '%')
                        ->orWhere('email', 'like', '%' . $keyword . '%');
                });
            }
        }

        $users = $query->get();
        if ($users->isEmpty()) {
            return response()->json(['error' => 'No users found.'], 404);
        }

        return response()->json($users);

    }

    public function destroy(string $id){
        try{
            $user=DB::table('users')->where('id', $id)->delete();

            if ($user) {
                return response()->json(['message' => 'User has been deleted ']);
            } else {
                return response()->json(['error' => 'User not found'], 404);
            }
        }catch (Exception $e) {
            return response()->json($e->getMessage());
        }
    }
}
