<table class="table table-bordered table-striped table-hover text-center">
    <tr>
        <th>زمینه همکاری</th>
        <th>مبلغ</th>
    </tr>
    @if(!is_null(Auth::user()->collabration_accept))
        @foreach(Auth::user()->collabration_accept as $item_collabration_accept)
            <tr>
                <td>
                    @if(!is_null($item_collabration_accept->collabration_details))
                        {{($item_collabration_accept->collabration_details->title)}}
                    @else
                        نامشخص
                    @endif
                </td>
                <td>{{number_format($item_collabration_accept->calculate)}}</td>
            </tr>
        @endforeach
        <tr>
            <td>مبلغ درخواست همکاری</td>
            <td>
                {{number_format(Auth::user()->collabration_accept->sum('calculate'))}}
            </td>
        </tr>
    @endif

    <tr class="text-center">
        <td>مبلغ همکاری</td>
        <td >
            @if(!is_null(Auth::user()->checkouts->where('status','=',1)->where('type','=','scholarship_payment')->last()))
                <span id="collabration_fi">{{number_format((Auth::user()->checkouts->where('status','=',1)->where('type','=','scholarship_payment')->last()->schoalrshipPayment->fi)*(Auth::user()->checkouts->where('status','=',1)->where('type','=','scholarship_payment')->last()->schoalrshipPayment->score)/100)}}</span> تومان
            @endif
        </td>
    </tr>
</table>
