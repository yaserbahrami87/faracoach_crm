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
use Illuminate\Queue\RedisQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use SweetAlert;




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
    public function index(Request $request)
    {

        if(Gate::allows('isAdmin')||Gate::allows('isEducation'))
        {
            $notFollowup=count($this->get_notfollowup_withoutPaginate());
            $follow=$this->get_usersByType(11,Auth::user()->id)->count();
            $cancel=$this->get_usersByType(12,Auth::user()->id)->count();
            $waiting=$this->get_usersByType(13,Auth::user()->id)->count();
            $student=$this->get_usersByType(20,Auth::user()->id)->count();
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
            $sumcancelfollowup=0;
            $sumallFollowups=0;
            $sumtodayFollowups=0;
            $sumfollowedTodaybyID=0;
            $sumcontinuefollowup=0;
            $sumwaiting=0;
            $sumstudents=0;
            $sumnoanswering=0;
            $suminsertuser=0;
            $sumtalktimeToday=0;
            $sumtalktime=0;

            if(isset($_GET['range']))
            {
                $this->validate($request,[
                    'start_date'    =>'required|string',
                ]);
                $request['start_date']=explode(' ~ ',$request['start_date']);
            }
            else
            {
                $request['start_date']=[$this->dateNow,$this->dateNow];

            }

            foreach ($usersEducation as $item)
            {
                $condition=['followups.insert_user_id',$item->id];
                $item->cancelfollowup=$this->get_usersByType(NULL,NULL,NULL,$request['start_date'],$condition,12)->count();
                $sumcancelfollowup=$sumcancelfollowup+$item->cancelfollowup;
                $condition=['followups.insert_user_id',$item->id];
                $item->allFollowups=$this->get_usersByType(NULL,NULL,NULL,$request['start_date'],$condition)->count();
                $sumallFollowups=$sumallFollowups+$item->allFollowups;
                $item->todayFollowups=count($this->get_todayFollowupbyID_withoutPaginate($item->id));
                $sumtodayFollowups=$sumtodayFollowups+$item->todayFollowups;
                $condition=['followups.date_fa',$this->dateNow];
                $item->followedTodaybyID=$this->get_usersByType(NULL,$item->id,NULL,NULL, $condition)->count();
                $sumfollowedTodaybyID=$sumfollowedTodaybyID+$item->followedTodaybyID;
                $condition=['followups.insert_user_id',$item->id];
                $item->continuefollowup=$this->get_usersByType(NULL,NULL,NULL,$request['start_date'],$condition,11)->count();
                $sumcontinuefollowup=$sumcontinuefollowup+$item->continuefollowup;
                $item->waiting=$this->get_usersByType(NULL,NULL,NULL,$request['start_date'],$condition,13)->count();
                $sumwaiting=$sumwaiting+$item->waiting;
                $condition=['followups.insert_user_id',$item->id];
                $item->students=$this->get_usersByType(NULL,NULL,NULL,$request['start_date'],$condition,20)->count();

                $sumstudents=$sumstudents+$item->students;
                $item->noanswering=$this->get_usersByType(NULL,NULL,NULL,$request['start_date'],$condition,14)->count();
                $sumnoanswering=$sumnoanswering+$item->noanswering;
                if(!is_null($item->last_login_at))
                {
                    $item->last_login_at = $this->changeTimestampToShamsi($item->last_login_at);
                }
                //تبدیل تاریخ شمسی  به میلادی برای نمایش کاربرهای براساس فیلد created_at
                if(isset($request['start_date']))
                {
                    $date_en=[$this->changeTimestampToMilad($request['start_date'][0]),$this->changeTimestampToMilad($request['start_date'][1])];
                }
                else
                {
                    $date_en=NULL;
                }

                $item->insertuser=$this->get_user(NULL,NULL,NULL,NULL,NULL,$date_en,$item->id)->count();

                $suminsertuser=$suminsertuser+$item->insertuser;
                $item->talktimeToday=$this->get_talktimeTodayByID($item->id);
                $sumtalktimeToday=$sumtalktimeToday+$item->talktimeToday;
                $item->talktime=$this->get_talktimeByID($item->id,$request['start_date']);

                //$item->talktime=$this->get_usersByType(NULL,$item->id,NULL,$request['start_date']);
                //dd($this->get_usersByType(NULL,315,NULL,$request['start_date'])->sum('followups.talktime'));
                $sumtalktime=$sumtalktime+$item->talktime;
            }


            $countUnreadMessages=$this->countUnreadMessages();
            return view('panelAdmin.home')
                        ->with('notFollowup',$notFollowup)
                        ->with('follow',$follow)
                        ->with('cancel',$cancel)
                        ->with('waiting',$waiting)
                        ->with('sumstudents',$sumstudents)
                        ->with('student',$student)
                        ->with('dateNow',$dateNow)
                        ->with('followupToday',$followupToday)
                        ->with('expirefollowupToday',$expirefollowupToday)
                        ->with('countUnreadMessages',$countUnreadMessages)
                        ->with('usersEducation',$usersEducation)
                        ->with('sumcancelfollowup',$sumcancelfollowup)
                        ->with('sumallFollowups',$sumallFollowups)
                        ->with('sumtodayFollowups',$sumtodayFollowups)
                        ->with('sumfollowedTodaybyID',$sumfollowedTodaybyID)
                        ->with('sumcontinuefollowup',$sumcontinuefollowup)
                        ->with('sumwaiting',$sumwaiting)
                        ->with('sumnoanswering',$sumnoanswering)
                        ->with('suminsertuser',$suminsertuser)
                        ->with('sumtalktimeToday',$sumtalktimeToday)
                        ->with('sumtalktime',$sumtalktime);
            //return redirect()->route('panelAdmin');
        }
        else if(Gate::allows('isUser'))
        {

            $user=(Auth::user());

            if(($user->status_coach==-2)||($user->status_coach==1))
            {
                $user=User::join('coaches','users.id','=','coaches.user_id')
                            ->where('users.id','=',$user->id)
                            ->select('users.*','coaches.id as id_coaches_table')
                            ->first();
            }

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



            $verifyScore=$user->email_verified_at;

            if(!is_null($verifyScore))
            {
                $scoreEmailverify=$this->get_scores()->email_verified;
                $score=$score+$scoreEmailverify;
            }
            else
            {
                $scoreEmailverify=0;
            }


            $SuccessIntroduced=User::where('introduced','=',$user->id)
                    ->where('type','=',20)
                    ->count();



            $scoreSuccess=$SuccessIntroduced*($this->get_scores()->changeintroduced);
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
                ->with('verifyStatus',$verifyStatus)
                ->with('scoreIntroducedUser',$scoreIntroducedUser)
                ->with('SuccessIntroduced',$SuccessIntroduced)
                ->with('scoreTelverify',$scoreTelverify)
                ->with('scoreEmailverify',$scoreEmailverify);

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
            alert()->error('کاربری با چنین مشخصاتی وجود ندارد', 'خطا')->persistent('close');
//            $msg="کاربری با چنین مشخصاتی وجود ندارد";
//            $errorStatus="danger";
            return redirect("/admin/users");
//                    ->with('msg',$msg)
//                    ->with('errorStatus',$errorStatus);
        }
        else
        {
            return view('panelAdmin.changePassword')
                    ->with('tel',$tel);
        }
    }

    public function changePasswordViewUser()
    {
        $user=Auth::user();
        return view('panelUser.changePassword')
                ->with('user',$user);

    }



}
