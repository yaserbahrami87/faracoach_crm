<?php

namespace Modules\Exam\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Exam extends Model
{
//    use HasFactory;

    protected $fillable = [
        'exam','description','certificate_id','pass','user_id','status'
    ];

    protected static function newFactory()
    {
        return \Modules\Exam\Database\factories\ExamFactory::new();
    }


    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function exam_questions()
    {
        return $this->hasMany('Modules\Exam\Entities\ExamQuestion');
    }

    public function takeExams()
    {
        return $this->hasMany('Modules\Exam\Entities\TakeExam');
    }
}
