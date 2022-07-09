<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ReportAdminController extends BaseController
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
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user,Request $request)
    {
        if(isset($_GET['range']))
        {
            $this->validate($request,[
                'start_date'    =>'required|string',
            ]);
            $request['start_date']=explode(' ~ ',$request['start_date']);
        }
        else
        {
            $dateNow = verta();
            $request['start_date']=[$dateNow->startMonth()->format('Y/m/d'),$dateNow->endMonth()->format('Y/m/d')];

        }

        if(isset($request['start_date']))
        {

            $date_en=[$this->changeTimestampToMilad($request['start_date'][0])." 00:00:00",$this->changeTimestampToMilad($request['start_date'][1])." 23:59:59"];
        }
        else
        {

            $date_en=[$this->changeTimestampToMilad($request['start_date'][0])." 00:00:00",$this->changeTimestampToMilad($request['start_date'][1])." 23:59:59"];
        }
        return  view('admin.reports.reportUser')
                    ->with('date_fa',$request['start_date'])
                    ->with('date_en',$date_en)
                    ->with('user',$user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function allReportsUsers()
    {

    }
}
