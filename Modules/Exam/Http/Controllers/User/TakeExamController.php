<?php

namespace Modules\Exam\Http\Controllers\User;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Exam\Entities\TakeExam;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class TakeExamController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $takeExams=TakeExam::where('user_id',Auth::user()->id)
                    ->get();

        return view('exam::user.takeExam.takeExams_all')
                            ->with('takeExams',$takeExams);
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
    public function edit(TakeExam $takeExam)
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

    //CCE Certificates
    public function get_certificate_CCE(Request $request,TakeExam $takeExam)
    {
        if($takeExam->status==2 && $takeExam->user_id==Auth::user()->id)
        {

            if (is_null(Auth::user()->fname_en) || is_null(Auth::user()->lname_en)) {
                alert()->error('نام و نام خانوادگی خود را به انگلیسی در پروفایل وارد کنید')->persistent('بستن');
                return redirect('/panel/profile');
            }


            ini_set('max_execution_time', 0);




            $pdf=Pdf::loadView('user.blank-certificates.icf_scholarship', [],[],[
                'format'    =>[900,655],

            ]);



            $fileName=time().'_.pdf';

            $pdf->allow_charset_conversion=false;  // Set by default to TRUE


            $pdf->charset_in='UTF-8';

            $pdf->save($fileName);

            return response()->download(public_path($fileName))
                ->deleteFileAfterSend(true);
        }
        else
        {
            alert()->error('برای شما مدرکی صادر نشده است')->persistent('بستن');
            return back();
        }

    }

}
