<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class landingController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view ('landing');
    }

    public function showPackageDownload()
    {
        if(session('status')==true)
        {
            return  view('freePackageLanding');
        }
        else
        {
            return back();
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
        $this->validate(request(),
        [
            'fname' =>'required|min:3|persian_alpha',
            'lname' =>'required|min:3|persian_alpha',
            'tel'   =>'required|iran_mobile',
            'email' =>'required|email'
        ]);

        $check=User::where('email','=',$request['email'])
                ->orwhere('tel','=',$request['tel'])
                ->count();

        if($check==1)
        {
            $user=User::where('tel','=',$request['tel'])
                ->first();
            if($user->fname!=$request['fname'])
            {
                $user->fname=$request['fname'];
            }

            if($user->lname!=$request['lname'])
            {
                $user->lname=$request['lname'];
            }


            if($user->email!=$request['email'])
            {
                $user->email=$request['email'];
            }

            if($user->tel!=$request['tel'])
            {
                $user->tel!=$request['tel'];
            }

            $status=$user->update();
            if($status)
            {
                $msg = "پروفایل با موفقیت به روزرسانی شد";
                $errorStatus = "success";
            }
            else
            {
                $msg = "خطا در بروزرسانی اطلاعات";
                $errorStatus = "danger";
            }
            return  redirect()
                    ->route('freePackageLanding')
                    ->with('status',true)
                    ->with('msg',$msg)
                    ->with('errorStatus',$errorStatus);

        }
        else if($check>1)
        {
            $msg="بیش از 1 نفر با اطلاعات وارد شده در سیستم موجوداست";
            $errorStatus="danger";
            return  back()
                    ->with('msg',$msg)
                    ->with('errorStatus',$errorStatus);
        }
        else if($check==0)
        {
            $status = User::create($request->all()+
            [
                'type'               =>'1',
                'password'           =>Hash::make('12345678'),
                'resource'           =>'کمپین',
                'detailsresource'    =>'17 ربیع 1399'
            ]);
            if($status)
            {
                $msg = "اطلاعات با موفقیت ثبت شد";
                $errorStatus = "success";
                $msgSMS=$request->fname." ".$request->lname. " عزیز اطلاعات شما در سیستم فراکوچ ثبت شد";
                $this->sensSms($request['tel'],$msgSMS);
            }
            else
            {
                $msg = "خطا در ثبت اطلاعات";
                $errorStatus = "danger";
            }
            return  redirect()
                    ->route('freePackageLanding')
                    ->with('msg',$msg)
                    ->with('errorStatus',$errorStatus)
                    ->with('status',true);
        }


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
