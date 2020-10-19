<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
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
        $check=User::where('user_codemelli','=',$request['user_codemelli'])
            ->count();

        if($check>0)
        {
            $msg="کد ملی تکراری است";
            $errorStatus="danger";
        }
        else
        {
            $this->validate(request(),
            [
                'user_fname'=>'required|min:3',
                'user_lname'=>'required|min:3',
                'user_codemelli'=>'required|min:9',
                'user_sex'=>'required|boolean',
                'user_tel'=>'required|numeric',
                'user_shenasname'=>'nullable|numeric',
                'user_father'=>'nullable|min:3|',
                'user_born'=>'nullable|min:3',
                'user_married'=>'nullable|boolean',
                'user_education'=>'nullable|min:4',
                'user_reshteh'=>'nullable|min:4',
                'user_state'=>'nullable|min:4',
                'user_city'=>'nullable|min:4',
                'user_address'=>'nullable|min:4',
                'user_personal_image'=>'nullable|mimes:jpeg,jpg,pdf',
                'user_shenasnameh_image'=>'nullable|mimes:jpeg,jpg,pdf',
                'user_cartmelli_image'=>'nullable|mimes:jpeg,jpg,pdf',
                'user_education_image'=>'nullable|mimes:jpeg,jpg,pdf',
                'user_email'=>'required|email',
                'user_password'=>'required_with:repassword|string',
                'repassword'=>'required',
                'rules'=>'required'
            ]);


            $status = User::create([
                'user_fname' => $request['user_fname'],
                'user_lname' => $request['user_lname'],
                'user_codemelli' => $request['user_codemelli'],
                'user_sex' => $request['user_sex'],
                'user_tel' => $request['user_tel'],
                'user_shenasname' => $request['user_shenasname'],
                'user_father' => $request['user_father'],
                'user_born' => $request['user_born'],
                'user_married' => $request['user_married'],
                'user_education' => $request['user_education'],
                'user_reshteh' => $request['user_reshteh'],
                'user_state' => $request['user_state'],
                'user_city' => $request['user_city'],
                'user_address' => $request['user_address'],
                'user_personal_image' => $request['user_personal_image'],
                'user_shenasnameh_image' => $request['user_shenasnameh_image'],
                'user_cartmelli_image' => $request['user_cartmelli_image'],
                'user_education_image' => $request['user_education_image'],
                'user_email' => $request['user_email'],
                'user_password' => md5($request['user_password']),
                'user_status' => 1
            ]);
            if($status)
            {
                $msg="اطلاعات ما با موفقیت در سیستم ثبت شد";
                $errorStatus="success";
            }
        }
        return back()->with('msg',$msg)->with('errorStatus',$errorStatus);
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
}
