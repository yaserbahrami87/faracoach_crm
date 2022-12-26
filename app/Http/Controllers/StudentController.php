<?php

namespace App\Http\Controllers;

use App\student;
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

        $students=student::get();

        $course=$this->get_courses();

        return view('admin.students')
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

        $this->validate($request,[
            'course_id' =>'required|numeric',
            'user_id'   =>'required|numeric',
            'date_fa'   =>'nullable|string',
            'status'    =>'required|numeric',
        ]);
        $student=student::where('user_id','=',$request->user_id)
                        ->where('course_id','=',$request->course_id)
                        ->first();

        if(is_null($student)) {
            $status = student::create($request->all());
            if ($status) {
                alert()->success('کاربر مورد نظر به لیست دانشجوها اضافه شد')->persistent('بستن');
            } else {
                alert()->error('خطا در اضافه کردن دانشجو')->persistent('بستن');
            }
        }
        else
        {
            alert()->error('کاربر در لیست دانشجوهای دوره وجود دارد')->persistent('بستن');
        }

        return redirect('/admin/courses');
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
     * @param  int  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(student $student)
    {
        $status=$student->delete();
        if($status)
        {
            alert()->success('دانشجو با موفقیت از دوره حذف شد')->persistent('بستن');
        }
        else
        {
            alert()->error('خطا در حذف دانشجو')->persistent('بستن');
        }
        return back();
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

        return view('admin.students')
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

        return view('admin.students')
            ->with('students',$students)
            ->with('course',$course);
    }



}
