<?php

namespace App\Http\Controllers;

use App\post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends BaseController
{

    public function __construct()
    {
        $dateNow = verta();
        $this->dateNow = $dateNow->format('Y/m/d');
        $this->timeNow = $dateNow->format('H:i:s');

//        $this->middleware('can:isUser');
//        $this->middleware(function ($request, $next) {
//            $this->user = Auth::user();
//            if(strlen($this->user->username)==0)
//            {
//                $msg = "برای دسترسی به قسمت بلاگ لطفا نام کاربری خود را در اطلاعات شخصی مشخص کنید";
//                $errorStatus = "danger";
//                return back()
//                    ->with('msg', $msg)
//                    ->with('errorStatus', $errorStatus);
//            }
//
//            return $next($request);

//        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(strlen(Auth::user()->username)==0)
        {
            return back();
        }
        else
        {
            $posts=post::where('user_id','=',Auth::user()->id)
                        ->orderby('id','desc')
                        ->get();
            return view('panelUser.posts')
                    ->with('posts',$posts);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(strlen(Auth::user()->username)==0)
        {
            return back();
        }
        else {
            return view('panelUser.insertPost');
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

        $this->validate($request,
            [
                'title'         =>'required|string|min:2|max:200',
                'shortlink'     =>'required|string|max:250',
                'content'       =>'required|string',
                'status'        =>'required|boolean',
                'status_comment'=>'required|boolean',
                'image'         =>'required|string'
            ]);
        $request['user_id']=Auth::user()->id;
        $request['date_fa']=$this->dateNow;
        $request['time_fa']=$this->timeNow;

        $status=post::create($request->all());
        if($status)
        {
            $msg = "پست با موفقیت ذخیره شد";
            $errorStatus = "success";
            return back()->with('msg', $msg)
                ->with('errorStatus', $errorStatus);
        }
        else
        {
            $msg = "خطا در ذخیره";
            $errorStatus = "danger";
            return back()->with('msg', $msg)
                ->with('errorStatus', $errorStatus);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($username,$post)
    {
        $user=$this->get_user_byUserName($username);
        if(!(is_null($user)))
        {
            $post=post::where('user_id','=',$user->id)
                ->where('shortlink','=',$post)
                ->first();
            if(!is_null($post))
            {
                return view('single')
                    ->with('posts',$post)
                    ->with('user',$user);
            }
        }
        $msg = "صفحه ای با چنین مشخصاتی پیدا نشد";
        $errorStatus = "danger";
        return abort(404);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($username, $post)
    {
        $user=$this->get_user_byUserName($username);
        if(!is_null($user))
        {
            $post=post::where('user_id','=',Auth::user()->id)
                ->where('shortlink','=',$post)
                ->first();
            if(!is_null($post))
            {
                return view('paneluser.editPost')
                        ->with('post',$post);
            }
        }
        return abort('404');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$username, $post)
    {
        $user=$this->get_user_byUserName($username);
        if(!is_null($user))
        {
            $post=post::where('user_id','=',Auth::user()->id)
                ->where('shortlink','=',$post)
                ->first();
            if(!is_null($post))
            {
                $this->validate($request,
                    [
                        'title'         =>'required|string|min:2|max:200',
                        'shortlink'     =>'required|string|max:250',
                        'content'       =>'required|string',
                        'status'        =>'required|boolean',
                        'status_comment'=>'required|boolean',
                        'image'         =>'required|string'
                    ]);
                $status=$post->update($request->all());

                if($status)
                {

                    $msg = "پست با موفقیت بروزرسانی شد";
                    $errorStatus = "success";
                    return redirect('/panel/post')
                        ->with('msg', $msg)
                        ->with('errorStatus', $errorStatus);
                }
                else
                {
                    $msg = "خطا در بروزرسانی";
                    $errorStatus = "danger";
                    return redirect('/panel/post')
                        ->with('msg', $msg)
                        ->with('errorStatus', $errorStatus);
                }
            }
        }
        return abort('404');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($username,$post)
    {
        $user=$this->get_user_byUserName($username);
        if(!is_null($user))
        {
            $post=post::where('user_id','=',Auth::user()->id)
                ->where('shortlink','=',$post)
                ->first();
            if(!is_null($post))
            {
                dd($post);
                $status=$post->delete();
                if($status)
                {
                    $msg = "پست با موفقیت بروزرسانی شد";
                    $errorStatus = "success";
                    return redirect('/panel/post')
                        ->with('msg', $msg)
                        ->with('errorStatus', $errorStatus);
                }
                else
                {
                    $msg = "خطا در بروزرسانی";
                    $errorStatus = "danger";
                    return redirect('/panel/post')
                        ->with('msg', $msg)
                        ->with('errorStatus', $errorStatus);
                }
            }
        }
        return abort('404');
    }

    public function blogHomePage($user)
    {
        $user=$this->get_user_byUserName($user);
        if(is_null($user))
        {
            return abort(404);
        }
        else
        {

            $posts=post::where('user_id','=',$user->id)
                        ->orderby('id','desc')
                        ->paginate(5);
            return view('blog')
                        ->with('posts',$posts)
                        ->with('user',$user);
        }
    }
}
