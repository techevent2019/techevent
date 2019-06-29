<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['payment_id', 'payment_status', 'payment_request_id', 'event_id', 'enrollment_no', 'college_code','amount'];
}
