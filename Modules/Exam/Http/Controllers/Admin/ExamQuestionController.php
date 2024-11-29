<?php

namespace Modules\Exam\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Exam\Entities\ExamQuestion;

class ExamQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('exam::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('exam::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('exam::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(ExamQuestion $examQuestion)
    {
        return view('exam::admin.exams.examQuestion_edit')
                        ->with('examQuestion',$examQuestion);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, ExamQuestion $examQuestion)
    {
        $request->validate(
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
     * @param int $id
     * @return Renderable
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
