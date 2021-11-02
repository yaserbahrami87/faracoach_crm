<?php

namespace App\Http\Controllers;

use App\event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('events');
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
        dd($request);
        $this->validate($request,[
            'event'         =>'required|persian_alpha_num|min:3',
            'shortlink'     =>'required|persian_alpha_num|min:3|,unique:users',
            'description'   =>'required|persian_alpha_num|min:3|',
            'capacity'      =>'required|numeric|',
            'image'         =>'required|mimes:jpeg,jpg,png,gif|max:1024',
            'video'         =>'nullable|string|min:3|',
            'start_date'    =>'required|string|max:11|',
            'start_time'    =>'required|string|max:6|',
            'end_date'      =>'required|string|max:11|',
            'end_time'      =>'required|string|max:6|',
            'expire_date'   =>'required|string|max:11|',
            'event_text'    =>'required|string|min:10|',
            'heading'       =>'nullable|string|min:10|',
            'contacts'      =>'nullable|string|min:10|',
            'faq'           =>'nullable|string|min:10|',
            'links'         =>'nullable|string|min:10|',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(event $event)
    {
        //
    }

    public function eventsListAdmin()
    {
        return view('panelAdmin.insertevent');
    }
}
