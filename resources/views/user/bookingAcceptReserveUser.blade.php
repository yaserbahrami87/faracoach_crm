@extends('user.master.index')
@section('content')
    <div class="col-md-12 mt-3 table-responsive">
        <table class="table border table-hover table-striped">
            <tr>
                <th></th>
                <th>کد جلسه</th>
                <th scope="col">تاریخ شروع</th>
                <th scope="col">ساعت شروع</th>
                <th scope="col">ساعت پایان</th>
                <th scope="col">مدت جلسه</th>
                @if(Auth::user()->status_coach==1)
                    <th scope="col">وضعیت</th>
                @endif
                @if(Auth::user()->status_coach==1)
                    <th scope="col">حذف</th>
                @else
                    <th>لغو جلسه</th>
                @endif
            </tr>

            @foreach($booking as $item)
                @switch($item['status'])
                    @case('1')   <tr class="table-warning">
                    @break
                    @case('0')   <tr class="table-success">
                    @break
                    @case('4')   <tr class="table-danger">
                    @break
                    @default    <tr>
                        @break
                        @endswitch

                        <td>
                            <img src="{{asset('/documents/users/'.$item->user['personal_image'])}}" class="img-circle"  width="50px" height="50px"/>
                        </td>
                        <td class="text-center">
                            <a href="/panel/reserve/{{$item->id}}">{{$item->booking->id}}</a>
                        </td>
                        <td class="text-center">
                            @if(Auth::user()->status_coach==1 )

                                @if($item->status==1  || ($item->caption_status=='باطل شده'))
                                    {{$item->booking->start_date}}
                                @else
                                    <a href="/panel/booking/{{$item->id}}">{{$item->start_date}}</a>
                                @endif
                            @else
                                <a href="/panel/reserve/{{$item->id}}">{{$item->booking->start_date}}</a>
                            @endif
                        </td>
                        <td class="text-center">{{$item->booking->start_time}}</td>
                        <td class="text-center">{{$item->booking->end_time}}</td>
                        <td class="text-center">{{$item->duration_booking}}</td>
                        @if(Auth::user()->status_coach==1)
                            <td>{{$item->caption_status}}</td>
                        @endif

                        @if((($item->start_date>$dateNow && Auth::user()->status_coach==1) && (($item['status'])!=0)&&($item['status']!=4)))
                            <td>
                                <form method="post" action="/panel/booking/{{$item->id}}" onsubmit="return confirm('آیا از حذف زمان رزرو اطمینان دارید؟');">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <button  class="btn btn-danger" type="submit">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </form>
                            </td>
                        @elseif($item->start_date>$dateNow && ($item['status']!=4))
                            <td>
                                <form method="POST" action="/panel/booking/{{$item->booking_id}}" onsubmit="return confirm('آیا از لغو جلسه اطمینان دارید؟')">
                                    {{csrf_field()}}
                                    {{method_field('PATCH')}}
                                    <input type="hidden" name="status" value="4" />
                                    <button type="submit" class="btn btn-danger">لغو جلسه
                                        <i class="bi bi-x-lg"></i>
                                    </button>
                                </form>
                            </td>
                        @endif
                    </tr>
                    @endforeach
        </table>
        {{$booking->links()}}
    </div>

@endsection
