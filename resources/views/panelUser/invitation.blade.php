@extends('panelUser.master.index')

@section('headerScript')
    <style>
        #invitation p
        {
            font-size: 20px;
            line-height: 2;
        }

        #invitation span *
        {
            font-size: 32px !important;
        }

        .custom-select
        {
            width: auto !important;
        }


        span.bg-danger
        {
            border-radius: 20px;
        }

    </style>
@endsection

@section('rowcontent')
    <div class="container" id="invitation">
            <div class="row shadow-lg p-3">
                <div class="col-12">
                    <p>سلام</p>
                    <p>از اینکه بعنوان یک عضو از خانواده بزرگ فراکوچ درکنار ما هستی، بسیار مفتخر و خوشحالیم.</p>
                    <p>قصد داریم تا به بهانه رونمایی از دستاوردهای خانواده فراکوچ، و به یمن سالروز ولادت پیامبر اکرم(ص) و امام جعفر صادق(ع) ، رویدادی رو با هدف گردهمایی اعضاء خانواده فراکوچ برگزار کنیم تا از موهبت و لطف درکنار هم بودن در این روز بهره‌مند شویم.</p>
                    <p>پس به این وسیله از شما دعوت می‌کنیم تا در این جشن و گردهمایی حضور یابید</p>
                    <p>اگر افتخار میزبانی شما رو در این جشن داریم لطفا حتما در فرم زیر ما رو مطلع کنید.</p>
                    <p>با سپاس -  مشتاق دیدار شما هستیم</p>
                    <span class="text-center bg-danger text-light font-weight-bold p-3 d-block mb-5" >
                            <i class="bi bi-alarm-fill"></i>
                            <p >زمان: یکشنبه 2 آبان 1400</p><p>مصادف با ولادت پیامبر اکرم (ص) و امام صادق (ع)</p>
                    </span>
                    <span class="text-center bg-danger text-light font-weight-bold p-3 d-block mb-5" >
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
                                    <option value="0" >دانشجو نیستم</option>
                                    @foreach($courses as $item)
                                        @if($item->id!=15)
                                        <option value="{{$item->id}}">{{$item->course}}</option>
                                        @endif
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
