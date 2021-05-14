<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class reserve extends Model
{
    protected $fillable = [
        'user_id','booking_id','subject','type_booking','details','fi','off','coupon','final_off','status','result_coach','score'
    ];
}
