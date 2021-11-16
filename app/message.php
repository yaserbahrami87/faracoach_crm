<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class message extends Model
{
    protected $fillable = [
        'user_id_send','subject','comment','user_id_recieve','attach','type','message_id_answer','date_fa','time_fa',
    ];
}
