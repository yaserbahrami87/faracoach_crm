<?php

namespace Modules\Exam\Http\Controllers;


use App\Notifications\sendMessageNotification;
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

    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Exam $exam)
    {

    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Exam $exam)
    {




    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param \Modules\Exam\Entities\Exam $exam
     * @return Renderable
     */
    public function update(Request $request,Exam $exam)
    {

    }

    /**
     * Remove the specified resource from storage.
     * @param \Modules\Exam\Entities\Exam $exam
     * @return Renderable
     */
    public function destroy(Exam $exam)
    {

    }







}
