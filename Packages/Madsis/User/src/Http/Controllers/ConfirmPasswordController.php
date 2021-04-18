<?php

namespace Madsis\User\Http\Controllers;

use Illuminate\Foundation\Auth\ConfirmsPasswords;

class ConfirmPasswordController extends Controller
{
    use ConfirmsPasswords;

    protected $redirectTo = '/home';

    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }
}