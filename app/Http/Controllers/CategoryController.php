<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories=Category::where('status',1)
                    ->get();
        return view('admin.categories.categories')
                        ->with('categories',$categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.category-insert');
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
            'category'  =>'required|unique:categories,category',
            'type'      =>'required|in:product',
            'status'    =>'required|boolean',
        ]);

        $category=Category::create($request->all());
        if($category)
        {
            alert()->success('دسته بندی با موفقیت ارسال شد')->persistent('بستن');
        }
        else
        {
            alert()->error('خطا در ایجاد دسته بندی')->persistent('بستن');
        }

        return back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.categories.category-edit')
                            ->with('category',$category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $this->validate($request,[
            'category'  =>'required|unique:categories,category,'.$category->id,
            'type'      =>'required|in:product|',
            'status'    =>'required|boolean',
        ]);

        $status=$category->update($request->all());
        if($status)
        {
            alert()->success('بروزرسانی با موفقیت بروز شد')->persistent('بستن');
        }
        else
        {
            alert()->error('خطا در بروزرسانی')->persistent('بستن');
        }

        return back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $status=$category->delete();
        if($status)
        {
            alert()->success('دسته با موفقیت حذف شد')->persistent('بستن');
        }
        else
        {
            alert()->error('خطا در بروزرسانی دسته')->persistent('بستن');
        }

        return back();
    }
}
