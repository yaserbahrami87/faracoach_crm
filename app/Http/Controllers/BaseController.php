<?php

namespace App\Http\Controllers;

use App\category_coach;
use App\category_post;
use App\categoryTag;
use App\city;
use App\comment;
use App\course;
use App\coursetype;
use App\followbyCategory;
use App\followup;
use App\message;
use App\option;
use App\post;
use App\problemfollowup;
use App\settingscore;
use App\settingsms;
use App\sms;
use App\state;
use App\tag;
use App\teacher;
use App\User;
use Kavenegar;
use GuzzleHttp\Client;
use Hekmatinasser\Verta\Verta;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class BaseController extends Controller
{
    public function __construct() {
        $dateNow = verta();
        $this->dateNow = $dateNow->format('Y/m/d');
        $this->timeNow = $dateNow->format('H:i:s');
    }

    public function signupForm()
    {
        if(Gate::allows('isUser')||Gate::allows('isAdmin'))
        {
            return redirect('/panel');
        }
        else
        {
            return view('signup');
        }
    }


    public function sendSms($tel,$msg)
    {
        try {
            $sender = "10004002002020";
            $message = $msg;
            $receptor = array($tel);
            $result = Kavenegar::Send($sender, $tel, $message);

            if ($result) {
                foreach ($result as $r) {
                    $messageid = $r->messageid;
                    $message = $r->message;
                    $status = $r->status;
                    $statustext = $r->statustext;
                    $sender = $r->sender;
                    $receptor = $r->receptor;
                    $date = $r->date;
                    $cost = $r->cost;
                }

                sms::create([
                    //'insert_user_id' => Auth::user()->id,
                    'recieve_user' => $tel,
                    'comment' => $message,
                    'date_fa' => $this->dateNow,
                    'time_fa' => $this->timeNow,
                    'type' => $status,
                    'code' => $messageid,
                ]);
                $msg=[];
                return $msg;
            }

        } catch (\Kavenegar\Exceptions\ApiException $e) {
            // در صورتی که خروجی وب سرویس 200 نباشد این خطا رخ می دهد
            $msg=[];
            $msg['msg'] = $e->errorMessage();
            $msg['status']=false;
            sms::create([
                'insert_user_id' => Auth::user()->id,
                'recieve_user' => $tel,
                'comment' => $message,
                'date_fa' => $this->dateNow,
                'time_fa' => $this->timeNow,
                'type' => $msg['status'],
                'code' =>  $msg['msg'],
            ]);
            return $msg;

        } catch (\Kavenegar\Exceptions\HttpException $e) {
            // در زمانی که مشکلی در برقرای ارتباط با وب سرویس وجود داشته باشد این خطا رخ می دهد
            $msg=[];
            $msg['msg'] = $e->errorMessage();
            $msg['status'] =false;
            sms::create([
                'insert_user_id' => Auth::user()->id,
                'recieve_user' => $tel,
                'comment' => $message,
                'date_fa' => $this->dateNow,
                'time_fa' => $this->timeNow,
                'type' => $msg['status'],
                'code' =>  $msg['msg'],
            ]);
            return $msg;
        }
    }


    //نمایش استان ها از بانک اطلاعاتی
    public function states()
    {
        $states=state::orderby('name','asc')
                ->get();
        return $states;
    }

    public function city($code)
    {
        return city::where('id','=',$code)
                    ->select('cities.name')
                    ->first();
    }


    // انتخاب شهر بر اساس ورودی کد استان مورد نظر به صورت ایجکس برای فرم ها
    public function citiesAjax($state)
    {
        $user=Auth::user();
        $cities=city::where('state_id','=',$state)
                    ->groupby('name')
                    ->orderby('name','asc')
                    ->get();
        foreach($cities as $item)
        {
            echo "<option value='$item->id' @if($item->id==$user->city) selected @endif>".$item->name."</option>";
        }
    }
    public function get_userTypes()
    {
        $types=['1' =>'پیگیری نشده',
                '2' =>'مدیر',
                '3' =>'آموزش',
                '11'=>"تور پیگیری",
                '12'=>"انصراف",
                '13'=>"در انتظار تصمیم",
                '14'=>"عدم پاسخگویی",
                '20'=>"مشتری"
        ];
        return $types;
    }
    public function userType($status)
    {

        switch($status)
        {
            case "1": return "پیگیری نشده";
                        break;
            case "2":return "مدیر";
                        break;
            case "3":return "آموزش";
                        break;
            case "11": return "تور پیگیری";
                        break;
            case "12":return "انصراف";
                        break;
            case "13":return "در انتظار تصمیم";
                        break;
            case "14":return "عدم پاسخگویی";
                        break;
            case "20":return "مشتری";
                        break;
            default:return "";
        }
    }

    //کاربر براساس شماره تلفن برمیگرداند
    public function get_user($tel)
    {
        $user=User::where('tel','=',$tel)->first();
        return  $user;
    }

    public function get_user_byID($id)
    {
        return user::where('id','=',$id)
                 ->first();
    }

    public function get_user_byUserName($user)
    {
        return user::where('username','=',$user)
                    ->first();
    }

    public function get_data_api()
    {
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'https://faracoach.com/',
            // You can set any number of default request options.
            'timeout'  => 60.0,
        ]);

        $response = $client->request('GET', 'wp-json/wc/store/products/');
        $contents_api=(json_decode($response->getBody()->getContents()));
        foreach ($contents_api as $item)
        {
            $item->name=str_replace('&#8221;','"',$item->name);
            $item->name=str_replace('&#8220;','"',$item->name);
            $item->name=str_replace('&#8211;','-',$item->name);

        }
