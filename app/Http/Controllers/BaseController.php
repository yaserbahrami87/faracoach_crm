<?php

namespace App\Http\Controllers;

use App\city;
use App\state;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function __construct() {
        $dateNow = verta();
        $this->dateNow = $dateNow->format('Y/m/d');
        $this->timeNow = $dateNow->format('H:i:s');
    }

    public function sensSms($tel,$msg)
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

    public function states()
    {
        $states=state::orderby('name','asc')
                ->get();
        return $states;
    }

    public function citiesAjax($state)
    {
        $cities=city::where('state_id','=',$state)
                    ->groupby('name')
                    ->orderby('name','asc')
                    ->get();
        foreach($cities as $item)
        {
            echo "<option value='{{$item->id}}'>".$item->name."</option>";
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


}
