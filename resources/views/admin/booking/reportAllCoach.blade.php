@extends('admin.master.index')

@section('content')

    <div class="col-12">
        <div id="app" class="col-md-4">
            <form method="get" action="/admin/booking/reportallcoach" id="formBooking">
                {{csrf_field()}}
                <date-picker
                    type="date"
                    v-model="dates"
                    range
                    format="jYYYY-jMM-jDD"
                    display-format="jYYYY/jMM/jDD"
                    name="start_date"
                    id="start_date"
                ></date-picker>
                <button type="submit" class="btn btn-success">بگرد</button>
            </form>
        </div>
    </div>
    <div class="col-12">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">جلسات رزرو شده <span class="badge badge-warning">{{$reserveBooking->count()}}</span> </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">جلسات برگزار شده <span class="badge badge-success">{{$successBooking->count()}}</span></a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#cancel_reserve" role="tab" aria-controls="cancel_reserve" aria-selected="false"> جلسات کنسل شده <span class="badge  badge-danger">{{$cancelBooking->count()}}</span></a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="pills-Appointments-tab" data-toggle="pill" href="#appointments_booking" role="tab" aria-controls="appointments_booking" aria-selected="false"> جلسات رزرو شده دراین تاریخ <span class="badge  badge-danger">{{$appointments_booking->count()}}</span></a>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <table class="table table-striped table-bordered table-warning">
                    <tr>
                        <th>#</th>
                        <th>کوچ</th>
                        <th>تاریخ جلسه</th>
                        <th>ساعت جلسه</th>
                        <th>مراجع</th>

                    </tr>
                    @foreach($reserveBooking as $item)
                        <tr>
                            <th>{{$loop->iteration}}</th>
                            <td>
                                <a href="/admin/booking/{{$item->coach->user->id}}/report" target="_blank">
                                    <img src="{{asset('/documents/users/'.$item->coach->user->personal_image)}}" width="50px" height="50px" class="rounded-circle" />
                                    {{$item->coach->user->fname.' '.$item->coach->user->lname}}
                                </a>
                            </td>
                            <td>{{$item->start_date}}</td>
                            <td>{{$item->start_time}}</td>
                            <td dir="ltr">
                                <a href="/admin/user/{{$item->reserve->user->id}}" target="_blank">
                                    @if(is_null($item->reserve->user->fname)&&is_null($item->reserve->user->lname))
                                        {{$item->reserve->user->tel}}
                                    @else
                                        {{$item->reserve->user->fname." ".$item->reserve->user->lname}}
                                    @endif
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <table class="table table-striped table-bordered table-success">
                    <tr>
                        <th>#</th>
                        <th>کوچ</th>
                        <th>تاریخ جلسه</th>
                        <th>ساعت جلسه</th>
                        <th>مراجع</th>

                    </tr>
                    @foreach($successBooking as $item)
                        <tr>
                            <th>{{$loop->iteration}}</th>
                            <td>
                                <a href="/admin/booking/{{$item->coach->user->id}}/report" target="_blank">
                                    <img src="{{asset('/documents/users/'.$item->coach->user->personal_image)}}" width="50px" height="50px" class="rounded-circle" />
                                    {{$item->coach->user->fname.' '.$item->coach->user->lname}}
                                </a>
                            </td>
                            <td>{{$item->start_date}}</td>
                            <td>{{$item->start_time}}</td>
                            <td dir="ltr">
                                <a href="/admin/user/{{$item->reserve->user->id}}" target="_blank">
                                    @if(is_null($item->reserve->user->fname)&&is_null($item->reserve->user->lname))
                                        {{$item->reserve->user->tel}}
                                    @else
                                        {{$item->reserve->user->fname." ".$item->reserve->user->lname}}
                                    @endif
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>

            <div class="tab-pane fade" id="appointments_booking" role="tabpanel" aria-labelledby="appointments_booking-tab">
                <table class="table table-striped table-bordered table-danger">
                    <tr>
                        <th>#</th>
                        <th>کوچ</th>
                        <th>تاریخ جلسه</th>
                        <th>ساعت جلسه</th>
                        <th>مراجع</th>

                    </tr>
                    @foreach($appointments_booking as $item)
                        <tr>
                            <th>{{$loop->iteration}}</th>
                            <td>

                                <a href="/admin/booking/{{$item->booking->coach->user->id}}/report" target="_blank">
                                    <img src="{{asset('/documents/users/'.$item->booking->coach->user->personal_image)}}" width="50px" height="50px" class="rounded-circle" />
                                    {{$item->booking->coach->user->fname.' '.$item->booking->coach->user->lname}}
                                </a>
                            </td>
                            <td>{{$item->booking->start_date}}</td>
                            <td>{{$item->booking->start_time}}</td>
                            <td dir="ltr">
                                <a href="/admin/user/{{$item->user->id}}" target="_blank">

                                    @if(is_null($item->user->fname)&&is_null($item->user->lname))
                                        {{$item->user->tel}}
                                    @else
                                        {{$item->user->fname." ".$item->user->lname}}
                                    @endif
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>

            <div class="tab-pane fade" id="cancel_reserve" role="tabpanel" aria-labelledby="cancel_reserve-tab">
                <table class="table table-striped table-bordered table-danger">
                    <tr>
                        <th>#</th>
                        <th>کوچ</th>
                        <th>تاریخ جلسه</th>
                        <th>ساعت جلسه</th>
                        <th>مراجع</th>

                    </tr>
                    @foreach($cancelBooking as $item)
                        <tr>
                            <th>{{$loop->iteration}}</th>
                            <td>
                                <a href="/admin/booking/{{$item->coach->user->id}}/report" target="_blank">
                                    <img src="{{asset('/documents/users/'.$item->coach->user->personal_image)}}" width="50px" height="50px" class="rounded-circle" />
                                    {{$item->coach->user->fname.' '.$item->coach->user->lname}}
                                </a>
                            </td>
                            <td>{{$item->start_date}}</td>
                            <td>{{$item->start_time}}</td>
                            <td dir="ltr">
                                <a href="/admin/user/{{$item->reserve->user->id}}" target="_blank">

                                    @if(is_null($item->reserve->user->fname)&&is_null($item->reserve->user->lname))
                                        {{$item->reserve->user->tel}}
                                    @else
                                        {{$item->reserve->user->fname." ".$item->reserve->user->lname}}
                                    @endif
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>




    </div>
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
