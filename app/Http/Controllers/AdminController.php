<?php

namespace App\Http\Controllers;

use App\followup;
use App\problemfollowup;
use App\User;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function __construct()
    {
        $dateNow = verta();
        $this->dateNow = $dateNow->format('Y/m/d');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notFollowup=User::where('type','=','1')
            ->count();
        $follow=User::where('type','=','11')
            ->count();
        $cancel=User::where('type','=','12')
            ->count();
        $student=User::where('type','=','20')
            ->count();
        $dateNow=$this->dateNow;

        $followupToday=User::join('followups','users.id','=','followups.user_id')
            ->where('nextfollowup_date_fa','=',$dateNow)
            ->wherenotIn('Users.type',[2,12])
            ->count();
        $expirefollowupToday=User::join('followups','users.id','=','followups.user_id')
            ->where('nextfollowup_date_fa','<',$dateNow)
            ->wherenotIn('Users.type',[2,12])
            ->count();

        return view('panelAdmin.home',compact('notFollowup','follow','cancel','student','dateNow','followupToday','expirefollowupToday'));
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
        //
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

    public function showCategoryUsers(Request $request)
    {
        $dateNow=$this->dateNow;
        switch ($request['categoryUsers'])
        {
            case '0': return redirect('/admin/users/');
                      break;
            case 'notfollowup': $users=User::where('type','=','1')
                            ->orderby('id','desc')
                            ->paginate(20);
                            break;
            case 'continuefollowup': $users=User::where('type','=','11')
                            ->orderby('id','desc')
                            ->paginate(20);
                            break;
            case 'cancelfollowup': $users=User::where('type','=','12')
                            ->orderby('id','desc')
                            ->paginate(20);
                            break;
            case 'students': $users=User::where('type','=','20')
                            ->orderby('id','desc')
                            ->paginate(20);
                            break;
            case 'todayFollowup': $users=User::join('followups','users.id','=','followups.user_id')
                            ->where('followups.nextfollowup_date_fa','=',$dateNow)
                            ->select('users.*')
                            ->orderby('date_fa','desc')
                            ->paginate(20);
                            break;
            case 'expireFollowup': $users=User::join('followups','users.id','=','followups.user_id')
                            ->where('followups.nextfollowup_date_fa','<',$dateNow)
                            ->wherenotIn('users.type',[2,12])
                            ->select('users.*')
                            ->orderby('date_fa','desc')
                            ->paginate(20);
                            break;

            default:return redirect('/admin/users/');
                    break;
        }

        $users->appends(['categoryUsers'=>$request['categoryUsers']]);
        return view('panelAdmin.users')
            ->with('users',$users);
    }

    public function searchUsers(Request $request)
    {

        $this->validate(request(),
            [
                'q'     =>'required|min:2|string'
            ],
            [
                'q.required'=>'برای جستجو یک مقدار وارد کنید'
            ]);

        $users=User::orwhere('fname','like','%'.$request['q'].'%')
                    ->orwhere('lname','like','%'.$request['q'].'%')
                    ->orwhere('tel','like','%'.$request['q'].'%')
                    ->orwhere('email','like','%'.$request['q'].'%')
                    ->orderby('id','desc')
                    ->paginate(20);
        $users->appends(['q' => $request['q']]);

        return view('panelAdmin.users')
                    ->with('users',$users);
    }

    public function showSettings()
    {
        $problemfollowup=problemfollowup::get();
        foreach ($problemfollowup as $item)
        {
            if($item->status==1)
            {
                $item->status="نمایش";
            }
            elseif ($item->status==0)
            {
                $item->status="عدم نمایش";
            }
        }
        return view('panelAdmin.settings')
                    ->with('problemfollowup',$problemfollowup);
    }

}
