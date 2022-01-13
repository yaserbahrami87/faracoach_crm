@extends('admin.master.index')

@section('content')
    <div class="col-12">
        <table class="table table-striped">
            <tr>
                <th></th>
                <th class="text-center">نام و نام وخانوادگی</th>
                <th class="text-center">شماره همراه</th>
                <th class="text-center">تاریخ ثبت نام</th>
                <th class="text-center">واریزی(تومان)</th>
                <th class="text-center">کدرهگیری</th>
            </tr>

            @foreach ($course->students as $item)

                <tr>
                    <td>
                        @if(is_null($item->user->personal_image))
                            <img src="{{asset('/documents/users/default-avatar.png')}}"  width="50px" height="50px" class="rounded-circle "/>
                        @else
                            <img src="{{asset('/documents/users/'.$item->user->personal_image)}}"  width="50px" height="50px" class="rounded-circle "/>
                        @endif
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
                        {{$item->date_fa}}
                    </td>
                    <td class="text-center">
                        @foreach($item->user->checkouts->where('status','=',1)->where('product_id','=',$item->course_id)->where('type','=','course') as $item2)
                            {{number_format($item2->price) }}
                        @endforeach
                    </td>

                    <td class="text-center">
                        @foreach($item->user->checkouts->where('status','=',1)->where('product_id','=',$item->course_id)->where('type','=','course') as $item2)
                            {{$item2->authority}}
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
