<?php

namespace App\Http\Controllers\Auth\Hod;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class HodLoginController extends Controller
{
    public function __construct()
	{
		$this->middleware('guest:hod', ['except' => ['logout']]);
	}

    public function showLoginForm()
    {
    	return view('auth.hod-login');
    }

    public function login(Request $request)
    {
    	// validate the form data
    	$this->validate($request, [
    		'email' => 'required|email',
    		'password' => 'required|min:8'
    	]);

    	// Attempt to log user in 
    	if (Auth::guard('hod')->attempt(['email' => $request->email, 'password' => $request->password], $request-> remember)) {
    		// if successful, then redirect to their intended location
    		return redirect()->intended(route('hod.dashbord'));
    	}
    	
    	// if unsuccesful, then redirect back to the login with the form
    	return redirect()->back()->withInput($request->only('email','remember'));
    }

    public function logout()
    {
        Auth::guard('hod')->logout();

        return redirect('/');
    }
}
