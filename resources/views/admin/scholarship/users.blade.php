@extends('admin.master.index')
@section('content')
    <div class="col-12 table-responsive">
        <table class="table table-striped">
            <tr class="text-center">
                <th>ردیف</th>
                <th>نام و نام خانوادگی</th>
                <th>تلفن</th>
                <th>وضعیت</th>
            </tr>
            @foreach($scholarships as $item)
                <tr>
                    <td class="text-center">{{$loop->iteration}}</td>
                    <td class="text-center">
                        <a href="/admin/scholarship/{{$item->id}}">{{$item->user->fname.' '.$item->user->lname}}</a>
                    </td>
                    <td class="text-center" dir="ltr">{{$item->user->tel}}</td>
                    <td class="text-center">
                        @if($item->status==0)
                            بررسی نشده
                        @elseif($item->status==1)
                            در حال بررسی
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
