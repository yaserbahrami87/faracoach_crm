<?php

namespace App\Http\Controllers;

use App\warrany;
use Illuminate\Http\Request;

class WarranyController extends Controller
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

        $this->validate($request,[
            'shomare_zemanat'   =>'nullable|string|',
            'tarikh_zemanat'    =>'nullable|string|max:20',
            'bak_zemanat'       =>'nullable|string',
            'fi_zemanat'        =>'nullable|numeric',
        ]);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\warrany  $warrany
     * @return \Illuminate\Http\Response
     */
    public function show(warrany $warrany)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\warrany  $warrany
     * @return \Illuminate\Http\Response
     */
    public function edit(warrany $warrany)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\warrany  $warrany
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, warrany $warrany)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\warrany  $warrany
     * @return \Illuminate\Http\Response
     */
    public function destroy(warrany $warrany)
    {
        //
    }
}
