<div class="row">
    <div class="col-12 col-md-3">
    </div>
    <div class="col-12 col-md-9 mb-1">
            <div class="row" id="collabration_category">
                @foreach($collabration_category as $item)
                    <div class="col-12 col-md-4  mb-1">
                        <button type="button" class="collabration_category btn btn-primary btn-block" data="{{$item->id}}" onclick="collabration_category({{$item->id}})" >{{$item->category}}</button>
                    </div>
                @endforeach
            </div>
    </div>
    <div class="col-12 col-md-4 mx-auto table-responsive" id="collabrationAccept_ajax">
            <table class="table table-bordered table-striped table-hover text-center">
                <tr>
                    <th>زمینه همکاری</th>
                    <th>مبلغ (تومان)</th>
                </tr>
                @if(!is_null(Auth::user()->collabration_accept))
                    @foreach(Auth::user()->collabration_accept as $item_collabration_accept)
                        <tr>
                            <td>
                                @if(Auth::user()->scholarship->collabration==0)
                                <button type='button' class="collabration_details_acceptEdit btn btn-outline-dark btn-sm" onclick="collabration_details_acceptEdit({{$item_collabration_accept->id}})"  >
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
                            </td>
                            <td>{{number_format($item_collabration_accept->calculate)}}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td>جمع مبلغ درخواست همکاری</td>
                        <td>
                            {{number_format(Auth::user()->collabration_accept->sum('calculate'))}}
                        </td>
                    </tr>
                @endif
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
                    <td>حداکثر سرمایه گذاری</td>
                    <td>
                        @if(!is_null(Auth::user()->checkouts->where('status','=',1)->where('type','=','scholarship_payment')->last()))
                            <span id="collabration_fi">{{number_format((((Auth::user()->checkouts->where('status','=',1)->where('type','=','scholarship_payment')->last()->schoalrshipPayment->fi)*(Auth::user()->checkouts->where('status','=',1)->where('type','=','scholarship_payment')->last()->schoalrshipPayment->score)/100)-((Auth::user()->checkouts->where('status','=',1)->where('type','=','scholarship_payment')->last()->schoalrshipPayment->fi)*((Auth::user()->checkouts->where('status','=',1)->where('type','=','scholarship_payment')->last()->schoalrshipPayment->score)/100)*       (Auth::user()->checkouts->where('status','=',1)->where('type','=','scholarship_payment')->last()->schoalrshipPayment->loan)/100))+((((Auth::user()->checkouts->where('status','=',1)->where('type','=','scholarship_payment')->last()->schoalrshipPayment->fi)*(Auth::user()->checkouts->where('status','=',1)->where('type','=','scholarship_payment')->last()->schoalrshipPayment->score)/100)-((Auth::user()->checkouts->where('status','=',1)->where('type','=','scholarship_payment')->last()->schoalrshipPayment->fi)*((Auth::user()->checkouts->where('status','=',1)->where('type','=','scholarship_payment')->last()->schoalrshipPayment->score)/100)*       (Auth::user()->checkouts->where('status','=',1)->where('type','=','scholarship_payment')->last()->schoalrshipPayment->loan)/100))/2))}}</span>
                        @endif
                    </td>
                </tr>
            </table>
    </div>
    <div class="col-12 text-center">
            @if(!is_null(Auth::user()->scholarship->financial))
                @if(!is_null(Auth::user()->collabration_accept)||(Auth::user()->collabration_accept->sum('calculate')>=((Auth::user()->checkouts->where('status','=',1)->where('type','=','scholarship_payment')->last()->schoalrshipPayment->fi)*(Auth::user()->checkouts->where('status','=',1)->where('type','=','scholarship_payment')->last()->schoalrshipPayment->score)/100)&&(Auth::user()->scholarship->collabration==0)))
                    <form method="post" action="/panel/scholarship/me/sendAcceptCollabration" onsubmit="return window.confirm('بعد از ارسال درخواست جهت بررسی امکان ویرایش وجود ندارد. آیا از ارسال درخواست اطمینان دارید ؟')">
                        {{csrf_field()}}
                        <input type="submit" value="ارسال درخواست جهت بررسی" class="btn btn-success">
                    </form>
                @endif
            @endif
    </div>
</div>

