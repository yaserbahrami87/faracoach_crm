<?php

namespace App\Http\Controllers;

use App\verify;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Hekmatinasser\Verta\Verta;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
                $user=$this->get_user($request['tel'],NULL,NULL,NULL,true);
                if(is_null($user)) {
                    $status = verify::where('tel', '=', $request)
                        ->where('verify', '=', 1)
                        ->count();

                    if ($status == 0) {
                        $status = verify::create(
                            [
                                'tel' => $request,
                                'code' => $six_digit_random_number,
                                'date_fa' => $this->dateNow,
                                'time_fa' => $this->timeNow
                            ]);
                        if ($status) {
                            $message = "کد فعالی سازی شما در سیستم فراکوچ : " . $six_digit_random_number;
                            $this->sendSms($request, $message);
                            return view('verifyAjax')
                                ->with('tel', $request);
                        } else {
                            echo('<div  class="alert alert-danger">خطا</div>');
                        }
                    } else {

                        echo('<div  class="alert alert-danger">شماره همراه قبلا ثبت و تایید شده است</div>');
                    }
                }
                else
                {
                    echo('<div  class="alert alert-danger">شماره وارد شده قبلا در سیستم ثبت شده است</div>');
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
            // if(preg_match('/^09(1[0-9]|3[1-9]|2[1-9])-?[0-9]{3}-?[0-9]{4}$/',$request['tel']))
            // {
                $now= Verta::now();
                $user= Auth::user();
                if($user->tel_verified==0)
                {
                    $status=verify::where('tel','=',$user->tel)
                            ->where('verify','=',0)
                            ->latest()
                            ->count();
                    if($status==0)
                    {
                        $status=verify::create(
                            [
                                'tel'           =>$user->tel,
                                'code'          =>$six_digit_random_number,
                                'date_fa'       =>$this->dateNow,
                                'time_fa'       =>$this->timeNow
                            ]);

                            if($status)
                            {
                                $message="کد فعالی سازی شما در سیستم فراکوچ : " . $six_digit_random_number ;
                                $this->sendSms($user->tel,$message);
                                $msg=" کد فعال سازی به شماره ".$user->tel." ارسال شد ";
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
                        $checkTimeCode=verify::where('tel','=',$user->tel)
                                    ->where('verify','=',0)
                                    ->latest()
                                    ->first();
                        $date=($checkTimeCode['created_at']);
                        $checkDays=$date->addMinutes(10);
                        if($checkDays<Carbon::now())
                        {

                            $status=verify::create(
                            [
                                'tel'           =>$user->tel,
                                'code'          =>$six_digit_random_number,
                                'date_fa'       =>$this->dateNow,
                                'time_fa'       =>$this->timeNow
                            ]);
                            if($status)
                            {
                                $message="کد فعالی سازی شما در سیستم فراکوچ : " . $six_digit_random_number ;
                                $this->sendSms($user->tel,$message);
                                $msg=" کد فعال سازی به شماره ".$user->tel." ارسال شد ";
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
            // }
            // else
            // {
            //     return back()
            //             ->with('msg',"تلفن همراه وارد شده اشتباه است")
            //             ->with('errorStatus',"danger");
            // }
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

    //ارسال کد فعالی سازی بدون رمز عبور
    public function storeCodewithoutPass(Request $request)
    {
        if(preg_match('/^09(1[0-9]|3[1-9]|2[1-9])-?[0-9]{3}-?[0-9]{4}$/',$request['tel']))
        {
            $this->validate(request(),
            [
                'tel'           =>'required|numeric|iran_mobile|',
            ]);
            $six_digit_random_number = mt_rand(100000, 999999);
            $verify=verify::where('tel','=',$request['tel'])
                        ->latest()
                        ->first();
            if(is_null($verify))
            {
                return back()->with('msg','شماره وارد شده در سیستم موجود نمی باشد')
                    ->with('errorStatus','danger');
            }
            else
            {
                $created_at = ($verify['created_at']);

                $created_at_add = $created_at->addMinutes(10);

                if ($created_at_add < Carbon::now()) {
                    $status = verify::create(
                        [
                            'tel' => $request['tel'],
                            'code' => $six_digit_random_number,
                            'date_fa' => $this->dateNow,
                            'time_fa' => $this->timeNow
                        ]);
                    if ($status) {
                        $message = "رمز یکبار مصرف شما در سیستم فراکوچ : " . $six_digit_random_number;
                        $this->sendSms($request['tel'], $message);
                        return back()->with('msg', 'رمز یکبار مصرف شما به شماره ' . $request['tel'] . ' ارسال شد')
                            ->with('errorStatus', 'success')
                            ->with('status', true);
                    } else {
                        return back()->with('msg', 'خطا در ارسال رمز یکبار مصرف')
                            ->with('errorStatus', 'danger');
                    }
                } else {
                    return back()->with('msg', 'رمز یکبار مصرف کمتر از 10 دقیقه به شماره ' . $request['tel'] . " ارسال شده است")
                        ->with('errorStatus', 'success')
                        ->with('status', true);
                }
            }

        }
        else
        {
            return back()->with('msg','تلفن همراه وارد شده معتبر نمی باشد')
                         ->with('errorStatus','danger');
        }

    }

    //چک کردن کد ارسال شده به موبایل برای لاگین
    public function checkCodewithoutPass(Request $request)
    {
        $status=verify::where('code','=',$request['code'])
                    ->where('verify','=',0)
                    ->count();
        if($status==1)
        {
            $user=verify::where('code','=',$request['code'])
                    ->where('verify','=',0)
                    ->first();
            $created_at=($user['created_at']);
            $created_at_add=$created_at->addMinutes(10);
            if($created_at_add>Carbon::now())
            {
                $user=$this->get_user($request['tel'],NULL,NULL,NULL,true);
                if(!is_null($user))
                {
                    $user=$this->get_user($request['tel'],NULL,NULL,NULL,true);
                    Auth::login($user);
                    return redirect('/panel');
                }
                else
                {
                    return back()->with('msg','کاربری با چنین تلفن همراه موجود نیست')
                         ->with('errorStatus','danger');
                }

            }
            else
            {
                return back()->with('msg','رمز یکبار مصرف منقضی شده است')
                         ->with('errorStatus','danger');
            }
        }
        else
        {
            return back()->with('msg','رمز یکبار مصرف اشتباه است')
                         ->with('errorStatus','danger');
        }
    }

    public function sendResetCode(request $request)
    {
        $six_digit_random_number = mt_rand(100000, 999999);
        $now= Verta::now();
        $user=$this->get_user($request['tel'],NULL,NULL,NULL,true);
        if(!is_null($user))
        {
            $status=verify::where('tel','=',$user->tel)
                ->where('verify','=',0)
                ->where('type','=',1)
                ->latest()
                ->count();

            if($status==0)
            {
                $status=verify::create(
                    [
                        'tel'           =>$user->tel,
                        'code'          =>$six_digit_random_number,
                        'type'          =>1,
                        'date_fa'       =>$this->dateNow,
                        'time_fa'       =>$this->timeNow
                    ]);

                if($status)
                {
                    $message="کد بازیابی شما در سیستم فراکوچ : " . $six_digit_random_number ;
                    $this->sendSms($user->tel,$message);
                    $msg=" کد بازیابی به شماره ".$user->tel." ارسال شد ";
                    $errorStatus="warning";
                    return view('resetPasswordbySMS')
                                ->with('msg',$msg)
                                ->with('errorStatus',$errorStatus);
                }
                else
                {

                    $msg="خطا";
                    $errorStatus="danger";
                    return back()
                            ->with('msg',$msg)
                            ->with('errorStatus',$errorStatus);
                }
            }
            else
            {

                $checkTimeCode=verify::where('tel','=',$user->tel)
                    ->where('verify','=',0)
                    ->latest()
                    ->first();
                $date=($checkTimeCode['created_at']);
                $checkDays=$date->addMinutes(10);
                if($checkDays<Carbon::now())
                {
                    $status=verify::create(
                        [
                            'tel'           =>$user->tel,
                            'type'          =>1,
                            'code'          =>$six_digit_random_number,
                            'date_fa'       =>$this->dateNow,
                            'time_fa'       =>$this->timeNow
                        ]);

                    if($status)
                    {
                        $message="کد بازیابی شما در سیستم فراکوچ : " . $six_digit_random_number ;
                        $this->sendSms($user->tel,$message);
                        $msg=" کد بازیابی به شماره ".$user->tel." ارسال شد ";
                        $errorStatus="warning";

                        return view('resetPasswordbySMS')
                            ->with('msg',$msg)
                            ->with('errorStatus',$errorStatus);
                    }
                    else
                    {
                        $msg="خطا";
                        $errorStatus="danger";
                        return back()
                            ->with('msg',$msg)
                            ->with('errorStatus',$errorStatus);
                    }
                }
                else
                {
                    $msg="کد بازیابی مجدد هر 10 دقیقه ارسال خواهد شد";
                    $errorStatus="danger";
                    return view('resetPasswordbySMS')
                                ->with('msg', $msg)
                                ->with('errorStatus', $errorStatus);
                }
            }
            return back()
                ->with('msg',$msg)
                ->with('errorStatus',$errorStatus);
        }
        else
        {
            $msg="شماره همراه وارد شده در سیستم موجود نمی باشد";
            $errorStatus="danger";
            return back()
                ->with('msg',$msg)
                ->with('errorStatus',$errorStatus);
        }
    }

    public function checkResetCode(request $request)
    {

        if (is_null($request))
        {
            return back();
        }
        else
        {

            $this->validate($request,[
                'password'      => ['required', 'string', 'min:8', 'confirmed'],
                'code'          =>['required','numeric','min:6']
            ]);
            $verify=verify::where('code','=',$request['code'])
                    //->where('type','=',1)
                    ->where('verify','=',0)
                    ->latest()
                    ->first();

            if(is_null($verify))
            {
                return view('resetPasswordbySMS')
                            ->with('msg',"کد وارد شده اشتباه است")
                            ->with('errorStatus','danger');
            }
            else {
                $date = ($verify['created_at']);

                $checkDays = $date->addMinutes(10);

                if($checkDays>Carbon::now()){
                    $user=$this->get_user($request['tel'],NULL,NULL,NULL,true);
                    $user['password'] = Hash::make($request['password']);
                    $status = $user->save();
                    if ($status)
                    {
                        $msg = "رمز با موفقیت تغییر کرد";
                        $errorStatus = "success";
                        return redirect('/password/reset')
                                ->with('msg', $msg)
                                ->with('errorStatus', $errorStatus);
                    }
                    else
                    {
                        $msg = "خطا در تغییر رمز عبور";
                        $errorStatus = "danger";
                        return view('resetPasswordbySMS')
                            ->with('msg', $msg)
                            ->with('errorStatus', $errorStatus);
                    }

                } else {
                    $msg = "کد بازیابی شما منقضی شده است";
                    $errorStatus = "danger";
                    return view('resetPasswordbySMS')
                        ->with('msg', $msg)
                        ->with('errorStatus', $errorStatus);
                }
            }
        }

    }
}
