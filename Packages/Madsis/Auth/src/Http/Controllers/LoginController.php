<?php

namespace Madsis\Auth\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        parent::__construct();
    }

    public function username() {
        return 'username';
    }

    protected function credentials(Request $request)
    {
        $request->merge(['email' => $request->input($this->username())]);
        $request->request->add(['is_active' => '1']);
        return $request->only('email', 'password','is_active');
    }

    public function authenticated(Request $request, $user) {
        $user->last_login = Carbon::now()->toDateTimeString();
        $user->last_login_ip = $request->getClientIp();
        $user->save();
    }

    public function index()
    {
        return view($this->_config['view']);
    }

    public function notFound()
    {
        abort(404);
    }

    public function upload()
    {
        $url = $this->searchRepository->uploadSearchImage(request()->all());
        return $url;
    }

    public function showLoginForm()
    {
        return view($this->_config['view']);
    }

}