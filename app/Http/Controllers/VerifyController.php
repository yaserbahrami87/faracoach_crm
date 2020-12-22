<?php

namespace App\Http\Controllers;

use App\verify;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Hekmatinasser\Verta\Verta;
use Illuminate\Support\Facades\Auth;

class VerifyController extends BaseController
{

    public function __construct()
    {
        $dateNow = verta();
        $this->dateNow = $dateNow->format('Y/m/d');
        $this->timeNow = $dateNow->format('H:i:s');
    }
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
    public function store($request)
    {
        if(isset($request))
        {
            $six_digit_random_number = mt_rand(100000, 999999);
            if(preg_match('/^09(1[0-9]|3[1-9]|2[1-9])-?[0-9]{3}-?[0-9]{4}$/',$request))
            {
                $status=verify::where('tel','=',$request)
                                ->where('verify','=',1)
                                ->count();
                if($status==0)
                {
                    $status=verify::create(
                    [
                        'tel'           =>$request,
                        'code'          =>$six_digit_random_number,
                        'date_fa'       =>$this->dateNow,
                        'time_fa'       =>$this->timeNow
                    ]);
                    if($status)
                    {
                        $message="کد فعالی سازی شما در سیستم فراکوچ : " . $six_digit_random_number ;
                        $this->sensSms($request,$message);
                        return view('verifyAjax')
                                ->with('tel',$request);
                    }
                    else
                    {
                        echo ('<div  class="alert alert-danger">خطا</div>');
                    }
                }
                else
                {

                    echo ('<div  class="alert alert-danger">شماره همراه قبلا ثبت و تایید شده است</div>');
                }
            }
            else
            {
                return '<div class="alert alert-danger">لظفا تلفن همراه را جهت تایید درست وارد کنید</div>';
            }
        }

    }

    // ایجاد کد فعال سازی موبایل در داخل پروفایل کاربر
    public function verifyTelPanel(Request $request)
    {
        if(isset($request))
        {
            $six_digit_random_number = mt_rand(100000, 999999);
            if(preg_match('/^09(1[0-9]|3[1-9]|2[1-9])-?[0-9]{3}-?[0-9]{4}$/',$request['tel']))
            {
                $time2=new verta('2020-12-17 01:51:40');
                $now= Verta::now();


                $status=verify::where('tel','=',$request['tel'])
                                ->where('verify','=',1)
                                ->count();
                if($status==0)
                {
                    $status=verify::where('tel','=',$request['tel'])
                            ->where('verify','=',0)
                            ->latest()
                            ->count();
                    if($status==0)
                    {
                        $status=verify::create(
                            [
                                'tel'           =>$request['tel'],
                                'code'          =>$six_digit_random_number,
                                'date_fa'       =>$this->dateNow,
                                'time_fa'       =>$this->timeNow
                            ]);

                            if($status)
                            {
                                $message="کد فعالی سازی شما در سیستم فراکوچ : " . $six_digit_random_number ;
                                $this->sensSms($request['tel'],$message);
                                $msg=" کد فعال سازی به شماره ".$request['tel']." ارسال شد ";
                                $errorStatus="warning";
                            }
                            else
                            {
                                $msg="خطا";
                                $errorStatus="danger";
                            }
                    }
                    else
                    {
                        $checkTimeCode=verify::where('tel','=',$request['tel'])
                                    ->where('verify','=',0)
                                    ->latest()
                                    ->first();
                        $date=($checkTimeCode['created_at']);
                        $checkDays=$date->addMinutes(10);
                        if($checkDays<Carbon::now())
                        {

                            $status=verify::create(
                            [
                                'tel'           =>$request['tel'],
                                'code'          =>$six_digit_random_number,
                                'date_fa'       =>$this->dateNow,
                                'time_fa'       =>$this->timeNow
                            ]);
                            if($status)
                            {
                                $message="کد فعالی سازی شما در سیستم فراکوچ : " . $six_digit_random_number ;
                                $this->sensSms($request['tel'],$message);
                                $msg=" کد فعال سازی به شماره ".$request['tel']." ارسال شد ";
                                $errorStatus="warning";
                            }
                            else
                            {
                                $msg="خطا";
                                $errorStatus="danger";
                            }
                        }
                        else
                        {
                            $msg="کد فعال سازی مجدد هر 10 دقیقه ارسال خواهد شد";
                            $errorStatus="danger";
                        }
                    }
                    return back()
                        ->with('msg',$msg)
                        ->with('errorStatus',$errorStatus);
                }
                else
                {
                    $msg="شماره همراه قبلا ثبت و تایید شده است";
                    $errorStatus="danger";
                    return back()
                        ->with('msg',$msg)
                        ->with('errorStatus',$errorStatus);
                }
            }
            else
            {
                return back()
                        ->with('msg',"تلفن همراه وارد شده اشتباه است")
                        ->with('errorStatus',"danger");
            }
        }
    }

    public function checkVerifyTelPanel(Request $request)
    {
        $this->validate(request(),
        [
            'tel'   =>'required|numeric|min:6'
        ]);

        $verify=verify::where('code','=',$request['tel'])
                        ->where('verify','=',0)
                        ->latest()
                        ->count();

        if($verify==1)
        {
            $verify=verify::where('code','=',$request['tel'])
                        ->where('verify','=',0)
                        ->latest()
                        ->first();
            $created_at=($verify['created_at']);
            $created_at_add=$created_at->addMinutes(10);

            if($created_at_add>Carbon::now())
            {
                $verify->verify=1;
                if($verify->save())
                {
                    $user=Auth::user();
                    $user->tel_verified=1;
                    $user->update();
                    $msg="شماره تلفن با موفقیت تایید شد";
                    $errorStatus="success";
                }
            }
            else
            {
                $msg="کد وارد شده منقضی شده است";
                $errorStatus="danger";

            }
        }
        else
        {
            $msg="کد وارد شده اشتباه است";
            $errorStatus="danger";
        }

        return back()
                ->with('msg',$msg)
                ->with('errorStatus',$errorStatus);



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\verify  $verify
     * @return \Illuminate\Http\Response
     */
    public function show(verify $verify)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\verify  $verify
     * @return \Illuminate\Http\Response
     */
    public function edit(verify $verify)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\verify  $verify
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, verify $verify)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\verify  $verify
     * @return \Illuminate\Http\Response
     */
    public function destroy(verify $verify)
    {
        //
    }


    public function checkCode($code)
    {
        if(preg_match('/\d/',$code))
        {
            $count=verify::where('code','=',$code)
                        ->where('verify','=',0)
                        ->count();
            if($count==1)
            {
                $verify=verify::where('code','=',$code)->first();
                $verify->verify=1;
                $verify->save();
                echo "<script> $('#tel_verified').val(1)</script>";
                return '<div  class="alert alert-success">شماره همراه تایید شد</div>';
            }
            else
            {
                return '<div  class="alert alert-danger">کد وارد شده اشتباه است</div>';
            }
        }
        else
        {
            return '<div  class="alert alert-danger">لطفا کد را درست وارد کنید</div>';
        }
    }
}
