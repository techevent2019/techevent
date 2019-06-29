<?php

namespace App\Http\Controllers\Auth\Eventcodinator;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Password;

class EventcodinatorForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:eventcodinator');
    }

    protected function broker()
    {
        return Password::broker('eventcodinators');
    }

    public function showLinkRequestForm()
    {
        return view('auth.passwords.email-eventcodinator');
    }
}
