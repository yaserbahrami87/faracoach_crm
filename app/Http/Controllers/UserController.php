<?php

namespace App\Http\Controllers;

use App\User;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Hekmatinasser\Verta\Verta;
use Throwable;
use SweetAlert;

class UserController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $dateNow = verta();
        $this->dateNow = $dateNow->format('Y/m/d');
        $this->timeNow = $dateNow->format('H:i:s');
    }

    public function index(Request $request)
    {
        if(Auth::user()->type==2)
        {
            if(is_null($request->orderby)&&is_null($request->parameter))
            {
                $request['orderby']='id';
                $request['parameter']='desc';
            }

            $users=User::orderby($request['orderby'],$request['parameter'])
                    ->select('users.*')
                    ->groupby('users.id')
                    ->paginate($this->countPage());


            foreach ($users as $item)
            {
                $item->created_at=$this->changeTimestampToShamsi($item->created_at);
                if(!is_null($item->last_login_at))
                {
                    $item->last_login_at = $this->changeTimestampToShamsi($item->last_login_at);
                }

                $expert=$this->get_user_byID($item->followby_expert);
                if(!is_null($expert))
                {
                    $item->followby_expert=$expert->fname." ".$expert->lname;
                }

                $item->status_followups=$this->userType($this->get_lastFollowupUser($item->id)['status_followups']);
                $item->countFollowup=$this->get_countFollowup($item->id);
                $item->quality=$this->get_lastFollowupUser($item->id)['problem'];
                $item->quality_color=$this->get_lastFollowupUser($item->id)['color'];
                $item->lastDateFollowup=$this->get_lastFollowupUser($item->id)['date_fa'];
                $item->lastFollowupCourse=$this->get_lastFollowupUser($item->id)['course_id'];
                $item->lastFollowupCourse=$this->get_coursesByID($item->lastFollowupCourse)['course'];
                if(is_null($item->personal_image))
                {
                    $item->personal_image="default-avatar.png";
                }
            }
            $tags=$this->get_tags();
            $parentCategory=$this->get_category('پیگیری');

            if(isset($request['user']))
            {
                //لیست تعداد کاربرها
                $notfollowup = count($this->get_notfollowup_withoutPaginate());
                $continuefollowup = count($this->get_continuefollowup_withoutPaginate());
                $cancelfollowup = count($this->get_cancelfollowup_withoutPaginate());
                $waiting = count($this->get_waiting_withoutPaginate());
                $noanswering = count($this->get_noanswering_withoutPaginate());
                $students = count($this->get_students_withoutPaginate());
                $todayFollowup = count($this->get_todayFollowup_withoutPaginate());
                $expireFollowup = $this->get_expireFollowup_withoutPaginate();
                $myfollowup = count($this->get_myfollowup_withoutPaginate());
                $followedToday = count($this->get_followedToday_withoutPaginate());
                $trashuser=count($this->getAll_trashuser_withoutPaginate());


            }
            else
            {
                //لیست تعداد کاربرها
                $notfollowup = count($this->get_notfollowup_withoutPaginate());
                $continuefollowup = count($this->get_continuefollowup_withoutPaginate());
                $cancelfollowup = count($this->get_cancelfollowup_withoutPaginate());
                $waiting = count($this->get_waiting_withoutPaginate());
                $noanswering = count($this->get_noanswering_withoutPaginate());
                $students = count($this->get_students_withoutPaginate());
                $todayFollowup = count($this->get_todayFollowup_withoutPaginate());
                $expireFollowup = $this->get_expireFollowup_withoutPaginate();
                $myfollowup = count($this->get_myfollowup_withoutPaginate());
                $followedToday = count($this->get_followedToday_withoutPaginate());
                $trashuser=count($this->getAll_trashuser_withoutPaginate());
            }

            $usersAdmin=user::orwhere('type','=',2)
                            ->orwhere('type','=',3)
                            ->get();

            if(isset($request['user']))
            {
                $user=$request['user'];
            }
            else
            {
                $user="";
            }

            if(!is_null($request->orderby)&&(!is_null($request->parameter))) {
                $users->appends(['orderby'=>$request['orderby']]);
                $users->appends(['parameter'=>$request['parameter']]);
            }
            return view('panelAdmin.users')
                ->with('users',$users)
                ->with('tags',$tags)
                ->with('parentCategory',$parentCategory)
                ->with('usersAdmin',$usersAdmin)
                ->with('followedToday',$followedToday)
                ->with('myfollowup',$myfollowup)
                ->with('todayFollowup',$todayFollowup)
                ->with('students',$students)
                ->with('noanswering',$noanswering)
                ->with('waiting',$waiting)
                ->with('cancelfollowup',$cancelfollowup)
                ->with('continuefollowup',$continuefollowup)
                ->with('notfollowup',$notfollowup)
                ->with('user',$user)
                ->with('trashuser',$trashuser)
                ->with('parameter',$request['parameter']);
        }
        else
        {
            if(is_null($request->orderby)&&is_null($request->parameter))
            {
                $request['orderby']='id';
                $request['parameter']='desc';
            }
            $users=User::leftjoin('followups','users.id','=','followups.user_id')
                        ->where(function($query)
                        {
                            $query->orwhere('followby_expert','=',Auth::user()->id)
                                  ->orwhere('followby_expert','=',NULL);
                        })
                        ->whereNotIn('users.type',[2,3,0])
                        ->select('users.*')
                        ->orderby($request['orderby'],$request['parameter'])
                        ->groupby('users.id')
                        ->paginate($this->countPage());


            //لیست تعداد کاربرها
            $notfollowup = $this->get_user(NULL,NULL,1,NULL,NULL,NULL )->count();
            $continuefollowup = $this->get_usersByType(11,Auth::user()->id,NULL,NULL,NULL,NULL )->count();
            $cancelfollowup = $this->get_usersByType(12,Auth::user()->id,NULL,NULL,NULL,NULL )->count();
            $waiting = $this->get_usersByType(13,Auth::user()->id,NULL,NULL,NULL,NULL )->count();
            $noanswering = $this->get_usersByType(14,Auth::user()->id,NULL,NULL,NULL,NULL )->count();
            $students = $this->get_usersByType(20,Auth::user()->id,NULL,NULL,NULL,NULL )->count();
            $condition=['nextfollowup_date_fa',$this->dateNow];
            $todayFollowup = $this->get_usersByType(NULL,Auth::user()->id,NULL,NULL,$condition,NULL )->count();
            $expireFollowup = $this->get_expireFollowup_withoutPaginate();
            $myfollowup = $this->get_usersByType(NULL,Auth::user()->id,NULL,NULL,NULL,NULL )->count();
            $condition=['date_fa',$this->dateNow];
            $followedToday = $this->get_usersByType(NULL,Auth::user()->id,NULL,NULL,$condition,NULL )->count();
            $trashuser=$this->get_usersByType(0,Auth::user()->id,NULL,NULL,NULL,NULL )->count();





            foreach ($users as $item)
            {
                $item->created_at=$this->changeTimestampToShamsi($item->created_at);
                if(!is_null($item->last_login_at))
                {
                        $item->last_login_at = $this->changeTimestampToShamsi($item->last_login_at);
                }

                $item->status_followups=$this->userType($this->get_lastFollowupUser($item->id)['status_followups']);
                $item->countFollowup=$this->get_countFollowup($item->id);
                $item->quality=$this->get_lastFollowupUser($item->id)['problem'];
                $item->quality_color=$this->get_lastFollowupUser($item->id)['color'];
                $item->lastDateFollowup=$this->get_lastFollowupUser($item->id)['date_fa'];
                $item->lastFollowupCourse=$this->get_lastFollowupUser($item->id)['course_id'];
                $item->lastFollowupCourse=$this->get_coursesByID($item->lastFollowupCourse)['course'];

                if(!is_null($item->introduced))
                {
                    if ($this->get_user(NULL, $item->introduced, NULL, NULL, true)->count()>0)
                    {
                        $item->introduced = $this->get_user(NULL, $item->introduced, NULL, NULL, true)->fname.' '.$this->get_user(NULL, $item->introduced, NULL, NULL, true)->lname ;
                    }
                    else if ($this->get_user($item->introduced, NULL, NULL, NULL, true)->count()>0)
                    {

                        $item->introduced=$this->get_user($item->introduced, NULL, NULL, NULL, true)->fname.' '.$this->get_user($item->introduced, NULL, NULL, NULL, true)->lname;

                    }
                }

                if(is_null($item->personal_image))
                {
                    $item->personal_image="default-avatar.png";
                }
            }
            $tags=$this->get_tags();
            $parentCategory=$this->get_category('پیگیری');

            if(!is_null($request->orderby)&&(!is_null($request->parameter))) {
                $users->appends(['orderby'=>$request['orderby']]);
                $users->appends(['parameter'=>$request['parameter']]);
            }

            return view('panelAdmin.users')
                        ->with('users',$users)
                        ->with('tags',$tags)
                        ->with('parentCategory',$parentCategory)
                        ->with('followedToday',$followedToday)
                        ->with('myfollowup',$myfollowup)
                        ->with('todayFollowup',$todayFollowup)
                        ->with('students',$students)
                        ->with('noanswering',$noanswering)
                        ->with('waiting',$waiting)
                        ->with('cancelfollowup',$cancelfollowup)
                        ->with('continuefollowup',$continuefollowup)
                        ->with('notfollowup',$notfollowup)
                        ->with('parameter',$request['parameter']);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,User $user)
    {

        $check=User::where('codemelli','=',$request['codemelli'])
                    ->orwhere('email','=',$request['email'])
                    ->count();

        if($check>0)
        {
            alert()->error("کد ملی / پست الکترونیکی تکراری است",'خطا')->persistent('بستن');
//            $msg="کد ملی / پست الکترونیکی تکراری است";
//            $errorStatus="danger";
        }
        else
        {

            $this->validate(request(),
            [
                'fname'             =>'persian_alpha|required|min:3',
                'lname'             =>'persian_alpha|required|min:3',
                'codemelli'         =>'nullable|melli_code',
                'sex'               =>'nullable|boolean',
                'tel'               =>'required|iran_mobileiran_mobile',
                'shenasname'        =>'nullable|numeric',
                'father'            =>'nullable|min:3|',
                'born'              =>'nullable|min:3',
                'married'           =>'nullable|boolean',
                'education'         =>'nullable|min:4',
                'reshteh'           =>'nullable|min:4',
                'state'             =>'nullable|min:4',
                'city'              =>'nullable|min:4',
                'address'           =>'nullable|min:4',
                'personal_image'    =>'nullable|mimes:jpeg,jpg,pdf|max:600',
                'shenasnameh_image' =>'nullable|mimes:jpeg,jpg,pdf|max:600',
                'cartmelli_image'   =>'nullable|mimes:jpeg,jpg,pdf|max:600',
                'education_image'   =>'nullable|mimes:jpeg,jpg,pdf|max:600',
                'email'             =>'required|email',
                'password'          =>'required_with:repassword|string',
                'repassword'        =>'required',
                'rules'             =>'required'
            ]);
            $shenasnameh_image=$cartmelli_image=$education_image=$personal_image=NULL;

            if($request->has('personal_image')&&$request->file('personal_image')->isValid())
            {
                $file=$request->file('personal_image');
                $personal_image="personal-".$request->codemelli.".".$request->file('personal_image')->extension();
                $path=public_path('/documents/users/');
                $files=$request->file('personal_image')->move($path, $personal_image);
                $request->personal_image=$personal_image;
            }

            if($request->has('shenasnameh_image')&&$request->file('shenasnameh_image')->isValid())
            {
                $file=$request->file('shenasnameh_image');
                $shenasnameh_image="shenasnameh-".$request->codemelli.".".$request->file('shenasnameh_image')->extension();
                $path=public_path('/documents/users/');
                $files=$request->file('shenasnameh_image')->move($path, $shenasnameh_image);
                $request->shenasnameh_image=$shenasnameh_image;

            }
            /*
            if($request->has('cartmelli_image')&&$request->file('cartmelli_image')->isValid())
            {
                $file=$request->file('cartmelli_image');
                $cartmelli_image="cartmelli-".$request->codemelli.".".$request->file('cartmelli_image')->extension();
                $path=public_path('/documents/users/');
                $files=$request->file('cartmelli_image')->move($path, $cartmelli_image);
                $request->cartmelli_image=$cartmelli_image;
            }

            if($request->has('education_image')&&$request->file('education_image')->isValid())
            {
                $file=$request->file('education_image');
                $education_image="education-".$request->codemelli.".".$request->file('education_image')->extension();
                $path=public_path('/documents/users/');
                $files=$request->file('education_image')->move($path, $education_image);
                $request->education_image=$education_image;
            }
            */
            $type=1;
            $status = User::create([
                'fname'                     => $request['fname'],
                'lname'                     => $request['lname'],
                'codemelli'                 => $request['codemelli'],
                'sex'                       => $request['sex'],
                'tel'                       => $request['tel'],
                'shenasname'                => $request['shenasname'],
                'father'                    => $request['father'],
                'born'                      => $request['born'],
                'married'                   => $request['married'],
                'education'                 => $request['education'],
                'reshteh'                   => $request['reshteh'],
                'state'                     => $request['state'],
                'city'                      => $request['city'],
                'address'                   => $request['address'],
                'personal_image'            => $personal_image,
                'shenasnameh_image'         => $shenasnameh_image,
                'cartmelli_image'           => $cartmelli_image,
                'education_image'           => $education_image,
                'email'                     => $request['email'],
                'password'                  => Hash::make($request['password']),
                'type'                      => $type,
                'email_verification_token'  => Str::random(32)
            ]);

            if($status)
            {
                $msg="اطلاعات با موفقیت در سیستم ثبت شد";
                alert()->success("اطلاعات با موفقیت در سیستم ثبت شد",'پیام')->persistent('بستن');



                // Send SMS
                $this->sendSms($request['tel'],' به زودی کارشناسان ما با شما تماس خواهند گرفت');

                $url = "https://ippanel.com/services.jspd";
                $rcpt_nm = array($request['tel']);
                $param = array
                            (
                                'uname'=>'09154665888',
                                'pass'=>'qSo9e_o2S3',
                                'from'=>'10003816',
                                'message'=>$msg ." به زودی کارشناسان ما با شما تماس خواهند گرفت",
                                'to'=>json_encode($rcpt_nm),
                                'op'=>'send'
                            );

                $handler = curl_init($url);
                curl_setopt($handler, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($handler, CURLOPT_POSTFIELDS, $param);
                curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
                $response2 = curl_exec($handler);
                $response2 = json_decode($response2);
                $res_code = $response2[0];
                $res_data = $response2[1];
            }
        }
        return back();

    }

    public function showRegister()
    {
        $settingsms=$this->get_settingsmsByType(2);
        return view('panelAdmin.registerUser')
                    ->with('settingsms',$settingsms);

    }
    //Register User by Admin
    public function register(Request $request)
    {

        $this->validate($request, [
            'fname'         => ['nullable','persian_alpha', 'string', 'max:30'],
            'lname'         => ['nullable','persian_alpha', 'string', 'max:30'],
            'email'         => ['nullable', 'string', 'email', 'max:150', 'unique:users'],
            'sex'           => ['required','numeric'],
            'tel'           => ['required','iran_mobile','unique:users'],
            'password'      => ['required', 'string', 'confirmed'],
            'tel_verified'  => ['required','boolean'],
            'introduced'    => ['nullable','numeric'],
            'gettingknow'   => ['nullable','persian_alpha'],
            'organization'  => ['nullable','persian_alpha'],
            'jobside'       => ['nullable','persian_alpha']
        ]);

        if(!isset($request['gettingknow']))
        {
            $request['gettingknow']=NULL;
        }

        if(!isset($request['introduced']))
        {
            $request['introduced']=NULL;
        }

        $status=User::create([
            'fname'             => $request['fname'],
            'lname'             => $request['lname'],
            'sex'               => $request['sex'],
            'email'             => $request['email'],
            'tel'               => $request['tel'],
            'tel_verified'      => $request['tel_verified'],
            'password'          => Hash::make($request['password']),
            'introduced'        => $request['introduced'],
            'gettingknow'       => $request['gettingknow'],
            'insert_user_id'    =>Auth::user()->id,
            'organization'      => $request['organization'],
            'jobside'           => $request['jobside'],
        ]);

        if($status)
        {
            if($request['sendsms']!="0")
            {
                if($request['sex']==1)
                {
                    $request['sex']="آقای ";
                }
                else if($request['sex']==0)
                {
                    $request['sex']="خانم ";
                }
                else
                {
                    $request['sex']="خانم/آقای ";
                }
                $request['sendsms']=str_replace("{tel}",$request['tel'],$request['sendsms']);
                $request['sendsms']=str_replace("{fname}",$request['fname'],$request['sendsms']);
                $request['sendsms']=str_replace("{lname}",$request['lname'],$request['sendsms']);
                $request['sendsms']=str_replace("{datebirth}",$request['datebirth'],$request['sendsms']);
                $request['sendsms']=str_replace("{sex}",$request['sex'],$request['sendsms']);
                $request['sendsms']=$request['sendsms']."\n  نام کاربری:".$request['tel']."\n رمز عبور:".$request['password']. "\n ";
                $request['sendsms']=(str_replace('...','',$request['sendsms']));
                $this->sendSms($request['tel'],$request['sendsms']);
            }
            alert()->success("کاربر با موفقیت در سیستم ثبت شد",'پیام')->persistent('بستن');
            return back();
        }
        else
        {
            alert()->error("خطا در ثبت کاربر",'خطا')->persistent('بستن');
            return back();
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


     // نمایش اطلاعات پروفایل خود کاربر
    public function profile(User $user)
    {
        $user=(Auth::user());

        if(strlen($user->personal_image)==0)
            {
                $user->personal_image="default-avatar.png";
            }

        //تعداد افراد دعوت شده
        $countIntroducedUser=User::where('introduced','=',$user->tel)
                        ->count();

        //یوزر توسط چه کسی معرفی شده است
        $resourceIntroduce=User::where('tel','=',$user->introduced)
                        ->first();

        $states=$this->states();

        //انتخاب شهر براساس کد
        $city=$this->city($user->city);

        return view ('panelUser.profile')
                        ->with('user',$user)
                        ->with('countIntroducedUser',$countIntroducedUser)
                        ->with('resourceIntroduce',$resourceIntroduce)
                        ->with('states',$states)
                        ->with('city',$city);
    }


    // نمایش پروفایل کاربر توسط ادمین
    public function show($user)
    {

        $userAdmin=Auth::user();
        //تعداد پیگیری های انجام شده
        $countFollowups=User::join('followups','users.id','=','followups.user_id')
                            ->where('users.id','=',$user)
                            ->count();


        //لیست پیگیری های انجام شده
        $followUps=User::join('followups','users.id','=','followups.user_id')
                        //->join('followups','users.id','=','followups.insert_user_id')
                        ->leftjoin('problemfollowups','problemfollowups.id','=','followups.problemfollowup_id')
                        ->where('followups.user_id','=',$user)
                        ->orderby('followups.id','desc')
                        ->get();
        foreach ($followUps as $item)
        {

            $admin_Followup=User::where('id','=',$item->insert_user_id)
                                ->first();
            $item->insert_user_id=$admin_Followup->fname." ".$admin_Followup->lname;
            $item->status_followups=$this->userType($item->status_followups);
            if(!is_null($item->course_id))
            {
                $item->course_id=$this->get_coursesByID($item->course_id)->course;
            }

        }

        //تبدیل تگهای پیگیری
       foreach ($followUps as $item)
       {
           $tmp=array();
           //تبدیل رشته به آرایه
           $arrayTags=explode(',',$item->tags);
           //حلقه تبدیل آدید تگ ها به رشته
           for ($i=0;$i<count($arrayTags);$i++)
           {
               $temp=$this->get_tag_byID($arrayTags[$i]);
               $tagName=$temp['tag'];
               array_push($tmp, "$tagName");
           }
           //اضافه کردن آرایه تگها بجای آرایه آدی ها
           $item->tags=$tmp;
       }

        //دسته بندی های لیست پیگیری
        $problemFollowup=$this->getproblemfollowup();

        //مقدار یوزر با توجه به دستور زیر مقدار ورودی تابع با مقدار خروجی تقییر میکند
        $user=User::find($user);

        if (strlen($user->personal_image) == 0) {
            $user->personal_image = "default-avatar.png";
        }

        //یوزر توسط چه کسی معرفی شده است
        $resourceIntroduce = User::where('id', '=', $user->introduced)
            ->first();

        // دریافت لیست مسئولین پیگیری
        $expert_followup = user::where(function ($query) {
            $query->orwhere('type', '=', 2)
                ->orwhere('type', '=', 3);
        })
            //->where('id','<>',Auth::user()->id)
            ->get();


        //تعداد افراد معرفی کرده
        $countIntroducedUser = User::where('introduced', '=', $user->id)
            ->count();
        $introducedUser = User::where('introduced', '=', $user->id)
            ->get();

        $introducedTree=[];
//        dd(gettype($introducedTree));
//        foreach ($introducedUser as $item)
//        {
//            $introducedTree=array_push($introducedTree,User::where('introduced', '=', $item->id)->get());
//        }

//        dd($introducedTree);


        //لیست افراد معرفی کرده
        $listIntroducedUser = User::where('introduced', '=', $user->id)
            ->get();

        //چک کردن وضعیت عکس کاربرها برای عکسهایی که وجود ندارد از آواتر استفاده شود
        foreach ($listIntroducedUser as $item) {
            if (strlen($item->personal_image) == 0) {
                $item->personal_image = "default-avatar.png";
            }
        }


        $introduced = User::where('id', '=', $user->introduced)
            ->first();
        if (strlen($introduced) > 0) {
            $user->introduced = $introduced->fname . " " . $introduced->lname . " با کد " . $introduced->id;
        }

        $states = $this->states();

        $city = NULL;
        if (strlen($user->city) > 0) {
            //انتخاب شهر براساس کد
            $city = $this->city($user->city);
        }

        //تگ ها
        $tags = $this->get_tags();
        $parentCategory = $this->get_category('پیگیری');

        //کسب امتیازات
        $score=0;
        $scoreIntroducedUser=$countIntroducedUser* ($this->get_scores()->introduced);
        $score=$score+$scoreIntroducedUser;


        $verifyScore=$user->tel_verified;
        if($verifyScore==1)
        {
            $scoreTelverify=$this->get_scores()->tel_verified;
            $score=$score+$scoreTelverify;
        }
        else
        {
            $scoreTelverify=0;
        }
        $SuccessIntroduced=User::where('introduced','=',$user->id)
            ->where('type','=',20)
            ->count();



        $scoreSuccess=$SuccessIntroduced*($this->get_scores()->changeintroduced);
        $score=$score+$scoreSuccess;

        $today = $this->dateNow;
        $timeNow = $this->timeNow;
        $v = verta('+2 day');
        $v = $v->format('Y/m/d');
        $nextDayFollow = $v;




        //لیست دوره ها
        $courses=$this->get_courses($this->dateNow);

        //لیست پیامکها
        $settingsms=$this->get_settingsmsByType(1);
        foreach ($settingsms as $item)
        {
           $item->comment=str_replace("\r\n","<br>",$item->comment);
           $item->comment=str_replace('{tel}',$user->tel,$item->comment);
           $item->comment=str_replace('{fname}',$user->fname,$item->comment);
           $item->comment=str_replace('{lname}',$user->lname,$item->comment);
           $item->comment=str_replace('{datebirth}',$user->datebirth,$item->comment);
           if($user->sex==0)
           {
               $item->comment=str_replace('{sex}','سرکارخانم ',$item->comment);
           }
           else if($user->sex==1)
           {
               $item->comment=str_replace('{sex}','جناب آقای ',$item->comment);
           }
        }



        return view('panelAdmin.profile')
                    ->with('user',$user)
                    ->with('countFollowups',$countFollowups)
                    ->with('followUps',$followUps)
                    ->with('problemFollowup',$problemFollowup)
                    ->with('userAdmin',$userAdmin)
                    ->with('listIntroducedUser',$listIntroducedUser)
                    ->with('countIntroducedUser',$countIntroducedUser)
                    ->with('resourceIntroduce',$resourceIntroduce)
                    ->with('states',$states)
                    ->with('city',$city)
                    ->with('score',$score)
                    ->with('verifyScore',$verifyScore)
                    ->with('scoreSuccess',$scoreSuccess)
                    ->with('settingsms',$settingsms)
                    ->with('tags',$tags)
                    ->with('today',$today)
                    ->with('nextDayFollow',$nextDayFollow)
                    ->with('timeNow',$timeNow)
                    ->with('expert_followup',$expert_followup)
                    ->with('parentCategory',$parentCategory)
                    ->with('courses',$courses)
                    ->with('scoreIntroducedUser',$scoreIntroducedUser)
                    ->with('SuccessIntroduced',$SuccessIntroduced)
                    ->with('scoreTelverify',$scoreTelverify);

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
    public function update(Request $request,User $user)
    {
            $this->validate(request(),
                [
                    'username'          =>'nullable|max:200|regex:/^(?=[a-zA-Z0-9._]{3,20}$)(?!.*[_.]{2})[^_.].*[^_.]$/u',
                    'fname'             =>'nullable|persian_alpha',
                    'lname'             =>'nullable|persian_alpha',
                    'codemelli'         =>'nullable|numeric|',
                    'sex'               =>'nullable|boolean',
                    'tel'               =>'nullable|iran_mobile',
                    'shenasname'        =>'nullable|numeric|',
                    'datebirth'         =>'nullable|max:11|string',
                    'father'            =>'nullable|persian_alpha|',
                    'born'              =>'nullable|persian_alpha|',
                    'married'           =>'nullable|boolean',
                    'education'         =>'nullable|persian_alpha|',
                    'reshteh'           =>'nullable|persian_alpha|',
                    'job'               =>'nullable|persian_alpha|',
                    'state'             =>'nullable|numeric',
                    'city'              =>'nullable|numeric',
                    'address'           =>'nullable|min:4|string',
                    'personal_image'    =>'nullable|mimes:jpeg,jpg,bmp|max:600',
                    'shenasnameh_image' =>'nullable|mimes:jpeg,jpg,bmp|max:600',
                    'cartmelli_image'   =>'nullable|mimes:jpeg,jpg,bmp|max:600',
                    'education_image'   =>'nullable|mimes:jpeg,jpg,bmp|max:600',
                    'resume'            =>'nullable|mimes:docx,doc,pdf|max:1024',
                    'email'             =>'nullable|email|',
                    'gettingknow'       =>'nullable|string',
                    'introduced'        =>'nullable|numeric',
                    'telegram'          =>'nullable|max:50|regex:/^(?=[a-zA-Z0-9._]{3,20}$)(?!.*[_.]{2})[^_.].*[^_.]$/u',
                    'instagram'         =>'nullable|max:50|regex:/^(?=[a-zA-Z0-9._]{3,20}$)(?!.*[_.]{2})[^_.].*[^_.]$/u',
                    'linkedin'          =>'nullable|string|max:250',
                    'aboutme'           =>'nullable|string|max:250',
                ]);


            if ($request->has('personal_image') && $request->file('personal_image')->isValid()) {
                $file = $request->file('personal_image');
                $personal_image = "personal-" . $user->tel . "." . $request->file('personal_image')->extension();
                $path = public_path('/documents/users/');
                $files = $request->file('personal_image')->move($path, $personal_image);
                $request->personal_image = $personal_image;
            }

            if ($request->has('shenasnameh_image') && $request->file('shenasnameh_image')->isValid()) {
                $file = $request->file('shenasnameh_image');
                $shenasnameh_image = "shenasnameh-" . $user->tel . "." . $request->file('shenasnameh_image')->extension();
                $path = public_path('/documents/users/');
                $files = $request->file('shenasnameh_image')->move($path, $shenasnameh_image);
                $request->shenasnameh_image = $shenasnameh_image;

            }

            if ($request->has('cartmelli_image') && $request->file('cartmelli_image')->isValid()) {
                $file = $request->file('cartmelli_image');
                $cartmelli_image = "cartmelli-" . $user->tel . "." . $request->file('cartmelli_image')->extension();
                $path = public_path('/documents/users/');
                $files = $request->file('cartmelli_image')->move($path, $cartmelli_image);
                $request->cartmelli_image = $cartmelli_image;
            }

            if ($request->has('education_image') && $request->file('education_image')->isValid()) {
                $file = $request->file('education_image');
                $education_image = "education-" . $user->tel . "." . $request->file('education_image')->extension();
                $path = public_path('/documents/users/');
                $files = $request->file('education_image')->move($path, $education_image);
                $request->education_image = $education_image;
            }

            if ($request->has('resume') && $request->file('resume')->isValid()) {
                $file = $request->file('resume');
                $resume = "resume-" . $user->tel . "." . $request->file('resume')->extension();
                $path = public_path('/documents/users/');
                $files = $request->file('resume')->move($path, $resume);
                $request->resume = $resume;
            }
            try {
                $user->update($request->all());
            } catch (Throwable $e) {

//                $msg = $e->errorInfo[2];
//                $errorStatus = "danger";
                alert()->error($e->errorInfo[2],'خطا')->persistent('بستن');
                return back();
//                    ->with('msg', $msg)
//                    ->with('errorStatus', $errorStatus);
            }

            if (isset($personal_image)) {
                $user->personal_image = $personal_image;
            }

            if (isset($shenasnameh_image)) {
                $user->shenasnameh_image = $shenasnameh_image;
            }

            if (isset($cartmelli_image)) {
                $user->cartmelli_image = $cartmelli_image;
            }

            if (isset($education_image)) {
                $user->education_image = $education_image;
            }

            if (isset($resume)) {
                $user->resume = $resume;
            }

            $user->save();
            alert()->success('پروفایل با موفقیت به روزرسانی شد','پیام')->persistent('بستن');
            return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(user $user)
    {
        if(isset($user))
        {

            if($user->id!=Auth::user()->id)
            {
                //$status=$user->delete();
                $user->type=0;
                $status=$user->save();
                if($status)
                {
                    alert()->success("اطلاعات با موفقیت حذف شد",'پیام')->persistent('بستن');
                }
                else
                {
                    alert()->error("خطا در حذف کاربر",'خطا')->persistent('بستن');
                }
                return back();
            }
            else
            {
                alert()->error("شما در حال حذف کاربری خود میباشید و امکان آن وجود ندارد",'خطا')->persistent('بستن');
                return redirect('/admin/users');
            }
        }
        else
        {
            return redirect('/admin/users');
        }
    }

    // select User introduced and showAjax
    public function introducedUserAjax($user)
    {
        $user=User::where ('id','=',$user)
                ->first();

        if(strlen($user->personal_image)==0)
        {
            $user->personal_image="default-avatar.png";

        }
        $user->type=$this->userType($user->type);
        if(!is_null($user->last_login_at))
        {
            $last_login=new verta($user->last_login_at);
            $user->last_login_at=($last_login->hour.":".$last_login->minute."  ".$last_login->year."/".$last_login->month."/".$last_login->day);
        }
        return view('panelUser.introducedProfileAjax')
                ->with('user',$user);
    }

    public function categorybyAdmin(Request $request)
    {
        if(Auth::user()->type==2) {
            if (!is_null($request) &&(strlen($request['user'])>0)) {
                $users = user::where('followby_expert', '=', $request['user'])
                        ->paginate($this->countPage());
                $countList = user::where('followby_expert', '=', $request['user'])
                        ->count();
                if(is_null($request->orderby)&&is_null($request->parameter))
                {
                    $request['orderby']='id';
                    $request['parameter']='desc';
                }
                foreach ($users as $item)
                {
                    $expert=$this->get_user_byID($item->followby_expert);
                    if(!is_null($expert))
                    {
                        $item->followby_expert=$expert->fname." ".$expert->lname;
                    }

                    $item->status_followups=$this->userType($this->get_lastFollowupUser($item->id)['status_followups']);
                    $item->quality=$this->get_lastFollowupUser($item->id)['problem'];
                    $item->quality_color=$this->get_lastFollowupUser($item->id)['color'];
                    $item->lastDateFollowup=$this->get_lastFollowupUser($item->id)['date_fa'];
                    $item->lastFollowupCourse=$this->get_lastFollowupUser($item->id)['course_id'];
                    $item->lastFollowupCourse=$this->get_coursesByID($item->lastFollowupCourse)['course'];
                    if(is_null($item->personal_image))
                    {
                        $item->personal_image="default-avatar.png";
                    }
                }
                $users->appends(['user' => $request['user']]);
                $tags = $this->get_tags();
                $parentCategory = $this->get_category('پیگیری');
                $usersAdmin = user::orwhere('type', '=', 2)
                    ->orwhere('type', '=', 3)
                    ->get();



                //لیست تعداد کاربرهای هر شخص
                $notfollowup=count($this->get_notfollowup_withoutPaginate());
                $continuefollowup=count($this->get_continuefollowupbyID_withoutPaginate($request['user']));
                $cancelfollowup=count($this->get_cancelfollowupbyID_withoutPaginate($request['user']));
                $waiting=count($this->get_waitingbyID_withoutPaginate($request['user']));
                $noanswering=count($this->get_noansweringbyID_withoutPaginate($request['user']));
                $students =count($this->get_studentsbyID_withoutPaginate($request['user']));
                $todayFollowup = count($this->get_todayFollowupbyID_withoutPaginate($request['user']));
                $expireFollowup = $this->get_expireFollowupbyID($request['user']);
                $myfollowup=count($this->get_myfollowupbyID_withoutPaginate($request['user']));
                $followedToday = count($this->get_followedTodaybyID_withoutPaginate($request['user']));
                $trashuser=count($this->getAll_trashuser_withoutPaginate());

                return view('panelAdmin.users')
                    ->with('tags', $tags)
                    ->with('users', $users)
                    ->with('countList', $countList)
                    ->with('parentCategory', $parentCategory)
                    ->with('usersAdmin', $usersAdmin)
                    ->with('followedToday',$followedToday)
                    ->with('myfollowup',$myfollowup)
                    ->with('todayFollowup',$todayFollowup)
                    ->with('students',$students)
                    ->with('noanswering',$noanswering)
                    ->with('waiting',$waiting)
                    ->with('cancelfollowup',$cancelfollowup)
                    ->with('continuefollowup',$continuefollowup)
                    ->with('notfollowup',$notfollowup)
                    ->with('user',$request['user'])
                    ->with('trashuser',$trashuser)
                    ->with('parameter',$request['parameter'])
                    ->with('orderby',$request['orderby']);
            } else {
                return redirect('/admin/users');
            }
        }
    }

    // نمایش اعضای سایت براساس دسته بندی برای ادمین
    public function showCategoryUsersAdmin(Request $request)
    {
        if(is_null($request->orderby)&&is_null($request->parameter))
        {
            $request['orderby']='id';
            $request['parameter']='desc';
        }
        $dateNow=$this->dateNow;

        if(Auth::user()->type==2)
        {
            if (!is_null($request)&&(strlen($request['user'])>0)) {
                switch ($request['categoryUsers']) {
                    case '0':
                        return redirect('/admin/users/');
                        break;
                    case 'notfollowup':
                        $users = $this->get_notfollowup($request['orderby'],$request['parameter']);
                        break;
                    case 'continuefollowup':
                        $users =$this->get_usersByType(11,$request['user'],true);

                        break;
                    case 'cancelfollowup':
                        $users = User::join('followups','users.id','=','followups.user_id')
                            ->where('status_followups', '=', '12')
                            ->where('followby_expert', '=', $request['user'])
                            ->orderby('users.id', 'desc')
                            ->groupby('users.id')
                            ->paginate($this->countPage());
                        break;
                    case 'waiting' :
                        $users = User::join('followups','users.id','=','followups.user_id')
                            ->where('status_followups', '=', '13')
                            ->where('followby_expert', '=', $request['user'])
                            ->orderby('users.id', 'desc')
                            ->paginate($this->countPage());
                        break;
                    case 'noanswering':
                        $users = User::join('followups','users.id','=','followups.user_id')
                            ->where('status_followups', '=', '14')
                            ->where('followby_expert', '=', $request['user'])
                            ->orderby('users.id', 'desc')
                            ->paginate($this->countPage());
                        break;
                    case 'students':
                        $users = User::join('followups','users.id','=','followups.user_id')
                            ->where('status_followups', '=', '20')
                            ->where('followby_expert', '=', $request['user'])
                            ->orderby('users.id', 'desc')
                            ->paginate($this->countPage());
                        break;
                    case 'todayFollowup':
                        $users = User::join('followups', 'users.id', '=', 'followups.user_id')
                            ->where('followups.nextfollowup_date_fa', '=', $this->dateNow)
                            ->where('followby_expert', '=', $request['user'])
                            ->select('users.*')
                            ->groupby('users.id')
                            ->orderby('date_fa', 'desc')
                            ->paginate($this->countPage());
                        break;
                    case 'expireFollowup':
                        $users = User::join('followups', 'users.id', '=', 'followups.user_id')
                            ->where('followups.nextfollowup_date_fa', '<', $dateNow)
                            ->where('followby_expert', '=', $request['user'])
                            ->wherenotIn('users.type', [2, 12])
                            ->select('users.*')
                            ->groupby('users.id')
                            ->orderby('date_fa', 'desc')
                            ->paginate($this->countPage());
                        break;
                    case 'myfollowup':
                        $users = User::join('followups', 'users.id', '=', 'followups.user_id')
                            ->where('followups.insert_user_id', '=', Auth::user()->id)
                            ->where('followby_expert', '=', $request['user'])
                            ->select('users.*')
                            ->orderby('date_fa', 'desc')
                            ->groupby('users.id')
                            ->paginate($this->countPage());
                        break;

                    case 'followedToday':
                        $users = User::join('followups', 'users.id', '=', 'followups.user_id')
                            ->where('followups.insert_user_id', '=', Auth::user()->id)
                            ->where('date_fa', '=', $dateNow)
                            ->where('followby_expert', '=', $request['user'])
                            ->select('users.*')
                            ->groupby('users.id')
                            ->orderby('date_fa', 'desc')
                            ->paginate($this->countPage());
                        break;
                    case 'trashuser':
                        $users=User::join('followups', 'users.id', '=', 'followups.user_id')
                            ->where('type', '=', 0)
                            ->select('users.*')
                            ->groupby('users.id')
                            ->orderby('date_fa', 'desc')
                            ->paginate($this->countPage());
                            break;
                    default:
                        return redirect('/admin/users/');
                        break;
                }

                //لیست تعداد کاربرها
                $notfollowup = count($this->get_notfollowup());
                $continuefollowup = count($this->get_continuefollowupbyID_withoutPaginate($request['user']));
                $cancelfollowup = count($this->get_cancelfollowupbyID_withoutPaginate($request['user']));
                $waiting = count($this->get_waitingbyID_withoutPaginate($request['user']));
                $noanswering = count($this->get_noansweringbyID_withoutPaginate($request['user']));
                $students = count($this->get_studentsbyID_withoutPaginate($request['user']));
                $todayFollowup = count($this->get_todayFollowupbyID_withoutPaginate($request['user']));
                $expireFollowup = $this->get_expireFollowupbyID($request['user']);
                $myfollowup = count($this->get_myfollowupbyID_withoutPaginate($request['user']));
                $followedToday = count($this->get_followedTodaybyID_withoutPaginate($request['user']));
                $trashUser=count($this->getAll_trashuser_withoutPaginate());
            }
            else
            {

                switch ($request['categoryUsers']) {
                    case '0':
                        return redirect('/admin/users/');
                        break;
                    case 'notfollowup':
                        $users = $this->get_notfollowup();
                        break;
                    case 'continuefollowup':
                        $users = $this->get_usersByType(11,Auth::user()->id,true);
                        break;
                    case 'cancelfollowup':
                        $users = $this->get_usersByType(12,Auth::user()->id,true);
                        break;
                    case 'waiting' :
                        $users =$users = $this->get_usersByType(13,Auth::user()->id,true);
                        break;
                    case 'noanswering':
                        $users = $this->get_usersByType(14,Auth::user()->id,true);
                        break;
                    case 'students':
                        $users = $this->get_usersByType(20,Auth::user()->id,true);
                        break;
                    case 'todayFollowup':
                        $users = $this->get_todayFollowup();
                        break;
                    case 'expireFollowup':
                        $users = $this->get_expireFollowup();
                        break;
                    case 'myfollowup':

                        $users = $this->get_user(NULL,Auth::user()->id);
                        break;

                    case 'followedToday':
                        $users = User::join('followups', 'users.id', '=', 'followups.user_id')
                            ->where('date_fa', '=', $dateNow)
                            ->where('followby_expert', '=', $request['user'])
                            ->select('users.*')
                            ->groupby('users.id')
                            ->orderby('date_fa', 'desc')
                            ->paginate($this->countPage());
                        break;
                    case 'trashuser':
                        $users=$this->getAll_trashuser();
                            break;
                    default:
                        return redirect('/admin/users/');
                        break;
                }

                //لیست تعداد کاربرها
                $notfollowup = count($this->get_notfollowup_withoutPaginate());
                $continuefollowup = $this->get_usersByType(NULL,Auth::user()->id)->count();
                $cancelfollowup = count($this->getAll_cancelfollowup_withoutPaginate());
                $waiting = count($this->getAll_waiting_withoutPaginate());
                $noanswering = count($this->getAll_noanswering_withoutPaginate());
                $students = count($this->getAll_students_withoutPaginate());
                $todayFollowup = count($this->getAll_todayFollowup_withoutPaginate());
                $expireFollowup = count($this->getAll_expireFollowup());
                $myfollowup = count($this->getAll_myfollowup_withoutPaginate());
                $followedToday = count($this->getAll_followedToday_withoutPaginate());
                $trashUser=count($this->getAll_trashuser_withoutPaginate());
            }
        }
        else {

            switch ($request['categoryUsers']) {
                case '0':
                    return redirect('/admin/users/');
                    break;
                case 'notfollowup':
                    $users = $this->get_notfollowup();
                    break;
                case 'continuefollowup':
                    $users = $this->get_usersByType(11,Auth::user()->id,true);
                    break;
                case 'cancelfollowup':
//                    $users = $this->get_cancelfollowup();
                    $users = $this->get_usersByType(12,Auth::user()->id,true);
                    break;
                case 'waiting' :
                    $users = $this->get_usersByType(13,Auth::user()->id,true);
                    break;
                case 'noanswering':
//                    $users = $this->get_noanswering();
                    $users = $this->get_usersByType(14,Auth::user()->id,true);
                    break;
                case 'students':
//                    $users = $this->get_students();
                    $users = $this->get_usersByType(20,Auth::user()->id,true);
                    break;
                case 'todayFollowup':
                    $users = $this->get_todayFollowup();
                    break;
                case 'expireFollowup':
                    $users = $this->get_expireFollowup();
                    break;
                case 'myfollowup':
//                    $users =$this->get_myfollowup();
                    $users =$this->get_usersByType(NULL,Auth::user()->id,true);
                    break;
                case 'followedToday':
                    $users = $this->get_followedToday();
                    break;
                default:
                    return redirect('/admin/users/');
                    break;
            }

            //لیست تعداد کاربرها
            $notfollowup = count($this->get_notfollowup_withoutPaginate());
//            $continuefollowup = count($this->get_continuefollowup_withoutPaginate());
            $continuefollowup = count($this->get_usersByType(11,Auth::user()->id));
//            $cancelfollowup = count($this->get_cancelfollowup_withoutPaginate());
            $cancelfollowup = count($this->get_usersByType(12,Auth::user()->id));
//            $waiting = count($this->get_waiting_withoutPaginate());
            $waiting = count($this->get_usersByType(13,Auth::user()->id));
//            $noanswering = count($this->get_noanswering_withoutPaginate());
            $noanswering = count($this->get_usersByType(14,Auth::user()->id));
//            $students = count($this->get_students_withoutPaginate());
            $students = count($this->get_usersByType(20,Auth::user()->id));
            $todayFollowup = count($this->get_todayFollowup_withoutPaginate());
            $expireFollowup = $this->get_expireFollowup_withoutPaginate();
            $myfollowup = count($this->get_usersByType(NULL,Auth::user()->id));
            $followedToday = count($this->get_followedToday_withoutPaginate());
            $trashUser=count($this->getAll_trashuser_withoutPaginate());
        }

        foreach ($users as $item)
        {

            $item->status_followups=$this->userType($this->get_lastFollowupUser($item->id)['status_followups']);
            $item->countFollowup=$this->get_countFollowup($item->id);

            $item->created_at = $this->changeTimestampToShamsi($item->created_at);
            if (!is_null($item->last_login_at)) {
                $item->last_login_at = $this->changeTimestampToShamsi($item->last_login_at);
            }

            $item->quality=$this->get_lastFollowupUser($item->id)['problem'];
            $item->quality_color=$this->get_lastFollowupUser($item->id)['color'];
            $expert=$this->get_user_byID($item->followby_expert);

            if(!is_null($expert))
            {
                $item->followby_expert=$expert->fname." ".$expert->lname;
            }

            $item->lastDateFollowup=$this->get_lastFollowupUser($item->id)['date_fa'];
            $item->lastFollowupCourse=$this->get_lastFollowupUser($item->id)['course_id'];
            $item->lastFollowupCourse=$this->get_coursesByID($item->lastFollowupCourse)['course'];
            if(is_null($item->personal_image))
            {
                $item->personal_image="default-avatar.png";
            }

            if(!is_null($item->introduced))
            {
                if ($this->get_user(NULL, $item->introduced, NULL, NULL, true)->count()>0)
                {
                    $item->introduced = $this->get_user(NULL, $item->introduced, NULL, NULL, true)->fname.' '.$this->get_user(NULL, $item->introduced, NULL, NULL, true)->lname ;
                }
                else if ($this->get_user($item->introduced, NULL, NULL, NULL, true)->count()>0)
                {

                    $item->introduced=$this->get_user($item->introduced, NULL, NULL, NULL, true)->fname.' '.$this->get_user($item->introduced, NULL, NULL, NULL, true)->lname;

                }
            }

        }
        $usersAdmin=user::orwhere('type','=',2)
                        ->orwhere('type','=',3)
                        ->get();

        $users->appends(['categoryUsers'=>$request['categoryUsers']]);
        if(!is_null($request->orderby)&&(!is_null($request->parameter))) {
            $users->appends(['orderby'=>$request['orderby']]);
            $users->appends(['parameter'=>$request['parameter']]);
        }

        $tags=$this->get_tags();
        $parentCategory=$this->get_category('پیگیری');


        if(isset($request['user']))
        {
            $user=$request['user'];
        }
        else
        {
            $user="";
        }
        return view('panelAdmin.users')
                    ->with('tags',$tags)
                    ->with('users',$users)
                    ->with('parentCategory',$parentCategory)
                    ->with('usersAdmin',$usersAdmin)
                    ->with('followedToday',$followedToday)
                    ->with('myfollowup',$myfollowup)
                    ->with('todayFollowup',$todayFollowup)
                    ->with('students',$students)
                    ->with('noanswering',$noanswering)
                    ->with('waiting',$waiting)
                    ->with('cancelfollowup',$cancelfollowup)
                    ->with('continuefollowup',$continuefollowup)
                    ->with('notfollowup',$notfollowup)
                    ->with('user',$user)
                    ->with('trashuser',$trashUser)
                    ->with('parameter',$request['parameter'])
                    ->with('categoryUsers',$request['categoryUsers']);
    }


    public function showCategoryTagsAdmin(Request $request)
    {

        if(is_null($request))
        {
            return redirect('/panel');
        }
        else {
            if(is_null($request->orderby)&&is_null($request->parameter))
            {
                $request['orderby']='id';
                $request['parameter']='desc';
            }
            $this->validate($request,
                [
                    'tags'  =>'array|required'
                ]);

            if (!isset($request['tags'])) {
                alert()->error("حداقل یک گزینه برای اعمال فیلترها انتخاب کنید",'خطا')->persistent('بستن');
                return back();
            } else {
                $tags = implode(',', $request['tags']);
                $users = user::join('followups', 'users.id', '=', 'followups.user_id')
                    ->where('followups.tags', 'like', '%' . $tags . '%')
                    ->where('followups.insert_user_id', '=', Auth::user()->id)
                    ->select('users.*')
                    ->groupby('users.id')
                    ->orderby('date_fa', 'desc')
                    ->paginate($this->countPage());


                foreach ($users as $item)
                {
                    $item->status_followups=$this->userType($this->get_lastFollowupUser($item->id)['status_followups']);
                    $item->created_at = $this->changeTimestampToShamsi($item->created_at);
                    if (!is_null($item->last_login_at)) {
                        $item->last_login_at = $this->changeTimestampToShamsi($item->last_login_at);
                    }
                    $item->countFollowup=$this->get_countFollowup($item->id);
                    $item->quality=$this->get_lastFollowupUser($item->id)['problem'];
                    $item->quality_color=$this->get_lastFollowupUser($item->id)['color'];
                    $expert=$this->get_user_byID($item->followby_expert);
                    if(!is_null($expert))
                    {
                        $item->followby_expert=$expert->fname." ".$expert->lname;
                    }
                    $item->lastDateFollowup=$this->get_lastFollowupUser($item->id)['date_fa'];
                    $item->lastFollowupCourse=$this->get_lastFollowupUser($item->id)['course_id'];
                    $item->lastFollowupCourse=$this->get_coursesByID($item->lastFollowupCourse)['course'];
                    if(is_null($item->personal_image))
                    {
                        $item->personal_image="default-avatar.png";
                    }
                }

                $users->appends(['tags' => $request['tags']]);

                $tags = $this->get_tags();
                $parentCategory=$this->get_category('پیگیری');

                $usersAdmin=user::orwhere('type','=','2')
                    ->orwhere('type','=',3)
                    ->get();

                if(isset($request['user']))
                {
                    $user=$request['user'];
                }
                else
                {
                    $user="";
                }

                //لیست تعداد کاربرها
                $notfollowup = count($this->get_notfollowup_withoutPaginate());
                $continuefollowup = count($this->get_continuefollowup_withoutPaginate());
                $cancelfollowup = count($this->get_cancelfollowup_withoutPaginate());
                $waiting = count($this->get_waiting_withoutPaginate());
                $noanswering = count($this->get_noanswering_withoutPaginate());
                $students = count($this->get_students_withoutPaginate());
                $todayFollowup = count($this->get_todayFollowup_withoutPaginate());
                $expireFollowup = $this->get_expireFollowup_withoutPaginate();
                $myfollowup = count($this->get_myfollowup_withoutPaginate());
                $followedToday = count($this->get_followedToday_withoutPaginate());
                $trashUser=count($this->getAll_trashuser_withoutPaginate());
                return view('panelAdmin.users')
                    ->with('tags',$tags)
                    ->with('users',$users)
                    ->with('parentCategory',$parentCategory)
                    ->with('usersAdmin',$usersAdmin)
                    ->with('followedToday',$followedToday)
                    ->with('myfollowup',$myfollowup)
                    ->with('todayFollowup',$todayFollowup)
                    ->with('students',$students)
                    ->with('noanswering',$noanswering)
                    ->with('waiting',$waiting)
                    ->with('cancelfollowup',$cancelfollowup)
                    ->with('continuefollowup',$continuefollowup)
                    ->with('notfollowup',$notfollowup)
                    ->with('user',$user)
                    ->with('orderby',$request['orderby'])
                    ->with('parameter',$request['parameter'])
                    ->with('trashuser',$trashUser);
            }
        }
    }

    //نمایش لیست دعوت شده ها
    public function listIntroducedUser(Request $request)
    {
        $user=Auth::user();
        //چک کردن کاربر که آیا توافقنامه را تایید کردند
        if($user->introduced_verified==0)
        {
            $options=$this->get_options();

            return view('panelUser.IntroducedVerified')
                    ->with('options',$options);
        }
        else {

            if ($request->has('category')) {
                //نمایش براساس دسته بندی افراد دعوت شده توسط کاربر
                switch ($request['category']) {
                    case '0':
                        return redirect('/panel/introduced');
                        break;
                    case 'notfollowup':
                        $listIntroducedUser = User::where('type', '=', '1')
                            ->where('introduced', '=', $user->id)
                            ->orderby('id', 'desc')
                            ->groupby('id')
                            ->paginate($this->countPage());
                        break;
                    case 'continuefollowup':
                        $listIntroducedUser = User::where('type', '=', '11')
                            ->where('introduced', '=', $user->id)
                            ->orderby('id', 'desc')
                            ->paginate($this->countPage());
                        break;
                    case 'cancelfollowup':
                        $listIntroducedUser = User::where('type', '=', '12')
                            ->where('introduced', '=', $user->id)
                            ->orderby('id', 'desc')
                            ->paginate($this->countPage());
                        break;
                    case 'students':
                        $listIntroducedUser = User::where('type', '=', '20')
                            ->where('introduced', '=', $user->id)
                            ->orderby('id', 'desc')
                            ->paginate($this->countPage());
                        break;
                    default:
                        return back();
                        break;
                }
            } else {
                //لیست همه افراد معرفی کرده
                $listIntroducedUser = User::where('introduced', '=', $user->id)
                    ->paginate(20);
            }

            foreach ($listIntroducedUser as $item) {
                if (strlen($item->personal_image) == 0) {
                    $item->personal_image = "default-avatar.png";
                }
            }

            //تعداد افراد دعوت شده
            $countIntroducedUser = User::where('introduced', '=', $user->id)
                ->count();

            $listIntroducedUser->appends(['category' => $request['category']]);
            $getFollowbyCategory = $this->getFollowbyCategory();

            return view('panelUser.listIntroducedUser')
                ->with('listIntroducedUser', $listIntroducedUser)
                ->with('countIntroducedUser', $countIntroducedUser)
                ->with('getFollowbyCategory', $getFollowbyCategory);
        }
    }

    public function searchUsers(Request $request)
    {
        if(is_null($request->orderby)&&is_null($request->parameter))
        {
            $request['orderby']='id';
            $request['parameter']='desc';
        }
        $this->validate(request(),
            [
                'q'     =>'required|min:2|string'
            ],
            [
                'q.required'=>'برای جستجو یک مقدار وارد کنید'
            ]);

        $users=User::leftjoin('followups','users.id','=','followups.user_id')
                    ->orwhere('fname','like','%'.$request['q'].'%')
                    ->orwhere('lname','like','%'.$request['q'].'%')
                    ->orwhere('tel','like','%'.$request['q'].'%')
                    ->orwhere('email','like','%'.$request['q'].'%')
                    ->select('users.*')
                    ->groupby('users.id')
                    ->orderby('users.id','desc')
                    ->paginate($this->countPage());

        foreach ($users as $item)
        {
            $item->status_followups=$this->userType($this->get_lastFollowupUser($item->id)['status_followups']);
            $expert=$this->get_user_byID($item->followby_expert);
            if(!is_null($expert))
            {
                $item->followby_expert=$expert->fname." ".$expert->lname;
            }
            $item->countFollowup=$this->get_countFollowup($item->id);
            $item->lastDateFollowup=$this->get_lastFollowupUser($item->id)['date_fa'];
            $item->quality=$this->get_lastFollowupUser($item->id)['problem'];
            $item->quality_color=$this->get_lastFollowupUser($item->id)['color'];
            $item->lastFollowupCourse=$this->get_lastFollowupUser($item->id)['course_id'];
            $item->lastFollowupCourse=$this->get_coursesByID($item->lastFollowupCourse)['course'];
            if(is_null($item->personal_image))
            {
                $item->personal_image="default-avatar.png";
            }
        }

        $users->appends(['q' => $request['q']]);
        if(!is_null($request->orderby)&&(!is_null($request->parameter))) {
            $users->appends(['orderby'=>$request['orderby']]);
            $users->appends(['parameter'=>$request['parameter']]);
        }

        $tags=$this->get_tags();
        $parentCategory=$this->get_category('پیگیری');
        $usersAdmin=user::orwhere('type','=',2)
                        ->orwhere('type','=',3)
                        ->get();

        //لیست تعداد کاربرها
        $notfollowup =count($this->get_notfollowup_withoutPaginate()) ;
        $continuefollowup =count($this->get_continuefollowup_withoutPaginate());
        $cancelfollowup = count($this->get_cancelfollowup_withoutPaginate());
        $waiting = count($this->get_waiting_withoutPaginate());
        $noanswering = count($this->get_noanswering_withoutPaginate());
        $students = count($this->get_students_withoutPaginate());
        $todayFollowup = count($this->get_todayFollowup_withoutPaginate());
        $expireFollowup = count($this->get_expireFollowup_withoutPaginate());
        $myfollowup = count($this->get_myfollowup_withoutPaginate());
        $followedToday = count($this->get_followedToday_withoutPaginate());
        $trashuser=count($this->getAll_trashuser_withoutPaginate());

        if(isset($request['user']))
        {
            $user=$request['user'];
        }
        else
        {
            $user="";
        }

        return view('panelAdmin.users')
                    ->with('users',$users)
                    ->with('tags',$tags)
                    ->with('parentCategory',$parentCategory)
                    ->with('usersAdmin',$usersAdmin)
                    ->with('followedToday',$followedToday)
                    ->with('myfollowup',$myfollowup)
                    ->with('todayFollowup',$todayFollowup)
                    ->with('students',$students)
                    ->with('noanswering',$noanswering)
                    ->with('waiting',$waiting)
                    ->with('cancelfollowup',$cancelfollowup)
                    ->with('continuefollowup',$continuefollowup)
                    ->with('notfollowup',$notfollowup)
                    ->with('user',$user)
                    ->with('trashuser',$trashuser)
                    ->with('parameter',$request['parameter']);
    }


    //جستجوی کاربرهای دعوت شده توسط خود سفیر
    public function searchUsersIntroduced(Request $request)
    {
        $user=Auth::user();
        $this->validate(request(),
            [
                'q'     =>'required|min:2|string'
            ],
            [
                'q.required'=>'برای جستجو یک مقدار وارد کنید'
            ]);

        $parent=$request['q'];
        $listIntroducedUser=User::join('followups','users.id','=','followups.user_id')
                    ->where('introduced','=',$user->tel)
                    ->where(function ($query) use ($parent)
                    {
                        $query  ->orwhere('fname','like','%'.$parent.'%')
                                ->orwhere('lname','like','%'.$parent.'%')
                                ->orwhere('tel','like','%'.$parent.'%')
                                ->orwhere('email','like','%'.$parent.'%');

                    })
                    ->orderby('followups.id','desc')
                    ->paginate(20);

        foreach($listIntroducedUser as $item)
        {
            if(strlen($item->personal_image)==0)
            {
                $item->personal_image="default-avatar.png";
            }
        }


        //تعداد افراد دعوت شده
        $countIntroducedUser=User::where('introduced','=',$user->tel)
                        ->count();

        $listIntroducedUser->appends(['q' => $request['q']]);
        return view('panelUser.listIntroducedUser')
                    ->with('listIntroducedUser',$listIntroducedUser)
                    ->with('countIntroducedUser',$countIntroducedUser);
    }


    //اضافه کردن یوزر توسط سفیر
    public function addIntroducedUser(Request $request)
    {

//        if(preg_match('/^09(1[0-9]|3[1-9]|2[1-9])-?[0-9]{3}-?[0-9]{4}$/',$request['tel']))
//        {
            $this->validate(request(),
            [
                'fname'         =>'required|persian_alpha|min:3|max:15',
                'lname'         =>'required|persian_alpha|min:3|max:15',
                'tel'           =>'required|iran_mobile|unique:users',
                'sex'           =>'required|boolean',
                'followby_id'   =>'required|numeric'
            ],
            [
                'fname.required'    =>'نام اجباری است',
                'fname.min'         =>'نام باید بیشتر از 3 حرف باشد',
                'fname.max'         =>'نام باید کمتر از 15 حرف باشد',
                'lname.required'    =>'نام خانوادگی اجباری است',
                'lname.min'         =>'نام خانوادگی باید بیشتر از 3 حرف باشد',
                'lname.max'         =>'نام خانوادگی باید کمتر از 15 حرف باشد',
                'tel.required'      =>'تلفن اجباریست',
                'tel.numeric'       =>'تلفن باید عدد باشد',
                'tel.unique'        =>'تلفن قبلا ثبت شده است',
                'sex.required'      =>'جنسیت اجباریست',
                'sex.boolean'       =>'جنسیت را درست وارد کنید',
            ]);

            $check=user::where('tel','=',$request['tel'])
                        ->count();

            if($check==0)
            {
                //ثبت تلفن دعوت شده به همراه تلفن دعوت کننده و تاریخ
                $status=User::create($request->all() +
                    [
                        'introduced'    =>Auth::user()->id,
                        'date_fa'       =>$this->dateNow,
                        'time_fa'       =>$this->timeNow,
                        'password'      =>Hash::make('1234'),
                    ]);

                if($status)
                {
                    if($request['sms']==1) {
                        if (is_null(Auth::user()->fname) || (is_null(Auth::user()->lname))) {
                            $this->sendSms($request['tel'], "به فراکوچ خوش آمدید/ شما توسط " . Auth::user()->tel . " به فراکوچ دعوت شدید"." رمز عبور:1234 ");
//                        $msg="تلفن با موفقیت در سیستم فراکوچ ثبت شد";
//                        $errorStatus="success";
                            alert()->success("تلفن با موفقیت در سیستم فراکوچ ثبت شد", 'پیام')->persistent('بستن');
                        } else {
                            $this->sendSms($request['tel'], "به فراکوچ خوش آمدید/ شما توسط " . Auth::user()->fname . Auth::user()->lname . " به فراکوچ دعوت شدید" ." رمز عبور:1234 ");
//                        $msg="تلفن با موفقیت در سیستم فراکوچ ثبت شد";
//                        $errorStatus="success";
                            alert()->success("تلفن با موفقیت در سیستم فراکوچ ثبت شد", 'پیام')->persistent('بستن');
                        }
                    }
                    else
                    {
                        alert()->success("تلفن با موفقیت در سیستم فراکوچ ثبت شد", 'پیام')->persistent('بستن');
                    }
                }
                else
                {
                    alert()->error("خطا در ثبت",'خطا')->persistent('بستن');
                }
            }
            else
            {
                alert()->error('شخص مورد نظر در گذشته توسط شما و یا شخص دیگر دعوت شده است','خطا')->persistent('بستن');
            }

            return back();
    }

    // نمایش سابقه پیگیری هر دعوت شده توسط خود یوزر
    public function showFollowupIntroduced($followup)
    {
        if(User::where('id','=',$followup)->count()==1) {

            $user = User::find($followup);
            $userInsert = Auth::user();
            if ($user->introduced == $userInsert->id) {
                //لیست پیگیری های انجام شده
                $followUps = User::join('followups', 'users.id', '=', 'followups.user_id')
                    ->join('problemfollowups', 'problemfollowups.id', '=', 'followups.problemfollowup_id')
                    ->where('followups.user_id', '=', $followup)
                    ->where('followups.insert_user_id', '=', Auth::user()->id)
                    ->orderby('followups.id', 'asc')
                    ->get();
                foreach ($followUps as $item)
                {
                    $item->status_followups=$this->userType($item->status_followups);
                    $item->course_id=$this->get_coursesByID($item->course_id)->course;
                }

                $problemFollowup = $problemFollowup = $this->getproblemfollowup();

                $courses=$this->get_courses($this->dateNow);

                //لیست پیامکها
                $settingsms=$this->get_settingsmsByType(1);
                foreach ($settingsms as $item)
                {
                    $item->comment=str_replace("\r\n","<br>",$item->comment);
                    $item->comment=str_replace('{tel}',$user->tel,$item->comment);
                    $item->comment=str_replace('{fname}',$user->fname,$item->comment);
                    $item->comment=str_replace('{lname}',$user->lname,$item->comment);
                    $item->comment=str_replace('{datebirth}',$user->datebirth,$item->comment);
                    if($user->sex==0)
                    {
                        $item->comment=str_replace('{sex}','سرکارخانم ',$item->comment);
                    }
                    else if($user->sex==1)
                    {
                        $item->comment=str_replace('{sex}','جناب آقای ',$item->comment);
                    }
                }

                return view('panelUser.followupsIntroduced')
                    ->with('followUps', $followUps)
                    ->with('userInsert', $userInsert)
                    ->with('user', $user)
                    ->with('problemFollowup', $problemFollowup)
                    ->with('settingsms', $settingsms)
                    ->with('courses', $courses);
            } else {
                return redirect('/panel/introduced');
            }
        }
        else
        {
            return redirect('/panel/introduced');
        }

    }

    public function updatePassword(Request $request,$tel)
    {
        $user=$this->get_user($tel);
        if(is_null($user))
        {
//            $msg="کاربری با چنین مشخصاتی وجود ندارد";
//            $errorStatus="danger";
            alert()->error('کاربری با چنین مشخصاتی وجود ندارد','خطا')->persistent('بستن');
            return redirect("/admin/users");
//                ->with('msg',$msg)
//                ->with('errorStatus',$errorStatus);
        }
        else
        {
            $this->validate(request(),
                [
                    'password'      => ['required', 'string', 'min:8', 'confirmed'],
                ]);
            $request['password']= Hash::make($request['password']);
            $user->password=$request['password'];
            $status=$user->save();
            if($status)
            {
//                $msg="رمز با موفقیت تغییر کرد";
//                $errorStatus="success";
                alert()->success('رمز با موفقیت تغییر کرد','پیام')->persistent('بستن');
                return redirect("/admin/users");
//                    ->with('msg',$msg)
//                    ->with('errorStatus',$errorStatus);
            }
            else
            {
//                $msg="خطا در تغییر رمز عبور";
//                $errorStatus="danger";
                alert()->error('خطا در تغییر رمز عبور','خطا')->persistent('بستن');
                return redirect("/admin/users");
//                    ->with('msg',$msg)
//                    ->with('errorStatus',$errorStatus);
            }
        }
    }


    public function updatePasswordUser(Request $request)
    {
        $user=Auth::user();
        if(is_null($user))
        {
//            $msg="کاربری با چنین مشخصاتی وجود ندارد";
//            $errorStatus="danger";
            alert()->error('کاربری با چنین مشخصاتی وجود ندارد','خطا')->persistent('بستن');
            return redirect("/panel/profile");
//                ->with('msg',$msg)
//                ->with('errorStatus',$errorStatus);
        }
        else
        {
            $this->validate(request(),
                [
                    'password'      => ['required', 'string', 'min:8', 'confirmed'],
                ]);
            $request['password']= Hash::make($request['password']);
            $user->password=$request['password'];
            $status=$user->save();
            if($status)
            {
//                $msg="رمز با موفقیت تغییر کرد";
//                $errorStatus="success";
                alert()->success('رمز با موفقیت تغییر کرد','پیام')->persistent('بستن');
                return redirect("/panel/profile");
//                    ->with('msg',$msg)
//                    ->with('errorStatus',$errorStatus);
            }
            else
            {
//                $msg="خطا در تغییر رمز عبور";
//                $errorStatus="danger";
                alert()->error('خطا در تغییر رمز عبور','خطا')->persistent('بستن');
                return redirect("/panel/profile");
//                    ->with('msg',$msg)
//                    ->with('errorStatus',$errorStatus);
            }
        }
    }

    public function changeType(Request $request,$id)
    {
        $this->validate(request(),
        [
            'type'=>'required|numeric'
        ]);
        $user=User::where('id','=',$id)
                ->first();
        if(is_null($user))
        {
//            $msg="کاربری با این اطلاعات موجود نمی باشد";
//            $errorStatus="danger";
            alert()->error('کاربری با این اطلاعات موجود نمی باشد','خطا')->persistent('بستن');
            return back();
//                ->with('msg',$msg)
//                ->with('errorStatus',$errorStatus);
        }
        else
        {
            $user['type']=$request['type'];
            $status=$user->save();
            if($status)
            {
//                $msg="سطح دسترسی کاربر تغییر کرد";
//                $errorStatus="success";
                alert()->success('سطح دسترسی کاربر تغییر کرد','پیام')->persistent('بستن');
                return back();
//                    ->with('msg',$msg)
//                    ->with('errorStatus',$errorStatus);
            }
            else
            {
//                $msg="خطا در تغییر سطح دسترسی";
//                $errorStatus="danger";
                alert()->error('خطا در تغییر سطح دسترسی','خطا')->persistent('بستن');
                return back();
//                    ->with('msg',$msg)
//                    ->with('errorStatus',$errorStatus);
            }

        }
    }

    public function checkUserAjax($id)
    {
        if(strlen($id)>0)
        {
            if (preg_match('/^09(1[0-9]|3[0-9]|2[0-9])-?[0-9]{3}-?[0-9]{4}$/', $id)) {
                $user = user::where('tel', '=', $id)
                    ->first();
                if (is_null($user)) {
                    return "<input type='hidden' value='" . $id . "' name='introduced' />";
                } else {
                    if ((strlen($user->fname) > 0) || (strlen($user->lname) > 0)) {
                        return "<span>معرف شما " . $user->fname . " " . $user->lname . "</span><input type='hidden' value='" . $user->id . "' name='introduced' />";

                    } else {
                        return "<span>معرف شما "  . $user->tel . "</span><input type='hidden' value='" . $user->id . "' name='introduced' />";
                    }
                }
            } else {
                return "<div class=''>فرمت شماره همراه صحیح نمی باشد</div>";
            }
        }
        else
        {
            return "<input type='hidden' value='' />";
        }
    }

    public function advanceSearchUsers (Request $request)
    {
        $this->validate($request,[
            'user'          =>'required|numeric',
            'categoryUsers' =>'required|string'
        ]);

        switch ($request['categoryUsers']) {
            case '0':
                $users = User:: leftjoin('followups', 'users.id', '=', 'followups.user_id')
                    ->where('followby_expert','=',$request['user'])
                    ->orderby('users.id', 'desc')
                    ->select('users.*')
                    ->groupby('users.id')
                    ->paginate($this->countPage());
                break;
            case 'notfollowup':
                $users = User:: leftjoin('followups', 'users.id', '=', 'followups.user_id')
                    ->where('users.status_followups', '=', '1')
                    ->where('followby_expert','=',$request['user'])
                    ->orderby('users.id', 'desc')
                    ->select('users.*')
                    ->groupby('users.id')
                    ->paginate($this->countPage());
                foreach ($users as $item) {
                    $item->created_at = $this->changeTimestampToShamsi($item->created_at);
                    if (!is_null($item->last_login_at)) {
                        $item->last_login_at = $this->changeTimestampToShamsi($item->last_login_at);
                    }
                    $expert=$this->get_user_byID($item->followby_expert);
                    if(!is_null($expert))
                    {
                        $item->followby_expert=$expert->fname." ".$expert->lname;
                    }
                    $item->lastFollowupCourse=$this->get_lastFollowupUser($item->id)['course_id'];
                    $item->lastFollowupCourse=$this->get_coursesByID($item->lastFollowupCourse)['course'];
                }
                break;
            case 'continuefollowup':
                $users = User::join('followups','users.id','=','followups.user_id')
                    ->where('status_followups', '=', '11')
                    ->where('followby_expert','=',$request['user'])
                    ->orderby('id', 'desc')
                    ->groupby('id')
                    ->paginate($this->countPage());
                foreach ($users as $item) {
                    $item->created_at = $this->changeTimestampToShamsi($item->created_at);
                    if (!is_null($item->last_login_at)) {
                        $item->last_login_at = $this->changeTimestampToShamsi($item->last_login_at);
                    }
                    $expert=$this->get_user_byID($item->followby_expert);
                    if(!is_null($expert))
                    {
                        $item->followby_expert=$expert->fname." ".$expert->lname;
                    }
                    $item->lastFollowupCourse=$this->get_lastFollowupUser($item->id)['course_id'];
                    $item->lastFollowupCourse=$this->get_coursesByID($item->lastFollowupCourse)['course'];
                }
                break;
            case 'cancelfollowup':
                $users = User::join('followups','users.id','=','followups.user_id')
                    ->where('status_followups', '=', '12')
                    ->where('followby_expert','=',$request['user'])
                    ->orderby('id', 'desc')
                    ->groupby('id')
                    ->paginate($this->countPage());
                foreach ($users as $item) {
                    $item->created_at = $this->changeTimestampToShamsi($item->created_at);
                    if (!is_null($item->last_login_at)) {
                        $item->last_login_at = $this->changeTimestampToShamsi($item->last_login_at);
                    }
                    $expert=$this->get_user_byID($item->followby_expert);
                    if(!is_null($expert))
                    {
                        $item->followby_expert=$expert->fname." ".$expert->lname;
                    }
                    $item->lastFollowupCourse=$this->get_lastFollowupUser($item->id)['course_id'];
                    $item->lastFollowupCourse=$this->get_coursesByID($item->lastFollowupCourse)['course'];
                }
                break;
            case 'waiting' :
                $users = User::join('followups','users.id','=','followups.user_id')
                    ->where('status_followups', '=', '13')
                    ->where('followby_expert','=',$request['user'])
                    ->orderby('id', 'desc')
                    ->paginate($this->countPage());
                foreach ($users as $item) {
                    $item->created_at = $this->changeTimestampToShamsi($item->created_at);
                    if (!is_null($item->last_login_at)) {
                        $item->last_login_at = $this->changeTimestampToShamsi($item->last_login_at);
                    }
                    $expert=$this->get_user_byID($item->followby_expert);
                    if(!is_null($expert))
                    {
                        $item->followby_expert=$expert->fname." ".$expert->lname;
                    }
                    $item->lastFollowupCourse=$this->get_lastFollowupUser($item->id)['course_id'];
                    $item->lastFollowupCourse=$this->get_coursesByID($item->lastFollowupCourse)['course'];
                }

                break;
            case 'noanswering':
                $users = User::join('followups','users.id','=','followups.user_id')
                    ->where('status_followups', '=', '14')
                    ->where('followby_expert','=',$request['user'])
                    ->orderby('id', 'desc')
                    ->paginate($this->countPage());
                foreach ($users as $item) {
                    $item->created_at = $this->changeTimestampToShamsi($item->created_at);
                    if (!is_null($item->last_login_at)) {
                        $item->last_login_at = $this->changeTimestampToShamsi($item->last_login_at);
                    }
                    $expert=$this->get_user_byID($item->followby_expert);
                    if(!is_null($expert))
                    {
                        $item->followby_expert=$expert->fname." ".$expert->lname;
                    }
                    $item->lastFollowupCourse=$this->get_lastFollowupUser($item->id)['course_id'];
                    $item->lastFollowupCourse=$this->get_coursesByID($item->lastFollowupCourse)['course'];
                }

                break;
            case 'students':
                $users = User::join('followups','users.id','=','followups.user_id')
                    ->where('status_followups', '=', '20')
                    ->where('followby_expert','=',$request['user'])
                    ->orderby('id', 'desc')
                    ->paginate($this->countPage());
                foreach ($users as $item) {
                    $item->created_at = $this->changeTimestampToShamsi($item->created_at);
                    if (!is_null($item->last_login_at)) {
                        $item->last_login_at = $this->changeTimestampToShamsi($item->last_login_at);
                    }
                    $expert=$this->get_user_byID($item->followby_expert);
                    if(!is_null($expert))
                    {
                        $item->followby_expert=$expert->fname." ".$expert->lname;
                    }
                    $item->lastFollowupCourse=$this->get_lastFollowupUser($item->id)['course_id'];
                    $item->lastFollowupCourse=$this->get_coursesByID($item->lastFollowupCourse)['course'];
                }

                break;
            case 'todayFollowup':
                $users = User::join('followups', 'users.id', '=', 'followups.user_id')
                    ->where('followby_expert','=',$request['user'])
                    ->where('followups.nextfollowup_date_fa', '=', $this->dateNow)
                    ->select('users.*')
                    ->groupby('users.id')
                    ->orderby('date_fa', 'desc')
                    ->paginate($this->countPage());
                foreach ($users as $item) {
                    $item->created_at = $this->changeTimestampToShamsi($item->created_at);
                    if (!is_null($item->last_login_at)) {
                        $item->last_login_at = $this->changeTimestampToShamsi($item->last_login_at);
                    }
                    $expert=$this->get_user_byID($item->followby_expert);
                    if(!is_null($expert))
                    {
                        $item->followby_expert=$expert->fname." ".$expert->lname;
                    }
                    $item->lastFollowupCourse=$this->get_lastFollowupUser($item->id)['course_id'];
                    $item->lastFollowupCourse=$this->get_coursesByID($item->lastFollowupCourse)['course'];
                }

                break;
            case 'expireFollowup':
                $users = User::join('followups', 'users.id', '=', 'followups.user_id')
                    ->where('followby_expert','=',$request['user'])
                    ->where('followups.nextfollowup_date_fa', '<', $this->dateNow)
                    ->wherenotIn('users.type', [2, 12])
                    ->select('users.*')
                    ->groupby('users.id')
                    ->orderby('date_fa', 'desc')
                    ->paginate($this->countPage());
                foreach ($users as $item) {
                    $item->created_at = $this->changeTimestampToShamsi($item->created_at);
                    if (!is_null($item->last_login_at)) {
                        $item->last_login_at = $this->changeTimestampToShamsi($item->last_login_at);
                    }
                    $expert=$this->get_user_byID($item->followby_expert);
                    if(!is_null($expert))
                    {
                        $item->followby_expert=$expert->fname." ".$expert->lname;
                    }
                    $item->lastFollowupCourse=$this->get_lastFollowupUser($item->id)['course_id'];
                    $item->lastFollowupCourse=$this->get_coursesByID($item->lastFollowupCourse)['course'];
                }

                break;
            case 'myfollowup':
                $users = User::join('followups', 'users.id', '=', 'followups.user_id')
                    ->where('followby_expert','=',$request['user'])
                    ->where('nextfollowup_date_fa','=',$this->dateNow)
                    ->select('users.*')
                    ->groupby('users.id')
                    ->orderby('date_fa', 'desc')
                    ->paginate($this->countPage());

                foreach ($users as $item) {
                    $item->created_at = $this->changeTimestampToShamsi($item->created_at);
                    if (!is_null($item->last_login_at)) {
                        $item->last_login_at = $this->changeTimestampToShamsi($item->last_login_at);
                    }
                    $expert=$this->get_user_byID($item->followby_expert);
                    if(!is_null($expert))
                    {
                        $item->followby_expert=$expert->fname." ".$expert->lname;
                    }
                    $item->lastFollowupCourse=$this->get_lastFollowupUser($item->id)['course_id'];
                    $item->lastFollowupCourse=$this->get_coursesByID($item->lastFollowupCourse)['course'];
                }

                break;
            case 'followedToday':
                $users = User::join('followups', 'users.id', '=', 'followups.user_id')
                    ->where('followby_expert','=',$request['user'])
                    ->where('date_fa', '=', $this->dateNow)
                    ->select('users.*')
                    ->groupby('users.id')
                    ->orderby('date_fa', 'desc')
                    ->paginate($this->countPage());
                foreach ($users as $item) {
                    $item->created_at = $this->changeTimestampToShamsi($item->created_at);
                    if (!is_null($item->last_login_at)) {
                        $item->last_login_at = $this->changeTimestampToShamsi($item->last_login_at);
                    }
                    $expert=$this->get_user_byID($item->followby_expert);
                    if(!is_null($expert))
                    {
                        $item->followby_expert=$expert->fname." ".$expert->lname;
                    }
                    $item->lastFollowupCourse=$this->get_lastFollowupUser($item->id)['course_id'];
                    $item->lastFollowupCourse=$this->get_coursesByID($item->lastFollowupCourse)['course'];
                }

                break;
            default:
                return redirect('/admin/users/');
                break;
        }

        foreach ($users as $item)
        {
            $item->status_followups=$this->userType($this->get_lastFollowupUser($item->id)['status_followups']);
            $item->countFollowup=$this->get_countFollowup($item->id);
            $expert=$this->get_user_byID($item->followby_expert);
            if(!is_null($expert))
            {
                $item->followby_expert=$expert->fname." ".$expert->lname;
            }

            $item->quality=$this->get_lastFollowupUser($item->id)['problem'];
            $item->quality_color=$this->get_lastFollowupUser($item->id)['color'];
            $item->lastDateFollowup=$this->get_lastFollowupUser($item->id)['date_fa'];
            $item->lastFollowupCourse=$this->get_lastFollowupUser($item->id)['course_id'];
            $item->lastFollowupCourse=$this->get_coursesByID($item->lastFollowupCourse)['course'];
        }

        $users->appends(['user' => $request['user'],'categoryUsers'=>$request['categoryUsers']]);
        $tags=$this->get_tags();
        $parentCategory=$this->get_parentCategory();
        $usersAdmin=user::orwhere('type','=',2)
                ->orwhere('type','=',3)
                ->get();

        //لیست تعداد کاربرها

        $notfollowup = User:: leftjoin('followups', 'users.id', '=', 'followups.user_id')
            ->where('users.type', '=', '1')
            ->count();

        $continuefollowup = User::where('type', '=', '11')
            ->where('followby_expert', '=', Auth::user()->id)
            ->orwhere(function ($query)
            {
                $query  ->where('followby_expert','=',NULL)
                    ->where('status_followups','=',11);
            })
            ->count();

        $cancelfollowup = User::where('type', '=', '12')
            ->where('followby_expert', '=', Auth::user()->id)
            ->orwhere(function ($query)
            {
                $query  ->where('followby_expert','=',NULL)
                    ->where('status_followups','=',12);
            })
            ->count();


        $waiting = User::where('type', '=', '13')
            ->where('followby_expert', '=', Auth::user()->id)
            ->orwhere(function ($query)
            {
                $query  ->where('followby_expert','=',NULL)
                    ->where('status_followups','=',13);
            })
            ->count();


        $noanswering = User::where('type', '=', '14')
            ->where('followby_expert', '=', Auth::user()->id)
            ->orwhere(function ($query)
            {
                $query  ->where('followby_expert','=',NULL)
                    ->where('status_followups','=',14);
            })
            ->count();


        $students = User::where('type', '=', '20')
            ->where('followby_expert', '=', Auth::user()->id)
            ->orwhere(function ($query)
            {
                $query  ->where('followby_expert','=',NULL)
                    ->where('status_followups','=',20);
            })
            ->count();


        $todayFollowup = User::join('followups', 'users.id', '=', 'followups.user_id')
            ->where('followups.nextfollowup_date_fa', '=', $this->dateNow)
            ->where('followby_expert', '=', Auth::user()->id)
            ->count();


        $expireFollowup = User::join('followups', 'users.id', '=', 'followups.user_id')
            ->where('followups.nextfollowup_date_fa', '<', $this->dateNow)
            ->where('followby_expert', '=', Auth::user()->id)
            ->wherenotIn('users.type', [2, 12])
            ->count();


        $myfollowup = User::join('followups', 'users.id', '=', 'followups.user_id')
            ->where('followups.insert_user_id', '=', Auth::user()->id)
            ->count();

        $followedToday = User::join('followups', 'users.id', '=', 'followups.user_id')
            ->where('followups.insert_user_id', '=', Auth::user()->id)
            ->where('date_fa', '=', $this->dateNow)
            ->select('users.*')
            ->orderby('date_fa', 'desc')
            ->count();
        return view('panelAdmin.users')
            ->with('users',$users)
            ->with('tags',$tags)
            ->with('parentCategory',$parentCategory)
            ->with('usersAdmin',$usersAdmin)
            ->with('followedToday',$followedToday)
            ->with('myfollowup',$myfollowup)
            ->with('todayFollowup',$todayFollowup)
            ->with('students',$students)
            ->with('noanswering',$noanswering)
            ->with('waiting',$waiting)
            ->with('cancelfollowup',$cancelfollowup)
            ->with('continuefollowup',$continuefollowup)
            ->with('notfollowup',$notfollowup);
    }

    public function createExcel()
    {
        return view('panelAdmin.excelImport');
    }

    public function storeExcel(Request $request)
    {
        $this->validate($request, [
                'excel'     =>['required','mimes:xlsx,csv'],
            ]);

        $collection = fastexcel()->import($request->file('excel'));
        $i=0;
        foreach ($collection as $item)
        {
            $count=user::where('tel','=',$item['tel'])
                         ->orwhere('email','=',$item['email'])
                         ->count();
            if($count==0)
            {
                $status=user::create($item);
                if($status)
                {
                    $i++;
                }

            }
        }
//        $msg = "تعداد".$i."نفر وارد بانک اطلاعاتی شدند";
//        $errorStatus = "success";
        alert()->success("تعداد".$i."نفر وارد بانک اطلاعاتی شدند",'پیام')->persistent('بستن');
        return back();
//        ->with('msg', $msg)
//            ->with('errorStatus', $errorStatus);


    }

    public function introducedVerified(Request $request)
    {
        $this->validate($request,[
            'introduced_verified'   =>'required|boolean'
        ]);

        $user=Auth::user();
        $user->introduced_verified=1;
        $status=$user->save();
        if($status)
        {
//            $msg="کد ملی / پست الکترونیکی تکراری است";
//            $errorStatus="danger";
            alert()->success("شرایط و ضوابط بطور کامل توسط شما پذیرفته شد",'پیام')->persistent('بستن');
            return redirect('/panel/introduced');
        }
        else
        {
//            $msg="کد ملی / پست الکترونیکی تکراری است";
//            $errorStatus="danger";
            alert()->error("خطا در پذیرفتن شرایط و ضوابط ",'خطا')->persistent('بستن');
            return back();
//                        ->with('msg',$msg)
//                        ->with('errorStatus',$errorStatus);
        }
    }



}
