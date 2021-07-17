<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class HomeController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $dateNow = verta();
        $this->dateNow = $dateNow->format('Y/m/d');
        $this->timeNow = $dateNow->format('H:i:s');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts=$this->get_post(NULL,1,'limit');
        if(Auth::check())
        {
            $tweets=$this->get_tweet(NULL,2,'paginate');
        }
        else
        {
            $tweets=$this->get_tweet(NULL,1,'paginate');
        }

        foreach ($posts as $item)
        {
//            $item->time=($this->dateNow)->formatDifference($item->updated_at);
            $item->time=$this->diff($item->created_at_post,'Asia/Tehran');

        }

        $last_users=User::wherenotin('type',['2','3','4'])
            ->where('status_coach','<>','1')
            ->orderby('last_login_at','desc')
            ->limit(12)
            ->get();
        $last_coaches=User::join('coaches','users.id','=','coaches.user_id')
                //->wherenotin('users.type',['2','3','4'])
                ->where('users.status_coach','=',1)
                ->orderby('users.last_login_at','desc')
                ->limit(12)
                ->get();


//        return view('home')
        return redirect('/login')
                    ->with('tweets',$tweets)
                    ->with('posts',$posts)
                    ->with('last_users',$last_users)
                    ->with('last_coaches',$last_coaches);
    }

    public function diff($item,$timezone)
    {
        date_default_timezone_set('UTC');
        $dt=Carbon::now($timezone);
        if (($dt->diffInSeconds($item))<=59)
        {
            return $dt->diffInMinutes($item)." ثانیه ";
        }
        else if( ($dt->diffInMinutes($item))<=59)
        {
            return $dt->diffInMinutes($item)." دقیقه ";
        }
        else if( ($dt->diffInHours($item))<=23)
        {
            return $dt->diffInHours($item)." ساعت ";
        }
        else
        {
            return $dt->diffInDays($item)." روز ";
        }
    }
}
