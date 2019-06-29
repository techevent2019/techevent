<?php

namespace App\Http\Controllers\Eventcodinator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Eventcodinator;
use App\Participants;
use App\Collegeadmin;
use Auth;
use DB;

class Round1Controller extends Controller
{
    public function round1(Request $request)
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
            ->where('participants.participetedround1', '=' , '0')
            //->where('participants.participetedround1', '=' , '0')
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
        return view('eventcodinator.round1.index', compact('participants', 's', 'college'));
    }

    public function round1score(Request $request)
    {
        // $present = Participants::all();
        //     foreach ($present as $b) {
        //         if($b->participetedround1 == '0')
        //         {
        //             $b->competeforround1 = '0';
        //             $b->save();
        //         }   
        //     }
        $round1score = $request->input('round1score');
        $id = $request->input('id');
        $n = sizeof($round1score);

        if(!is_null($round1score))
        {
            for ($i=0; $i < $n; $i++)
            {
                // echo $round1score[$i];
                // echo $id[$i];
                if(is_null($round1score[$i]))
                    $round1score[$i] = '0';
            
                $score = Participants::find($id[$i]);
                $score->round1score  = $round1score[$i];
                $score->participetedround1  = '1';
                $score->save();
            }
            
            return redirect()->back()->with('success', 'Successfully Score Added');
        }
    }

    // public function competeforround1(Request $request)
    // {
    //     $present = Participants::all();
    //     $competeforround1 = $request->input('competeforround1');
    //     // foreach ($present as $b) {
    //     //     $b->competeforround1 = '0';
    //     //     $b->save();
    //     // }
    //     if(!is_null($competeforround1))
    //     {
    //         foreach ($competeforround1 as $c) {
    //         $present = Participants::find($c);
    //         $present->competeforround1  = '1';
    //         // $present->participetedround1  = '1';
    //         $present->save();
    //         }
    //     }
    //    return redirect()->route('eventcodinator.battle_1');
    // }

    public function battle_1(Request $request)
    {
        $event_id = Auth::user()->event_id;
        $ec_col_code = Auth::user()->ec_col_code;
        $s = $request->input('ss');

        $college = Collegeadmin::all()
            ->where('col_code', '=' ,$ec_col_code);

        $competeforround1 = $request->input('competeforround1');

        if($competeforround1 == null)
            return redirect()->back()->with('alert', 'Plese choose atlist one participant');
        else
        {
            $participants = DB::table('participants')

                ->join('events', 'participants.event_id', '=', 'events.id')
                ->join('students', 'participants.enrollment_no', '=', 'students.stu_enrollment_no')
                ->select('events.*', 'students.*','participants.*')

                ->where('events.id', '=', $event_id)
                ->orderBy('round1score','desc')
                // ->where('participants.competeforround1', '=' , '1')
                // ->where('participants.participetedround1', '=' , '0')
                ->where(function($query) use ($s){
                    $query->orwhere('students.stu_col_code', 'LIKE', '%'.$s.'%');
                    $query->orWhere('students.stu_col_name', 'LIKE', '%'.$s.'%');
                    $query->orWhere('students.stu_enrollment_no', 'LIKE', '%'.$s.'%');
                    $query->orWhere('students.stu_gender', 'LIKE', '%'.$s.'%');
                    $query->orWhere('students.email', 'LIKE', '%'.$s.'%');
                })

                ->where(function($query) use ($competeforround1){
                    foreach ($competeforround1 as $c) {
                    $query->orwhere('participants.id',$c);
                    }
                })

                // ->orderBy(function($query) use ($sort){
                //     if($sort == '1')
                //         $query->orderBy('round1score','desc');
                // }) //not working
                ->orderBy('present','desc')
                ->paginate(10);
            return view('eventcodinator.round1.battleround1', compact('participants', 's', 'college'));
        }
    }

    public function addinround2(Request $request)
    {
        $id = $request->input('id');

        if(!is_null($id))
        {
            foreach ($id as $a) 
            {
                //echo $a;
                $aa = Participants::find($a);
                $aa->participetedround1  = '1';
                $aa->save();
            }
        }

        $idforen = $request->input('enrollment_no');
        $participants = Participants::find($idforen);
        $participants->addedinround2  = '1';
        $participants->save();
        return redirect()->route('eventcodinator.round1.index')->with('success', 'Successfully Added in round 2');
    }

    public function addround2(Request $request)
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
            ->where('participants.participetedround1', '=' , '1')
            ->orderBy('round1score','desc')
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
        return view('eventcodinator.round1.addround2', compact('participants', 's', 'college'));
    }
}
