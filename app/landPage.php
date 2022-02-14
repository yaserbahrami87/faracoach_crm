<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class landPage extends Model
{
    protected $fillable=[
        'user_id','fname','lname','email','tel','resource','options','instagram','introductioncoaching','attendingcoaching','coachingservices','mention','resultoptions','introduced','count'
    ];


    public function introducedUser()
    {
        return $this->hasMany('App\landPage','introduced','id');
    }

    public function introduce()
    {
        return $this->belongsTo('App\landPage','introduced','id');
    }
}
