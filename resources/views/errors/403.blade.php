@extends('master.index')
@section('headerscript')
    <style>
        #img-403 {
            max-width:80%;
        }
        p{
            font-size: 2rem;
        }

        #text_403 p
        {
            font-size: 1.2rem;
        }

        @media (min-width: 320px) and (max-width:767px){
            p{
                font-size: 17px;
            }
            #img-403 {
                max-width:100%;
            }

        }
    </style>
@endsection
@section('row1')
    <body>
    <div class="col-12 text-center mt-xl-5 mt-lg-5 mt-md-4 mt-sx-3 ">
        <img src="{{asset('images/403.png')}} " id="img-403" alt="responsive img" />
        <p class="font-weight-bold mt-xl-5 mt-lg-5 mt-md-5 mt-sx-5">شما مجوز ورود به این صفحه را ندارید!</p>
    </div>
    <div class="col-12" id="text_403" >
        <p>دوستِ من</p>
        <p>برای ورود به این صفحه باید عضو پرتال باشی</p>
        <p class="mt-2 mb-2">اگر قبلا عضو شدی، فقط کافیه از دکمه ورود استفاده کنی و وارد بشی.</p>
        <p class="mt-2 mb-2">این رو بدون که بعضی صفحات نیاز به دسترسی مدیریت سایت داره و کاربران عادی نمی تونن وارد اون صفحه بشن.</p>
    </div>
    <div class="col-12 text-center">
        <a href= "/login" class="btn btn-primary mt-xl-5 mt-lg-5 mt-md-4 mt-sx-3" >ورود / ثبت نام </a>
    </div>
    </body>

@endsection
