<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class news extends Model
{
    protected $fillable=[
        'user_id','title','summery_news','news','status'
    ];
    use HasFactory;
}
