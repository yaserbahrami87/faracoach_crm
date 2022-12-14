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

    //نمایش فاکتورها برای ادمین
    public function faktorAdmin(Request $request)
    {
        if($request->start_date)
        {
            $this->validate($request,[
                'start_date'    =>'required|string',
            ]);
            $request['start_date']=explode(' ~ ',$request['start_date']);
            $startMonth=$request['start_date'][0];
            $endtMonth=$request['start_date'][1];
        }
        else
        {
            $startMonth=verta();
            $startMonth=($startMonth->startYear())->format('Y/m/d');
            $endtMonth=verta();
            $endtMonth=($endtMonth->endMonth())->format('Y/m/d');

        }


        $faktors=faktor::orderby('id','desc')
                    ->wherebetween('date_faktor',[$startMonth,$endtMonth])
                    ->orderby('date_faktor','desc')
                    ->get();

        $faktorsExpire=faktor::wherebetween('date_faktor',[$startMonth,$endtMonth])
                            ->where('status','=','0')
                            ->orderby('date_faktor','desc')
                            ->get();

        $faktorsSuccess=faktor::wherebetween('date_faktor',[$startMonth,$endtMonth])
                            ->where('status','=','1')
                            ->orderby('date_faktor','desc')
                            ->get();

        return view('admin.financial.faktor-all')
                        ->with('faktorsExpire',$faktorsExpire)
                        ->with('faktorsSuccess',$faktorsSuccess)
                        ->with('faktors',$faktors);

    }
}
