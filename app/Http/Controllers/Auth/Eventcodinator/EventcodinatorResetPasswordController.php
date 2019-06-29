<?php

namespace App\Http\Controllers\Auth\Eventcodinator;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Password;
use Auth\Eventcodinator;
use Auth;

class EventcodinatorResetPasswordController extends Controller
{
    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/eventcodinator';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:eventcodinator');
    }

    protected function guard()
    {
        return Auth::guard('eventcodinator');
    }

    protected function broker()
    {
        return Password::broker('eventcodinators');
    }

    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.reset-eventcodinator')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }
}
