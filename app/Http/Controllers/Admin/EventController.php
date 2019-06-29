<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Calendar;
use App\Event;
use App\Participants;
use DB;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::all();
        $event = [];
        
            foreach ($events as $row) {
                //$enddate = $row->end_date."24:00:00";
                $event[] = \Calendar::event(
                    $row->event_name,
                    true,
                    new \DateTime($row->event_start_date),
                    new \DateTime($row->event_end_date),
                    
                    $row->id,
                    // Add color and link on event
                    [
                        'color' => '#f05050',
                        'url' => (route('admin.event.eventditail',$row->id)),
                    ]
                );
            }
        
        $calendar = \Calendar::addEvents($event);
        return view('admin.event.index', compact('events','calendar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.event.addevent');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $event_start_date  = $request->input("event_start_date");
        $event_last_registration_date  = $request->input("event_last_registration_date");
        $min_member  = $request->input("min_member");
        $max_member  = $request->input("max_member");
        // if($event_start_date>= $event_last_registration_date)
        // {
        //     $min_member  = $request->input("min_member");
        //     $max_member  = $request->input("max_member");
        //     if($max_member>= $min_member)
        //     {
                $this->validate($request,[
                    'event_name' => 'required',
                    'event_start_date' => 'required|after:today',
                    'event_end_date' => 'required|after_or_equal:event_start_date',
                    'event_start_time' => 'required',
                    'event_end_time' => 'required|after:event_start_time',
                    'event_last_registration_date' => 'required|before_or_equal:event_start_date',
                    'event_place' => 'required',
                    'col_cod' => 'required|numeric',
                    //'e_c_id' => 'required|numeric',
                    'department' => 'required',
                    'description' => 'required',
                    'team_specification' => 'required',
                    'general_rules' => 'required',
                    'judging_criteria' => 'required',
                    'level_description' => 'required',
                    'college_name' => 'required',
                    'college_address' => 'required',
                    'evetn_price' => 'required',
                    'city' => 'required',
                    'techfest_name' => 'required',
                    'level' => 'required',
                'min_member' => 'required|between:1,'.$max_member,
                'max_member' => 'required|min:'.$min_member,
                ]);
            // }
        //     else
        //     {
        //         return redirect()->back()->with('max_member', 'max value is not lass then min value');
        //     }
        // }
        // else
        // {
        //     return redirect()->back()->with('event_last_registration_date', 'Last Registraton date is not after event');
        // }


        $events = new Event();

        if($request->image->getClientOriginalName())
        {
            $ext = $request->image->getClientOriginalExtension();
            $file = date('YmdHis').rand(1,999999).'.'.$ext;
            $request->image->storeAs('public/events',$file);
        }
        else
        {
            $file = '';
        }

        $events->event_name  = $request->input("event_name");
        $events->event_start_date = $request->input("event_start_date");
        $events->event_end_date = $request->input("event_end_date");
        $events->event_start_time  = $request->input("event_start_time");
        $events->event_end_time  = $request->input("event_end_time");
        $events->event_place  = $request->input("event_place");
        $events->col_cod  = $request->input("col_cod");
        $events->department  = $request->input("department");
        $events->event_last_registration_date  = $request->input("event_last_registration_date");
        //$events->e_c_id  = $request->input("e_c_id");
        $events->image = $file;
        $events->description = $request->input("description");
        $events->team_specification = $request->input("team_specification");
        $events->general_rules = $request->input("general_rules");
        $events->judging_criteria = $request->input("judging_criteria");
        $events->level_description = $request->input("level_description");
        $events->college_name = $request->input("college_name");
        $events->college_address = $request->input("college_address");
        $events->evetn_price = $request->input("evetn_price");
        $events->city = $request->input("city");
        $events->min_member = $request->input("min_member");
        $events->max_member = $request->input("max_member");
        $events->techfest_name = $request->input("techfest_name");
        $events->level = $request->input("level");

        $events ->save();

        return redirect()->route('admin.event.index')->with('success', 'event Added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $ss = $request->input('ss');

        $events = Event::latest()
            ->search($ss)
            ->paginate(10);
        return view('admin.event.display', compact('events', 'ss'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {
    //     return ('helwe');
    //     // $events = Event::find($id);
    //     // return view('event.editform',compact('events', 'id'));
    // }
    public function edit1($id)
    {
        // return ('helwe');
        $events = Event::find($id);
        return view('admin.event.editform',compact('events', 'id'));
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
    //     $this->validate($request,[
    //         'event_name' => 'required',
    //         'event_start_date' => 'required',
    //         'event_end_date' => 'required',
    //         'event_start_time' => 'required',
    //         'event_end_time' => 'required',
    //         'event_place' => 'required',
    //         'col_cod' => 'required',
    //         'hod_id' => 'required',
    //         'e_c_id' => 'required',
    //     ]);

    //     $events = Event::find($id);

    //     $events->event_name  = $request->input("event_name");
    //     $events->event_start_date = $request->input("event_start_date");
    //     $events->event_end_date = $request->input("event_end_date");
    //     $events->event_start_time  = $request->input("event_start_time");
    //     $events->event_end_time  = $request->input("event_end_time");
    //     $events->event_place  = $request->input("event_place");
    //     $events->col_cod  = $request->input("col_cod");
    //     $events->hod_id  = $request->input("hod_id");
    //     $events->e_c_id  = $request->input("e_c_id");

    //     $events ->save();

    //     return redirect('event')->with('success', 'event Updated.');
    // }
    public function update1(Request $request, $id)
    {
        $min_member  = $request->input("min_member");
        $max_member  = $request->input("max_member");
        $min_member  = $request->input("min_member");
        $max_member  = $request->input("max_member");
        // if($max_member>= $min_member)
        // {
            $this->validate($request,[
                'event_name' => 'required',
                    'event_start_date' => 'required|after:today',
                    'event_end_date' => 'required|after_or_equal:event_start_date',
                    'event_start_time' => 'required',
                    'event_end_time' => 'required|after:event_start_time',
                    'event_last_registration_date' => 'required|before_or_equal:event_start_date',
                    'event_place' => 'required',
                    'col_cod' => 'required|numeric',
                    //'e_c_id' => 'required|numeric',
                    'department' => 'required',
                    'description' => 'required',
                    'team_specification' => 'required',
                    'general_rules' => 'required',
                    'judging_criteria' => 'required',
                    'level_description' => 'required',
                    'college_name' => 'required',
                    'college_address' => 'required',
                    'evetn_price' => 'required',
                    'city' => 'required',
                    'techfest_name' => 'required',
                    'level' => 'required',
                'min_member' => 'required|between:1,'.$max_member,
                'max_member' => 'required|min:'.$min_member,
            ]);
        // }
        // else
        // {
        //     return redirect()->back()->with('max_member', 'max value is not lass then min value');
        // }

        $events = Event::find($id);

        if(isset($request->image) && $request->image->getClientOriginalName())
        {
            $ext = $request->image->getClientOriginalExtension();
            $file = date('YmdHis').rand(1,999999).'.'.$ext;
            $request->image->storeAs('public/events',$file);
        }
        else
        {
            if(!$events->image)
                $file = '';
            else
                $file = $events->image;
        }

        $events->event_name  = $request->input("event_name");
        $events->event_start_date = $request->input("event_start_date");
        $events->event_end_date = $request->input("event_end_date");
        $events->event_start_time  = $request->input("event_start_time");
        $events->event_end_time  = $request->input("event_end_time");
        $events->event_place  = $request->input("event_place");
        $events->col_cod  = $request->input("col_cod");
        $events->department  = $request->input("department");
        $events->event_last_registration_date  = $request->input("event_last_registration_date");
        //$events->e_c_id  = $request->input("e_c_id");
        $events->image = $file;
        $events->description = $request->input("description");
        $events->team_specification = $request->input("team_specification");
        $events->general_rules = $request->input("general_rules");
        $events->judging_criteria = $request->input("judging_criteria");
        $events->level_description = $request->input("level_description");
        $events->college_name = $request->input("college_name");
        $events->college_address = $request->input("college_address");
        $events->evetn_price = $request->input("evetn_price");
        $events->city = $request->input("city");
        $events->min_member = $request->input("min_member");
        $events->max_member = $request->input("max_member");
        $events->techfest_name = $request->input("techfest_name");
        $events->level = $request->input("level");

        $events ->save();

        return redirect()->route('admin.event.index')->with('success', 'event Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     $events = Event::find($id);
    //     $events->delete();

    //     return redirect('event')->with('success','Event Delete');
    // }
    public function destroy1($id)
    {
        $events = Event::find($id);
        $events->delete();

        return redirect()->route('admin.event.index')->with('success','Event Delete');
    }

    public function participants(Request $request)
    {
        $s = $request->input('ss');

        $participants = DB::table('participants')
            ->join('events', 'participants.event_id', '=', 'events.id')
            ->join('students', 'participants.enrollment_no', '=', 'students.stu_enrollment_no')
            ->select('events.*', 'students.*','participants.*')
            ->where('participants.leader', '=', '1')

            ->where(function($query) use ($s){
                $query->orwhere('students.stu_col_code', 'LIKE', $s);
                $query->orWhere('students.stu_col_name', 'LIKE', '%'.$s.'%');
                $query->orWhere('students.stu_department', 'LIKE', '%'.$s.'%');
                $query->orWhere('students.stu_gender', 'LIKE', '%'.$s.'%');
                $query->orWhere('students.stu_enrollment_no', 'LIKE',$s);
                $query->orWhere('students.stu_name', 'LIKE', '%' .$s. '%');
                $query->orwhere('events.event_name', 'LIKE', '%' .$s. '%');
                $query->orWhere('events.col_cod', 'LIKE',$s);
                $query->orWhere('events.college_name', 'LIKE', '%' .$s. '%');
                $query->orWhere('events.evetn_price', 'LIKE', '%' .$s. '%');
            })
            ->paginate(15);

        return view('admin.event.participants', compact('participants', 's'));
    }

    public function eventditail($id)
    {
        $event = Event::find($id);
        return view('admin.event.eventditail',compact('event'));
    }

    public function winner(Request $request)
    {
        $s = $request->input('ss');

        $participants = DB::table('participants')
            ->join('events', 'participants.event_id', '=', 'events.id')
            ->join('students', 'participants.enrollment_no', '=', 'students.stu_enrollment_no')
            ->select('events.*', 'students.*','participants.*')

            ->where('participants.winner', '!=', 'null')
            ->where(function($query) use ($s){
                $query->orwhere('students.stu_col_code', 'LIKE', '%'.$s.'%');
                $query->orWhere('students.stu_col_name', 'LIKE', '%'.$s.'%');
                $query->orWhere('students.stu_enrollment_no', 'LIKE', '%'.$s.'%');
                $query->orWhere('students.stu_gender', 'LIKE',$s);
                $query->orWhere('students.email', 'LIKE', '%'.$s.'%');
                $query->orwhere('events.event_name', 'LIKE', '%'.$s.'%');
            })
            ->paginate(15);
        return view('admin/event/winner', compact('participants', 's'));
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

        return view('admin.event.teamdetail',compact('team'));
    }
}
