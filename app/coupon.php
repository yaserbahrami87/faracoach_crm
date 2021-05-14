<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class coupon extends Model
{
    protected $fillable=[
        'user_id','coupon','discount','expire_date','product','limit_user','count'
    ];
}
