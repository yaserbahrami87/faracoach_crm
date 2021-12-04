@extends('user.master.index')
@section('content')
    <div class="col-12 table-responsive">
        <table class="table">
            <tr>
                <th scope="col" class="text-center">شماره تیکت</th>
                <th scope="col" class="text-center">موضوع</th>
                <th scope="col" class="text-center">ارسال کننده</th>
                <th scope="col" class="text-center">تاریخ</th>
                <th scope="col" class="text-center">ساعت</th>
                <th scope="col" class="text-center">وضعیت</th>
            </tr>
            @foreach($messages As $item)
                <tr >
                    <td class="text-center">
                        <a href="/panel/message/{{$item->id}}">{{$item->id}}</a>
                    </td>
                    <td class="text-center">
                        <a href="/panel/message/{{$item->id}}">{{$item->subject}}</a>
                    </td>
                    <td class="text-center">
                        <a href="/panel/message/{{$item->id}}">{{$item->user_id_send}}</a>
                    </td>
                    <td class="text-center">
                        <a href="/panel/message/{{$item->id}}">{{$item->date_fa}}</a>
                    </td>
                    <td class="text-center">
                        <a href="/panel/message/{{$item->id}}">{{$item->time_fa}}</a>
                    </td>
                </tr>
            @endforeach
        </table>
        {{$messages->links()}}
    </div>
    <table></table>
@endsection
