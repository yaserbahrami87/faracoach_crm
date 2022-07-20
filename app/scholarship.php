<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class scholarship extends Model
{
    protected $fillable=[
        'user_id','target','types','gettingknow','description','scientific','executive','introduce','cooperation','applicant','resume','status','trackingcode'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }


}


