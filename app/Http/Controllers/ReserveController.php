<?php

namespace App\Http\Controllers;

use App\cart;
use App\checkout;
use App\coach;
use App\event;
use App\eventreserve;
use App\homework;
use App\notification;
use App\Notifications\sendMessageNotification;
use App\order;
use App\reserve;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\booking;
use App\coupon;
use SweetAlert;

class ReserveController extends BaseController
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
        dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\reserve  $reserve
     * @return \Illuminate\Http\Response
     */
    public function show(reserve $reserve)
    {

        switch($reserve->type_booking)
        {
            case '1':$reserve->type_booking='حضوری';
                break;
            case '2':$reserve->type_booking='آنلاین';
                break;
            case '0':$reserve->type_booking='فرقی ندارد';
                break;
            default:$reserve->type_booking='خطا';
                break;
        }


        $booking=booking::leftjoin('feedback_coachings','bookings.id','=','feedback_coachings.booking_id')
                    ->where('booking_id','=',$reserve['booking_id'])
                    ->first();

//        $user_coach=$this->get_user_byID($reserve->user_id);


        $homework=homework::where('booking_id','=',$reserve->booking_id)
            ->where('type','=','booking')
            ->orderby('id')
            ->get();

//        $dateNow=$this->dateNow;
        return view('user.showReserveUser')
                    ->with('reserve',$reserve)
//                    ->with('dateNow',$dateNow)
                    ->with('booking',$booking)
                    ->with('homework',$homework);
//                    ->with('user_coach',$user_coach);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\reserve  $reserve
     * @return \Illuminate\Http\Response
     */
    public function edit(reserve $reserve)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\reserve  $reserve
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, reserve $reserve)
    {
        //$reserve->booking->coach->user);
        $this->validate($request,[
            'presession'    =>'required|string|'
        ]);
        $status=$reserve->update($request->all());
        if($status)
        {
            //$reserve->notify(new sendMessageNotification(Auth::user()->tel,'شما در پورتال فراکوچ یک پیام خصوصی دارید.'."\nنام کاربری شماره همراه شما"."\n my.faracoach.com"));
            $this->send_notification($reserve->booking->coach->user->id,'فرم پیش جلسه کد'.$reserve->booking->id." درسیستم ثبت شد ");
            alert()->success('فرم پیش جلسه با موفقیت ثبت شد')->persistent('بستن');
        }
        else
        {
            alert()->error('خطا در ثبت فرم پیش جلسه')->persistent('بستن');
        }

        return back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\reserve  $reserve
     * @return \Illuminate\Http\Response
     */
    public function destroy(reserve $reserve)
    {
        if($reserve->user_id==Auth::user()->id)
        {
            $status=$reserve->delete();
            if($status)
            {
                  alert()->success('زمان مورد نظر حذف شد')->persistent('بستن');
            }
            else
            {
                  alert()->error('خطا در حذف زمان رزرو شده مورد نظر')->persistent('بستن');
            }

        }
        else
        {
            alert()->error('شما مجاز به حذف این مورد نیستید')->persistent('بستن');
        }

        return back();
    }

    //محاسبه قیمت و ثبت اطلاعات
    public  function mohasebe(Request $request)
    {
        $this->validate($request,
            [
                'booking_id'    =>'required|numeric',
                'subject'       =>'required|string',
                'type_booking'  =>'required|numeric',
                'details'       =>'nullable|string',
            ]
        );


        //حذف سبد خرید
        reserve::where('user_id','=',Auth::user()->id)
            ->where('status', '=', 0)
            ->delete();




        $reserve=reserve::where('booking_id','=',$request['booking_id'])
                            ->where('user_id','=',Auth::user()->id)
                            ->first();

        $booking=booking::where('id','=',$request['booking_id'])
                        ->first();


        //بررسی کاربر برای تعیین نوع جلسه معارفه یا کوچینگ
        $user=reserve::join('bookings','reserves.booking_id','=','bookings.id')
                        ->join('users','bookings.user_id','=','users.id')
                        ->where('bookings.user_id','=',$booking->coach->user->id)
                        ->where('reserves.user_id','=',Auth::user()->id)
                        ->where('reserves.status','<>',4)
                        ->first();


//            booking::join('users','bookings.user_id','=','users.id')
//                            ->join('reserves','bookings.id','=','reserves.booking_id')
//                            ->where('reserves.user_i','=',Auth::user()->id )
//                            ->where(function($query)
//                            {
//                                return $query->orwhere('reserves.status','=','3')
//                                        ->orwhere('reserves.status','=','1');
//                            })
//                            ->first();



        if(!$user)
        {
            $duration_booking=1;
            $booking=booking::where('id','=',$request->booking_id)
                ->first();

            //تعیین میزان تخفیف برای جلسات معارفه
            $introduction_discount = ($booking->coach->fi * $booking->coach->introduction_discount) / 100;
            $fi=$booking->coach->fi-$introduction_discount;
        }
        else
        {
            $duration_booking=2;
            $booking=booking::where('id','=',$request->booking_id)
                        ->first();
            $fi=$booking->coach->fi;
        }

        $off=0;
        $final_off=$fi-$off;



        if($request->type_booking==1)
        {
            $extra=$booking->coach->extra_presence;
            $final_off=(($final_off*$extra)/100)+$final_off;
        }


        if(is_null($reserve))
        {

            $reserve = reserve::create($request->all()+
                [
                    'user_id'           => Auth::user()->id,
                    'final_off'         =>$final_off,
                    'fi'                =>$fi,
                    'duration_booking'  =>$duration_booking,
                ]);
            $status=$reserve ;

        }
        else
        {

            $status=$reserve->update($request->all()+[
                'user_id'           => Auth::user()->id,
                'final_off'         =>$final_off,
                'fi'                =>$fi,
                'duration_booking'  =>$duration_booking,
            ]);

        }

        if($status)
        {
            return "<script>window.location='/cart'</script>";

        }
        else
        {
            return ('<div class="alert alert-danger">خطا در محاسبه</div>');
        }
    }


    //ثبت نهایی رزرو
    public  function insert(Request $request)
    {
        $cart = (Auth::user()->reserves->where('status','=',0));

        foreach ($cart as $item)
        {
            $reserve = reserve::where('booking_id', '=', $item['booking_id'])
                ->first();

            if ($reserve->status == 0)
            {
                $user = booking::join('users', 'bookings.user_id', '=', 'users.id')
                    ->join('coaches', 'users.id', '=', 'coaches.user_id')
                    ->where('bookings.id', '=', $item['booking_id'])
                    ->first();


                $fi = $item->final_off;
                $off = 0;
                $final_off = $fi - $off;

                if($final_off==0)
                {
                    if ($reserve->duration_booking == 1) {
                        $duration = 'جلسه معارفه';
                    } else {
                        $duration = 'جلسه کوچینگ';
                    }

                    $reserve->update(
                        [
                            'status' => 1,
                        ]);
                    $status = $reserve->save();


                    if ($status)
                    {
                        $booking = booking::where('id', '=', $reserve->booking->id)
                            ->first();
                        $booking->status = 0;
                        $booking->save();
                    }
                }

                elseif($final_off<100)
                {
                    alert()->warning('حداقل پرداختی 100 تومان می باشد');
                    return back();
                }
                else
                {

                    return  $this->checkoutStore($reserve->id,$final_off,Auth::user(),'reserve',NULL,'رزرو جلسه');
                }
            } else
            {
                alert()->error('این وقت رزرو شده است')->persistent('بستن');
                return back();
            }



            if ($status) {
                if ($reserve->duration_booking == 1) {
                    $duration = 'جلسه معارفه';
                } else {
                    $duration = 'جلسه کوچینگ';
                }

                //                //ارسال پیامک به کوچ
                $msg =$duration . " \n " . $reserve->booking->start_date . " \n  " . $reserve->booking->start_time . "\n مراجع:" . Auth::user()->fname . " " . Auth::user()->lname . "\n تماس کوچ:" .  Auth::user()->tel;
                $this->sendSms($reserve->booking->coach->user->tel, $msg);

                //                //ارسال پیامک برای مراجع
                $msg =$duration . " \n " . $reserve->booking->start_date . " \n " . $reserve->booking->start_time . "\n کوچ: " . $reserve->booking->coach->user->fname . " " . $reserve->booking->coach->user->lname . "\nتماس:" .$reserve->booking->coach->user->tel;
                $this->sendSms(Auth::user()->tel, $msg);

                //ارسال پیامک برای حسام
                $msg=$duration . " \n " . $booking->start_date . " \n  " . $booking->start_time . "\n کوچ:" . $user->fname . " " . $user->lname . "\n مراجع ".Auth::user()->fname . " " . Auth::user()->lname . "\nتماس:" .Auth::user()->tel;
                $this->sendSms('+989101769020', $msg);

                //ارسال پیامک برای یوسفی
                $msg=$duration . " \n " . $booking->start_date . " \n  " . $booking->start_time . "\n کوچ:" . $user->fname . " " . $user->lname . "\n مراجع ".Auth::user()->fname . " " . Auth::user()->lname . "\nتماس:" .Auth::user()->tel;
                $this->sendSms('+989151060792', $msg);
            } else {
                alert()->error('خطا در محاسبه')->persistent('بستن');
                return back();
            }
        }


        alert()->success('رزرو با موفقیت انجام شد')->persistent('بستن');
//        return $this->checkout(Auth::user()->id,$reserve->id,$reserve->final_off,'جلسه',Auth::user()->email,Auth::user()->tel,$duration.$user->fname . " " . $user->lname);
        return '<script>window.location="/"</script>';
    }


    //ثبت نتیجه جلسه توسط خود کوچ
    public function result_coach (Request $request,Reserve $reserve)
    {


        $this->validate($request, [
            'result_coach' => 'required|string|',
            'score' => 'required|numeric|between:1,5',
            'status' => 'required|numeric|between:1,4'

        ], [
            'result_coach.required' => 'نتیجه جلسه الزامی است',
            'result_coach.string' => 'نتیجه جلسه را درست وارد کنید',
            'score.required' => 'امتیاز  جلسه را وارد کنید',
            'score.numeric' => 'امتیاز جلسه باید عدد باشد',
            'score.between' => 'وضعیت باید بین 1 تا 5 باشد',
            'status.required' => 'وضعیت  جلسه را وارد کنید',
            'status.numeric' => 'وضعیت جلسه باید عدد باشد',
            'status.between' => 'وضعیت جلسه باید بین 1 تا 5 باشد'
        ]);
        $coach = coach::where('user_id','=',Auth::user()->id)
                        ->first();

//            $this->get_coach(NULL, , NULL, NULL, 'first');
        $coach->count_meeting=$coach->count_meeting+1;
        $coach->save();


        if ($coach) {

            $status = $reserve->update($request->all());
            $booking = $reserve->booking;
            $user=User::join('reserves','reserves.user_id','=','users.id')
                ->join('bookings','bookings.id','=','reserves.booking_id')
                ->where('bookings.id', '=', $reserve->booking->id)
                ->select('users.*')
                ->first();

            $booking->status = $request->status;
            $booking->save();


            if ($status)
            {
                if($request->status=="3")
                {
                    $coach->count_meeting=$coach->count_meeting+1;
                    $coach->save();

                    $msg='لطفا نسبت به تکمیل فرم ارزیابی جلسه '.$booking->start_date." اقدام نمایید \n فراکوچ ";
                    $this->sendSms($user->tel,$msg);

                }



                alert()->success('گزارش جلسه با موفقیت ثبت شد', 'پیام')->persistent('بستن');
            } else {
                alert()->error('خطا در ثبت گزارش جلسه', 'خطا')->persistent('بستن');
            }
        }
        else
        {
            alert()->error('خطا در در یافتن اطلاعات کوچ موردنظر', 'خطا')->persistent('بستن');
        }

        return back();
    }



    //نمایش دوره های ثبت نام ناقص
    public function waiting()
    {
        $reserve=reserve::join('bookings','reserves.booking_id','=','bookings.id')
                        ->where('reserves.status','=',0)
                        ->select('bookings.*','reserves.id as id_reserves','reserves.status as reserve_status')
                        ->orderby('reserves.id','desc')
                        ->paginate($this->countPage());

        foreach ($reserve as $item)
        {
            switch ($item->duration_booking)
            {
                case '1':
                    $item->duration_booking = 'معارفه 30 دقیقه ای';
                    break;
                case '2':
                    $item->duration_booking = 'کوچینگ 60 دقیقه ای';
                    break;
            }

            switch ($item->reserve_status)
            {
                case '1':$item->caption_status='رزرو شده';
                        break;
                case '0':$item->caption_status='رزرو ناقص';
                    break;
            }
        }
        $dateNow=$this->dateNow;
        return view('admin.reserves')
                    ->with('booking',$reserve)
                    ->with('dateNow',$dateNow);
    }

    public function showCart()
    {
        if(Auth::check())
        {
            //چک کردن تعداد رزروهای ناقص کامل نشده در سبد خرید
            $cart = (Auth::user()->reserves->where('status', '=', 0));
            if ($cart->count() == 0) {
                alert()->warning('سبد خرید شما خالی می باشد')->persistent('بستن');
                return redirect('/coaches/all');
            } else {
                return view('cart')
                    ->with('cart', $cart);
            }
        }
        else
        {
            alert()->warning('لطفا ابتدا وارد سایت شوید')->persistent('بستن');
            return redirect('/');
        }
    }

    public function test()
    {
        $reserve=checkout::get();

        foreach($reserve as $item)
        {
            //$user=$this->get_user(NULL,$item->user_id,NULL,NULL,'first');
            $booking=order::where('id','=',$item->order_id)
                        ->first();
            if(is_null($booking))
            {
                echo "<script>console.log(USER=".$item.");</script>";
            }
        }
    }


}
