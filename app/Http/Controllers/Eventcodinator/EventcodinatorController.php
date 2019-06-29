<?php

namespace App\Http\Controllers\Eventcodinator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Eventcodinator;
use App\Participants;
use App\Collegeadmin;
// use App\Notifications\Eventcodinator\ParticipantseventstartedNotification;
// use App\Notifications\Eventcodinator\Participantseventstartedforround2Notification;
// use App\Notifications\Eventcodinator\Participantseventstartedforround3Notification;
use Illuminate\Support\Facades\Hash;
use Auth;
use DB;
use Notification;

class EventcodinatorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:eventcodinator');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $event_id = Auth::user()->event_id;
        $ec_col_code = Auth::user()->ec_col_code;
        $s = $request->input('ss');

        $college = Collegeadmin::all()
            ->where('col_code', '=' ,$ec_col_code);

        $participants = DB::table('participants')
            ->join('events', 'participants.event_id', '=', 'events.id')
            ->join('students', 'participants.enrollment_no', '=', 'students.stu_enrollment_no')
            ->select('events.*', 'students.*','participants.*')

            ->where('events.id', '=', $event_id)
            ->where('participants.register', '=', '1')
            ->where('participants.leader', '=', '1')
            ->where(function($query) use ($s){
                $query->orwhere('students.stu_col_code', 'LIKE', '%'.$s.'%');
                $query->orWhere('students.stu_col_name', 'LIKE', '%'.$s.'%');
                $query->orWhere('students.stu_enrollment_no', 'LIKE', '%'.$s.'%');
                $query->orWhere('students.stu_gender', 'LIKE',$s);
                $query->orWhere('students.email', 'LIKE', '%'.$s.'%');
            })
            ->paginate(15);

        // $event_id = Auth::user()->event_id;
        // $ss = $request->input('ss');

        // $participants = Participants::where('event_id',$event_id)
        //     ->searchforcollegeadmin($ss)
        //     ->paginate(10);
        return view('eventcodinator/index', compact('participants', 's', 'college'));
    }

    public function present(Request $request)
    { 
        $present = Participants::all();
        foreach ($present as $b) {
            $b->present = '0';
            $b->save();
        }

        $present = $request->input('present');
        if(!is_null($present))
        {
            foreach ($present as $p) {
            //echo $p;
            $present = Participants::find($p);
            $present->present  = '1';
            $present->save();
            }
        }
       return redirect()->route('eventcodinator.dashbord')->with('success', 'Successfully Updated');
    }

    public function winner(Request $request)
    {
        $event_id = Auth::user()->event_id;
        $ec_col_code = Auth::user()->ec_col_code;
        $s = $request->input('ss');

        $college = Collegeadmin::all()
            ->where('col_code', '=' ,$ec_col_code);

        $participants = DB::table('participants')
            ->join('events', 'participants.event_id', '=', 'events.id')
            ->join('students', 'participants.enrollment_no', '=', 'students.stu_enrollment_no')
            ->select('events.*', 'students.*','participants.*')

            ->where('events.id', '=', $event_id)
            ->where('participants.winner', '!=', 'null')
            ->orderBy('winner','asc')
            ->where(function($query) use ($s){
                $query->orwhere('students.stu_col_code', 'LIKE', '%'.$s.'%');
                $query->orWhere('students.stu_col_name', 'LIKE', '%'.$s.'%');
                $query->orWhere('students.stu_enrollment_no', 'LIKE', '%'.$s.'%');
                $query->orWhere('students.stu_gender', 'LIKE',$s);
                $query->orWhere('students.email', 'LIKE', '%'.$s.'%');
            })
            ->paginate(15);
        return view('eventcodinator/winner/index', compact('participants', 's', 'college'));
    }

    public function reset(Request $request)
    { 
        $present = Participants::all();
        foreach ($present as $b) {
            $b->present = '0';
            $b->round1score = '0';
            $b->round2score = '0';
            $b->round3score = '0';
            $b->addedinround2 = '0';
            $b->addedinround3 = '0';
            $b->participetedround1 = '0';
            $b->participetedround3 = '0';
            $b->participetedround2 = '0';
            $b->winner = '0';
            $b->save();
        }
       return redirect()->route('eventcodinator.dashbord')->with('success', 'Successfully =reset');
    }

    public function teamdetail($event_id,$team_id)
    {
        // echo $event_id;
        // echo $team_id;
        $team = DB::table('participants')
        ->join('students', 'participants.enrollment_no', '=', 'students.stu_enrollment_no')
        ->select( 'students.*','participants.*')
        ->where('participants.team_id', $team_id)
        ->where('participants.event_id', $event_id)
        ->paginate(15);

        return view('eventcodinator.teamdetail',compact('team'));
    }

    // public function notification()
    // {
    //     $event_id = Auth::user()->event_id;
    //     // Participants::find($event_id)->notify(new ParticipantseventstartedNotification);

    //     $participants = Participants::all()
    //         ->where('event_id', $event_id)
    //         ->where('leader', '1');

    //     if(is_null($participants))
    //     {
    //         echo "null";
    //     }
    //     else
    //     {
    //         Notification::send($participants, new ParticipantseventstartedNotification());

    //     return redirect()->route('eventcodinator.dashbord')->with('success', 'Successfully Notification Sended');
    //     }
    // }

    // public function notificationforround2()
    // {
    //     $event_id = Auth::user()->event_id;
    //     $participants = Participants::all()
    //         ->where('event_id', $event_id)
    //         ->where('addedinround2', '1');

    //     if(is_null($participants))
    //     {
    //         echo "null";
    //     }
    //     else
    //     {
    //         Notification::send($participants, new Participantseventstartedforround2Notification());

    //     return redirect()->route('eventcodinator.round2.index')->with('success', 'Successfully Notification Seded');
    //     }
    // }

    // public function notificationforround3()
    // {
    //     $event_id = Auth::user()->event_id;
    //     $participants = Participants::all()
    //         ->where('event_id', $event_id)
    //         ->where('addedinround3', '1');

    //     if(is_null($participants))
    //     {
    //         echo "null";
    //     }
    //     else
    //     {
    //         Notification::send($participants, new Participantseventstartedforround3Notification());

    //     return redirect()->route('eventcodinator.round3.index')->with('success', 'Successfully Notification Seded');
    //     }
    // }
    public function score(Request $request)
    {
        $event_id = Auth::user()->event_id;
        $s = $request->input('ss');

        $participants = DB::table('participants')
            ->join('events', 'participants.event_id', '=', 'events.id')
            ->join('students', 'participants.enrollment_no', '=', 'students.stu_enrollment_no')
            ->select('events.*', 'students.*','participants.*')

            ->where('events.id', '=', $event_id)
            ->where('participants.register', '=', '1')
            ->where('participants.leader', '=', '1')
            ->where(function($query) use ($s){
                $query->orwhere('students.stu_name', 'LIKE', '%'.$s.'%');
                $query->orWhere('students.stu_enrollment_no', 'LIKE', '%'.$s.'%');
            })
            ->paginate(15);

        return view('eventcodinator/score', compact('participants', 's'));
    }
    public function update(Request $request,$id)
    {
        $round1score = $request->input('round1score');
        $round2score = $request->input('round2score');
        $round3score = $request->input('round3score');
        $addedinround2 = $request->input('addedinround2');
        $addedinround3 = $request->input('addedinround3');
        if($addedinround2 == 'on')
            echo 'yes';
        else
            echo 'no';

        $participants = Participants::find($id);
        if($round1score != null)
            $participants->round1score  = $round1score;
        else
            $participants->round1score  = '0';
        if($round2score != null)
            $participants->round2score  = $round2score;
        else
            $participants->round2score  = '0';
        if($round3score != null)
            $participants->round3score  = $round3score;
        else
            $participants->round3score  = '0';
        if($addedinround2 == 'on')
            $participants->addedinround2  = '1';
        else
            $participants->addedinround2  = '0';
        if($addedinround3 == 'on')
            $participants->addedinround3  = '1';
        else
            $participants->addedinround3  = '0';

        $participants->save();

        return redirect()->route('eventcodinator.score')->with('success', 'Successfully updated');
    }
}
