<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class reserve extends Model
{
    protected $fillable = [
        'user_id','booking_id','subject','type_booking','duration_booking','details','fi','off','type_discount','coupon','final_off','presession','status','result_coach','score'
    ];

    public function booking()
    {
        return $this->belongsTo('App\booking','booking_id','id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }


}
