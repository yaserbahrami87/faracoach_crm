<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class document extends Model
{
    protected $fillable = [
        'title', 'shortlink','content','file','permission','clicks','date_fa','time_fa','status','type','size','extension'
    ];
}
