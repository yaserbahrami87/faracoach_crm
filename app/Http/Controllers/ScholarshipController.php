<?php

namespace App\Http\Controllers;

use App\city;
use App\followup;
use App\message;
use App\Notifications\sendMessageNotification;
use App\scholarship;
use App\state;
use App\User;
use Faker\Provider\Base;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Throwable;

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
        foreach ($scholarships as $item)
        {
            $item->created_at=$this->changeTimestampToShamsi($item->created_at);
        }



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


        if((!$request->session()->has('scholarshipStatus')) && Auth::check())
        {
            $request->session()->put('scholarshipStatus','infoUser');
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

        $check=scholarship::where('user_id','=',Auth::user()->id)
                    ->first();

        if(is_null($check))
        {
            $file = $request->file('resume');
            $resume = "resume-" . Auth::user()->tel . "." . $request->file('resume')->extension();
            $path = public_path('/documents/scholarship');
            $files = $request->file('resume')->move($path, $resume);


            $dateNow = verta();
            $this->dateNow = $dateNow->format('Ymd');
            $this->timeNow = $dateNow->format('His');
            $trackingCode = $this->dateNow . $this->timeNow;


            $status = scholarship::create(
                [
                    'user_id' => Auth::user()->id,
                    'target' => implode(',', $request->target),
                    'types' => implode(',', $request->types),
                    'gettingknow' => $request->gettingknow,
//            'description'   =>$request->description,
//            'scientific'    =>$request->scientific,
//            'executive'     =>$request->executive,
                    'introduce' => session()->get('introduce'),
                    'cooperation' => $request->cooperation,
                    'applicant' => $request->applicant,
                    'resume' => $resume,
                    'trackingcode' => $trackingCode,

                ]);


            if ($status) {
                $msg = Auth::user()->fname . ' ' . Auth::user()->lname . " عزیز\nدرخواست شما ثبت شد\nمنتظر تایید اولیه اطلاعات باشید\nلینک دعوت از دوستان و کسب امتیاز معرفی: " . "my.faracoach.com/scholarship/register?introduce=" . Auth::user()->id;
                $this->sendSms(Auth::user()->tel, $msg);
//            $this->sendSms(Auth::user()->tel,'شماره پیگیری بورسیه فراکوچ:'.$trackingCode."\nلینک اختصاصی شما جهت دعوت در بورسیه:\n "."my.faracoach.com/scholarship/register?introduce=".Auth::user()->id);
                $this->sendSms('09153159020', $status->id . ' بورسیه:' . Auth::user()->fname . ' ' . Auth::user()->lname . "\nتحصیلات:\n " . Auth::user()->education);
                alert()->success("ثبت نام شما در بورسیه فراکوچ با موفقیت انجام شد \nکد پیگیری شما $trackingCode")->persistent('بستن');
                $request->session()->forget('scholarshipStatus');
                return redirect('/panel');
            }
        }else
        {
            $request->session()->forget('scholarshipStatus');
            alert()->error('اطاعات شما در سامانه بورسیه کوچینگ قبلا ثبت شده است')->persistent('بستن');
            return back();
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

        $cities=city::where('state_id',$scholarship->user->state)
            ->get();

        if(!is_null($scholarship->user->gettingknow))
        {
            $scholarship->user->gettingknow_parent_user=$this->get_categoryGettingknow($scholarship->user->gettingknow,NULL,NULL,NULL,'first')->parent_id;
            $condition=['parent_id','=',$scholarship->user->gettingknow_parent_user];
            $gettingKnow_child_list=$this->get_categoryGettingknow(NULL,NULL,1,NULL,'get',$condition);
        }
        else
        {
            $gettingKnow_child_list=NULL;
        }

        $condition=['parent_id','=','0'];
        $gettingKnow_parent_list=$this->get_categoryGettingknow(NULL,NULL,1,NULL,'get',$condition);

        $getFollowbyCategory=$this->getFollowbyCategory();





       return view('admin.scholarship.scholarship')
                    ->with('scholarship',$scholarship)
                    ->with('gettingKnow_child_list',$gettingKnow_child_list)
                    ->with('gettingKnow_parent_list',$gettingKnow_parent_list)
                    ->with('getFollowbyCategory',$getFollowbyCategory)
                    ->with('city',$city)
                    ->with('cities',$cities)
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


        try {

            $status=$user->update($request->all());

        } catch (Throwable $e) {
            alert()->error('ایمیل وارد شده تکراری می باشد','خطا')->persistent('بستن');
            return back();
        }


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

        $this->validate($request, [
            'status' => 'required|numeric',
            'comment' => 'required|string',
        ]);
        //برای اینمه تمام فیلدها ریست بشن و از اول مقدار برای کانفیرم بگیرن رسیت میشوند به روش زیر
        $scholarship->confirm_target = 0;
        $scholarship->confirm_types = 0;
        $scholarship->confirm_gettingknow = 0;
        $scholarship->confirm_cooperation = 0;
        $scholarship->confirm_applicant = 0;
        $scholarship->confirm_resume = 0;
        $scholarship->save();


        $scholarship->update($request->all());

        $scholarship->status = $request->status;
        if ($request->status == 2) {
            $followups = followup::where('user_id', '=', $scholarship->user_id)
                ->get();

            foreach ($followups as $item) {
                $t = followup::where('id', '=', $item->id)   //    $this->get_followup($item->followups_id,NULL,NULL,NULL,"first");
                ->first();
                $t->flag = 0;
                $t->update();
            }

            followup::create([
                'user_id' => $scholarship->user_id,
                'insert_user_id' => Auth::user()->id,
                'comment' => 'کاربر از بخش بورسیه به فروش منتقل شد',
                'status_followups' => 11,
                'nextfollowup_date_fa' => $this->dateNow,
                'flag' => 1,
                'date_fa' => $this->dateNow,
                'time_fa' => $this->timeNow,

            ]);

            $user = User::where('id', '=', $scholarship->user_id)
                        ->first();
            $user->type = 11;
            $user->followby_expert = NULL;
            $user->save();
        }
        $scholarship->save();
        $status = message::create([
            'user_id_send' => Auth::user()->id,
            'comment' => $request->comment,
            'user_id_recieve' => $scholarship->user->id,
            'type' => 'scholarship',
            'date_fa' => $this->dateNow,
            'time_fa' => $this->timeNow,
        ]);

        switch ($request->status)
        {
            case(1):$status_scholarship= 'قبول';
                            break;
            case(2):$status_scholarship ='رد درخواست';
                            break;
            case(3):$status_scholarship='در حال بررسی';
                            break;
            case(4):$status_scholarship='اصلاح درخواست';
                            break;

        }


        if($request->status==1)
        {
            $msg=$scholarship->user->fname." ".$scholarship->user->lname." عزیز \n مرحله اول و دوم درخواست بورسیه کوچینگ با موفقیت ثبت شد\n"."دوره آموزشی مقدماتی 5 شنبه 10 شهریور";
        }
        else
        {
            $msg="نتیجه درخواست بورسیه شما:".$status_scholarship."\n برای آگاهی بیشتر به پورتال فراکوچ مراجعه کنید";
        }
        $this->sendSms($scholarship->user->tel,$msg);



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


    //نمایش صفحه برای خود کاربر
    public function me()
    {
        $scholarship=scholarship::where('user_id','=',Auth::user()->id)
                    ->first();
        if(is_null($scholarship))
        {
            session()->put('scholarshipStatus','infoUser');
            alert()->warning('شما در بورسیه فراکوچ ثبت نام نکرده اید')->persistent('بستن');
            return redirect('/scholarship/register');
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

            $states=state::get();


            $cities=city::where('state_id',$scholarship->user->state)
                                ->get();


            //انتخاب شهر براساس کد
            $city=$this->city($scholarship->user->city);

            if(!is_null($scholarship->user->gettingknow))
            {
                $scholarship->user->gettingknow_parent_user=$this->get_categoryGettingknow($scholarship->user->gettingknow,NULL,NULL,NULL,'first')->parent_id;
                $condition=['parent_id','=',$scholarship->user->gettingknow_parent_user];
                $gettingKnow_child_list=$this->get_categoryGettingknow(NULL,NULL,1,NULL,'get',$condition);
            }
            else
            {
                $gettingKnow_child_list=NULL;
            }

            $condition=['parent_id','=','0'];
            $gettingKnow_parent_list=$this->get_categoryGettingknow(NULL,NULL,1,NULL,'get',$condition);

            $getFollowbyCategory=$this->getFollowbyCategory();

            return  view('user.scholarship.profile')
                        ->with('messages',$messages)
                        ->with('states',$states)
                        ->with('city',$city)
                        ->with('cities',$cities)
                        ->with('gettingKnow_child_list',$gettingKnow_child_list)
                        ->with('gettingKnow_parent_list',$gettingKnow_parent_list)
                        ->with('getFollowbyCategory',$getFollowbyCategory)
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
            $msg=Auth::user()->fname.' '.Auth::user()->lname."\n فرم بورسیه را اصلاح کرد";
            $this->sendSms("09153159020",$msg);

            alert()->success('اطلاعات با موفقیت ثبت شد')->persistent('بستن');
        }
        else
        {
            alert()->error('خطا در ثبت اطلاعات')->persistent('بستن');
        }
        return back();

    }

    public function exportExcel()
    {

        $scholarship=scholarship::get();
        foreach ($scholarship as $item)
        {
            if($item->user->created_at>'2022-07-20 00:00:00')
            {
                $item->newUser='*';
            }

            $item->created_at=$this->changeTimestampToShamsi($item->created_at);
        }



        Artisan::call('cache:clear');
        Artisan::call('view:clear');
        $dateNow = verta();
        $this->dateNow = $dateNow->format('Ymd');
        $this->timeNow = $dateNow->format('His');
        $fileName=$this->dateNow.$this->timeNow.".xlsx";

        $list=[];

        foreach ($scholarship as $item) {
            array_push($list,['جدید'=>$item['newUser'],'نام'=>$item->user->fname,'نام خانوادگی'=>$item->user->lname,'تلفن همراه'=>$item->user->tel,'تاریخ ثبت نام'=>substr($item->created_at,0,10)]);
        }

        $excel=fastexcel($list)->export($fileName);

        if($excel)
        {
            return response()->download(public_path($fileName))
                                ->deleteFileAfterSend(true);
        }
    }

    public function sendSMS_incompleteProfile()
    {
        $scholarship=scholarship::get();
        $user_incomplete=[];
        foreach ($scholarship as $item)
        {
            if(strlen($item->user->email)==0||strlen($item->user->fname)==0||strlen($item->user->lname)==0||strlen($item->user->datebirth)==0|| strlen($item->user->father)==0|| strlen($item->user->codemelli)==0||strlen($item->user->sex)==0||strlen($item->user->tel)==0||strlen($item->user->shenasname)==0||strlen($item->user->born)==0||strlen($item->user->education)==0||strlen($item->user->reshteh)==0||strlen($item->user->job)==0||strlen($item->user->state)==0||strlen($item->user->city)==0||strlen($item->user->address)==0||strlen($item->user->personal_image)==0||strlen($item->user->resume)==0||strlen($item->user->married)==0)
            {
                array_push($user_incomplete,$item->user);
            }

        }

        foreach ($user_incomplete as $item)
        {
            $msg="$item->fname $item->lname عزیز\n "."مرحله دوم پروفایل بورسیه شما کامل نشده است.\n"."لطفا هرچه سریعتر با استفاده از لینک زیر آن را تکمیل نمایید.\n"."b2n.ir/g42306";
            $item->notify(new sendMessageNotification($item->tel,$msg));

            $followups = followup::where('user_id', '=', $item->id)
                            ->get();

            foreach ($followups as $item)
            {
                $t = followup::where('id', '=', $item->id)   //    $this->get_followup($item->followups_id,NULL,NULL,NULL,"first");
                            ->first();
                $t->flag = 0;
                $t->update();
            }

            followup::create([
                'user_id' => $item->id,
                'insert_user_id' => Auth::user()->id,
                'comment' => "ارسال پیامک: $msg",
                'status_followups' => 11,
                'nextfollowup_date_fa' => NULL,
                'flag' => 1,
                'date_fa' => $this->dateNow,
                'time_fa' => $this->timeNow,

            ]);
        }


//                            with('User')
//                            ->whereHas('User', function($q)
//                            {
//                                  $q->orWhereNull('state')
//                                    ->orWhereNull('email')
//                                    ->orWhereNull('fname')
//                                    ->orWhereNull('lname')
//                                    ->orWhereNull('datebirth')
//                                    ->orWhereNull('father')
//                                    ->orWhereNull('codemelli')
//                                    ->orWhereNull('sex')
//                                    ->orWhereNull('tel')
//                                    ->orWhereNull('shenasname')
//                                    ->orWhereNull('born')
//                                    ->orWhereNull('education')
//                                    ->orWhereNull('reshteh')
//                                    ->orWhereNull('job')
//                                    ->orWhereNull('city')
//                                    ->orWhereNull('address')
//                                    ->orWhereNull('personal_image')
//                                    ->orWhereNull('resume')
//                                    ->orWhereNull('marrie');
//                            })
//                            ->get();





        alert()->success($user_incomplete->count(). " پیامک برای افرادی که پروفایل ناقص دارند ارسال شد")->persistent('بستن');
        return back();

    }
}
