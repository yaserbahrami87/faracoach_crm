<?php

namespace Modules\Clinic\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClinicBasicInfo extends Model
{
    protected $fillable=[
        'title','parent_id','pic','description','status'
    ];

    public function speciality_infos()
    {
        return $this->hasMany('Modules\Clinic\Entities\clinic_basic_info','parent_id','id');
    }

    public function coach_requests()
    {
        return $this->hasMany('Modules\Clinic\Entities\coach_request','fk_orientation','id');
    }

    public function children()
    {
        return $this->hasMany('Modules\Clinic\Entities\ClinicBasicInfo','parent_id','id');
    }

    public function parent()
    {
        return $this->belongsTo('Modules\Clinic\Entities\clinic_basic_info','parent_id','id');
    }

    public function getRouteKeyName()
    {
        return "title";
    }
}
