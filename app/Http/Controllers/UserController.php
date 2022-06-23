<?php

namespace App\Http\Controllers;

use App\category_gettingknow;
use App\followup;
use App\landPage;
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
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;



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

            $users=User::where('users.type','<>',0)
                    ->where('users.type','=',1)
                    ->orderby('id','desc')
                    ->select('users.*')
//                    ->paginate($this->countPage());
                    ->get();


            foreach ($users as $item)
            {
                if($item->followups->where('flag','=',1)->first())
                {
                    $lastFollowup=$item->followups->where('flag','=',1)->first();
                    $item->status_followups=$this->userType($lastFollowup->status_followups);
                    $quality=($lastFollowup->problemfollowup);
                    $item->lastFollowupCourse=$lastFollowup->courses['course'];

                }


                if(isset($quality))
                {
                    $item->quality=$quality['problem'];
                    $item->quality_color=$quality['color'];
                    $item->lastDateFollowup=$lastFollowup['date_fa'];
                    $item->countFollowup=$item->followups->count();
                }
                else
                {
                    $item->quality=NULL;
                    $item->quality_color=NULL;
                    $item->lastDateFollowup=NULL;
                    $item->lastFollowupCourse=NULL;
                    $item->countFollowup=NULL;
                }

                $item->created_at = $this->changeTimestampToShamsi($item->created_at);
                if (!is_null($item->last_login_at)) {
                    $item->last_login_at = $this->changeTimestampToShamsi($item->last_login_at);
                }

                $expert=$this->get_user_byID($item->followby_expert);
                if(!is_null($expert))
                {
                    $item->followby_expert=$expert->fname." ".$expert->lname;
                }




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


                $item->gettingknow=($item->categoryGettingKnow['category']);
                if(!is_null($item->insert_user_id))
                {
                    $item->insert_user=$item->get_insertuserInfo('insert_user_id')->first()->fname." ".$item->get_insertuserInfo('insert_user_id')->first()->lname;
                }
                //$item=$this->changeNumberToData($item);
            }


            $tags=$this->get_tags();
            $parentCategory=$this->get_category('پیگیری');
            $usersAdmin=user::orwhere('type'    ,'=',2)
                        ->orwhere('type','=',3)
                        ->get();

            //لیست تعداد کاربرها
            $statics=$this->get_staticsCountUsers_admin();

            if(isset($request['user']))
            {
                $user=$request['user'];
            }
            else
            {
                $user="";
            }

            //دریافت کفیت های پیگیری
            $problem=$this->get_problemfollowup(NULL,1);

            return view('admin.users')
                ->with('users',$users)
                ->with('tags',$tags)
                ->with('parentCategory',$parentCategory)
                ->with('usersAdmin',$usersAdmin)
                ->with('user',$user)
                ->with('problem',$problem)
                ->with('statics',$statics)
                ->with('dateNow',$this->dateNow)
                ->with('parameter',$request['parameter']);
        }

        //نیروهای فروش
        elseif(Auth::user()->type==3)
        {
            $users=User::leftjoin('followups','users.id','=','followups.user_id')
                        ->where(function($query)
                        {
                            $query->orwhere('followby_expert','=',Auth::user()->id)
                                  ->orwhere('followby_expert','=',NULL);
                        })
                        ->where('followups.flag','=',1)
                        ->whereNotIn('users.type',[-3,-2,-1,2,3,0,30])
                        ->select('users.*','followups.nextfollowup_date_fa')
                        ->orderby('followups.nextfollowup_date_fa','desc')
                        ->orderby('users.id','desc')
                        ->groupby('users.id')
                        ->get();


            $users=User::where(function($query)
                {
                    $query->orwhere('followby_expert','=',Auth::user()->id)
                        ->orwhere('followby_expert','=',NULL);
                })
                ->whereNotIn('users.type',[-3,-2,-1,2,3,0,30])
                ->orderby('users.id','desc')
                ->groupby('users.id')
                ->get();




            $usersAdmin=user::orwhere('type','=',2)
                ->orwhere('type','=',3)
                ->get();
            // دریافت تعداد کاربرها بر اساس دسته بندی ها
            $statics=$this->get_staticsCountUsers_admin();

            foreach ($users as $item)
            {
                if($item->followups->where('flag','=',1)->first())
                {
                    $lastFollowup=$item->followups->where('flag','=',1)->first();
                    $item->status_followups=$this->userType($lastFollowup->status_followups);
                    $quality=($lastFollowup->problemfollowup);
                    $item->lastFollowupCourse=$lastFollowup->courses['course'];

                }


                if(isset($quality))
                {
                    $item->quality=$quality['problem'];
                    $item->quality_color=$quality['color'];
                    $item->lastDateFollowup=$lastFollowup['date_fa'];

                    $item->countFollowup=$item->followups->count();
                }
                else
                {
                    $item->quality=NULL;
                    $item->quality_color=NULL;
                    $item->lastDateFollowup=NULL;
                    $item->lastFollowupCourse=NULL;
                    $item->countFollowup=NULL;
                }

                $item->created_at = $this->changeTimestampToShamsi($item->created_at);
                if (!is_null($item->last_login_at)) {
                    $item->last_login_at = $this->changeTimestampToShamsi($item->last_login_at);
                }

                $expert=$this->get_user_byID($item->followby_expert);
                if(!is_null($expert))
                {
                    $item->followby_expert=$expert->fname." ".$expert->lname;
                }

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


                $item->gettingknow=($item->categoryGettingKnow['category']);
                if(!is_null($item->insert_user_id))
                {
                    $item->insert_user=$item->get_insertuserInfo('insert_user_id')->first()->fname." ".$item->get_insertuserInfo('insert_user_id')->first()->lname;
                }
            }


            $tags=$this->get_tags();
            $parentCategory=$this->get_category('پیگیری');

            //دریافت کفیت های پیگیری
            $problem=$this->get_problemfollowup(NULL,1);

            return view('admin.users')
                        ->with('users',$users)
                        ->with('tags',$tags)
                        ->with('parentCategory',$parentCategory)
                        ->with('usersAdmin',$usersAdmin)
                        ->with('problem',$problem)
                        ->with('statics',$statics)
                        ->with('dateNow',$this->dateNow)
                        ->with('parameter',$request['parameter']);
        }
        //نیروهای کلینیک
        elseif(Auth::user()->type==4)
        {
            $users=User::orwhere('type','=',30)
                ->orwhere(function($query)
                {
                    $query->orwhere('followby_expert','=',Auth::user()->id);
                        //->orwhere('followby_expert','=',NULL);
                })
                ->orderby('id','desc')
                ->get();

            $statics=$this->get_staticsCountUsers_admin();


            $dateNow=$this->dateNow;
            $todayFollowup=User::where('followby_expert','=',Auth::user()->id)
                                ->whereHas("followups" , function ($query) use ($dateNow)
                                {
                                    $query->where('nextfollowup_date_fa','=',$dateNow)
                                           ->where('flag','=',1);
                                })
                                ->get();

            return  view('admin.users_clinic')
                            ->with('users',$users)
                            ->with('statics',$statics);
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
        }
        else
        {
            $request['tel']=$this->convertPersianNumber($request->tel);
            $this->validate(request(),
            [
                'fname'             =>'persian_alpha|required|min:3',
                'lname'             =>'persian_alpha|required|min:3',
                'codemelli'         =>'nullable|melli_code',
                'sex'               =>'nullable|boolean',
                'tel'               =>'required|',
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

        $condition=['parent_id','=','0'];
        $gettingKnow_parent=$this->get_categoryGettingknow(NULL,NULL,1,NULL,'get',$condition);

        return view('admin.registerUser')
                    ->with('gettingKnow_parent',$gettingKnow_parent)
                    ->with('settingsms',$settingsms);

    }
    //Register User by Admin
    public function register(Request $request)
    {
        $request['tel']=$this->convertPersianNumber($request->tel);
        $this->validate($request, [
            'fname'             => ['nullable','persian_alpha', 'string', 'max:30'],
            'lname'             => ['nullable','persian_alpha', 'string', 'max:30'],
            'email'             => ['nullable', 'string', 'email', 'max:150', 'unique:users'],
            'sex'               => ['required','numeric'],
            'tel'               => ['required','unique:users'],
            'password'          => ['required', 'string', 'confirmed'],
            'tel_verified'      => ['required','boolean'],
            'introduced'        => ['nullable','numeric'],
            'gettingknow'       => ['nullable','numeric'],
            'organization'      => ['nullable','persian_alpha'],
            'jobside'           => ['nullable','persian_alpha'],
            'type'              => ['required','string']
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
            'type'              =>$request['type']

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
            return redirect('/admin/add');
        }
        else
        {
            alert()->error("خطا در ثبت کاربر",'خطا')->persistent('بستن');
            return redirect('/admin/add');
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
        if(is_null($user->tel))
        {
            $countIntroducedUser=NULL;
        }
        else
        {
            $countIntroducedUser=User::where('introduced','=',$user->tel)
                ->count();
        }


        //یوزر توسط چه کسی معرفی شده است
        if(is_null($user->introduced))
        {
            $resourceIntroduce=NULL;
        }
        else
        {
            $resourceIntroduce=User::where('tel','=',$user->introduced)
                ->first();
        }



        $states=$this->states();


        if(!is_null($user->gettingknow))
        {
            $user->gettingknow_parent_user=$this->get_categoryGettingknow($user->gettingknow,NULL,NULL,NULL,'first')->parent_id;
            $condition=['parent_id','=',$user->gettingknow_parent_user];
            $gettingKnow_child_list=$this->get_categoryGettingknow(NULL,NULL,1,NULL,'get',$condition);
        }
        else
        {
            $gettingKnow_child_list=NULL;
        }


        //انتخاب شهر براساس کد
        $city=$this->city($user->city);

        $condition=['parent_id','=','0'];
        $gettingKnow_parent_list=$this->get_categoryGettingknow(NULL,NULL,1,NULL,'get',$condition);

        return view ('user.profile')
                        ->with('user',$user)
                        ->with('countIntroducedUser',$countIntroducedUser)
                        ->with('resourceIntroduce',$resourceIntroduce)
                        ->with('states',$states)
                        ->with('gettingKnow_parent_list',$gettingKnow_parent_list)
                        ->with('gettingKnow_child_list',$gettingKnow_child_list)
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
        $problemFollowup=$this->get_problemfollowup(NULL,1);

        //مقدار یوزر با توجه به دستور زیر مقدار ورودی تابع با مقدار خروجی تقییر میکند
        $user=User::find($user);

        if(!is_null($user->gettingknow))
        {
            $user->gettingknow_parent_user=$this->get_categoryGettingknow($user->gettingknow,NULL,NULL,NULL,'first')->parent_id;
            $condition=['parent_id','=',$user->gettingknow_parent_user];
            $gettingKnow_child_list=$this->get_categoryGettingknow(NULL,NULL,1,NULL,'get',$condition);
        }
        else
        {
            $gettingKnow_child_list=NULL;
        }



        if (strlen($user->personal_image) == 0) {
            $user->personal_image = "default-avatar.png";
        }

        //یوزر توسط چه کسی معرفی شده است
        $resourceIntroduce = User::where('id', '=', $user->introduced)
            ->first();

        // دریافت لیست مسئولین پیگیری
        $expert_followup = user::where(function ($query) {
            $query->orwhere('type', '=', 2)
                    ->orwhere('type', '=', 3)
                    ->orwhere('type', '=', 4);
        })
            //->where('id','<>',Auth::user()->id)
            ->get();


        //تعداد افراد معرفی کرده
        $countIntroducedUser = User::where('introduced', '=', $user->id)
            ->count();
        $introducedUser = User::where('introduced', '=', $user->id)
            ->get();

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


        $condition=['parent_id','=','0'];
        $gettingKnow_parent_list=$this->get_categoryGettingknow(NULL,NULL,1,NULL,'get',$condition);




        return view('admin.profile')
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
                    ->with('gettingKnow_child_list',$gettingKnow_child_list)
                    ->with('gettingKnow_parent_list',$gettingKnow_parent_list)
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
                    'tel'               =>'nullable|string',
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
                    'personal_image'    =>'nullable|mimes:jpeg,jpg,bmp,png|max:600',
                    'shenasnameh_image' =>'nullable|mimes:jpeg,jpg,bmp,png|max:600',
                    'cartmelli_image'   =>'nullable|mimes:jpeg,jpg,bmp,png|max:600',
                    'education_image'   =>'nullable|mimes:jpeg,jpg,bmp,png|max:600',
                    'resume'            =>'nullable|mimes:docx,doc,pdf,jpg,png|max:1024',
                    'email'             =>'nullable|email|',
                    'gettingknow'       =>'nullable|numeric',
                    'gettingknow_child' =>'nullable|numeric',
                    'introduced'        =>'nullable|numeric',
                    'telegram'          =>'nullable|max:50|regex:/^[a-zA-Z0-9._]+$/u',
                    'instagram'         =>'nullable|max:50|regex:/^[a-zA-Z0-9._]+$/u',
                    'linkedin'          =>'nullable|string|max:250',
                    'aboutme'           =>'nullable|string|max:250',
                ]);


            if ($request->has('personal_image') && $request->file('personal_image')->isValid()) {
                $file = $request->file('personal_image');
                $personal_image = "personal-" . $user->tel . "." . $request->file('personal_image')->extension();
                $path = public_path('documents/users/');
                $files = $request->file('personal_image')->move($path, $personal_image);
                $img=Image::make($files->getRealPath());
                $img->resize(350,350);
                $img->save($path.'small-'.$personal_image);
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
                $status=$user->delete();

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
    }

    // نمایش اعضای سایت براساس دسته بندی برای ادمین
    public function showCategoryUsersAdmin(Request $request)
    {
        $dateNow=$this->dateNow;
        switch ($request['categoryUsers'])
        {
            case '0':
                return redirect('/admin/users/');
                            break;
            case 'lead':
                $users = user::orwhere('type','=',-1)
                    ->orwhere('type','=',-2)
                    ->orwhere('type','=',-3)
                    ->orderby('id','desc')
                    ->get();
                break;
            case 'notfollowup':
                $users = user::where('type','=',1)
                            ->orderby('id','desc')
                            ->get();
                break;
            case 'continuefollowup':
                $users=Auth::user()->get_followby_expert()
                            ->where('type','=',11)
                            ->get();

                break;
            case 'cancelfollowup':
                $users=Auth::user()->get_followby_expert()
                    ->where('type','=',12)
                    ->get();
                break;
            case 'waiting' :
                $users=Auth::user()->get_followby_expert()
                            ->where('type','=',13)
                            ->get();
                break;
            case 'noanswering':
                $users=Auth::user()->get_followby_expert()
                            ->where('type','=',14)
                            ->get();
                break;
            case 'students':
                $users=Auth::user()->get_followby_expert()
                            ->where('type','=',20)
                            ->get();
                break;
            case 'todayFollowup':
                $condition=['nextfollowup_date_fa','=',$this->dateNow];
                $users=$this->get_usersByType(NULL,Auth::user()->id,NULL,NULL,$condition,NULL,1);
                break;
            case 'expireFollowup':

                $users=User::where('followby_expert','=',Auth::user()->id)
                        ->whereNotIn('type',['-1','-2','-3','12'])
                        ->whereHas('followups',function($query) use ($dateNow)
                        {
                            $query->where('flag','=',1)
                                    ->where('nextfollowup_date_fa','<',$dateNow);
                        })
                        ->get();
                break;
            case 'myfollowup':
                $users =$this->get_usersByType(NULL,Auth::user()->id);
                break;
            case 'followedToday':
                $users = $this->get_followedToday();
                break;
            default:
                return redirect('/admin/users/');
                break;
        }

        $statics=$this->get_staticsCountUsers_admin();


        foreach ($users as $item)
        {
            if($item->followups->where('flag','=',1)->first())
            {
                $lastFollowup=$item->followups->where('flag','=',1)->first();
                $item->status_followups=Auth::user()->userType($lastFollowup->status_followups);
                $quality=($lastFollowup->problemfollowup);
                $item->lastFollowupCourse=$lastFollowup->courses['course'];
            }


            if(isset($quality))
            {
                $item->quality=$quality['problem'];
                $item->quality_color=$quality['color'];
                $item->lastDateFollowup=$lastFollowup['date_fa'];

                $item->countFollowup=$item->followups->count();
            }
            else
            {
                $item->quality=NULL;
                $item->quality_color=NULL;
                $item->lastDateFollowup=NULL;
                $item->lastFollowupCourse=NULL;
                $item->countFollowup=NULL;
            }

            $item->created_at = $this->changeTimestampToShamsi($item->created_at);
            if (!is_null($item->last_login_at)) {
                $item->last_login_at = $this->changeTimestampToShamsi($item->last_login_at);
            }

            $expert=$this->get_user_byID($item->followby_expert);
            if(!is_null($expert))
            {
                $item->followby_expert=$expert->fname." ".$expert->lname;
            }




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


            $item->gettingknow=($item->categoryGettingKnow['category']);
            if(!is_null($item->insert_user_id))
            {
                $item->insert_user=$item->get_insertuserInfo('insert_user_id')->first()->fname." ".$item->get_insertuserInfo('insert_user_id')->first()->lname;
            }


            //$item= $this->changeNumberToData($item);
        }

        $usersAdmin=user::orwhere('type','=',2)
                        ->orwhere('type','=',3)
                        ->get();
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

        //دریافت کفیت های پیگیری
        $problem=$this->get_problemfollowup(NULL,1);

        return view('admin.users')
                    ->with('tags',$tags)
                    ->with('users',$users)
                    ->with('parentCategory',$parentCategory)
                    ->with('usersAdmin',$usersAdmin)
                    ->with('statics',$statics)
                    ->with('user',$user)
                    ->with('parameter',$request['parameter'])
                    ->with('problem',$problem)
                    ->with('categoryUsers',$request['categoryUsers']);
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

            if (!isset($request['tags']))
            {
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
//                    ->paginate($this->countPage());
                    ->get();


                foreach ($users as $item)
                {
                    $item=$this->changeNumberToData($item);
                }

//                $users->appends(['tags' => $request['tags']]);

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
                $statics=$this->get_staticsCountUsers_admin();

                //دریافت کفیت های پیگیری
                $problem=$this->get_problemfollowup(NULL,1);


                return view('admin.users')
                    ->with('tags',$tags)
                    ->with('users',$users)
                    ->with('parentCategory',$parentCategory)
                    ->with('usersAdmin',$usersAdmin)
                    ->with('user',$user)
                    ->with('statics',$statics)
                    ->with('parameter',$request['parameter'])
                    ->with('problem',$problem);
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
            return view('user.IntroducedVerified')
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

            return view('user.listIntroducedUser')
                ->with('listIntroducedUser', $listIntroducedUser)
                ->with('countIntroducedUser', $countIntroducedUser)
                ->with('getFollowbyCategory', $getFollowbyCategory);
        }
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


        $users=User::leftjoin('followups','users.id','=','followups.user_id')
                    ->orwhere('fname','like','%'.$request['q'].'%')
                    ->orwhere('lname','like','%'.$request['q'].'%')
                    ->orwhere('tel','like','%'.$request['q'].'%')
                    ->orwhere('email','like','%'.$request['q'].'%')
                    ->select('users.*')
                    ->groupby('users.id')
                    ->orderby('users.id','desc')
//                    ->paginate($this->countPage());
                    ->get();

        foreach ($users as $item)
        {
            $item=$this->changeNumberToData($item);
        }

        $tags=$this->get_tags();
        $parentCategory=$this->get_category('پیگیری');
        $usersAdmin=user::orwhere('type','=',2)
                        ->orwhere('type','=',3)
                        ->get();

        //لیست تعداد کاربرها
        $statics=$this->get_staticsCountUsers_admin();

        if(isset($request['user']))
        {
            $user=$request['user'];
        }
        else
        {
            $user="";
        }

        //دریافت کفیت های پیگیری
        $problem=$this->get_problemfollowup(NULL,1);



        return view('admin.users')
                    ->with('users',$users)
                    ->with('tags',$tags)
                    ->with('parentCategory',$parentCategory)
                    ->with('usersAdmin',$usersAdmin)
                    ->with('user',$user)
                    ->with('problem',$problem)
                    ->with('statics',$statics)
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

        $getFollowbyCategory = $this->getFollowbyCategory();
        return view('user.listIntroducedUser')
                    ->with('listIntroducedUser',$listIntroducedUser)
                    ->with('getFollowbyCategory',$getFollowbyCategory)
                    ->with('countIntroducedUser',$countIntroducedUser);
    }


    //اضافه کردن یوزر توسط سفیر
    public function addIntroducedUser(Request $request)
    {
            $request['tel']=$this->convertPersianNumber($request->tel);
            $this->validate(request(),
            [
                'fname'         =>'required|persian_alpha|min:3|max:15',
                'lname'         =>'required|persian_alpha|min:3|max:15',
                'tel'           =>'required|unique:users',
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
                            alert()->success("تلفن با موفقیت در سیستم فراکوچ ثبت شد", 'پیام')->persistent('بستن');
                        } else {
                            $this->sendSms($request['tel'], "به فراکوچ خوش آمدید/ شما توسط " . Auth::user()->fname . Auth::user()->lname . " به فراکوچ دعوت شدید" ." رمز عبور:1234 ");
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

                $problemFollowup = $this->get_problemfollowup(NULL,1,NULL,'get');

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

                return view('user.followupsIntroduced')
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

        $user=$this->get_user($tel,NULL,NULL,NULL,true);
        if(is_null($user))
        {
            alert()->error('کاربری با چنین مشخصاتی وجود ندارد','خطا')->persistent('بستن');
            return redirect("/admin/users");
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
                alert()->success('رمز با موفقیت تغییر کرد','پیام')->persistent('بستن');
                return redirect("/admin/users");
            }
            else
            {
                alert()->error('خطا در تغییر رمز عبور','خطا')->persistent('بستن');
                return redirect("/admin/users");
            }
        }
    }


    public function updatePasswordUser(Request $request)
    {
        $user=Auth::user();
        if(is_null($user))
        {
            alert()->error('کاربری با چنین مشخصاتی وجود ندارد','خطا')->persistent('بستن');
            return redirect("/panel/profile");
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
                alert()->success('رمز با موفقیت تغییر کرد','پیام')->persistent('بستن');
                return redirect("/panel/profile");
            }
            else
            {
                alert()->error('خطا در تغییر رمز عبور','خطا')->persistent('بستن');
                return redirect("/panel/profile");
            }
        }
    }

    public function changeType(Request $request,$id)
    {
        $this->validate(request(),
        [
            'type'=>'required|numeric'
        ]);

        $typing=$this->userType($request['type']);

//        switch($request['type'])
//        {
//            case '-1': $typing='مارکتینگ';
//                        break;
//            case '11': $typing='فروش';
//                        break;
//
//        }
        $data=$this->get_user_byID($id);
        if($data)
        {
            $check=followup::create([
                'user_id'               =>$id,
                'insert_user_id'        =>Auth::user()->id,
                'date_fa'               =>$this->dateNow,
                'time_fa'               =>$this->timeNow,
                'comment'               =>" کاربر ارجاع داده شد به بخش $typing",
                'datetime_fa'           =>$this->dateNow." ".$this->timeNow,

            ]);
            if($check)
            {

                $data->type=$request['type'];
                $data->followby_expert=NULL;
                $status=$data->save();
                if($status)
                {
                    alert()->success('سطح دسترسی کاربر تغییر کرد','پیام')->persistent('بستن');
                    return back();
                }
                else
                {
                    alert()->error('خطاتغییر سطح دسترسی')->persistent('بستن');
                }
            }

//        $user=User::leftjoin('followups','users.id','=','followups.user_id')
//                ->where('users.id','=',$id)
//                ->where('followups.flag','=',1)
//                ->select('users.*','followups.nextfollowup_date_fa')
//                ->first();
        }
        else
        {
            alert()->error('کاربری با این اطلاعات موجود نمی باشد','خطا')->persistent('بستن');
            return back();
        }
//        else
//        {
//
////            $user=$this->get_user(NULL,$id,NULL,NULL,'first');
////            $user['type']=$request['type'];
////            $user['followby_expert']=NULL;
//            $status=$user->save();
//
//            if($status)
//            {
//                $followups=$this->get_followup(NULL,$id,NULL,1,'first');
//
//                $followups['nextfollowup_date_fa']=NULL;
//                $status=$followups->save();
//
//                if($status)
//                {
//                    alert()->success('سطح دسترسی کاربر تغییر کرد','پیام')->persistent('بستن');
//                    return back();
//                }
//                else
//                {
//                    alert()->error('خطا در پاک کردن تاریخ پیگیری بعد')->persistent('بستن');
//                }
//            }
//            else
//            {
//                alert()->error('خطا در تغییر سطح دسترسی','خطا')->persistent('بستن');
//                return back();
//            }
//
//        }
    }

    public function checkUserAjax(Request $request,$id)
    {

        if(strlen($id)>0)
        {
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
        }
        else
        {
            return "<input type='hidden' value='' />";
        }
    }

//    public function advanceSearchUsers (Request $request)
    public function advancesearch (Request $request)
    {
        $this->validate($request,[
            'user'              =>'nullable|numeric',
            'categorypeygiri'   =>'nullable|boolean',
            'gettingknow'       =>'nullable|string'
        ]);

        if(!is_null($request['user']))
        {
            $user=$request['user'];
        }
        if(!is_null($request['categorypeygiri']))
        {
            $categorypeygiri=$request['categorypeygiri'];
        }



        $users = User:: join('followups', 'users.id', '=', 'followups.user_id')
                    ->when(($request['categorypeygiri']=="1" && $request['user'] ),function($query) use ($request)
                    {
                        return $query->where('users.insert_user_id','=',$request->user);
                    })
                    ->when(($request['categorypeygiri']=="0" && $request['user']),function($query) use ($request)
                    {
                        return $query->where('users.followby_expert','=',$request->user);
                    })
                    ->when(($request['categorypeygiri']=="1"),function($query) use ($request)
                    {
                        return $query->whereNotNull('followups.insert_user_id');
                    })
                    ->when(($request['categorypeygiri']=="0"),function($query) use ($request)
                    {
                        return $query->whereNotNull('users.followby_expert');
                    })
                    ->when(($request['gettingknow']),function($query) use ($request)
                    {
                        return $query->where('users.gettingknow','=',$request->gettingknow);
                    })
                    ->when(($request['problem']),function($query) use ($request)
                    {
                        return $query->where('followups.problemfollowup_id','=',$request->problem);
                    })
                    ->where('flag','=',1)
                    ->orderby('followups.id','desc')
//                    ->groupby('followups.user_id')
                    ->select('users.*')
//                    ->paginate($this->countPage());
                    ->get();




        foreach ($users as $item)
        {
            $item=$this->changeNumberToData($item);
        }

        $tags=$this->get_tags();
        $parentCategory=$this->get_category('پیگیری');
        $usersAdmin=user::orwhere('type','=',2)
                ->orwhere('type','=',3)
                ->get();


        //لیست تعداد کاربرها
        $statics=$this->get_staticsCountUsers_admin();

        //دریافت کفیت های پیگیری
        $problem=$this->get_problemfollowup(NULL,1);



        return view('admin.users')
            ->with('users',$users)
            ->with('tags',$tags)
            ->with('parentCategory',$parentCategory)
            ->with('usersAdmin',$usersAdmin)
            ->with('user',Auth::user()->id)
            ->with('parameter',$request['parameter'])
            ->with('statics',$statics)
            ->with('problem',$problem);
    }

    public function createExcel()
    {
        return view('admin.excelImport');
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
            if(!strlen($item['email'])>0)
            {
                $item['email']=NULL;
            }

            $item['tel']=$this->convertPersianNumber($item['tel']);
            $count=user::orwhere('tel','=',$item['tel'])
                        ->when($item['email'],function($query,$item)
                        {
                            return $query->orwhere('email', '=', $item);
                        })
                        ->count();

            if($count==0)
            {
                $item['password']=Hash::make('1234');
                $status=user::create($item);
                if($status)
                {
                    $i++;
                }

            }
        }
        alert()->success("تعداد".$i."نفر وارد بانک اطلاعاتی شدند",'پیام')->persistent('بستن');
        return back();
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
            alert()->success("شرایط و ضوابط بطور کامل توسط شما پذیرفته شد",'پیام')->persistent('بستن');
            return redirect('/panel/introduced');
        }
        else
        {
            alert()->error("خطا در پذیرفتن شرایط و ضوابط ",'خطا')->persistent('بستن');
            return back();
        }
    }

    //نمایش اعضا براساس نحوه آشنایی برای ادمین
    public function list_user_gettingknow(Request $request)
    {

    }


    public function export_excel()
    {
        //خروجی اکسل
        $list=user::where('introduced_verified','=',1)
                    ->get();


        $excel=fastexcel($list)->export('export.xlsx');
        if($excel)
        {
            return response()->download(public_path('export.xlsx'));

        }
        else
        {
            return back();
        }

    }


    //تبدیل کدهای خارجی به دیتاهای مربوط به خودشون در زمان نمایش کاربرها بر اساس دسته بندی های مختلف
    public function changeNumberToData($item)
    {
        $tmp=$this->get_followup(NULL,$item->id,NULL,1,'first');

        if($tmp->count()>0)
        {
            $item->status_followups=$this->userType($this->get_lastFollowupUser($item->id)['status_followups']);
            $quality=$this->get_problemfollowup($tmp['problemfollowup_id'],NULL,NULL,'first');
        }


        if(isset($quality) && ($quality->count()>0))
        {
            $item->quality=$quality['problem'];
            $item->quality_color=$quality['color'];
            $item->lastDateFollowup=$tmp['date_fa'];
            $item->lastFollowupCourse=$tmp['course_id'];
            $item->countFollowup=$this->get_followup(NULL,$item->id,NULL,NULL,'get')->count();
        }
        else
        {
            $item->quality=NULL;
            $item->quality_color=NULL;
            $item->lastDateFollowup=NULL;
            $item->lastFollowupCourse=NULL;
            $item->countFollowup=NULL;
        }


        $item->created_at = $this->changeTimestampToShamsi($item->created_at);
        if (!is_null($item->last_login_at)) {
            $item->last_login_at = $this->changeTimestampToShamsi($item->last_login_at);
        }
        $expert=$this->get_user_byID($item->followby_expert);
        if(!is_null($expert))
        {
            $item->followby_expert=$expert->fname." ".$expert->lname;
        }
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

        if(!is_null($item))
        {
            $item->gettingknow=$this->get_categoryGettingknow($item->gettingknow,NULL,NULL,NULL,'first')->category;
        }

        if(!is_null($item->insert_user_id))
        {

            $item->insert_user = $this->get_user(NULL, $item->insert_user_id, NULL, NULL, true)->fname.' '.$this->get_user(NULL, $item->insert_user_id, NULL, NULL, true)->lname ;
        }

        return $item;
    }

    public function signupAjax(Request $request)
    {
        $request->email=$this->convertPersianNumber($request->email);
        $request->tel=$this->convertPersianNumber($request->tel);
        $request->password=$this->convertPersianNumber($request->password);
        $request->password_confirmation=$this->convertPersianNumber($request->password_confirmation);
        $this->validate($request,[
            'email'     =>'required|email|unique:users',
            'tel'       =>'required|unique:users',
            'password'  =>'required|string|min:8|confirmed'
        ]);

        $user=User::create([
            'email'     =>$request->email,
            'tel'       =>$request->tel,
            'password'  =>Hash::make($request['password'])
        ]);

        if($user)
        {
            Auth::loginUsingId($user->id);
            alert()->success('ثبت نام با موفقیت انجام شد')->persistent('بستن');
            echo "<script>location.reload()</script>";
        }
        else
        {
            return "<div class='alert alert-danger'>خطا در ثبت نام</div>";
        }
    }

//    public function contacts()
//    {
//        $user=Auth::user();
//        if(strlen(Auth::user()->personal_image)==0)
//        {
//            $user->personal_image="default-avatar.png";
//        }
//
//        //تعداد افراد دعوت شده
//        $countIntroducedUser=User::where('introduced','=',$user->tel)
//            ->count();
//
//        //یوزر توسط چه کسی معرفی شده است
//        $resourceIntroduce=User::where('tel','=',$user->introduced)
//            ->first();
//
//        $states=$this->states();
//
//
//        if(!is_null($user->gettingknow))
//        {
//            $user->gettingknow_parent_user=$this->get_categoryGettingknow($user->gettingknow,NULL,NULL,NULL,'first')->parent_id;
//            $condition=['parent_id','=',$user->gettingknow_parent_user];
//            $gettingKnow_child_list=$this->get_categoryGettingknow(NULL,NULL,1,NULL,'get',$condition);
//        }
//        else
//        {
//            $gettingKnow_child_list=NULL;
//        }
//
//
//        //انتخاب شهر براساس کد
//        $city=$this->city($user->city);
//
//        $condition=['parent_id','=','0'];
//        $gettingKnow_parent_list=$this->get_categoryGettingknow(NULL,NULL,1,NULL,'get',$condition);
//
//        return view ('user.contacts_info')
//            ->with('user',$user)
//            ->with('countIntroducedUser',$countIntroducedUser)
//            ->with('resourceIntroduce',$resourceIntroduce)
//            ->with('states',$states)
//            ->with('gettingKnow_parent_list',$gettingKnow_parent_list)
//            ->with('gettingKnow_child_list',$gettingKnow_child_list)
//            ->with('city',$city);
//    }

//    public function introduction()
//    {
//        $user=Auth::user();
//        if(strlen(Auth::user()->personal_image)==0)
//        {
//            $user->personal_image="default-avatar.png";
//        }
//
//        //تعداد افراد دعوت شده
//        $countIntroducedUser=User::where('introduced','=',$user->tel)
//            ->count();
//
//        //یوزر توسط چه کسی معرفی شده است
//        $resourceIntroduce=User::where('tel','=',$user->introduced)
//            ->first();
//
//        $states=$this->states();
//
//
//        if(!is_null($user->gettingknow))
//        {
//            $user->gettingknow_parent_user=$this->get_categoryGettingknow($user->gettingknow,NULL,NULL,NULL,'first')->parent_id;
//            $condition=['parent_id','=',$user->gettingknow_parent_user];
//            $gettingKnow_child_list=$this->get_categoryGettingknow(NULL,NULL,1,NULL,'get',$condition);
//        }
//        else
//        {
//            $gettingKnow_child_list=NULL;
//        }
//
//
//        //انتخاب شهر براساس کد
//        $city=$this->city($user->city);
//
//        $condition=['parent_id','=','0'];
//        $gettingKnow_parent_list=$this->get_categoryGettingknow(NULL,NULL,1,NULL,'get',$condition);
//
//        return view ('user.introduction_info')
//            ->with('user',$user)
//            ->with('countIntroducedUser',$countIntroducedUser)
//            ->with('resourceIntroduce',$resourceIntroduce)
//            ->with('states',$states)
//            ->with('gettingKnow_parent_list',$gettingKnow_parent_list)
//            ->with('gettingKnow_child_list',$gettingKnow_child_list)
//            ->with('city',$city);
//    }

//    public function contract()
//    {
//        $user=Auth::user();
//        if(strlen(Auth::user()->personal_image)==0)
//        {
//            $user->personal_image="default-avatar.png";
//        }
//
//        //تعداد افراد دعوت شده
//        $countIntroducedUser=User::where('introduced','=',$user->tel)
//            ->count();
//
//        //یوزر توسط چه کسی معرفی شده است
//        $resourceIntroduce=User::where('tel','=',$user->introduced)
//            ->first();
//
//        $states=$this->states();
//
//
//        if(!is_null($user->gettingknow))
//        {
//            $user->gettingknow_parent_user=$this->get_categoryGettingknow($user->gettingknow,NULL,NULL,NULL,'first')->parent_id;
//            $condition=['parent_id','=',$user->gettingknow_parent_user];
//            $gettingKnow_child_list=$this->get_categoryGettingknow(NULL,NULL,1,NULL,'get',$condition);
//        }
//        else
//        {
//            $gettingKnow_child_list=NULL;
//        }
//
//
//        //انتخاب شهر براساس کد
//        $city=$this->city($user->city);
//
//        $condition=['parent_id','=','0'];
//        $gettingKnow_parent_list=$this->get_categoryGettingknow(NULL,NULL,1,NULL,'get',$condition);
//
//        return view ('user.contract_info')
//            ->with('user',$user)
//            ->with('countIntroducedUser',$countIntroducedUser)
//            ->with('resourceIntroduce',$resourceIntroduce)
//            ->with('states',$states)
//            ->with('gettingKnow_parent_list',$gettingKnow_parent_list)
//            ->with('gettingKnow_child_list',$gettingKnow_child_list)
//            ->with('city',$city);
//    }


    //پیدا کردن و پاک کردن اطلاعات ناهمسان جداول باهمدیگر
    public function test()
    {
        $users=User::get();
        foreach ($users as $item)
        {
            $user=User::find($item->id);
            echo "<script>console.log(".$user->id.");</script>";

            if(($user->tel[0]=='0')&&(!is_null($user->tel)))
            {
                try {
                    $user->tel='+98'.substr($user['tel'],1);
                    $user->save();
                }
                catch (Throwable $e)
                {
                    $user->tel='0'.substr($user['tel'],1);
                    $user->save();
                }

            }
        }

    }

    public function userAjax(Request $request)
    {
        $this->validate($request,[
            'user'   =>'required|min:3|string',
        ]);
        $user=User::orwhere('tel','like','%'.$request->user.'%')
                    ->orwhere('fname','like','%'.$request->user.'%')
                    ->orwhere('lname','like','%'.$request->user.'%')
                    ->get();
        return $user;
    }


    //لاگین کاربر از طریق ادمین
    public function loginWithUser(User $user)
    {
        $status=Auth::loginUsingId($user->id);
        if($status)
        {
            alert()->warning('شما با اکانت '.$user->fname.' '.$user->lname.' وارد سایت شدید. ')->persistent('بستن');
            return redirect('/panel');
        }
        else
        {
            alert()->error('خطا در ورود به سایت')->persistent('بستن');
            return back();
        }

    }

}
