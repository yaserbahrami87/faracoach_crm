<?php

namespace App\Http\Controllers;

use App\booking;
use App\reserve;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Verta;
use SweetAlert;
use Carbon\Carbon;


class BookingController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // وضعیتstatus مقدار 3 یعنی برگزار شده مقدار 4 یعنی کنسل شده

    public function index()
    {
        if(Auth::user()->type==2) {

            $booking = booking::where('user_id', '=', Auth::user()->id)
                ->where('start_date','>=',$this->dateNow)
                ->orderby('start_date', 'desc')
                ->orderby('start_time', 'desc')
                ->paginate($this->countPage());

            foreach ($booking as $item) {
                switch ($item->status) {
                    case '1':
                        $item->caption_status = 'آماده رزرو';
                        break;
                    case '0':
                        $item->caption_status = 'رزرو شده';
                        break;
                }
                //تعیین وضعیت رزروهایی که تاریخ گذشته و رزرو نشده

//                if (($item->status == 1) && ($item->start_date < $this->dateNow)) {
////                    $item->status = 3;
//                    $item->caption_status = 'باطل شده';
//                }

                switch ($item->duration_booking) {
                    case '1':
                        $item->duration_booking = 'معارفه 30 دقیقه ای';
                        break;
                    case '2':
                        $item->duration_booking = 'کوچینگ 60 دقیقه ای';
                        break;
                }
            }
            return view('panelAdmin.booking')
                ->with('booking', $booking)
                ->with('dateNow', $this->dateNow);
        }
        else
        {

           // وصعیت 1 برای رزرو های در حال رزرو و 0 رزرو شده هاست
            $booking = booking::where('user_id', '=', Auth::user()->id)
                ->where(function($query)
                {
                    $query->orwhere('status','<>',1)
                            ->orwhere('start_date','>=',$this->dateNow);
                })
                ->orderby('start_date', 'desc')
                ->orderby('start_time', 'desc')
                ->paginate($this->countPage());

            foreach ($booking as $item) {
                switch ($item->status) {
                    case '1':
                        $item->caption_status = 'آماده رزرو';
                        break;
                    case '0':
                        $item->caption_status = 'رزرو شده';
                        break;
                    case '3':
                        $item->caption_status = 'برگزارشده';
                        break;
                    case '4':
                        $item->caption_status = 'کنسل شده';
                        break;

                }
                //تعیین وضعیت رزروهایی که تاریخ گذشته و رزرو نشده
//                if (($item->status == 1) && ($item->start_date < $this->dateNow)) {
//                    $item->status = -1;
//                    $item->caption_status = 'باطل شده';
//                }

                switch ($item->duration_booking) {
                    case '1':
                        $item->duration_booking = 'معارفه 30 دقیقه ای';
                        break;
                    case '2':
                        $item->duration_booking = 'کوچینگ 60 دقیقه ای';
                        break;
                }


            }
            return view('panelUser.booking')
                ->with('booking', $booking)
                ->with('dateNow', $this->dateNow);
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
        $this->validate($request,[
            'start_date'      =>'required|',
            'start_time'      =>'required|date_format:H:i',
            'duration_booking'=>'required|numeric|digits_between:1,5'
        ]);

        if($request['duration_booking']==1)
        {
            $duration_booking=30;
        }
        else if($request['duration_booking']==2)
        {
            $duration_booking=60;
        }
        else
        {
            return back();
        }

        $tmp=(explode(' ~ ',$request->start_date));
        $tmp=Arr::sort($tmp);
        foreach ($tmp as $item) {
            $check = booking::where('start_date', '=', $item)
                ->where('user_id','=',Auth::user()->id)
                ->where('start_time', '=', $request['time'])
                ->first();
            if(!is_null($check))
            {
                $msg="تاریخ ".$item." در ساعت ".$request['start_time']." قبلا تنظیم شده است.لطفا تاریخ ها را مجدد تنظیم کنید";
                alert()->error($msg,'خطا')->persistent('بستن');
                return back();
            }
            $carbon = new Carbon($item." ".$request['start_time']);

            $check = booking::where('start_date', '=', $item)
                        ->where('user_id','=',Auth::user()->id)
                        ->where(function($q) use ($request,$carbon,$duration_booking)
                        {
                            $q->orwherebetween('start_time',[$request['start_time'],$carbon->addMinutes($duration_booking)->format('H:i')])
                                ->orwherebetween('start_time',[$carbon->subMinutes(($duration_booking+5))->format('H:i'),$request['start_time']])
                                ->orwherebetween('end_time',[$carbon->format('H:i'),$carbon->addMinutes($duration_booking+5)->format('H:i')]);

                        })
                        ->get();


            if(count($check)!=0)
            {
                $msg="تاریخ ".$item." در ساعت ".$request['start_time']." با ".count($check)."جلسه دیگر دارای تداخل می باشد.لطفا تاریخ ها را مجدد تنظیم کنید";
                alert()->error($msg,'خطا')->persistent('بستن');
                return back();
            }
        }


        foreach ($tmp as $item) {
            $carbon = new Carbon($item." ".$request['start_time']);
            $carbon->addMinutes($duration_booking);

            $status=booking::create(
                [
                'start_date'        =>$item,
                'start_time'        =>$request['start_time'],
                'end_date'          =>$carbon->format('Y/m/d'),
                'end_time'          =>$carbon->format('H:i'),
                'duration_booking'  =>$request['duration_booking'],
                'date_fa'           =>$this->dateNow,
                'time_fa'           =>$this->timeNow,
                'user_id'           =>Auth::user()->id
            ]);
            if($status)
            {
                alert()->success("اطلاعات با موفقیت ثبت شد",'پیام')->persistent('بستن');

            }
            else
            {
                alert()->error("کد ملی / پست الکترونیکی تکراری است",'خطا')->persistent('بستن');
                return back();
            }
        }
        return back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(booking $booking)
    {

        if((Auth::user()->id==$booking->user_id)||(Auth::user()->type==2))
        {
            $booking=booking::join('reserves','bookings.id','=','reserves.booking_id')
                        ->where('bookings.id','=',$booking->id)
                        ->first();

            $reserve=Reserve::join('users','reserves.user_id','=','users.id')
                        ->where('reserves.booking_id','=',$booking['booking_id'])
                        ->first();

            $states=$this->states();
            if(!is_null($reserve->city))
            {
                $reserve['city']=$this->city($reserve->city);
            }

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

            $feedback=booking::join('feedback_coachings','bookings.id','=','feedback_coachings.booking_id')
                ->where('booking_id','=',$booking['booking_id'])
                ->first();


           $dateNow=$this->dateNow;
           $timeNow=$this->timeNow;

           return view('panelUser.InfoReserve')
                        ->with('user',$reserve)
                        ->with('booking',$booking)
                        ->with('states',$states)
                        ->with('feedback',$feedback)
                        ->with('dateNow',$dateNow);

        }
        else
        {
            alert()->error('این رزرو متعلق به شما نمی باشد','خطا')->persistent('بستن');
            return back();
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, booking $booking)
    {

        $this->validate($request,[
            'status'    =>'required|numeric',
        ]);

        $status=$booking->update($request->all());

        if($status)
        {
            $reserve=$this->get_reserve(NULL,NULL,$booking->id,NULL,NULL,NULL,'first');
//                    reserve::where('booking_id','=',$booking->id)
//                                ->first();

            $reserve->status=$request->status;
            $reserve->save();
            if ($reserve->duration_booking == 1) {
                $duration = 'جلسه معارفه';
            } else {
                $duration = 'جلسه کوچینگ';
            }

            $user = booking::join('users', 'bookings.user_id', '=', 'users.id')
                            ->join('coaches', 'users.id', '=', 'coaches.user_id')
                            ->where('bookings.id', '=', $reserve['booking_id'])
                            ->first();

            //ارسال پیامک برای کوچ
            $msg =$duration . " \n " . $user->start_date . " \n " . $user->start_time . "\n " . Auth::user()->fname . " " . Auth::user()->lname . "\nلغو شد" ;
            $this->sendSms($user->tel, $msg);
            //ارسال پیامک به مراجعه
            $msg =$duration . " \n " . $user->start_date . " \n ساعت " . $user->start_time . "\n کوچ:" . $user->fname . " " . $user->lname . "\nلغو شد" ;
            $this->sendSms(Auth::user()->tel, $msg);
            alert()->success('جلسه با موفقیت لغو شد')->persistent('بستن');
        }
        else
        {
            alert()->error('خطا در لغو جلسه')->persistent('بستن');
        }

        return back();//('/panel/booking/accept_reserve_user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(booking $booking)
    {
        if($booking->user_id==Auth::user()->id)
        {
            $status=$booking->delete();
            if($status)
            {
                alert()->success('اطلاعات با موفقیت حذف شد','پیام')->persistent('بستن');
            }
            else
            {
                alert()->error('خطا در حذف اطلاعات','خطا')->persistent('بستن');
            }

            return back();
        }
        else
        {
            alert()->error('شما مجاز به حذف این زمان رزرو نیستید','خطا')->persistent('بستن');
            return back();
        }
    }

    //جستجوی تاریخ برای رزروها
    public function createAjax(Request $request)
    {
        $this->validate($request, [
            'coach' => 'required|numeric',
            'calenderSelector' => 'required|string'
        ]);

        $booking = booking::where('start_date', '=', $request['calenderSelector'])
            ->where('user_id', '=', $request['coach'])
            ->where('status', '=',1)
            ->orderby('start_time', 'asc')
            ->get();

        $user=reserve::join('bookings','reserves.booking_id','=','bookings.id')
                    ->join('users','reserves.user_id','users.id')
                    ->where('reserves.user_id','=',Auth::user()->id)
                    ->where('bookings.duration_booking','=','1')
                    ->where('bookings.status','=','0')
                    ->count();

        //چک کردن تعداد رزروهای ناقص کامل نشده در سبد خرید
        $cart=$this->get_reserve(NULL,Auth::user()->id,NULL,NULL,NULL,0,'get');

        if (count($booking) == 0) {
            return '<div class="alert alert-warning" role="alert">برای این تاریخ ساعت رزرو یافت نشد</div>';
        } else {
            return view('reserveCoaching')
                ->with('booking', $booking)
                ->with('cart', $cart)
                ->with('user',$user);
        }
    }


    public function showFormReserve(Request $request)
    {
        $this->validate($request,[
            'id'    =>'required|numeric',
        ]);
        $booking=booking::find($request['id']);

        return view('formReserve')
                    ->with('booking',$booking);

    }


    public function acceptReserve()
    {
        $booking=booking::join('reserves','bookings.id','=','reserves.booking_id')
                ->join('users','users.id','=','reserves.user_id')
                ->wherein('bookings.status',[0,2,3])
                ->where('bookings.user_id','=',Auth::user()->id)
                ->orderby('bookings.id','desc')
                ->select('bookings.*','users.fname','users.lname','bookings.id as booking_id','users.personal_image')
                ->paginate($this->countPage());

        foreach ($booking as $item)
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

            switch ($item->status)
            {
                case '0':
                    $item->caption_status = 'رزرو شده';
                    break;
                case '3':
                    $item->caption_status = 'برگزار شد';
                    break;
                case '4':
                    $item->caption_status = 'لغو شد';
                    break;
            }
        }
        return view('panelUser.bookingAcceptReserveCoach')
//        return view('panelUser.booking')
                ->with('booking', $booking)
                ->with('dateNow', $this->dateNow);
    }


    //جلسات رزرو شده کاربر ساده
    public function accept_reserve_user()
    {
        $booking=booking::join('users','users.id','=','bookings.user_id')
                ->join('reserves','bookings.id','=','reserves.booking_id')
                ->where('reserves.user_id','=',Auth::user()->id)
                ->where(function($query){
                      $query->orwhere('reserves.status','=',1)
                            ->orwhere('reserves.status','=',3)
                            ->orwhere('reserves.status','=',4);
                })
                ->select('bookings.*','reserves.*','reserves.id as id_reserves','bookings.id as bookings_id','users.fname','users.lname','users.personal_image')
                ->orderby('reserves.id','desc')
                ->paginate($this->countPage());

        foreach ($booking as $item)
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

            switch ($item->status)
            {
                case '1':
                    $item->caption_status = 'رزرو شده';
                    break;
                case '3':
                    $item->caption_status = 'برگزار شد';
                    break;
                case '4':
                    $item->caption_status = 'لغو شد';
                    break;
            }


        }
        return view('panelUser.booking')
            ->with('booking', $booking)
            ->with('dateNow', $this->dateNow);
    }





}
