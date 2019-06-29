<?php

namespace App\Http\Controllers\Auth\Collegeadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Collegeadmin;

class CollegeadminLoginController extends Controller
{
	public function __construct()
	{
		$this->middleware('guest:collegeadmin', ['except' => ['logout']]);
	}

    public function showLoginForm()
    {
    	return view('auth.collegeadmin-login');
    }

    public function login(Request $request)
    {
    	// validate the form data
    	$this->validate($request, [
    		'email' => 'required|email',
    		'password' => 'required|min:8'
    	]);

    	// Attempt to log user in 
    	if (Auth::guard('collegeadmin')->attempt(['email' => $request->email, 'password' => $request->password], $request-> remember)) {
    		// if successful, then redirect to their intended location
            return redirect()->intended(route('collegeadmin.dashbord'));
    	}
    	
    	// if unsuccesful, then redirect back to the login with the form
    	return redirect()->back()->withInput($request->only('email','remember'));
    }

    public function logout()
    {
        Auth::guard('collegeadmin')->logout();

        return redirect('/');
    }
}
