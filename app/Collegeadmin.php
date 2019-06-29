<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\CollegeadminResetPasswordNotification;
use App\Notifications\Amail;

class Collegeadmin extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    protected $guard = 'collegeadmin';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'col_name', 'email', 'password', 'col_address', 'col_con_no', 'col_code', 'col_city', 'image','col_admin_name','col_principal_name','admin_con_no',
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
        $this->notify(new CollegeadminResetPasswordNotification($token));
    }

    public function formail()
    {
        $this->notify(new Amail());
    }

    public function scopeSearch($query, $s)
    {
        return $query->where('col_name', 'LIKE', '%' .$s. '%')
            ->orWhere('col_code', 'LIKE', '%' .$s. '%');
        
    }
}