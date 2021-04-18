<?php
namespace Madsis\Api\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Log;

class ApiController extends Controller
{
    use AuthenticatesUsers;
    
    protected function credentials(Request $request){
        $request->merge(['email' => $request->input('email')]);
        $request->request->add(['is_active' => '1']);
        return $request->only('email', 'password','is_active');
    }

    public function authenticated(Request $request, $user) {
        $user->last_login = \Carbon\Carbon::now()->toDateTimeString();
        $user->last_login_ip = $request->getClientIp();
        $user->save();
    }

    public function login(Request $request){
        $this->validateLogin($request);
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }
        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }
        $this->incrementLoginAttempts($request);
        return $this->sendFailedLoginResponse($request);
    }

    public function logout(){
        Log::info('Ajax Peticion para destruir token');
        auth('api')->logout(true);
        auth('api')->invalidate(true);
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh(){
        return $this->respondWithToken(auth('api')->claims(['user' => auth()->user()->getJWTIdentifier(),'role' => auth()->user()->getRoleNames()[0]])->refresh(true,true));
    }

    public function loggedIn(){
        return auth('api')->user();
    }

    protected function sendFailedLoginResponse(){
        return response()->json(['message' => 'Credenciales Incorrectas'], 401);
    }

    protected function sendLoginResponse(Request $request){
        $field = filter_var($request->input($this->username()), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $token =  auth('api')->claims(['user' => auth()->user()->getJWTIdentifier(),'role' => auth()->user()->getRoleNames()[0]])->attempt($request->only($field, 'password'));
        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token){
        // 'expires_in' => auth('api')->factory()->getTTL() * 60,
        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL()/*,
            'user' => auth('api')->user()->getJWTIdentifier()*/
        ]);
    }
}