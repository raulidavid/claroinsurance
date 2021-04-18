<?php

namespace SIEC\Http\Middleware;

use Closure;
use JWTAuth;
use Exception;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return response()->json(['message' => 'Token is Invalid'],401);
            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return response()->json(['message'=>'Token is Expired'],401);
            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenBlacklistedException) {
                return response()->json(['message'=>'Token BlackListed'],401);
            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\UserNotDefinedException) {
                return response()->json(['message'=>'User not Found'],404);
            }
            /*else{
                return response()->json(['message' => 'Authorization Token not found'],404);
            }*/
        }
        return $next($request);
    }
}
