@extends('panelAdmin.master.index')
@section('rowcontent')

    @if(Auth::user()->type==2)
        <div class="col-12">
            <div class="row">
                <div class="col-xs-12 col-md-3 col-lg-3 col-xl-3 mb-3" id="app">
                    <form method="GET" action="/panel">
                        <div class="form-group">
                            <label for="start_date">بازه نمایش را وارد کنید</label>
                            <date-picker
                                type="date"
                                v-model="dates"
                                range
                                format="jYYYY-jMM-jDD"
                                display-format="jYYYY/jMM/jDD"
                                name="start_date"
                                max="{{$dateNow}}"
                                id="start_date"
                            ></date-picker>
                            <button type="submit" class="btn btn-success btn-sm" name="range">نمایش بده</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">نام و نام خانوادگی</th>
                    <th scope="col">ثبت نام ها</th>
                    <th scope="col">ارباب رجوع ها</th>
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
                <?php
                    $i=1;

                ?>
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
                        <td scope="row">{{$item->talktimeToday}}</td>
                        <td scope="row">{{$item->talktime}}</td>
                    </tr>
                @endforeach
                    <tr class="text-bold">
                        <td>{{$i++}}</td>
                        <td>جمع کل</td>
                        <td>{{$suminsertuser}}</td>
                        <td>{{$sumallFollowups}}</td>
                        <td>{{$sumtodayFollowups}}</td>
                        <td>{{$sumfollowedTodaybyID}}</td>
                        <td>{{$sumcontinuefollowup}}</td>
                        <td>{{$sumwaiting}}</td>
                        <td>{{$sumstudents}}</td>
                        <td>{{$sumnoanswering}}</td>
                        <td>{{$sumcancelfollowup}}</td>
                        <td>{{$sumtalktimeToday}}</td>
                        <td>{{$sumtalktime}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    @endif
    @include('panelAdmin.cardBox')


@endsection


@section('footerScript')

    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment-jalaali@0.7.4/build/moment-jalaali.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue-persian-datetime-picker/dist/vue-persian-datetime-picker-browser.js"></script>
    <script>
        var app = new Vue({
            el: '#app',
            components: {
                DatePicker: VuePersianDatetimePicker
            },
            data: {
                time:"{{old('time')}}",
                dates: [],
                message:'asdasdasd'
            }

        });


    </script>
@endsection
