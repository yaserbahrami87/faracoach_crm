<?php

namespace Modules\Exam\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Exam\Entities\TakeExam;

class TakeExamController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $takeExams=TakeExam::orderby('id','desc')
            ->get();

        return view('exam::admin.takeExam.takeExams')
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
    public function show(TakeExam $takeExam)
    {
        return view('exam::admin.takeExam.takeExam_show')
            ->with('takeExam',$takeExam);
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
    public function update(Request $request, TakeExam $takeExam)
    {

        $request->validate(
            [
            'status'    =>'required|numeric|between:0,2'
        ]);

        $status=$takeExam->update($request->all());
        if($status)
        {
            alert()->success('وضعیت آزمون با موفقیت تغییر کرد')->persistent('بستن');
        }
        else
        {
            alert()->error('خطا در تغییر وضعیت آزمون')->persistent('بستن');
        }

        return back();
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
}
