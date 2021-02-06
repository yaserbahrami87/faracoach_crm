<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class course extends Model
{
    protected $fillable = [
        'course','shortlink' ,'image','teacher_id','type','duration','duration_date','count_students','coaches','coachingbycoach','coachingbyreference','intership','start','end','course_days','course_times','infocourse','exam','certificate','fi','fi_off','type_peymant_id','images','status'
    ];

    public function getRouteKeyName()
    {
        return 'shortlink';
    }
}
