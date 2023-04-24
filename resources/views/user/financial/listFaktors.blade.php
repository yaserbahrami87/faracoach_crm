@extends('user.master.index')

@section('headerScript')
    <link href="{{asset('/dashboard/assets/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
@endsection

@section('content')
    <div class="col-12 table-responsive">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
            <tr>
                <th>#</th>
                <th>محصول</th>
                <th>تاریخ ایجاد </th>
                <th>موعد پرداخت</th>
                <th>قیمت(تومان)</th>
                <th>وضعیت</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($faktors as $item)
                <tr class="@if(($dateNow>$item->date_faktor)&&($item->status==0)) table-danger @elseif($item->status==1) table-success @endif" >
                    <td>{{$loop->iteration}}</td>
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
                    <td>
                        @if($item->status==0)
                            <form method="post" action="/panel/faktor/checkout/pardakhtaghsat">
                                {{csrf_field()}}
                                <input type="hidden" value="{{$item->id}}" name="faktor_id" />
                                <input type="submit" class="btn btn-primary btn-sm" value="پرداخت نشده" />
                            </form>
                        @endif
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection




@section('footerScript')
    <script src="{{asset('/dashboard/assets/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('/dashboard/assets/js/dataTables.bootstrap4.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        } );
    </script>
@endsection
