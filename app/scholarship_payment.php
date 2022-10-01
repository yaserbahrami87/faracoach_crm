<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class scholarship_payment extends Model
{
    protected $fillable=[
        'user_id','course_id','fi','loan','after_loan','score','fi_scholarship','fi_final','pre_payment','remaining','date_fa','time_fa'
    ];
}
