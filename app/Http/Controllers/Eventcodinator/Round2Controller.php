<?php

namespace App\Http\Controllers\Eventcodinator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Eventcodinator;
use App\Participants;
use App\Collegeadmin;
use Auth;
use DB;

class Round2Controller extends Controller
{
    public function round2(Request $request)
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
            ->where('participants.participetedround2', '=' , '0')
            ->where('participants.addedinround2', '=' , '1')
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
        return view('eventcodinator.round2.index', compact('participants', 's', 'college'));
    }

    public function battle_2(Request $request)
    {
        $event_id = Auth::user()->event_id;
        $ec_col_code = Auth::user()->ec_col_code;
        $s = $request->input('ss');

        $college = Collegeadmin::all()
            ->where('col_code', '=' ,$ec_col_code);

        $competeforround2 = $request->input('competeforround2');

        if($competeforround2 == null)
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

            ->where(function($query) use ($competeforround2){
                foreach ($competeforround2 as $c) {
                $query->orwhere('participants.id',$c);
                }
            })

            // ->orderBy(function($query) use ($sort){
            //     if($sort == '1')
            //         $query->orderBy('round1score','desc');
            // }) //not working
            ->orderBy('present','desc')
            ->paginate(10);
            return view('eventcodinator.round2.battleround2', compact('participants', 's', 'college'));
        }
    }

    public function round2score(Request $request)
    {
        $round2score = $request->input('round2score');
        $id = $request->input('id');
        $n = sizeof($round2score);

        if(!is_null($round2score))
        {
            for ($i=0; $i < $n; $i++)
            {
                // echo $round1score[$i];
                // echo $id[$i];
                if(is_null($round2score[$i]))
                    $round2score[$i] = '0';
            
                $score = Participants::find($id[$i]);
                $score->round2score  = $round2score[$i];
                $score->participetedround2  = '1';
                $score->save();
            }
            
            return redirect()->back()->with('success', 'Successfully Score Added');
        }
    }

    public function addinround3(Request $request)
    {
        $id = $request->input('id');

        if(!is_null($id))
        {
            foreach ($id as $a) 
            {
                //echo $a;
                $aa = Participants::find($a);
                $aa->participetedround2  = '1';
                $aa->save();
            }
        }

        $idforen = $request->input('enrollment_no');
        $participants = Participants::find($idforen);
        $participants->addedinround3  = '1';
        $participants->save();
        return redirect()->route('eventcodinator.round2.index')->with('success', 'Successfully Added in round 3');
    }

    public function addround3(Request $request)
    {
        $event_id = Auth::user()->event_id;
        $ec_col_code = Auth::user()->ec_col_code;
        $s = $request->input('ss');
        //$sort = $request->input('sort');

        $college = Collegeadmin::all()
            ->where('col_code', '=' ,$ec_col_code);

            // $sort = DB::table('participants')
            //     ->orderBy('round1score','desc')
            //     ->get();

        $participants = DB::table('participants')

            ->join('events', 'participants.event_id', '=', 'events.id')
            ->join('students', 'participants.enrollment_no', '=', 'students.stu_enrollment_no')
            ->select('events.*', 'students.*','participants.*')

            ->where('events.id', '=', $event_id)
            ->where('participants.present', '=' , '1')
            ->where('participants.participetedround2', '=' , '1')
            ->orderBy('round2score','desc')
            ->where(function($query) use ($s){
                $query->orwhere('students.stu_col_code', 'LIKE', '%'.$s.'%');
                $query->orWhere('students.stu_col_name', 'LIKE', '%'.$s.'%');
                $query->orWhere('students.stu_enrollment_no', 'LIKE', '%'.$s.'%');
                $query->orWhere('students.stu_gender', 'LIKE', '%'.$s.'%');
                $query->orWhere('students.email', 'LIKE', '%'.$s.'%');
            })
            ->paginate(10);
        return view('eventcodinator.round2.addround3', compact('participants', 's', 'college'));
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
            ->where('participants.participetedround2', '=' , '1')
            ->orderBy('round3score','desc')
            ->where(function($query) use ($s){
                $query->orwhere('students.stu_col_code', 'LIKE', '%'.$s.'%');
                $query->orWhere('students.stu_col_name', 'LIKE', '%'.$s.'%');
                $query->orWhere('students.stu_enrollment_no', 'LIKE', '%'.$s.'%');
                $query->orWhere('students.stu_gender', 'LIKE', '%'.$s.'%');
                $query->orWhere('students.email', 'LIKE', '%'.$s.'%');
            })
            
            ->paginate(10);
        return view('eventcodinator.round2.choosewinner', compact('participants', 's', 'college'));
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
        return redirect()->route('eventcodinator.round2.index')->with('success', 'Successfully Added Winner');
    }
}
