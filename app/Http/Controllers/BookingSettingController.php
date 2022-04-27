<?php

namespace App\Http\Controllers;

use App\coach;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class BookingSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->type==2)
        {

        }
        else
        {
            if(Auth::user()->status_coach==1)
            {
                $settings=Auth::user()->coach;
                return view('user.booking.settingBooking')
                    ->with('settings',$settings);
            }
            else
            {
                alert()->error('عدم دسترسی به این بخش ')->persistent('بستن');
                return redirect('/panel');

            }

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(coach $coach)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $coach
     * @return \Illuminate\Http\Response
     */
    public function edit(coach $coach)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\coach  $coach
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,coach  $coach)
    {
        $request->validate([
            'type_holding'      =>'required|in:0,1,2',
            'address'           =>'required|string',
            'online_platform'   =>'required|string',
            'tel'               =>'nullable|string',
            'today_meeting'     =>'required|in:0,1',
        ]);


        $status=$coach->update($request->all());
        if($status)
        {
            alert()->success('تنظیمات جلسات با موفقیت بروزرسانی شد')->persistent('بستن');
        }
        else
        {
            alert()->error('خطا در بروزرسانی')->persistent('بستن');
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $coach
     * @return \Illuminate\Http\Response
     */
    public function destroy(coach $coach)
    {
        //
    }
}
