<?php

namespace App\Http\Controllers;

use App\certificate;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
     * @param  \App\certificate  $certificate
     * @return \Illuminate\Http\Response
     */
    public function show(certificate $certificate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\certificate  $certificate
     * @return \Illuminate\Http\Response
     */
    public function edit(certificate $certificate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\certificate  $certificate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, certificate $certificate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\certificate  $certificate
     * @return \Illuminate\Http\Response
     */
    public function destroy(certificate $certificate)
    {
        //
    }


    public function get_certificate()
    {
        if(Auth::user()->scholarship->confirm_exam==1 && Auth::user()->scholarship->confirm_webinar==1 )
        {


            if (is_null(Auth::user()->fname_en) || is_null(Auth::user()->lname_en)) {
                alert()->error('نام و نام خانوادگی خود را به انگلیسی در پروفایل وارد کنید')->persistent('بستن');
                return redirect('/panel/profile');
            }

            ini_set('max_execution_time', 0);


//        Pdf::setOption(['dpi' => 300])->loadView('user.blank-certificates.level1')->setPaper('a4', 'landscape')->save(Auth::user()->id.'.pdf');
            Pdf::setOption(['dpi' => 300, 'fontDir' => storage_path('/fonts'), 'font_cache' => storage_path('fontsCache/')])->loadView('user.blank-certificates.icf_scholarship')->setPaper('a4', 'landscape')->save(Auth::user()->id . '.pdf');
            return response()->download(public_path(Auth::user()->id.'.pdf'))
                        ->deleteFileAfterSend(true);
//            return view('user.blank-certificates.icf_scholarship');
        }
        else
        {
            alert()->error('برای شما مدرکی صادر نشده است')->persistent('بستن');
            return back();
        }

    }

    public function get_certificate1()
    {
        if(is_null(Auth::user()->fname_en)||is_null(Auth::user()->lname_en))
        {
            alert()->error('نام و نام خانوادگی خود را به انگلیسی در پروفایل وارد کنید')->persistent('بستن');
            return redirect('/panel/profile');
        }

        ini_set('max_execution_time', 0);


//        Pdf::setOption(['dpi' => 300])->loadView('user.blank-certificates.level1')->setPaper('a4', 'landscape')->save(Auth::user()->id.'.pdf');
        Pdf::setOption(['dpi' => 300,'fontDir'=>storage_path('/fonts'),'font_cache'=>storage_path('fontsCache/')])->loadView('user.blank-certificates.icf_scholarship')->setPaper('a4', 'landscape')->save(Auth::user()->id.'.pdf');
//        return response()->download(asset(Auth::user()->id.'.pdf'))
//                        ->deleteFileAfterSend(true);
        return view('user.blank-certificates.icf_scholarship');

    }
}
