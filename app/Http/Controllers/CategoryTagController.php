<?php

namespace App\Http\Controllers;

use App\categoryTag;
use Illuminate\Http\Request;

class CategoryTagController extends Controller
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

        $this->validate($request,
        [
            'category'  =>'required|persian_alpha|min:3',
            'status'    =>'required|numeric'
        ]);

        $status = categoryTag::create($request->all());
        if($status)
        {
            $msg="اطلاعات با موفقیت ذخیره شد";
            $errorStatus='success';
        }
        else
        {
            $msg="خطا در ذخیره";
            $errorStatus="danger";
        }
        return  back()
            ->with('msg',$msg)
            ->with('errorStatus',$errorStatus);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\categoryTag  $categoryTag
     * @return \Illuminate\Http\Response
     */
    public function show(categoryTag $categoryTag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\categoryTag  $categoryTag
     * @return \Illuminate\Http\Response
     */
    public function edit(categoryTag $categoryTag)
    {
        return view('panelAdmin.editCategoryTags')
                    ->with('categoryTag', $categoryTag);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\categoryTag  $categoryTag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, categoryTag $categoryTag)
    {

        $this->validate(request(),
            [
                'category'  =>'required|string|min:3|persian_alpha',
                'status'   =>'required|numeric'
            ]);

        $status=$categoryTag->update($request->all());
        if($status)
        {
            $msg="اطلاعات با موفقیت بروزرسانی  شد";
            $errorStatus='success';
        }
        else
        {
            $msg="خطا در بروزرسانی";
            $errorStatus="danger";
        }
        return  back()
            ->with('msg',$msg)
            ->with('errorStatus',$errorStatus);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\categoryTag  $categoryTag
     * @return \Illuminate\Http\Response
     */
    public function destroy(categoryTag $categoryTag)
    {
        $status=$categoryTag->delete();
        if($status)
        {
            $msg="اطلاعات با موفقیت حذف شد";
            $errorStatus="success";
        }
        else
        {
            $msg="خطا در ذخیره";
            $errorStatus="danger";
        }

        return back()->with('msg',$msg)
            ->with('errorStatus',$errorStatus);
    }
}
