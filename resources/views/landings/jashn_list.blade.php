@extends('admin.master.index')
@section('content')
    <div class="col-12">
        <p>تعداد کل ثبت نام </p>
        <table class="table table-striped">
            <tr>

                <th class="text-center">نام و نام وخانوادگی</th>
                <th class="text-center">شماره همراه</th>
                <th class="text-center">تاریخ ثبت نام</th>
                <th class="text-center">معرف</th>
            </tr>

            @foreach ($users as $item)
                <tr>

                    <td class="text-center">
                        {{$item->fname." ".$item->lname}}
                    </td>
                    <td class="text-center" dir="ltr">
                            {{$item->tel}}
                    </td>

                    <td class="text-center">
                        {{$item->date_fa}}
                    </td>
                    <td class="text-center">
                        {{$item->introducedUser['fname']." ".$item->introducedUser['lname']}}
                    </td>


                </tr>
            @endforeach
        </table>
        {{$users->links()}}
    </div>
@endsection
