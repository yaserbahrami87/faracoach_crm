<?php

namespace App;

use Hekmatinasser\Verta\Verta;
use Illuminate\Database\Eloquent\Model;

class scholarship extends Model
{
    protected $fillable=[
        'user_id','target','confirm_target','types','confirm_types','gettingknow','confirm_gettingknow','description','scientific','executive','introduce','cooperation','confirm_cooperation','applicant','confirm_applicant','resume','confirm_resume','confirm_webinar','confirm_exam','status','trackingcode','introductionletter','score_profile','score_introductionletter','financial','confirm_introductionletter','view_score','type_payment'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    //تبدیل تاریخ میلادی به شمسی
    public function changeTimestampToShamsi($date)
    {
        $dateMiladi=new verta($date);
        return ($dateMiladi->hour.":".$dateMiladi->minute."  ".$dateMiladi->year."/".$dateMiladi->month."/".$dateMiladi->day);
    }


    public function get_financial()
    {
        return $this->hasOne('App\checkout','authority','financial');
    }

    public function get_score()
    {

//        $this->created_at=$this->changeTimestampToShamsi($this->created_at);




        //امتیاز
        $count_scholarshipIntroduce=0;
        foreach ($this->user->get_invitations->where('created_at','>','2022-07-20 00:00:00')->where('resource','=','بورسیه تحصیلی') as $item)
        {

            if(!is_null($item->scholarship))
            {
                $count_scholarshipIntroduce++;
            }
        }

        $count_scholarshipIntroduce=$count_scholarshipIntroduce*4;

        //جمع امتیازات
        $result_final=0;

        if(is_null($this->score_profile))
        {
            $result_final=$result_final+0;
        }
        else
        {
            $result_final=$result_final+$this->score_profile;

        }

        if($this->confirm_webinar==1)
        {
            $result_final=$result_final+10;
        }
        else
        {
            $result_final=$result_final+0;
        }

        $result_final=$result_final+$count_scholarshipIntroduce;

        if(count($this->user->get_scholarshipexam)==0 || $this->user->get_scholarshipexam->last()->score<50)
        {
            $result_final=$result_final+0;
        }
        elseif(($this->user->get_scholarshipexam->last()->score) >= 50 && ($this->user->get_scholarshipexam->last()->score) <= 70)
        {
            $result_final=$result_final+10;
        }
        elseif(($this->user->get_scholarshipexam->last()->score) > 70)
        {
            $result_final=$result_final+20;
        }

        if(is_null($this->user->get_scholarshipInterview))
        {
            $result_final=$result_final+0;
        }
        else
        {
            $result_final=$result_final+$this->user->get_scholarshipInterview->score;
        }

        return ($result_final+$this->score_introductionletter);
    }


}


