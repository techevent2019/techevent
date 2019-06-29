<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
        'event_id', 'enrollment_no', 'team_id',
    ];
}
