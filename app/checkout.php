<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class checkout extends Model
{
    protected $fillable=[
        'user_id','order_id','product_id','price','type','authority','description','status'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function course()
    {
        return $this->hasMany('App\course','product_id','id');
    }

    public function order()
    {
        return $this->belongsTo('App\order','order_id','id');
    }
}
