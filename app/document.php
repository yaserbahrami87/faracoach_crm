<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class document extends Model
{
    protected $fillable = [
        'title', 'shortlink','content','file','permission','clicks','date_fa','time_fa','status','type','size','extension'
    ];

    public function permissions()
    {
        return [
            'همه کاربرها','دانشجویان'
        ];
    }

    public function get_permission()
    {
        switch ($this->permission)
        {
            case 0:return "همه کاربرها";
                    break;
            case 1:return "دانشجویان";
                    break;
            default:return "خطا";
                    break;
        }
    }
}
