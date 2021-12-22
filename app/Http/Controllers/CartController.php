<?php

namespace App\Http\Controllers;

use App\cart;
use App\course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart=cart::where('user_id','=',Auth::user()->id)
                    ->get();

        foreach ($cart as $item)
        {
            switch($item->type)
            {
                case 'course':$course=course::where('id','=',$item->product_id)
                                                ->first();
                              $item->product=$course->course;
                              $item->fi=$course->fi_off;
            }
        }
        return view('cart_all')
                        ->with('cart',$cart);
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
        if(Auth::check()) {

            $this->validate($request,
                [
                    'product_id' => 'required|numeric',
                    'type' => 'required|string',
                ]
            );

            $cart = cart::where('product_id', '=', $request->product_id)
                ->where('type', '=', $request->type)
                ->where('user_id', '=', Auth::user()->id)
                ->first();

            if ($cart)
            {
                if ($request->capacity) {
                    $cart->capacity++;
                    $status = $cart->save();
                    if ($status) {
                        alert()->success('محصول مورد نظر اضافه شد')->persistent('بستن');
                    } else {
                        alert()->error('خطا به اضافه کردن تعدا محصول مورد نظر ')->persistent('بستن');
                    }
                } else {
                    alert()->warning('محصول مورد نظر در سبد شما وجود دارد')->persistent('بستن');
                }
            } else {
                switch($request->type)
                {
                    case 'course':$product=course::where('id','=',$request->product_id)
                                    ->first();
                                    //برای اینکه مقدار فیلد نهایی قیمت همه در یک فیلد باشد در فیلد زیر میریزم
                                    $product->final_off=$product->fi_off;
                                    break;

                    default:    alert()->error('محصولی با این مشخصات پیدا نشد')->persistent('بستن');
                                return back();
                }

                $cart = cart::create($request->all() +
                    [
                        'user_id'   => Auth::user()->id,
                        'date_fa'   => $this->dateNow,
                        'time_fa'   => $this->timeNow,
                        'fi'        =>$product->fi,
                        'final_off' =>$product->final_off,
                    ]);

                if ($cart) {
                    alert()->success('محصول به سبد شما اضافه شد')->persistent('بستن');
                } else {
                    alert()->success('خطا در اضافه کردن به سبد خرید')->persistent('بستن');
                    return back();
                }
            }
            return redirect('/cart/all');
        }
        else
        {
            return redirect('/login');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(cart $cart)
    {
        $status=$cart->delete();
        if($status)
        {
            alert()->success('محصول با موفقیت از سبد خرید حذف شد')->persistent('بستن');

        }
        else
        {
            alert()->error('خطا در حذف محصول از سبد')->persistent('بستن');
        }
        return back();

    }
}
