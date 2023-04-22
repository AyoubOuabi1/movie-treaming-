<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $token=$request->cookie('jwt_token');
        if($token){
            $request->headers->set('Authorization', 'Bearer ' . $token);
            //dd($request,Auth::user());
            return $next($request);
        }
        return redirect()->route('login');

    }
    public static function checkLogin(){
        $token=Cookie::get('jwt_token');
        if($token){

            return true;
        }
        return false;
    }
    public static  function  checkUser(){
        if(JwtMiddleware::checkLogin()){
            $user=\App\Models\User::find(auth()->id());
            if($user->hasRole('simple-user')){
                return 1;
            }else if ($user->hasRole('moderator')){
                return 2;
            }else if ($user->hasRole('super-admin')){
                return 3;
            }
        }
    }
}
