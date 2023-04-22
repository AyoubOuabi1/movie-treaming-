<?php

namespace App\Http\Controllers;

use App\Models\User;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function show(){
        $user=User::find(auth()->id());
        return view('User/profile',compact('user'));
    }
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
    public function update(Request $request) {
        $user = auth()->user(); // Retrieve the authenticated user

        $request->validate([
            'name' => 'string|max:255',
            'email' => 'string|email|max:255|unique:users,email,' . $user->id,
            'old_password' => 'required_with:old_password|string',
            'password' => 'required_with:password|string|min:8',
            'image' =>  ['nullable', 'image', 'max:2048', 'mimes:jpg,jpeg,png,jfif']
        ]);

        $name = $request->input('name');
        $email = $request->input('email');
        $oldPassword = $request->input('old_password');
        $newPassword = $request->input('password');
        $image = $request->file('image');
        $user->name = $name;
        $user->email = $email;
        if ($request->hasFile('image')) {
            $result = Cloudinary::upload($image->getRealPath(), [
                "folder" => "profiles/",
                "public_id" => "profile_" . time(),
                "overwrite" => true
            ]);
            $user->image = $result->getSecurePath();
        }

        if ($newPassword && $oldPassword) {
            if (Hash::check($oldPassword, $user->password)) {
                $user->password = Hash::make($newPassword);
            } else {
                return redirect()->route('user-profile')->with('msg-error', 'The old password is incorrect');

            }
        }

        $user->save(); // Save the updated user information

        return redirect()->route('user-profile')->with('success', 'User information has been updated successfully.');
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
