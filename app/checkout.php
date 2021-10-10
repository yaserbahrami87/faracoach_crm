<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class checkout extends Model
{
    protected $fillable=[
        'user_id','product_id','price','type','authority','description','status'
    ];
}
