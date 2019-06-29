<?php

namespace App\Http\Controllers\Auth\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Password;
use Auth\Hod;
use Auth;

class StudentResetPasswordController extends Controller
{
    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/student';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:student');
    }

    protected function guard()
    {
        return Auth::guard('student');
    }

    protected function broker()
    {
        return Password::broker('students');
    }

    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.reset-student')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }
}
