<?php

namespace App\Http\Controllers;

use App\categoryTag;
use App\city;
use App\course;
use App\coursetype;
use App\followbyCategory;
use App\followup;
use App\message;
use App\problemfollowup;
use App\state;
use App\tag;
use App\teacher;
use App\User;
use GuzzleHttp\Client;
use Hekmatinasser\Verta\Verta;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        // Send SMS
        $url = "https://ippanel.com/services.jspd";
        $rcpt_nm = array($tel);
        $param = array
                    (
                        'uname'=>'09154665888',
                        'pass'=>'qSo9e_o2S3',
                        'from'=>'3000505',
                        'message'=>$msg,
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

            default:return "خطا";
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

    public function get_tags()
    {
        return tag::where('status','=',1)
                ->get();
    }

    public function get_tag_byID($id)
    {
        return tag::where('id','=',$id)
                ->first();
    }

    public function changeTimestampToShamsi($date)
    {
        $dateMiladi=new verta($date);
        return ($dateMiladi->hour.":".$dateMiladi->minute."  ".$dateMiladi->year."/".$dateMiladi->month."/".$dateMiladi->day);
    }

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

    public function get_lastFollowupUser($id)
    {
        return followup::join('problemfollowups','followups.problemfollowup_id','=','problemfollowups.id')
                    ->where('user_id','=',$id)
                    ->orderby('followups.id','desc')
                    ->first();
    }

    public function get_notfollowup()
    {
        return User:: leftjoin('followups', 'users.id', '=', 'followups.user_id')
            ->where(function ($query)
            {
                $query  ->where('users.type', '=', '1')
                    ->orwhere('followby_expert','=',NULL);

            })
            ->select('users.*')
            ->orderby('users.id', 'desc')
            ->groupby('users.id')
            ->paginate(100);
    }

    public function get_notfollowup_withoutPaginate()
    {
        return User:: leftjoin('followups', 'users.id', '=', 'followups.user_id')
            ->where(function ($query)
            {
                $query  ->where('users.type', '=', '1')
                    ->orwhere('followby_expert','=',NULL);

            })
            ->select('users.*')
            ->orderby('users.id', 'desc')
            ->get();
    }

    public function get_continuefollowup()
    {
         return User::where('type', '=', '11')
            ->where('followby_expert', '=', Auth::user()->id)
            ->where('type','=',11)
            ->select('users.*')
            ->groupby('users.id')
            ->orderby('users.id', 'desc')
             ->paginate(100);
    }

    public function get_continuefollowup_withoutPaginate()
    {
        return User::where('type', '=', '11')
            ->where('followby_expert', '=', Auth::user()->id)
            ->where('type','=',11)
            ->select('users.*')
            ->orderby('users.id', 'desc')
            ->get();
    }

    public function get_continuefollowupbyID($id)
    {
        return User::where('type', '=', '11')
            ->where('followby_expert', '=', $id)
            ->where('type','=',11)
            ->select('users.*')
            ->groupby('users.id')
            ->orderby('users.id', 'desc')
            ->paginate(100);
    }

    public function getAll_continuefollowup()
    {
        return User::where('type', '=', '11')
            ->where('type','=',11)
            ->select('users.*')
            ->groupby('users.id')
            ->orderby('users.id', 'desc')
            ->paginate(100);
    }

    public function get_cancelfollowup()
    {
         return User::where('type', '=', '12')
            ->where('followby_expert', '=', Auth::user()->id)
            ->where('type','=',12)
            ->select('users.*')
            ->groupby('users.id')
            ->orderby('users.id', 'desc')
             ->paginate(100);
    }

    public function get_cancelfollowup_withoutPaginate()
    {
        return User::where('type', '=', '12')
            ->where('followby_expert', '=', Auth::user()->id)
            ->where('type','=',12)
            ->select('users.*')
            ->orderby('users.id', 'desc')
            ->get();
    }

    public function get_cancelfollowupbyID($id)
    {
        return User::where('type', '=', '12')
            ->where('followby_expert', '=', $id)
            ->where('type','=',12)
            ->select('users.*')
            ->groupby('users.id')
            ->orderby('users.id', 'desc')
            ->paginate(100);
    }

    public function getAll_cancelfollowup()
    {
        return User::where('type', '=', '12')
            ->where('type','=',12)
            ->select('users.*')
            ->groupby('users.id')
            ->orderby('users.id', 'desc')
            ->paginate(100);
    }

    public function get_waiting()
    {
        return User::where('type', '=', '13')
            ->where('followby_expert', '=', Auth::user()->id)
            ->where('type','=',13)
            ->select('users.*')
            ->groupby('users.id')
            ->orderby('users.id', 'desc')
            ->paginate(100);
    }

    public function get_waiting_withoutPaginate()
    {
        return User::where('type', '=', '13')
            ->where('followby_expert', '=', Auth::user()->id)
            ->where('type','=',13)
            ->select('users.*')
            ->orderby('users.id', 'desc')
            ->get();
    }

    public function get_waitingbyID($id)
    {
        return User::where('type', '=', '13')
            ->where('followby_expert', '=', $id)
            ->where('type','=',13)
            ->select('users.*')
            ->groupby('users.id')
            ->orderby('users.id', 'desc')
            ->paginate(100);
    }

    public function getAll_waiting()
    {
        return User::where('type', '=', '13')
            ->where('type','=',13)
            ->select('users.*')
            ->groupby('users.id')
            ->orderby('users.id', 'desc')
            ->paginate(100);
    }

    public function get_noanswering()
    {
         return User::where('type', '=', '14')
            ->where('followby_expert', '=', Auth::user()->id)
            ->where('type','=',14)
            ->select('users.*')
            ->groupby('users.id')
            ->orderby('users.id', 'desc')
             ->paginate(100);
    }

    public function get_noanswering_withoutPaginate()
    {
        return User::where('type', '=', '14')
            ->where('followby_expert', '=', Auth::user()->id)
            ->where('type','=',14)
            ->select('users.*')
            ->orderby('users.id', 'desc')
            ->get();
    }

    public function get_noansweringbyID($id)
    {
        return User::where('type', '=', '14')
            ->where('followby_expert', '=', $id)
            ->where('type','=',14)
            ->select('users.*')
            ->groupby('users.id')
            ->orderby('users.id', 'desc')
            ->paginate(100);
    }

    public function getAll_noanswering()
    {
        return User::where('type', '=', '14')
            ->where('type','=',14)
            ->select('users.*')
            ->groupby('users.id')
            ->orderby('users.id', 'desc')
            ->paginate(100);
    }

    public function get_students()
    {
        return User::where('type', '=', '20')
            ->where('followby_expert', '=', Auth::user()->id)
            ->where('type','=',20)
            ->select('users.*')
            ->groupby('users.id')
            ->orderby('users.id', 'desc')
            ->paginate(100);
    }

    public function get_students_withoutPaginate()
    {
        return User::where('type', '=', '20')
            ->where('followby_expert', '=', Auth::user()->id)
            ->where('type','=',20)
            ->select('users.*')
            ->orderby('users.id', 'desc')
            ->get();
    }

    public function get_studentsbyID($id)
    {
        return User::where('type', '=', '20')
            ->where('followby_expert', '=', $id)
            ->where('type','=',20)
            ->select('users.*')
            ->groupby('users.id')
            ->orderby('users.id', 'desc')
            ->paginate(100);
    }

    public function getAll_students()
    {
        return User::where('type', '=', '20')
            ->where('type','=',20)
            ->select('users.*')
            ->groupby('users.id')
            ->orderby('users.id', 'desc')
            ->paginate(100);
    }

    public function get_todayFollowup()
    {
        return User::join('followups', 'users.id', '=', 'followups.user_id')
            ->where('followups.nextfollowup_date_fa', '=', $this->dateNow)
            ->where('followby_expert', '=', Auth::user()->id)
            ->select('users.*')
            ->groupby('users.id')
            ->orderby('users.id', 'desc')
            ->paginate(100);
    }

    public function get_todayFollowup_withoutPaginate()
    {
        return User::join('followups', 'users.id', '=', 'followups.user_id')
            ->where('followups.nextfollowup_date_fa', '=', $this->dateNow)
            ->where('followby_expert', '=', Auth::user()->id)
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
            ->paginate(100);
    }

    public function getAll_todayFollowup()
    {
        return User::join('followups', 'users.id', '=', 'followups.user_id')
            ->where('followups.nextfollowup_date_fa', '=', $this->dateNow)
            ->select('users.*')
            ->groupby('users.id')
            ->orderby('users.id', 'desc')
            ->paginate(100);
    }

    public function get_expireFollowup()
    {
        return User::join('followups', 'users.id', '=', 'followups.user_id')
            ->where('followups.nextfollowup_date_fa', '<', $this->dateNow)
            ->where('followby_expert', '=', Auth::user()->id)
            ->wherenotIn('users.type', [2, 12])
            ->groupby('users.id')
            ->select('users.*')
            ->orderby('users.id', 'desc')
            ->paginate(100);
    }

    public function get_expireFollowup_withoutPaginate()
    {
        return User::join('followups', 'users.id', '=', 'followups.user_id')
            ->where('followups.nextfollowup_date_fa', '<', $this->dateNow)
            ->where('followby_expert', '=', Auth::user()->id)
            ->wherenotIn('users.type', [2, 12])
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
            ->paginate(100);
    }

    public function getAll_expireFollowup()
    {
        return User::join('followups', 'users.id', '=', 'followups.user_id')
            ->where('followups.nextfollowup_date_fa', '<', $this->dateNow)
            ->wherenotIn('users.type', [2, 12])
            ->groupby('users.id')
            ->select('users.*')
            ->orderby('users.id', 'desc')
            ->paginate(100);
    }

    public function get_myfollowup()
    {
        return User::join('followups', 'users.id', '=', 'followups.user_id')
            ->where('followups.insert_user_id', '=', Auth::user()->id)
            ->select('users.*')
            ->groupby('users.id')
            ->orderby('users.id', 'desc')
            ->paginate(100);
    }

    public function get_myfollowup_withoutPaginate()
    {
        return User::join('followups', 'users.id', '=', 'followups.user_id')
            ->where('followups.insert_user_id', '=', Auth::user()->id)
            ->select('users.*')
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
            ->paginate(100);
    }

    public function getAll_myfollowup()
    {
        return User::join('followups', 'users.id', '=', 'followups.user_id')
            ->select('users.*')
            ->groupby('users.id')
            ->orderby('users.id', 'desc')
            ->paginate(100);
    }

    public function get_followedToday()
    {
        return User::join('followups', 'users.id', '=', 'followups.user_id')
            ->where('followups.insert_user_id', '=', Auth::user()->id)
            ->where('date_fa', '=', $this->dateNow)
            ->select('users.*')
            ->orderby('users.id', 'desc')
            ->groupby('users.id')
            ->paginate(100);
    }

    public function get_followedToday_withoutPaginate()
    {
        return User::join('followups', 'users.id', '=', 'followups.user_id')
            ->where('followups.insert_user_id', '=', Auth::user()->id)
            ->where('date_fa', '=', $this->dateNow)
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
            ->paginate(100);
    }

    public function getAll_followedToday()
    {
        return User::join('followups', 'users.id', '=', 'followups.user_id')
            ->where('date_fa', '=', $this->dateNow)
            ->select('users.*')
            ->orderby('users.id', 'desc')
            ->groupby('users.id')
            ->paginate(100);
    }

    public function get_insertuserToday()
    {
        return User::where('users.insert_user_id', '=', Auth::user()->id)
            ->where('date_fa', '=', $this->dateNow)
            ->select('users.*')
            ->orderby('users.id', 'desc')
            ->groupby('users.id')
            ->paginate(100);
    }

    public function get_insertuserbyID($id)
    {
        return User::where('insert_user_id', '=',$id)
            ->select('users.*')
            ->orderby('users.id', 'desc')
            ->groupby('users.id')
            ->paginate(100);
    }

    public function getAll_insertuser()
    {
        return User::join('followups', 'users.id', '=', 'followups.user_id')
            ->where('insert_user_id', '=', Auth::user()->id)
            ->select('users.*')
            ->orderby('users.id', 'desc')
            ->groupby('users.id')
            ->paginate(100);
    }

    public function get_trashuserToday()
    {
        return User::where('date_fa', '=', $this->dateNow)
            ->where('type','=',0)
            ->select('users.*')
            ->orderby('users.id', 'desc')
            ->groupby('users.id')
            ->paginate(100);
    }

    public function get_trashuserbyID($id)
    {

        return User::where('insert_user_id', '=',$id)
            ->where('type','=',0)
            ->select('users.*')
            ->orderby('users.id', 'desc')
            ->groupby('users.id')
            ->paginate(100);
    }

    public function getAll_trashuser()
    {
        return User::where('type', '=', 0)
            ->select('users.*')
            ->orderby('users.id', 'desc')
            ->groupby('users.id')
            ->paginate(100);
    }

    public function getAll_trashuser_withoutPaginate()
    {
        return User::where('type', '=', 0)
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

    public function get_courses()
    {
        return course::where('status','=',1)
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
}
