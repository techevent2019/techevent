<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Collegeadmin;
use App\Student;
use App\Event;
use App\Eventcodinator;
use App\Participants;
use App\Payment;
use DB;
use Auth;
use Charts;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $countcollege = Collegeadmin::count();
        $countstudent = Student::count();
        $countevent = Event::count();
        $countparticipars = Participants::count();

        $students = Student::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))
                    ->get();
        $studentchart = Charts::database($students, 'area', 'Chartjs')
                  ->title("Monthly new Register Student")
                  ->elementLabel("Total Student")
                  ->dimensions(1000, 500)
                  ->responsive(false)
                  ->groupByMonth(date('Y'), true);

        $events = Event::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))
                    ->get();

        $eventchart = Charts::database($events, 'line', 'Chartjs')
                  ->title("Monthly new Register Events")
                  ->elementLabel("Total Events")
                  ->dimensions(1000, 500)
                  ->responsive(false)
                  ->groupByMonth(date('Y'), true);

        $college = Collegeadmin::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))
                    ->get();

        $collegechart = Charts::database($college, 'bar', 'Chartjs')
                  ->title("Monthly new Register Colleges")
                  ->elementLabel("Total Colleges")
                  ->dimensions(1000, 500)
                  ->responsive(false)
                  ->colors(['green', 'aqua', 'red',])
                  ->groupByMonth(date('Y'), true);

        $participants = Participants::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))
                    ->get();

        $participantchart = Charts::database($participants, 'line', 'Chartjs')
                  ->title("Monthly new Register Participants")
                  ->elementLabel("Total Participants")
                  ->dimensions(1000, 500)
                  ->responsive(false)
                  ->colors(['orange', 'aqua', 'red',])
                  ->groupByMonth(date('Y'), true);


        // return view('admin/admin',compact('chart'));

        return view('admin/admin', compact('countstudent','countevent','countparticipars','countcollege','studentchart','eventchart','collegechart','participantchart'));
    }

    public function Paymentdetails(Request $request)
    {
        $ss = $request->input('ss');
        $pay = DB::table('payments')
            ->join('students', 'payments.enrollment_no', '=', 'students.stu_enrollment_no')
            ->join('events', 'payments.event_id', '=', 'events.id')
            ->select('students.*','events.*','payments.*')
           ->where(function($query) use ($ss){
                $query->orWhere('students.stu_enrollment_no', 'LIKE', $ss);
                $query->orWhere('students.stu_name', 'LIKE',$ss);
                $query->orwhere('events.id', 'LIKE', $ss);
                $query->orwhere('events.col_cod', 'LIKE',$ss);

                $query->orwhere('events.college_name', 'LIKE','%'.$ss.'%');

                $query->orwhere('events.event_name', 'LIKE','%'.$ss.'%');
                $query->orwhere('payments.payment_status', 'LIKE', $ss);
            })
            ->paginate(10);

            $totel = 0;
            foreach ($pay as $a) {
                $totel = $a->amount + $totel;
            }
        return view('admin/Paymentdetail',compact('pay', 'ss','totel'));
    }
}
