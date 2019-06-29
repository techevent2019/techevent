<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Participants;

class AcceptController extends Controller
{
    public function accept(Request $request)
    {
    	$team_id = $request->team_id;
    	$event_id = $request->event_id;
    	$enrollment_no = $request->enrollment_no;
    	$leader_enrollment_no = $request->team_id;

        // $leader_enrollment_no = Auth::user()->stu_enrollment_no;
        // echo $team_id;
        // echo $event_id;
        
        // echo $enrollment_no;
        $participant = Participants::where('team_id', $team_id)
            ->where('event_id', $event_id)
            ->where('enrollment_no', $enrollment_no)
            ->first();

        $participant->accept = '1';
        $participant->save();

        $participant = Participants::where('event_id', $event_id)
            ->where('enrollment_no', $leader_enrollment_no)
            ->where('register', '1')
            ->first();
        if(is_null($participant))
            return redirect()->route('accept');
        // echo "Your are now in team.";
    	else
    		return redirect()->route('acceptnot');
        // echo "sorry you are leate team member are all rady selected.";
    }
}
