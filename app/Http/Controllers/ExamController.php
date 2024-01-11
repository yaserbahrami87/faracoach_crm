<?php

namespace App\Http\Controllers;

use App\certificate;
use App\Exam;
use App\ExamQuestion;
use App\ExamResult;
use App\Notifications\sendMessageNotification;
use App\TakeExam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Exams=Exam::get();
        return view('admin.Exams.Exams')
                    ->with('Exams',$Exams);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Certificates=certificate::where('status',1)
                        ->get();
        return view('admin.Exams.Exam_insert')
                    ->with('Certificates',$Certificates);
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
     * Display the specified resource.
     *
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function show(Exam $exam)
    {
        if(Auth::user()->takeExams->where('exam_id',$exam->id)->count()==0)
        {
            return view('user.Exams.Exam')
                ->with('exam',$exam);
        }
        else
        {
            alert()->error('شما قبلا در این آزمون شرکت کرده اید و اجازه شرکت مجدد ندارید')->persistent('بستن');
            return redirect('/panel');
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function edit(Exam $exam)
    {
        $Certificates =certificate::where('status',1)
                        ->get();
        return view('admin.Exams.Exam_edit')
                    ->with('Certificates',$Certificates )
                    ->with('Exam',$exam);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Exam $exam)
    {
        $this->validate($request,[
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
     *
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
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
        return view('admin.Exams.ExamQuestions')
                        ->with('exam',$exam);
    }

    public function ExamQuetions_create (Exam $exam)
    {
        return view('admin.Exams.ExamQuestion_insert')
                    ->with('exam',$exam);

    }

    public function ExamQuetions_store(Request $request,Exam $exam)
    {
        $this->validate($request,
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
               'date_fa'        =>$this->dateNow,
               'time_fa'        =>$this->timeNow,

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


    public function answer_store(Request $request,Exam $exam)
    {
        $score=0;
        foreach ($request->all() as $key=>$answer)
        {
            if(str_starts_with($key,'answer'))
            {
                $question=ExamQuestion::where('id',str_replace('answer','',$key))
                                ->first();

                $answerQuestion=ExamQuestion::where('id',$answer)
                                                ->first();


                if($answerQuestion->is_correct==1)
                {
                    $score+=$question->score;
                }

                if(!is_null($answerQuestion))
                {
                    Auth::user()->examResult_insert()->create([
                        'exam_question_id'  =>$question->id,
                        'result_id'         =>$answer,
                        'date_fa'           =>$this->dateNow,
                        'time_fa'           =>$this->timeNow,
                        'exam_id'           =>$exam->id,
                    ]);
                }
            }
        }

        if($score>=$exam->pass)
        {
            $statusExam=1;
            $status_msg="قبول";
        }
        else
        {
            $statusExam=0;
            $status_msg="رد";
        }

        $takeExam=Auth::user()->takeExams()->create(
            [
                'exam_id'   =>$exam->id,
                'score'     =>$score,
                'status'    =>$statusExam,
                'date_fa'   =>$this->dateNow,
                'time_fa'   =>$this->timeNow,
            ]
        );

        if($statusExam)
        {

            $msg=Auth::user()->fname.' '.Auth::user()->lname." عزیز "."\n"."نتیجه آزمون شما: $score "."\n"."وضعیت: $status_msg"." گواهینامه شما به زودی صادر و قابل دانلود خواهد بود. "."\n"."آکادمی بین المللی فراکوچ";


            Auth::user()->notify(new sendMessageNotification(Auth::user()->tel,$msg));
            alert()->success('نمر شما در آزمون '.$score.'تبریک ! شما در آزمون قبول شدید.به زودی گواهینامه شما صادر و قابل دانلود خواهد بود.پیامک اطلاع رسانی برای شما ارسال خواهد شد.')->persistent('بستن');
        }
        else
        {
            $msg=Auth::user()->fname.' '.Auth::user()->lname." عزیز "."\n"."نتیجه آزمون شما: $score "."\n"."وضعیت: $status_msg"."\n"."آکادمی بین المللی فراکوچ";
            Auth::user()->notify(new sendMessageNotification(Auth::user()->tel,$msg));
            alert()->warning('نمر شما در آزمون '.$score.' می باشد. متاسفانه شما حداقل نمره قبولی در آزمون رو کسب نکردید')->persistent('بستن');
        }


        return redirect('/panel');
    }
}