//        dd($contents_api);
        return $contents_api;
    }

    public function getFollowbyCategory()
    {
        return followbyCategory::where('status','=',1)
                        ->get();
    }

    public function getProblemFollowup_byID($id)
    {
        return problemfollowup::where('id','=',$id)->first();
    }

    public function getproblemfollowup()
    {
        return problemfollowup::orderby('problem')
                ->where('status','=','1')
                ->get();
    }

    // تگ های فعال را برمی گرداند
    public function get_tags()
    {
        return tag::where('status','=',1)
                ->get();
    }


    //تگ ها را براساس آیدی برمی گرداند
    public function get_tag_byID($id)
    {
        return tag::where('id','=',$id)
                ->first();
    }

    //تبدیل تاریخ میلادی به شمسی
    public function changeTimestampToShamsi($date)
    {
        $dateMiladi=new verta($date);
        return ($dateMiladi->hour.":".$dateMiladi->minute."  ".$dateMiladi->year."/".$dateMiladi->month."/".$dateMiladi->day);
    }

    //دسته بندی تگ ها را برمیگرداند
    public function categoryTags()
    {
        return categoryTag::where('status','=',1)
                            ->get();
    }

    public function get_parentCategory()
    {
        return categoryTag::where('status','=',1)
                            ->where('parent_id','=',0)
                            ->get();
    }

    public function get_category($request)
    {
        $categoryTag=categoryTag::where('category','=',$request)
                                ->first();
        return categoryTag::where('parent_id','=',$categoryTag->id)->get();
    }

    public function countUnreadMessages()
    {
        return message::where('status','=',1)
            ->where('user_id_recieve', '=', Auth::user()->id)
            ->count();
    }

    public function get_countFollowup($id)
    {
        return followup::where('user_id','=',$id)->count();
    }

    //آخرین پیگیری کاربر را براساس آیدی آن بر میگرداند
    public function get_lastFollowupUser($id)
    {

        return followup::join('problemfollowups','followups.problemfollowup_id','=','problemfollowups.id')
                    ->where('user_id','=',$id)
                    ->orderby('followups.id','desc')
                    ->first();
    }


    public function get_notfollowup($order="users.id",$parameter="asc")
    {
        return User:: leftjoin('followups', 'users.id', '=', 'followups.user_id')
            ->where(function ($query)
            {
                $query  ->where('users.type', '=', '1')
                    ->orwhere('followby_expert','=',NULL);

            })
            ->groupby('users.id')
            ->select('users.*')
            ->orderby($order, $parameter)
            ->groupby('users.id')
            ->paginate($this->countPage());
    }

    public function get_notfollowup_withoutPaginate()
    {
        return User:: leftjoin('followups', 'users.id', '=', 'followups.user_id')
            ->where(function ($query)
            {
                $query  ->where('users.type', '=', '1')
                    ->orwhere('followby_expert','=',NULL);

            })
            ->groupby('users.id')
            ->select('users.*')
            ->orderby('users.id', 'desc')
            ->get();
    }


    public function get_continuefollowup($type=NULL,$id=NULL,$paginate=NULL)
    {
        $users= User::join('followups','users.id','=','followups.user_id')

            ->when($id, function ($query) {
                return $query->where('followby_expert', '=', Auth::user()->id);
            })
            ->when($type,function($query,$type){
                return $query->where('users.type','=',$type);
            })
            ->orderby('followups.id', 'desc')
            ->groupby('followups.user_id')
            ->select('users.*')
            ->when($paginate,function($query){
                    return $query->paginate($this->countPage());
            },function($query){
                    return $query->get();
            });
        return $users;

    }

    public function get_continuefollowup_withoutPaginate()
    {
        $users =DB::table('users')
            ->join('followups','users.id','=','followups.user_id')
            ->where('followby_expert', '=', Auth::user()->id)
            ->where('users.type','=',11)
            ->orderby('followups.id', 'desc')
            ->distinct('followups.user_id')
            ->get();
        return $users;

    }

    public function get_continuefollowupbyID($id)
    {
        return User::join('followups','users.id','=','followups.user_id')
            ->where('followby_expert', '=', $id)
            ->where('status_followups','=',11)
            ->select('users.*')
            ->groupby('users.id')
            ->orderby('users.id', 'desc')
            ->paginate($this->countPage());
    }

    public function get_continuefollowupbyID_withoutPaginate($id=NULL)
    {

        return User::join('followups','users.id','=','followups.user_id')
            ->where('users.type','=',11)

            ->when($id, function ($query, $id) {
                return $query->where('followby_expert', $id);
            })
            ->select('users.*')
            ->groupby('users.id')
            ->orderby('users.id', 'desc')
            ->get();
    }

    public function getAll_continuefollowup()
    {
        return User::join('followups','users.id','=','followups.user_id')
            ->where('status_followups', '=', '11')
            ->select('users.*')
            ->groupby('users.id')
            ->orderby('users.id', 'desc')
            ->paginate($this->countPage());
    }

    public function getAll_continuefollowup_withoutPaginate()
    {
        return User::join('followups','users.id','=','followups.user_id')
            ->where('status_followups', '=', '11')
            ->select('users.*')
            ->groupby('users.id')
            ->orderby('users.id', 'desc')
            ->get();
    }

    public function get_cancelfollowup()
    {
         return User::join('followups','users.id','=','followups.user_id')
            ->where('followby_expert', '=', Auth::user()->id)
//            ->where('status_followups','=',12)
            ->where('users.type','=',12)
            ->select('users.*')
            ->groupby('users.id')
            ->orderby('users.id', 'desc')
            ->paginate($this->countPage());
    }

    public function get_cancelfollowup_withoutPaginate()
    {
        return User::join('followups','users.id','=','followups.user_id')
            ->where('status_followups', '=', '12')
            ->where('followby_expert', '=', Auth::user()->id)
            ->where('status_followups','=',12)
            ->groupby('users.id')
            ->select('users.*')
            ->orderby('users.id', 'desc')
            ->get();
    }

    public function get_cancelfollowupbyID($id)
    {
        return User::join('followups','users.id','=','followups.user_id')
            ->where('followby_expert', '=', $id)
            ->where('status_followups','=',12)
            ->select('users.*')
            ->groupby('users.id')
            ->orderby('users.id', 'desc')
            ->paginate($this->countPage());
    }

    public function get_cancelfollowupbyID_withoutPaginate($id)
    {
        return User::join('followups','users.id','=','followups.user_id')
            ->where('followby_expert', '=', $id)
            ->where('status_followups','=',12)
            ->select('users.*')
            ->groupby('users.id')
            ->orderby('users.id', 'desc')
            ->get();
    }

    public function getAll_cancelfollowup()
    {
        return User::join('followups','users.id','=','followups.user_id')
            ->where('status_followups','=',12)
            ->select('users.*')
            ->groupby('users.id')
            ->orderby('users.id', 'desc')
            ->paginate($this->countPage());
    }

    public function getAll_cancelfollowup_withoutPaginate()
    {
        return User::join('followups','users.id','=','followups.user_id')
            ->where('status_followups','=',12)
            ->select('users.*')
            ->groupby('users.id')
            ->orderby('users.id', 'desc')
            ->get();
    }

    public function get_waiting()
    {
        return User::join('followups','users.id','=','followups.user_id')
            ->where('followby_expert', '=', Auth::user()->id)
//            ->where('status_followups','=',13)
            ->where('users.type','=',13)
            ->select('users.*')
            ->groupby('users.id')
            ->orderby('users.id', 'desc')
            ->paginate($this->countPage());
    }

    public function get_waiting_withoutPaginate()
    {
        return User::join('followups','users.id','=','followups.user_id')
            ->where('followby_expert', '=', Auth::user()->id)
            ->where('status_followups','=',13)
            ->groupby('users.id')
            ->select('users.*')
            ->orderby('users.id', 'desc')
            ->get();
    }

    public function get_waitingbyID($id)
    {
        return User::join('followups','users.id','=','followups.user_id')
            ->where('status_followups', '=', '13')
            ->where('followby_expert', '=', $id)
            ->select('users.*')
            ->groupby('users.id')
            ->orderby('users.id', 'desc')
            ->paginate($this->countPage());
    }

    public function get_waitingbyID_withoutPaginate($id)
    {
        return User::join('followups','users.id','=','followups.user_id')
            ->where('status_followups', '=', '13')
            ->where('followby_expert', '=', $id)
            ->select('users.*')
            ->groupby('users.id')
            ->orderby('users.id', 'desc')
            ->get();
    }

    public function getAll_waiting()
    {
        return User::join('followups','users.id','=','followups.user_id')
            ->where('status_followups','=',13)
            ->select('users.*')
            ->groupby('users.id')
            ->orderby('users.id', 'desc')
            ->paginate($this->countPage());
    }

    public function getAll_waiting_withoutPaginate()
    {
        return User::join('followups','users.id','=','followups.user_id')
            ->where('status_followups','=',13)
            ->select('users.*')
            ->groupby('users.id')
            ->orderby('users.id', 'desc')
            ->get();
    }

    public function get_noanswering()
    {
         return User::join('followups','users.id','=','followups.user_id')
            ->where('followby_expert', '=', Auth::user()->id)
            ->where('status_followups','=',14)
            ->select('users.*')
            ->groupby('users.id')
            ->orderby('users.id', 'desc')
            ->paginate($this->countPage());
    }

    public function get_noanswering_withoutPaginate()
    {
        return User::join('followups','users.id','=','followups.user_id')
            ->where('followby_expert', '=', Auth::user()->id)
            ->where('status_followups','=',14)
            ->groupby('users.id')
            ->select('users.*')
            ->orderby('users.id', 'desc')
            ->get();
    }

    public function get_noansweringbyID($id)
    {
        return User::join('followups','users.id','=','followups.user_id')
            ->where('status_followups', '=', '14')
            ->where('followby_expert', '=', $id)
            ->select('users.*')
            ->groupby('users.id')
            ->orderby('users.id', 'desc')
            ->paginate($this->countPage());
    }

    public function get_noansweringbyID_withoutPaginate($id)
    {
        return User::join('followups','users.id','=','followups.user_id')
            ->where('users.type', '=', '14')
            ->where('followby_expert', '=', $id)
            ->select('users.*')
            ->groupby('users.id')
            ->orderby('users.id', 'desc')
            ->get();
    }

    public function getAll_noanswering()
    {
        return User::join('followups','users.id','=','followups.user_id')
            ->where('status_followups','=',14)
            ->select('users.*')
            ->groupby('users.id')
            ->orderby('users.id', 'desc')
            ->paginate($this->countPage());
    }

    public function getAll_noanswering_withoutPaginate()
    {
        return User::join('followups','users.id','=','followups.user_id')
            ->where('status_followups','=',14)
            ->select('users.*')
            ->groupby('users.id')
            ->orderby('users.id', 'desc')
            ->get();
    }

    public function get_students()
    {
        return User::join('followups','users.id','=','followups.user_id')
            ->where('followby_expert', '=', Auth::user()->id)
            //->where('status_followups','=',20)
            ->where('users.type','=',20)
            ->orderby('users.id', 'desc')
            ->groupby('users.id')
            ->select('users.*')
            ->paginate($this->countPage());
    }

    public function get_students_withoutPaginate()
    {
        return User::join('followups','users.id','=','followups.user_id')
            ->where('followby_expert', '=', Auth::user()->id)
            ->where('status_followups','=',20)
            ->groupby('users.id')
            ->select('users.*')
            ->orderby('users.id', 'desc')
            ->get();
    }

    public function get_studentsbyID($id)
    {
        return User::join('followups','users.id','=','followups.user_id')
            ->where('status_followups', '=', '20')
            ->where('followby_expert', '=', $id)
            ->select('users.*')
            ->groupby('users.id')
            ->orderby('users.id', 'desc')
            ->paginate($this->countPage());
    }

    public function get_studentsbyID_withoutPaginate($id)
    {
        return User::join('followups','users.id','=','followups.user_id')
            ->where('status_followups', '=', '20')
            ->where('followby_expert', '=', $id)
            ->select('users.*')
            ->groupby('users.id')
            ->orderby('users.id', 'desc')
            ->get();
    }

    public function getAll_students()
    {
        return User::join('followups','users.id','=','followups.user_id')
            ->where('status_followups','=',20)
            ->select('users.*')
            ->groupby('users.id')
            ->orderby('users.id', 'desc')
            ->paginate($this->countPage());
    }

    public function getAll_students_withoutPaginate()
    {
        return User::join('followups','users.id','=','followups.user_id')
            ->where('status_followups','=',20)
            ->select('users.*')
            ->groupby('users.id')
            ->orderby('users.id', 'desc')
            ->get();
    }

    public function get_todayFollowup()
    {
        return User::join('followups', 'users.id', '=', 'followups.user_id')
            ->where('followups.nextfollowup_date_fa', '=', $this->dateNow)
            ->where('followby_expert', '=', Auth::user()->id)
            ->select('users.*')
            ->groupby('users.id')
            ->orderby('users.id', 'desc')
            ->paginate($this->countPage());
    }

    public function get_todayFollowup_withoutPaginate()
    {
        return User::join('followups', 'users.id', '=', 'followups.user_id')
            ->where('followups.nextfollowup_date_fa', '=', $this->dateNow)
            ->where('followby_expert', '=', Auth::user()->id)
            ->groupby('users.id')
            ->select('users.*')
            ->orderby('users.id', 'desc')
            ->get();
    }


    public function get_todayFollowupbyID($id)
    {
        return User::join('followups', 'users.id', '=', 'followups.user_id')
            ->where('followups.nextfollowup_date_fa', '=', $this->dateNow)
            ->where('followby_expert', '=', $id)
            ->select('users.*')
            ->groupby('users.id')
            ->orderby('users.id', 'desc')
            ->paginate($this->countPage());
    }

    public function get_todayFollowupbyID_withoutPaginate($id)
    {
        return User::join('followups', 'users.id', '=', 'followups.user_id')
            ->where('followups.nextfollowup_date_fa', '=', $this->dateNow)
            ->where('followby_expert', '=', $id)
            ->select('users.*')
            ->groupby('users.id')
            ->orderby('users.id', 'desc')
            ->paginate($this->countPage());
    }

    public function getAll_todayFollowup()
    {
        return User::join('followups', 'users.id', '=', 'followups.user_id')
            ->where('followups.nextfollowup_date_fa', '=', $this->dateNow)
            ->select('users.*')
            ->groupby('users.id')
            ->orderby('users.id', 'desc')
            ->paginate($this->countPage());
    }

    public function getAll_todayFollowup_withoutPaginate()
    {
        return User::join('followups', 'users.id', '=', 'followups.user_id')
            ->where('followups.nextfollowup_date_fa', '=', $this->dateNow)
            ->select('users.*')
            ->groupby('users.id')
            ->orderby('users.id', 'desc')
            ->get();
    }

    public function get_expireFollowup()
    {
        return User::join('followups', 'users.id', '=', 'followups.user_id')
            ->where('followups.nextfollowup_date_fa', '<', $this->dateNow)
            ->where('followby_expert', '=', Auth::user()->id)
            ->wherenotIn('users.type', [2, 12])
            ->select('users.*')
            ->groupby('users.id')
            ->orderby('users.id', 'desc')
            ->paginate($this->countPage());
    }

    public function get_expireFollowup_withoutPaginate()
    {
        return User::join('followups', 'users.id', '=', 'followups.user_id')
            ->where('followups.nextfollowup_date_fa', '<', $this->dateNow)
            ->where('followby_expert', '=', Auth::user()->id)
            ->wherenotIn('users.type', [2, 12])
            ->groupby('users.id')
            ->select('users.*')
            ->orderby('users.id', 'desc')
            ->get();
    }

    public function get_expireFollowupbyID($id)
    {
        return User::join('followups', 'users.id', '=', 'followups.user_id')
            ->where('followups.nextfollowup_date_fa', '<', $this->dateNow)
            ->where('followby_expert', '=', $id)
            ->wherenotIn('users.type', [2, 12])
            ->groupby('users.id')
            ->select('users.*')
            ->orderby('users.id', 'desc')
            ->paginate($this->countPage());
    }

    public function getAll_expireFollowup()
    {
        return User::join('followups', 'users.id', '=', 'followups.user_id')
            ->where('followups.nextfollowup_date_fa', '<', $this->dateNow)
            ->wherenotIn('users.type', [2, 12])
            ->groupby('users.id')
            ->select('users.*')
            ->orderby('users.id', 'desc')
            ->paginate($this->countPage());
    }

    public function getAll_expireFollowup_withoutPaginate()
    {
        return User::join('followups', 'users.id', '=', 'followups.user_id')
            ->where('followups.nextfollowup_date_fa', '<', $this->dateNow)
            ->wherenotIn('users.type', [2, 12])
            ->groupby('users.id')
            ->select('users.*')
            ->orderby('users.id', 'desc')
            ->get();
    }

    public function get_myfollowup()
    {
        return User::join('followups', 'users.id', '=', 'followups.user_id')
            ->where('followups.insert_user_id', '=', Auth::user()->id)
            ->select('users.*')
            ->groupby('users.id')
            ->orderby('users.id', 'desc')
            ->paginate($this->countPage());
    }

    public function get_myfollowup_withoutPaginate()
    {
        return User::join('followups', 'users.id', '=', 'followups.user_id')
            ->where('followups.insert_user_id', '=', Auth::user()->id)
            ->select('users.*')
            ->groupby('users.id')
            ->orderby('users.id', 'desc')
            ->get();
    }

    public function get_myfollowupbyID($id)
    {
        return User::join('followups', 'users.id', '=', 'followups.user_id')
            ->where('followups.insert_user_id', '=',$id)
            ->select('users.*')
            ->groupby('users.id')
            ->orderby('users.id', 'desc')
            ->paginate($this->countPage());
    }

    public function get_myfollowupbyID_withoutPaginate($id)
    {
        return User::join('followups', 'users.id', '=', 'followups.user_id')
            ->where('followups.insert_user_id', '=',$id)
            ->select('users.*')
            ->groupby('users.id')
            ->orderby('users.id', 'desc')
            ->get();
    }

    public function getAll_myfollowup()
    {
        return User::join('followups', 'users.id', '=', 'followups.user_id')
            ->where('followups.user_id','=',Auth::user()->id)
            ->select('users.*')
            ->groupby('users.id')
            ->orderby('users.id', 'desc')
            ->paginate($this->countPage());
    }

    public function getAll_myfollowup_withoutPaginate()
    {
        return User::join('followups', 'users.id', '=', 'followups.user_id')
            ->where('followups.insert_user_id', '=', Auth::user()->id)
            ->select('users.*')
            ->groupby('users.id')
            ->orderby('users.id', 'desc')
            ->get();
    }

    public function get_followedToday()
    {
        return User::join('followups', 'users.id', '=', 'followups.user_id')
            ->where('followups.insert_user_id', '=', Auth::user()->id)
            ->where('date_fa', '=', $this->dateNow)
            ->select('users.*')
            ->orderby('users.id', 'desc')
            ->groupby('users.id')
            ->paginate($this->countPage());
    }

    public function get_followedToday_withoutPaginate()
    {
        return User::join('followups', 'users.id', '=', 'followups.user_id')
            ->where('followups.insert_user_id', '=', Auth::user()->id)
            ->where('date_fa', '=', $this->dateNow)
            ->groupby('users.id')
            ->select('users.*')
            ->orderby('users.id', 'desc')
            ->get();
    }

    public function get_followedTodaybyID($id)
    {
        return User::join('followups', 'users.id', '=', 'followups.user_id')
            ->where('followups.insert_user_id', '=', $id)
            ->where('date_fa', '=', $this->dateNow)
            ->select('users.*')
            ->orderby('users.id', 'desc')
            ->groupby('users.id')
            ->paginate($this->countPage());
    }

    public function get_followedTodaybyID_withoutPaginate($id)
    {
        return User::join('followups', 'users.id', '=', 'followups.user_id')
            ->where('followups.insert_user_id', '=', $id)
            ->where('date_fa', '=', $this->dateNow)
            ->select('users.*')
            ->orderby('users.id', 'desc')
            ->groupby('users.id')
            ->get();
    }



    public function getAll_followedToday()
    {
        return User::join('followups', 'users.id', '=', 'followups.user_id')
            ->where('date_fa', '=', $this->dateNow)
            ->select('users.*')
            ->orderby('users.id', 'desc')
            ->groupby('users.id')
            ->paginate($this->countPage());
    }

    public function getAll_followedToday_withoutPaginate()
    {
        return User::join('followups', 'users.id', '=', 'followups.user_id')
            ->where('date_fa', '=', $this->dateNow)
            ->select('users.*')
            ->orderby('users.id', 'desc')
            ->groupby('users.id')
            ->get();
    }

    public function get_insertuserToday()
    {
        return User::where('users.insert_user_id', '=', Auth::user()->id)
            ->where('date_fa', '=', $this->dateNow)
            ->select('users.*')
            ->orderby('users.id', 'desc')
            ->groupby('users.id')
            ->paginate($this->countPage());
    }

    public function get_insertuserbyID($id)
    {
        return User::where('insert_user_id', '=',$id)
            ->select('users.*')
            ->orderby('users.id', 'desc')
            ->groupby('users.id')
            ->paginate($this->countPage());
    }

    public function getAll_insertuser()
    {
        return User::join('followups', 'users.id', '=', 'followups.user_id')
            ->where('insert_user_id', '=', Auth::user()->id)
            ->select('users.*')
            ->orderby('users.id', 'desc')
            ->groupby('users.id')
            ->paginate($this->countPage());
    }

    public function get_trashuserToday()
    {
        return User::where('date_fa', '=', $this->dateNow)
            ->where('type','=',0)
            ->select('users.*')
            ->orderby('users.id', 'desc')
            ->groupby('users.id')
            ->paginate($this->countPage());
    }

    public function get_trashuserbyID($id)
    {

        return User::where('insert_user_id', '=',$id)
            ->where('type','=',0)
            ->select('users.*')
            ->orderby('users.id', 'desc')
            ->groupby('users.id')
            ->paginate($this->countPage());
    }

    public function getAll_trashuser()
    {
        return User::where('type', '=', 0)
            ->select('users.*')
            ->orderby('users.id', 'desc')
            ->groupby('users.id')
            ->paginate($this->countPage());
    }

    public function getAll_trashuser_withoutPaginate()
    {
        return User::where('type', '=', 0)
            ->groupby('users.id')
            ->select('users.*')
            ->orderby('users.id', 'desc')
            ->get();
    }

    public function get_teachers()
    {
        return teacher::orderby('id','desc')
                ->get();
    }

    public function get_teachersById($id)
    {
        return teacher::where('id','=',$id)
                ->orderby('id','desc')
                ->first();
    }

    public function get_courses($date=NULL)
    {
        return course::where('status','=',1)
                    ->when($date,function($query,$date)
                    {
                        return $query->where('start','>',$date);
                    })
                    ->get();
    }

    public function get_coursesByID($id)
    {
        return course::where('id','=',$id)
            ->first();
    }

    public function get_courseType()
    {
        return coursetype::orderby('id','desc')
                ->get();
    }

    public function get_detailsResource()
    {
        return user::whereNotNull('detailsresource')
                ->groupby('detailsresource')
                ->get();

    }

    public function get_talktimeByID($id)
    {
        return followup::where('insert_user_id','=',$id)
                    ->sum('followups.talktime');
    }

    public function get_talktimeTodayByID($id)
    {
        return followup::where('insert_user_id','=',$id)
                    ->where('date_fa','=',$this->dateNow)
                    ->sum('followups.talktime');
    }

    public function get_settingsmsByType($type)
    {
        return settingsms::where('type',$type)
                    ->where('status','=',1)
                    ->get();
    }

    public function countPage()
    {
        $count=30;
        return $count;
    }

    public function get_options()
    {
        return option::get();
    }

    public function get_optionByName($value)
    {
        return option::where('option_name','=',$value)
                    ->first();
    }

    public function get_postById($post)
    {
        return post::where('id','=',$post)
            ->first();
    }

    public function get_commentByPostId($id,$status=1)
    {
        return comment::where('post_id','=',$id)
                ->where('status','=',$status)
                ->orderby('id','desc')
                ->paginate($this->countPage());
    }

    public function get_commentByPostId_withoutPaginate($id)
    {
        return comment::where('post_id','=',$id)
            ->orderby('id','desc')
            ->get();
    }

    public function get_categoryPostByUserId($id)
    {
        return category_post::where('user_id','=',$id)
                        ->get();
    }

    public function get_categoryPost_ByUserId_ByCategory($id,$category)
    {
        return category_post::where('user_id','=',$id)
                        ->where('category','=',$category)
                        ->first();
    }

    public function get_categoryPostById($id)
    {
        return category_post::where('id','=',$id)
                ->first();
    }

    public function get_scores()
    {
        return settingscore::first();
    }


    public function get_usersByType($type=NULL,$id=NULL,$paginate=NULL,$between=NULL,$condition=NULL)
    {

        $users= User::join('followups','users.id','=','followups.user_id')
            ->when($id, function ($query,$id) {
                return $query->where('followby_expert', '=', $id);
            })
            ->when($type,function($query,$type){
                return $query->where('users.type','=',$type);
            })
            ->when($between,function($query,$between)
            {
                return $query->wherebetween('followups.date_fa',[$between[0],$between[1]]);
            })
            ->when($condition,function($query,$condition)
            {
                return $query->where($condition[0],'=',$condition[1]);
            })
            ->orderby('followups.id', 'desc')
            ->groupby('followups.user_id')
            ->select('users.*')
            ->when($paginate,function($query){
                return $query->paginate($this->countPage());
            },function($query){
                return $query->get();
            });

        return $users;
    }

    public function get_categoryCoaches($id=NULL,$shortlink=NULL,$status=NULL,$paginate=NULL)
    {
        return category_coach::when($id,function($query,$id){
                return $query->where('id','=',$id);
            })
            ->when($shortlink,function ($query,$shortlink)
            {
                return $query->where('shortlink','=',$shortlink);
            })
            ->when($status,function($query,$status)
            {
                return $query->where('status','=',1);
            })
            ->when($paginate,function($query){
                return $query->paginate($this->countPage());
            },function($query){
                return $query->get();
            });
    }


}
