<?php

namespace App\Http\Controllers\Auth\Hod;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Password;
use Auth\Hod;
use Auth;

class HodResetPasswordController extends Controller
{
    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/hod';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:hod');
    }

    protected function guard()
    {
        return Auth::guard('hod');
    }

    protected function broker()
    {
        return Password::broker('hods');
    }

    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.reset-hod')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }
}
