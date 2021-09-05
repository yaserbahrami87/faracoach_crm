<?php

namespace App\Http\Controllers;

use App\category_gettingknow;
use Illuminate\Http\Request;

class CategoryGettingknowController extends Controller
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
        return view('panelAdmin.insertCategoryGettingknow');
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
            'category'  =>'required|string',
            'status'    =>'required|boolean',
        ]);

        $status=category_gettingknow::where('category','=',$request['category'])
                            ->first();
        if($status)
        {
            alert()->error('این دسته بندی تکراری است')->persistent('بستن');
            return back();
        }
        else
        {
            $status=category_gettingknow::create($request->all());
            if($status)
            {
                alert()->success('دسته بندی ثبت شد')->persistent('بستن');
                return redirect('/admin/settings/');
            }
            else
            {
                alert()->error('خطا در ثبت دسته بندی')->persistent('بستن');
                return back();
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\category_gettingknow  $category_gettingknow
     * @return \Illuminate\Http\Response
     */
    public function show(category_gettingknow $category_gettingknow)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\category_gettingknow  $category_gettingknow
     * @return \Illuminate\Http\Response
     */
    public function edit(category_gettingknow $category_gettingknow)
    {
        return view('panelAdmin.editCategoryGettingknow')
                        ->with('category_gettingknow',$category_gettingknow);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\category_gettingknow  $category_gettingknow
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, category_gettingknow $category_gettingknow)
    {
        $this->validate($request,[
            'category'  =>'required|string',
            'status'    =>'required|boolean',
        ]);

        $status=category_gettingknow::where('category','=',$request['category'])
            ->where('id','<>',$category_gettingknow->id)
            ->first();
        if($status)
        {
            alert()->error('این دسته بندی تکراری است')->persistent('بستن');
            return back();
        }
        else
        {
            $status=$category_gettingknow->update($request->all());
            if($status)
            {
                alert()->success('دسته بندی بروزرسانی شد')->persistent('بستن');
                return redirect('/admin/settings/');
            }
            else
            {
                alert()->error('خطا در بروزرسانی دسته بندی')->persistent('بستن');
                return back();
            }
        }



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\category_gettingknow  $category_gettingknow
     * @return \Illuminate\Http\Response
     */
    public function destroy(category_gettingknow $category_gettingknow)
    {
        $status=$category_gettingknow->delete();
        if($status)
        {
            alert()->success('دسته بندی با موفقیت حذف شد','پیام')->persistent('بستن');
        }
        else
        {
            alert()->error('خطا در حذف دسته بندی','خطا')->persistent('بستن');
        }

        return back();
    }
}
