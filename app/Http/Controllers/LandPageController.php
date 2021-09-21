<?php

namespace App\Http\Controllers;

use App\landPage;
use Illuminate\Http\Request;

class LandPageController extends BaseController
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
    public function create(Request $request)
    {
        if(is_numeric($request->q) )
        {
            $introduced=$request->q;
        }
        else
        {
            $introduced=NULL;
//            alert()->error('لینک معرف شما نادرست است')->persistent('بستن');
        }
        return  view('landeTamamiat')
                    ->with('introduced',$introduced);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['tel']=$this->convertPersianNumber($request->tel);

        $this->validate($request,[
            'fname'     =>'string|max:15|required',
            'lname'     =>'string|max:50|required',
            'email'     =>'required|email',
            'tel'       =>'required|iran_mobile',
            'resource'  =>'required|string',
            'introduced'=>'nullable|numeric',
        ]);

        $status=landPage::create($request->all());
        if($status)
        {
            if($request->resource=='وبینار تمامیت')
            {
                $msg=$request->lname ." عزیز \nمرحله اول رزرو در 'وبینار تمامیت' با موفقیت انجام شد.\n"."لطفا مرحله دوم را تکمیل نمایید\n"."\n"."مدیران ایران -فراکوچ";
                $this->sendSms($request->tel,$msg);
                return view('landTamamiat_return')
                            ->with('land',$status);
            }
            else
            {
                alert()->success("ثبت نام شما با موفقیت انجام شد")->persistent("بستن");
            }

        }
        else
        {
            alert()->error('خطا در ثبت نام '.$request->resource)->persistent('بستن');;
        }

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\landPage  $landPage
     * @return \Illuminate\Http\Response
     */
    public function show(landPage $landPage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\landPage  $landPage
     * @return \Illuminate\Http\Response
     */
    public function edit(landPage $landPage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\landPage  $landPage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, landPage $landPage)
    {

        $this->validate($request,[
            'options'   =>'required|array'
        ]);

        $request['options']=implode(',',$request->options);
        $status=$landPage->update($request->all());
        if($status)
        {
            if(!is_null($request->count))
            {
                $msg=$landPage->lname." عزیز \n".'میزبان شما و '.$request->count." میهمان ارزشمندتان در 'وبینار تمامیت' خواهیم بود\n"."لینک وبینار متعاقبا ارسال خواهد شد\n"."لینک اختصاصی جهت معرفی میهمانان: \n".asset('/integrity?q='.$landPage->id)."\n فراکوچ-مدیران ایران ";
            }
            else
            {
                $msg=$landPage->lname." عزیز \n".'میزبان شما و میهمان ارزشمندتان در "وبینار تمامیت" خواهیم بود'."لینک وبینار متعاقبا ارسال خواهد شد\n"."لینک اختصاصی جهت معرفی میهمانان: \n".asset('/integrity?q='.$landPage->id)."\n فراکوچ-مدیران ایران ";
            }


            $this->sendSms($landPage->tel,$msg);
            alert()->success("رزرو وبینار شما با موفقیت انجام شد\n یک روز قبل از وبینار لینک وبینار برای شما ارسال میگردد.")->persistent("بستن");
        }
        else
        {
            alert()->error('خطا در ثبت اطلاعات')->persistent('بستن');
        }
        return redirect('/integrity');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\landPage  $landPage
     * @return \Illuminate\Http\Response
     */
    public function destroy(landPage $landPage)
    {
        //
    }
}
