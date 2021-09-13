@extends('master.index')
@section('row1')
    <style>



        h1{
            font-size:28px;
            color:rgb(13 44 90);
            padding-bottom:10px;
            font-weight:700;
        }
        h2{
            font-size:24px;
            color:rgb(13 44 90);
            padding:18px 0 10px 0;
            font-weight:600;
        }
        .mad{
            background-color:#f7f7f7;
        }
        p, a, ol, li{
            text-align:justify;
            margin-top:10px;
            line-height: 2;
            font-size:16px;
        }
        .text-img{
            border:1px solid #ced4da;
        }
        .img{
            width:50%;
            height: 50%;
        }
        /* Small devices (320 px) */
        @media only screen and (max-width: 321px){
            .title{
                font-size:20px;
            }
            p, a,li{
                font-size:12px;
            }
            h2{
                font-size:16px;
            }

        }

    </style>
    <div class="container mt-5" id="int">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div >
                    <img src="{{asset('/images/int.png')}}" target="_blank" class="img-fluid img-thumbnail " />
                    <div class="text-center title mt-3">
                        <h1>وبینار تمامیت</h1>
                    </div>
                    <p>
                        با مقوله « تمامیت » (integrity) چقدر آشنا هستید؟ آیا میدانید در حال حاضر، «تمامیت داشتن» ، یکی از مهمترین فاکتورهای سازمانهای بزرگ برای استخدام کارکنان است؟
                        <br/>
                        آیا میدانستید تمامیت ، در کنار منابع چهارگانه سازمانها، بعنوان یکی از مهمترین عوامل موفقیت یا عدم موفقیت سازمانها و برندهاست؟
                        <br/>
                        آیا می‌دانستید، مهمترین عامل برای ساختن پرسنال برند ( برند شخصی ) و حتی برند سازمانی، داشتن تمامیت و به کارگیری دستورات «قانون تمامیت » است؟
                </div>
                <div class="row col-12 mad">
                    <div class="p-5 mt-5 col-8  text-justify">
                        <p>وارن بافت ، سرمایه گذار و کارآفرین امریکایی : وقتی میخواهید فردی را استخدام کنید، به سه قابلیت اصلی او توجه کنید:<strong> تمامیت، هوشمندی، انرژی </strong>یادتان باشد که اگر اولی را نداشته باشد، دو مورد بعدی شما را خواهد کشت.
                        </p>
                    </div>
                    <div class="p-3 col-4 text-justify ">
                        <img src="{{asset('/images/وارن-بافت.jpg')}}" target="_blank" class="img-fluid img-thumbnail border border-primary" />
                    </div>
                </div>
                <h2 class="text-center">
                    اما تمامیت چیست؟
                </h2>
                <p>
                    تمامیت مفهومی از تمام و کمال بودن است. خودرویی را فرض کنید که چرخ ندارد، این خودرو هرگز کارکرد درستی نخواهد داشت. حتی جزئی تر از آن، خودرویی را تصور کنید که یک برف پاک کن ساده را ندارد ، باز هم یک خودرو تمام و کمال نخواهد بود و در شرایط بحرانی ممکن است باعث بروز خسارت های جدی به ما شود.                        <br/>
                    در وبینار کاربرد کوچینگ برای روانشناسان و مشاوران دراین‌باره خواهیم گفت .
                    <br/>
                    تمامیت مفهومی از تمام و کمال بودن است. خودرویی را فرض کنید که چرخ ندارد، این خودرو هرگز کارکرد درستی نخواهد داشت. حتی جزئی تر از آن، خودرویی را تصور کنید که یک برف پاک کن ساده را ندارد ، باز هم یک خودرو تمام و کمال نخواهد بود و در شرایط بحرانی ممکن است باعث بروز خسارت های جدی به ما شود.
                </p>
                <div class=" row  p-3 col-12">
                    <div class=" feed col-xl-4 col-lg-4 col-md-4 col-sm-12">
                        <div id="97454693371"><script type="text/JavaScript" src="https://www.aparat.com/embed/5JOI3?data[rnddiv]=97454693371&data[responsive]=yes"></script></div>
                    </div>
                    <div class=" feed col-xl-4 col-lg-4 col-md-4 col-sm-12">
                        <div id="60738551128"><script type="text/JavaScript" src="https://www.aparat.com/embed/jdl9N?data[rnddiv]=60738551128&data[responsive]=yes"></script></div>
                    </div>
                    <div class=" feed col-xl-4 col-lg-4 col-md-4 col-sm-12">
                        <div id="75923739805"><script type="text/JavaScript" src="https://www.aparat.com/embed/5jvpk?data[rnddiv]=75923739805&data[responsive]=yes"></script></div>
                    </div>
                    <p>
                        تمامیت در انسانها هم تقریبا به همین شکل است. اگر ما یک فرد تمام و کمال نباشیم چگونه می‌توانیم اهدافمان را به درستی تدوین و اجرا کنیم؟ چگونه نزدیکان ما می‌توانند به ما اعتماد کنند؟ و اگر کسی به ما اعتماد نداشته باشد، چگونه می‌توانیم در ایجاد روابط اجتماعی و عاطفی موفق باشیم.
                        <br/><strong>
                            تمامیت یعنی صادقانه رفتار کردن، متعهد بودن در قبال مسئولیت‌ها، پذیرش خطای خود و جبران آن، احترام به دیگران و قابل‌اعتماد بودن. به‌طورکلی فردی که تمامیت دارد از انجام کاری که برخلاف ارزش‌های اخلاقی است، صرف‌نظر می‌کند؛ چون به خود و ارزش‌های خود وفادار و پایبند است.
                        </strong>
                    </p>
                    <div class="row col-12 mad">
                        <div class="p-5 mt-5 col-8  text-justify">
                            <p>
                                پروفسور مایکل جنسن ، استاد ممتاز دانشگاه هاروارد پس از حدود یک دهه تحقیق و بررسی سازمانها و برندهای موفق و ناموفق، متوجه شد که اغلب شکست‌ها، حتی در سازمان‌هایی که بودجه های کلانی را صرف تبلیغات و برندسازی و حتی تجهیزات و فناوری کرده‌اند، نداشتن « تمامیت» بوده است.
                            </p>
                        </div>
                        <div class="p-3 col-4 text-justify ">
                            <img src="{{asset('/images/jjjjjj.jpg')}}" target="_blank" class="img-fluid img-thumbnail border border-primary" />
                        </div>
                    </div>
                    <p class="text-center font-weight-bold">
                        و موسسه فراکوچ با همکاری موسسه مدیران ایران با توجه به اهمیت شناخت و به‌کارگیری تمامیت در زندگی امروزی، بر آن شدند تا با برگزاری یک وبینار با محوریت موضوع تمامیت، به معرفی این ویژگی مهم و تأثیرگذار بپردازد.
                    </p>
                    <div class="row col-12 mad">
                        <div class="p-3 col-12 text-justify">
                            <h2 class="text-left" >
                                محوریت این وبینار چیست؟
                            </h2>
                            <p>
                                در این وبینار بیشتر به مفهوم تمامیت و تحولی که در زندگی ایجاد خواهد کرد می‌پردازیم. با درک بهتر از تمامیت، بهتر می‌توانیم تمامیت را به زندگی شخصی آورده و حتی آن را به محیط کار ببریم و از مزایای آن استفاده کنیم. با پیشرفت علمی و درک عمیقی که افراد از زندگی باکیفیت به دست آورده‌اند، بحث تمامیت خود یک دانشگاه توسعه فردی محسوب می‌شود که به افزایش کیفیت روابط، افزایش اعتماد و احترام می‌انجامد.
                            </p>
                        </div>
                    </div >
                    <div class="col-12">
                        <h2 class="text-center text-danger display-4">
                            این یک جمله انگیزشی و یا اغراق شده نیست:
                        </h2>
                        <h3 class="text-center display-5" >شرکت در این وبینار می‌تواند یک تغییر اساسی در زندگی شخصی و کاری شما ایجاد کند</h3>
                    </div>


                    <p  class="mt-3 text-center">
                        شرکت در این وبینار برای هر فرد لازم است؛ چراکه:
                        <br/>
                        علاوه بر آشنایی با مفهوم تمامیت با کاربردهای آن در زندگی شخصی و کسب‌وکار خود نیز آشنا خواهید شد. اینکه چگونه افراد تمامیت را در فضای کسب‌وکار و زندگی خود پیاده‌سازی کنند. چگونه با تمامیت زندگی خود را تغییر دهند و تحولی عظیم اول در خود و کم‌کم پس‌ازآن، در اجتماع ایجاد کنند. در وبینار تمامیت به بررسی گام‌هایی خواهیم پرداخت که شما را به سمت داشتن تمامیت در زندگی سوق می‌دهند.
                    </p>
                    <div class="col-12">
                        <h2 class="text-center text-dark ">
                            پس اگر تصمیم دارید از همین امروز تمامیت را از خود نشان دهید، باید بگویم که
                            <br/>
                            <small>اولین گام آن ثبت‌نام در این وبینار و آشنایی با آن است.</small>
                        </h2>
                    </div>
                    <div class="col-12 m-4 text-danger">
                        <h2 class="text-center display-5">
                            تاریخ برگزاری این وبینار
                        </h2>
                        <p class="text-center display-4 ">
                            پنج‌شنبه ۱ مهر ساعت ۱۷:۰۰
                        </p>
                    </div>
                    <div class="col-12 mad">
                        <div class="row">
                            <div class="col-12">
                                <h2 class="text-center">
                                    مدرسین وبینار
                                </h2>
                                <p class="text-center">
                                    این وبینار با حضور سرکار خانم ندا مفاخری و استاد یاسر متحدین برگزار خواهد شد.
                                </p>
                            </div>
                            <div class="p-3 col-6 text-center ">
                                <img src="{{asset('/images/neda.jpg')}}" target="_blank" class="img-fluid img-thumbnail border border-primary" />
                                <p class="text-justify">
                                    خانم دکتر مفاخری مدیرعامل مدیران ایران، مربی حرفه‌ای توسعه فردی و سازمانی ICF هستند. ایشان دارای مدرک DBA، نویسنده صدها مقاله و مطلب مدیریتی بوده و در این حوزه سخنران و مدرس هم می‌باشند. خانم دکتر مفاخری به مطالبی در مورد مفهوم تمامیت، تمامیت و تحول، تمامیت در زندگی شخصی و تمامیت در فضای کسب‌وکار خواهند پرداخت.
                                </p>
                            </div>
                            <div class="p-3 col-6 text-center">
                            <img src="{{asset('/images/yaser.jpg')}}" target="_blank" class="img-fluid img-thumbnail border border-primary" />
                            <p class="text-justify">
                                استاد یاسر متحدین مؤسس مرکز آموزش کوچینگ ایران، بنیان‌گذار بنیاد کوچ‌های حرفه‌ای ایران دارای مدرک دکترای حرفه‌ای مدیریت کسب‌وکار DBA، عضو فدراسیون بین‌المللی کوچینگ ICF و کوچ حرفه‌ای بین‌المللی PCC هستند. ایشان سرپرست هیئت‌علمی آموزشگاه فراکوچ و مدیر مرکز مشاوره و اطلاع‌رسانی کارآفرینی در خراسان رضوی بوده و سابقه بیش از 1000 نفر ساعت تجربه تدریس و اجرای کوچینگ برای افراد، مدیران و سازمان‌های خصوصی و دولتی دارند. آقای متحدین بیشتر در مورد کاربردهای تمامیت در زندگی برای ما خواهند گفت.                            </p>
                        </div>
                        </div>
                    </div>
                    <div class="row col-12">
                        <div class="text p-3 col-xl-3 col-lg-3 col-md-3 col-sm-6 " style="text-align:center;">
                        <!--<img src="{{asset('/images/ravanshenasi.jpg')}}" target="_blank" class="img-fluid img-thumbnail border border-primary"/>
    --> <p class="text-center text-primary display-5 font-weight-bold">پلتفرم برگزاری وبینار تمامیت</p>
                            <p class="text-justify"> این وبینار بی‌نظیر در فضای اسکای روم برگزار می‌شود که امکان حضور را پس از تکمیل ثبت‌نام و دریافت یوزر و پسورد از همکاران ما در بخش ثبت‌نام، خواهید داشت.</p>
                        </div>
                        <div class="text p-3 col-xl-3 col-lg-3 col-md-3 col-sm-6 " style="text-align:center;">
                        <!--<img src="{{asset('/images/ravanshenasi.jpg')}}" target="_blank" class="img-fluid img-thumbnail border border-primary"/>
    --> <p class="text-center text-primary display-5 font-weight-bold">هزینه شرکت در وبینار</p>
                            <del class="text-justify font-weight-bold text-danger">ارزش سرمایه گزاری : 4.000.000</del>
                            <p class="text-center font-weight-bold display-4">رایگان</p>
                        </div>
                        <div class="text p-3 col-xl-3 col-lg-3 col-md-3 col-sm-6 " style="text-align:center;">
                        <!--<img src="{{asset('/images/ravanshenasi.jpg')}}" target="_blank" class="img-fluid img-thumbnail border border-primary"/>
    --><p class="text-center text-primary display-5 font-weight-bold">مزایای شرکت در این وبینار</p>
                            <ol>
                                <li class="text-justify">درک مفهوم تمامیت و تلاش برای به‌کارگیری آن به‌منظور افزایش کیفیت زندگی</li>
                                <li class="text-justify">درک اهمیت تمامیت و نقش آن در زندگی اجتماعی امروزی</li>
                                <li class="text-justify">به‌کارگیری آن در تمامی جوانب زندگی و محل کار</li>
                                <li class="text-justify">متعهد شدن به آنچه می‌گوییم و باور داریم و...</li>
                            </ol>
                        </div>
                        <div class="text p-3 col-xl-3 col-lg-3 col-md-3 col-sm-6 " style="text-align:center;">
                        <!--<img src="{{asset('/images/ravanshenasi.jpg')}}" target="_blank" class="img-fluid img-thumbnail"/>
    --><p class="text-center text-primary display-5 font-weight-bold">نحوه ثبت‌نام</p>
                            <p class="text-justify"> برای شرکت در این وبینار تمامیت تنها کافی است روی لینک زیر کلیک کنید و با درج موارد موردنیاز ثبت‌نام خود را نهایی کنید و از این وبینار ارزشمند بهره‌مند شوید..</p>
                        </div>
                    </div>
                </div>
                <p>
                    جهت کسب اطلاعات بیشتر و شرکت در این وبینار فرم زیر را تکمیل فرمایید.
                </p>
            </div>
        </div>

        <form method="POST" action="{{ route('register') }}">
            {{csrf_field()}}
            <div class="form-group row">
                <label for="fname" class="col-md-4 col-form-label text-md-right">{{ __('نام: *') }}</label>
                <div class="col-md-4">
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

                <div class="col-md-4">
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

                <div class="col-md-4">
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

                <div class="col-md-4">
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

                <div class="col-md-4">
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

                <div class="col-md-4">
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

                <div class="col-md-4">
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

                <div class="col-md-4">
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


@endsection

@section('footerScript')
    <script>

        window.location="#int";

    </script>
@endsection
