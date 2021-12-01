<?php

namespace App\Http\Controllers;

use App\document;
use Illuminate\Http\Request;

class DocumentController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $documents=document::get();
        return view('admin.documents')
                    ->with('documents',$documents);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panelAdmin.insertDocument');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!file_exists(public_path('documents/files/'.$request->file('file')->getClientOriginalName()))) {
            $this->validate($request, [
                'title'         => ['required','string', 'max:30'],
                'shortlink'     => ['required','string','max:250','unique:documents'],
                'content'       => ['required','string'],
                'permission'    => ['required','numeric'],
                'file'          => ['required','max:40000'],
            ]);
            $image = $request->file('file')->getClientOriginalName();
            $path = public_path('/documents/files/');
            $file = $request->file('file')->move($path, $image);
            $request['file']=$image;
            $request['date_fa']=$this->dateNow;
            $request['time_fa']=$this->timeNow;

            $status = document::create([
                'title'                     => $request['title'],
                'shortlink'                 => $request['shortlink'],
                'content'                   => $request['content'],
                'permission'                => $request['permission'],
                'file'                      => $image,
                'date_fa'                   => $request['date_fa'],
                'time_fa'                   => $request['time_fa'],
            ]);
            if($status)
            {
                $msg="فایل با موفقیت در سیستم ثبت شد";
                $errorStatus="success";
                return back()
                    ->with('msg',$msg)
                    ->with('errorStatus',$errorStatus);
            }
            else
            {
                $msg="خطا در ثبت فایل";
                $errorStatus="danger";
                return back()
                    ->with('msg',$msg)
                    ->with('errorStatus',$errorStatus);
            }
        }
        else
        {
            $msg="فایلی با این نام موجود است";
            $errorStatus="danger";
            return back()
                ->with('msg',$msg)
                ->with('errorStatus',$errorStatus);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\document  $document
     * @return \Illuminate\Http\Response
     */
    public function show($document)
    {
        $document=document::where('shortlink','=',$document)
                        ->first();
        return view('panelAdmin.showDocument')
                        ->with('document',$document);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\document  $document
     * @return \Illuminate\Http\Response
     */
    public function edit(document $document)
    {
        return view('panelAdmin.editDocument')
                    ->with('document',$document);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, document $document)
    {
        $this->validate($request, [
            'title'         => ['nullable','string', 'max:30'],
            'shortlink'     => ['nullable','string','max:250'],
            'content'       => ['nullable','string'],
            'permission'    => ['nullable','numeric'],
            'file'          => ['nullable'],
        ]);
        if ($request->has('file') && $request->file('file')->isValid()) {
            if(!file_exists(public_path('documents/files/'.$request->file('file')->getClientOriginalName()))) {
                $image = $request->file('file')->getClientOriginalName();
                $path = public_path('/documents/files/');
                $file = $request->file('file')->move($path, $image);
                $request['file'] = $image;
                $request['date_fa'] = $this->dateNow;
                $request['time_fa'] = $this->timeNow;
            }
        }
        try {
            $document->update($request->all());
            $document['file']=$request->file('file')->getClientOriginalName();
            $document->update();
        } catch (Throwable $e) {

            $msg = $e->errorInfo[2];
            $errorStatus = "danger";
            return back()->with('msg', $msg)
                ->with('errorStatus', $errorStatus);
        }

        if (isset($image)) {
            $document['file'] = $image;
        }
        $document->save();
        $msg = "فایل با موفقیت به روزرسانی شد";
        $errorStatus = "success";

        return redirect('/admin/documents')
                ->with('msg', $msg)
                ->with('errorStatus', $errorStatus);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(document $document)
    {
        $status=$document->delete();
        if($status)
        {
            $msg = "فایل با موفقیت حذف شد";
            $errorStatus = "success";
            return back()->with('msg', $msg)
                ->with('errorStatus', $errorStatus);
        }
        else
        {
            $msg = "خطا در حذف فایل";
            $errorStatus = "danger";
            return back()->with('msg', $msg)
                ->with('errorStatus', $errorStatus);
        }
    }

    public function indexUser()
    {
        $documents=document::orderby('id','desc')
                ->get();
        return view('panelUser.documents')
            ->with('documents',$documents);
    }

    public function showUser($document)
    {
        $document=document::where('shortlink','=',$document)
            ->first();
        return view('panelUser.showDocument')
            ->with('document',$document);
    }
}
