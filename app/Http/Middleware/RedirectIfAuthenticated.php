<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {

        switch ($guard) {
            case 'collegeadmin':
                if(Auth::guard($guard)->check()){
                    return redirect()->route('collegeadmin.dashbord');
                }
                break;

            case 'hod':
                if(Auth::guard($guard)->check()){
                    return redirect()->route('hod.dashbord');
                }
                break;

            case 'eventcodinator':
                if(Auth::guard($guard)->check()){
                    return redirect()->route('eventcodinator.dashbord');
                }
                break;

            case 'student':
                if(Auth::guard($guard)->check()){
                    return redirect()->route('student.index');
                }
                break;
            
            default:
                if(Auth::guard($guard)->check()){
                    return redirect('/admin');
                }
                break;
        }

        // if (Auth::guard($guard)->check()) {
        //     return redirect('/home');
        // }

        return $next($request);
    }
}
