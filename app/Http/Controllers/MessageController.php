<?php

namespace App\Http\Controllers;

use App\message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hekmatinasser\Verta\Verta;
use Illuminate\Support\Facades\Gate;

class MessageController extends Controller
{

    public function __construct()
    {
        $dateNow = verta();
        $this->dateNow = $dateNow->format('Y/m/d');
        $this->timeNow = $dateNow->format('H:i:s');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Gate::allows('isAdmin'))
        {
            $messages=message::where('message_id_answer','=',NULL)
                            ->where(function ($query)
                            {
                                $query  ->orwhere('user_id_send','=',Auth::user()->id)
                                        ->orwhere('user_id_recieve','=',Auth::user()->id);

                            })
                            ->get();
            return view('panelAdmin.messages')
                    ->with('messages',$messages);
        }
        else if(Gate::allows('isUser'))
        {
            $messages=message::where('message_id_answer','=',NULL)
                            ->where(function ($query)
                            {
                                $query  ->orwhere('user_id_send','=',Auth::user()->id)
                                        ->orwhere('user_id_recieve','=',Auth::user()->id);

                            })
                            ->get();
            return view('panelUser.messages')
                    ->with('messages',$messages);
        }




    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //یوزر توسط چه کسی معرفی شده است
        $resourceIntroduce=User::where('tel','=',Auth::user()->introduced)
                ->select('users.id','users.fname','users.lname','users.tel')
                ->first();

        //لیست افراد معرفی شده
        $listIntroducedUser=User::where('introduced','=',Auth::user()->tel)
                ->select('users.id','users.fname','users.lname','users.tel')
                ->get();

        //سطح دسترسی ها
        if(Gate::allows('isAdmin'))
        {
            return view('panelAdmin.insertMessage')
                    ->with('resourceIntroduce',$resourceIntroduce)
                    ->with('listIntroducedUser',$listIntroducedUser);
        }else if(Gate::allows('isUser'))
        {
            return view('panelUser.insertMessage')
                    ->with('resourceIntroduce',$resourceIntroduce)
                    ->with('listIntroducedUser',$listIntroducedUser);
        }
        else
        {
            return back();
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate(request(),
        [
            'subject'           =>'required|min:3|string',
            'user_id_recieve'   =>'required|numeric',
            'comment'           =>'required|string|min:3'
        ]);

        $status=message::create($request->all() +
            [
                'user_id_send'  =>Auth::user()->id,
                'date_fa'       =>$this->dateNow,
                'time_fa'       =>$this->timeNow
            ]);
        if($status)
        {
            $msg="پیام با موفقیت ارسال شد";
            $errorStatus='success';
        }
        else
        {
            $msg="خطا در ارسال";
            $errorStatus="danger";
        }
        return  back()
            ->with('msg',$msg)
            ->with('errorStatus',$errorStatus);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(message $message)
    {
        if(($message->user_id_send== Auth::user()->id)||(($message->user_id_recieve== Auth::user()->id)))
        {

            $messages=message::leftjoin('users','messages.user_id_send','=','users.id')
                ->orwhere('messages.id','=',$message->id)
                ->orwhere('messages.message_id_answer','=',$message->id)
                ->orderby('messages.id','desc')
                ->select('messages.*','users.fname','users.lname')
                ->get();
            if(Gate::allows('isAdmin'))
            {
                return view('panelAdmin/showMessage')
                        ->with('messages',$messages)
                        ->with('message',$message);
            }
            else if(Gate::allows('isUser'))
            {
                return view('panelUser/showMessage')
                        ->with('messages',$messages)
                        ->with('message',$message);
            }


        }
        else
        {
            return redirect('/panel/messages/');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(message $message)
    {
        //
    }

    public function reply(Request $request)
    {
        $this->validate(request(),
        [
            'comment'   =>'required|string|min:3'
        ]);


        $status=message::create($request->all() +
            [
                'user_id_send'  =>Auth::user()->id,
                'date_fa'       =>$this->dateNow,
                'time_fa'       =>$this->timeNow
            ]);
        if($status)
        {
            $msg="پیام با موفقیت ارسال شد";
            $errorStatus='success';
        }
        else
        {
            $msg="خطا در ارسال";
            $errorStatus="danger";
        }
        return  back()
            ->with('msg',$msg)
            ->with('errorStatus',$errorStatus);


    }
}
