@extends('master.index')

@section('headerscript')
    <style>
        .btnContactSubmit
        {
            width: 50%;
            border-radius: 1rem;
            padding: 1.5%;
            color: #fff;
            background-color: #0062cc;
            border: none;
            cursor: pointer;
            margin-right: 6%;
            background-color: white;
            color: blue;
            margin-top: 4%;
        }
        .register .nav-tabs .nav-link:hover{
            border: none;
        }
        .text-align{
            margin-top: -3%;
            margin-bottom: -9%;

            padding: 10%;
            margin-left: 30%;
        }
        .form-new{
            margin-right: 22%;
            margin-left: 20%;
        }
        .register-heading{
            margin-left: 21%;
            margin-bottom: 10%;
            color: #e9ecef;
        }
        .register-heading h1{
            margin-left: 21%;
            margin-bottom: 10%;
            color: #e9ecef;
        }
        .btnLoginSubmit{
            border: none;
            padding: 2%;
            width: 25%;
            cursor: pointer;
            background: #29abe2;
            color: #fff;
        }
        .btnForgetPwd{
            cursor: pointer;
            margin-right: 5%;
            color: #f8f9fa;
        }
        .register{
            background: -webkit-linear-gradient(left, #3931af, #00c6ff);
            margin-top: 3%;
            padding: 3%;
            border-radius: 2.5rem;
        }
        .nav-tabs .nav-link{
            border: 1px solid transparent;
            border-top-left-radius: .25rem;
            border-top-right-radius: .25rem;
            color: white;
        }
    </style>
@endsection
@section('row1')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <a href="" class="">
                <img src="{{asset('/images/logo-colored.png')}}" class="mb-4"/>
            </a>
        </div>
    </div>
</div>








<div class="container register">
    <div class="row">
        <div class="col-md-12">
            @if($errors->any())
                <div class="col-12">
                    <div class="alert alert-danger" role="alert">
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </div>
                </div>
            @endif
            <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">ورود با شماره همراه</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">ورود با ایمیل</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active text-align form-new" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="row register-form">
                        <div class="col-md-12">
                            <form method="POST" action="{{ route('login') }}">
                                {{csrf_field()}}
                                <div class="form-group row">
                                    <label for="exampleInputEmail1">شماره همراه:</label>
                                    <input type="hidden" id="tel_org" value="{{ old('email') }}" name="email"/>
                                    <input id="tel" type="tel" class="form-control @error('email') is-invalid @enderror"  value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group row">
                                    <label for="exampleInputEmail1">{{ __('رمز عبور:') }}</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-8 offset-md-4 mb-1">
                                        <button type="submit" class="btn btn-primary mb-1">
                                            {{ __('ورود') }}
                                        </button>
                                        <a class="btn btn-link  btn-light mb-1" href="/loginSMS">
                                            {{ __('ورود بدون رمز') }}
                                        </a>
                                    </div>
                                </div>
                                <div class="form-group row m-0 p-0">
                                    <div class="col-md-6 col-12">
                                        <a class="btn text-light mb-1" href="/register">
                                            {{ __('ثبت نام') }}
                                        </a>
                                        @if (Route::has('password.request'))
                                            <a class="btn text-light mb-1" href="{{ route('password.request') }}">
                                                {{ __('رمز را فراموش کردید؟') }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade show text-align form-new" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="row register-form">
                        <div class="col-md-12">
                            <form method="POST" action="{{ route('login') }}">
                                {{csrf_field()}}
                                <div class="form-group row">
                                    <label for="exampleInputEmail1">ایمیل:</label>
                                    <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group row">
                                    <label for="exampleInputEmail1">{{ __('رمز عبور:') }}</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-8 offset-md-4 mb-1">
                                        <button type="submit" class="btn btn-primary mb-1">
                                            {{ __('ورود') }}
                                        </button>
                                        <a class="btn btn-link  btn-light mb-1" href="/loginSMS">
                                            {{ __('ورود بدون رمز') }}
                                        </a>
                                    </div>
                                </div>
                                <div class="form-group row m-0 p-0">
                                    <div class="col-md-6 col-12">
                                        <a class="btn text-light mb-1" href="/register">
                                            {{ __('ثبت نام') }}
                                        </a>
                                        @if (Route::has('password.request'))
                                            <a class="btn text-light mb-1" href="{{ route('password.request') }}">
                                                {{ __('رمز را فراموش کردید؟') }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('footerScript')

    <script>
        var input = document.querySelector("#tel");
        var intl=intlTelInput(input,{
            formatOnDisplay:false,
            separateDialCode:true,
            preferredCountries:["ir", "gb"]
        });



        input.addEventListener("countrychange", function() {
            document.querySelector("#tel_org").value=intl.getNumber();
        });

        $('#tel').change(function()
        {
            document.querySelector("#tel_org").value=intl.getNumber();
        });
    </script>
@endsection

