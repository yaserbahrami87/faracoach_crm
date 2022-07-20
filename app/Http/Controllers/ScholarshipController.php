<?php

namespace App\Http\Controllers;

use App\message;
use App\scholarship;
use App\User;
use Faker\Provider\Base;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ScholarshipController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$scholarships=scholarship::wherein('status',[0,2,3,4])
        $scholarships=scholarship::get();
        return view('admin.scholarship.users')
                    ->with('scholarships',$scholarships);
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


        return  view('scholarship.beforeRegister_Scholarship');
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
            'target'        =>'required|array',
            'types'         =>'required|array',
            'gettingknow'   =>'required|string',
//            'description'   =>'nullable|string',
//            'scientific'    =>'required|string',
//            'executive'     =>'required|string',
//            'introduce'     =>'nullable|string',
            'cooperation'   =>'required|string',
            'applicant'     =>'required|numeric',
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
            'target'        =>implode(',',$request->target),
            'types'         =>implode(',',$request->types),
            'gettingknow'   =>$request->gettingknow,
//            'description'   =>$request->description,
//            'scientific'    =>$request->scientific,
//            'executive'     =>$request->executive,
//            'introduce'     =>$request->introduce,
            'cooperation'   =>$request->cooperation,
            'applicant'     =>$request->applicant,
            'resume'        =>$resume,
            'trackingcode'  =>$trackingCode,
        ]);



        if($status)
        {
            $this->sendSms(Auth::user()->tel,'شماره پیگیری شما در سامانه بورسیه فراکوچ:'.$trackingCode);
            alert()->success("ثبت نام شما در بورسیه فراکوچ با موفقیت انجام شد \nکد پیگیری شما $trackingCode")->persistent('بستن');
            $request->session()->forget('scholarshipStatus');
            return redirect('/panel');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $scholarship
     * @return \Illuminate\Http\Response
     */
    public function show(scholarship  $scholarship)
    {

        $states=$this->states();
        $city=$this->city($scholarship->user->city);
        $scholarship->types=explode(',' ,$scholarship->types);

        $id=$scholarship->user_id;
        $messages=message::where(function($query) use($id)
                            {
                                $query->orwhere('user_id_send','=',$id)
                                    ->orwhere('user_id_recieve','=',$id);
                            })
                            ->where('type','=','scholarship')
                            ->orderby('id','desc')
                            ->get();



       return view('admin.scholarship.scholarship')
                    ->with('scholarship',$scholarship)
                    ->with('city',$city)
                    ->with('messages',$messages)
                    ->with('states',$states);
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
            'fname'                 =>'required|string',
            'lname'                 =>'required|string',
            'sex'                   =>'required|in:1,0',
            'email'                 =>'required|email',
            'tel'                   =>'required|string',
            'education'             =>'required|string',
            'reshteh'               =>'required|string',
//            'password'              =>'required_with:password_confirmation|string',
            'password'              =>'nullable|string|confirmed',
        ]);


        $user=User::where('tel','=',$request->tel)
            ->first();

        $status=$user->update($request->all());
         if(!is_null($request['password']))
         {
             $user->password=Hash::make($request['password']);
             $user->save();
         }

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

    public function changestatus(Request $request,scholarship $scholarship)
    {
        $this->validate($request,[
            'status'    =>'required|numeric',
            'comment'   =>'required|string',
        ]);

        $scholarship->status=$request->status;
        $scholarship->save();
        $status=message::create([
                'user_id_send'      =>Auth::user()->id,
                'comment'           =>$request->comment,
                'user_id_recieve'   =>$scholarship->user->id,
                'type'              =>'scholarship',
                'date_fa'           =>$this->dateNow,
                'time_fa'           =>$this->timeNow,
        ]);
        if($status)
        {
            alert()->success('اطلاعات با موفقیت ثبت شد')->persistent('بستن');
        }
        else
        {
            alert()->error('خطا در ثبت اطلاعات')->persistent('بستن');
        }

        return redirect('/admin/scholarship/');

    }
}
