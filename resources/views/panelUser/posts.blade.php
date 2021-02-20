@extends('panelUser.master.index')
@section('rowcontent')
    <div class="col-12 table-responsive">
        <a href="/panel/post/create" class="btn btn-primary">پست جدید <i class="fas fa-plus-circle"></i></a>
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">عنوان</th>
                <th scope="col">تاریخ ثبت</th>
                <th scope="col">ویرایش</th>
                <th scope="col">حذف</th>
            </tr>
            </thead>
            <tbody>
            @foreach($posts as $item)
                <tr>
                    <th scope="row">1</th>
                    <td>
                        <a href="/{{Auth::user()->username}}/post/{{$item->shortlink}}" target="_blank">
                        {{$item->title}}
                        </a>
                    </td>
                    <td>{{$item->date_fa}}</td>
                    <td>
                        <a class="btn btn-warning" href="/panel/post/{{Auth::user()->username}}/{{$item->shortlink}}/edit">
                            <i class="fas fa-edit"></i>
                        </a>
                    </td>
                    <td>
                        <form method="post" action="/panel/post/{{Auth::user()->username}}/{{$item->shortlink}}/delete" onsubmit="return confirm('آیا از حذف استاد اطمینان دارید؟(در صورت حذف تمام سوابق دوره های استاد و اطلاعات آن از بانک حذف می شود)');">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button  class="btn btn-danger" type="submit">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
