<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamQuestion extends Model
{
    protected $fillable=[
        'title','is_question','question_id','is_correct','user_id','score','exam_id','date_fa','time_fa'
    ];

    public function answers()
    {
        return $this->hasMany('App\ExamQuestion','question_id','id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function exam()
    {
        return $this->belongsTo('App\Exam');
    }

    public function exam_results()
    {
        return $this->hasMany('App\ExamResult','exam_question_id','id');
    }

    public function result_user()
    {
        return $this->hasMany('App\ExamResult','result_id','id');
    }



}
