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

    public function get_status()
    {

        switch ($this->status)
        {
            case 1:
                return ('دانشجو');
                break;
            case 2:
                return ('انصراف');
                break;
            case 3:
                return ('فارغ التحصیل');
                break;
            case 4:
                return ('مرخصی');
                break;
            case 5:
                return ('بلاتکلیف');
                break;
            default: return ('خطا');

        }
    }
}
