<?php

namespace App\Http\Controllers;

use App\booking;
use App\coupon;
use App\reserve;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SweetAlert;

class CouponController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons=coupon::where('user_id','=',Auth::user()->id)
                ->paginate($this->countPage());
        if(Auth::user()->type==2)
        {
            return view('panelAdmin.coupon')
                ->with('coupons',$coupons);
        }
        else
        {
            return view('panelUser.coupon')
                ->with('coupons',$coupons);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dateNow=$this->dateNow;
        if(Auth::user()->type==2)
        {
            return view('panelAdmin.insertCoupon')
                ->with('dateNow',$dateNow);
        }
        else
        {
            return view('panelUser.insertCoupon')
                ->with('dateNow',$dateNow);
        }

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
            'coupon'        =>'required|string|',
            'discount'      =>'required|numeric|between:0,100',
            'expire_date'   =>'required',
            'product'       =>'required|numeric',
            'limit_user'    =>'required|numeric',
            'count'         =>'nullable|numeric|',
        ]);
        $coupon=coupon::where('coupon','=',$request['coupon'])
                        ->where('user_id','=',Auth::user()->id)
                        ->get();

        if(count($coupon)==0) {
            if(is_null($request['count']))
            {
               $request['count']=-1 ;
            }

            $status = coupon::create($request->all()+
                [
                    'user_id'   =>Auth::user()->id,
                ]);

            if ($status) {
                alert()->success('کوپن با موفقیت ایجاد شد', 'پیام')->persistent('بستن');
            } else {
                alert()->error('خطا در ثبت کوپن', 'خطا')->persistent('بستن');
            }
        }else
        {
            alert()->error('کوپن با این نام قبلا ایجاد شده است','خطا')->persistent('بستن');
        }

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(coupon $coupon)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit(coupon $coupon)
    {
        $coupon=coupon::find($coupon)->first();
        if($coupon->user_id==Auth::user()->id)
        {
            $dateNow=$this->dateNow;
            if(Auth::user()->type==2)
            {
                return view('panelAdmin.editCoupon')
                    ->with('coupon',$coupon)
                    ->with('dateNow',$dateNow);
            }
            else
            {
                return view('panelUser.editCoupon')
                    ->with('coupon',$coupon)
                    ->with('dateNow',$dateNow);
            }

        }
        else
        {
            alert()->error('این کوپن متعلق به شما نیست','خطا')->persistent('بستن');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, coupon $coupon)
    {
        if($coupon->user_id==Auth::user()->id)
        {
            $this->validate($request,[
                'coupon'        =>'required|string|',
                'discount'      =>'required|numeric|between:0,100',
                'expire_date'   =>'required',
                'product'       =>'required|numeric',
                'limit_user'    =>'required|numeric',
                'count'         =>'nullable|numeric|',
            ]);

            $status=$coupon->update($request->all());
            if($status)
            {
                alert()->success('اطلاعات بروزرسانی شد','پیام')->persistent('بستن');
            }
            else
            {
                alert()->error('خطا در بروزرسانی','خطا')->persistent('بستن');
            }
        }
        else
        {
            alert()->error('کوپن متعلق به شما نیست');
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(coupon $coupon)
    {
        if($coupon->user_id==Auth::user()->id)
        {
            $status=$coupon->delete();
            if($status)
            {
                alert()->success('کوپن ما موفقیت حذف شد','پیام')->persistent('بستن');
            }
            else
            {
                alert()->error('خطا در حذف کوپن تخفیف','خطا')->persistent('بستن');
            }
        }
        else
        {
            alert()->error('کوپن تخفیف متعلق به شما نمی باشد','خطا')->persistent('بستن');
        }

        return redirect('/panel/coupon');
    }


    public function check(Request $request)
    {
        $this->validate($request,[
            'coupon'=>'nullable|string'
        ]);

        $users=booking::join('users','bookings.user_id','=','users.id')
                ->where('bookings.id','=',$request['booking_id'])
                ->first();
        $coupon=coupon::where('coupon','=',$request['coupon'])
                ->where('user_id','=',$users->id)
                ->first();


        //اگر کوپن وجود نداشت
        if(is_null($coupon))
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
            $request['coupon']=NULL;


            if(is_null($reserve)) {
                $status = reserve::create($request->all()+
                    [
                        'user_id'   => Auth::user()->id,
                        'final_off' =>$final_off,
                        'fi'        =>$fi,
                    ]);
            }
            else
            {
                $status=$reserve->update($request->all()+
                    [
                        'user_id' => Auth::user()->id,
                        'final_off' =>$final_off,
                        'fi'        =>$fi,
                        'off'       =>NULL
                    ]);
            }

            $msg='کوپن تخفیف موجود نیست';
            $errorStatus='danger';

            return view('reserveFi')
                ->with('msg',$msg)
                ->with('errorStatus',$errorStatus)
                ->with('reserve',$reserve);
        }
        // اگر تعداد کوپن تمام شده بود
        else if($coupon->count==0)
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
            $request['coupon']=NULL;

            if(is_null($reserve)) {
                reserve::create($request->all()+
                    [
                        'user_id'   => Auth::user()->id,
                        'final_off' =>$final_off,
                        'fi'        =>$fi,
                    ]);
            }
            else
            {
                $reserve->update($request->all()+
                    [
                        'user_id' => Auth::user()->id,
                        'final_off' =>$final_off,
                        'fi'        =>$fi,
                        'off'       =>NULL
                    ]);
            }

            $msg='تعداد کوپن تمام شده است';
            $errorStatus='danger';

            return view('reserveFi')
                ->with('msg',$msg)
                ->with('errorStatus',$errorStatus)
                ->with('reserve',$reserve);
            //return ('<div class="alert alert-danger">تعداد کوپن مورد نظر استفاده شده است</div>');
        }
        else
        {

            $coupon=coupon::join('users','coupons.user_id','=','users.id')
                    ->where('coupon','=',$request['coupon'])
                    ->where('user_id','=',$users->id)
                    ->first();
            if($coupon->user_id==$users->id)
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


                if(is_null($reserve))
                {
                    $reserve = reserve::create($request->all()+
                        [
                            'user_id'   => Auth::user()->id,
                            'off'       =>$coupon->discount,
                            'final_off' =>$final_off,
                            'fi'        =>$fi,
                        ]);
                }
                else
                {
                    $reserve->update($request->all()+
                        [
                            'user_id' => Auth::user()->id,
                            'off'       =>$coupon->discount,
                            'final_off' =>$final_off,
                            'fi'        =>$fi,
                        ]);
                }

                $msg='کوپن اعمال شد';
                $errorStatus='success';

                return view('reserveFi')
                    ->with('msg',$msg)
                    ->with('errorStatus',$errorStatus)
                    ->with('reserve',$reserve);
            }
            else
            {
                return '<div class="alert alert-danger">کد تخفیف مربوط به این محصول نمیباشد</div>';
            }
        }

    }
}
