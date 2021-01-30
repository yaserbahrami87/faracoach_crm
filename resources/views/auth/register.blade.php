@extends('master.index')

@section('navbarTop')
    @include('master.navbarTop')
@endsection

@section('row1')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('ثبت نام') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        {{csrf_field()}}
                        <div class="form-group row">
                            <label for="fname" class="col-md-4 col-form-label text-md-right">{{ __('نام:') }}</label>

                            <div class="col-md-6">
                                <input id="fname" type="text" class="form-control @error('fname') is-invalid @enderror" name="fname" value="{{ old('fname') }}" lang="fa" required autocomplete="fname" autofocus>

                                @error('fname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <input type="hidden" value="0" name="tel_verified" id="tel_verified"/>
                        <div class="form-group row">
                            <label for="lname" class="col-md-4 col-form-label text-md-right">{{ __('نام خانوادگی:') }}</label>

                            <div class="col-md-6">
                                <input id="lname" type="text" class="form-control @error('lname') is-invalid @enderror"  lang="fa" name="lname" value="{{ old('lname') }}" required autocomplete="lname" autofocus>

                                @error('lname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('جنسیت:') }}</label>

                            <div class="col-md-6">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="gender1" name="sex" class="custom-control-input"  value="1">
                                    <label class="custom-control-label" for="gender1" >مرد</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="gender2" name="sex" class="custom-control-input" value="0">
                                    <label class="custom-control-label" for="gender2" >زن</label>
                                </div>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('پست الکترونیکی:') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tel" class="col-md-4 col-form-label text-md-right">{{ __('تلفن همراه:') }}</label>

                            <div class="col-md-6">
                                <div class="input-group">
                                    <input id="tel" type="text" class="form-control @error('tel') is-invalid @enderror" name="tel" value="{{ old('tel') }}" required autocomplete="tel">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-outline-secondary btn-info text-light" type="button" id="activeMobile" data-toggle="modal" data-target="#ModalMobile">فعال سازی</button>
                                    </div>
                                    @error('tel')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tel" class="col-md-4 col-form-label text-md-right">{{ __('معرف:') }}</label>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input id="introduced" type="text" class="form-control @error('introduced') is-invalid @enderror" value="{{ old('introduced') }}" autocomplete="introduced">

                                    @error('introduced')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tel" class="col-md-4 col-form-label text-md-right"></label>
                            <div class="col-md-6">
                                <span id="feedback_introduced" ></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4 col-form-label text-right" >
                                <a class="btn btn-primary" data-toggle="collapse" href="#Organization" role="button" class="text-md-right  text-dark">{{ __('اطلاعات سازمان:') }}</a>                                   
                            </div>
                            <div class="col-md-6">
                                <div class="collapse" id="Organization">
                                    <div class="card card-body border-0">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="organization">ارگان</label>
                                                <input id="organization" type="text" name="organization" class="form-control @error('organization') is-invalid @enderror" value="{{ old('organization') }}" autocomplete="organization">            
                                                @error('organization')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="jobside">سمت</label>
                                                <input id="jobside" type="text"  name="jobside" class="form-control @error('jobside') is-invalid @enderror" value="{{ old('jobside') }}" autocomplete="jobside">            
                                                @error('jobside')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>    
                        <div class="form-group row">
                            <label for="gettingknow" class="col-md-4 col-form-label text-md-right">{{ __('نحوه آشنایی با فراکوچ:') }}</label>

                            <div class="col-md-6">
                                <select id="gettingknow" class="form-control" @error('gettingknow') is-invalid @enderror" name="gettingknow">
                                    <option selected disabled>انتخاب کنید</option>
                                    <option>اینستاگرام</option>
                                    <option>تلگرام</option>
                                    <option>تبلیغاتی محیطی</option>
                                    <option>تبلیغات فضای مجازی</option>
                                    <option>پکیج رایگان</option>
                                    <option>واتساپ</option>
                                    <option>موتورهای جستجو</option>
                                </select>
                                @error('gettingknow')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('رمز عبور:') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('تکرار رمز عبور:') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('ثبت نام') }}
                                </button>
                                <a class="btn btn-link" href="/login">
                                    {{ __('ورود') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

 <!-- Modal -->
 <div class="modal fade" id="ModalMobile" tabindex="-1" aria-labelledby="ModalMobile" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body" id="modal_body">
            </div>
        </div>
    </div>
</div>


@endsection
