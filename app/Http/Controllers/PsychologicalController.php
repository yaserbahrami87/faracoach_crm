<?php

namespace App\Http\Controllers;

use App\psychological;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PsychologicalController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $psychological=psychological::join('users','psychologicals.user_id','=','users.id')
                        ->orderby('psychologicals.id','desc')
                        ->select('psychologicals.*','users.fname','users.lname')
                        ->get();
        return view('panelAdmin.PsychologicalPsychiatry_list')
                    ->with('psychological',$psychological);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panelUser.PsychologicalPsychiatry_test');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result=[];
        for($i=1;$i<=54;$i++)
        {
            $tmp="vehicle".$i;
            array_push($result,$request->$tmp);
        }

        $status=psychological::create([
            'user_id'   =>Auth::user()->id,
            'result'    =>implode(",", $result),
        ]);

        if($status)
        {
            alert()->success('اطلاعات با موفقیت در سیستم ثبت شد')->persistent('بستن');
        }
        else
        {
            alert()->error('خطا در ثبت سیستم')->persistent('بستن');
        }

        return redirect('/panel');



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\psychological  $psychological
     * @return \Illuminate\Http\Response
     */
    public function show(psychological $psychological)
    {
        $psychological=psychological::join('users','psychologicals.user_id','=','users.id')
            ->where('psychologicals.id','=',$psychological->id)
            ->orderby('psychologicals.id','desc')
            ->select('psychologicals.*','users.fname','users.lname')
            ->first();

        $psychological['result']=explode(',',$psychological->result);

        return view('panelAdmin.psychological_result')
                        ->with('psychological',$psychological);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\psychological  $psychological
     * @return \Illuminate\Http\Response
     */
    public function edit(psychological $psychological)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\psychological  $psychological
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, psychological $psychological)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\psychological  $psychological
     * @return \Illuminate\Http\Response
     */
    public function destroy(psychological $psychological)
    {
        //
    }

    public function export_excel(psychological $psychological)
    {
        return $psychological->user;
//        return psychological::find($psychological->id)->user;
    }
}
