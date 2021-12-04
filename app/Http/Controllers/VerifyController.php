<?php

namespace App\Http\Controllers;

use App\landPage;
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
    public function store(Request $request)
    {
        $six_digit_random_number = mt_rand(100000, 999999);

        $this->validate($request,
            [
                'tel'   =>'required|iran_mobile'
            ]
        );


        $user=$this->get_user($request['tel'],NULL,NULL,NULL,true);
        if(is_null($user))
        {
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
                        $checkDays=$date->addMinutes(2);
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
                                alert()->warning($msg)->persistent('بستن');

                            }
                            else
                            {
                                alert()->error('خطا')->persistent('بستن');
                            }
                        }
                        else
                        {

                            $msg="کد فعال سازی مجدد هر 2 دقیقه ارسال خواهد شد";
                            alert()->error($msg)->persistent('بستن');

                        }
                    }
                    return back();
                }
                else
                {
                    alert()->error('شماره همراه قبلا ثبت و تایید شده است')->persistent('بستن');
                    return back();
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
            $created_at_add=$created_at->addMinutes(2);

            if($created_at_add>Carbon::now())
            {
                $verify->verify=1;
                if($verify->save())
                {
                    $user=Auth::user();
                    $user->tel_verified=1;
                    $user->update();
                    alert()->success('شماره تلفن با موفقیت تایید شد')->persistent('بستن');
                }
            }
            else
            {
                alert()->error('کد وارد شده منقضی شده است')->persistent('بستن');
            }
        }
        else
        {
            alert()->error('کد وارد شده اشتباه است')->persistent('بستن');

        }

        return back();



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

        $this->validate($request,[
            'tel'   =>'required|string|iran_mobile'
        ]);
//        if(preg_match('/^09(1[0-9]|3[1-9]|2[1-9])-?[0-9]{3}-?[0-9]{4}$/',$request['tel']))
//        {


            $six_digit_random_number = mt_rand(100000, 999999);
            $verify=$this->get_user($request['tel'],NULL,NULL,NULL,true);    //verify::where('tel','=',$request['tel'])
//                        ->latest()
//                        ->first();

            if(is_null($verify))
            {
                return back()->with('msg','شماره وارد شده در سیستم موجود نمی باشد')
                    ->with('errorStatus','danger');
            }
            else
            {
                $created_at = ($verify['created_at']);

                $created_at_add = $created_at->addMinutes(2);

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
                    return back()->with('msg', 'رمز یکبار مصرف کمتر از 2 دقیقه به شماره ' . $request['tel'] . " ارسال شده است")
                        ->with('errorStatus', 'success')
                        ->with('status', true);
                }
            }

