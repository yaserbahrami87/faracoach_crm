<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category_gettingknow extends Model
{
    protected $fillable=[
        'category','status','parent_id'
    ];

    public function getRouteKeyName()
    {
        return 'id';
    }
}
