<?php

namespace Modules\Exam\Http\Controllers\Admin;


use App\Services\JalaliDateService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Exam\Entities\Certificate;
use Modules\Exam\Entities\Exam;


class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {

        $Exams=Exam::get();
            return view('exam::admin.exams.exams')
            ->with('Exams',$Exams);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $Certificates=Certificate::where('status',1)
            ->get();

        return view('exam::admin.exams.exam_Insert')
                        ->with('Certificates',$Certificates);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {

        $request->validate([
            'exam'          =>'required|string|max:200|unique:exams',
            'description'   =>'required|string|',
            'certificate_id'=>'nullable|numeric',
            'pass'          =>'required|numeric|between:0,100',
        ]);

        $status=Auth::user()->exam_insert()->create($request->all());

        if($status)
        {
            alert()->success('آزمون با موفقیت ایجاد شد.لطفا سوالات مربوط به آزمون را وارد کنید')->persistent('بستن');
        }
        else
        {
            alert()->error('خطا در ایجاد آزمون')->persistent('بستن');
        }

        return back();
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
    public function edit(Exam $exam)
    {
        $Certificates =certificate::where('status',1)
            ->get();
        return view('exam::admin.exams.exam_edit')
            ->with('Certificates',$Certificates )
            ->with('Exam',$exam);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request,Exam $exam)
    {
        $request->validate([
            'exam'          =>'required|string|max:200|unique:exams,exam,'.$exam->id,
            'description'   =>'required|string|',
            'certificate_id'=>'nullable|numeric',
            'pass'          =>'required|numeric|between:0,100',
        ]);
        $status=$exam->update($request->all());
        if($status)
        {
            alert()->success('آزمون با موفقیت به روزرسانی شد')->persistent('بستن');
        }
        else
        {
            alert()->error('خطا در بروزرسانی')->persistent('بستن');
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Exam $exam)
    {
        $status=$exam->delete();
        if($status)
        {
            alert()->success('آزمون با موفقیت حذف شد')->persistent('بستن');

        }
        else
        {
            alert()->error('خطا در حذف')->persistent('بستن');
        }

        return back();
    }

    public function ExamQuetions_show(Exam $exam)
    {

        return view('exam::admin.exams.examQuestions')
            ->with('exam',$exam);
    }

    public function ExamQuetions_create (Exam $exam)
    {
        return view('exam::admin.exams.examQuestion_Insert')
            ->with('exam',$exam);

    }

    public function ExamQuetions_store(Request $request,Exam $exam)
    {
        $request->validate(
            [
                'title'     =>'required|string',
                'answer1'   =>'required|string',
                'answer2'   =>'required|string',
                'answer3'   =>'required|string',
                'answer4'   =>'required|string',
                'correct'   =>'required|numeric|between:1,4',
                'score'     =>'required|numeric|between:0,100',
            ]);



        $question=Auth::user()->examQuestion_insert()->create(
            [
                'title'          =>$request->title,
                'is_question'    =>1,
                'score'          =>$request->score,
                'exam_id'        =>$exam->id,
                'date_fa'        =>JalaliDateService::getDate(),
                'time_fa'        =>JalaliDateService::getTime(),

            ]);


        $answer1=Auth::user()->examQuestion_insert()->create(
            [
                'title'          =>$request->answer1,
                'question_id'    =>$question->id,

            ]);
        $answer2=Auth::user()->examQuestion_insert()->create(
            [
                'title'          =>$request->answer2,
                'question_id'    =>$question->id,

            ]);
        $answer3=Auth::user()->examQuestion_insert()->create(
            [
                'title'          =>$request->answer3,
                'question_id'    =>$question->id,

            ]);
        $answer4=Auth::user()->examQuestion_insert()->create(
            [
                'title'          =>$request->answer4,
                'question_id'    =>$question->id,

            ]);



        if($request->correct==1)
        {
            $answer1->is_correct=1;
            $answer1->save();
        }
        elseif($request->correct==2)
        {
            $answer2->is_correct=1;
            $answer2->save();
        }
        elseif($request->correct==3)
        {
            $answer3->is_correct=1;
            $answer3->save();
        }
        elseif($request->correct==4)
        {
            $answer4->is_correct=1;
            $answer4->save();
        }

        if($answer1 && $answer2 && $answer3 && $answer4 && $question)
        {
            alert()->success('سوال با موفقیت به آزمون اضافه شد')->persistent('بستن');
        }
        else
        {
            alert()->error('خطا در ثبت آزمون');
        }

        return back();
    }
}
