@extends('panelAdmin.master.index')

@section('navbarTop')
    @include('master.navbarTop')
@endsection

@section('rowcontent')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header border-bottom pb-3 bg-light">{{ __('ثبت نام کاربر جدید') }}</div>

                    <div class="card-body">
                        <form method="POST" action="/admin/register">
                            {{csrf_field()}}
                            <div class="form-group row">
                                <label for="fname" class="col-md-4 col-form-label text-md-right">{{ __('نام:') }}</label>

                                <div class="col-md-6">
                                    <input id="fname" type="text" class="form-control @error('fname') is-invalid @enderror" name="fname" value="{{ old('fname') }}" lang="fa"  autocomplete="fname" autofocus>

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
                                    <input id="lname" type="text" class="form-control @error('lname') is-invalid @enderror"  lang="fa" name="lname" value="{{ old('lname') }}"  autocomplete="lname" autofocus>

                                    @error('lname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('پست الکترونیکی:') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email">

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
                                    <input id="tel" type="text" class="form-control @error('tel') is-invalid @enderror" name="tel" value="{{ old('tel') }}" required autocomplete="tel">

                                    @error('tel')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="tel" class="col-md-4 col-form-label text-md-right">{{ __('معرف:') }}</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input id="introduced_registerAdmin" type="text" class="form-control @error('introduced') is-invalid @enderror" value="{{ old('introduced') }}" autocomplete="introduced">

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
                                <label for="sendSMS" class="col-md-4 col-form-label text-md-right">ارسال پیامک</label>
                                <div class="col-md-6 mr-5">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="sendsms" id="sendsms1" value="0" checked>
                                        <label class="form-check-label" for="sendsms1">
                                            ارسال نشود
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="sendsms" id="sendsms2"  value="                                            خانم/آقای ....محترم  ممنون از تماس شما.مشخصات شما در باشگاه مشتریان فراکوچ ثبت شد.به زودی باشما تماس خواهیم گرفت.">
                                        <label class="form-check-label" for="sendsms2">
                                            خانم/آقای ....محترم  ممنون از تماس شما.مشخصات شما در باشگاه مشتریان فراکوچ ثبت شد.به زودی باشما تماس خواهیم گرفت.
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="sendsms" id="sendsms3" value="خانم/آقای ... محترم شما توسط ... به باشگاه مشتریان فراکوچ دعوت شدید">
                                        <label class="form-check-label" for="sendsms3">
                                           خانم/آقای ... محترم شما توسط ... به باشگاه مشتریان فراکوچ دعوت شدید
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="sendsms" id="sendsms3" value="جناب آقای / خانم ... موسسه فراکوچ مقدم شما را گرامی می دارد">
                                        <label class="form-check-label" for="sendsms3">
                                            جناب آقای / خانم ... موسسه فراکوچ مقدم شما را گرامی می دارد
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('ثبت نام') }}
                                    </button>
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
