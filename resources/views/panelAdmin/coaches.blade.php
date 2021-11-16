@extends('panelAdmin.master.index')
@section('rowcontent')
    <div class="container bg-light shadow-lg p-3">
        <table class="table table-striped table-bordered ">
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
                            <img src="{{asset('/documents/users/'.$item->personal_image)}}" class="img-circle"  width="50px" height="50px"/>
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
                            <i class="fas fa-user-edit"></i>
                        </a>
                    </td>
                    <td>
                        <form method="post" action="/admin/coach/{{$item->id}}" onsubmit="return confirm('آیا از حذف دوره اطمینان دارید؟(در صورت حذف تمام اطلاعات مربوط به آن از بانک حذف می شود)')">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button  class="btn btn-danger" type="submit">
                                <i class="fas fa-user-times"></i>
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
@endsection
