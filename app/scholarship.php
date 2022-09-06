<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class scholarship extends Model
{
    protected $fillable=[
        'user_id','target','confirm_target','types','confirm_types','gettingknow','confirm_gettingknow','description','scientific','executive','introduce','cooperation','confirm_cooperation','applicant','confirm_applicant','resume','confirm_resume','confirm_webinar','confirm_exam','status','trackingcode','introductionletter'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }




}


