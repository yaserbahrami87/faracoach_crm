<?php

namespace App\Http\Controllers;

use App\reserve;
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

        $reserve=reserve::join('bookings','bookings.id','=','reserves.booking_id')
                    ->where('reserves.id','=',$reserve['id'])
                    ->select('reserves.*','bookings.*','reserves.id as id_reserve','reserves.status as status_reserve')
                    ->first();

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

        $user_coach=$this->get_user_byID($reserve->user_id);


        $dateNow=$this->dateNow;
        return view('panelUser.showReserveUser')
                    ->with('reserve',$reserve)
                    ->with('dateNow',$dateNow)
                    ->with('booking',$booking)
                    ->with('user_coach',$user_coach);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\reserve  $reserve
     * @return \Illuminate\Http\Response
     */
    public function destroy(reserve $reserve)
    {
        //
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


        $reserve=reserve::where('booking_id','=',$request['booking_id'])
                            ->where('user_id','=',Auth::user()->id)
                            ->first();
        $count_meeting_fi=$this->get_optionByName('count_meeting');
        $count_meeting_fi=$count_meeting_fi->option_value;

        $customer_satisfaction_fi=$this->get_optionByName('customer_satisfaction');
        $customer_satisfaction_fi=$customer_satisfaction_fi->option_value;

        $change_customer_fi=$this->get_optionByName('change_customer');
        $change_customer_fi=$change_customer_fi->option_value;

        $count_recommendation_fi=$this->get_optionByName('count_recommendation');
        $count_recommendation_fi=$count_recommendation_fi->option_value;

        $user=booking::join('users','bookings.user_id','=','users.id')
                ->join('coaches','users.id','=','coaches.user_id')
                ->where('bookings.id','=',$request['booking_id'])
                ->first();
        $count_meeting=$user->count_meeting;
        $customer_satisfaction=$user->customer_satisfaction;
        $change_customer=$user->change_customer;
        $count_recommendation=$user->count_recommendation;

        $fi=($count_meeting_fi*$count_meeting)+($customer_satisfaction_fi*$customer_satisfaction)+($change_customer_fi*$change_customer)+($count_recommendation_fi*$count_recommendation);
        $off=0;
        $final_off=$fi-$off;

        if(is_null($reserve)) {
            $reserve = reserve::create($request->all()+
                [
                    'user_id'   => Auth::user()->id,
                    'final_off' =>$final_off,
                    'fi'        =>$fi,
                ]);
            $status=$reserve ;

        }
        else
        {
            $status=$reserve->update($request->all()+[
                'user_id'   => Auth::user()->id,
                'final_off' =>$final_off,
                'fi'        =>$fi,
            ]);

        }

        if($status)
        {
            return view('formReserveBills')
                ->with('reserve',$reserve)
                ->with('status',NULL);
        }
        else
        {
            return ('<div class="alert alert-danger">خطا در محاسبه</div>');
        }
    }


    //
    public  function insert(Request $request)
    {

        $this->validate($request,
            [
                'booking_id'    =>'required|numeric',
                'subject'       =>'required|string',
                'type_booking'  =>'required|numeric',
                'details'       =>'nullable|string',
            ]
        );

        $reserve=reserve::where('booking_id','=',$request['booking_id'])
                        ->first();

        if(is_null($reserve)) {
            $status = reserve::create($request->all()+
                [
                    'user_id'       => Auth::user()->id,
                    'status'        =>1
                ]);
        }
        else
        {
            if($reserve->status==0)
            {
                if(!is_null($request['coupon']))
                {
                    $users=booking::join('users','bookings.user_id','=','users.id')
                            ->where('bookings.id','=',$request['booking_id'])
                            ->first();
                    $coupon =coupon::where('coupon','=',$request['coupon'])
                                            ->where('user_id','=',$users->id)
                                            ->first();
                    if(!is_null($coupon))
                    {

                        if ($coupon->count == 0) {
                            return ('<div class="alert alert-danger">تعداد کوپن مورد نظر استفاده شده است</div>');
                        }

                        if ($coupon->count != '-1') {
                            $coupon->count--;
                            $coupon->save();
                        }
                    }
                }


                if(isset($coupon))
                {
                    $count_meeting_fi=$this->get_optionByName('count_meeting');
                    $count_meeting_fi=$count_meeting_fi->option_value;

                    $customer_satisfaction_fi=$this->get_optionByName('customer_satisfaction');
                    $customer_satisfaction_fi=$customer_satisfaction_fi->option_value;

                    $change_customer_fi=$this->get_optionByName('change_customer');
                    $change_customer_fi=$change_customer_fi->option_value;

                    $count_recommendation_fi=$this->get_optionByName('count_recommendation');
                    $count_recommendation_fi=$count_recommendation_fi->option_value;

                    $user=booking::join('users','bookings.user_id','=','users.id')
                        ->join('coaches','users.id','=','coaches.user_id')
                        ->where('bookings.id','=',$request['booking_id'])
                        ->first();
                    $count_meeting=$user->count_meeting;
                    $customer_satisfaction=$user->customer_satisfaction;
                    $change_customer=$user->change_customer;
                    $count_recommendation=$user->count_recommendation;

                    $fi=($count_meeting_fi*$count_meeting)+($customer_satisfaction_fi*$customer_satisfaction)+($change_customer_fi*$change_customer)+($count_recommendation_fi*$count_recommendation);
                    $off=($fi*$coupon->discount)/100;
                    $final_off=$fi-$off;
                    $status=$reserve->update($request->all()+
                    [
                        'status'    =>1,
                        'off'       =>$coupon->discount,
                        'final_off' =>$final_off,
                        'fi'        =>$fi,
                    ]);
                }
                else
                {
                    $count_meeting_fi=$this->get_optionByName('count_meeting');
                    $count_meeting_fi=$count_meeting_fi->option_value;

                    $customer_satisfaction_fi=$this->get_optionByName('customer_satisfaction');
                    $customer_satisfaction_fi=$customer_satisfaction_fi->option_value;

                    $change_customer_fi=$this->get_optionByName('change_customer');
                    $change_customer_fi=$change_customer_fi->option_value;

                    $count_recommendation_fi=$this->get_optionByName('count_recommendation');
                    $count_recommendation_fi=$count_recommendation_fi->option_value;

                    $user=booking::join('users','bookings.user_id','=','users.id')
                        ->join('coaches','users.id','=','coaches.user_id')
                        ->where('bookings.id','=',$request['booking_id'])
                        ->first();
                    $count_meeting=$user->count_meeting;
                    $customer_satisfaction=$user->customer_satisfaction;
                    $change_customer=$user->change_customer;
                    $count_recommendation=$user->count_recommendation;

                    $fi=($count_meeting_fi*$count_meeting)+($customer_satisfaction_fi*$customer_satisfaction)+($change_customer_fi*$change_customer)+($count_recommendation_fi*$count_recommendation);
                    $off=0;
                    $final_off=$fi-$off;

                    $status=$reserve->update($request->all()+
                    [
                        'status'    =>1,
                        'final_off' =>$final_off,
                        'fi'        =>$fi,
                    ]);
                }


                if($status)
                {
                    $booking=booking::where('id','=',$request['booking_id'])
                            ->first();
                    $booking->status=0;
                    $booking->save();

                }
            }
            else
            {
                return ('<div class="alert alert-danger">این وقت رزرو شده است</div>');
            }
        }

        if($status)
        {
            if($user->duration_booking==1)
            {
                $duration='جلسه معارفه';
            }
            else
            {
                $duration='جلسه کوچینگ';
            }
            $this->sendSms($user->tel,'رزرو '.$duration.' در فراکوچ انجام شد');
            return ('<div class="alert alert-success">رزرو با موفقیت انجام شد</div>');
        }
        else
        {
            return ('<div class="alert alert-danger">خطا در محاسبه</div>');
        }
    }


    //ثبت نتیجه جلسه توسط خود کوچ
    public function result_coach (Request $request,Reserve $reserve)
    {

        $this->validate($request,[
            'result_coach'  =>'required|string|persian_alpha',
            'score'         =>'required|numeric|between:1,5',
            'status'        =>'required|numeric|between:1,4'

        ],[
            'result_coach.required'         =>'نتیجه جلسه الزامی است',
            'result_coach.string'           =>'نتیجه جلسه را درست وارد کنید',
            'score.required'                =>'امتیاز  جلسه را وارد کنید',
            'score.numeric'                 =>'امتیاز جلسه باید عدد باشد',
            'score.between'                 =>'وضعیت باید بین 1 تا 5 باشد',
            'status.required'               =>'وضعیت  جلسه را وارد کنید',
            'status.numeric'                =>'وضعیت جلسه باید عدد باشد',
            'status.between'                =>'وضعیت جلسه باید بین 1 تا 5 باشد'
        ]);

        $status=$reserve->update($request->all());

        $booking=booking::where('id','=',$reserve->booking_id)
                ->first();
        $booking->status=$request->status;
        $booking->save();

        if($status)
        {
            alert()->success('گزارش جلسه با موفقیت ثبت شد','پیام')->persistent('بستن');
        }
        else
        {
            alert()->error('خطا در ثبت گزارش جلسه','خطا')->persistent('بستن');
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
        return view('panelAdmin.reserves')
                    ->with('booking',$reserve)
                    ->with('dateNow',$dateNow);
    }
}
