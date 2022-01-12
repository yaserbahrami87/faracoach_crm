@extends('admin.master.index')

@section('content')
    <div class="col-12">
        <table class="table table-striped">
            <tr>
                <th></th>
                <th>نام و نام وخانوادگی</th>
                <th>تاریخ ثبت نام</th>
            </tr>

            @foreach ($course->students as $item)

                <tr>

                    <td>
                        {{$item->user->fname." ".$item->user->lname}}
                    </td>
                    <td >
                        {{$item->date_fa}}
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
