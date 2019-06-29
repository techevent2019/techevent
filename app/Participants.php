<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\Student\conformNotification;

class Participants extends Model
{

    use Notifiable;

    protected $fillable = [
        'event_id', 'enrollment_no', 'present', 'round1score', 'round2score', 'round3score', 'addedinround2', 'addedinround3', 'participetedround1' ,'participetedround3', 'participetedround2','winner','team_id','register','leader','email',
    ];

    // public function scopeSearch($query, $s)
    // {
    //     return $query->where('event_name', 'LIKE', '%' .$s. '%')
    //         ->orWhere('par_col_code', 'LIKE',$s)
    //         ->orWhere('par_col_name', 'LIKE', '%' .$s. '%')
    //         ->orWhere('event_col_code', 'LIKE',$s)
    //         ->orWhere('event_col_name', 'LIKE', '%' .$s. '%')
    //         ->orWhere('evetn_price', 'LIKE', '%' .$s. '%')
    //         ->orWhere('department', 'LIKE', $s)
    //         ->orWhere('gender', 'LIKE', $s);      
    // }

    // public function scopeSearchforcollegeadmin($query, $s)
    // {
    //     return $query->where('event_name', 'LIKE', '%' .$s. '%')
    //         ->orWhere('par_col_code', 'LIKE',$s)
    //         ->orWhere('par_col_name', 'LIKE', '%' .$s. '%')
    //         ->orWhere('evetn_price', 'LIKE', '%' .$s. '%')
    //         ->orWhere('department', 'LIKE', $s)
    //         ->orWhere('enrollment_no', 'LIKE', $s)
    //         ->orWhere('gender', 'LIKE', $s);      
    // }
}
