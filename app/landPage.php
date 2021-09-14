<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class landPage extends Model
{
    protected $fillable=[
        'fname','lname','email','tel','resource','options','introduced'
    ];
}
