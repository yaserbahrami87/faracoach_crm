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

        return view('panelUser.coupon')
                    ->with('coupons',$coupons);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dateNow=$this->dateNow;
        return view('panelUser.insertCoupon')
                        ->with('dateNow',$dateNow);
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
            return view('panelUser.editCoupon')
                        ->with('coupon',$coupon)
                        ->with('dateNow',$dateNow);
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
            'coupon'=>'required|string'
        ]);
        $coupon=coupon::where('coupon','=',$request['coupon'])
                ->get();
        if((count($coupon)==0)||(is_null($coupon)))
        {
            return '<div class="alert alert-danger">کوپن تخفیف موجود نیست</div>';
        }
        else
        {

            $users=booking::join('users','bookings.user_id','=','users.id')
                        ->where('bookings.id','=',$request['booking_id'])
                        ->first();


            $coupon=coupon::join('users','coupons.user_id','=','users.id')
                    ->where('coupon','=',$request['coupon'])
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

                $fi=100000;
                $off=($fi*$coupon->discount)/100;
                $final_off=$fi-$off;

                if(is_null($reserve)) {
                    $status = reserve::create($request->all()+
                        [
                            'user_id'   => Auth::user()->id,
                            'off'       =>$coupon->discount,
                            'final_off' =>$final_off,
                            'fi'        =>$fi,
                        ]);
                }
                else
                {
                    $status=$reserve->update($request->all()+
                        [
                            'user_id' => Auth::user()->id,
                            'off'       =>$coupon->discount,
                            'final_off' =>$final_off,
                            'fi'        =>$fi,
                        ]);
                }

                if($status)
                {
                   $status=true;
                }
                else
                {
                    $status=false;
                }

                return view('reserveFi')
                            ->with('status',$status)
                            ->with('reserve',$reserve);
            }
            else
            {
                return '<div class="alert alert-danger">کد تخفیف مربوط به این محصول نمیباشد</div>';
            }

        }

    }
}
