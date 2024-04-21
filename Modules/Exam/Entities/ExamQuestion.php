<?php

namespace Modules\Exam\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExamQuestion extends Model
{
//    use HasFactory;

    protected $fillable = [
        'title','is_question','question_id','is_correct','user_id','score','exam_id','date_fa','time_fa'
    ];

    protected static function newFactory()
    {
        return \Modules\Exam\Database\factories\ExamQuestionFactory::new();
    }

    public function answers()
    {
        return $this->hasMany('Modules\Exam\Entities\ExamQuestion','question_id','id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function exam()
    {
        return $this->belongsTo('Modules\Exam\Entities\Exam');
    }

    public function exam_results()
    {
        return $this->hasMany('Modules\Exam\Entities\ExamResult','exam_question_id','id');
    }

    public function result_user()
    {
        return $this->hasMany('Modules\Exam\Entities\ExamResult','result_id','id');
    }
}
