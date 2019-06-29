<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Eventcodinator;
use App\Student;
use App\Event;
use Notification;
use App\Notifications\EventcodinatorpasswordNotification;
use App\Notifications\Eventcodinator\EvnetcangeforcodinatorNotification;
use DB;

class EventcodinatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $s = $request->input('ss');

        $eventcodinators = DB::table('eventcodinators')
            ->join('students', 'eventcodinators.ec_enrollment_no', '=', 'students.stu_enrollment_no')
            ->select('students.*', 'eventcodinators.*')
                ->where(function($query) use ($s){
                $query->orwhere('eventcodinators.event_name', 'LIKE', '%'.$s.'%');
                $query->orWhere('eventcodinators.event_id', 'LIKE',$s);
                $query->orWhere('eventcodinators.event_name', 'LIKE',$s);
                $query->orWhere('eventcodinators.ec_col_code', 'LIKE',$s);
                $query->orWhere('students.stu_enrollment_no', 'LIKE', $s.'%');
                $query->orWhere('students.stu_gender', 'LIKE',$s);
                $query->orWhere('students.stu_col_name', 'LIKE',$s);
                $query->orWhere('students.email', 'LIKE', '%'.$s.'%');
            })
            ->paginate(15);

        // $eventcodinators = Eventcodinator::latest()
        //     ->search($ss)
        //     ->paginate(10);
        return view('admin.eventcodinator.index', compact('eventcodinators', 's'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $event_id = $request->input('event_id');
        $event_name = $request->input('event_name');
        $ec_enrollment_no = $request->input('ec_enrollment_no');
        $id = $request->input('id');

        $a = DB::table('eventcodinators')
            ->where('event_id', '=', $event_id)
            ->where('event_name', '=', $event_name)
            ->where('ec_enrollment_no', '=', $ec_enrollment_no);
        if(is_null($a))
        {
            $event_name = $request['event_name'];
                $a = DB::table('events')
                ->where('event_name', '=', $event_name)
                ->first();
                $event_id = $a->id;
            $eventcodinators = Eventcodinator::create([
                'email' => $request['email'],
                'password' => $request['password'],
                'event_name' => $request['event_name'],
                'event_id' => $request['event_id'],
                'ec_enrollment_no' => $request['ec_enrollment_no'],
                'ec_col_code' => $request['ec_col_code'],
            ]);

            Notification::send($eventcodinators, new EventcodinatorpasswordNotification);

            $eventcodinators->password = Hash::make($request->password);
            $eventcodinators->save();

            return redirect()->route('admin.eventcodinator.index')->with('success', 'Successfully Added');
        }
        else
        {
            return redirect()->back()->with('danger', 'Event Codinator is All Rady Choosen');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     $students = Student::find($id);
    //     return view('admin.eventcodinator.add_new_eventcodinator',compact('students', 'id'));
    // }
    public function show1($id)
    {
        $arr['events'] = Event::all();
        $students = Student::find($id);
        return view('admin.eventcodinator.add_new_eventcodinator',compact('students', 'id'))->with($arr);
    }

    public function display(Request $request)
    {
        $ss = $request->input('ss');

        $students = Student::latest()
            ->search($ss)
            ->paginate(10);
        return view('admin.eventcodinator.display', compact('students', 'ss'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {
    //     $eventcodinators = Eventcodinator::find($id);
    //     return view('admin.eventcodinator.edit',compact('eventcodinators', 'id'));
    // }

    public function edit1($id)
    {
        $arr['events'] = Event::all();
        $eventcodinators = DB::table('eventcodinators')
            ->join('students', 'eventcodinators.ec_enrollment_no', '=', 'students.stu_enrollment_no')
            ->select('eventcodinators.*', 'students.*')
            ->where('eventcodinators.id', '=', $id)
            ->first();

        // $arr['events'] = Event::all();
        // $eventcodinators = Eventcodinator::find($id);
        return view('admin.eventcodinator.edit',compact('eventcodinators', 'id'))->with($arr);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {
    //     $eventcodinators = Eventcodinator::create([
    //         'ec_name' => $request['ec_name'],
    //         'email' => $request['email'],
    //         'event_name' => $request['event_name'],
    //         'event_id' => $request['event_id'],
    //         'ec_enrollment_no' => $request['ec_enrollment_no'],
    //         'ec_con_no' => $request['ec_con_no'],
    //         'col_code' => $request['col_code'],
    //         'ec_department' => $request['ec_department'],
    //         'ec_sem' => $request['ec_sem'],
    //         'ec_gender' => $request['ec_gender'],
    //     ]);
    //     $eventcodinators->save();
    //     return redirect()->route('admin.eventcodinator.index')->with('success', 'Successfully Updated');
    // }

    public function update1(Request $request, $id)
    {
        $b = DB::table('eventcodinators')
            ->where('event_name', '=', $request->input('event_name'))
            ->first();
        if(is_null($b))
        {
            $event_name = $request['event_name'];
            $a = DB::table('events')
                ->where('event_name', '=', $event_name)
                ->first();
            $event_id = $a->id;

            $eventcodinators = Eventcodinator::find($id);
            $eventcodinators->event_name  = $request->input('event_name');
            $eventcodinators->event_id  = $event_id;
            $eventcodinators->save();
             Notification::send($eventcodinators, new EvnetcangeforcodinatorNotification);
            return redirect()->route('admin.eventcodinator.index')->with('success', 'Successfully Updated');
        }
        else
        {
            return redirect()->back()->with('danger', 'Event Codinator is All Rady Choosen For This Event');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy1($id)
    {
        $eventcodinators = Eventcodinator::find($id);
        $eventcodinators->delete();

        return redirect()->route('admin.eventcodinator.index')->with('success','Event Codinator Delete');
    }

}
