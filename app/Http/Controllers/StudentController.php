<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class StudentController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $students=User::join('followups','users.id','=','followups.user_id')
            ->join('courses','followups.course_id','=','courses.id')
            ->where('followups.status_followups','=','20')
            ->select('users.*','courses.course')
            ->orderby('followups.id','desc')
            ->groupby('followups.user_id')
            ->paginate(32);

        $course=$this->get_courses();

        return view('panelAdmin.students')
            ->with('course',$course)
            ->with('students',$students);

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

    public function search(Request $request)
    {
        $this->validate($request,[
            'q' =>'required|string'
        ]);

        $students=User::join('followups','users.id','=','followups.user_id')
            ->join('courses','followups.course_id','=','courses.id')
            ->where('followups.status_followups','=','20')
            ->where(function($query) use ($request)
            {
                $query->orwhere('users.fname','like','%'.$request->q.'%')
                        ->orwhere('users.lname','like','%'.$request->q.'%')
                        ->orwhere('users.tel','like','%'.$request->q.'%');
            })
            ->select('users.*','courses.course')
            ->orderby('followups.id','desc')
            ->groupby('followups.user_id')
            ->paginate(32);

        $course=$this->get_courses();

        return view('panelAdmin.students')
                ->with('students',$students)
                ->with('course',$course);
    }

    public function advancesearch(Request $request)
    {
        $this->validate($request,[
            'course' =>'nullable|integer'
        ]);

        $students=User::join('followups','users.id','=','followups.user_id')
            ->join('courses','followups.course_id','=','courses.id')
            ->where('followups.status_followups','=','20')
            ->where('followups.course_id','=',$request->course)
            ->select('users.*','courses.course')
            ->orderby('followups.id','desc')
            ->groupby('followups.user_id')
            ->paginate(32);

        $course=$this->get_courses();

        return view('panelAdmin.students')
            ->with('students',$students)
            ->with('course',$course);
    }
}