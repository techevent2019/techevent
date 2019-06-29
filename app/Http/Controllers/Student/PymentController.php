<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use App\Participants;
use App\Event;
use App\Payment;
use App\Student;

class PymentController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth:student');
    }

    public function createRequest($request)
    {
    	// echo $request['stu_enrollment_no'];
    	// echo $request['purpose'];

    	$enrollment_no = Auth::user()->stu_enrollment_no;
        $email = Auth::user()->email;
        $phone = Auth::user()->stu_con_no;
        $username = Auth::user()->stu_name;
    	$event_id = $request['event_id'];
    	
    	$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payment-requests/');
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
		curl_setopt($ch, CURLOPT_HTTPHEADER,
		            array("X-Api-Key:",
		                  "X-Auth-Token:"));
		$payload = Array(
		    'purpose' => $request['purpose'],
		    'amount' => $request['amount'],
		    'phone' => $phone,
		    'buyer_name' => $username,
		    'redirect_url' => 'http://www.techevent.com/student/redirect/'.$event_id,
		    'send_email' => true,
		    'webhook' => 'http://www.techevent.com/student/event/webhook/',
		    'send_sms' => false,
		    'email' => $email,
		    'allow_repeated_payments' => false
		);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
		$response = curl_exec($ch);
		curl_close($ch); 

		// echo $response;
		// // $all = $request->all();
		// $enrollment_no = $request->stu_enrollment_no;
		// $event_id = $request->event_id;
		
		$data = json_decode($response,true);
        $payment_id = redirect($data['payment_request']['longurl']);
		return redirect($data['payment_request']['longurl']);
        // return $payment_id;
        
    }

    public function redirect(Request $request, $event_id)
    {
        $e = Event::find($event_id);

        $min = $e->min_member;
        $max = $e->max_member;
        $amount = $e->evetn_price;
        $college_code = $e->col_cod;
    
    	$stu_enrollment = Auth::user()->stu_enrollment_no;
        $email = Auth::user()->email;

    	$pyment = new Payment();

    	$pyment->payment_id  = $request->payment_id;
    	$pyment->payment_status  = $request->payment_status;
    	$pyment->payment_request_id  = $request->payment_request_id;
    	$pyment->event_id  = $event_id;
    	$pyment->enrollment_no  = $stu_enrollment;
        $pyment->college_code  = $college_code;
        $pyment->amount  = $amount;
        $pyment ->save();

        // return $request->payment_id;

        if($min == '1' and $max == '1')
        {
            $participant = new Participants();
            $participant->enrollment_no  = $stu_enrollment;
            $participant->event_id  = $event_id;
            $participant->email  = $email;
            $participant->register  = '1';
            $participant->leader  = '1';
            $participant->accept  = '1';
            $participant ->save();
        }
        else
        {
            $participant = Participants::all()
                    ->where('event_id', $event_id)
                    ->where('team_id', $stu_enrollment )
                    ;
                if(sizeof($participant) > '1')
                {
                    foreach ($participant as $p) {
                        $pa = Participants::find($p->id);
                        $pa->register  = '1';
                        $pa->save();
                    }
                }        
        }             

        return redirect()->route('student.index')->with('success', 'Successfully participant in Event.');
    }



    public function store(Request $request)
    {
    	// echo $request->input('purpose');
    	// return $this->createRequest($request->all());

        $min = $request->input('min_member');
        $max = $request->input('max_member');
        $stu_enrollment_no = $request->input('stu_enrollment_no');
        $event_id = $request->input('event_id');
        $stu_enrollment = Auth::user()->stu_enrollment_no;

        $participant = new Participants();

            $a = DB::table('participants')
                ->where('event_id', '=', $event_id)
                ->where('enrollment_no', '=', $stu_enrollment_no)
                ->where('register', '=', '1')
                ->first();
            $p = DB::table('payments')
                ->where('event_id', '=', $event_id)
                ->where('enrollment_no', '=', $stu_enrollment_no)
                ->first();

        if($min == '1' and $max == '1')
        {
            if(!is_null($a) and !is_null($p))
            {
                //echo "no";
                //Session::flash('alert', 'You are all rady Register '); 
                return redirect()->route('student.event',$event_id)->with('alert', 'You are all rady Register ');
            }
            
            else
            {
                return $this->createRequest($request->all());
            }        
        }

        else
        {
            $a = DB::table('participants')
                ->where('event_id', '=', $event_id)
                ->where('enrollment_no', '=', $stu_enrollment_no)
                ->where('register', '=', '1')
                ->first();
            $b = DB::table('participants')
                ->where('event_id', '=', $event_id)
                ->where('enrollment_no', '=', $stu_enrollment_no)
                ->where('leader', '=', '1')
                ->first();

            if(!is_null($a))
            {
                return redirect()->route('student.event',$event_id)->with('alert', 'You are all rady Register ');
            }
            
            elseif(is_null($b))
            {
                
                $participant->enrollment_no  = $request->input('stu_enrollment_no');
                $participant->event_id  = $request->input('event_id');
                $participant->email  = $request->input('email');
                $participant->team_id  = $request->input('stu_enrollment_no');
                $participant->leader  = '1';
                $participant->accept  = '1';
                $participant ->save();

                $stu_id = Auth::user()->id;
                $student = Student::find($stu_id);
                //echo $student->stu_enrollment_no;
                $event = Event::find($event_id);
                
                return redirect()->route('student.team',$event_id);
            }
            else
            {
                return redirect()->route('student.team',$event_id);
            }       
        }
        
    }

    public function storeforteam(Request $request)
    {
        $event_id = $request->input('event_id');
        // $id = $request->input('id');
        $stu_enrollment = Auth::user()->stu_enrollment_no;

        $a = DB::table('participants')
                ->where('event_id', '=', $event_id)
                ->where('enrollment_no', '=', $stu_enrollment)
                ->where('register', '=', '1')
                ->first();

        if(!is_null($a))
            {
                return redirect()->route('student.event',$event_id)->with('alert', 'You are all rady Register ');
            }
            
        else
        {
            $a = Participants::all()
                ->where('team_id', $stu_enrollment)
                ->where('event_id', $event_id)
                ->where('accept', '1');
            $n = sizeof($a);

            $b = DB::table('events')
                ->where('id', '=', $event_id)
                ->first();
            $max = $b->max_member;
            $min = $b->min_member;

            if($n < $min)
            {
                return redirect()->route('student.team',$event_id)->with('alert',"Minimam Team Member Required is $min");
            }
            elseif($n > $max)
            {
                return redirect()->route('student.team',$event_id)->with('alert',"Maximum Team Member Required is $max");
            }
            else
            {
                return $this->createRequest($request->all());
            }
        }       
    }
}
