<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    //
    public function __construct()
    {
       // $this->middleware('auth:api');
    }
    public function assignRole(string $id,Request $request){
        $roles = ['super-admin', 'moderator', 'simple-user'];
        if (!in_array($request->input('role'), $roles)) {
            return response()->json(['error' => 'Invalid role.'], 400);
        }
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'User not found.'], 404);
        }
        $user->syncRoles([$request->input('role')]);
        return response()->json(['message' => 'Role assigned successfully.']);
    }

    public  function getPermissions(Request $request){
        $role = Role::findByName($request->name);
        $permissions = $role->permissions->toArray();
        return response()->json($permissions);
    }
}
