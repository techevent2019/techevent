<?php

namespace App\Http\Controllers\Eventcodinator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\Eventcodinator\ParticipantseventstartedNotification;
use App\Notifications\Eventcodinator\Participantseventstartedforround2Notification;
use App\Notifications\Eventcodinator\Participantseventstartedforround3Notification;
use App\Notifications\Eventcodinator\Participantsselectedforround2Notification;
use App\Notifications\Eventcodinator\Participantsselectedforround3Notification;
use Auth;
use DB;
use Notification;
use App\Eventcodinator;
use App\Participants;
use App\Collegeadmin;

class notificationController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth:eventcodinator');
    }

    public function notification()
    {
        $event_id = Auth::user()->event_id;
        // Participants::find($event_id)->notify(new ParticipantseventstartedNotification);

        $participants = Participants::all()
            ->where('event_id', $event_id)
            ->where('leader', '1');

        if(sizeof($participants)=='0')
        {
            return redirect()->route('eventcodinator.dashbord')->with('alert', 'No participants Found');
        }
        else
        {
            Notification::send($participants, new ParticipantseventstartedNotification());

        return redirect()->route('eventcodinator.dashbord')->with('success', 'Successfully Notification Sended');
        }
    }

    public function notificationforround2()
    {
        $event_id = Auth::user()->event_id;
        $participants = Participants::all()
            ->where('event_id', $event_id)
            ->where('addedinround2', '1');

        if(sizeof($participants)=='0')
        {
            return redirect()->route('eventcodinator.round2.index')->with('alert', 'No participants Found');
        }
        else
        {
            Notification::send($participants, new Participantseventstartedforround2Notification());

        return redirect()->route('eventcodinator.round2.index')->with('success', 'Successfully Notification Seded');
        }
    }

    public function notificationforround3()
    {
        $event_id = Auth::user()->event_id;
        $participants = Participants::all()
            ->where('event_id', $event_id)
            ->where('addedinround3', '1');

        if(sizeof($participants)=='0')
        {
            return redirect()->route('eventcodinator.round3.index')->with('alert', 'No participants Found');
        }
        else
        {
            Notification::send($participants, new Participantseventstartedforround3Notification());

        return redirect()->route('eventcodinator.round3.index')->with('success', 'Successfully Notification Seded');
        }
    }

    public function notificationforselectedinround2()
    {
        $event_id = Auth::user()->event_id;
        $participants = Participants::all()
            ->where('event_id', $event_id)
            ->where('addedinround2', '1');

        if(sizeof($participants)=='0')
        {
            return redirect()->route('eventcodinator.round2.index')->with('alert', 'No participants Found');
        }
        else
        {
            Notification::send($participants, new Participantsselectedforround2Notification());

        return redirect()->route('eventcodinator.round2.index')->with('success', 'Successfully Notification Seded');
        }
    }

    public function notificationforselectedinround3()
    {
        $event_id = Auth::user()->event_id;
        $participants = Participants::all()
            ->where('event_id', $event_id)
            ->where('addedinround3', '1');

        if(sizeof($participants)=='0')
        {
            return redirect()->route('eventcodinator.round3.index')->with('alert', 'No participants Found');
        }
        else
        {
            Notification::send($participants, new Participantsselectedforround3Notification());

        return redirect()->route('eventcodinator.round2.index')->with('success', 'Successfully Notification Seded');
        }
    }
}
