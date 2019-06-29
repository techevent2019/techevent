<?php

namespace App\Http\Controllers\Auth\Hod;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Password;

class HodForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:hod');
    }

    protected function broker()
    {
        return Password::broker('hods');
    }

    public function showLinkRequestForm()
    {
        return view('auth.passwords.email-hod');
    }
}
