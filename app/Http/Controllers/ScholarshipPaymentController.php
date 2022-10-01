<?php

namespace App\Http\Controllers;

use App\checkout;
use App\lib\zarinpal;
use App\scholarship;
use App\scholarship_payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScholarshipPaymentController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

//        $scholarship->target=explode(',',Auth::user()->scholarship->target);
//        $scholarship->types=explode(',',Auth::user()->scholarship->types);

        $count_scholarshipIntroduce=0;
        foreach (Auth::user()->get_invitations->where('created_at','>','2022-07-20 00:00:00')->where('resource','=','بورسیه تحصیلی') as $item)
        {
            if(!is_null($item->scholarship))
            {
                $count_scholarshipIntroduce++;
            }
        }

        $count_scholarshipIntroduce=$count_scholarshipIntroduce*4;

        //جمع امتیازات
        $result_final=0;

        if(is_null(Auth::user()->scholarship->score_profile))
        {
            $result_final=$result_final+0;
        }
        else
        {
            $result_final=$result_final+Auth::user()->scholarship->score_profile;

        }

        if(Auth::user()->scholarship->confirm_webinar==1)
        {
            $result_final=$result_final+10;
        }
        else
        {
            $result_final=$result_final+0;
        }

        $result_final=$result_final+$count_scholarshipIntroduce;

        if(count(Auth::user()->get_scholarshipexam)==0 || Auth::user()->get_scholarshipexam->last()->score<50)
        {
            $result_final=$result_final+0;
        }
        elseif((Auth::user()->get_scholarshipexam->last()->score) >= 50 && (Auth::user()->get_scholarshipexam->last()->score) <= 70)
        {
            $result_final=$result_final+10;
        }
        elseif((Auth::user()->get_scholarshipexam->last()->score) > 70)
        {
            $result_final=$result_final+20;
        }

        if(is_null(Auth::user()->get_scholarshipInterview))
        {
            $result_final=$result_final+0;
        }
        else
        {
            $result_final=$result_final+Auth::user()->get_scholarshipInterview->score;
        }


        $course=$this->get_coursesByID($request->course_id);
        $fi_off=$course->fi_off;
        $off_percent=10;
        $gheymat_nahaei=($course->fi_off-($course->fi_off*$off_percent)/100);
        $boorsieh=($gheymat_nahaei*$result_final)/100;
        $pardakht=$gheymat_nahaei-$boorsieh;
//        $prepaymant=5000000;
        $prepaymant=500;
        $remaining=$pardakht-$prepaymant;
        $scholarship_payment= scholarship_payment::create([
                    'user_id'       =>Auth::user()->id,
                    'course_id'     =>$course->id,
                    'fi'            =>$fi_off,
                    'loan'          =>$off_percent,
                    'after_loan'    =>$gheymat_nahaei,
                    'score'         =>$result_final,
                    'fi_scholarship'=>$boorsieh,
                    'fi_final'      =>$pardakht,
                    'pre_payment'   =>$prepaymant,
                    'remaining'     =>$remaining,
                    'date_fa'       =>$this->dateNow,
                    'time_fa'       =>$this->timeNow,
        ]);

        $order = new zarinpal();
        $res = $order->pay($prepaymant, Auth::user()->email, Auth::user()->tel,'schoalrship');
        $status = checkout::create([
            'user_id'       => Auth::user()->id,
            'product_id'    => $course->id,
            'order_id'      => $scholarship_payment->id,
            'price'         => $prepaymant,
            'type'          => 'scholarship_payment',
            'authority'     => $res,
            'description'   => 'انتقال به درگاه',
        ]);

        return redirect('https://www.zarinpal.com/pg/StartPay/' . $res);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\scholarship_payment  $scholarship_payment
     * @return \Illuminate\Http\Response
     */
    public function show(scholarship_payment $scholarship_payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\scholarship_payment  $scholarship_payment
     * @return \Illuminate\Http\Response
     */
    public function edit(scholarship_payment $scholarship_payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\scholarship_payment  $scholarship_payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, scholarship_payment $scholarship_payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\scholarship_payment  $scholarship_payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(scholarship_payment $scholarship_payment)
    {
        //
    }
}
