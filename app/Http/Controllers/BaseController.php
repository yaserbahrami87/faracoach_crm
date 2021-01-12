<?php

namespace App\Http\Controllers;

use App\categoryTag;
use App\city;
use App\followbyCategory;
use App\problemfollowup;
use App\state;
use App\tag;
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
            case "11": return "در حال پیگیری";
                        break;
            case "12":return "انصراف";
                        break;
            case "20":return "دانشجو";
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
}