//        }
//        else
//        {
//            return back()->with('msg','تلفن همراه وارد شده معتبر نمی باشد')
//                         ->with('errorStatus','danger');
//        }

    }

    //چک کردن کد ارسال شده به موبایل برای لاگین
    public function checkCodewithoutPass(Request $request)
    {
        $status=verify::where('code','=',$request['code'])
                    ->where('verify','=',0)
                    ->count();
        if($status==1)
        {
            $verify=verify::where('code','=',$request['code'])
                    ->where('verify','=',0)
                    ->first();

            $created_at=($verify['created_at']);
            $created_at_add=$created_at->addMinutes(2);
            if($created_at_add>Carbon::now())
            {

                $user=$this->get_user($verify->tel,NULL,NULL,NULL,true);
                if(!is_null($user))
                {
                    $user=$this->get_user($verify->tel,NULL,NULL,NULL,true);
                    Auth::login($user);
                    return redirect('/');
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
                    alert()->warning($msg)->persistent('بستن');
                    return view('resetPasswordbySMS')
                                        ->with('tel',$user->tel);;
                }
                else
                {
                    alert()->error('خطا')->persistent('بستن');
                    return back();
                }
            }
            else
            {

                $checkTimeCode=verify::where('tel','=',$user->tel)
                    ->where('verify','=',0)
                    ->latest()
                    ->first();
                $date=($checkTimeCode['created_at']);
                $checkDays=$date->addMinutes(2);
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
                        alert()->warning($msg)->persistent('بستن');
                        return view('resetPasswordbySMS')
                            ->with('tel',$user->tel);
                    }
                    else
                    {
                        alert()->error('خطا')->persistent('بستن');
                        return back()
                            ->with('tel',$user->tel);
                    }
                }
                else
                {
                    $msg="کد بازیابی مجدد هر 2 دقیقه ارسال خواهد شد";
                    $errorStatus="danger";
                    return view('resetPasswordbySMS')
                                ->with('msg', $msg)
                                ->with('errorStatus', $errorStatus)
                                ->with('tel',$user->tel);
                }
            }
            return back()
                ->with('tel',$user->tel);
        }
        else
        {
            alert()->error("شماره همراه وارد شده در سیستم موجود نمی باشد")->persistent('بستن');
            return back()
                ->with('tel',$user->tel);
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
                            ->with('errorStatus','danger')
                            ->with('tel',$request['tel']);
            }
            else {
                $date = ($verify['created_at']);

                $checkDays = $date->addMinutes(2);

                if($checkDays>Carbon::now()){
                    $user=$this->get_user($request['tel'],NULL,NULL,NULL,true);
                    $user['password'] = Hash::make($request['password']);
                    $status = $user->save();
                    if ($status)
                    {
                        $msg = "رمز با موفقیت تغییر کرد";
                        $errorStatus = "success";
                        alert()->success('رمز با موفقیت تغییر کرد')->persistent('بستن');
                        return redirect('/login')
                                ->with('msg', $msg)
                                ->with('errorStatus', $errorStatus);
                    }
                    else
                    {
                        $msg = "خطا در تغییر رمز عبور";
                        $errorStatus = "danger";
                        return view('resetPasswordbySMS')
                            ->with('msg', $msg)
                            ->with('errorStatus', $errorStatus)
                            ->with('tel',$request['tel']);
                    }

                } else {
                    $msg = "کد بازیابی شما منقضی شده است";
                    $errorStatus = "danger";
                    return redirect('/password/reset')
                        ->with('msg', $msg)
                        ->with('errorStatus', $errorStatus)
                        ->with('tel',$request['tel']);
                }
            }
        }
    }


    public function verifyCreate(Request $request)
    {
        $this->validate($request,[
            'type' =>'required|string'
        ]);

        //غیرفعال کردن کدهای قبلی
        verify::where('type','=',$request->type)
            ->where('verify','=',0)
            ->update(['verify'=>1]);


        $six_digit_random_number = mt_rand(100000, 999999);
        $status=verify::create($request->all()+[
                'code'      =>$six_digit_random_number,
                'date_fa'   =>$this->dateNow,
                'time_fa'   =>$this->timeNow,
                'tel'       =>Auth::user()->tel,
            ]);
        if($status) {
            $msg = NULL;
            switch ($request->type) {
                case 'event':
                    $msg = " کد فعال سازی شما در رویداد '" . $request->event . "' فراکوچ \n " . $six_digit_random_number;
                    break;
            }
            if (!is_null($msg)) {
                $this->sendSms(Auth::user()->tel, $msg);
                return "<div class='alert '></div>";
            }
        }


    }

    public function verifyStore(Request $request)
    {
        $this->validate($request,[
            'code'  =>'required|numeric',
            'type'  =>'required|string'
        ]);


        $verify=verify::where('type','=',$request->type)
                ->where('code','=',$request->code)
                ->where('verify','=',0)
                ->latest()
                ->first();
        if($verify)
        {
            return $verify;
        }
        else
        {
            return NULL;
        }


    }

    //کد فعال سازی شماره لندینگ ها
    public function store_landings(Request $request)
    {
        $six_digit_random_number = mt_rand(100000, 999999);

        $this->validate($request,
            [
                'tel' => 'required|iran_mobile'
            ]
        );

        $status = verify::create(
            [
                'tel' => $request->tel,
                'type' => 'landing',
                'code' => $six_digit_random_number,
                'date_fa' => $this->dateNow,
                'time_fa' => $this->timeNow
            ]);
        if ($status) {
            landPage::create(
                [
                    'tel' => $request->tel,
                    'resource' => 'جایزه',
                ]
            );
            $message = "کد فعالی سازی شما در سیستم فراکوچ : " . $six_digit_random_number;
            $this->sendSms($request->tel, $message);
            return view('verifyAjax')
                ->with('tel', $request->tel);
        } else {
            echo('<div  class="alert alert-danger">خطا</div>');
        }
    }


    public function checkCode_landings($code)
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
                echo "<script> $('#tel_verified').val('".$verify->tel."');$('#bodyActiveSms').hide();$('#submitVerifySMS').hide();$('#tel_landing').hide();   $('#frm_tel_landing').show();    </script>";
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
