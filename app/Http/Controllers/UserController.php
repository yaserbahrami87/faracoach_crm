<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Contracts\Auth\Access\Gate  as GateContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
                'fname'             =>'required|min:3',
                'lname'             =>'required|min:3',
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

            $status = User::create([
                'fname'             => $request['fname'],
                'lname'             => $request['lname'],
                'codemelli'         => $request['codemelli'],
                'sex'               => $request['sex'],
                'tel'               => $request['tel'],
                'shenasname'        => $request['shenasname'],
                'father'            => $request['father'],
                'born'              => $request['born'],
                'married'           => $request['married'],
                'education'         => $request['education'],
                'reshteh'           => $request['reshteh'],
                'state'             => $request['state'],
                'city'              => $request['city'],
                'address'           => $request['address'],
                'personal_image'    => $personal_image,
                'shenasnameh_image' => $shenasnameh_image,
                'cartmelli_image'   => $cartmelli_image,
                'education_image'   => $education_image,
                'email'             => $request['email'],
                'password'          => Hash::make($request['password']),
                'type' => 1
            ]);

            if($status)
            {
                $msg="اطلاعات ما با موفقیت در سیستم ثبت شد";
                $errorStatus="success";
            }
        }
        return back()->with('msg',$msg)->with('errorStatus',$errorStatus);
    }


    public function panel()
    {
        if(Gate::allows('isAdmin'))
        {
            return view('panelUser');
        }
        else if(Gate::allows('isUser'))
        {
            return view('panelUser/home');
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
    public function update(Request $request,User $user)
    {
        $this->validate(request(),
            [
                'fname'             =>'required|min:3',
                'lname'             =>'required|min:3',
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
            ]);


        if($request->has('personal_image')&&$request->file('personal_image')->isValid())
        {
            $file=$request->file('personal_image');
            $personal_image="personal-".$request->codemelli.$request->file('personal_image')->extension();
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

        $user->update($request->all());
        if(isset($personal_image))
        {
            $user->personal_image=$personal_image;
        }

        if(isset($shenasnameh_image))
        {
            $user->shenasnameh_image=$shenasnameh_image;
        }

        if(isset($cartmelli_image))
        {
            $user->cartmelli_image=$cartmelli_image;
        }

        if(isset($education_image))
        {
            $user->education_image=$education_image;
        }

        $user->save();
        $msg="پروفایل با موفقیت به روزرسانی شد";
        return back()->with('msg',$msg)
                     ->with('errorStatus',"success");
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
