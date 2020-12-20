@if($user->tel_verified==0)
    <div class="col-12">
        <div class="alert alert-warning">
            برای ادامه فعالیت باید تلفن همراه خود را در سیستم فراکوچ ثبت کنید
        </div>
        @if ($verifyStatus==false)
            <form method="get" action="/panel/active/mobile/">
                <div class="input-group">
                    <input id="tel" type="text" class="form-control @error('tel') is-invalid @enderror" name="tel" value="{{ old('tel') }}" required autocomplete="tel">
                    <div class="input-group-prepend ">
                        <button class="btn btn-outline-secondary btn-info text-light m-0" type="submit" id="activeMobile" data-toggle="modal" data-target="#ModalMobile">ارسال کد فعال سازی</button>
                    </div>
                </div>
            </form>
        @else
            <div class="alert alert-warning">
                جهت فعال سازی کد ارسال شده به تلفن همراه را وارد کنید
            </div>
            <form method="post" action="/panel/active/mobile/code">
                {{csrf_field()}}
                <div class="input-group">
                    <input id="tel" type="text" class="form-control @error('tel') is-invalid @enderror" name="tel" value="{{ old('tel') }}" required autocomplete="tel">
                    <div class="input-group-prepend ">
                        <button class="btn btn-outline-secondary btn-info text-light m-0" type="submit" id="activeMobile" data-toggle="modal" data-target="#ModalMobile">فعال سازی</button>
                    </div>
                </div>
            </form>
        @endif

    </div>

@endif
<div class="col-lg-4 col-md-6 col-sm-6 card_home_user">
    <div class="card card-stats">
        <div class="card-body ">
            <div class="row">
                <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                        <i class="nc-icon nc-send text-warning"></i>
                    </div>
                </div>
                <div class="col-7 col-md-8">
                    <div class="numbers">
                        <p class="card-category">پیام</p>
                        <p class="card-title">{{$unreadMessage}} ناخوانده<p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer ">
            <hr>
            <div class="stats">
                <i class="fa fa-eye mr-1"></i>
                <a href="/panel/messages/">مشاهده</a>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-4 col-md-6 col-sm-6 card_home_user">
    <div class="card card-stats">
        <div class="card-body ">
            <div class="row">
                <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                        <i class="nc-icon nc-hat-3 text-success"></i>
                    </div>
                </div>
                <div class="col-7 col-md-8">
                    <div class="numbers">
                        <p class="card-category">وضعیت</p>
                        <p class="card-title">
                            @switch($user->type)
                                @case('1')پیگیری نشده
                                    @break
                                @case('11') در حال پیگیری
                                    @break
                                @case('12') انصراف
                                    @break
                                @case('20') دانشجو
                                    @break
                                @default خطا
                            @endswitch
                        <p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer ">
            <hr>
            <div class="stats">
                <i class="fa fa-calendar-o"></i>
                    در حال بروزرسانی
            </div>
        </div>
    </div>
</div>
<div class="col-lg-4 col-md-6 col-sm-6 card_home_user">
    <div class="card card-stats">
        <div class="card-body ">
            <div class="row">
                <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                        <i class="nc-icon nc-user-run text-danger"></i>
                    </div>
                </div>
                <div class="col-7 col-md-8">
                    <div class="numbers">
                        <p class="card-category">افراد دعوت شده</p>
                        <p class="card-title">{{$countIntroducedUser}} نفر<p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer ">
            <hr>
            <div class="stats">
                <i class="fa fa-eye"></i>
                <a href="/panel/introduced">مشاهده</a>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-4 col-md-6 col-sm-6 card_home_user">
    <div class="card card-stats">
        <div class="card-body ">
            <div class="row">
                <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                        <i class="nc-icon nc-trophy text-success"></i>
                    </div>
                </div>
                <div class="col-7 col-md-8">
                    <div class="numbers">
                        <p class="card-category">امتیازات</p>
                        <p class="card-title">{{$score}} امتیاز<p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer ">
            <hr>
            <div class="stats">
                <i class="fa fa-eye"></i>
                <a href="#">مشاهده</a>
            </div>
        </div>
    </div>
</div>
