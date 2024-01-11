<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $fillable=[
        'exam','description','certificate_id','pass','user_id','status'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function exam_questions()
    {
        return $this->hasMany('App\ExamQuestion');
    }

    public function takeExams()
    {
        return $this->hasMany('App\TakeExam');
    }
}
