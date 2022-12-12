@extends('user.master.index')

@section('headerScript')
    <style>
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
            color: #FFF;
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
    <div class="col-12">
        <p>گزارش عملکرد {{$coach->fname}} {{$coach->lname}}</p>
        <div id="app" class="col-md-4">
            <p>انتخاب بازه زمانی</p>
            <form method="get" action="/panel/booking/report" id="formBooking">
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
            <span class="count-numbers text-white">{{$waitingCoaching->count()}} جلسه </span>
            <span class="count-name text-white">جلسه کوچینگ رزرو شده</span>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card-counter warning">
            <span class="count-numbers text-white">{{$waitingMoarefeh->count()}} جلسه </span>
            <span class="count-name text-white">جلسه معارفه رزرو شده</span>
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
