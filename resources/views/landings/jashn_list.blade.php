@extends('admin.master.index')

@section('headerScript')
    <link href="{{asset('/dashboard/assets/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
@endsection

@section('content')
    <div class="col-12 table-responsive overflow-auto">
        <p >تعداد کل ثبت نام
            <b class="font-weight-bold">{{$count}}</b>
             نفر
        </p>

        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th class="text-center">نام و نام وخانوادگی</th>
                    <th class="text-center">شماره همراه</th>
                    <th class="text-center">تاریخ ثبت نام</th>
                    <th class="text-center">معرف</th>
                </tr>
                </thead>
            <tbody>

            @foreach ($users as $item)
                <tr>

                    <td class="text-center">
                        {{$item->fname." ".$item->lname}}
                    </td>
                    <td class="text-center" dir="ltr">
                            {{$item->tel}}
                    </td>

                    <td class="text-center">
                        {{$item->date_fa}}
                    </td>
                    <td class="text-center">
                        {{$item->introducedUser['fname']." ".$item->introducedUser['lname']}}
                    </td>


                </tr>
            @endforeach
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
