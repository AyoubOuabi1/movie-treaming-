<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            return $next($request);
        }
        return redirect()->route('login');
   /*     $token = $request->header('Authorization');

        if (!$token) {
            return redirect()->route('login');
        }

        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (TokenInvalidException $e) {
            return redirect()->route('login');
        } catch (JWTException $e) {
            return redirect()->route('login');
        }

        if (!$user) {
            return redirect()->route('login');
        }

        Auth::login($user);

        return $next($request);*/
    }
}
