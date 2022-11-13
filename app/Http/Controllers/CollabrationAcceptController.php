<?php

namespace App\Http\Controllers;

use App\collabration_accept;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CollabrationAcceptController extends Controller
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
        $collabration_accept=collabration_accept::where('user_id','=',Auth::user()->id)
                                ->where('collabration_detail_id','=',$request->collabration_detail_id)
                                ->first();
        if($collabration_accept)
        {
            ?>

            <script>
                alert('این زمینه کاری قبلا انتخاب شده است');
                collabration_category(0);
                collabration_details_acceptShow();
            </script>
            <?php
        }
        else
        {
            $status=collabration_accept::create(
            [
                'user_id'               =>Auth::user()->id,
                'value'                 =>((int) str_replace(',', '', $request->value)),
                'count'                 =>$request->count,
                'expire'                =>$request->expire,
                'calculate'             =>((int) str_replace(',', '', $request->calculate)),
                'collabration_detail_id'=>$request->collabration_detail_id,
            ]);

            if($status)
            {
                ?>

                <script>
                    alert('با موفقیت ثبت شد');
                    collabration_category(0);
                    collabration_details_acceptShow();
                </script>
                <?php
            }
            else
            {
                ?>
                <div class="alert alert-danger">خطا در ثبت</div>
                <?php
            }
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\collabration_accept  $collabration_accept
     * @return \Illuminate\Http\Response
     */
    public function show(collabration_accept $collabration_accept)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\collabration_accept  $collabration_accept
     * @return \Illuminate\Http\Response
     */
    public function edit(collabration_accept $collabration_accept)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\collabration_accept  $collabration_accept
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, collabration_accept $collabration_accept)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\collabration_accept  $collabration_accept
     * @return \Illuminate\Http\Response
     */
    public function destroy(collabration_accept $collabration_accept)
    {
        //
    }

    public function collabrationAccept_ajax()
    {
        return view('user.scholarship.table_collabration_details');
    }

    public function collabrationAcceptEdit_ajax(collabration_accept $collabration_accept)
    {
        $collabration_details=$collabration_accept->collabration_details;
        return view('user.scholarship.collabration_details_edit')
                        ->with('collabration_details',$collabration_details)
                        ->with('collabration_accept',$collabration_accept);
    }
}
