<?php

namespace App\Http\Controllers\Eventcodinator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Eventcodinator;
use App\Participants;
use App\Collegeadmin;
use Auth;
use DB;

class Round3Controller extends Controller
{
    public function round3(Request $request)
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
            ->where('participants.present', '=' , '1')
            ->where('participants.participetedround3', '=' , '0')
            ->where('participants.addedinround3', '=' , '1')
            ->where(function($query) use ($s){
                $query->orwhere('students.stu_col_code', 'LIKE', '%'.$s.'%');
                $query->orWhere('students.stu_col_name', 'LIKE', '%'.$s.'%');
                $query->orWhere('students.stu_enrollment_no', 'LIKE', '%'.$s.'%');
                $query->orWhere('students.stu_gender', 'LIKE', '%'.$s.'%');
                $query->orWhere('students.email', 'LIKE', '%'.$s.'%');
            })
            // ->orderBy(function($query) use ($sort){
            //     if($sort == '1')
            //         $query->orderBy('round1score','desc');
            // }) //not working
            ->orderBy('present','desc')
            ->paginate(10);
        return view('eventcodinator.round3.index', compact('participants', 's', 'college'));
    }

    public function battle_3(Request $request)
    {
        $event_id = Auth::user()->event_id;
        $ec_col_code = Auth::user()->ec_col_code;
        $s = $request->input('ss');

        $college = Collegeadmin::all()
            ->where('col_code', '=' ,$ec_col_code);

        $competeforround3 = $request->input('competeforround3');

        if($competeforround3 == null)
            return redirect()->back()->with('alert', 'Plese choose atlist one participant');
        else
        {
            $participants = DB::table('participants')

                ->join('events', 'participants.event_id', '=', 'events.id')
                ->join('students', 'participants.enrollment_no', '=', 'students.stu_enrollment_no')
                ->select('events.*', 'students.*','participants.*')

                ->where('events.id', '=', $event_id)
                // ->where('participants.competeforround1', '=' , '1')
                // ->where('participants.participetedround1', '=' , '0')
                ->where(function($query) use ($s){
                    $query->orwhere('students.stu_col_code', 'LIKE', '%'.$s.'%');
                    $query->orWhere('students.stu_col_name', 'LIKE', '%'.$s.'%');
                    $query->orWhere('students.stu_enrollment_no', 'LIKE', '%'.$s.'%');
                    $query->orWhere('students.stu_gender', 'LIKE', '%'.$s.'%');
                    $query->orWhere('students.email', 'LIKE', '%'.$s.'%');
                })

                ->where(function($query) use ($competeforround3){
                    foreach ($competeforround3 as $c) {
                    $query->orwhere('participants.id',$c);
                    }
                })

                // ->orderBy(function($query) use ($sort){
                //     if($sort == '1')
                //         $query->orderBy('round1score','desc');
                // }) //not working
                ->orderBy('present','desc')
                ->paginate(10);
            return view('eventcodinator.round3.battleround3', compact('participants', 's', 'college'));
        }
    }

    public function round3score(Request $request)
    {
        $round3score = $request->input('round3score');
        $id = $request->input('id');
        $n = sizeof($round3score);

        if(!is_null($round3score))
        {
            for ($i=0; $i < $n; $i++)
            {
                // echo $round1score[$i];
                // echo $id[$i];
                if(is_null($round3score[$i]))
                    $round3score[$i] = '0';
            
                $score = Participants::find($id[$i]);
                $score->round3score  = $round3score[$i];
                $score->participetedround3  = '1';
                $score->save();
            }
            
            return redirect()->route('eventcodinator.round3.index')->with('success', 'Successfully Score Added');
        }
    }

    

    public function choosewinner(Request $request)
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
            ->where('participants.present', '=' , '1')
            ->where('participants.participetedround3', '=' , '1')
            ->orderBy('round3score','desc')
            ->where(function($query) use ($s){
                $query->orwhere('students.stu_col_code', 'LIKE', '%'.$s.'%');
                $query->orWhere('students.stu_col_name', 'LIKE', '%'.$s.'%');
                $query->orWhere('students.stu_enrollment_no', 'LIKE', '%'.$s.'%');
                $query->orWhere('students.stu_gender', 'LIKE', '%'.$s.'%');
                $query->orWhere('students.email', 'LIKE', '%'.$s.'%');
            })
            
            ->paginate(10);
        return view('eventcodinator.round3.choosewinner', compact('participants', 's', 'college'));
    }

    public function winner(Request $request)
    {
        $winner = $request->input('winner');
        $id = $request->input('id');

        $a = sizeof($id);

        if(!is_null($id))
        {
            for ($i=0; $i < $a ; $i++) 
            {
                // echo 'id'.$id[$i].'/';
                // echo $winner[$i].'//';
                $aa = Participants::find($id[$i]);
                $aa->winner  = $winner[$i];
                $aa->save();
            }
        }
        return redirect()->route('eventcodinator.round3.index')->with('success', 'Successfully Added Winner');
    }
}
