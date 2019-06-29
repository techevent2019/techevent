<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Student;
use App\Event;
use App\Collegeadmin;
use App\Participants;
use App\Team;
use Auth;
use DB;
use Session;
use App\Notifications\Student\conformNotification;
use Notification;
use PDF;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:student');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $ss = $request->input('ss');
        $events = Event::latest()
            ->search($ss)
            ->paginate(9);
        return view('student.index', compact('events', 'ss'));
    }

    public function events($id)
    {
        $stu_id = Auth::user()->id;
        $student = Student::find($stu_id);
        //echo $student->stu_enrollment_no;
        $event = Event::find($id);
        // $a = $event->event_start_date;
        // echo $a->format('d/m/Y');

        $ss = Auth::user()->id;
        $user = Student::find($ss);
        $u = DB::table('notifications')->where('notifiable_id',$ss)->get();
        foreach ($u as $uu) {
            
        $a = $uu->data;
        $data = json_decode($a,true);

        if( $data['event_id'] == $id)
            $n_id = $uu->id;
        }
        $user->unreadNotifications->where('id',$n_id)->markAsRead();

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

    // public function store(Request $request)
    // {
    //     $min = $request->input('min_member');
    //     $max = $request->input('max_member');
    //     $stu_enrollment_no = $request->input('stu_enrollment_no');
    //     $event_id = $request->input('event_id');
    //     $stu_enrollment = Auth::user()->stu_enrollment_no;

    //     $participant = new Participants();

    //         $a = DB::table('participants')
    //             ->where('event_id', '=', $event_id)
    //             ->where('enrollment_no', '=', $stu_enrollment_no)
    //             ->where('register', '=', '1')
    //             ->first();

    //     if($min == '1' and $max == '1')
    //     {
    //         if(!is_null($a))
    //         {
    //             //echo "no";
    //             //Session::flash('alert', 'You are all rady Register '); 
    //             return redirect()->route('student.event',$event_id)->with('alert', 'You are all rady Register ');
    //         }
            
    //         else
    //         {
    //             $participant->enrollment_no  = $request->input('stu_enrollment_no');
    //             $participant->event_id  = $request->input('event_id');
    //             $participant->email  = $request->input('email');
    //             $participant->register  = '1';
    //             $participant->leader  = '1';
    //             $participant->accept  = '1';
    //             $participant ->save();

    //             return redirect()->route('student.index')->with('success', 'Successfully participant in Event.');
    //         }        
    //     }

    //     else
    //     {
    //         $a = DB::table('participants')
    //             ->where('event_id', '=', $event_id)
    //             ->where('enrollment_no', '=', $stu_enrollment_no)
    //             ->where('register', '=', '1')
    //             ->first();
    //         $b = DB::table('participants')
    //             ->where('event_id', '=', $event_id)
    //             ->where('enrollment_no', '=', $stu_enrollment_no)
    //             ->where('leader', '=', '1')
    //             ->first();

    //         if(!is_null($a))
    //         {
    //             return redirect()->route('student.event',$event_id)->with('alert', 'You are all rady Register ');
    //         }
            
    //         elseif(is_null($b))
    //         {
                
    //             $participant->enrollment_no  = $request->input('stu_enrollment_no');
    //             $participant->event_id  = $request->input('event_id');
    //             $participant->email  = $request->input('email');
    //             $participant->team_id  = $request->input('stu_enrollment_no');
    //             $participant->leader  = '1';
    //             $participant->accept  = '1';
    //             $participant ->save();
                
    //             return redirect()->route('student.team',$event_id);
    //         }
    //         else
    //         {
    //             return redirect()->route('student.team',$event_id);
    //         }       
    //     }
        
    // }

    // public function storeforteam(Request $request)
    // {
    //     $event_id = $request->input('event_id');
    //     $id = $request->input('id');
    //     $stu_enrollment = Auth::user()->stu_enrollment_no;

    //     $a = DB::table('participants')
    //             ->where('event_id', '=', $event_id)
    //             ->where('enrollment_no', '=', $stu_enrollment)
    //             ->where('register', '=', '1')
    //             ->first();

    //     if(!is_null($a))
    //         {
    //             return redirect()->route('student.event',$event_id)->with('alert', 'You are all rady Register ');
    //         }
            
    //     else
    //     {
    //         $a = Participants::all()
    //             ->where('team_id', $stu_enrollment)
    //             ->where('event_id', $event_id)
    //             ->where('accept', '1');
    //         $n = sizeof($a);

    //         $b = DB::table('events')
    //             ->where('id', '=', $event_id)
    //             ->first();
    //         $max = $b->max_member;
    //         $min = $b->min_member;

    //         if($n < $min)
    //         {
    //             return redirect()->route('student.team',$event_id)->with('alert',"Minimam Team Member Required is $min");
    //         }
    //         elseif($n > $max)
    //         {
    //             return redirect()->route('student.team',$event_id)->with('alert',"Maximum Team Member Required is $max");
    //         }
    //         else
    //         {
    //             for($i=0 ; $i<$n ; $i++ ) {
    //                 $participant = Participants::find($id[$i]);
    //                 $participant->register  = '1';
    //                 $participant->save();
    //             }
    //             // $participant = new Participants();
    //             // $participant->enrollment_no  = $stu_enrollment;
    //             // $participant->event_id  = $event_id;
    //             // $participant ->save();

    //             return redirect()->route('student.index')->with('success', 'Successfully participant in Event.');
    //         }
    //     }       
    // }

    public function registerevent()
    {
        $enrollment_no = Auth::user()->stu_enrollment_no;
        $participant = DB::table('participants')
            ->join('events', 'participants.event_id', '=', 'events.id')
            ->join('students', 'participants.enrollment_no', '=', 'students.stu_enrollment_no')
            // ->join('teams', 'participants.enrollment_no', '=', 'teams.enrollment_no')
            ->select('participants.*', 'events.*','students.*')
            // ->where('teams.enrollment_no', $enrollment_no)
            ->where('participants.enrollment_no', $enrollment_no)
            ->where('participants.register', '1')
            ->paginate(15);

        return view('student.registerevents',compact('participant'));
    }

    public function team($id)
    {
        //$s = $request->input('s');
        $event_id = $id;
        $event = Event::where('id', $id)->get();
        // echo $event_id;
            $enrollment_no = Auth::user()->stu_enrollment_no;
            $team = DB::table('participants')
            ->join('events', 'participants.event_id', '=', 'events.id')
            ->join('students', 'participants.enrollment_no', '=', 'students.stu_enrollment_no')
            ->select('events.*', 'students.*','participants.*')
            ->where('participants.team_id', $enrollment_no)
            ->where('participants.event_id', $event_id)
            ->paginate(15);

        return view('student.team',compact('team','id','event'));
    }

    public function selectteammember(Request $request,$id)
    {
        // echo $id;
        $s = $request->input('s');

        $stu_col_code = Auth::user()->stu_col_code;
        $stu_department = Auth::user()->stu_department;
        $stu_sem = Auth::user()->stu_sem;
        $team = DB::table('students')
            ->where('stu_col_code', $stu_col_code)
            ->where('stu_department', $stu_department)
            ->where('stu_sem', $stu_sem)
            ->where(function($query) use ($s){
                $query->orWhere('stu_enrollment_no', 'LIKE', '%'.$s.'%');
            })
            ->paginate(15);

        return view('student.selectteammember',compact('team','s','id'));
    }

    public function storemember(Request $request,$id)
    {
        // echo $id;
        $member_name  = $request->input('stu_name');
        $member_enrollment  = $request->input('stu_enrollment_no');
        $email  = $request->input('email');
        //echo $member_name;
        //echo $member_enrollment;
        $stu_enrollment_no = Auth::user()->stu_enrollment_no;
        //echo $stu_enrollment_no;

        $a = DB::table('participants')
            ->where('team_id', $stu_enrollment_no)
            ->where('enrollment_no', $member_enrollment)
            ->where('event_id', $id)
            ->first();

        if(is_null($a))
        {
            //$team = new Team();
            $participant = new Participants();

            // $team->enrollment_no  = $member_enrollment;
            // $team->event_id  = $id;
            // $team->team_id  = $stu_enrollment_no;
            // $team ->save();
            $participant->enrollment_no  = $member_enrollment;
            $participant->event_id  = $id;
            $participant->team_id  = $stu_enrollment_no;
            $participant->email  = $email;
            $participant ->save();

            $p = Participants::all()
                ->where('enrollment_no', $member_enrollment)
                ->where('team_id', $stu_enrollment_no)
                ->where('event_id', $id)
                ->first();
            Notification::send($p, new conformNotification());

            return redirect()->route('student.team',$id)->with('success', 'Successfully Added Team Member.');
        }
        else
        {
            return redirect()->route('student.selectteammember',$id)->with('alert', 'Team Member Allrady Selected .');
        }
    }

    public function destroy($id,$event_id,$enrollment_no)
    {
        $stu_enrollment_no = Auth::user()->stu_enrollment_no;

        // $event_id = $request->input('event_id');
        // $enrollment_no = $request->input('enrollment_no');

        //echo $event_id;
        //echo $enrollment_no;

        $a = DB::table('participants')
            ->where('team_id', $enrollment_no)
            ->where('enrollment_no', $enrollment_no)
            ->where('leader', '1')
            ->first();

         if(!is_null($a))
         {
            return redirect()->route('student.team',$event_id)->with('alert', 'You can not Removed your self after all you are team leader.');
         }
         else
         {
            $team = Participants::find($id);
            $team->delete();
            return redirect()->route('student.team',$event_id)->with('success','Successfully Removed');
         }
    }

    public function teamdetail($id)
    {
        $enrollment_no = Auth::user()->stu_enrollment_no;
         $team = DB::table('participants')
            ->where('event_id', $id)
            ->where('enrollment_no', $enrollment_no)
            ->first();

        $team_id = $team->team_id;
            // $team_id = Auth::user()->stu_enrollment_no;
            $team = DB::table('participants')
            ->join('students', 'participants.enrollment_no', '=', 'students.stu_enrollment_no')
            ->select( 'students.*','participants.*')
            ->where('participants.team_id', $team_id)
            ->where('participants.event_id', $id)
            ->paginate(15);

            // echo $team->team_id;

        return view('student.teamdetail',compact('team'));
    }

    // public function accept($event_id,$team_id,$enrollment_no,$team_id)
    // {
    //     $leader_enrollment_no = Auth::user()->stu_enrollment_no;
    //     // echo $team_id;
    //     // echo $event_id;
        
    //     // echo $enrollment_no;
    //     $participant = Participants::where('team_id', $team_id)
    //         ->where('event_id', $event_id)
    //         ->where('enrollment_no', $enrollment_no)
    //         ->first();

    //     $participant->accept = '1';
    //     $participant->save();

    //     $participant = Participants::where('event_id', $event_id)
    //         ->where('enrollment_no', $leader_enrollment_no)
    //         ->where('register', '1')
    //         ->first();
    //     if(is_null($participant))
    //         return redirect()->route('accept');
    //     // echo "Your are now in team.";
    // else
    //     echo "sorry you are leate team member are all rady selected.";

    // }

    // public function score($event_id,$team_id)
    // {
    //     $score = Participants::where('event_id', $event_id)
    //         ->where('team_id', $team_id)
    //         ->where('register', '1')
    //         ->first();

    //     return view('student.score',compact('score'));

    // }

    public function score()
    {
        $stu_enrollment_no = Auth::user()->stu_enrollment_no;
        // $score = Participants::where('enrollment_no', $stu_enrollment_no)
        //     ->where('register', '1')
        //     ->paginate(15);

        $score = DB::table('participants')
        ->join('events', 'participants.event_id', '=', 'events.id')
        ->select('participants.*', 'events.*')
        ->where('participants.enrollment_no', $stu_enrollment_no)
        ->where('participants.register', '1')
        ->paginate(15);

        return view('student.score',compact('score'));
    }

    public function edit()
    {
        $stu_enrollment_no = Auth::user()->stu_enrollment_no;
        $students = Student::where('stu_enrollment_no', $stu_enrollment_no)
            ->first();
        return view('student.edit',compact('students'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'stu_name' => 'required|min:2|max:50',

            'email' => "required|email|unique:students,email,$id" ,

            'stu_con_no' => 'required|min:10|numeric',

            'stu_department' => 'required',

            'stu_gender' => 'required',

            'stu_sem' => 'required',
        ]);

        $students = Student::find($id);
        $students->stu_name  = $request->input('stu_name');
        $students->email  = $request->input('email');
        $students->stu_con_no  = $request->input('stu_con_no');
        $students->stu_department  = $request->input('stu_department');
        $students->stu_gender  = $request->input('stu_gender');
        $students->stu_sem  = $request->input('stu_sem');

        $students ->save();

        return redirect()->route('student.index')->with('success', 'Successfully student Updated.');        
    }

    public function winner(Request $request)
    {
        $col_code = Auth::user()->stu_col_code;
        $s = $request->input('ss');

        $participants = DB::table('participants')
            ->join('events', 'participants.event_id', '=', 'events.id')
            ->join('students', 'participants.enrollment_no', '=', 'students.stu_enrollment_no')
            ->select('events.*', 'students.*','participants.*')

            // ->where('events.col_cod', '=', $col_code)

            ->where('participants.winner', '!=', 'null')
            ->where(function($query) use ($s){
                $query->orwhere('events.event_name', 'LIKE', '%'.$s.'%');
                $query->orwhere('events.col_cod', 'LIKE', '%'.$s.'%');
                $query->orWhere('events.college_name', 'LIKE', '%'.$s.'%');
            })
            ->paginate(15);
        return view('student/winner', compact('participants', 's'));
    }

    public function cartificate($id)
    {
        $stu_name = Auth::user()->stu_name;
        $enrollment_no = Auth::user()->stu_enrollment_no;

        $event = Event::find($id);
        $col_code = $event->col_cod;

        $col = Collegeadmin::where('col_code', $col_code)->first();
        $ev_co = DB::table('eventcodinators')
                ->join('students', 'eventcodinators.ec_enrollment_no', '=', 'students.stu_enrollment_no')
                ->where('event_id', $id)
                ->first();

        $team = DB::table('participants')
            ->where('event_id', $id)
            ->where('enrollment_no', $enrollment_no)
            ->first();

        $team_id = $team->team_id;
        if($team_id != '0')
        {
            $data = DB::table('participants')
                ->join('events', 'participants.event_id', '=', 'events.id')
                ->join('students', 'participants.enrollment_no', '=', 'students.stu_enrollment_no')
                ->select('events.*', 'students.*','participants.*')
                ->where('events.id', $id)
                ->where('participants.enrollment_no', $team_id )
                ->where('participants.present', '1' )
                ->first();

            if(is_null($data))
            {
                // echo $data->team_id;
                return redirect()->route('student.registerevent')->with('alert', 'Your are not participant in This event');
            }
            else
            {    
                $pdf = PDF::loadView('student.cartificate', compact('data', 'col','ev_co'));
                return $pdf->setPaper('A4', 'landscape')->stream('cartificate.pdf');
            }
        }

        else
        {
            $data = DB::table('participants')
                ->join('events', 'participants.event_id', '=', 'events.id')
                ->join('students', 'participants.enrollment_no', '=', 'students.stu_enrollment_no')
                ->select('events.*', 'students.*','participants.*')
                ->where('events.id', $id)
                ->where('students.stu_name', $stu_name)
                ->where('participants.present', '1' )
                ->first();

            if(is_null($data))
            {
                // echo $data->team_id;
                return redirect()->route('student.registerevent')->with('alert', 'Your are not participant in This event');
            }
            else
            {    
                $pdf = PDF::loadView('student.cartificate', compact('data','col','ev_co'));
                return $pdf->setPaper('A4', 'landscape')
                ->stream('cartificate.pdf');
            }
        }
    }


}
