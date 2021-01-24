<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class followup extends Model
{
    protected $fillable = [
        'user_id', 'insert_user_id', 'comment','problemfollowup_id','categoryfollowup_id','status_followups','nextfollowup_date_fa','sms','date_fa','time_fa','datetime_fa','tags'
    ];
}
