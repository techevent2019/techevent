<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Student;
use App\Event;
use App\Collegeadmin;
use Auth;

class StudentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:student');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $ss = $request->input('ss');

        $events = Event::latest()
            ->search($ss)
            ->paginate(9);
        return view('student.index', compact('events', 'ss'));

        // $events = Event::all();
        // return view('student.index', ['events' => $events]);
    }

    public function events($id)
    {
        $stu_id = Auth::user()->id;
        $student = Student::find($stu_id);
        $event = Event::find($id);
        return view('student.event',compact('event','student'));
    }

    public function colleges(Request $request)
    {
        $ss = $request->input('ss');
        $colleges = Collegeadmin::latest()
            ->search($ss)
            ->paginate(9);
        return view('student.college', compact('colleges', 'ss'));
    }

}
