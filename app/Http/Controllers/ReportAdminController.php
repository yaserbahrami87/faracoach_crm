<?php

namespace App\Http\Controllers;

use App\followup;
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

    public function allReportsUsers(Request $request)
    {

        if(isset($request['range']))
        {
            $this->validate($request,[
                'start_date'    =>'required|string',
            ]);
            $request['start_date']=explode(' ~ ',$request['start_date']);
            $date_en=[$this->changeTimestampToMilad($request['start_date'][0])." 00:00:00",$this->changeTimestampToMilad($request['start_date'][1])." 23:59:59"];
            $users=User::wherebetween('created_at',$date_en)
                            ->get();
            $followups=followup::wherebetween('date_fa',$request['start_date'])
                        ->get();
        }
        else
        {
            $users=User::get();
            $followups=followup::get();
        }

        $v=verta();

        $ageTo20=$users->wherebetween('datebirth',[$v->subYears(20),$v->now()]);
        $age21to30=$users->wherebetween('datebirth',[$v->now()->subYears(30),$v->now()->subYears(21)]);
        $age31to40=$users->wherebetween('datebirth',   [$v->now()->subYears(40),$v->now()->subYears(31)]);
        $age41to50=$users->wherebetween('datebirth',   [$v->now()->subYears(50),$v->now()->subYears(41)]);
        $age51to60=$users->wherebetween('datebirth',   [$v->now()->subYears(60),$v->now()->subYears(50)]);
        $age61to70=$users->wherebetween('datebirth',   [$v->now()->subYears(70),$v->now()->subYears(61)]);
        $age71to80=$users->wherebetween('datebirth',   [$v->now()->subYears(80),$v->now()->subYears(71)]);
        $age901to81=$users->wherebetween('datebirth',   [$v->now()->subYears(90),$v->now()->subYears(81)]);
        $ages=['ageTo20'=>$ageTo20->count(),'age21to30'=>$age21to30->count(),'age31to40'=>$age31to40->count(),'age41to50'=>$age41to50->count(),'age51to60'=>$age51to60->count(),'age61to70'=>$age61to70->count(),'age71to80'=>$age71to80->count()];



        return view('admin.reports.allDatabase')
                    ->with('followups',$followups)
                    ->with('date_jalali',$v->now())
                    ->with('ages',$ages)
                    ->with('users',$users);
    }
}
