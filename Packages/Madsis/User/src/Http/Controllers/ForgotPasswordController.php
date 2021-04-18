<?php

namespace Madsis\User\Http\Controllers;

use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{

    use SendsPasswordResetEmails;

    public function __construct()
    {
        parent::__construct();
        $this->middleware('guest');
    }

    public function showLinkRequestForm()
    {
        return view($this->_config['view']);
        // return view('auth.passwords.email');
    }
}
