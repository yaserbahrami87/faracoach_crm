<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class student extends Model
{
    protected $fillable=
        [
            'user_id','course_id','type','status','date_fa','time_fa'
        ];

    public function courses()
    {
        return $this->hasMany('App\course','user_id','id');
    }
}
