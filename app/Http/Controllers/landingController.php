<?php

namespace App\Http\Controllers;

use App\landPage;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class landingController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view ('landing');
    }

    public function showPackageDownload()
    {
        if(session('status')==true)
        {
            return  view('freePackageLanding');
        }
        else
        {
            return back();
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
        $this->validate(request(),
        [
            'fname' =>'required|min:3|persian_alpha',
            'lname' =>'required|min:3|persian_alpha',
            'tel'   =>'required|iran_mobile',
            'email' =>'nullable|email'
        ]);

        $check=User::where('email','=',$request['email'])
                ->orwhere('tel','=',$request['tel'])
                ->count();

        if($check==1)
        {
            $user=User::where('tel','=',$request['tel'])
                        ->orwhere('email','=',$request['email'])
                        ->first();

            if(!is_null($user) )
            {
                if ($user->fname != $request['fname']) {
                    $user->fname = $request['fname'];
                }

                if($user->lname!=$request['lname'])
                {
                    $user->lname=$request['lname'];
                }


                if($user->email!=$request['email'])
                {
                    $user->email=$request['email'];
                }

                if($user->tel!=$request['tel'])
                {
                    $user->tel!=$request['tel'];
                }
                $status=$user->update();
            }
            else
            {
                $status=User::create($request->all() +
                    [
                        'date_fa'       =>$this->dateNow,
                        'time_fa'       =>$this->timeNow
                    ]);

            }

            if($status)
            {
                $msg = "پروفایل با موفقیت به روزرسانی شد";
                $errorStatus = "success";
            }
            else
            {
                $msg = "خطا در بروزرسانی اطلاعات";
                $errorStatus = "danger";
            }
            return  redirect()
                    ->route('freePackageLanding')
                    ->with('status',true)
                    ->with('msg',$msg)
                    ->with('errorStatus',$errorStatus);

        }
        else if($check>1)
        {
            $msg="بیش از 1 نفر با اطلاعات وارد شده در سیستم موجوداست";
            $errorStatus="danger";
            return  back()
                    ->with('msg',$msg)
                    ->with('errorStatus',$errorStatus);
        }
        else if($check==0)
        {
            $status = User::create($request->all()+
            [
                'type'               =>'1',
                'password'           =>Hash::make('12345678'),
                'resource'           =>'کمپین',
                'detailsresource'    =>'17 ربیع 1399'
            ]);
            if($status)
            {
                $msg = "اطلاعات با موفقیت ثبت شد";
                $errorStatus = "success";
                $msgSMS=$request->fname." ".$request->lname. " عزیز اطلاعات شما در سیستم فراکوچ ثبت شد";
                $this->sensSms($request['tel'],$msgSMS);
            }
            else
            {
                $msg = "خطا در ثبت اطلاعات";
                $errorStatus = "danger";
            }
            return  redirect()
                    ->route('freePackageLanding')
                    ->with('msg',$msg)
                    ->with('errorStatus',$errorStatus)
                    ->with('status',true);
        }


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

    public function store_landing_gift(Request $request)
    {

        $this->validate(request(),
            [
                'fname' =>'required|min:3|persian_alpha',
                'lname' =>'required|min:3|persian_alpha',
                'tel'   =>'required|iran_mobile',
                'email' =>'nullable|email'
            ]);



            $land=landPage::where('tel','=',$request->tel)
                            ->latest()
                            ->first();


            $status=$land->update($request->all()+[
                    'date_fa'       =>$this->dateNow,
                    'time_fa'       =>$this->timeNow
                ]);


            if($status)
            {
                alert()->success('اطلاعات با موفقیت ثبت شد')->persistent('بستن');
            }
            else
            {
                alert()->error('خطا در ثبت')->persistent('بستن');
            }

            return  redirect('/gift');



    }

    //لندینگ دعوت گردهمایی مشهد
    public function invitaionCreate()
    {
        $user=landPage::where('user_id','=',Auth::user()->id)
                    ->where('resource','=','گردهمایی مشهد')
                    ->get();

        if($user->count()>0)
        {
            alert()->error('اطلاعات شما در دورهمی فراکوچ ثبت شده است.')->persistent('بستن');
            return back();
        }
        else
        {
            $courses=$this->get_courses();
            return view('panelUser.invitation')
                ->with('courses',$courses);
        }

    }

    public function invitaionStore (Request $request)
    {
        $this->validate($request,[
            'options'   =>'required|numeric',
        ],[
            'options.required'  =>'انتخاب دوره اجباریست',
            'options.numeric'   =>'انتخاب دوره را صحیح وارد کنید',
        ]);

        $status=landPage::create($request->all()+[
                'user_id'   =>Auth::user()->id,
                'resource'  =>'گردهمایی مشهد'

            ]);

        if($status)
        {
            if($status->options==0)
            {
                alert()->warning("این مراسم ویژه دانشپذیران و فارغ التحصیلان فراکوچ می باشد \n شما می توانید به صورت آنلاین از طریق صفحه اینستاگرام فراکوچ در رویداد شرکت کنید.")->persistent('بستن');
                $sw=false;
                return redirect('/');
            }
            else
            {
                alert()->success('درخواست شما برای شرکت در گردهمایی مشهد ثبت شد')->persistent('بستن');
                $msg="حضور شما در گردهمایی خانواده بزرگ فراکوچ ثبت شد.\nآدرس: مشهد جاده شاندیز مدرس 1/6 باغ تالار بارثاوا\nساعت ۱۵:۴۵\n";
                $this->sendSms(Auth::user()->tel,$msg);
                return view('panelUser.invitation_back');
            }

        }
        else
        {
            alert()->error('خطا در درخواست شرکت در گردهمایی')->persistent('بستن');
        }

        return back();

    }

    public function invitationIndex()
    {
        $user=landPage::join('users','land_pages.user_id','=','users.id')
                    ->where('land_pages.resource','=','گردهمایی مشهد')
                    ->get();
        foreach ($user as $item)
        {
            if($item->options==0)
            {
                $item->course='دانشجو نیستم';
            }
            else
            {
                $item->course=$this->get_coursesByID($item->options)->course;
            }

        }

        return view('panelAdmin.invitation_list')
                    ->with('users',$user);
    }
}
