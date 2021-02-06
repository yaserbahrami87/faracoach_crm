<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class teacher extends Model
{
    protected $fillable = [
        'fname', 'lname','email','tel','sex' ,'type','education','city','image','biography','shortlink'
    ];

    public function getRouteKeyName()
    {
        return 'shortlink';
    }
}
