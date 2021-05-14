<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class coach extends Model
{
    protected $fillable = [
        'user_id','education_background','researches','certificates','experience','skills','documents','count_meeting','customer_satisfaction','change_customer','count_recommendation','status'
    ];
}
