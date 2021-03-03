<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    protected $fillable = [
        'user_id','post_id' ,'comment','status','date_fa','time_fa'
    ];
}
