<?php

namespace App\Http\Controllers;

use App\followup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowupController extends BaseController
{

    public function showForm($id)
    {
        $userAdmin=Auth::user();
        return view('panelAdmin.insertFollowUp')
                ->with('id',$id)
                ->with('userAdmin',$userAdmin);
    }

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

        $this->validate($request,[
            'insert_user_id'        =>'required|numeric',
            'course_id'             =>'required|numeric',
            'user_id'               =>'required|numeric|',
            'followup'              =>'required|numeric',
            'status_followups'      =>'required|numeric',
            'comment'               =>'nullable|string|min:3',
            'tags'                  =>'required|array',
            'date_fa'               =>'required|string',
            'time_fa'               =>'required|string',
            'nextfollowup_date_fa'  =>'string|min:9|nullable',
            'followby_expert'       =>'required|numeric|',
            'talktime'              =>'required|numeric|',
        ]);

        $request['tags']=implode(',',$request['tags']);

        $check=followup::create([
            'user_id'               =>$request['user_id'],
            'insert_user_id'        =>$request['insert_user_id'],
            'course_id'             =>$request['course_id'],
            'comment'               =>$request['comment'],
            'talktime'              =>$request['talktime'],
            'problemfollowup_id'    =>$request['followup'],
            'status_followups'      =>$request['status_followups'],
            'tags'                  =>$request['tags'],
            'date_fa'               =>$request['date_fa'],
            'insert_user_id'        =>auth()->user()->id,
            'nextfollowup_date_fa'  =>$request['nextfollowup_date_fa'],
            'sms'                   =>$request['sms'],
            'time_fa'               =>$request['time_fa'],
            'datetime_fa'           =>$request['date_fa']." ".$request['time_fa']
        ]);

        $data=$this->get_user_byID($request['user_id']);
        $data->type=$request['status_followups'];
        $data->followby_expert=$request['followby_expert'];
        $data->save();
        $request['followby_expert']=$this->get_user_byID($request['followby_expert'])->fname." ".$this->get_user_byID($request['followby_expert'])->lname;
        if($request['sms']!="0")
        {
            //$request['sms']=$request['sms']."\n https://crm.faracoach.com";
            $request['sms']=str_replace('{nextDate}',$request['nextfollowup_date_fa'],$request['sms']);
            $request['sms']=str_replace('{followby_expert}',$request['followby_expert'],$request['sms']);
            $request['sms']=str_replace("<br>","\r\n",$request['sms']);
            $this->sendSms($data['tel'],$request['sms']);
        }
        if($check)
        {
            $msg="پیگیری با موفقیت ثبت شد";
            $errorStatus="success";
        }
        else
        {
            $msg="خطا در ثبت";
            $errorStatus="danger";
        }


        if($request['followby_expert']==Auth::user()->id)
        {
            return back()->with('msg',$msg)
                ->with('errorStatus',$errorStatus);
        }
        else
        {
            return redirect('/admin/users')->with('msg',$msg)
                ->with('errorStatus',$errorStatus);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\followup  $followup
     * @return \Illuminate\Http\Response
     */
    public function show(followup $followup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\followup  $followup
     * @return \Illuminate\Http\Response
     */
    public function edit(followup $followup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\followup  $followup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, followup $followup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\followup  $followup
     * @return \Illuminate\Http\Response
     */
    public function destroy(followup $followup)
    {
        //
    }


    public function store_user(Request $request)
    {
        $this->validate($request,[
            'insert_user_id'        =>'required|numeric',
            'course_id'             =>'required|numeric',
            'user_id'               =>'required|numeric|',
            'followup'              =>'required|numeric',
            'status_followups'      =>'required|numeric',
            'comment'               =>'nullable|string|min:3',
            'date_fa'               =>'required|string',
            'time_fa'               =>'required|string',
            'nextfollowup_date_fa'  =>'string|min:9|nullable',
            'talktime'              =>'required|numeric|',
        ]);



        $check=followup::create([
            'user_id'               =>$request['user_id'],
            'insert_user_id'        =>$request['insert_user_id'],
            'course_id'             =>$request['course_id'],
            'comment'               =>$request['comment'],
            'talktime'              =>$request['talktime'],
            'problemfollowup_id'    =>$request['followup'],
            'status_followups'      =>$request['status_followups'],
            'date_fa'               =>$request['date_fa'],
            'insert_user_id'        =>auth()->user()->id,
            'nextfollowup_date_fa'  =>$request['nextfollowup_date_fa'],
            'sms'                   =>$request['sms'],
            'time_fa'               =>$request['time_fa'],
            'datetime_fa'           =>$request['date_fa']." ".$request['time_fa'],
        ]);


        $data=$this->get_user_byID($request['user_id']);
        $data->type=$request['status_followups'];
        $data->followby_expert=Auth::user()->id;
        $data->save();

        if($request['sms']!="0")
        {
            //$request['sms']=$request['sms']."\n https://crm.faracoach.com";
            $request['sms']=str_replace('{nextDate}',$request['nextfollowup_date_fa'],$request['sms']);
            $request['sms']=str_replace('{followby_expert}',$request['followby_expert'],$request['sms']);
            $request['sms']=str_replace("<br>","\r\n",$request['sms']);
            $this->sendSms($data['tel'],$request['sms']);
        }

        if($check)
        {

            alert()->success("پیگیری با موفقیت ثبت شد",'پیام')->persistent('بستن');
        }
        else
        {
            alert()->error("خطا در ثبت",'خطا')->persistent('بستن');
        }

        return back();

    }
}
