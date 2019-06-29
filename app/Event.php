<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';
    protected $fillable = ['event_name','event_start_date','event_end_date','event_start_time','event_end_time','event_place','col_cod','event_last_registration_date','e_c_id','department', 'image','description','team_specification', 'general_rules', 'judging_criteria', 'level_description', 'college_name', 'college_address', 'evetn_price', 'city', 'max_member', 'min_member', 'techfest_name','level'];

    public function students()
    {
    	return $this->hasmany('App\Student');
    }

    public function eventcodinators()
    {
    	return $this->hasmany('App\Eventcodinator');
    }

    public function scopeSearch($query, $s)
    {
        return $query->where('event_name', 'LIKE', '%' .$s. '%')
            ->orWhere('col_cod', 'LIKE', '%' .$s. '%')
            ->orWhere('event_start_date', 'LIKE', '%' .$s. '%')
            ->orWhere('event_end_date', 'LIKE', '%' .$s. '%')
            ->orWhere('event_place', 'LIKE', '%' .$s. '%')
            ->orWhere('department', 'LIKE', $s);      
    }

    public function scopeSearchforcollegeadmin($query, $s)
    {
        return $query->where('event_name', 'LIKE', '%' .$s. '%')
            ->orWhere('col_cod', 'LIKE', '%' .$s. '%')
            ->orWhere('event_start_date', 'LIKE', '%' .$s. '%')
            ->orWhere('event_end_date', 'LIKE', '%' .$s. '%')
            ->orWhere('event_place', 'LIKE', '%' .$s. '%')
            ->orWhere('department', 'LIKE', $s);      
    }
}
