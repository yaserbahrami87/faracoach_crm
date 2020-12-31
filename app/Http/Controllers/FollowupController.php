<?php

namespace App\Http\Controllers;

use App\followup;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowupController extends Controller
{



    public function showForm($id)
    {
        $userAdmin=Auth::user();
        return view('panelAdmin.insertFollowUp',compact('id','userAdmin'));
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
            'user_id'               =>'required|numeric|',
            'followup'              =>'required|numeric',
            'status_followups'      =>'required|numeric',
            'comment'               =>'required|string|min:3',
            'tags'                  =>'|array',
            'date_fa'               =>'required|string',
            'time_fa'               =>'required|string',
            'nextfollowup_date_fa'  =>'string|min:9|nullable'

        ]);
        $request['tags']=implode(',',$request['tags']);

        $check=followup::create([
            'user_id'               =>$request['user_id'],
            'insert_user_id'        =>$request['insert_user_id'],
            'comment'               =>$request['comment'],
            'problemfollowup_id'    =>$request['followup'],
            'status_followups'      =>$request['status_followups'],
            'tags'                  =>$request['tags'],
            'date_fa'               =>$request['date_fa'],
            'insert_user_id'        =>auth()->user()->id,
            'nextfollowup_date_fa'  =>$request['nextfollowup_date_fa'],
            'time_fa'               =>$request['time_fa'],
            'datetime_fa'           =>$request['date_fa']." ".$request['time_fa']
        ]);

        $data=User::where('users.id','=',$request['user_id'])
                        ->first();

        $data->type=$request['status_followups'];
        $data->save();

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

        return back()->with('msg',$msg)
                    ->with('errorStatus',$errorStatus);
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
}
