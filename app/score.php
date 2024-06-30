<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class score extends Model
{
    protected $fillable=[
        'user_id','total_score','score_introduced','score_purchase','score_re_entry','type'
    ];


}
