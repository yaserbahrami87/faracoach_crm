@extends('admin.master.index')

@section('content')

        <div class="col-12 table-responsive">
            <table class="table table-striped">
                <tr>
                    <th class="text-center">شماره چک / سفته</th>
                    <th>تاریخ</th>
                    <th>بانک</th>
                    <th>مبلغ</th>
                    <th>امضا</th>
                </tr>
                <tr>
                    <td class="text-center">{{$warrany->receipt}}</td>
                    <td>{{$warrany->date_fa}}</td>
                    <td>{{$warrany->bank}}</td>
                    <td>{{number_format($warrany->fi) }} تومان</td>
                    <td>
                        <img src="{{asset('/documents/signatures/'.$warrany->signature)}}" class="img-fluid" />
                    </td>
                </tr>
            </table>
        </div>

@endsection
