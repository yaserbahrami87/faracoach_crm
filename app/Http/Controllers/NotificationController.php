<?php

namespace App\Http\Controllers;

use App\notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function show(notification $notification)
    {
        if($notification->user_id==Auth::user()->id)
        {
            $notification->status=0;
            $notification->save();
            if($notification->type=='user')
            {
                return redirect('/admin/user/'.$notification->post_id);
            }
            else
            {
                return back();
            }
        }
        else
        {
            alert()->error('این پیغام مربوط به شما نمی باشد')->persistent('بستن');
            return back();
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function edit(notification $notification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, notification $notification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function destroy(notification $notification)
    {
        //
    }
}
