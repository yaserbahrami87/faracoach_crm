<?php

namespace App\Http\Controllers;

use App\news;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news=news::orderby('id','desc')
            ->get();
        return view('admin.news.show_news')
            ->with('news',$news);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.news.create_news');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'         =>'required|string|max:250',
            'summery_news'  =>'nullable|string|max:250',
            'news'          =>'required',
            'status'        =>'required|boolean'
        ]);

        $news=news::create($request->all()+
            [
                'user_id'   =>Auth::user()->id
            ]
        );

        if($news)
        {
            alert()->success('خبر با موفقیت اضافه شد')->persistent('بستن');
        }
        else
        {
            alert()->error('خطا در اضافه کردن خبر')->persistent('بستن');
        }

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\news  $news
     * @return \Illuminate\Http\Response
     */
    public function show(news $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\news  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(news $news)
    {
        return view('admin.news.edit_news')
              ->with('news',$news);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\news  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, news $news)
    {
        $request->validate([
            'title'         =>'required|string|max:250',
            'summery_news'  =>'nullable|string|max:250',
            'news'          =>'required',
            'status'        =>'required|boolean'
        ]);
        $status=$news->update($request->all());
        if($status)
        {
            alert()->success('خبر با موفقیت ویرایش شد')->persistent('بستن');
        }
        else
        {
            alert()->error('خطا در ویرایش کردن خبر')->persistent('بستن');
        }

        return redirect('admin/news');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\news  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(news $news)
    {
        $status=$news->delete();
        if($status)
        {
            alert()->success('خبر با موفقیت حذف شد')->persistent('بستن');
        }
        else
        {
            alert()->error('خطا در حذف خبر')->persistent('بستن');
        }

        return back();
    }
}
