<?php

namespace App\Http\Controllers;

use App\problemfollowup;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;





class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $dateNow = verta();
        $this->dateNow = $dateNow->format('Y/m/d');
    }

    public function index()
    {
        $users=User::whereNotIn('users.type',[2])
            ->orderby('id','desc')
            ->paginate(20);

        return view('panelAdmin.users')
                    ->with('users',$users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,User $user)
    {
        $check=User::where('codemelli','=',$request['codemelli'])
                    ->orwhere('email','=',$request['email'])
                    ->count();

        if($check>0)
        {
            $msg="کد ملی / پست الکترونیکی تکراری است";
            $errorStatus="danger";
        }
        else
        {

            $this->validate(request(),
            [
                'fname'             =>'persian_alpha|required|min:3',
                'lname'             =>'persian_alpha|required|min:3',
                'codemelli'         =>'required|min:9',
                'sex'               =>'required|boolean',
                'tel'               =>'required|numeric',
                'shenasname'        =>'nullable|numeric',
                'father'            =>'nullable|min:3|',
                'born'              =>'nullable|min:3',
                'married'           =>'nullable|boolean',
                'education'         =>'nullable|min:4',
                'reshteh'           =>'nullable|min:4',
                'state'             =>'nullable|min:4',
                'city'              =>'nullable|min:4',
                'address'           =>'nullable|min:4',
                'personal_image'    =>'nullable|mimes:jpeg,jpg,pdf|max:600',
                'shenasnameh_image' =>'nullable|mimes:jpeg,jpg,pdf|max:600',
                'cartmelli_image'   =>'nullable|mimes:jpeg,jpg,pdf|max:600',
                'education_image'   =>'nullable|mimes:jpeg,jpg,pdf|max:600',
                'email'             =>'required|email',
                'password'          =>'required_with:repassword|string',
                'repassword'        =>'required',
                'rules'             =>'required'
            ]);
            $shenasnameh_image=$cartmelli_image=$education_image=$personal_image=NULL;

            if($request->has('personal_image')&&$request->file('personal_image')->isValid())
            {
                $file=$request->file('personal_image');
                $personal_image="personal-".$request->codemelli.".".$request->file('personal_image')->extension();
                $path=public_path('/documents/users/');
                $files=$request->file('personal_image')->move($path, $personal_image);
                $request->personal_image=$personal_image;
            }

            if($request->has('shenasnameh_image')&&$request->file('shenasnameh_image')->isValid())
            {
                $file=$request->file('shenasnameh_image');
                $shenasnameh_image="shenasnameh-".$request->codemelli.".".$request->file('shenasnameh_image')->extension();
                $path=public_path('/documents/users/');
                $files=$request->file('shenasnameh_image')->move($path, $shenasnameh_image);
                $request->shenasnameh_image=$shenasnameh_image;

            }
            /*
            if($request->has('cartmelli_image')&&$request->file('cartmelli_image')->isValid())
            {
                $file=$request->file('cartmelli_image');
                $cartmelli_image="cartmelli-".$request->codemelli.".".$request->file('cartmelli_image')->extension();
                $path=public_path('/documents/users/');
                $files=$request->file('cartmelli_image')->move($path, $cartmelli_image);
                $request->cartmelli_image=$cartmelli_image;
            }

            if($request->has('education_image')&&$request->file('education_image')->isValid())
            {
                $file=$request->file('education_image');
                $education_image="education-".$request->codemelli.".".$request->file('education_image')->extension();
                $path=public_path('/documents/users/');
                $files=$request->file('education_image')->move($path, $education_image);
                $request->education_image=$education_image;
            }
            */
            $type=1;
            $status = User::create([
                'fname'                     => $request['fname'],
                'lname'                     => $request['lname'],
                'codemelli'                 => $request['codemelli'],
                'sex'                       => $request['sex'],
                'tel'                       => $request['tel'],
                'shenasname'                => $request['shenasname'],
                'father'                    => $request['father'],
                'born'                      => $request['born'],
                'married'                   => $request['married'],
                'education'                 => $request['education'],
                'reshteh'                   => $request['reshteh'],
                'state'                     => $request['state'],
                'city'                      => $request['city'],
                'address'                   => $request['address'],
                'personal_image'            => $personal_image,
                'shenasnameh_image'         => $shenasnameh_image,
                'cartmelli_image'           => $cartmelli_image,
                'education_image'           => $education_image,
                'email'                     => $request['email'],
                'password'                  => Hash::make($request['password']),
                'type'                      => $type,
                'email_verification_token'  => Str::random(32)
            ]);

            if($status)
            {
                $msg="اطلاعات ما با موفقیت در سیستم ثبت شد";
                $errorStatus="success";

                // Send SMS
                $url = "https://ippanel.com/services.jspd";
                $rcpt_nm = array($request['tel']);
                $param = array
                            (
                                'uname'=>'09154665888',
                                'pass'=>'qSo9e_o2S3',
                                'from'=>'10003816',
                                'message'=>$msg ." به زودی کارشناسان ما با شما تماس خواهند گرفت",
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
        return back()->with('msg',$msg)->with('errorStatus',$errorStatus);
    }


    public function panel()
    {
        if(Gate::allows('isAdmin'))
        {
            return redirect()->route('panelAdmin');
        }
        else if(Gate::allows('isUser'))
        {
            return view('panelUser.home');
        }
        else
        {
            return back();
        }

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function profile(User $user)
    {
        $user=(Auth::user());
        return view ('panelUser.profile')
                    ->with('user',$user);
    }

    public function show($user)
    {

        $userAdmin=Auth::user();
        $countFollowups=User::join('followups','users.id','=','followups.user_id')
                            ->where('users.id','=',$user)
                            ->count();

        $followUps=User::join('followups','users.id','=','followups.user_id')
                        //->join('followups','users.id','=','followups.insert_user_id')
                        ->join('problemfollowups','problemfollowups.id','=','followups.problemfollowup_id')
                        ->where('followups.user_id','=',$user)
                        ->orderby('followups.id','asc')
                        ->get();

        $listIntroducedUser=User::where('introduced','=',$user)
                        ->get();
        foreach ($listIntroducedUser as $item)
        {
            if(strlen($item->personal_image)==0)
            {
                $item->personal_image="default-avatar.png";
            }
        }

        foreach ($followUps as $item)
        {
            $admin_Followup=User::where('id','=',$item->insert_user_id)
                                ->first();
            $item->insert_user_id=$admin_Followup->fname." ".$admin_Followup->lname;
        }


        $problemFollowup=problemfollowup::orderby('problem')
                        ->where('status','=','1')
                        ->get();

        //مقدار یوزر با توجه به دستور زیر مقدار ورودی تابع با مقدار خروجی تقییر میکند

        $user=User::find($user);
        if(strlen($user->personal_image)==0)
        {
            $user->personal_image="default-avatar.png";
        }

        $introduced=User::where('id','=',$user->introduced)
                            ->first();
        if(strlen($introduced)>0)
        {
            $user->introduced=$introduced->fname." ".$introduced->lname ." با کد ".$introduced->id;
        }


//        $countFollowups=user::join('followups','users.id','=','followups.user_id')
//              ->count();

//        $followUps=user::join('followups','users.id','=','followups.user_id')
//            ->join('problemfollowups','problemfollowups.id','=','followups.problemfollowup_id')
//            ->get();
        return view('panelAdmin.profile',compact('user','countFollowups','followUps','problemFollowup','userAdmin','listIntroducedUser'));
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
    public function update(Request $request,User $user)
    {

        $check=User::where('codemelli','=',$request['codemelli'])
            ->orwhere('email','=',$request['email'])
            ->count();
            try {


                $this->validate(request(),
                    [
                        'fname' => 'nullable|min:3',
                        'lname' => 'nullable|min:3',
                        'codemelli' => 'nullable:codemelli|min:9|unique:users',
                        'sex' => 'nullable|boolean',
                        'tel' => 'nullable|numeric',
                        'shenasname' => 'nullable|numeric',
                        'father' => 'nullable|min:3|',
                        'born' => 'nullable|min:3',
                        'married' => 'nullable|boolean',
                        'education' => 'nullable|min:4',
                        'reshteh' => 'nullable|min:4',
                        'state' => 'nullable|min:4',
                        'city' => 'nullable|min:4',
                        'address' => 'nullable|min:4',
                        'personal_image' => 'nullable|mimes:jpeg,jpg,pdf|max:600',
                        'shenasnameh_image' => 'nullable|mimes:jpeg,jpg,pdf|max:600',
                        'cartmelli_image' => 'nullable|mimes:jpeg,jpg,pdf|max:600',
                        'education_image' => 'nullable|mimes:jpeg,jpg,pdf|max:600',
                        'email' => 'nullable|email|unique:users',
                    ]);


                if ($request->has('personal_image') && $request->file('personal_image')->isValid()) {
                    $file = $request->file('personal_image');
                    $personal_image = "personal-" . $user->id . "." . $request->file('personal_image')->extension();
                    $path = public_path('/documents/users/');
                    $files = $request->file('personal_image')->move($path, $personal_image);
                    $request->personal_image = $personal_image;
                }

                if ($request->has('shenasnameh_image') && $request->file('shenasnameh_image')->isValid()) {
                    $file = $request->file('shenasnameh_image');
                    $shenasnameh_image = "shenasnameh-" . $user->id . "." . $request->file('shenasnameh_image')->extension();
                    $path = public_path('/documents/users/');
                    $files = $request->file('shenasnameh_image')->move($path, $shenasnameh_image);
                    $request->shenasnameh_image = $shenasnameh_image;

                }

                if ($request->has('cartmelli_image') && $request->file('cartmelli_image')->isValid()) {
                    $file = $request->file('cartmelli_image');
                    $cartmelli_image = "cartmelli-" . $user->id . "." . $request->file('cartmelli_image')->extension();
                    $path = public_path('/documents/users/');
                    $files = $request->file('cartmelli_image')->move($path, $cartmelli_image);
                    $request->cartmelli_image = $cartmelli_image;
                }

                if ($request->has('education_image') && $request->file('education_image')->isValid()) {
                    $file = $request->file('education_image');
                    $education_image = "education-" . $user->id . "." . $request->file('education_image')->extension();
                    $path = public_path('/documents/users/');
                    $files = $request->file('education_image')->move($path, $education_image);
                    $request->education_image = $education_image;
                }

                $user->update($request->all());
                if (isset($personal_image)) {
                    $user->personal_image = $personal_image;
                }

                if (isset($shenasnameh_image)) {
                    $user->shenasnameh_image = $shenasnameh_image;
                }

                if (isset($cartmelli_image)) {
                    $user->cartmelli_image = $cartmelli_image;
                }

                if (isset($education_image)) {
                    $user->education_image = $education_image;
                }

                $user->save();
                $msg = "پروفایل با موفقیت به روزرسانی شد";
                $errorStatus = "success";
            }catch (\Illuminate\Database\QueryException $e)
            {

            }


        return back()->with('msg',$msg)
                    ->with('errorStatus',$errorStatus);
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
}
