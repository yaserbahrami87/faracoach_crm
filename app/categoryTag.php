<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class categoryTag extends Model
{
    protected $fillable = [
        'category', 'status'
    ];

    public function getRouteKeyName()
    {
        return 'id';
    }
}
