<table class="table text-center mt-1">
    <tr>
        <td>ردیف</td>
        <td></td>
        <td>نام و نام خانوادگی</td>
        <td>تلفن</td>
        <td>آخرین ورود</td>
        <td>امتیاز بورسیه</td>
        <td>امتیاز شما</td>

    </tr>
    @foreach($scholarship->user->get_invitations->where('resource','=','بورسیه تحصیلی') as $item)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>
                @if(is_null($item->personal_image))
                    <img class="rounded" src="{{asset('/documents/users/default-avatar.png')}}" width="50px" height="50px" />
                @else
                    <img class="rounded" src="{{asset('/documnts/users/'.$item->personal_image)}}" width="50px" height="50px" />
                @endif
            </td>
            <td>{{$item->fname.' '.$item->lname }}</td>
            <td dir="ltr">{{$item->tel}}</td>
            <td dir="ltr">-</td>
            <td dir="ltr">-</td>
        </tr>
    @endforeach
    @for($i=(count($scholarship->user->get_invitations->where('resource','=','بورسیه تحصیلی'))+1);$i<=5;$i++)
        <tr>
            <td>{{$i}}</td>
            <td>
                <img class="rounded" src="{{asset('/documents/users/default-avatar.png')}}" width="50px" height="50px" />
            </td>
            <td></td>
            <td dir="ltr"></td>
            <td dir="ltr">-</td>
            <td dir="ltr">-</td>
        </tr>
    @endfor
</table>
