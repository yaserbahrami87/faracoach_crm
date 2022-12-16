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

        .card-counter{
            box-shadow: 2px 2px 10px #DADADA;
            margin: 5px;
            padding: 20px 10px;
            background-color: #fff;
            height: 100px;
            border-radius: 5px;
            transition: .3s linear all;
        }

        .card-counter:hover{
            box-shadow: 4px 4px 20px #DADADA;
            transition: .3s linear all;
        }

        .card-counter.primary{
            background-color: #99caff;
            color: #000000;
        }

        .card-counter.danger{
            background-color: #ef5350;
            color: #FFF;
        }

        .card-counter.success{
            background-color: #66bb6a;
            color: #FFF;
        }

        .card-counter.info{
            background-color: #26c6da;
            color: #FFF;
        }

        .card-counter.warning{
            background-color: #e6e600;
            color: #000000 ;
        }

        .card-counter i{
            font-size: 5em;
            opacity: 0.2;
        }

        .card-counter .count-numbers{
            position: absolute;
            right: 35px;
            top: 20px;
            font-size: 25px;
            display: block;
        }

        .card-counter .count-name{
            position: absolute;
            right: 35px;
            top: 65px;
            text-transform: capitalize;
            opacity: 0.5;
            display: block;
            font-size: 14px;
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


    </div>

    <div class="col-md-3">
        <div class="card-counter info">
            <span class="count-numbers text-white">{{$reserveCoaching->count()}} جلسه </span>
            <span class="count-name text-white">جلسه کوچینگ در انتظار رزرو</span>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card-counter info">
            <span class="count-numbers text-white">{{$reserveMoarefeh->count()}} جلسه </span>
            <span class="count-name text-white">جلسه معارفه در انتظار رزرو</span>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card-counter warning">
            <span class="count-numbers text-dark">{{$waitingCoaching->count()}} جلسه </span>
            <span class="count-name text-dark">جلسه کوچینگ رزرو شده</span>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card-counter warning">
            <span class="count-numbers text-dark">{{$waitingMoarefeh->count()}} جلسه </span>
            <span class="count-name text-dark">جلسه معارفه رزرو شده</span>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card-counter success">
            <span class="count-numbers text-white">{{$heldCoaching->count()}} جلسه </span>
            <span class="count-name text-white">جلسه کوچینگ برگزار شده</span>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card-counter success">
            <span class="count-numbers text-white">{{$heldMoarefeh->count()}} جلسه </span>
            <span class="count-name text-white">جلسه  معارفه برگزار شده</span>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card-counter danger">
            <span class="count-numbers text-white">{{$cancelCoaching->count()}} جلسه </span>
            <span class="count-name text-white">جلسه  کوچینگ کنسل شده</span>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card-counter danger">
            <span class="count-numbers text-white">{{$cancelMoarefeh->count()}} جلسه </span>
            <span class="count-name text-white">جلسه معارفه کنسل شده</span>
        </div>
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
            <div class="col-12 table-responsive">
                <table class="table table-striped table-bordered">
                @foreach($heldCoaching as $item)
                    <tr class="@if($item->caption_status=='رزرو شده') bg-warning @elseif($item->caption_status=='برگزار شد') bg-success @endif">
                        <td>{{$loop->iteration}}</td>
                        <td class="p-0">
                            <img src="{{asset('/documents/users/'.$item->personal_image)}}" class="rounded-circle "  width="50px" height="50px" />
                        </td>
                        <td>
                            {{$item->fname.' '.$item->lname}}
                        </td>
                        <td>
                            {{$item->start_date}}
                        </td>
                        <td>
                            {{$item->start_time}}
                        </td>
                        <td>
                            {{$item->duration_booking}}
                        </td>
                        <td>
                            {{$item->caption_status}}
                        </td>
                    </tr>
                @endforeach
                </table>
            </div>



            <div class="col-12 border-bottom  mt-3 mb-3">
                <h4>جلسات معارفه</h4>
            </div>
            <div class="col-12 table-responsive">
                <table class="table table-striped table-bordered">
                    @foreach($heldMoarefeh as $item)
                        <tr class="@if($item->caption_status=='رزرو شده') bg-warning @elseif($item->caption_status=='برگزار شد') bg-success @endif">
                            <td>{{$loop->iteration}}</td>
                            <td class="p-0">
                                <img src="{{asset('/documents/users/'.$item->personal_image)}}" class="rounded-circle "  width="50px" height="50px" />
                            </td>
                            <td>
                                {{$item->fname.' '.$item->lname}}
                            </td>
                            <td>
                                {{$item->start_date}}
                            </td>
                            <td>
                                {{$item->start_time}}
                            </td>
                            <td>
                                {{$item->duration_booking}}
                            </td>
                            <td>
                                {{$item->caption_status}}
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

@endsection

@section('footerScript')



    <script src="{{asset('/js/vue@2.js')}}"></script>
    <script src="{{asset('/js/moment.js')}}"></script>
    <script src="{{asset('/js/moment-jalaali.js')}}"></script>
    <script src="{{asset('/js/vue-persian-datetime-picker-browser.js')}}"></script>
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
