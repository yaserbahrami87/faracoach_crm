<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class student extends Model
{
    protected $fillable=
        [
            'user_id','course_id','type','status','date_fa','time_fa'
        ];

    public function course()
    {
        return $this->belongsTo('App\course','course_id','id');
    }

    public function courses()
    {
        return $this->hasMany('App\course','user_id','id');
    }

    public function user()
    {
        return $this->belongsTo('App\user','user_id','id');
    }

    public function get_status($status)
    {
        switch ($status)
        {
            case '1':
                return 'دانشجو';
                break;
            case '0':
                return 'انصراف';
                break;

            default: return 'خطا';

        }
    }
}
