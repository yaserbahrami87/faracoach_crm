
<div class="col-12 table-responsive mb-3">
    <p>فاکتورهای ایجاد شده</p>
    <table class="dataTable table table-striped table-bordered" style="width:100%">
        <thead>
        <tr>
            <th>#</th>
            <th>شماره فاکتور</th>
            <th>محصول</th>
            <th>تاریخ ایجاد </th>
            <th>موعد پرداخت</th>
            <th>قیمت(تومان)</th>
            <th>وضعیت</th>

        </tr>
        </thead>
        <tbody>
        @foreach($user->faktors as $item)
            <tr class="@if(($dateNow>$item->date_faktor)&&($item->status==0)) table-danger @elseif($item->status==1) table-success @endif" >
                <td>{{$loop->iteration}}</td>
                <td>{{$item->id}}</td>
                <td>
                    @if($item->type=='course')
                        {{($item->course['course'])}}
                    @endif
                </td>
                <td>{{$item->date_createfaktor}}</td>
                <td>{{$item->date_faktor}}</td>
                <td>{{number_format($item->fi)}}</td>
                <td>
                    @if($item->status==0)
                        پرداخت نشده
                    @else
                        تسویه شد
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>

    </table>
</div>

<hr/>
<div class="col-12 table-responsive">
    <p>واریزی های انجام شده</p>
    <table class="dataTable table table-striped table-bordered" style="width:100%">
        <thead>
        <tr>
            <th>#</th>
            <th>شماره فاکتور / رسید</th>
            <th>محصول</th>
            <th>تاریخ پرداخت</th>
            <th>قیمت(تومان)</th>
        </tr>
        </thead>
        <tbody>

        @foreach($user->checkouts->where('status','=',1) as $item)
            <tr class="@if(($dateNow>$item->date_faktor)&&($item->status==0)) table-danger @elseif($item->status==1) table-success @endif" >
                <td>{{$loop->iteration}}</td>
                <td class="text-center">
                    @switch($item->type)
                        @case('ghest')
                            {{$item->faktor->id}}
                            @break
                        @case('scholarship_payment')
                            {{$item->schoalrshipPayment->id}}
                            @break
                    @endswitch
                </td>
                <td>
                    @if($item->type=='course'||$item->type=='scholarship_payment')
                        {{($item->course['course'])}}
                    @elseif($item->type=='event')
                        {{($item->event->event)}}
                    @elseif($item->type=='ghest')
                        پرداخت قسط
                    @elseif($item->type=='reserve')
                        جلسه {{$item->reserve->booking->coach->user['fname'].' '.$item->reserve->booking->coach->user['lname']}}
                    @endif
                </td>
                <td>

                    @switch($item->type)
                        @case('scholarship_payment')
                                {{($item->schoalrshipPayment['date_fa'])}}
                                @break
                        @case('ghest')
                                {{$item->faktor->date_pardakht}}
                                @break
                        @case('reserve')
                                {{number_format($item->reserve['final_off'])}}
                                @break
                    @endswitch

                </td>
                <td>{{number_format($item->price)}}</td>

            </tr>
        @endforeach
        </tbody>

    </table>
</div>

