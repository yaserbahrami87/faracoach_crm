<?php

namespace App\Http\Controllers;

use App\categoryTag;
use App\followup;
use App\message;
use App\problemfollowup;
use App\tag;
use App\User;
use App\verify;
use Carbon\Carbon;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;


class AdminController extends BaseController
{

    public function __construct()
    {
        $dateNow = verta();
        $this->dateNow = $dateNow->format('Y/m/d');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Gate::allows('isAdmin')||Gate::allows('isEducation'))
        {
            $notFollowup=count($this->get_notfollowup_withoutPaginate());
            $follow=User::where('type','=','11')
                ->count();
            $cancel=User::where('type','=','12')
                ->count();
            $waiting=User::where('type','=','13')
                ->count();
            $student=User::where('type','=','20')
                ->count();
            $dateNow=$this->dateNow;

            $followupToday=User::join('followups','users.id','=','followups.user_id')
                ->where('nextfollowup_date_fa','=',$dateNow)
                ->wherenotIn('users.type',[2,12])
                ->groupby('users.id')
                ->count();
            $expirefollowupToday=User::join('followups','users.id','=','followups.user_id')
                ->where('nextfollowup_date_fa','<',$dateNow)
                ->wherenotIn('users.type',[2,12])
                ->groupby('users.id')
                ->count();

            $usersEducation=user::where('type','=',3)
                        ->get();
            foreach ($usersEducation as $item)
            {
                $item->cancelfollowup=count($this->get_cancelfollowupbyID_withoutPaginate($item->id));
                $item->allFollowups=count($this->get_myfollowupbyID_withoutPaginate($item->id));
                $item->todayFollowups=count($this->get_todayFollowupbyID_withoutPaginate($item->id));
                $item->followedTodaybyID=count($this->get_followedTodaybyID_withoutPaginate($item->id));
                $item->continuefollowup=count($this->get_continuefollowupbyID_withoutPaginate($item->id));
                $item->waiting=count($this->get_waitingbyID_withoutPaginate($item->id));
                $item->students=count($this->get_studentsbyID_withoutPaginate($item->id));
                $item->noanswering=count($this->get_noansweringbyID_withoutPaginate($item->id));
                if(!is_null($item->last_login_at))
                {
                    $item->last_login_at = $this->changeTimestampToShamsi($item->last_login_at);
                }
                $item->insertuser=count($this->get_insertuserbyID($item->id));
                $item->talktimeToday=$this->get_talktimeTodayByID($item->id);
                $item->talktime=$this->get_talktimeByID($item->id);
            }



            $countUnreadMessages=$this->countUnreadMessages();
            return view('panelAdmin.home')
                        ->with('notFollowup',$notFollowup)
                        ->with('follow',$follow)
                        ->with('cancel',$cancel)
                        ->with('waiting',$waiting)
                        ->with('student',$student)
                        ->with('dateNow',$dateNow)
                        ->with('followupToday',$followupToday)
                        ->with('expirefollowupToday',$expirefollowupToday)
                        ->with('countUnreadMessages',$countUnreadMessages)
                        ->with('usersEducation',$usersEducation);
            //return redirect()->route('panelAdmin');
        }
        else if(Gate::allows('isUser'))
        {
            $user=(Auth::user());

                if(strlen($user->personal_image)==0)
                {
                    $user->personal_image="default-avatar.png";
                }

                //تعداد افراد دعوت شده
                $countIntroducedUser=User::where('introduced','=',$user->id)
                    ->count();

                //یوزر توسط چه کسی معرفی شده است
                $resourceIntroduce=User::where('id','=',$user->introduced)
                    ->first();
                //تعداد پیام های خوانده نشده
                $unreadMessage=message::where('user_id_recieve','=',$user->id)
                        ->where('status','=',1)
                        ->count();
                //کسب امتیازات
                $score=$countIntroducedUser*5;
                $verifyScore=$user->tel_verified;
                if($verifyScore==1)
                {
                    $score=$score+5;
                }
                $scoreSuccess=User::where('introduced','=',$user->id)
                        ->where('type','=',20)
                        ->count();
                $scoreSuccess=$scoreSuccess*10;
                $score=$score+$scoreSuccess;

                $checkTimeCode=verify::where('tel','=',$user['tel'])
                                ->where('verify','=',0)
                                ->latest()
                                ->first();
                $verifyStatus=false;
                if(!is_null( $checkTimeCode))
                {
                    $date=($checkTimeCode['created_at']);
                    $checkDays=$date->addMinutes(10);
                    if($checkDays>Carbon::now())
                    {
                        $verifyStatus=true;
                    }
                }

                return view('panelUser.home')
                    ->with('user',$user)
                    ->with('countIntroducedUser',$countIntroducedUser)
                    ->with('resourceIntroduce',$resourceIntroduce)
                    ->with('unreadMessage',$unreadMessage)
                    ->with('score',$score)
                    ->with('verifyScore',$verifyScore)
                    ->with('scoreSuccess',$scoreSuccess)
                    ->with('verifyStatus',$verifyStatus);

        }
        else
        {
            return redirect('/login');
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
        //
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


    //نمایش صفحه تنظیمات ادمین
    public function showSettings()
    {
        $problemfollowup=problemfollowup::get();
        foreach ($problemfollowup as $item)
        {
            if($item->status==1)
            {
                $item->status="نمایش";
            }
            elseif ($item->status==0)
            {
                $item->status="عدم نمایش";
            }
        }

        $parentCategory=$this->get_parentCategory();
        foreach ($parentCategory as $item)
        {
            if($item->status==1)
            {
                $item->status="نمایش";
            }
            elseif ($item->status==0)
            {
                $item->status="عدم نمایش";
            }
        }

        $categoryTags=categoryTag::get();
        foreach ($categoryTags as $item)
        {
            if($item->status==1)
            {
                $item->status="نمایش";
            }
            elseif ($item->status==0)
            {
                $item->status="عدم نمایش";
            }
        }


        $options=$this->get_options();

        foreach ($options as $item)
        {
            $options[$item->option_name]=$item->option_value;

        }

        return view('panelAdmin.settings')
                    ->with('problemfollowup',$problemfollowup)
                    ->with('parentCategory',$parentCategory)
                    ->with('categoryTags',$categoryTags)
                    ->with('options',$options);
    }

    public function showProducts()
    {
        $contents_api=$this->get_data_api();
        return view('panelUser.products')
                    ->with('contents_api',$contents_api);
    }

    public function showFreePackages()
    {
        return  redirect()
            ->route('freePackageLanding')
            ->with('status',true);
    }

    public function loginSMS()
    {
        if (Auth::check())
        {
            return back();
        }
        else
        {
            return view('loginSMS');
        }
    }

    public function changePasswordView($tel)
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
            return view('panelAdmin.changePassword')
                    ->with('tel',$tel);
        }
    }

}
