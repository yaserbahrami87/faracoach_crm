<?php

namespace App\Http\Controllers;

use App\collabration_category;
use App\collabration_details;
use App\Http\Requests\CollabrationCategoryRequest;
use Illuminate\Http\Request;

class CollabrationCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collabration_category=collabration_category::get();
        return  view('admin.scholarship.settings.category')
                    ->with('collabration_category',$collabration_category);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('admin.scholarship.settings.category_insert');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CollabrationCategoryRequest $request)
    {
        $status=collabration_category::create($request->all());
        if($status)
        {
            alert()->success('زمینه همکاری اضافه شد')->persistent('بستن');
        }
        else
        {
            alert()->error('خطا در اضافه کردن زمینه همکاری')->persistent('بستن');
        }

        return redirect('/admin/collabration_category');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\collabration_category  $collabration_category
     * @return \Illuminate\Http\Response
     */
    public function show(collabration_category $collabration_category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\collabration_category  $collabration_category
     * @return \Illuminate\Http\Response
     */
    public function edit(collabration_category $collabration_category)
    {
        return view('admin.scholarship.settings.category_edit')
                    ->with('collabration_category',$collabration_category);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\collabration_category  $collabration_category
     * @return \Illuminate\Http\Response
     */
    public function update(CollabrationCategoryRequest $request, collabration_category $collabration_category)
    {
        $status=$collabration_category->update($request->all());
        if($status)
        {
            alert()->success('زمینه با موفقیت بروزرسانی شد')->persistent('بستن');
        }
        else
        {
            alert()->error('خطا در بروزرسانی')->persistent('بستن');
        }

        return redirect('/admin/collabration_category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\collabration_category  $collabration_category
     * @return \Illuminate\Http\Response
     */
    public function destroy(collabration_category $collabration_category)
    {
        //
    }

    public function ajaxCategory($collabration_category)
    {
        if($collabration_category==0)
        {
            $collabration_category=collabration_category::get();
            foreach ($collabration_category as $item)
            {
                echo "<div class='col-6 col-md-4'>
                    <button type='button' class='collabration_category btn btn-primary btn-block mb-1' data='$item->id' onclick='collabration_category($item->id)'>$item->category</button>
                </div>";
            }
        }
        else
        {
            $collabration_details=collabration_details::where('collabration_categories_id', '=', $collabration_category)
                                            ->get();

            echo "<div class='col-6 col-md-4  mb-1'>
                    <button type='button' class='collabration_category btn btn-primary btn-block btn-lg' data='0' onclick='collabration_category(0)'>بازگشت</button>
                </div>";

            foreach ($collabration_details as $item) {
                echo "<div class='col-6 col-md-4  mb-1'>
                    <button type='button' class='collabration_details btn btn-primary btn-block btn-lg' data='$item->id' onclick='collabration_details($item->id)' >$item->title</button>
                </div>";
            }
        }
    }
}
