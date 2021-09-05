@extends('master.index')
@section('row1')
    <style>



        .title{
            font-size:20px;
            text-align:center;
            color:rgb(13 44 90);
            padding-bottom:10px;
        }
        p{
            text-align:justify;
            margin-top:10px;
            line-height: 3;
        }
        .text-img{
            border:1px solid #ced4da;
        }
        .img{
            width:50%;
            height: 50%;
        }
        /* Small devices (320 px) */
        @media (min-width: 320px ) and (max-width: 321px){
            .title{
            font-size:14px;
            }

        }




    </style>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div >
                    <div class="title mt-3">
                            توضیحات موسسه فراکوچ نسبت به اطلاعیه سازمان نظام روانشناسی و مشاوره کشور
                    </div>
                    <p>
                        به اطلاع می‌رساند مرکز آموزش کوچینگ ایران – فراکوچ در تاریخ 21 مرداد 1400، در قالب پیغام صوتی ضبط شده با فعالین حوزه روانشناسی تماس گرفته و متخصصین این حوزه را برای شرکت در دوره اختصاصی کوچینگ، ویژه روانشناسان دعوت نمود.
                    </p>
                    <p>
                        در استناد به بیانات جناب آقای دکتر محمد ابراهیم مداحی، معاون و بنیانگذار سازمان نظام روانشناسی و مشاوره کشور در همایش آموزشی «فرصت های نوین شغلی و بهبود کسب و کار در روانشناسی و مشاوره» در تاریخ 1 آذر 1388 در حضور جمعی از  روانشناسان و مشاوران استان خراسان رضوی، به حاضرین در این همایش توصیه می‌کنند که «بسیاری از مسائل مراجعین با سیستم سریع و همه جانبه کوچینگ رفع مشکل می شوند»، در متن پیغام ارسالی به روانشناسان این مطلب سهواً و اشتباهاً از قول رئیس سازمان روانشناسی کشور نقل شده بود.
                    </p>
                    <p>
                        موسسه فراکوچ حسب الامر وظیفه اخلاقی و در کمال احترام و عذرخواهی در خصوص اشتباه پیش آمده، مراتب پیگیری قانونی را توسط نامه ای رسمی به شماره 12/117 تاریخ 1400/05/30 به سازمان روانشناسی کشور اعلام نمود که علارغم پیگیری های متعدد پاسخی از سوی مقامات این سازمان دریافت نشد.
                    </p>

                    <div class="row col-12 ">

                        <div class="img p-3 col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <img src="{{asset('/images/ravanshenasi.jpg')}}" target="_blank" class="img-fluid img-thumbnail" />
                        </div>
                        <div class="text p-3 col-xl-6 col-lg-6 col-md-6 col-sm-12 ">
                            <div id="77958893894"><script type="text/JavaScript" src="https://www.aparat.com/embed/pF4rM?data[rnddiv]=77958893894&data[responsive]=yes"></script></div>
                        </div>
                    </div>
                    <p>
                        لذا سبب شفاف‌سازی برای قشر فرهیخته روانشناسی، در تاریخ 11 شهریور 1400، پیغام صوتی دیگری برای این افراد ارسال شد و ضمن عذرخواهی توضیحات اصلاحیه به حضور این افراد رسید و مجددا برای شرکت در دوره آموزشی از ایشان دعوت به عمل آمد.
                    </p>
                    <p>
                        طی دو مرحله در تاریخ های 22 مرداد و 12 شهریور تکذیبیه هایی از سوی سازمان نظام روانشناسی و مشاوره کشور منتشر شد که توضیحات تکمیلی به شرح ذیل اعلام می‌گردد:
                    </p>
                    <p>
                        بدینوسیله اعلام می‌شود با کمال احترام به مدیران سازمان نظام رواشناسی و مشاوره کشور، اعضای این سازمان، متخصصین و فعالین حوزه مشاوره، روانشناسی و درمان، موسسه فراکوچ هیچ‌گونه تاییدیه یا همکاری با سازمان نظام روانشناسی نداشته و مستقلاً با مجوزهایی از سازمان فنی و حرفه ای و اداره تعاون، کار و رفاه اجتماعی فعالیت می‌نماید.
                    </p>
                    <p>
                        همچنین این موسسه توانسته است، مهارت کوچینگ را به عنوان استاندارد آموزش شایستگی در سازمان فنی و حرفه ای و سازمان جهانی کار ILO با کد ملی آموزش شایستگی 524920450010111 تدوین و ثبت نماید.
                    </p>
                    <div class=" row col-12">
                        <div class=" license p-3 col-xl-4 col-lg-4 col-md-4 col-sm-12">
                            <img class="img-fluid img-thumbnail" src="{{asset('/images/madrak.jpeg')}}" target="_blank">
                        </div>

                        <div class=" license p-3 col-xl-4 col-lg-4 col-md-4 col-sm-12" >
                            <img src="{{asset('/images/mojavez sherkat.jpeg')}}" target="_blank" class="img-fluid img-thumbnail" />
                        </div>
                        <div class="img p-3 col-xl-4 col-lg-4 col-md-4 col-sm-12">
                            <img src="{{asset('/images/fani herfei.jpg')}}" target="_blank" class="img-fluid img-thumbnail" />
                        </div>
                    </div>

                    <p>
                        دانش کوچینگ مهارتی بین رشته ای و مستقل از رشته های روانشناسی می باشد؛ اما اعتقادات بنیادین را از روانشناسی مثبت گرا الهام می‌گیرد. همچنین اعلام می گردد افرادی که کوچینگ را آموخته اند یا تدریس می‌نمایند، هیچ‌گونه ادعایی در خصوص مباحث روانشناسی نداشته و خود را روانشناس اعلام نمی‌کنند (مگر با داشتن مدرک تحصیلی روانشناسی و عضویت در سازمان نظام روانشناسی کشور)؛ زیرا مباحث علمی و مهارتی کوچینگ ساختاری مجزا از روانشناسی دارد.
                    </p>
                    <p class="text-center font-weight-bold">
                            <a href="https://faracoach.com/coaching-and-positive-psychology/" target="_blank">لینک مقاله روانشناسی مثبت گرا و کوچینگ</a>
                    </p>
                    <p>
                        لازم به ذکر است، تعداد بسیار زیادی از روانشناسان، مشاوران و صاحب نظران این حوزه در دوره های آموزش کوچینگ شرکت کرده و تجارب مفید و ارزشمندی را در این حوزه کسب کرده اند. به گفته این افراد: دانش کوچینگ تاثیرات مثبت قابل توجهی در جلسات مشاوره و درمان دارد و از نظر ابزار شباهت های بسیار زیادی بین مشاوره، روانشناسی، درمانگری و کوچینگ وجود دارد.
                    </p>
                    <div class="title">در ادامه تجربه چند تن از صاحب‌نظران و متخصصین حوزه روانشناسی به حضور تقدیم می ‌گردد:</div>
                    <div class=" row  p-3 col-12">
                        <div class=" feed col-xl-4 col-lg-4 col-md-4 col-sm-12">
                            <div id="97273034136"><script type="text/JavaScript" src="https://www.aparat.com/embed/Y0G85?data[rnddiv]=97273034136&data[responsive]=yes"></script></div>
                        </div>
                        <div class=" feed col-xl-4 col-lg-4 col-md-4 col-sm-12">
                            <div id="33541903482"><script type="text/JavaScript" src="https://www.aparat.com/embed/KFT9a?data[rnddiv]=33541903482&data[responsive]=yes"></script></div>
                        </div>
                        <div class=" feed col-xl-4 col-lg-4 col-md-4 col-sm-12">
                            <div id="64109404953"><script type="text/JavaScript" src="https://www.aparat.com/embed/OwgnD?data[rnddiv]=64109404953&data[responsive]=yes"></script></div>
                        </div>
                    </div>
                    <p>
                        لذا با توجه به توضیحات ارائه شده و ایجاد شفافیت بیشتر، مرکز آموزش کوچینگ ایران – فراکوچ، آمادگی خود را جهت برگزاری وبینار آشنایی با مهارت کوچینگ اعلام می‌دارد.
                    </p>
                    <div class="title">
                        جهت کسب اطلاعات بیشتر و شرکت در این وبینار فرم زیر را تکمیل فرمایید.
                    </div>
                    <p class="text-center">
                        <a href="https://faracoach.com/about/" target="_blank" >جهت آشنایی بیشتر با موسسه فراکوچ اینجا کلیک کنید.</a>
                    </p>

                </div>
                <form method="POST" action="{{ route('register') }}">
                    {{csrf_field()}}
                    <div class="form-group row">
                        <label for="fname" class="col-md-4 col-form-label text-md-right">{{ __('نام: *') }}</label>

                        <div class="col-md-6">
                            <input id="fname" type="text" class="form-control @error('fname') is-invalid @enderror" name="fname" value="{{ old('fname') }}" required autocomplete="fname" autofocus>

                            @error('fname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <input type="hidden" value="0" name="tel_verified" id="tel_verified"/>
                    <div class="form-group row">
                        <label for="lname" class="col-md-4 col-form-label text-md-right">{{ __('نام خانوادگی: *') }}</label>

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
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('جنسیت: *') }}</label>

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
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('پست الکترونیکی: *') }}</label>

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
                        <label for="tel" class="col-md-4 col-form-label text-md-right">{{ __('تلفن همراه: *') }}</label>

                        <div class="col-md-6">
                            <div class="input-group">
                                <input id="tel" type="text" class="form-control @error('tel') is-invalid @enderror" name="tel" value="{{ old('tel') }}" required autocomplete="tel">
                                <!--
                                <div class="input-group-prepend">
                                    <button class="btn btn-outline-secondary btn-info text-light" type="button" id="activeMobile" data-toggle="modal" data-target="#ModalMobile">فعال سازی</button>
                                </div>
                                -->
                                @error('tel')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
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
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('رمز عبور: *') }}</label>

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
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('تکرار رمز عبور: *') }}</label>

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
