<?php

namespace App\Http\Controllers;

use App\TakeExam;
use Illuminate\Http\Request;

class TakeExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $takeExams=TakeExam::orderby('id','desc')
                ->get();

        return view('admin.Exams.TakeExam.TakeExams')
                        ->with('takeExams',$takeExams);

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
     * @param  \App\TakeExam  $takeExam
     * @return \Illuminate\Http\Response
     */
    public function show(TakeExam $takeExam)
    {
        return view('admin.Exams.TakeExam.TakeExam_show')
                    ->with('takeExam',$takeExam);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TakeExam  $takeExam
     * @return \Illuminate\Http\Response
     */
    public function edit(TakeExam $takeExam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TakeExam  $takeExam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TakeExam $takeExam)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TakeExam  $takeExam
     * @return \Illuminate\Http\Response
     */
    public function destroy(TakeExam $takeExam)
    {
        //
    }
}
