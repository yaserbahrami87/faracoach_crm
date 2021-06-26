<?php

namespace App\Http\Controllers;

use App\course;
use Illuminate\Http\Request;
use Throwable;

class CourseController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $courses=course::orderby('id','desc')
                    ->get();
        foreach ($courses as $item)
        {
            $item->teacher_id=$this->get_teachersById($item->teacher_id)->fname." ".$this->get_teachersById($item->teacher_id)->lname;

        }
        return view('panelAdmin.courses')
                    ->with('courses',$courses);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teachers=$this->get_teachers();
        $courseType=$this->get_courseType();
        return view('panelAdmin.insertCourse')
                    ->with('teachers',$teachers)
                    ->with('courseType',$courseType);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'course'                => ['required','string','max:250'],
            'shortlink'             => ['required','string','max:250','unique:courses'],
            'teacher'               => ['required', 'numeric'],
            'image'                 => ['required','mimes:jpeg,jpg,png','max:600'],
            'type'                  => ['required', 'numeric'],
            'duration'              => ['nullable', 'numeric'],
            'duration_date'         => ['nullable', 'string','max:20'],
            'count_students'        => ['nullable', 'numeric'],
            'coaches'               => ['nullable', 'numeric'],
            'coachingbycoach'       => ['nullable', 'numeric'],
            'coachingbyreference'   => ['nullable', 'numeric'],
            'intership'             => ['nullable', 'numeric'],
            'start'                 => ['required', 'min:9'],
            'end'                   => ['nullable', 'min:9'],
            'course_days'           => ['nullable', 'string'],
            'course_times'          => ['nullable', 'string'],
            'exam'                  => ['nullable', 'string','min:9'],
            'certificate'           => ['nullable', 'string'],
            'fi'                    => ['nullable', 'numeric'],
            'fi_off'                => ['nullable', 'numeric'],
            'type_peymant_id'       => ['nullable','numeric'],
            'infocourse'            => ['nullable', 'string'],

        ]);
        $file=$request->file('image');
        $image="course-".time().".".$request->file('image')->extension();
        $path=public_path('/documents/');
        $files=$request->file('image')->move($path, $image);

        $status = course::create($request->all()+[
                'teacher_id'                 => $request['teacher'],
                'image'                      => $image,
            ]);
        if($status) {
            $msg = "دوره ما با موفقیت ثبت شد";
            $errorStatus = "success";
        }
        else
        {
            $msg = "خطا در ثبت دوره";
            $errorStatus = "success";
        }
        return back()->with('msg',$msg)
                     ->with('errorStatus',$errorStatus);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(course $course)
    {
        $teachers=$this->get_teachers();
        $courseType=$this->get_courseType();
        return view('panelAdmin.editCourse')
                    ->with('course',$course)
                    ->with('teachers',$teachers)
                    ->with('courseType',$courseType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, course $course)
    {

        $this->validate($request, [
            'course'                => ['required','string','max:250'],
            'shortlink'             => ['required','string','max:250'],
            'teacher'               => ['required', 'numeric'],
            'image'                 => ['nullable','mimes:jpeg,jpg,png','max:600'],
            'type'                  => ['required', 'numeric'],
            'duration'              => ['nullable', 'numeric'],
            'duration_date'         => ['nullable', 'string','max:20'],
            'count_students'        => ['nullable', 'numeric'],
            'coaches'               => ['nullable', 'numeric'],
            'coachingbycoach'       => ['nullable', 'numeric'],
            'coachingbyreference'   => ['nullable', 'numeric'],
            'intership'             => ['nullable', 'numeric'],
            'start'                 => ['required', 'min:9'],
            'end'                   => ['nullable', 'min:9'],
            'course_days'           => ['nullable', 'string'],
            'course_times'          => ['nullable', 'string'],
            'exam'                  => ['nullable', 'string','min:9'],
            'certificate'           => ['nullable', 'string'],
            'fi'                    => ['nullable', 'numeric'],
            'fi_off'                => ['nullable', 'numeric'],
            'type_peymant_id'       => ['nullable','numeric'],
            'infocourse'            => ['nullable', 'string'],
        ]);


        if ($request->has('image') && $request->file('image')->isValid()) {
            $file = $request->file('image');
            $image = "course-" . time() . "." . $request->file('image')->extension();
            $path = public_path('/documents/');
            $files = $request->file('image')->move($path, $image);
        }


        try {
            $status=$course->update($request->all());
        } catch (Throwable $e) {
            $msg = "شورتکد تکراری می باشد";
            $errorStatus = "danger";
            return back()->with('msg', $msg)
                ->with('errorStatus', $errorStatus);
        }

        if($status)
        {
            if (isset($image)) {
                $course->image = $image;
            }
            $status=$course->save();
            if($status) {
                $msg = "دوره با موفقیت به روزرسانی شد";
                $errorStatus = "success";
            }
            else
            {
                $msg = "خطا در بروزرسانی";
                $errorStatus = "success";
            }
        }
        else
        {
            {
                $msg = "خطا در بروزرسانی";
                $errorStatus = "danger";
            }
        }

        return redirect('/admin/courses')->with('msg', $msg)
            ->with('errorStatus', $errorStatus);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(course $course)
    {
        //
    }
}
