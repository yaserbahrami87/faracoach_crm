@extends('admin.master.index')

@section('content')

    <div class="col-12 table-responsive">
        <table class="table text-center">
            <tr>
                <th>دسته بندی</th>
                <th>وضعیت</th>
                <th>ویرایش</th>
                <th>حذف</th>
            </tr>
            @foreach($categories as $category)
                <tr>
                    <td>{{$category->category}}</td>
                    <td>{{($category->status==1)?'فعال':'غیرفعال'}}</td>
                    <td>
                        <a href="/admin/category/{{$category->id}}/edit" class="btn btn-warning">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                    </td>
                    <td>
                        <form method="post" action="/admin/category/{{$category->id}}" onsubmit="return window.confirm('ایا از حذف دسته بندی اطمینان دارید')">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                            <button class="btn btn-danger" type="submit">
                                <i class="bi bi-trash-fill"></i>
                            </button>

                        </form>
                    </td>
                </tr>
            @endforeach

        </table>
    </div>
@endsection
