@extends('panelAdmin.master.index')
@section('rowcontent')

    @if(Auth::user()->type==2)
        <div class="col-12 table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">نام و نام خانوادگی</th>
                    <th scope="col">ثبت نام ها</th>
                    <th scope="col">کل مشتریان</th>
                    <th scope="col">پیگیری های امروز </th>
                    <th scope="col">پیگیری های انجام شده امروز </th>
                    <th scope="col">تور پیگیری</th>
                    <th scope="col">در انتظار تصمیم</th>
                    <th scope="col">مشتری</th>
                    <th scope="col">عدم پاسخ</th>
                    <th scope="col">انصرافی ها</th>
                    <th scope="col">مدت مکالمه روز</th>
                    <th scope="col">مدت مکالمه</th>
                </tr>
                </thead>
                <tbody>
                <?php $i=1;  ?>
                @foreach($usersEducation as $item)
                    <tr>
                        <th scope="row">{{$i++}}</th>
                        <td scope="row">{{$item->fname}} {{$item->lname}}</td>
                        <td scope="row">{{$item->insertuser}}</td>
                        <td scope="row">{{$item->allFollowups}}</td>
                        <td scope="row">{{$item->todayFollowups}}</td>
                        <td scope="row">{{$item->followedTodaybyID}}</td>
                        <td scope="row">{{$item->continuefollowup}}</td>
                        <td scope="row">{{$item->waiting}}</td>
                        <td scope="row">{{$item->students}}</td>
                        <td scope="row">{{$item->noanswering}}</td>
                        <td scope="row">{{$item->cancelfollowup}}</td>
                        <td scope="row"></td>
                        <td scope="row">{{$item->talktime}}</td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
    @include('panelAdmin.cardBox')


@endsection
