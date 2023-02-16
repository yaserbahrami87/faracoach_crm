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
                    <th class="text-center">ویرایش</th>
                    <th class="text-center">حذف</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($course->students as $item)
                <tr>
                    <td>
                        <a  data-toggle="collapse" href="#collaps{{$item->user->id}}" role="button" aria-expanded="false" aria-controls="collaps{{$item->user->id}}">
                            @if(is_null($item->user->personal_image))
                                <img src="{{asset('/documents/users/default-avatar.png')}}"  width="50px" height="50px" class="rounded-circle "/>
                            @else
                                <img src="{{asset('/documents/users/'.$item->user->personal_image)}}"  width="50px" height="50px" class="rounded-circle "/>
                            @endif
                        </a>
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
                        <a href="/admin/education/students/{{$item->id}}/edit" class="btn btn-warning" >
                            <i class="bi bi-pencil-square"></i>
                        </a>
                    </td>
                    <td>
                        <form method="post" action="/admin/education/students/{{$item->id}}" onsubmit="return window.confirm('آیا از حذف دانشجو از دوره اطمینان داری؟')">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                            <button class="btn btn-danger" type="submit">حذف از دوره</button>
                        </form>
                    </td>
                </tr>
                <tr class="collapse" id="collaps{{$item->user->id}}">
                    <td colspan="7">
                        @if($item->user->checkouts->where('status','=',1)->count()!=0)
                            @foreach($item->user->checkouts->where('status','=',1) as $item_checkout)
                                {{$item_checkout->authority}}
                            @endforeach
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="col-12">

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
