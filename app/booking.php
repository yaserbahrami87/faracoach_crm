<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class booking extends Model
{
    protected $fillable = [
        'user_id', 'start_date','start_time','end_date','end_time','duration_booking','duration_relax','status','date_fa','time_fa'
    ];

    public function reserve()
    {
        return $this->hasOne('App\reserve','booking_id','id');
    }

    public function coach()
    {
        return $this->belongsTo('App\coach','user_id','user_id');
    }

    public function feedback()
    {
        return $this->hasOne('App\feedback_coaching','booking_id','id');
    }

}
