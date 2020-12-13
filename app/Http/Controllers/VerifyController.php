<?php

namespace App\Http\Controllers;

use App\verify;
use Illuminate\Http\Request;

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
