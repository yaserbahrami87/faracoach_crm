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
        $sms=sms::orderby('id','desc')
                ->paginate(50);
        foreach ($sms as $item)
        {
            if(!is_null($item->insert_user_id))
            {
                $item->insert_user_id=$this->get_user_byID($item->insert_user_id)->fname." ".$this->get_user_byID($item->insert_user_id)->lname;
            }
        }
        return view ('panelAdmin.sms')
                    ->with('sms',$sms);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=($this->get_detailsResource());

        //تگ ها
        $tags = $this->get_tags();
        $parentCategory = $this->get_category('پیگیری');
        $problem=$this->getproblemfollowup();
        $types=$this->get_userTypes();
        return view('panelAdmin.sendSms')
                    ->with('categories',$categories)
                    ->with('parentCategory',$parentCategory )
                    ->with('tags',$tags)
                    ->with('problem',$problem)
                    ->with('types',$types);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'comment'   =>'required'
        ]);
        $user=user::query();
        $user->leftjoin('followups','users.id','=','followups.user_id');

        if(isset($request->categories)) {
            for ($i = 0; $i < count($request->categories); $i++) {
                $user = $user->orwhere('resource', '=', $request['categories'][$i]);
                $user = $user->orwhere('detailsresource', '=', $request['categories'][$i]);
            }
        }

        if(isset($request->tags))
        {
            for ($i = 0; $i < count($request->tags); $i++) {
                $user = $user->where('followups.tags', 'like', "%".$request['tags'][$i]."%");
            }
        }
        if(isset($request->fields)) {
            for ($i = 0; $i < count($request->fields); $i++) {
                $user = $user->where($request['fields'][$i], $request['comparison'][$i], $request['values'][$i]);
            }
        }

        if(isset($request->problem)) {
            for ($i = 0; $i < count($request->problem); $i++) {
                $user = $user->orwhere('followups.problemfollowup_id', '=', $request['problem'][$i]);
            }
        }

        if(isset($request->types)) {
            for ($i = 0; $i < count($request->types); $i++) {
                if ($request['types'][$i] == 1) {
                    $user = $user->orwhere('users.type', '=', '1');
                } else if ($request['types'][$i] == 2) {
                    $user = $user->orwhere('users.type', '=', '2');
                }else if($request['types'][$i] == 3) {
                    $user = $user->orwhere('users.type', '=', '3');
                }
                else {
                    $user = $user->orwhere('users.type', '=', $request['types'][$i]);
                }
            }
        }


        $user=$user->get();


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

            foreach ($user as $item) {
                $comment=$request['comment'];
                if($item->sex==1)
                {
                    $item->sex="آقای ";
                }
                else if(is_null($item->sex))
                {
                    $item->sex="کاربر ";
                }
                else if($item->sex==0)
                {
                    $item->sex="خانم ";
                }

                $comment=str_replace("{tel}",$item->tel,$comment);
                $comment=str_replace("{fname}",$item->fname,$comment);
                $comment=str_replace("{lname}",$item->lname,$comment);
                $comment=str_replace("{datebirth}",$item->datebirth,$comment);
                $comment=str_replace("{sex}",$item->sex,$comment);
                //$this->sendSms($item->tel,$comment);
            }
            $msg = "پیام با موفقیت به تعداد " .count($user) . " ارسال شد";
            $errorStatus = "success";
            return back()->with('msg', $msg)
                ->with('errorStatus', $errorStatus);
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

    public function createAjax(request $request)
    {
        $user=user::query();
        $user->leftjoin('followups','users.id','=','followups.user_id');
        if(isset($request->categories)) {
            for ($i = 0; $i < count($request->categories); $i++) {
                $user = $user->orwhere('resource', '=', $request['categories'][$i]);
                $user = $user->orwhere('detailsresource', '=', $request['categories'][$i]);
            }
        }
        if(isset($request->tags))
        {
            for ($i = 0; $i < count($request->tags); $i++) {
                $user = $user->where('followups.tags', 'like', "%".$request['tags'][$i]."%");
            }
        }
        if(isset($request->fields)) {
            for ($i = 0; $i < count($request->fields); $i++) {
                $user = $user->where($request['fields'][$i], $request['comparison'][$i], $request['values'][$i]);
            }
        }

        if(isset($request->problem)) {
            for ($i = 0; $i < count($request->problem); $i++) {
                $user = $user->orwhere('followups.problemfollowup_id', '=', $request['problem'][$i]);
            }
        }

        if(isset($request->types)) {
            for ($i = 0; $i < count($request->types); $i++) {
                if ($request['types'][$i] == 1) {
                    $user = $user->orwhere('users.type', '=', '1');
                } else if ($request['types'][$i] == 2) {
                    $user = $user->orwhere('users.type', '=', '2');
                }else if($request['types'][$i] == 3) {
                    $user = $user->orwhere('users.type', '=', '3');
                }
                else {
                    $user = $user->orwhere('users.type', '=', $request['types'][$i]);
                }
            }
        }
        $user=$user->get();
        if((count($user)>0)||(isset($request['tel_recieves']))) {
            echo "تعداد افراد فیلترشده ".count($user)." نفر می باشد";
        }
        else
        {
            $msg = "تعداد افراد فیلترشده 0 نفر می باشد";
            $errorStatus = "danger";
            return back()->with('msg', $msg)
                ->with('errorStatus', $errorStatus);
        }
    }
}
