<table class="table table-bordered table-striped table-hover text-center">
    <tr>
        <th>زمینه همکاری</th>
        <th>مبلغ</th>
    </tr>
    @if(!is_null(Auth::user()->collabration_accept))
        @foreach(Auth::user()->collabration_accept as $item_collabration_accept)
            <tr>
                <td>
                    <button type='button' class="collabration_details_acceptEdit btn btn-outline-dark btn-sm" onclick="collabration_details_acceptEdit({{$item_collabration_accept->id}})"  >
                        @if(!is_null($item_collabration_accept->collabration_details))
                            {{($item_collabration_accept->collabration_details->title)}}
                        @else
                            نامشخص
                        @endif
                    </button>
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
                                            }}</span> تومان
            @endif
        </td>
    </tr>
    <tr class="text-center">
        <td>وام صندوق شکوفایی</td>
        <td>
            %{{(Auth::user()->checkouts->where('status','=',1)->where('type','=','scholarship_payment')->last()->schoalrshipPayment->loan)}}
        </td>
    </tr>
    <tr class="text-center">
        <td>مبلغ بورسیه</td>
        <td>
            @if(!is_null(Auth::user()->checkouts->where('status','=',1)->where('type','=','scholarship_payment')->last()))
                <span id="collabration_fi">{{number_format(((Auth::user()->checkouts->where('status','=',1)->where('type','=','scholarship_payment')->last()->schoalrshipPayment->fi)*(Auth::user()->checkouts->where('status','=',1)->where('type','=','scholarship_payment')->last()->schoalrshipPayment->score)/100)-((Auth::user()->checkouts->where('status','=',1)->where('type','=','scholarship_payment')->last()->schoalrshipPayment->fi)*((Auth::user()->checkouts->where('status','=',1)->where('type','=','scholarship_payment')->last()->schoalrshipPayment->score)/100)*       (Auth::user()->checkouts->where('status','=',1)->where('type','=','scholarship_payment')->last()->schoalrshipPayment->loan)/100))}}</span> تومان
            @endif
        </td>
    </tr>
    <tr class="text-center">
        <td>مبلغ سقف همکاری</td>
        <td>
            @if(!is_null(Auth::user()->checkouts->where('status','=',1)->where('type','=','scholarship_payment')->last()))
                <span id="collabration_fi">{{number_format((((Auth::user()->checkouts->where('status','=',1)->where('type','=','scholarship_payment')->last()->schoalrshipPayment->fi)*(Auth::user()->checkouts->where('status','=',1)->where('type','=','scholarship_payment')->last()->schoalrshipPayment->score)/100)-((Auth::user()->checkouts->where('status','=',1)->where('type','=','scholarship_payment')->last()->schoalrshipPayment->fi)*((Auth::user()->checkouts->where('status','=',1)->where('type','=','scholarship_payment')->last()->schoalrshipPayment->score)/100)*       (Auth::user()->checkouts->where('status','=',1)->where('type','=','scholarship_payment')->last()->schoalrshipPayment->loan)/100))+((((Auth::user()->checkouts->where('status','=',1)->where('type','=','scholarship_payment')->last()->schoalrshipPayment->fi)*(Auth::user()->checkouts->where('status','=',1)->where('type','=','scholarship_payment')->last()->schoalrshipPayment->score)/100)-((Auth::user()->checkouts->where('status','=',1)->where('type','=','scholarship_payment')->last()->schoalrshipPayment->fi)*((Auth::user()->checkouts->where('status','=',1)->where('type','=','scholarship_payment')->last()->schoalrshipPayment->score)/100)*       (Auth::user()->checkouts->where('status','=',1)->where('type','=','scholarship_payment')->last()->schoalrshipPayment->loan)/100))/2))}}</span> تومان
            @endif
        </td>
    </tr>
</table>
