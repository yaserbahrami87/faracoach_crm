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

    public function index()
    {
        if(Auth::user()->type==2)
        {
            $users=User::orderby('users.id','desc')
                    ->groupby('users.id')
                    ->get();


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

                $item->type=$this->userType($item->type);
                $item->countFollowup=$this->get_countFollowup($item->id);

                $item->quality=$this->get_lastFollowupUser($item->id)['problem'];
                $item->quality_color=$this->get_lastFollowupUser($item->id)['color'];
                $item->lastDateFollowup=$this->get_lastFollowupUser($item->id)['date_fa'];
            }
            $tags=$this->get_tags();
            $parentCategory=$this->get_category('پیگیری');

            if(isset($request['user']))
            {
                //لیست تعداد کاربرها
                $notfollowup = count($this->get_notfollowup());
                $continuefollowup = count($this->get_continuefollowup());
                $cancelfollowup = count($this->get_cancelfollowup());
                $waiting = count($this->get_waiting());
                $noanswering = count($this->get_noanswering());
                $students = count($this->get_students());
                $todayFollowup = count($this->get_todayFollowup());
                $expireFollowup = $this->get_expireFollowup();
                $myfollowup = count($this->get_myfollowup());
                $followedToday = count($this->get_followedToday());
            }
            else
            {
                //لیست تعداد کاربرها
                $notfollowup = count($this->get_notfollowup());
                $continuefollowup = count($this->getAll_continuefollowup());
                $cancelfollowup = count($this->getAll_cancelfollowup());
                $waiting = count($this->getAll_waiting());
                $noanswering = count($this->getAll_noanswering());
                $students = count($this->getAll_students());
                $todayFollowup = count($this->getAll_todayFollowup());
                $expireFollowup = count($this->getAll_expireFollowup());
                $myfollowup = count($this->getAll_myfollowup());
                $followedToday = count($this->getAll_followedToday());
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
                ->with('user',$user);
        }
        else
        {
            $users=User::where(function($query)
                        {
                            $query->orwhere('followby_expert','=',Auth::user()->id)
                                  ->orwhere('followby_expert','=',NULL);
                        })
                        ->whereNotIn('users.type',[2,3])
                        ->orderby('users.id','desc')
                        ->groupby('users.id')
                        ->get();

            //لیست تعداد کاربرها
            $notfollowup=count($this->get_notfollowup());
            $continuefollowup=count($this->get_continuefollowup());
            $cancelfollowup=count($this->get_cancelfollowup());
            $waiting=count($this->get_waiting());
            $noanswering=count($this->get_noanswering());
            $students =count($this->get_students());
            $todayFollowup = count($this->get_todayFollowup());
            $expireFollowup = $this->get_expireFollowup();
            $myfollowup=count($this->get_myfollowup());
            $followedToday = count($this->get_followedToday());

            foreach ($users as $item)
            {
                $item->created_at=$this->changeTimestampToShamsi($item->created_at);
                if(!is_null($item->last_login_at))
                {
                        $item->last_login_at = $this->changeTimestampToShamsi($item->last_login_at);
                }
                $item->type=$this->userType($item->type);
                $item->countFollowup=$this->get_countFollowup($item->id);
                $item->quality=$this->get_lastFollowupUser($item->id)['problem'];
                $item->quality_color=$this->get_lastFollowupUser($item->id)['color'];
                $item->lastDateFollowup=$this->get_lastFollowupUser($item->id)['date_fa'];
            }
            $tags=$this->get_tags();
            $parentCategory=$this->get_category('پیگیری');
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
                        ->with('notfollowup',$notfollowup);
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
            $msg="کد ملی / پست الکترونیکی تکراری است";
            $errorStatus="danger";
        }
        else
        {

            $this->validate(request(),
            [
                'fname'             =>'persian_alpha|required|min:3',
                'lname'             =>'persian_alpha|required|min:3',
                'codemelli'         =>'nullable|melli_code',
                'sex'               =>'nullable|boolean',
                'tel'               =>'required|numeric|iran_mobile',
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
                $msg="اطلاعات ما با موفقیت در سیستم ثبت شد";
                $errorStatus="success";

                // Send SMS
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
        return back()->with('msg',$msg)->with('errorStatus',$errorStatus);
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
            'password'      => ['required', 'string', 'min:8', 'confirmed'],
            'tel_verified'  => ['required','boolean'],
            'introduced'  =>   ['nullable','numeric'],
            'gettingknow'  =>  ['nullable','persian_alpha'],

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
        ]);

        if($status)
        {
            if($request['sendsms']!="0")
            {
                $request['sendsms']=$request['sendsms']."\n  نام کاربری:".$request['tel']."\n رمز عبور:".$request['password']. "\n https://www.crm.faracoach.com";
                $request['sendsms']=(str_replace('...','',$request['sendsms']));
                $this->sendSms($request['tel'],$request['sendsms']);
            }

            $msg="کاربر با موفقیت در سیستم ثبت شد";
            $errorStatus="success";
            return back()
                    ->with('msg',$msg)
                    ->with('errorStatus',$errorStatus);
        }
        else
        {
            $msg="خطا در ثبت کاربر";
            $errorStatus="danger";
            return back()
                ->with('msg',$msg)
                ->with('errorStatus',$errorStatus);
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
            $item->type=$this->userType($item->type);
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
        $score = $countIntroducedUser * 5;
        //امتیاز تایید شماره همراه
        $verifyScore = $user->tel_verified;
        if ($verifyScore == 1) {
            $score = $score + 5;
            $verifyScore = 5;
        }
        //امتیاز تعداد دعوت شده
        $scoreSuccess = User::where('introduced', '=', $user->id)
            ->where('type', '=', 20)
            ->count();
        $scoreSuccess = $scoreSuccess * 10;
        $score = $score + $scoreSuccess;

        $today = $this->dateNow;
        $timeNow = $this->timeNow;
        $v = verta('+2 day');
        $v = $v->format('Y/m/d');
        $nextDayFollow = $v;
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
                    //->with('verifyStatus',$verifyStatus)
                    ->with('tags',$tags)
                    ->with('today',$today)
                    ->with('nextDayFollow',$nextDayFollow)
                    ->with('timeNow',$timeNow)
                    ->with('expert_followup',$expert_followup)
                    ->with('parentCategory',$parentCategory);

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
                    'fname' => 'nullable|min:3|persian_alpha',
                    'lname' => 'nullable|min:3|persian_alpha',
                    'codemelli' => 'nullable|numeric',
                    'sex' => 'nullable|boolean',
                    'tel' => 'nullable|iran_mobile',
                    'shenasname' => 'nullable|numeric',
                    'father' => 'nullable|min:3|persian_alpha',
                    'born' => 'nullable|min:3|persian_alpha',
                    'married' => 'nullable|boolean',
                    'education' => 'nullable|min:4|persian_alpha',
                    'reshteh' => 'nullable|min:4|persian_alpha',
                    'state' => 'nullable|numeric',
                    'city' => 'nullable|numeric',
                    'address' => 'nullable|min:4|',
                    'personal_image' => 'nullable|mimes:jpeg,jpg,pdf|max:600',
                    'shenasnameh_image' => 'nullable|mimes:jpeg,jpg,pdf|max:600',
                    'cartmelli_image' => 'nullable|mimes:jpeg,jpg,pdf|max:600',
                    'education_image' => 'nullable|mimes:jpeg,jpg,pdf|max:600',
                    'email' => 'nullable|email|',
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
            try {
                $user->update($request->all());
            } catch (Throwable $e) {

                $msg = $e->errorInfo[2];
                $errorStatus = "danger";
                return back()->with('msg', $msg)
                    ->with('errorStatus', $errorStatus);

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
            $user->tel_verified = 0;
            $user->save();
            $msg = "پروفایل با موفقیت به روزرسانی شد";
            $errorStatus = "success";

            return back()->with('msg', $msg)
                ->with('errorStatus', $errorStatus);


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
                        ->get();
                $countList = user::where('followby_expert', '=', $request['user'])
                        ->count();
                foreach ($users as $item)
                {
                    $expert=$this->get_user_byID($item->followby_expert);
                    if(!is_null($expert))
                    {
                        $item->followby_expert=$expert->fname." ".$expert->lname;
                    }

                    $item->type=$this->userType($item->type);
                    $item->quality=$this->get_lastFollowupUser($item->id)['problem'];
                    $item->quality_color=$this->get_lastFollowupUser($item->id)['color'];
                    $item->lastDateFollowup=$this->get_lastFollowupUser($item->id)['date_fa'];
                }
                //$users->appends(['user' => $request['user']]);
                $tags = $this->get_tags();
                $parentCategory = $this->get_category('پیگیری');
                $usersAdmin = user::orwhere('type', '=', 2)
                    ->orwhere('type', '=', 3)
                    ->get();

                //لیست تعداد کاربرهای هر شخص
                $notfollowup=count($this->get_notfollowup());
                $continuefollowup=count($this->get_continuefollowupbyID($request['user']));
                $cancelfollowup=count($this->get_cancelfollowupbyID($request['user']));
                $waiting=count($this->get_waitingbyID($request['user']));
                $noanswering=count($this->get_noansweringbyID($request['user']));
                $students =count($this->get_studentsbyID($request['user']));
                $todayFollowup = count($this->get_todayFollowupbyID($request['user']));
                $expireFollowup = $this->get_expireFollowupbyID($request['user']);
                $myfollowup=count($this->get_myfollowupbyID($request['user']));
                $followedToday = count($this->get_followedTodaybyID($request['user']));

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
                    ->with('user',$request['user']);
            } else {
                return redirect('/admin/users');
            }
        }
    }
    // نمایش اعضای سایت براساس دسته بندی برای ادمین
    public function showCategoryUsersAdmin(Request $request)
    {

        $dateNow=$this->dateNow;
        if(Auth::user()->type==2)
        {
            if (!is_null($request) &&(strlen($request['user'])>0)) {
                switch ($request['categoryUsers']) {
                    case '0':
                        return redirect('/admin/users/');
                        break;
                    case 'notfollowup':
                        $users = User:: leftjoin('followups', 'users.id', '=', 'followups.user_id')
                            ->where('users.type', '=', '1')
                            ->orderby('users.id', 'desc')
                            ->select('users.*')
                            ->groupby('users.id')
                            ->get();
                        break;
                    case 'continuefollowup':
                        $users = User::where('type', '=', '11')
                            ->where('followby_expert', '=', $request['user'])
                            ->orderby('id', 'desc')
                            ->groupby('id')
                            ->get();
                        break;
                    case 'cancelfollowup':
                        $users = User::where('type', '=', '12')
                            ->where('followby_expert', '=', $request['user'])
                            ->orderby('id', 'desc')
                            ->groupby('id')
                            ->get();
                        break;
                    case 'waiting' :
                        $users = User::where('type', '=', '13')
                            ->where('followby_expert', '=', $request['user'])
                            ->orderby('id', 'desc')
                            ->get();
                        break;
                    case 'noanswering':
                        $users = User::where('type', '=', '14')
                            ->where('followby_expert', '=', $request['user'])
                            ->orderby('id', 'desc')
                            ->get();
                        break;
                    case 'students':
                        $users = User::where('type', '=', '20')
                            ->where('followby_expert', '=', $request['user'])
                            ->orderby('id', 'desc')
                            ->get();
                        break;
                    case 'todayFollowup':
                        $users = User::join('followups', 'users.id', '=', 'followups.user_id')
                            ->where('followups.nextfollowup_date_fa', '=', $this->dateNow)
                            ->where('followby_expert', '=', $request['user'])
                            ->select('users.*')
                            ->groupby('users.id')
                            ->orderby('date_fa', 'desc')
                            ->get();
                        break;
                    case 'expireFollowup':
                        $users = User::join('followups', 'users.id', '=', 'followups.user_id')
                            ->where('followups.nextfollowup_date_fa', '<', $dateNow)
                            ->where('followby_expert', '=', $request['user'])
                            ->wherenotIn('users.type', [2, 12])
                            ->select('users.*')
                            ->groupby('users.id')
                            ->orderby('date_fa', 'desc')
                            ->get();
                        break;
                    case 'myfollowup':
                        $users = User::join('followups', 'users.id', '=', 'followups.user_id')
                            ->where('followups.insert_user_id', '=', Auth::user()->id)
                            ->where('followby_expert', '=', $request['user'])
                            ->select('users.*')
                            ->orderby('date_fa', 'desc')
                            ->groupby('users.id')
                            ->get();
                        break;

                    case 'followedToday':
                        $users = User::join('followups', 'users.id', '=', 'followups.user_id')
                            ->where('followups.insert_user_id', '=', Auth::user()->id)
                            ->where('date_fa', '=', $dateNow)
                            ->where('followby_expert', '=', $request['user'])
                            ->select('users.*')
                            ->groupby('users.id')
                            ->orderby('date_fa', 'desc')
                            ->get();
                        break;
                    default:
                        return redirect('/admin/users/');
                        break;
                }
                //لیست تعداد کاربرها
                $notfollowup = count($this->get_notfollowup());
                $continuefollowup = count($this->get_continuefollowupbyID($request['user']));
                $cancelfollowup = count($this->get_cancelfollowupbyID($request['user']));
                $waiting = count($this->get_waitingbyID($request['user']));
                $noanswering = count($this->get_noansweringbyID($request['user']));
                $students = count($this->get_studentsbyID($request['user']));
                $todayFollowup = count($this->get_todayFollowupbyID($request['user']));
                $expireFollowup = $this->get_expireFollowupbyID($request['user']);
                $myfollowup = count($this->get_myfollowupbyID($request['user']));
                $followedToday = count($this->get_followedTodaybyID($request['user']));
            }
            else
            {
                switch ($request['categoryUsers']) {
                    case '0':
                        return redirect('/admin/users/');
                        break;
                    case 'notfollowup':
                        $users = User:: leftjoin('followups', 'users.id', '=', 'followups.user_id')
                            ->where('users.type', '=', '1')
                            ->orderby('users.id', 'desc')
                            ->select('users.*')
                            ->groupby('users.id')
                            ->get();
                        break;
                    case 'continuefollowup':
                        $users = User::where('type', '=', '11')
                            ->orderby('id', 'desc')
                            ->groupby('id')
                            ->get();
                        break;
                    case 'cancelfollowup':
                        $users = User::where('type', '=', '12')
                            ->orderby('id', 'desc')
                            ->groupby('id')
                            ->get();
                        break;
                    case 'waiting' :
                        $users = User::where('type', '=', '13')
                            ->orderby('id', 'desc')
                            ->get();
                        break;
                    case 'noanswering':
                        $users = User::where('type', '=', '14')
                            ->orderby('id', 'desc')
                            ->get();
                        break;
                    case 'students':
                        $users = User::where('type', '=', '20')
                            ->orderby('id', 'desc')
                            ->get();
                        break;
                    case 'todayFollowup':
                        $users = User::join('followups', 'users.id', '=', 'followups.user_id')
                            ->where('followups.nextfollowup_date_fa', '=', $this->dateNow)
                            ->select('users.*')
                            ->groupby('users.id')
                            ->orderby('date_fa', 'desc')
                            ->get();
                        break;
                    case 'expireFollowup':
                        $users = User::join('followups', 'users.id', '=', 'followups.user_id')
                            ->where('followups.nextfollowup_date_fa', '<', $dateNow)
                            ->wherenotIn('users.type', [2, 12])
                            ->select('users.*')
                            ->groupby('users.id')
                            ->orderby('date_fa', 'desc')
                            ->get();
                        break;
                    case 'myfollowup':
                        $users = User::join('followups', 'users.id', '=', 'followups.user_id')
                            ->where('followups.insert_user_id', '=', Auth::user()->id)
                            ->select('users.*')
                            ->orderby('date_fa', 'desc')
                            ->groupby('users.id')
                            ->get();
                        break;

                    case 'followedToday':
                        $users = User::join('followups', 'users.id', '=', 'followups.user_id')
                            ->where('date_fa', '=', $dateNow)
                            ->where('followby_expert', '=', $request['user'])
                            ->select('users.*')
                            ->groupby('users.id')
                            ->orderby('date_fa', 'desc')
                            ->get();
                        break;
                    default:
                        return redirect('/admin/users/');
                        break;
                }
                //لیست تعداد کاربرها
                $notfollowup = count($this->get_notfollowup());
                $continuefollowup = count($this->getAll_continuefollowup());
                $cancelfollowup = count($this->getAll_cancelfollowup());
                $waiting = count($this->getAll_waiting());
                $noanswering = count($this->getAll_noanswering());
                $students = count($this->getAll_students());
                $todayFollowup = count($this->getAll_todayFollowup());
                $expireFollowup = count($this->getAll_expireFollowup());
                $myfollowup = count($this->getAll_myfollowup());
                $followedToday = count($this->getAll_followedToday());
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
                    $users = $this->get_continuefollowup();
                    break;
                case 'cancelfollowup':
                    $users = $this->get_cancelfollowup();
                    break;
                case 'waiting' :
                    $users = $this->get_waiting();
                    break;
                case 'noanswering':
                    $users = $this->get_noanswering();
                    break;
                case 'students':
                    $users = $this->get_students();
                    break;
                case 'todayFollowup':
                    $users = $this->get_todayFollowup();
                    break;
                case 'expireFollowup':
                    $users = $this->get_expireFollowup();
                    break;
                case 'myfollowup':
                    $users =$this->get_myfollowup();
                    break;
                case 'followedToday':
                    $users = $this->get_followedToday();
                    break;
                default:
                    return redirect('/admin/users/');
                    break;
            }
            //لیست تعداد کاربرها
            $notfollowup=count($this->get_notfollowup());
            $continuefollowup=count($this->get_continuefollowup());
            $cancelfollowup=count($this->get_cancelfollowup());
            $waiting=count($this->get_waiting());
            $noanswering=count($this->get_noanswering());
            $students =count($this->get_students());
            $todayFollowup = count($this->get_todayFollowup());
            $expireFollowup = $this->get_expireFollowup();
            $myfollowup=count($this->get_myfollowup());
            $followedToday = count($this->get_followedToday());
        }

        foreach ($users as $item)
        {
            $item->type=$this->userType($item->type);

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
        }
        $usersAdmin=user::orwhere('type','=','2')
                        ->orwhere('type','=',3)
                        ->get();

        //$users->appends(['categoryUsers'=>$request['categoryUsers']]);
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
                    ->with('user',$user);
    }


    public function showCategoryTagsAdmin(Request $request)
    {
        if(is_null($request))
        {
            return redirect('/panel');
        }
        else {
            $this->validate($request,
                [
                    'tags'  =>'array|required'
                ]);

            if (!isset($request['tags'])) {
                $msg = "حداقل یک گزینه برای اعمال فیلترها انتخاب کنید";
                $errorStatus = "danger";
                return back()->with('msg', $msg)
                    ->with('errorStatus', $errorStatus);
            } else {
                $tags = implode(',', $request['tags']);
                $users = user::join('followups', 'users.id', '=', 'followups.user_id')
                    ->where('followups.tags', 'like', '%' . $tags . '%')
                    ->where('followups.insert_user_id', '=', Auth::user()->id)
                    ->select('users.*')
                    ->groupby('users.id')
                    ->orderby('date_fa', 'desc')
                    ->paginate(20);

                foreach ($users as $item)
                {
                    $item->type=$this->userType($item->type);
                }
                $users->appends(['tags' => $request['tags']]);

                $tags = $this->get_tags();
                $parentCategory=$this->get_category('پیگیری');
                return view('panelAdmin.users')
                    ->with('tags', $tags)
                    ->with('users', $users)
                    ->with('parentCategory',$parentCategory);
            }
        }
    }

    //نمایش لیست دعوت شده ها
    public function listIntroducedUser(Request $request)
    {
        $user=Auth::user();
        if($request->has('category'))
        {
            //نمایش براساس دسته بندی افراد دعوت شده توسط کاربر
            switch ($request['category'])
            {
                case '0': return redirect('/panel/introduced');
                                break;
                case 'notfollowup': $listIntroducedUser=User::where('type','=','1')
                                ->where('introduced','=',$user->id)
                                ->orderby('id','desc')
                                ->groupby('id')
                                ->paginate(20);
                                break;
                case 'continuefollowup': $listIntroducedUser=User::where('type','=','11')
                                ->where('introduced','=',$user->id)
                                ->orderby('id','desc')
                                ->paginate(20);
                                break;
                case 'cancelfollowup': $listIntroducedUser=User::where('type','=','12')
                                ->where('introduced','=',$user->id)
                                ->orderby('id','desc')
                                ->paginate(20);
                                break;
                case 'students': $listIntroducedUser=User::where('type','=','20')
                                ->where('introduced','=',$user->id)
                                ->orderby('id','desc')
                                ->paginate(20);
                                break;
                default:return back();
                        break;
            }
        }
        else
        {
             //لیست همه افراد معرفی کرده
            $listIntroducedUser=User::where('introduced','=',$user->id)
                        ->paginate(20);
        }

        foreach($listIntroducedUser as $item)
        {
            if(strlen($item->personal_image)==0)
            {
                $item->personal_image="default-avatar.png";
            }
        }

        //تعداد افراد دعوت شده
        $countIntroducedUser=User::where('introduced','=',$user->id)
                        ->count();

        $listIntroducedUser->appends(['category'=>$request['category']]);
        $getFollowbyCategory=$this->getFollowbyCategory();
        return view('panelUser.listIntroducedUser')
                        ->with('listIntroducedUser',$listIntroducedUser)
                        ->with('countIntroducedUser',$countIntroducedUser)
                        ->with('getFollowbyCategory',$getFollowbyCategory);
    }

    public function searchUsers(Request $request)
    {
        $this->validate(request(),
            [
                'q'     =>'required|min:2|string'
            ],
            [
                'q.required'=>'برای جستجو یک مقدار وارد کنید'
            ]);

        $users=User::orwhere('fname','like','%'.$request['q'].'%')
                    ->orwhere('lname','like','%'.$request['q'].'%')
                    ->orwhere('tel','like','%'.$request['q'].'%')
                    ->orwhere('email','like','%'.$request['q'].'%')
                    ->orderby('id','desc')
                    ->paginate(20);
        foreach ($users as $item)
        {
            $item->type=$this->userType($item->type);
            $expert=$this->get_user_byID($item->followby_expert);
            if(!is_null($expert))
            {
                $item->followby_expert=$expert->fname." ".$expert->lname;
            }
            $item->countFollowup=$this->get_countFollowup($item->id);
            $item->lastDateFollowup=$this->get_lastFollowupUser($item->id)['date_fa'];
        }

        $users->appends(['q' => $request['q']]);
        $tags=$this->get_tags();
        $parentCategory=$this->get_category('پیگیری');
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
                    ->where('type','=',11);


            })
            ->count();

        $cancelfollowup = User::where('type', '=', '12')
            ->where('followby_expert', '=', Auth::user()->id)
            ->orwhere(function ($query)
            {
                $query  ->where('followby_expert','=',NULL)
                    ->where('type','=',12);
            })
            ->count();


        $waiting = User::where('type', '=', '13')
            ->where('followby_expert', '=', Auth::user()->id)
            ->orwhere(function ($query)
            {
                $query  ->where('followby_expert','=',NULL)
                    ->where('type','=',13);


            })
            ->count();


        $noanswering = User::where('type', '=', '14')
            ->where('followby_expert', '=', Auth::user()->id)
            ->orwhere(function ($query)
            {
                $query  ->where('followby_expert','=',NULL)
                    ->where('type','=',14);


            })
            ->count();


        $students = User::where('type', '=', '20')
            ->where('followby_expert', '=', Auth::user()->id)
            ->orwhere(function ($query)
            {
                $query  ->where('followby_expert','=',NULL)
                    ->where('type','=',20);


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
        $listIntroducedUser=User::where('introduced','=',$user->tel)
                    ->where(function ($query) use ($parent)
                    {
                        $query  ->orwhere('fname','like','%'.$parent.'%')
                                ->orwhere('lname','like','%'.$parent.'%')
                                ->orwhere('tel','like','%'.$parent.'%')
                                ->orwhere('email','like','%'.$parent.'%');

                    })
                    ->orderby('id','desc')
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

    public function addIntroducedUser(Request $request)
    {
        if(preg_match('/^09(1[0-9]|3[1-9]|2[1-9])-?[0-9]{3}-?[0-9]{4}$/',$request['tel']))
        {
            $this->validate(request(),
            [
                'fname'         =>'required|persian_alpha|min:3|max:15',
                'lname'         =>'required|persian_alpha|min:3|max:15',
                'tel'           =>'required|numeric|iran_mobile|',
                'followby_id'   =>'required|numeric'
            ]);

            $check=user::where('tel','=',$request['tel'])
                        ->count();

            if($check==0)
            {
                //ثبت تلفن دعوت شده به همراه تلفن دعوت کننده و تاریخ
                $status=User::create($request->all() +
                    [
                        'introduced'  =>Auth::user()->id,
                        'date_fa'       =>$this->dateNow,
                        'time_fa'       =>$this->timeNow
                    ]);

                if($status)
                {
                    if(is_null(Auth::user()->fname) ||(is_null(Auth::user()->lname)) )
                    {
                        $this->sendSms($request['tel'],"به فراکوچ خوش آمدید/ شما توسط ".Auth::user()->tel." به فراکوچ دعوت شدید");
                        $msg="تلفن با موفقیت در سیستم فراکوچ ثبت شد";
                        $errorStatus="success";
                    }
                    else
                    {
                        $this->sendSms($request['tel'],"به فراکوچ خوش آمدید/ شما توسط ".Auth::user()->fname.Auth::user()->lname ." به فراکوچ دعوت شدید");
                        $msg="تلفن با موفقیت در سیستم فراکوچ ثبت شد";
                        $errorStatus="success";
                    }
                }
                else
                {
                    $msg="خطا در ثبت";
                    $errorStatus="danger";
                }
            }
            else
            {
                $msg="شخص مورد نظر در گذشته توسط شما و یا شخص دیگر دعوت شده است";
                $errorStatus="danger";
            }

            return back()
                    ->with('msg',$msg)
                    ->with('errorStatus',$errorStatus);
        }
        else
        {
            $msg="شماره همراه وارد شده نادرست است";
            $errorStatus="danger";
            return back()
                    ->with('msg',$msg)
                    ->with('errorStatus',$errorStatus);
        }
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

                $problemFollowup = $problemFollowup = $this->getproblemfollowup();


                return view('panelUser.followupsIntroduced')
                    ->with('followUps', $followUps)
                    ->with('userInsert', $userInsert)
                    ->with('user', $user)
                    ->with('problemFollowup', $problemFollowup);
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
            $msg="کاربری با چنین مشخصاتی وجود ندارد";
            $errorStatus="danger";
            return redirect("/admin/users")
                ->with('msg',$msg)
                ->with('errorStatus',$errorStatus);
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
                $msg="رمز با موفقیت تغییر کرد";
                $errorStatus="success";
                return redirect("/admin/users")
                    ->with('msg',$msg)
                    ->with('errorStatus',$errorStatus);
            }
            else
            {
                $msg="خطا در تغییر رمز عبور";
                $errorStatus="danger";
                return redirect("/admin/users")
                    ->with('msg',$msg)
                    ->with('errorStatus',$errorStatus);
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
            $msg="کاربری با این اطلاعات موجود نمی باشد";
            $errorStatus="danger";
            return back()
                ->with('msg',$msg)
                ->with('errorStatus',$errorStatus);
        }
        else
        {
            $user['type']=$request['type'];
            $status=$user->save();
            if($status)
            {
                $msg="سطح دسترسی کاربر تغییر کرد";
                $errorStatus="success";
                return back()
                    ->with('msg',$msg)
                    ->with('errorStatus',$errorStatus);
            }
            else
            {
                $msg="خطا در تغییر سطح دسترسی";
                $errorStatus="danger";
                return back()
                    ->with('msg',$msg)
                    ->with('errorStatus',$errorStatus);
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
                    ->get();
                break;
            case 'notfollowup':
                $users = User:: leftjoin('followups', 'users.id', '=', 'followups.user_id')
                    ->where('users.type', '=', '1')
                    ->where('followby_expert','=',$request['user'])
                    ->orderby('users.id', 'desc')
                    ->select('users.*')
                    ->groupby('users.id')
                    ->get();
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
                }

                break;
            case 'continuefollowup':
                $users = User::where('type', '=', '11')
                    ->where('followby_expert','=',$request['user'])
                    ->orderby('id', 'desc')
                    ->groupby('id')
                    ->get();
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
                }

                break;
            case 'cancelfollowup':
                $users = User::where('type', '=', '12')
                    ->where('followby_expert','=',$request['user'])
                    ->orderby('id', 'desc')
                    ->groupby('id')
                    ->get();
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
                }

                break;
            case 'waiting' :
                $users = User::where('type', '=', '13')
                    ->where('followby_expert','=',$request['user'])
                    ->orderby('id', 'desc')
                    ->get();
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
                }

                break;
            case 'noanswering':
                $users = User::where('type', '=', '14')
                    ->where('followby_expert','=',$request['user'])
                    ->orderby('id', 'desc')
                    ->get();
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
                }

                break;
            case 'students':
                $users = User::where('type', '=', '20')
                    ->where('followby_expert','=',$request['user'])
                    ->orderby('id', 'desc')
                    ->get();
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
                }

                break;
            case 'todayFollowup':
                $users = User::join('followups', 'users.id', '=', 'followups.user_id')
                    ->where('followby_expert','=',$request['user'])
                    ->where('followups.nextfollowup_date_fa', '=', $this->dateNow)
                    ->select('users.*')
                    ->groupby('users.id')
                    ->orderby('date_fa', 'desc')
                    ->get();
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
                    ->get();
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
                }

                break;
            case 'myfollowup':
                $users = User::join('followups', 'users.id', '=', 'followups.user_id')
                    ->where('followby_expert','=',$request['user'])
                    ->where('nextfollowup_date_fa','=',$this->dateNow)
                    ->select('users.*')
                    ->groupby('users.id')
                    ->orderby('date_fa', 'desc')
                    ->get();

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
                }

                break;
            case 'followedToday':
                $users = User::join('followups', 'users.id', '=', 'followups.user_id')
                    ->where('followby_expert','=',$request['user'])
                    ->where('date_fa', '=', $this->dateNow)
                    ->select('users.*')
                    ->groupby('users.id')
                    ->orderby('date_fa', 'desc')
                    ->get();
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
                }

                break;
            default:
                return redirect('/admin/users/');
                break;
        }

        foreach ($users as $item)
        {
            $item->type=$this->userType($item->type);
            $item->countFollowup=$this->get_countFollowup($item->id);
            $expert=$this->get_user_byID($item->followby_expert);
            if(!is_null($expert))
            {
                $item->followby_expert=$expert->fname." ".$expert->lname;
            }

            $item->quality=$this->get_lastFollowupUser($item->id)['problem'];
            $item->quality_color=$this->get_lastFollowupUser($item->id)['color'];
            $item->lastDateFollowup=$this->get_lastFollowupUser($item->id)['date_fa'];
        }

        //$users->appends(['user' => $request['user'],'categoryUsers'=>$request['categoryUsers']]);
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
                    ->where('type','=',11);
            })
            ->count();

        $cancelfollowup = User::where('type', '=', '12')
            ->where('followby_expert', '=', Auth::user()->id)
            ->orwhere(function ($query)
            {
                $query  ->where('followby_expert','=',NULL)
                    ->where('type','=',12);
            })
            ->count();


        $waiting = User::where('type', '=', '13')
            ->where('followby_expert', '=', Auth::user()->id)
            ->orwhere(function ($query)
            {
                $query  ->where('followby_expert','=',NULL)
                    ->where('type','=',13);
            })
            ->count();


        $noanswering = User::where('type', '=', '14')
            ->where('followby_expert', '=', Auth::user()->id)
            ->orwhere(function ($query)
            {
                $query  ->where('followby_expert','=',NULL)
                    ->where('type','=',14);
            })
            ->count();


        $students = User::where('type', '=', '20')
            ->where('followby_expert', '=', Auth::user()->id)
            ->orwhere(function ($query)
            {
                $query  ->where('followby_expert','=',NULL)
                    ->where('type','=',20);
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

}
