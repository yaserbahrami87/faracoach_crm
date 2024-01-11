<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamResult extends Model
{
    protected $fillable=[
        'user_id','exam_question_id','result_id','date_fa','time_fa','exam_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
