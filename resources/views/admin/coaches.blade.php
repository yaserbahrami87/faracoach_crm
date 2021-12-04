@extends('admin.master.index')
@section('headerScript')
    <link href="{{asset('/dashboard/assets/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
@endsection

@section('content')
    <div class="container p-1">
        <div class="row">
            <div class="table-responsive overflow-auto p-3">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">نام </th>
                            <th scope="col">نام خانوادگی</th>
                            <th scope="col">وضعیت</th>
                            <th scope="col">ویرایش</th>
                            <th scope="col">حذف</th>
                            <th scope="col">گزارش</th>
                        </tr>
                    </thead>
                    <tbody>

                    @foreach($coaches as $item)
                        <tr>
                            <td>
                                <a href="/admin/user/{{$item->id_user_table}}">
                                    <img src="{{asset('/documents/users/'.$item->personal_image)}}" class="rounded-circle"  width="50px" height="50px"/>
                                </a>
                            </td>
                            <td>
                                <a href="/admin/user/{{$item->id_user_table}}" class="d-block" target="_blank" >{{$item->fname}}</a>
                            </td>
                            <td>
                                <a href="/admin/user/{{$item->id_user_table}}" class="d-block" target="_blank" >{{$item->lname}}</a>
                            </td>
                            <td>
                                <a href="/admin/user/{{$item->id_user_table}}" class="d-block" target="_blank" >{{$item->status}}</a>
                            </td>
                            <td>
                                <a href="/admin/coach/{{$item->id}}/edit" class="btn btn-primary">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                            </td>
                            <td>
                                <form method="post" action="/admin/coach/{{$item->id}}" onsubmit="return confirm('آیا از حذف دوره اطمینان دارید؟(در صورت حذف تمام اطلاعات مربوط به آن از بانک حذف می شود)')">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <button  class="btn btn-danger" type="submit">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </form>
                            </td>
                            <td>
                                <a href="/admin/booking/{{$item->id_user_table}}/report" class="btn btn-success">
                                    <i class="bi bi-bar-chart-line-fill"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
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