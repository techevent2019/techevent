<?php

namespace App\Http\Controllers\Hod;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HodController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:hod');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('hod/hod');
    }
}
