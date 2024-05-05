<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable=[
        'product','shortlink','image','info','fi','fi_off','status','date_fa','time_fa','user_id','description','is_scholarship'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function getRouteKeyName()
    {
        return "shortlink";
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }


}
