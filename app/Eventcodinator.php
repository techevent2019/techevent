<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\EventcodinatorResetPasswordNotification;

class Eventcodinator extends Authenticatable
{
    use Notifiable;

    protected $guard = 'eventcodinator';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'email', 'password', 'event_name', 'event_id', 'ec_enrollment_no', 'ec_col_code',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new EventcodinatorResetPasswordNotification($token));
    }

    public function event()
    {
        return $this->belongsTo('App\Event');
    }

    public function scopeSearch($query, $s)
    {
        return $query->where('event_name', 'LIKE', '%' .$s. '%')
            ->orWhere('event_id', 'LIKE', $s)
            ->orWhere('ec_col_code', 'LIKE', $s)
            // ->orWhere('ec_name', 'LIKE', '%' .$s. '%')
            // ->orWhere('ec_enrollment_no', 'LIKE', $s)
            // ->orWhere('ec_department', 'LIKE', '%' .$s. '%')
            // ->orWhere('ec_gender', 'LIKE',$s)
            // ->orWhere('ec_sem', 'LIKE', '%' .$s. '%')
            ;    
    }

}
