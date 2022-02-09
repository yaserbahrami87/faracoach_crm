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
        $users=landPage::where('resource','=','سالگرد')
                    ->orderby('id','desc')
                    ->get();

        $count=$users->count();

        return view('landings.jashn_list')
                ->with('count',$count)
                ->with('users',$users);
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
            $introduced=landPage::where('id','=',$request->q)
                    ->where('resource','=','سالگرد')
                    ->first();
            if(!is_null($introduced))
            {
                $introduced=$request->q;
            }
            else
            {
                $introduced=NULL;
                alert()->error('کاربر معرف شما نامعتبر است')->persistent('بستن');

            }

        }
        else
        {
            $introduced=NULL;
        }
        return  view('jashn')
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
        $user=landPage::where('tel','=',$request['tel'])
                    ->where('resource','=',$request->resource)
                    ->first();
        if(is_null($user)) {
            $this->validate($request, [
                'fname' => 'nullable|string|max:15',
                'lname' => 'nullable|string|max:50',
                'email' => 'nullable|email',
                'tel' => 'required|iran_mobile',
                'resource' => 'required|string',
                'introduced' => 'nullable|numeric',
            ]);

            $status = landPage::create($request->all());
            if ($status) {
                if ($request->resource == 'وبینار تمامیت') {
                    $introduced=landPage::where('id','=',$request->introduced)
                                    ->where('resource','=','سالگرد')
                                    ->first();

                    $msg = $request->lname . " عزیز \nاطلاعات شما با موفقیت ثبت شد.\n" . "با توجه به تکمیل ظرفیت وبینار، ویدئوی ضبط شده وبینار در اختیار شما قرار خواهد گرفت.\n" . "\n نام کاربری و رمز متعاقبا ارسال خواهد شد." . "\n" . "فراکوچ";
                    $this->sendSms($request->tel, $msg);


                    alert()->success($request->lname . " عزیز \nاطلاعات شما با موفقیت ثبت شد.\n" . "با توجه به تکمیل ظرفیت وبینار، ویدئوی ضبط شده وبینار در اختیار شما قرار خواهد گرفت.\n" . "\n نام کاربری و رمز متعاقبا ارسال خواهد شد.")->persistent("بستن");
                    return back();
                } else if ($request->resource == 'سالگرد') {
                    $msg = $request->fname . " " . $request->lname . " عزیز \n تبریک نام شما در لیست قرعه کشی هدایای سالگرد فراکوچ ثبت شد\n برای تایید نهایی سایر مراحل را انجام دهید"."\n لینک معرفی اختصاصی شما:"."\n".asset('/jashn?q='.$status->id."\n جهت استفاده در شبکه های اجتماعی ، بایو و استوری اینستاگرام ");
                    $this->sendSms($request['tel'], $msg);
                    $msg="تبریک ".$request->fname.' '.$request->lname." توسط لینک شما در قرعه کشی فراکوچ ثبت نام کرد \n "."شانس شما بیشتر شد";
                    $this->sendSms($status->introduce['tel'],$msg);
                    return view('landings.jashn_return')
                        ->with('user', $status);
                } else {
                    alert()->success("ثبت نام شما با موفقیت انجام شد")->persistent("بستن");
                }

            } else {
                alert()->error('خطا در ثبت نام ' . $request->resource)->persistent('بستن');;
            }
        }
        else
        {
            return view('landings.jashn_return')
                ->with('user', $user);
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
//            if(!is_null($request->count))
//            {
//                $msg=$landPage->lname." عزیز \n".'میزبان شما و '.$request->count." میهمان ارزشمندتان در 'وبینار تمامیت' خواهیم بود\n"."لینک وبینار متعاقبا ارسال خواهد شد\n"."لینک اختصاصی جهت معرفی میهمانان: \n".asset('/integrity?q='.$landPage->id)."\n فراکوچ-مدیران ایران ";
//            }
//            else
//            {
//                $msg=$landPage->lname." عزیز \n".'میزبان شما و میهمان ارزشمندتان در "وبینار تمامیت" خواهیم بود'."لینک وبینار متعاقبا ارسال خواهد شد\n"."لینک اختصاصی جهت معرفی میهمانان: \n".asset('/integrity?q='.$landPage->id)."\n فراکوچ-مدیران ایران ";
//            }


            $msg=$landPage->fname.' '.$landPage->lname."عزیز \n"."درخواست شما ثبت شد\n پس از تایید اقدامات در لیست نهایی قرار می گیرید";


            $this->sendSms($landPage->tel,$msg);
            alert()->success($msg)->persistent("بستن");
        }
        else
        {
            alert()->error('خطا در ثبت اطلاعات')->persistent('بستن');
        }
        return redirect('/jashn');
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
