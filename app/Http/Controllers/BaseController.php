<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function __construct() {

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
                        'from'=>'10003816',
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
}
