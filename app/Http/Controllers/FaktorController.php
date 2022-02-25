<?php

namespace App\Http\Controllers;

use App\faktor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FaktorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faktors=faktor::where('user_id','=',Auth::user()->id)
                    ->get();

        return view('user.financial.listFaktors')
                        ->with('faktors',$faktors);
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
     * @param  \App\faktor  $faktor
     * @return \Illuminate\Http\Response
     */
    public function show(faktor $faktor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\faktor  $faktor
     * @return \Illuminate\Http\Response
     */
    public function edit(faktor $faktor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\faktor  $faktor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, faktor $faktor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\faktor  $faktor
     * @return \Illuminate\Http\Response
     */
    public function destroy(faktor $faktor)
    {
        //
    }
}
