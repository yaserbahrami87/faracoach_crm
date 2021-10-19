@extends('panelUser.master.index')

@section('headerScript')
    <style>
        #invitation p
        {
            font-size: 20px;
        }

        #invitation span *
        {
            font-size: 32px !important;
        }

        .custom-select
        {
            width: auto !important;
        }
    </style>
@endsection

@section('rowcontent')
    <div class="container" id="invitation">
        <div class="row shadow-lg p-3">
            <div class="col-12">
                <p>سلام</p>
                <p>از اینکه به عنوان خانواده فراکوچ در کنار ما هستی، باعث افتخار ماست.</p>
                <p>همونطور که می دونی فراکوچ در روزهای اخیر، به دستاوردهای قابل توجهی دست پیدا کرده. </p>
                <p>ما می خوایم در کنار شما این دستاورد ها رو جشن بگیریم.</p>
                <p>پس از تو دعوت می کنیم تا در این جشن در کنار ما باشی و لحظات خوبی رو باهم بسازیم.</p>
                <span class="text-center bg-danger text-light font-weight-bold p-3 d-block mb-5" >
                        <i class="bi bi-alarm-fill"></i>
                        <p >زمان: یکشنبه 2 آبان 1400</p><p>مصادف با ولادت پیامبر اکرم (ص) و امام صادق (ع)</p>
                </span>
                <span class="text-center bg-danger text-light font-weight-bold p-3 d-block mb-5">
                        <i class="bi bi-geo-alt-fill"></i>
                        <p>مکان: به صورت حضوری در مشهد - </p>
                        <p>و به صورت آنلاین در اینستاگرام کارت دعوت برای شما ارسال میشه.</p>
                </span>
                <p>اگر افتخار میزبانی شما رو در این جشن داریم در فرم زیر به ما اطلاع بده:</p>
                <form method="post" action="/panel/landing/invitation/">
                    {{csrf_field()}}
                    <div class="col-12">
                        <p>اینجانب {{Auth::user()->fname." ".Auth::user()->lname}}
                            دانشپذیر دوره
                            <select class="custom-select" name="options">
                                <option selected disabled>انتخاب دوره</option>
                                @foreach($courses as $item)
                                    <option value="{{$item->id}}">{{$item->course}}</option>

                                @endforeach
                            </select>
                            حضور خود را برای شرکت در گردهمایی به صورت
                            <select class="custom-select" name="count">
                                <option selected disabled>انتخاب کنید</option>
                                <option value="0">حضوری</option>
                                <option value="1">آنلاین</option>
                            </select>
                            اعلام می نمایم
                        </p>
                        <input type="submit" class="btn btn-success btn-lg float-left" value="ثبت درخواست " />
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
