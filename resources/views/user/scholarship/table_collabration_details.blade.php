<table class="table table-bordered table-striped table-hover text-center" style="line-height: 2">
    <tr>
        <th>زمینه همکاری</th>
        <th>مبلغ (تومان)</th>
        <th>مهلت انجام</th>
        @if(Auth::user()->scholarship->collabration==0)
            <th>ویرایش</th>
            <th>حذف</th>
        @endif
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


                </td>
                <td>{{number_format($item_collabration_accept->calculate)}}</td>
                <td>{{$item_collabration_accept->expire}}</td>
                @if(Auth::user()->scholarship->collabration==0)
                    <td>
                        <button type='button' class="btn btn-warning btn-sm" onclick="collabration_details_acceptEdit({{$item_collabration_accept->id}})" >
                            <i class="bi bi-pencil-square"></i>
                        </button>
                    </td>
                    <td>
                        <form method="post" action="/panel/collabration_accept/{{$item_collabration_accept->id}}" onsubmit="return (window.confirm('ایا از حذف زمینه همکاری اطمینان دارید؟'))">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                            <button class="btn btn-danger btn-sm">
                                <i class="bi bi-trash3-fill"></i>
                            </button>
                        </form>
                    </td>
                @endif
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
        <th>مبلغ (تومان)</th>
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






