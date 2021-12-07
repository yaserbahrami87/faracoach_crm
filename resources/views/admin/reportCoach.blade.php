@extends('admin.master.index')
@section('headerScript')
    <style>
        a
        {
            color:#000000;
        }


        #colors span
        {
            width: 25px;
            height: 25px;
        }

        table *
        {
            font-size:12px;
        }

        .listFriends .btn
        {
            border-radius: 5px;
        }

        .listFriends .btn
        {
            width: auto;
            height: auto;
        }

        .listFriends .card .avatar
        {
            width: auto;
            height: auto;
        }

        .listFriends .card {
            padding-top: 20px;
            margin: 10px 0 20px 0;
            background-color: rgba(214, 224, 226, 0.2);
            border-top-width: 0;
            border-bottom-width: 2px;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
            -webkit-box-shadow: none;
            -moz-box-shadow: none;
            box-shadow: none;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        .listFriends .card .card-heading {
            padding: 0 20px;
            margin: 0;
        }

        .listFriends .card .card-heading.simple {
            font-size: 20px;
            font-weight: 300;
            color: #777;
            border-bottom: 1px solid #e5e5e5;
        }

        .listFriends .card .card-heading.image img {
            display: inline-block;
            width: 46px;
            height: 46px;
            margin-right: 15px;
            vertical-align: top;
            border: 0;
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            border-radius: 50%;
        }

        .listFriends .card .card-heading.image .card-heading-header {
            display: inline-block;
            vertical-align: top;
        }

        .listFriends .card .card-heading.image .card-heading-header h3 {
            margin: 0;
            font-size: 14px;
            line-height: 16px;
            color: #262626;
        }

        .listFriends .card .card-heading.image .card-heading-header span {
            font-size: 12px;
            color: #999999;
        }

        .listFriends .card .card-body {
            padding: 0 20px;
            margin-top: 20px;
        }

        .listFriends .card .card-media {
            padding: 0 20px;
            margin: 0 -14px;
        }

        .listFriends .card .card-media img {
            max-width: 100%;
            max-height: 100%;
        }

        .listFriends .card .card-actions {
            min-height: 30px;
            padding: 0 20px 20px 20px;
            margin: 20px 0 0 0;
        }

        .listFriends .card .card-comments {
            padding: 20px;
            margin: 0;
            background-color: #f8f8f8;
        }

        .listFriends .card .card-comments .comments-collapse-toggle {
            padding: 0;
            margin: 0 20px 12px 20px;
        }

        .listFriends .card .card-comments .comments-collapse-toggle a,
        .listFriends .card .card-comments .comments-collapse-toggle span {
            padding-right: 5px;
            overflow: hidden;
            font-size: 12px;
            color: #999;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .listFriends .card-comments .media-heading {
            font-size: 13px;
            font-weight: bold;
        }

        .listFriends .card.people {
            position: relative;
            display: inline-block;
            width: 170px;
            height: 300px;
            padding-top: 0;
            margin-left: 20px;
            overflow: hidden;
            vertical-align: top;
        }

        .listFriends .card.people:first-child {
            margin-left: 0;
        }

        .listFriends .card.people .card-top {
            position: absolute;
            top: 0;
            left: 0;
            display: inline-block;
            width: 170px;
            height: 150px;
            background-color: #ffffff;
        }

        .listFriends .card.people .card-top.green {
            background-color: #53a93f;
        }

        .listFriends .card.people .card-top.blue {
            background-color: #427fed;
        }

        .listFriends .card.people .card-info {
            position: absolute;
            top: 150px;
            display: inline-block;
            width: 100%;
            height: 101px;
            overflow: hidden;
            background: #ffffff;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        .listFriends .card.people .card-info .title {
            display: block;
            margin: 8px 14px 0 14px;
            overflow: hidden;
            font-size: 16px;
            font-weight: bold;
            line-height: 18px;
            color: #404040;
        }

        .listFriends .card.people .card-info .desc {
            display: block;
            margin: 8px 14px 0 14px;
            overflow: hidden;
            font-size: 12px;
            line-height: 16px;
            color: #737373;
            text-overflow: ellipsis;
        }

        .listFriends .card.people .card-bottom {
            position: absolute;
            bottom: 0;
            left: 0;
            display: inline-block;
            width: 100%;
            padding: 10px 20px;
            line-height: 29px;
            text-align: center;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        .listFriends .card.hovercard {
            position: relative;
            padding-top: 0;
            overflow: hidden;
            text-align: center;
            background-color: rgba(214, 224, 226, 0.2);
        }

        .listFriends .card.hovercard .cardheader {
            background: url("http://lorempixel.com/850/280/nature/4/");
            background-size: cover;
            height: 135px;
        }

        .listFriends .card.hovercard .avatar {
            position: relative;
            top: -50px;
            margin-bottom: -50px;
        }

        .listFriends .card.hovercard .avatar img {
            width: 100px;
            height: 100px;
            max-width: 100px;
            max-height: 100px;
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            border-radius: 50%;
            border: 5px solid rgba(255,255,255,0.5);
        }

        .listFriends .card.hovercard .info {
            padding: 4px 8px 10px;
        }

        .listFriends .card.hovercard .info .title {
            margin-bottom: 4px;
            font-size: 16px;
            line-height: 1;
            color: #262626;
            vertical-align: middle;
        }

        .listFriends .card.hovercard .info .desc {
            overflow: hidden;
            font-size: 12px;
            line-height: 20px;
            color: #737373;
            text-overflow: ellipsis;
        }

        .listFriends .card.hovercard .bottom {
            padding: 0 20px;
            margin-bottom: 17px;
        }

        .listFriends .btn{
            border-radius: 50%;
            width:32px;
            height:32px;
            line-height:24px;
        }
    </style>
@endsection

@section('content')
    <?php
    //$roozha="'Sunday','Friday'";
    $roozha="";
    ?>

    <div id="app" class="col-md-4">
        <p>انتخاب بازه زمانی</p>
        <form method="get" action="/admin/booking/{{$coach->id}}/report" id="formBooking">
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
            <button type="submit" class="btn btn-success">نمایش</button>
        </form>
    </div>


    <div class="col-md-12 mt-3 table-responsive">
        <p>گزارش عملکرد {{$coach->fname}} {{$coach->lname}}</p>
        <table class="table border table-hover table-striped">
            <tr>
                <th scope="col" class="p-1">#</th>
                <th scope="col" class="p-1">تعداد جلسات کوچینگ در انتظار رزرو</th>
                <th scope="col" class="p-1">تعداد جلسات معارفه در انتظار رزرو</th>
                <th scope="col" class="p-1">تعداد جلسات کوچینگ رزرو شده</th>
                <th scope="col" class="p-1">تعداد جلسات معارفه رزرو شده</th>
                <th scope="col" class="p-1">تعداد جلسات کوچینگ برگزار شده</th>
                <th scope="col" class="p-1">تعداد جلسات معارفه برگزار شده</th>
                <th scope="col" class="p-1">تعداد جلسات کوچینگ کنسل شده</th>
                <th scope="col" class="p-1">تعداد جلسات معارفه کنسل شده</th>
            </tr>
            <tr>
                <td>#</td>
                <td>{{$reserveCoaching->count()}}</td>
                <td>{{$reserveMoarefeh->count()}}</td>
                <td>{{$waitingCoaching->count()}}</td>
                <td>{{$waitingMoarefeh->count()}}</td>
                <td>{{$heldCoaching->count()}}</td>
                <td>{{$heldMoarefeh->count()}}</td>
                <td>{{$cancelCoaching->count()}}</td>
                <td>{{$cancelMoarefeh->count()}}</td>
            </tr>
        </table>
    </div>

    <div class="container">
        <div class="row shadow-lg">
            <div class="col-12 m-5 border-bottom">
                <h3>لیست جلسات رزرو شده</h3>
            </div>
            <div class="col-12" id="colors">
                <div class="row">
                    <div class="col-6 col-sm-1 col-lg-1 col-md-1 col-xl-1 text-center p-0 m-0">
                        <span class="d-inline-block bg-success rounded-circle" ></span>
                    </div>
                    <div class="col-6 col-sm-11 col-lg-2 col-md-2 col-xl-2 p-0 m-0">
                        <p class=" p-0 m-0"> جلسات کوچینگ</p>
                    </div>
                    <div class="col-6 col-sm-1 col-lg-1 col-md-1 col-xl-1 text-center p-0 m-0">
                        <span class="d-inline-block bg-warning rounded-circle" ></span>
                    </div>
                    <div class="col-6 col-sm-11 col-lg-2 col-md-2 col-xl-2 p-0 m-0">
                        <p class=" p-0 m-0"> جلسات معارفه</p>
                    </div>
                </div>

            </div>
            <div class="col-12 border-bottom  mt-3 mb-3">
                <h4>جلسات کوچینگ</h4>
            </div>
            @foreach($heldCoaching as $item)
                <div class="col-lg-3 col-sm-6  mb-1 listFriends @if($item->caption_status=='رزرو شده') bg-warning @elseif($item->caption_status=='برگزار شد') bg-success @endif" id="">
                    <div class="box shadow-lg p-1">
                        <img class="profile" src="{{asset('documents/users/'.$item->personal_image)}}" alt=""/>

                        <div class="box-title">{{$item->fname.' '.$item->lname}}</div>

                        <div class="box-text mt-1" dir="ltr">
                            <p class="border-bottom pb-4">
                                <span class="float-right">
                                    <i class="bi bi-calendar-date-fill"></i>
                                    {{$item->start_date}}
                                </span>
                                <span class="float-left">
                                    <i class="bi bi-clock-fill"></i>
                                    {{$item->start_time}}
                                </span>
                            </p>
                            <p class="border-bottom">
                                {{$item->duration_booking}}
                            </p>
                            <p>{{$item->caption_status}}</p>

                            <!-- <a class="btn btn-primary btn-sm" href="/panel/booking/{{$item->id}}" title="نمایش" >
                                <i class="bi bi-eye-fill"></i>
                            </a>-->
                        </div>
                    </div>
                </div>
            @endforeach



















            <div class="col-12 border-bottom  mt-3 mb-3">
                <h4>جلسات معارفه</h4>
            </div>
            @foreach($heldMoarefeh as $item)
                <div class="col-lg-3 col-sm-6  mb-1 listFriends @if($item->caption_status=='رزرو شده') bg-warning @elseif($item->caption_status=='برگزار شد') bg-success @endif" id="">
                    <div class="box shadow-lg p-1">
                        <img class="profile" src="{{asset('documents/users/'.$item->personal_image)}}" alt=""/>

                        <div class="box-title">{{$item->fname.' '.$item->lname}}</div>

                        <div class="box-text mt-1" dir="ltr">
                            <p class="border-bottom pb-4">
                                <span class="float-right">
                                    <i class="bi bi-calendar-date-fill"></i>
                                    {{$item->start_date}}
                                </span>
                                <span class="float-left">
                                    <i class="bi bi-clock-fill"></i>
                                    {{$item->start_time}}
                                </span>
                            </p>
                            <p class="border-bottom">
                                {{$item->duration_booking}}
                            </p>
                            <p>{{$item->caption_status}}</p>

                        <!-- <a class="btn btn-primary btn-sm" href="/panel/booking/{{$item->id}}" title="نمایش" >
                                <i class="bi bi-eye-fill"></i>
                            </a>-->
                        </div>
                    </div>


                </div>
            @endforeach
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
