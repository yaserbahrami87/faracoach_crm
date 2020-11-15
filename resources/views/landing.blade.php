@extends('masterLanding.master')
@section('rowTopBlue')
    <section class="col-sm-12 col-md-6 col-lg-6 col-xl-6" id="rightOff">
        <h2>برای اولین بار در ایران و فقط برای همین یکبار</h2>
    </section>
    <section class="col-sm-12 col-md-6 col-lg-6 col-xl-6" id="leftOff">
        <h2>12,900,000 ریال</h2>
        <h2>رایگان</h2>
        <ul id="example" dir="ltr">
            <li><span class="days">00</span><p class="days_text">روز</p></li>

            <li><span class="hours">00</span><p class="hours_text">ساعت</p></li>

            <li><span class="minutes">00</span><p class="minutes_text">دقیقه</p></li>

            <li><span class="seconds">00</span><p class="seconds_text">ثانیه</p></li>
        </ul>
        <image src="{{asset('landing/images/arrow.png')}}" id="arrow" width="120px" alt=""/>
        <div class="col-12" id="formBox">
            @if(session('msg') && (session('errorStatus')))
                <div class="alert alert-{{session('errorStatus')}}">
                    <p>{{session('msg')}}</p>
                </div>
            @endif
            @if($errors->any())
                @foreach($errors->all() as $item)
                    <div class="alert alert-danger">
                        <li>{{$item}}</li>
                    </div>
                @endforeach
            @endif
            <form method="POST" action="/landingPage/store">
                {{csrf_field()}}
                <div class="input-group input-group-lg mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">تلفن همراه</span>
                    </div>
                    <input type="text" class="form-control" placeholder="تلفن همراه خود را وارد کنید"  aria-describedby="basic-addon1" name="tel" />
                </div>
                <div class="input-group input-group-lg mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon2">پست الکترونیکی</span>
                    </div>
                    <input type="email" class="form-control" placeholder="پست الکترونیکی خود را وارد کنید" aria-describedby="basic-addon2" name="email" />
                </div>
                <button type="submit" class="btn btn-primary btn-block">دریافت پکیج رایگان</button>
            </form>
        </div>
    </section>
    <section class="col-12">

    </section>
@endsection
@section('rowShoar')
    <h2 id="h2_shoar">ما ضمانت می کنیم که یک بار مهارتی می آموزید که تا آخر عمر از آن بهره خواهید برد ...</h2>
@endsection

@section('whiteBox')
    <div class="col-12" id="whiteBox">
        <h2 class="mt-5">فقط و فقط برای همین یکبار</h2>
        <h1 class="mt-3">دوره ویدئویی آموزش کوچینگ حرفه ای</h1>
        <h2 class="mt-3">موسسه فراکوچ- اولین و تنها آموزشگاه مجاز آموزش کوچینگ ایران</h2>
        <h3 class="mt-3">کامـــلا رایگان</h3>
        <h2 class="mt-3">به مناسبت ولادت با سعادت پیغمبر اکرم صلی الله علیه و آله</h2>
        @if(session('msg1') && (session('errorStatus1')))
            <div class="alert alert-{{session('errorStatus1')}}">
                <p>{{session('msg1')}}</p>
            </div>
        @endif
        @if($errors->any())
            @foreach($errors->all() as $item)
                <div class="alert alert-danger">
                    <li>{{$item}}</li>
                </div>
            @endforeach
        @endif
        <form method="POST" action="/landingPage/store1">
            {{csrf_field()}}
            <div class="input-group input-group-lg mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">تلفن همراه</span>
                </div>
                <input type="text" class="form-control" placeholder="تلفن همراه خود را وارد کنید"  aria-describedby="basic-addon1" name="tel1" />
            </div>
            <div class="input-group input-group-lg mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon2">پست الکترونیکی</span>
                </div>
                <input type="email" class="form-control" placeholder="پست الکترونیکی خود را وارد کنید" aria-describedby="basic-addon2" name="email1" />
            </div>
            <button type="submit" class="btn btn-primary btn-block">دریافت پکیج رایگان</button>
        </form>
    </div>
@endsection
