<?php

namespace App\Http\Controllers\Collegeadmin;

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

class CollegeadminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:collegeadmin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $col_code = Auth::user()->col_code;
        $countcollegeadmin = Collegeadmin::where('col_code',$col_code)->count();
        $countstudent = Student::where('stu_col_code',$col_code)->count();
        $countevent = Event::where('col_cod',$col_code)->count();
        $counteventcodinator = Eventcodinator::where('ec_col_code',$col_code)->count();
        $countparticipants = DB::table('participants')
            ->join('events', 'participants.event_id', '=', 'events.id')
            ->select('events.*','participants.*')
            ->Where('events.col_cod',$col_code)
            ->count();

        $students = Student::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))
                ->where('stu_col_code', $col_code)
                ->get();

        $studentchart = Charts::database($students, 'area', 'Chartjs')
                  ->title("Monthly new Register Student")
                  ->elementLabel("Total Student")
                  ->dimensions(1000, 500)
                  ->responsive(false)
                  ->groupByMonth(date('Y'), true);

        $events = Event::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))
                ->where('col_cod', $col_code)
                ->get();

        $eventchart = Charts::database($events, 'line', 'Chartjs')
                  ->title("Monthly new Register Events")
                  ->elementLabel("Total Events")
                  ->dimensions(1000, 500)
                  ->responsive(false)
                  ->groupByMonth(date('Y'), true);

        $participants = Participants::where(DB::raw("(DATE_FORMAT(participants.created_at,'%Y'))"),date('Y'))
            ->join('events', 'participants.event_id', '=', 'events.id')
            ->join('students', 'participants.enrollment_no', '=', 'students.stu_enrollment_no')
            ->select('events.*', 'students.*','participants.*')
            ->Where('events.col_cod',$col_code)
                ->get();

        $participantchart = Charts::database($participants, 'bar', 'Chartjs')
                  ->title("Monthly new Register Participants")
                  ->elementLabel("Total Participants")
                  ->dimensions(1000, 500)
                  ->responsive(false)
                  ->groupByMonth(date('Y'), true);
            
        return view('collegeadmin/index', compact('countstudent','countevent','counteventcodinator','countcollegeadmin','countparticipants','studentchart','eventchart','participantchart'));
        //return view('collegeadmin/index');
    }

    public function Paymentdetails(Request $request)
    {
        $col_code = Auth::user()->col_code;
        $ss = $request->input('ss');
        $pay = DB::table('payments')
            ->join('students', 'payments.enrollment_no', '=', 'students.stu_enrollment_no')
            ->join('events', 'payments.event_id', '=', 'events.id')
            ->select('students.*','events.*','payments.*')
            ->where('events.col_cod', $col_code)
           ->where(function($query) use ($ss){
                $query->orWhere('students.stu_enrollment_no', 'LIKE', $ss);
                $query->orWhere('students.stu_name', 'LIKE',$ss);
                $query->orwhere('events.id', 'LIKE', $ss);
                $query->orwhere('events.event_name', 'LIKE', $ss);
                $query->orwhere('payments.payment_status', 'LIKE', $ss);
            })
            ->paginate(10);

            $totel = 0;
            foreach ($pay as $a) {
                $totel = $a->amount + $totel;
            }
        return view('collegeadmin/Paymentdetail',compact('pay', 'ss','totel'));
    }
}