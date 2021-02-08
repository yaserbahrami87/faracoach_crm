<?php

namespace App\Http\Controllers;

use App\sms;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kavenegar;

class SmsController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=($this->get_detailsResource());
        return view('panelAdmin.insertSms')
                    ->with('categories',$categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $temp='';
        $user=user::query();
        if(isset($request->categories)) {
            for ($i = 0; $i < count($request->categories); $i++) {
                $user = $user->orwhere('resource', '=', $request['categories'][$i]);
            }
        }
        if(isset($request->fields)) {
            for ($i = 0; $i < count($request->fields); $i++) {
                $user = $user->where($request['fields'][$i], $request['comparison'][$i], $request['values'][$i]);
            }
        }
        $user=$user->groupby('id')->get();

        if((count($user)>0)||(isset($request['tel_recieves']))) {
            $tel_array = [];
            foreach ($user as $item) {
                array_push($tel_array, $item->tel);
            }
            $tel = implode(',', $tel_array);
            if(isset($request['tel_recieves']))
            {
                $tel=$tel.",".$request['tel_recieves'];
            }

            try {
                $sender = "10004346";
                $message = $request['comment'];
                $receptor = array($tel);
                $result = Kavenegar::Send($sender, $receptor, $message);
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
                        'insert_user_id' => Auth::user()->id,
                        'recieve_user' => $tel,
                        'comment' => $request['comment'],
                        'date_fa' => $this->dateNow,
                        'time_fa' => $this->timeNow,
                        'type' => $status,
                        'code' => $messageid,
                    ]);
                    $msg = "پیامک با مشخصات " . $messageid . " متن" . $message . " با وضعیت" . $status . " می باشد";
                    $errorStatus = "success";
                    return back()->with('msg', $msg)
                        ->with('errorStatus', $errorStatus);
                }

            } catch (\Kavenegar\Exceptions\ApiException $e) {
                // در صورتی که خروجی وب سرویس 200 نباشد این خطا رخ می دهد
                $msg = $e->errorMessage();
                $errorStatus = "danger";
                return back()->with('msg', $msg)
                    ->with('errorStatus', $errorStatus);
            } catch (\Kavenegar\Exceptions\HttpException $e) {
                // در زمانی که مشکلی در برقرای ارتباط با وب سرویس وجود داشته باشد این خطا رخ می دهد
                $msg = $e->errorMessage();
                $errorStatus = "danger";
                return back()->with('msg', $msg)
                    ->with('errorStatus', $errorStatus);
            }
        }
        else
        {
            $msg = "تعداد افراد فیلترشده 0 نفر می باشد";
            $errorStatus = "danger";
            return back()->with('msg', $msg)
                ->with('errorStatus', $errorStatus);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\sms  $sms
     * @return \Illuminate\Http\Response
     */
    public function show(sms $sms)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\sms  $sms
     * @return \Illuminate\Http\Response
     */
    public function edit(sms $sms)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\sms  $sms
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, sms $sms)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\sms  $sms
     * @return \Illuminate\Http\Response
     */
    public function destroy(sms $sms)
    {
        //
    }
}
