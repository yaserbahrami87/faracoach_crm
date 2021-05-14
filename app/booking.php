<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class booking extends Model
{
    protected $fillable = [
        'user_id', 'start_date','start_time','end_date','end_time','duration_booking','duration_relax','status','date_fa','time_fa'
    ];
}
