<?php

namespace App\Http\Controllers;

use App\option;
use Illuminate\Http\Request;

class OptionController extends Controller
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

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\option  $option
     * @return \Illuminate\Http\Response
     */
    public function show(option $option)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\option  $option
     * @return \Illuminate\Http\Response
     */
    public function edit(option $option)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\option  $option
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, option $option)
    {

        $this->validate($request,
            [
                'introduced_verify' =>'nullable|string'
            ]);

        $status=option::where('option_name','=','introduced_verify')
                    ->update(['option_value'=>$request['introduced_verify']]);
        if($status)
        {
            $msg="اطلاعات با موقفیت بروزرسانی شد";
            $errorStatus="success";
            return back()
                ->with('msg',$msg)
                ->with('errorStatus',$errorStatus);
        }
        else
        {
            $msg="خطا در بروزرسانی";
            $errorStatus="danger";
            return back()
                ->with('msg',$msg)
                ->with('errorStatus',$errorStatus);
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\option  $option
     * @return \Illuminate\Http\Response
     */
    public function destroy(option $option)
    {
        //
    }
}
