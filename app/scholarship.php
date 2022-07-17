<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class scholarship extends Model
{
    protected $fillable=[
        'user_id','target','types','gettingknow','description','scientific','executive','introduce','resume','status','trackingcode'
    ];
}
