<?php

namespace App\Http\Controllers;

use App\ExamQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamQuestionController extends BaseController
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ExamQuestion  $examQuestion
     * @return \Illuminate\Http\Response
     */
    public function show(ExamQuestion $examQuestion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ExamQuestion  $examQuestion
     * @return \Illuminate\Http\Response
     */
    public function edit(ExamQuestion $examQuestion)
    {
        return view('admin.Exams.ExamQuestion_edit')
                        ->with('examQuestion',$examQuestion);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ExamQuestion  $examQuestion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExamQuestion $examQuestion)
    {

        $this->validate($request,
            [
                'title'     =>'required|string|max:200',
                'answer1'   =>'required|string|max:200',
                'answer2'   =>'required|string|max:200',
                'answer3'   =>'required|string|max:200',
                'answer4'   =>'required|string|max:200',
                'correct'   =>'required|numeric|between:1,4',
                'score'     =>'required|numeric|between:0,100',
            ]);

        $question=$examQuestion->update(
            [
                'title'          =>$request->title,
                'score'          =>$request->score,
                'user_id'        =>Auth::user()->id,
            ]);

        $loop=1;
        foreach ($examQuestion->answers as $answer)
        {
            $tmp="answer".$loop;

            $answer->update(
                [
                    'title'          =>$request->$tmp,
                    'is_correct'     =>NULL,
                ]);
            if($request->correct == $loop)
            {
                $answer->update([
                    'is_correct'     =>1,
                ]);
            }
            $loop++;
        }


        alert()->success('سوال با موفقیت بروزرسانی شد')->persistent('بستن');


        return back();




    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ExamQuestion  $examQuestion
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExamQuestion $examQuestion)
    {
        $status=$examQuestion->delete();
        if($status)
        {
            alert()->success('سوال با موفقیت حذف شد')->persistent('بستن');
        }
        else
        {
            alert()->error('خطا در حذف کرن سوال')->persistent('بستن');
        }

        return back();
    }
}
