<?php

namespace App\Http\Controllers;

use App\coach;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SweetAlert;
use Hekmatinasser\Verta\Verta;

class CoachController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coaches=coach::join('users','coaches.user_id','=','users.id')
                    ->where('users.status_coach','=','1')
                    ->select('users.*','coaches.*','users.id as id_user_table')
                    ->get();

        return view('panelAdmin.coaches')
                    ->with('coaches',$coaches);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if((Auth::user()->status_coach==0)||((Auth::user()->type==2)))
        {
            $user=Auth::user();
            if(strlen($user->username)>0)
            {
                return view('panelUser.insertCoach');
            }
            else
            {
                alert()->error('برای درخواست همکاری باید اطلاعات پروفایل خود را کامل کنید','خطا')->persistent('بستن');
                return redirect('/panel/profile');
            }

        }
        else
        {
            alert()->error('شما مجاز به دسترسی به این بخش نیستید','خطا')->persistent('بستن');
            return redirect('/panel');
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
        $this->validate($request,[
            'education_background'  =>'required|string',
            'certificates'          =>'required|string',
            'experience'            =>'required|string',
            'skills'                =>'required|string',
            'researches'            =>'nullable|string',
            'count_meeting'         =>'required|numeric|between:0,10000',
            'customer_satisfaction' =>'required|numeric|between:0,1000',
            'change_customer'       =>'required|numeric|between:0,1000'
        ]);

        $user=Auth::user();
        $coach=coach::where('user_id','=',$user->id)
                ->first();
        if(is_null($coach)) {
            $user->status_coach = '-1';
            $user->update();

            $status = coach::create([
                'user_id' => Auth::user()->id,
                'education_background' => $request['education_background'],
                'researches' => $request['researches'],
                'certificates' => $request['certificates'],
                'experience' => $request['experience'],
                'skills' => $request['skills'],
                'count_meeting' => $request['count_meeting'],
                'customer_satisfaction' => $request['customer_satisfaction'],
                'change_customer' => $request['change_customer'],
                'count_recommendation' => $request['count_recommendation'],
            ]);

            if ($status) {
                $this->sendSms(Auth::user()->tel,'درخواست همکاری شما در سیستم فراکوچ ثبت شد');
                $this->sendSms('09153159020',Auth::user()->fname.''.Auth::user()->lname.' درخواست همکاری به عنوان کوچ در سیستم ثبت کرد');
                alert()->success('درخواست همکاری شما با موفقیت ثبت شد', 'پیام')->persistent('بستن');
            } else {
                alert()->error('خطا در ثبت', 'خطا')->persistent('بستن');
            }
        }
        else
        {
            alert()->error('درخواست همکاری شما قبلا ارسال شده است', 'خطا')->persistent('بستن');
        }

        return redirect('/panel');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\coach  $coach
     * @return \Illuminate\Http\Response
     */
    public function show($coach)
    {
        //چک کردن یوزر کاربر وارد شده در لینک
        $user=$this->get_user_byUserName($coach);

        if(is_null($user))
        {
            alert()->error('کوچ مورد نظر یافت نشد','خطا')->persistent('بستن');
            return redirect('/coaches/all');
        }
        else
        {
            //جوین کردن دو جدول برای بدست آوردن اطلاعات کوچ و کاربر موردنظر که ممکنه آیدی درست باشد ولی کوچ نباشد
            $coach = coach::join('users', 'coaches.user_id', '=', 'users.id')
                ->where('users.id', '=', $user->id)
                ->first();

            $feedbacks=coach::join('bookings', 'coaches.user_id', '=', 'bookings.user_id')
                    ->join('feedback_coachings','bookings.id','=','feedback_coachings.booking_id')
                    ->join('users','users.id','=','feedback_coachings.user_id')
                    ->where('coaches.user_id','=',$user->id)
                    ->paginate(10);


            if(is_null($coach))
            {
                alert()->error('شخص مورد نظر به عنوان کوچ تعریف نشده است','خطا')->persistent('بستن');
                return redirect('/coaches/all');
            }
            else
            {
                if(!is_null($coach->city))
                {
                    $coach->city=$this->city($coach->city)->name;
                }

                $dateNow = verta();
                $dateShamsi = $dateNow->format('Y-m-d');
                $date_Miladi = Verta::getGregorian($dateNow->format('Y'), $dateNow->format('m'), $dateNow->format('d'));

                $date_Miladi = $date_Miladi[0] . '-' . $date_Miladi[1] . '-' . $date_Miladi[2];

                return view('coach')
                    ->with('coach', $coach)
                    ->with('dateNow', $dateShamsi)
                    ->with('date_Miladi', $date_Miladi)
                    ->with('feedbacks',$feedbacks);
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\coach  $coach
     * @return \Illuminate\Http\Response
     */
    public function edit(coach $coach)
    {
        if((Auth::user()->type==2) ||(Auth::user()->type==3))
        {
            return view('panelAdmin.editCoach')
                ->with('coach',$coach);
        }
        else
        {

            if(Auth::user()->id==$coach->user_id)
            {
                return view('panelUser.editCoach')
                    ->with('coach',$coach);
            }
            else{
                alert()->error('شما سطح دسترسی به این بخش را ندارید','خطا')->persistent('بستن');
                return back();
            }

        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\coach  $coach
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, coach $coach)
    {
        $this->validate($request,[
            'education_background'  =>'required|string',
            'certificates'          =>'required|string',
            'experience'            =>'required|string',
            'skills'                =>'required|string',
            'researches'            =>'nullable|string',
            'count_meeting'         =>'required|numeric|between:0,10000',
            'customer_satisfaction' =>'required|numeric|between:0,1000',
            'change_customer'       =>'required|numeric|between:0,1000',
            'status'                =>'required|numeric|between:-2,5'
        ]);

        $status=$coach->update($request->all());
        if($status)
        {
            $user = User::where('id', '=', $coach->user_id)
                ->first();
            $user->status_coach = $request['status'];
            $user->save();

            alert()->success('اطلاعات با موفقیت بروزرسانی شد','پیام')->persistent('بستن');
        }
        else
        {
            alert()->error('خطا در بروزرسانی','خطا ')->persistent('بستن');
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\coach  $coach
     * @return \Illuminate\Http\Response
     */
    public function destroy(coach $coach)
    {
        //
    }

    public function coach_request()
    {
        $coaches=coach::join('users','coaches.user_id','=','users.id')
                ->where('status','=','0')
                ->select('users.*','coaches.*','users.id as id_user_table')
                ->get();

        return view('panelAdmin.coaches')
            ->with('coaches',$coaches);
    }

    public function viewAllCoaches()
    {
        $users=coach::join('users','coaches.user_id','=','users.id')
            ->where('status_coach','=',1)
            ->where('status','=',1)
            ->orderby('users.id','desc')
            ->get();


        return view('allCoaches')
            ->with('coaches',$users);
    }

    public function newrequest (Request $request, coach $coach)
    {
        $this->validate($request,[
            'education_background'  =>'required|string',
            'certificates'          =>'required|string',
            'experience'            =>'required|string',
            'skills'                =>'required|string',
            'researches'            =>'nullable|string',
            'count_meeting'         =>'required|numeric|between:0,10000',
            'customer_satisfaction' =>'required|numeric|between:0,1000',
            'change_customer'       =>'required|numeric|between:0,1000',

        ]);

        $status=$coach->update($request->all());
        if($status)
        {
            $user = User::where('id', '=', $coach->user_id)
                    ->first();
            $user->status_coach = -1;
            $user->save();

            alert()->success('اطلاعات با موفقیت بروزرسانی شد','پیام')->persistent('بستن');
        }
        else
        {
            alert()->error('خطا در بروزرسانی','خطا ')->persistent('بستن');
        }
        return redirect('/panel');
    }
}
