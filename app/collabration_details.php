<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class collabration_details extends Model
{
    protected $fillable=[
        'title','value','max','status','collabration_categories_id','unit','description'
    ];

    public function collabration_category()
    {
        return $this->belongsTo('App\collabration_category');
    }

    public function collabration_accept()
    {
        return $this->hasMany('App\collabration_accept');
    }
}
