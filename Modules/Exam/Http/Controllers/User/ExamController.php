<?php

namespace Modules\Exam\Http\Controllers\User;

use App\Notifications\sendMessageNotification;
use App\Services\JalaliDate;
use App\Services\JalaliDateService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Exam\Entities\Exam;
use Modules\Exam\Entities\ExamQuestion;

class ExamController extends Controller
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
    public function show(Exam $exam)
    {
        if(Auth::user()->takeExams->where('exam_id',$exam->id)->count()==0)
        {
            return view('exam::user.exams.exam')
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
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('exam::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }

    public function answer_store(Request $request,Exam $exam)
    {
        if(Auth::user()->takeExams->where('exam_id',$exam->id)->count()!=0)
        {
            alert()->error('شما قبلا در این آزمون شرکت کرده اید و اجازه شرکت مجدد ندارید')->persistent('بستن');
            return redirect('/panel');
        }


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
                        'date_fa'           =>JalaliDateService::getDate(),
                        'time_fa'           =>JalaliDateService::getTime(),
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
            $status_msg="عدم قبولی";
        }

        $takeExam=Auth::user()->takeExams()->create(
            [
                'exam_id'   =>$exam->id,
                'score'     =>$score,
                'status'    =>$statusExam,
                'date_fa'   =>JalaliDateService::getDate(),
                'time_fa'   =>JalaliDateService::getTime(),
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
            $msg=Auth::user()->fname.' '.Auth::user()->lname." عزیز "."\n"."نمره شما: $score "."\n"."وضعیت: $status_msg"."\n"."برای آزمون مجدد با پشتیبانی روابط عمومی ارتباط بگیرید."."\n"." 09197060068"."\n"."آکادمی بین المللی فراکوچ";
            Auth::user()->notify(new sendMessageNotification(Auth::user()->tel,$msg));
            alert()->warning('نمره شما: '.$score.' می باشد. متاسفانه شما حداقل نمره قبولی در آزمون را کسب نکرده اید.برای آزمون مجدد با پشتیبانی روابط عمومی ارتباط بگیرید.09197060068')->persistent('بستن');
        }


        return redirect('/panel');
    }
}
