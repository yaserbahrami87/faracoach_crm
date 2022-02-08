<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class landPage extends Model
{
    protected $fillable=[
        'user_id','fname','lname','email','tel','resource','options','introduced','count'
    ];


    public function introducedUser()
    {
        return $this->belongsTo('App\landPage','introduced','id');
    }
}
