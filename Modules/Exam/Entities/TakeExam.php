<?php

namespace Modules\Exam\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TakeExam extends Model
{
//    use HasFactory;

    protected $fillable = [
        'user_id','exam_id','score','status','date_fa','time_fa'
    ];

    protected static function newFactory()
    {
        return \Modules\Exam\Database\factories\TakeExamFactory::new();
    }


    public function exam()
    {
        return $this->belongsTo('Modules\Exam\Entities\Exam');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
