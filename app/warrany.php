<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class warrany extends Model
{
    protected $fillable=[
        'user_id','product_id','type','receipt','date_fa','bank','fi','signature','description','status'
    ];
}
