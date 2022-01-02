<?php

namespace App\Http\Controllers;

use App\booking;
use App\cart;
use App\checkout;
use App\eventreserve;
use App\lib\zarinpal;
use App\student;
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
        $checkout=checkout::join('users','checkouts.user_id','=','users.id')
                            ->orderby('checkouts.id','desc')
                            ->select('checkouts.*','users.fname','users.lname')
                            ->paginate(30);
        foreach ($checkout as $item)
        {
             switch ($item->type)
             {
                 case 'event':$item->product=$this->get_events($item->product_id,NULL,NULL,NULL,NULL,NULL,'first')->event;
                                break;
                 default:$item->product='خطا';
                                break;
             }

             $item->dateTime=($this->changeTimestampToShamsi( $item->created_at));
        }
        return view('admin.checkout.checkout_accept')
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

                        } else if ($item->type == 'course')
                        {

                            $status=student::create(
                                [
                                    'user_id'       =>Auth::user()->id,
                                    'course_id'    =>$item->product_id,
                                    'date_fa'       =>$this->dateNow,
                                    'time_fa'       =>$this->timeNow,
                                ]
                            );
                        }
                    }

                    cart::where('user_id','=',Auth::user()->id)
                                    ->delete();


                    $msg='<p>پرداخت با موفقیت انجام شد</p><p>شماره پیگیری: '.$item->authority.'</p>';
                    $alert='success';
                    return view('callBackCheckout')
                                ->with('msg',$msg)
                                ->with('alert',$alert);

                }
                else
                {
//                    return 'خطا در انجام عملیات';
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
//                return '2خطا در انجام عملیات';
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
}
