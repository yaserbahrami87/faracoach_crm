<?php

namespace App\Http\Controllers;

use App\booking;
use App\cart;
use App\checkout;
use App\course;
use App\eventreserve;
use App\faktor;
use App\lib\zarinpal;
use App\reserve;
use App\student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use nusoap_client;

class CheckoutController extends BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

//        $Amount=100;
//        $Email=Auth::user()->email;
//        $Mobile=Auth::user()->tel;
//        $Description="فروش";
//
//        //Redirect to URL You can do it also by creating a form
//        $order = new zarinpal();
//
//        $res = $order->pay($Amount,$Email,$Mobile,$Description);
//
//        $status=checkout::create([
//            'user_id'       =>Auth::user()->id,
//            'price'         =>100,
//            'authority'     =>$res,
//            'description'   =>$Description,
//        ]);
//        if($status)
//        {
//            return redirect('https://www.zarinpal.com/pg/StartPay/' . $res);
//        }
//        else
//        {
//            return redirect('/');
//        }

        if($request->start_date)
        {
            $this->validate($request,[
                'start_date'    =>'required|string',
            ]);
            $request['start_date']=explode(' ~ ',$request['start_date']);

            $startMonth=$request['start_date'][0];
            $startMonth=($this->changeTimestampToMilad($startMonth).' 00:00:00');
            $endtMonth=$request['start_date'][1];
            $endtMonth=$this->changeTimestampToMilad($endtMonth).' 23:59:59';

        }
        else
        {
            $MiladiDateNow=Carbon::now();
            $startMonth=$MiladiDateNow->startOfMonth();
            $MiladiDateNow=Carbon::now();
            $endtMonth=($MiladiDateNow->endOfMonth());


        }


        $checkout=checkout::wherebetween('created_at',[$startMonth,$endtMonth])
                            ->orderby('checkouts.id','desc')
                            ->get();

        foreach ($checkout as $item)
        {
//             switch ($item->type)
//             {
//                 case 'event':$item->product=$this->get_events($item->product_id,NULL,NULL,NULL,NULL,NULL,'first')->event;
//                                break;
//                 default:$item->product='خطا';
//                                break;
//             }

             $item->dateTime=($this->changeTimestampToShamsi($item->created_at));
        }

        //پرداخت های انجام شده درگاه
        $checkoutAccess=checkout::wherebetween('created_at',[$startMonth,$endtMonth])
            ->where('status','=',1)
            ->orderby('checkouts.id','desc')
            ->get();

        foreach ($checkoutAccess as $item)
        {
            $item->dateTime=($this->changeTimestampToShamsi($item->created_at));
        }


        return view('admin.checkout.checkout_list')
                    ->with('checkoutAccess',$checkoutAccess)
                    ->with('checkout',$checkout);

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
        $order = new zarinpal();
        $res = $order->pay($Amount,$Email,$Mobile,$Description);

        $status=checkout::create([
            'user_id'       =>Auth::user()->id,
            'product_id'    =>$request->booking_id,
            'price'         =>$Amount,
            'type'          =>$type,
            'authority'     =>$res,
            'description'   =>$Description,
        ]);

        if($status)
        {
            echo ($res);
//            echo "<script>window.location='https://www.zarinpal.com/pg/StartPay/'+$res</script>";
            return redirect('https://www.zarinpal.com/pg/StartPay/' . $res);
        }
        else
        {
            return redirect('/');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function show(checkout $checkout)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function edit(checkout $checkout)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, checkout $checkout)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function destroy(checkout $checkout)
    {
        //
    }

    public function callback(Request $request)
    {

        $MerchantID = '16dd8032-0e0b-11e9-9da0-005056a205be';
        $Authority =$request->get('Authority') ;

        $checkout=checkout::where('authority','=',$Authority)
                        ->get();




        if(($checkout)->count()>0)
        {
            //ما در اینجا مبلغ مورد نظر را بصورت دستی نوشتیم اما در پروژه های واقعی باید از دیتابیس بخوانیم
//        $Amount = 500;
            //$Amount = $checkout->price;
            if ($request->get('Status') == 'OK')
            {

                $client = new nusoap_client('https://www.zarinpal.com/pg/services/WebGate/wsdl', 'wsdl');
                $client->soap_defencoding = 'UTF-8';


                foreach ($checkout as $item)
                {
                    $sumFi=$item->price;
                }


                //در خط زیر یک درخواست به زرین پال ارسال می کنیم تا از صحت پرداخت کاربر مطمئن شویم
                $result = $client->call('PaymentVerification', [
                    [
                        //این مقادیر را به سایت زرین پال برای دریافت تاییدیه نهایی ارسال می کنیم
                        'MerchantID' => $MerchantID,
                        'Authority' => $checkout[0]->authority,
                        'Amount' => $sumFi,
                    ],
                ]);


                if ($result['Status'] == 100)
                {
                    foreach ($checkout as $item) {

                        $item->status = 1;
                        $item->description = 'خرید انجام شد';
                        $item->save();

//                        $check = checkout::where('authority', '=', $request->get('Authority'))
//                                        ->get();



                        if ($item->type == 'event')
                        {
                            $event = $this->get_events($item->product_id, NULL, NULL, NULL, NULL, NULL, 'first');
                            $status = eventreserve::create([
                                'user_id'   => Auth::user()->id,
                                'event_id'  => $event->id,
                                'date_fa'   => $this->dateNow,
                                'time_fa'   => $this->timeNow,
                            ]);
                            if ($status) {
                                $event->capacity--;
                                $event->save();
                                $msg = Auth::user()->lname . " عزیز \nثبت نام شما در " . $event->event . " با موفقیت انجام شد\n فراکوچ ";
                                $this->sendSms(Auth::user()->tel, $msg);
                                alert()->success('رزرو دوره با موفقیت انجام شد')->persistent('بستن');

                            } else {
                                alert()->error('خطا در ثبت واریزی')->persistent('بستن');

                            }

                        } else if ($item->type == 'course')
                        {

                            $status=student::create(
                                [
                                    'user_id'       =>Auth::user()->id,
                                    'course_id'     =>$item->product_id,
                                    'date_fa'       =>$this->dateNow,
                                    'time_fa'       =>$this->timeNow,
                                ]
                            );

                            if(!is_null($item->order->tedad_ghest))
                            {
                                $v=verta();
                                for ($i=0;$i<$item->order->tedad_ghest;$i++)
                                {

                                    $v=$v->addMonths(1);
                                    $Date=$v->format('Y/m/d');
                                    faktor::create([
                                        'user_id'           =>Auth::user()->id,
                                        'checkout_id'       =>$item->id,
                                        'product_id'        =>$item->product_id,
                                        'type'              =>'course',
                                        'date_createfaktor' =>$this->dateNow,
                                        'date_faktor'       =>$Date,
                                        'fi'                =>$item->order->fi_ghest,
                                    ]);
                                }
                            }
                        }
                        else if ($item->type == 'ghest')
                        {
                            $faktor=faktor::where('id','=',$item->order_id)
                                        ->where('user_id','=',Auth::user()->id)
                                        ->first();
                            if(is_null($faktor))
                            {
                                $msg='<p>خطا در بروزرسانی فاکتور اقساط</p>';
                                $alert='danger';
                                return view('callBackCheckout')
                                    ->with('msg',$msg)
                                    ->with('alert',$alert);
                            }
                            else
                            {
                                $faktor->authority=$Authority;
                                $faktor->description='پرداخت شده';
                                $faktor->date_pardakht=$this->dateNow;
                                $faktor->time_pardakht=$this->timeNow;
                                $faktor->checkout_id_pardakht=$item->id;
                                $faktor->status=1;
                                $faktor->save();
                                $msg='<p>پرداخت با موفقیت انجام شد</p><p>شماره پیگیری: '.$item->authority.'</p>';
                                $alert='success';
                                return view('callBackCheckout')
                                    ->with('msg',$msg)
                                    ->with('alert',$alert);
                            }

                        }
                        else if ($item->type == 'reserve')
                        {
                            $reserve=reserve::where('id','=',$item->product_id)
                                            ->first();
                            $reserve->update(
                                [
                                    'status' => 1,
                                ]);
                            $status = $reserve->save();


                            if ($status) {
                                $booking = booking::where('id', '=', $reserve->booking_id)
                                            ->first();
                                $booking->status = 0;
                                $booking->save();
                            }

                            if ($reserve->type_booking == 1) {
                                $duration = 'جلسه معارفه';
                            } else {
                                $duration = 'جلسه کوچینگ';
                            }

                            $user = booking::join('users', 'bookings.user_id', '=', 'users.id')
                                ->join('coaches', 'users.id', '=', 'coaches.user_id')
                                ->where('bookings.id', '=', $reserve->booking_id)
                                ->first();

//                //ارسال پیامک برای کوچ
                            $msg =$duration . " \n " . $booking->start_date . " \n ساعت " . $booking->start_time . "\n " . Auth::user()->fname . " " . Auth::user()->lname . "\nتماس:" .Auth::user()->tel;
                            $this->sendSms($booking->coach->user->tel, $msg);
//
//                //ارسال پیامک به مراجع
                            $msg =$duration . " \n " . $booking->start_date . " \n  " . $booking->start_time . "\n کوچ:" . $user->fname . " " . $user->lname . "\n تماس کوچ:" .  $booking->coach->user->tel;
                            $this->sendSms(Auth::user()->tel, $msg);
                            //ارسال پیامک برای حسام
                            $msg=$duration . " \n " . $booking->start_date . " \n  " . $booking->start_time . "\n کوچ:" . $user->fname . " " . $user->lname . "\n مراجع ".Auth::user()->fname . " " . Auth::user()->lname . "\nتماس:" .Auth::user()->tel;
                            $this->sendSms('+989101769020', $msg);

                            //ارسال پیامک برای یوسفی
                            $msg=$duration . " \n " . $booking->start_date . " \n  " . $booking->start_time . "\n کوچ:" . $user->fname . " " . $user->lname . "\n مراجع ".Auth::user()->fname . " " . Auth::user()->lname . "\nتماس:" .Auth::user()->tel;
                            $this->sendSms('+989151060792', $msg);

                            $msg='<p>جلسه کوچینگ با موفقیت انجام شد</p><p>شماره پیگیری: '.$item->authority.'</p>';
                            $alert='success';

                            return view('callBackCheckout')
                                ->with('msg',$msg)
                                ->with('alert',$alert);

                        }
                        else if($item->type=='scholarship_payment')
                        {
                            $status=student::create(
                                [
                                    'user_id'       =>Auth::user()->id,
                                    'course_id'     =>$item->product_id,
                                    'date_fa'       =>$this->dateNow,
                                    'time_fa'       =>$this->timeNow,
                                ]
                            );

                            $v=verta();
                            if($item->schoalrshipPayment->type_payment==0)
                            {
                                $v=$v->addMonths(1);
                                $Date=$v->format('Y/m/d');
                                faktor::create(
                                    [
                                        'user_id'           =>Auth::user()->id,
                                        'checkout_id'       =>$item->id,
                                        'product_id'        =>$item->product_id,
                                        'type'              =>'course',
                                        'date_createfaktor' =>$this->dateNow,
                                        'date_faktor'       =>$Date,
                                        'fi'                =>$item->schoalrshipPayment->remaining,
                                    ]);
                            }
                            else
                            {
                                for ($i=1;$i<=2;$i++)
                                {
                                    $v=$v->addMonths(1);
                                    $Date=$v->format('Y/m/d');
                                    faktor::create(
                                        [
                                            'user_id'           =>Auth::user()->id,
                                            'checkout_id'       =>$item->id,
                                            'product_id'        =>$item->product_id,
                                            'type'              =>'course',
                                            'date_createfaktor' =>$this->dateNow,
                                            'date_faktor'       =>$Date,
                                            'fi'                =>($item->schoalrshipPayment->remaining)/2,
                                        ]);
                                }
                            }


                            $scholarship=$item->user->scholarship;
                            $scholarship->financial=$Authority;
                            $scholarship->save();
                            $course=course::where('id','=',$item->product_id)
                                        ->first();

                            $student=student::where('course_id','=',$item->product_id)
                                        ->count();
                            $msg=$item->user->fname.' '.$item->user->lname."\n"."دوره:".$course->course."\n نفر:$student ";
                            $this->sendSms("09153159020",$msg);
                            $this->sendSms("09198906540",$msg);
                            $this->sendSms($item->user->get_followbyExpert->tel,$msg);
                        }
                    }


                    $msg='<p>پرداخت با موفقیت انجام شد</p><p>شماره پیگیری: '.$item->authority.'</p>';
                    $alert='success';
                    return view('callBackCheckout')
                                ->with('msg',$msg)
                                ->with('alert',$alert);

                }
                else
                {
                    foreach ($checkout as $item) {
                        $item->description = 'خطا در انجام عملیات';
                        $item->save();

                    }
                    $msg='<p>خطا در انجام عملیات</p>';
                    $alert='danger';
                    return view('callBackCheckout')
                        ->with('msg',$msg)
                        ->with('alert',$alert);
                }
            } else {
                foreach ($checkout as $item)
                {
                    $item->description='انصراف از پرداخت';
                    $item->save();
                }

                $msg='<p>انصراف از پرداخت</p>';
                $alert='danger';
                return view('callBackCheckout')
                    ->with('msg',$msg)
                    ->with('alert',$alert);
            }
        }
        else
        {
            $msg="خطا در کد رهگیری";
            $alert='danger';
            return view('callBackCheckout')
                ->with('msg',$msg)
                ->with('alert',$alert);

        }
    }

    //پرداخت اقساط دوره
    public function storeAghsat(Request $request)
    {

        $this->validate($request,[
            'faktor_id'     =>'required|numeric'
        ]);

        $faktor=faktor::where('id','=',$request->faktor_id)
                    ->first();
        if(is_null($faktor))
        {
            alert()->error('فاکتور اشتباه است')->persistent('بستن');
            return back();
        }
        else
        {
            $order = new zarinpal();
            $res = $order->pay($faktor->fi, Auth::user()->email, Auth::user()->tel,'پرداخت قسط');
            $status=checkout::create([
                'user_id'       =>Auth::user()->id,
                //شماره آیدی فاکتور بجای order_id در اقساط ساب میشود
                'order_id'      =>$faktor->id,
                'product_id'    =>$faktor->product_id,
                'price'         =>$faktor->fi,
                'type'          =>'ghest',
                'authority'     =>$res,
                'description'   =>'انتقال به درگاه',
            ]);

            if($status)
            {
                return redirect('https://www.zarinpal.com/pg/StartPay/' . $res);
            }
            else
            {
                alert()->error('خطا در پرداخت فاکتور اقساط')->persistent('بستن');
                return redirect('/');
            }
        }

    }


    public function transactionsUser()
    {
        $checkouts=checkout::where('user_id','=',Auth::user()->id)
            ->where('status','=',1)
            ->orderby('id','desc')
            ->get();

        return view('user.financial.transactions')
                    ->with('checkouts',$checkouts);
    }
}
