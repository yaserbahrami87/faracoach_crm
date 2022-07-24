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
    public function create(Request $request)
    {
//        session()->forget('status');
//
        if(isset($request->introduce))
        {
            $request->session()->put('introduce',$request->introduce);
        }

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
            'introduce'     =>session()->get('introduce'),
            'cooperation'   =>$request->cooperation,
            'applicant'     =>$request->applicant,
            'resume'        =>$resume,
            'trackingcode'  =>$trackingCode,
        ]);



        if($status)
        {
            $msg=Auth::user()->fname.' '.Auth::user()->lname." عزیز\nدرخواست شما ثبت شد\nمنتظر تایید اولیه اطلاعات باشید\nلینک دعوت از دوستان و کسب امتیاز معرفی: "."my.faracoach.com/scholarship/register?introduce=".Auth::user()->id;
            $this->sendSms(Auth::user()->tel,$msg);
//            $this->sendSms(Auth::user()->tel,'شماره پیگیری بورسیه فراکوچ:'.$trackingCode."\nلینک اختصاصی شما جهت دعوت در بورسیه:\n "."my.faracoach.com/scholarship/register?introduce=".Auth::user()->id);
            $this->sendSms('09153159020','بورسیه فراکوچ:'.Auth::user()->fname.' '.Auth::user()->lname."\nشماره:\n ".Auth::user()->tel);
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


//        if(!is_null($request->confirm_target))
//        {
//            $scholarship->confirm_target=implode($request->confirm_target);
//        }
        //برای اینمه تمام فیلدها ریست بشن و از اول مقدار برای کانفیرم بگیرن رسیت میشوند به روش زیر
        $scholarship->confirm_target=0;
        $scholarship->confirm_types=0;
        $scholarship->confirm_gettingknow=0;
        $scholarship->confirm_cooperation=0;
        $scholarship->confirm_applicant=0;
        $scholarship->confirm_resume=0;
        $scholarship->save();


        $scholarship->update($request->all());

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

    public function me()
    {
        $scholarship=scholarship::where('user_id','=',Auth::user()->id)
                    ->first();
        if(is_null($scholarship))
        {
            alert()->warning('شما در بورسیه فراکوچ ثبت نام نکرده اید')->persistent('بستن');
            return back();
        }
        else
        {
            $scholarship->target=explode(',',$scholarship->target);
            $scholarship->types=explode(',',$scholarship->types);

            $messages=message::where(function($query)
            {
                $query->orwhere('user_id_send','=',Auth::user()->id)
                    ->orwhere('user_id_recieve','=',Auth::user()->id);
            })
                ->where('type','=','scholarship')
                ->orderby('id','desc')
                ->get();

            return  view('user.scholarship.profile')
                        ->with('messages',$messages)
                        ->with('scholarship',$scholarship);
        }
    }

    public function answerstatus(Request $request)
    {
        $this->validate($request,[
            'target'        =>'nullable|array',
            'types'         =>'nullable|array',
            'gettingknow'   =>'nullable|string',
            'cooperation'   =>'nullable|string',
            'applicant'     =>'nullable|numeric',
            'resume'        =>'nullable|mimes:jpeg,jpg,pdf,doc,png|max:600',
        ]);

        $scholarship=scholarship::where('user_id','=',Auth::user()->id)
                        ->first();

        $scholarship->update($request->all());

        if ($request->has('resume') && $request->file('resume')->isValid()) {
            $file = $request->file('resume');
            $resume = "resume-" . Auth::user()->tel . "." . $request->file('resume')->extension();
            $path = public_path('/documents/scholarship');
            $files = $request->file('resume')->move($path, $resume);

        }

        if(isset($resume))
        {
            $scholarship->resume=$resume;
        }

        if(!is_null($request->target))
        {
            $scholarship->target=implode(',',$request->target);
        }

        if(!is_null($request->types))
        {
            $scholarship->types=implode(',',$request->types);
        }

        $scholarship->confirm_target=0;
        $scholarship->confirm_types=0;
        $scholarship->confirm_gettingknow=0;
        $scholarship->confirm_cooperation=0;
        $scholarship->confirm_applicant=0;
        $scholarship->confirm_resume=0;
        $scholarship->status=5;
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
        return back();

    }
}
