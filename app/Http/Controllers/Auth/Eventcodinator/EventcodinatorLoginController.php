<?php

namespace App\Http\Controllers\Auth\Eventcodinator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class EventcodinatorLoginController extends Controller
{

    public function __construct()
	{
		$this->middleware('guest:eventcodinator', ['except' => ['logout']]);
	}

    public function showLoginForm()
    {
    	return view('auth.eventcodinator-login');
    }

    public function login(Request $request)
    {
    	// validate the form data
    	$this->validate($request, [
    		'email' => 'required|email',
    		'password' => 'required|min:8'
    	]);

    	// Attempt to log user in 
    	if (Auth::guard('eventcodinator')->attempt(['email' => $request->email, 'password' => $request->password], $request-> remember)) {
    		// if successful, then redirect to their intended location
    		return redirect()->intended(route('eventcodinator.dashbord'));
    	}
    	
    	// if unsuccesful, then redirect back to the login with the form
    	return redirect()->back()->withInput($request->only('email','remember'));
    }

    public function logout()
    {
        Auth::guard('eventcodinator')->logout();

        return redirect('/');
    }
}
