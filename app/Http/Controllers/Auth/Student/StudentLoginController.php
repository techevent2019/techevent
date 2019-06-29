<?php

namespace App\Http\Controllers\Auth\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use Student;

class StudentLoginController extends Controller
{
    public function __construct()
	{
		$this->middleware('guest:student', ['except' => ['logout']]);
	}

    public function showLoginForm()
    {
    	return view('auth.student-login');
    }

    public function login(Request $request)
    {
    	// validate the form data
    	$this->validate($request, [
    		'email' => 'required|email',
    		'password' => 'required|min:8'
    	]);

        // $a = DB::table('students')
        //     ->where('email', $request->input('email'))
        //     ->where('emailvarification', '1')->first();

        // if(!is_null($a))
        // {
            // Attempt to log user in 
            if (Auth::guard('student')->attempt(['email' => $request->email, 'password' => $request->password], $request-> remember)) {
                // if successful, then redirect to their intended location
                return redirect()->intended(route('student.index'));
            }
            
            // if unsuccesful, then redirect back to the login with the form
            return redirect()->back()->withInput($request->only('email','remember'));

        // }
        // else
        // {
        //     return redirect()->back()->with('danger', 'please first verify your email , check your mail');
        // }

    }

    public function logout()
    {
        Auth::guard('student')->logout();

        return redirect('/');
    }
}
