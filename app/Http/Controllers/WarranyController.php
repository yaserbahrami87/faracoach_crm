<?php

namespace App\Http\Controllers;

use App\scholarship;
use App\warrany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class WarranyController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $warranies=warrany::get();

        return view('admin.warrany.warrany_list')
            ->with('warranies',$warranies);


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
            'signature_zemanat' =>'nullable|mimes:docx,doc,pdf,jpg,png|max:1024',
        ]);

        $warrany=warrany::create([
            'user_id'       =>Auth::user()->id,
            'product_id'    =>$request->product_id,
            'type'          =>$request->type,
            'receipt'       =>$request->shomare_zemanat,
            'date_fa'       =>$request->tarikh_zemanat,
            'fi'            =>$request->fi_zemanat,
            'bank'          =>$request->bak_zemanat,
        ]);

        $scholarship=scholarship::where('user_id','=',Auth::user()->id)
            ->first();

        if ($request->has('signature_zemanat') && $request->file('signature_zemanat')->isValid()) {
            $file = $request->file('signature_zemanat');
            $personal_image = "signature-scholarship-" . $scholarship->user->tel . "." . $request->file('signature_zemanat')->extension();
            $path = public_path('documents/signatures/');
            $files = $request->file('signature_zemanat')->move($path, $personal_image);
//            $img=Image::make($files->getRealPath());
//            $img->resize(350,350);
//            $img->save($path.'small-'.$personal_image);
            $warrany->signature = $personal_image;
            $warrany->save();
        }

        $scholarship->warrany_id=$warrany->id;
        $status=$scholarship->save();
        if($status)
        {
            $msg=$scholarship->user->fname.' '.$scholarship->user->lname." عزیز\n"."دزخواست تعهدنامه شما در سیستم ثبت شد";
            $this->sendSms($scholarship->user->tel,$msg);
            $msg=$scholarship->user->fname.' '.$scholarship->user->lname."درخواست تعهدنامه خود را درسیستم ثبت کرد";
            $this->sendSms('09153159020',$msg);
            alert()->success('تعهدنامه با موفقیت ذخیره شد')->persistent('بستن');
        }
        else
        {
            alert()->error('خطا در ثبت تعهدنامه')->persistent('بستن');
        }

        return back();






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
