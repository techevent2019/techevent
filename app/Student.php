<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\StudentResetPasswordNotification;

class Student extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    protected $guard = 'student';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'stu_name', 'email', 'password', 'stu_enrollment_no', 'stu_con_no', 'stu_department', 'stu_col_code' ,'stu_gender' ,'stu_sem' , 'stu_col_name', 'stu_department',
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
        $this->notify(new StudentResetPasswordNotification($token));
    }

    //for many to may relation with table
    public function event()
    {
        return $this->belongsTo('App\Event');
    }

    public function scopeSearch($query, $s)
    {
        return $query->where('stu_name', 'LIKE', '%' .$s. '%')
            ->orWhere('stu_enrollment_no', 'LIKE',$s)
            ->orWhere('stu_department', 'LIKE', '%' .$s. '%')
            ->orWhere('stu_col_code', 'LIKE', $s)
            ->orWhere('stu_gender', 'LIKE',$s)
            ->orWhere('stu_sem', 'LIKE', '%' .$s. '%')
            ->orWhere('stu_col_name', 'LIKE', '%' .$s. '%');       
    }

}
