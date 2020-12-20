<?php

namespace App\Http\Controllers;

use App\User;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
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
        $users=User::whereNotIn('users.type',[2])
            ->orderby('id','desc')
            ->paginate(20);

        return view('panelAdmin.users')
                    ->with('users',$users);
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
                'codemelli'         =>'required|min:9',
                'sex'               =>'required|boolean',
                'tel'               =>'required|numeric',
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


    public function panel()
    {


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
                        ->join('problemfollowups','problemfollowups.id','=','followups.problemfollowup_id')
                        ->where('followups.user_id','=',$user)
                        ->orderby('followups.id','asc')
                        ->get();
        foreach ($followUps as $item)
        {
            $admin_Followup=User::where('id','=',$item->insert_user_id)
                                ->first();
            $item->insert_user_id=$admin_Followup->fname." ".$admin_Followup->lname;
        }

        //دسته بندی های لیست پیگیری
        $problemFollowup=$this->getproblemfollowup();

        //مقدار یوزر با توجه به دستور زیر مقدار ورودی تابع با مقدار خروجی تقییر میکند
        $user=User::find($user);
        if(strlen($user->personal_image)==0)
        {
            $user->personal_image="default-avatar.png";
        }

        //یوزر توسط چه کسی معرفی شده است
        $resourceIntroduce=User::where('tel','=',$user->introduced)
                        ->first();
        if($resourceIntroduce==null)
        {
            //$resourceIntroduce=['id'=>''];
        }


        //تعداد افراد معرفی کرده
        $countIntroducedUser=User::where('introduced','=',$user->tel)
                        ->count();

        //لیست افراد معرفی کرده
        $listIntroducedUser=User::where('introduced','=',$user->tel)
                        ->get();

        //چک کردن وضعیت عکس کاربرها برای عکسهایی که وجود ندارد از آواتر استفاده شود
        foreach ($listIntroducedUser as $item)
        {
            if(strlen($item->personal_image)==0)
            {
                $item->personal_image="default-avatar.png";
            }
        }


        $introduced=User::where('id','=',$user->introduced)
                            ->first();
        if(strlen($introduced)>0)
        {
            $user->introduced=$introduced->fname." ".$introduced->lname ." با کد ".$introduced->id;
        }

        $states=$this->states();

//        $countFollowups=user::join('followups','users.id','=','followups.user_id')
//              ->count();

//        $followUps=user::join('followups','users.id','=','followups.user_id')
//            ->join('problemfollowups','problemfollowups.id','=','followups.problemfollowup_id')
//            ->get();
        return view('panelAdmin.profile',compact('user','countFollowups','followUps','problemFollowup','userAdmin','listIntroducedUser','countIntroducedUser','resourceIntroduce','states'));
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

        $status=User::where('codemelli','=',$request['codemelli'])
            ->orwhere('email','=',$request['email'])
            ->orwhere('tel','=',$request['tel'])
            ->count();

                $this->validate(request(),
                    [
                        'fname'             => 'nullable|min:3|persian_alpha',
                        'lname'             => 'nullable|min:3|persian_alpha',
                        'codemelli'         => 'min:9|melli_code',
                        'sex'               => 'nullable|boolean',
                        'tel'               => 'required|iran_mobile|',
                        'shenasname'        => 'nullable|numeric',
                        'father'            => 'nullable|min:3|persian_alpha',
                        'born'              => 'nullable|min:3|persian_alpha',
                        'married'           => 'nullable|boolean',
                        'education'         => 'nullable|min:4|persian_alpha',
                        'reshteh'           => 'nullable|min:4|persian_alpha',
                        'state'             => 'nullable|numeric',
                        'city'              => 'nullable|numeric',
                        'address'           => 'nullable|min:4|',
                        'personal_image'    => 'nullable|mimes:jpeg,jpg,pdf|max:600',
                        'shenasnameh_image' => 'nullable|mimes:jpeg,jpg,pdf|max:600',
                        'cartmelli_image'   => 'nullable|mimes:jpeg,jpg,pdf|max:600',
                        'education_image'   => 'nullable|mimes:jpeg,jpg,pdf|max:600',
                        'email'             => 'nullable|email|unique:users',
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
            try
            {
                $user->update($request->all());
            }
            catch(Throwable $e)
            {

               $msg = $e->errorInfo[2];
               $errorStatus = "danger";
               return back()->with('msg',$msg)
                            ->with('errorStatus',$errorStatus);

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
                $user->tel_verified=0;
                $user->save();
                $msg = "پروفایل با موفقیت به روزرسانی شد";
                $errorStatus = "success";

                return back()->with('msg',$msg)
                            ->with('errorStatus',$errorStatus);

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
        return view('panelUser.introducedProfileAjax')
                ->with('user',$user);
    }

    public function showCategoryUsersAdmin(Request $request)
    {
        $dateNow=$this->dateNow;
        switch ($request['categoryUsers'])
        {
            case '0': return redirect('/admin/users/');
                      break;
            case 'notfollowup': $users=User::where('type','=','1')
                            ->orderby('id','desc')
                            ->paginate(20);
                            break;
            case 'continuefollowup': $users=User::where('type','=','11')
                            ->orderby('id','desc')
                            ->paginate(20);
                            break;
            case 'cancelfollowup': $users=User::where('type','=','12')
                            ->orderby('id','desc')
                            ->paginate(20);
                            break;
            case 'students': $users=User::where('type','=','20')
                            ->orderby('id','desc')
                            ->paginate(20);
                            break;
            case 'todayFollowup': $users=User::join('followups','users.id','=','followups.user_id')
                            ->where('followups.nextfollowup_date_fa','=',$dateNow)
                            ->select('users.*')
                            ->groupby('users.id')
                            ->orderby('date_fa','desc')
                            ->paginate(20);
                            break;
            case 'expireFollowup': $users=User::join('followups','users.id','=','followups.user_id')
                            ->where('followups.nextfollowup_date_fa','<',$dateNow)
                            ->wherenotIn('users.type',[2,12])
                            ->select('users.*')
                            ->groupby('users.id')
                            ->orderby('date_fa','desc')
                            ->paginate(20);
                            break;

            default:return redirect('/admin/users/');
                    break;
        }

        $users->appends(['categoryUsers'=>$request['categoryUsers']]);
        return view('panelAdmin.users')
            ->with('users',$users);
    }


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
                                ->where('introduced','=',$user->tel)
                                ->orderby('id','desc')
                                ->paginate(20);
                                break;
                case 'continuefollowup': $listIntroducedUser=User::where('type','=','11')
                                ->where('introduced','=',$user->tel)
                                ->orderby('id','desc')
                                ->paginate(20);
                                break;
                case 'cancelfollowup': $listIntroducedUser=User::where('type','=','12')
                                ->where('introduced','=',$user->tel)
                                ->orderby('id','desc')
                                ->paginate(20);
                                break;
                case 'students': $listIntroducedUser=User::where('type','=','20')
                                ->where('introduced','=',$user->tel)
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
            $listIntroducedUser=User::where('introduced','=',$user->tel)
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
        $countIntroducedUser=User::where('introduced','=',$user->tel)
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
        $users->appends(['q' => $request['q']]);

        return view('panelAdmin.users')
                    ->with('users',$users);
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
                    'introduced'  =>Auth::user()->tel,
                    'date_fa'       =>$this->dateNow,
                    'time_fa'       =>$this->timeNow
                ]);

            if($status)
            {
                $this->sensSms($request['tel'],"به فراکوچ خوش آمدید/ شما توسط ".Auth::user()->tel." به فراکوچ دعوت شدید");
                $msg="تلفن با موفقیت در سیستم فراکوچ ثبت شد";
                $errorStatus="success";
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
    // نمایش سابقه پیگیری هر دعوت شده توسط خود یوزر
    public function showFollowupIntroduced($followup)
    {
        if(User::where('id','=',$followup)->count()==1) {
            $user = User::find($followup);
            $userInsert = Auth::user();
            if ($user->introduced == $userInsert->tel) {
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
}
