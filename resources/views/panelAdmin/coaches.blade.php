@extends('panelAdmin.master.index')
@section('rowcontent')
    <a href="/admin/coach/create" class="btn btn-primary mb-5">اضافه کردن<i class="fas fa-plus"></i></a>
    <table class="table table-striped table-bordered ">
        <thead>
            <tr>
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
@endsection
