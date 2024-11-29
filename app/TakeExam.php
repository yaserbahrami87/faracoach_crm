<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TakeExam extends Model
{
    protected $fillable=[
        'user_id','exam_id','score','status','date_fa','time_fa'
    ];

    public function exam()
    {
        return $this->belongsTo('App\exam');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
