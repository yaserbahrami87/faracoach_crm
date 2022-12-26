@extends('admin.master.index')

@section('headerScript')
    <link href="{{asset('/dashboard/assets/css/buttons.dataTables.min.css')}}" rel="stylesheet" />
@endsection


@section('content')
    <div class="col-12 table-responsive">
        <a href="/admin/courses/{{$course->shortlink}}/students/add" class="btn btn-primary mb-2">اضافه کردن دانشجو</a>
        <table  class="table_data table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th></th>
                    <th class="text-center">نام و نام وخانوادگی</th>
                    <th class="text-center">شماره همراه</th>
                    <th class="text-center">اینستاگرام</th>
                    <th class="text-center">تاریخ ثبت نام</th>
                    <th class="text-center">واریزی(تومان)</th>
                    <th class="text-center">تخفیف پرداخت نقدی(تومان)</th>
                    <th class="text-center">تعداد اقساط</th>
                    <th class="text-center">مبلغ قسط</th>
                    <th class="text-center">قیمت ثبت نام شده</th>
                    <th class="text-center">کدرهگیری</th>
                    <th class="text-center">جذف</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($course->students as $item)
                <tr>
                    <td>

                        @if(is_null($item->user->personal_image))
                            <img src="{{asset('/documents/users/default-avatar.png')}}"  width="50px" height="50px" class="rounded-circle "/>
                        @else
                            <img src="{{asset('/documents/users/'.$item->user->personal_image)}}"  width="50px" height="50px" class="rounded-circle "/>
                        @endif
                    </td>

                    <td class="text-center">
                        {{$item->user->fname." ".$item->user->lname}}
                    </td>
                    <td class="text-center" dir="ltr">
                        <a href="/admin/user/{{$item->user->id}}" target="_blank">
                        {{$item->user->tel}}
                        </a>
                    </td>
                    <td class="text-center">
                        {{$item->user->instagram}}
                    </td>

                    <td class="text-center">
                        {{$item->date_fa}}
                    </td>
                    <td class="text-center">
                        @foreach($item->user->checkouts->where('status','=',1)->where('product_id','=',$item->course_id)->where('type','=','course') as $item2)
                            {{number_format($item2->price) }}
                        @endforeach
                    </td>
                    <td class="text-center">
                        @foreach($item->user->checkouts->where('status','=',1)->where('product_id','=',$item->course_id)->where('type','=','course') as $item2)
                            {{number_format($item2->order['takhfif_naghdi'])}}
                        @endforeach
                    </td>
                    <td class="text-center">
                        @foreach($item->user->checkouts->where('status','=',1)->where('product_id','=',$item->course_id)->where('type','=','course') as $item2)
                            {{number_format($item2->order['tedad_ghest'])}}
                        @endforeach
                    </td>
                    <td class="text-center">
                        @foreach($item->user->checkouts->where('status','=',1)->where('product_id','=',$item->course_id)->where('type','=','course') as $item2)
                            {{number_format($item2->order['fi_ghest'])}}
                        @endforeach
                    </td>
                    <td class="text-center">
                        @foreach($item->user->checkouts->where('status','=',1)->where('product_id','=',$item->course_id)->where('type','=','course') as $item2)
                            {{number_format($item2->order['fi'])}}
                        @endforeach
                    </td>
                    <td class="text-center">
                        @foreach($item->user->checkouts->where('status','=',1)->where('product_id','=',$item->course_id)->where('type','=','course') as $item2)
                            {{$item2->authority}}
                        @endforeach
                    </td>
                    <td>
                        <form method="post" action="/admin/education/students/{{$item->id}}" onsubmit="return window.confirm('آیا از حذف دانشجو از دوره اطمینان داری؟')">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                            <button class="btn btn-danger" type="submit">حذف از دوره</button>
                        </form>
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
    <script src="{{asset('/panel_assets/js/scripts/datatables/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('/panel_assets/js/scripts/datatables/jszip.min.js')}}"></script>
    <script src="{{asset('/panel_assets/js/scripts/datatables/vfs_fonts.js')}}"></script>
    <script src="{{asset('/panel_assets/js/scripts/datatables/buttons.html5.min.js')}}"></script>
    <script src="{{asset('/panel_assets/js/scripts/datatables/buttons.print.min.js')}}"></script>


    <script>
        $(document).ready(function() {
            $('.table_data').DataTable({
                order: [[4, 'desc']],
                dom: 'Bfrltip',
                buttons: [
                    'excel',
                ]
            } );
        } );
    </script>
@endsection
