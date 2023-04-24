@extends('user.master.index')
@section('content')
    <div class="col-12 table-responsive">
        <table class="table text-center">
            <tr>
                <th>#</th>
                <th>دوره</th>
                <th>قیمت دوره</th>
                <th>تخفیف</th>
                <th>امتیاز بورسیه</th>
                <th>قیمت نهایی</th>
                <th>پیش پرداخت</th>
                <th>تعداد قسط</th>
                <th>مبلغ هر قسط</th>
                <th></th>
            </tr>

            @foreach(Auth::user()->invoice as $item)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{($item->course->course)}}</td>
                <td>{{number_format($item->fi)}}</td>
                <td>{{($item->off)}}%</td>
                <td>{{($item->score)}}</td>
                <td>{{number_format($item->fi_final)}}</td>
                <td>{{number_format($item->pre_payment)}} تومان</td>
                <td>{{$item->count_installment}}</td>
                <td>{{number_format($item->fi_installment)}} تومان</td>
                <td>
                    @if($item->status==0)
                        <form method="post" action="/panel/invoice/checkout/{{$item->id}}">
                            {{csrf_field()}}
                            <input type="hidden" value="{{$item->id}}" name="faktor_id" />
                            <input type="submit" class="btn btn-primary btn-sm" value="پرداخت نشده" />
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </table>
    </div>
@endsection
