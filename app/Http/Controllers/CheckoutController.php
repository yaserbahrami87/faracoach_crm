<?php

namespace App\Http\Controllers;

use App\booking;
use App\checkout;
use App\eventreserve;
use App\lib\zarinpal;
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
    public function index()
    {
//        $invoice = (new Invoice)->amount(500);
//        $invoice->detail(['detailName' => 'your detail goes here']);
//
//        return Payment::purchase($invoice, function($driver, $transactionId) {
//
//        })->pay()->render();
//
//        // Do all things together in a single line.
//        return Payment::purchase(
//            (new Invoice)->amount(1000),
//            function($driver, $transactionId) {
//            }
//        )->pay()->render();
//
//        // Retrieve json format of Redirection (in this case you can handle redirection to bank gateway)
//        return Payment::purchase(
//            (new Invoice)->amount(1000),
//            function($driver, $transactionId) {
//
//            }
//        )->pay()->toJson();


        $Amount=100;
        $Email=Auth::user()->email;
        $Mobile=Auth::user()->tel;
        $Description="فروش";

        //Redirect to URL You can do it also by creating a form
        $order = new zarinpal();

        $res = $order->pay($Amount,$Email,$Mobile,$Description);

        $status=checkout::create([
            'user_id'       =>Auth::user()->id,
            'price'         =>100,
            'authority'     =>$res,
            'description'   =>$Description,
        ]);
        if($status)
        {
            return redirect('https://www.zarinpal.com/pg/StartPay/' . $res);
        }
        else
        {
            return redirect('/');
        }
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
                        ->first();
        if(!is_null($checkout)) {
            //ما در اینجا مبلغ مورد نظر را بصورت دستی نوشتیم اما در پروژه های واقعی باید از دیتابیس بخوانیم
//        $Amount = 500;
            $Amount = $checkout->price;
            if ($request->get('Status') == 'OK')
            {
                $client = new nusoap_client('https://www.zarinpal.com/pg/services/WebGate/wsdl', 'wsdl');
                $client->soap_defencoding = 'UTF-8';


                //در خط زیر یک درخواست به زرین پال ارسال می کنیم تا از صحت پرداخت کاربر مطمئن شویم
                $result = $client->call('PaymentVerification', [
                    [
                        //این مقادیر را به سایت زرین پال برای دریافت تاییدیه نهایی ارسال می کنیم
                        'MerchantID' => $MerchantID,
                        'Authority' => $checkout->authority,
                        'Amount' => $checkout->price,
                    ],
                ]);


                if ($result['Status'] == 100)
                {
                    $checkout->status = 1;
                    $checkout->description = 'خرید انجام شد';

                    $checkout->save();
                    $check=checkout::where('authority','=',$request->get('Authority'))
                                    ->first();
                    if ($checkout->type=='event')
                    {
                        $event=$this->get_events($checkout->product_id,NULL,NULL,NULL,NULL,NULL,'first');
                        $status = eventreserve::create([
                            'user_id' => Auth::user()->id,
                            'event_id' => $event->id,
                            'date_fa' => $this->dateNow,
                            'time_fa' => $this->timeNow,
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

                    }

//                    $reserve=$this->get_reserve($checkout->product_id,Auth::user()->id,NULL,NULL,NULL,NULL,'first');
//                    $reserve->update(
//                        [
//                            'status' => 1,
//                        ]);
//                    $status=$reserve->save();


//                    if ($status) {
//                        $booking = booking::where('id', '=', $reserve['booking_id'])
//                            ->first();
//                        $booking->status = 0;
//                        $booking->save();
//                    }

//                    if ($status) {
//                        $user = booking::join('users', 'bookings.user_id', '=', 'users.id')
//                            ->join('coaches', 'users.id', '=', 'coaches.user_id')
//                            ->where('bookings.id', '=', $reserve['booking_id'])
//                            ->first();
//
//                        if ($user->duration_booking == 1) {
//                            $duration = 'جلسه معارفه';
//                        } else {
//                            $duration = 'جلسه کوچینگ';
//                        }
//                        //ارسال پیامک برای مشتری
//                        $msg =$duration . " \n " . $booking->start_date . " \n ساعت " . $booking->start_time . "\n " . Auth::user()->fname . " " . Auth::user()->lname . "\nتماس:" .Auth::user()->tel;
//                        $this->sendSms($user->tel, $msg);
//
//                        //ارسال پیامک به کوچ
//                        $msg =$duration . " \n " . $booking->start_date . " \n  " . $booking->start_time . "\n کوچ:" . $user->fname . " " . $user->lname . "\n تماس کوچ:" .  $user->tel;
//                        $this->sendSms(Auth::user()->tel, $msg);
//
//
//
//                    } else {
//                        alert()->error('خطا در محاسبه')->persistent('بستن');
//                        return redirect('/');
//                    }

                    $msg='<p>پرداخت با موفقیت انجام شد</p><p>شماره پیگیری: '.$checkout->authority.'</p>';
                    $alert='success';
                    return view('callBackCheckout')
                                ->with('msg',$msg)
                                ->with('alert',$alert);

                }
                else
                {
//                    return 'خطا در انجام عملیات';
                    $checkout->description='خطا در انجام عملیات';
                    $checkout->save();
                    $msg='<p>خطا در انجام عملیات</p>';
                    $alert='danger';
                    return view('callBackCheckout')
                        ->with('msg',$msg)
                        ->with('alert',$alert);
                }
            } else {
                $checkout->description='انصراف از پرداخت';
                $checkout->save();
                $msg='<p>انصراف از پرداخت</p>';
                $alert='danger';
                return view('callBackCheckout')
                    ->with('msg',$msg)
                    ->with('alert',$alert);
//                return '2خطا در انجام عملیات';
            }
        }
        else
        {
            return "خطا در کد رهگیری";
        }
    }
}
