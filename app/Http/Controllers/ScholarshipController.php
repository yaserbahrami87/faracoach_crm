<?php

namespace App\Http\Controllers;

use App\scholarship;
use App\User;
use Faker\Provider\Base;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScholarshipController extends BaseController
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
//        session()->forget('status');
//
        return  view('scholarship.beforeRegister_scholarship');
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
            'user_id'       =>'required|numeric|',
            'target'        =>'required|string',
            'types'         =>'required|array',
            'gettingknow'   =>'required|string',
            'description'   =>'nullable|string',
            'scientific'    =>'required|string',
            'executive'     =>'required|string',
            'introduce'     =>'required|string',
            'resume'        =>'required|mimes:jpeg,jpg,pdf,doc,png|max:600',
        ]);


        $file=$request->file('resume');
        $resume="resume-".Auth::user()->tel.".".$request->file('resume')->extension();
        $path=public_path('/documents/scholarship');
        $files=$request->file('resume')->move($path, $resume);


        $dateNow = verta();
        $this->dateNow = $dateNow->format('Ymd');
        $this->timeNow = $dateNow->format('His');
        $trackingCode=$this->dateNow.$this->timeNow;


        $status=scholarship::create(
        [
            'user_id'       =>Auth::user()->id,
            'target'        =>$request->target,
            'types'         =>implode($request->types),
            'gettingknow'   =>$request->gettingknow,
            'description'   =>$request->description,
            'scientific'    =>$request->scientific,
            'executive'     =>$request->executive,
            'introduce'     =>$request->introduce,
            'resume'        =>$resume,
            'trackingcode'  =>$trackingCode,
        ]);



        if($status)
        {
            $this->sendSms(Auth::user()->tel,'شماره پیگیری شما در سامانه بورسیه فراکوچ:'.$trackingCode);
            alert()->success("ثبت نام شما در بورسیه فراکوچ با موفقیت انجام شد \nکد پیگیری شما $trackingCode")->persistent('بستن');
            $request->session()->forget('scholarshipStatus');
            return back();
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


    public function register_Scholarship(Request $request)
    {
        $this->validate($request,[
            'fname'     =>'required|string',
            'lname'     =>'required|string',
            'sex'       =>'required|in:1,0',
            'email'     =>'required|email',
            'tel'       =>'required|string',
            'education' =>'required|string',
            'reshteh'   =>'required|string',
        ]);
        $user=User::where('tel','=',$request->tel)
            ->first();

        $status=$user->update($request->all());
        $request->session()->put('scholarshipStatus','infoScholarship');
//        return view('scholarship.infoCoach_scholarship')

        return back()
                ->with('user',$user);

    }

    //پاک کردن تلفن از سشن
    public function cleartel()
    {
        session()->forget('scholarshipStatus');
        return back();
    }
}
