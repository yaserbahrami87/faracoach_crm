<?php

namespace Modules\Exam\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExamResult extends Model
{
//    use HasFactory;

    protected $fillable = [
        'user_id','exam_question_id','result_id','date_fa','time_fa','exam_id'
    ];

    protected static function newFactory()
    {
        return \Modules\Exam\Database\factories\ExamResultFactory::new();
    }


    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
