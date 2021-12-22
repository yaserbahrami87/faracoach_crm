<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    protected $fillable=[
        'user_id','product_id','capacity','fi','off','coupon','final_off','type','status','date_fa','time_fa'
    ];
}
