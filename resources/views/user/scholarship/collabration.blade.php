<div class="row">
    <div class="col-12 mb-1">
            <div class="row" id="collabration_category">
                @foreach($collabration_category as $item)
                    <div class="col-12 col-md-4  mb-1">
                        <button type="button" class="collabration_category btn btn-primary btn-block" data="{{$item->id}}" onclick="collabration_category({{$item->id}})" >{{$item->category}}</button>
                    </div>
                @endforeach
            </div>
    </div>
    <div class="col-12 col-md-6 mx-auto table-responsive" id="collabrationAccept_ajax">

            <table class="table table-bordered table-striped table-hover text-center" style="line-height: 2">
                <tr>
                    <th>زمینه همکاری</th>
                    <th style="padding:1rem !important;">مبلغ (تومان)</th>
                    <th style="padding:1rem !important;">مهلت انجام</th>
                </tr>

                @if(!is_null(Auth::user()->collabration_accept))
                    @foreach(Auth::user()->collabration_accept as $item_collabration_accept)
                        <tr>
                            <td>
                                @if(Auth::user()->scholarship->collabration==0)
                                <button type='button' class="m-1 collabration_details_acceptEdit btn btn-outline-dark btn-sm" onclick="collabration_details_acceptEdit({{$item_collabration_accept->id}})"  >
                                    @if(!is_null($item_collabration_accept->collabration_details))
                                        {{($item_collabration_accept->collabration_details->title)}}
                                    @else
                                        نامشخص
                                    @endif
                                </button>
                                @else
                                    @if(!is_null($item_collabration_accept->collabration_details))
                                        {{($item_collabration_accept->collabration_details->title)}}
                                    @else
                                        نامشخص
                                    @endif
                                @endif

                                <form method="post" action="/panel/collabration_accept/{{$item_collabration_accept->id}}" onsubmit="return (window.confirm('ایا از حذف زمینه همکاری اطمینان دارید؟'))">
                                    {{csrf_field()}}
                                    {{method_field('DELETE')}}
                                    <button class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash3-fill"></i>
                                    </button>
                                </form>
                            </td>
                            <td>{{number_format($item_collabration_accept->calculate)}}</td>
                            <td>{{$item_collabration_accept->expire}}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td>جمع مبلغ درخواست همکاری</td>
                        <td>
                            {{number_format(Auth::user()->collabration_accept->sum('calculate'))}}
                        </td>
                    </tr>

                @endif

            </table>



        <table class="table table-bordered table-striped table-hover text-center" style="line-height: 2">
            <tr>
                <th>اطلاعات بورسیه</th>
                <th >مبلغ (تومان)</th>
            </tr>

            <tr class="text-center">
                <td>مبلغ بورسیه</td>
                <td>
                    @if(!is_null(Auth::user()->checkouts->where('status','=',1)->where('type','=','scholarship_payment')->last()))
                        <span id="collabration_fi">{{number_format(
                                            (Auth::user()->checkouts->where('status','=',1)->where('type','=','scholarship_payment')->last()->schoalrshipPayment->fi)*
                                            (Auth::user()->checkouts->where('status','=',1)->where('type','=','scholarship_payment')->last()->schoalrshipPayment->score)/100)
                                            }}</span>
                    @endif
                </td>
            </tr>
            <tr class="text-center">
                <td>وام صندوق شکوفایی</td>
                <td>

                    @if(!is_null(Auth::user()->checkouts->where('status','=',1)->where('type','=','scholarship_payment')->last()))
                        %{{(Auth::user()->checkouts->where('status','=',1)->where('type','=','scholarship_payment')->last()->schoalrshipPayment->loan)}}
                    @endif
                </td>
            </tr>
            <tr class="text-center">
                <td>مانده بورسیه</td>
                <td>
                    @if(!is_null(Auth::user()->checkouts->where('status','=',1)->where('type','=','scholarship_payment')->last()))
                        <span id="collabration_fi">{{number_format(((Auth::user()->checkouts->where('status','=',1)->where('type','=','scholarship_payment')->last()->schoalrshipPayment->fi)*(Auth::user()->checkouts->where('status','=',1)->where('type','=','scholarship_payment')->last()->schoalrshipPayment->score)/100)-((Auth::user()->checkouts->where('status','=',1)->where('type','=','scholarship_payment')->last()->schoalrshipPayment->fi)*((Auth::user()->checkouts->where('status','=',1)->where('type','=','scholarship_payment')->last()->schoalrshipPayment->score)/100)*       (Auth::user()->checkouts->where('status','=',1)->where('type','=','scholarship_payment')->last()->schoalrshipPayment->loan)/100))}}</span>
                    @endif
                </td>
            </tr>
            <tr class="text-center">
                <td>حداقل اعلام همکاری</td>
                <td>
                    @if(!is_null(Auth::user()->checkouts->where('status','=',1)->where('type','=','scholarship_payment')->last()))
                        <span id="collabration_fi">{{number_format((((Auth::user()->checkouts->where('status','=',1)->where('type','=','scholarship_payment')->last()->schoalrshipPayment->fi)*(Auth::user()->checkouts->where('status','=',1)->where('type','=','scholarship_payment')->last()->schoalrshipPayment->score)/100)-((Auth::user()->checkouts->where('status','=',1)->where('type','=','scholarship_payment')->last()->schoalrshipPayment->fi)*((Auth::user()->checkouts->where('status','=',1)->where('type','=','scholarship_payment')->last()->schoalrshipPayment->score)/100)*       (Auth::user()->checkouts->where('status','=',1)->where('type','=','scholarship_payment')->last()->schoalrshipPayment->loan)/100))+((((Auth::user()->checkouts->where('status','=',1)->where('type','=','scholarship_payment')->last()->schoalrshipPayment->fi)*(Auth::user()->checkouts->where('status','=',1)->where('type','=','scholarship_payment')->last()->schoalrshipPayment->score)/100)-((Auth::user()->checkouts->where('status','=',1)->where('type','=','scholarship_payment')->last()->schoalrshipPayment->fi)*((Auth::user()->checkouts->where('status','=',1)->where('type','=','scholarship_payment')->last()->schoalrshipPayment->score)/100)*       (Auth::user()->checkouts->where('status','=',1)->where('type','=','scholarship_payment')->last()->schoalrshipPayment->loan)/100))/2))}}</span>
                    @endif
                </td>
            </tr>
        </table>
    </div>
    <div class="col-12 text-center">

            <form method="post" action="/panel/scholarship/me/sendAcceptCollabration" onsubmit="return window.confirm('بعد از ارسال درخواست جهت بررسی امکان ویرایش وجود ندارد. آیا از ارسال درخواست اطمینان دارید ؟')">
                {{csrf_field()}}
                <input type="submit" value="ارسال درخواست جهت بررسی" class="btn btn-success" />
            </form>

    </div>
</div>

