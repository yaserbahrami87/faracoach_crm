@extends('master.index')

@section('headerscript')


    <!--====== Line Icons css ======-->
    <link rel="stylesheet" href='{{ asset("/tamamiat/css/LineIcons.css") }}' />

    <!--====== Magnific Popup css ======-->
    <link rel="stylesheet" href="{{asset('/tamamiat/css/magnific-popup.css')}}" />

    <!--====== Slick css ======-->
    <link rel="stylesheet" href="{{asset('/tamamiat/css/slick.css')}}">

    <!--====== Animate css ======-->
    <link rel="stylesheet" href="{{asset('/tamamiat/css/animate.css')}}" />

    <!--====== Default css ======-->
    <link rel="stylesheet" href='{{asset("/tamamiat/css/default.css")}}' />

    <!--====== Style css ======-->
    <link rel="stylesheet" href="{{asset('/tamamiat/css/style.css')}}" />
    <style>
        .container-fluid{
            padding:0!important;
        }
    </style>
@endsection

@section('row1')

    <!--====== PRELOADER PART START ======-->

    <div class="preloader ">
        <div class="loader">
            <div class="ytp-spinner">
                <div class="ytp-spinner-container">
                    <div class="ytp-spinner-rotator">
                        <div class="ytp-spinner-left">
                            <div class="ytp-spinner-circle"></div>
                        </div>
                        <div class="ytp-spinner-right">
                            <div class="ytp-spinner-circle"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--====== PRELOADER PART ENDS ======-->

    <!--====== NAVBAR PART START ======-->



    <!--====== NAVBAR PART ENDS ======-->

    <!--====== SAIDEBAR PART START ======-->

    <!--<div class="sidebar-right">
        <div class="sidebar-close">
            <a class="close" href="#close"><i class="lni-close"></i></a>
        </div>
        <div class="sidebar-content">
            <div class="sidebar-logo text-center">
                <a href="#"><img src="assets/images/logo-alt.png" alt="Logo"></a>
            </div>  --> <!-- logo -->
    <!-- <div class="sidebar-menu">
         <ul>
             <li><a href="#">ABOUT</a></li>
             <li><a href="#">SERVICES</a></li>
             <li><a href="#">RESOURCES</a></li>
             <li><a href="#">CONTACT</a></li>
         </ul>
     </div>--> <!-- menu -->
    <!--<div class="sidebar-social d-flex align-items-center justify-content-center">
        <span>FOLLOW US</span>
        <ul>
            <li><a href="#"><i class="lni-twitter-original"></i></a></li>
            <li><a href="#"><i class="lni-facebook-filled"></i></a></li>
        </ul>
    </div>--> <!-- sidebar social -->
    <!--</div>--><!-- content -->
    <!--</div>
    <div class="overlay-right"></div>-->

    <!--====== SAIDEBAR PART ENDS ======-->

    <!--====== ABOUT PART START ======-->

    <section id="about" class="about-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="section-title text-center mt-30 pb-40">
                        <h4 class="title wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="0.6s">تمامیت</h4>
                        <p class="wow text-justify fadeInUp" data-wow-duration="1.5s" data-wow-delay="1s">با مقوله « تمامیت » (integrity) چقدر آشنا هستید؟ آیا میدانید در حال حاضر، «تمامیت داشتن» ، یکی از مهمترین فاکتورهای سازمانهای بزرگ برای استخدام کارکنان است؟</p>
                        <p class="wow text-justify fadeInUp" data-wow-duration="1.5s" data-wow-delay="1s">آیا میدانستید تمامیت ، در کنار منابع چهارگانه سازمانها، بعنوان یکی از مهمترین عوامل موفقیت یا عدم موفقیت سازمانها و برندهاست؟</p>
                        <p class="wow text-justify fadeInUp" data-wow-duration="1.5s" data-wow-delay="1s">آیا میدانستید، مهمترین عامل برای ساختن پرسنال برند ( برند شخصی ) و حتی برند سازمانی، داشتن تمامیت و به کارگیری دستورات «قانون تمامیت » است؟</p>
                        <p class="wow text-justify fadeInUp b" data-wow-duration="1.5s" data-wow-delay="1s">وارن بافت ، سرمایه گذار و کارآفرین امریکایی : وقتی میخواهید فردی را استخدام کنید، به سه قابلیت اصلی او توجه کنید: تمامیت، هوشمندی، انرژی یادتان باشد که اگر اولی را نداشته باشد، دو مورد بعدی شما را خواهد کشت.</p>
                    </div> <!-- section title -->
                </div>
            </div> <!-- row -->

            <div class="row">
                <div class="col-12">
                    <h4 class="title wow fadeInUp text-center" data-wow-duration="1.5s" data-wow-delay="0.6s">اما تمامیت چیست؟</h4>
                    <p class="text-justify">
                        تمامیت مفهومی از تمام و کمال بودن است. خودرویی را فرض کنید که چرخ ندارد، این خودرو هرگز کارکرد درستی نخواهد داشت. حتی جزئی تر از آن، خودرویی را تصور کنید که یک برف پاک کن ساده را ندارد ، باز هم یک خودرو تمام و کمال نخواهد بود و در شرایط بحرانی ممکن است باعث بروز خسارت های جدی به ما شود.
                    </p>
                    <p class="text-justify">
                        تمامیت در انسانها هم تقریبا به همین شکل است. اگر ما یک فرد تمام و کمال نباشیم چگونه میتوانیم اهدافمان را به درستی تدوین و اجرا کنیم؟ چگونه نزدیکان ما میتوانند به ما اعتماد کنند؟ و اگر کسی به ما اعتماد نداشته باشد، چگونه میتوانیم در ایجاد روابط اجتماعی و عاطفی موفق باشیم.
                    </p>
                    <p style="font-weight: bolder" class="mt-2">تمامیت یعنی صادقانه رفتار کردن، متعهد بودن در قبال مسئولیتها، پذیرش خطای خود و جبران آن، احترام به دیگران و قابلاعتماد بودن. بهطورکلی فردی که تمامیت دارد از انجام کاری که برخلاف ارزشهای اخلاقی است، صرفنظر میکند؛ چون به خود و ارزشهای خود وفادار و پایبند است.</p>
                    <p>پروفسور مایکل جنسن ، استاد ممتاز دانشگاه هاروارد پس از حدود یک دهه تحقیق و بررسی سازمانها و برندهای موفق و ناموفق، متوجه شد که اغلب شکستها، حتی در سازمانهایی که بودجه های کلانی را صرف تبلیغات و برندسازی و حتی تجهیزات و فناوری کردهاند، نداشتن « تمامیت» بوده است.</p>
                    <p>و موسسه فراکوچ با همکاری موسسه مدیران ایران با توجه به اهمیت شناخت و بهکارگیری تمامیت در زندگی امروزی، بر آن شدند تا با برگزاری یک وبینار با محوریت موضوع تمامیت، به معرفی این ویژگی مهم و تأثیرگذار بپردازد.</p>
                </div>
                <div class="col-12">
                    <h4>محوریت این وبینار چیست؟</h4>
                    <p>در این وبینار بیشتر به مفهوم تمامیت و تحولی که در زندگی ایجاد خواهد کرد میپردازیم. با درک بهتر از تمامیت، بهتر میتوانیم تمامیت را به زندگی شخصی آورده و حتی آن را به محیط کار ببریم و از مزایای آن استفاده کنیم. با پیشرفت علمی و درک عمیقی که افراد از زندگی باکیفیت به دست آوردهاند، بحث تمامیت خود یک دانشگاه توسعه فردی محسوب میشود که به افزایش کیفیت روابط، افزایش اعتماد و احترام میانجامد.</p>
                </div>
                <div class="col-lg-6">

                    <div class="single-about text-justify d-sm-flex mt-30 wow fadeInUp rtl" data-wow-duration="1.5s" data-wow-delay="1.2s">
                        <div class="about-icon">
                            <img src="{{asset('/images/faracoach-logo.png')}}" alt="Icon">
                        </div>
                        <div class="about-content media-body">
                            <h4 class="about-title">فرصت را از دست ندهید</h4>
                            <p class="text">شرکت در این وبینار برای هر فرد لازم است؛ چراکه:
                                علاوه بر آشنایی با مفهوم تمامیت با کاربردهای آن در زندگی شخصی و کسب‌وکار خود نیز آشنا خواهید شد. اینکه چگونه افراد تمامیت را در فضای کسب‌وکار و زندگی خود پیاده‌سازی کنند. چگونه با تمامیت زندگی خود را تغییر دهند و تحولی عظیم اول در خود و کم‌کم پس‌ازآن، در اجتماع ایجاد کنند. در وبینار تمامیت به بررسی گام‌هایی خواهیم پرداخت که شما را به سمت داشتن تمامیت در زندگی سوق می‌دهند.
                            </p>
                        </div>

                    </div> <!-- single about -->
                </div>
                <div class="col-lg-6">
                    <div class="single-about text-justify d-sm-flex mt-30 wow fadeInUp rtl" data-wow-duration="1.5s" data-wow-delay="1.4s">
                        <div class="about-icon">
                            <img src="{{asset('/images/modiran-iran-logo.png')}}" alt="Icon">
                        </div>
                        <div class="about-content media-body">
                            <h4 class="about-title">محوریت این وبینار چیست؟</h4>
                            <p class="text">در این وبینار بیشتر به مفهوم تمامیت و تحولی که در زندگی ایجاد خواهد کرد می‌پردازیم. با درک بهتر از تمامیت، بهتر می‌توانیم تمامیت را به زندگی شخصی آورده و حتی آن را به محیط کار ببریم و از مزایای آن استفاده کنیم. با پیشرفت علمی و درک عمیقی که افراد از زندگی باکیفیت به دست آورده‌اند، بحث تمامیت خود یک دانشگاه توسعه فردی محسوب می‌شود که به افزایش کیفیت روابط، افزایش اعتماد و احترام می‌انجامد..</p>
                        </div>

                    </div> <!-- single about -->
                </div>
                <div class="col-12 text-center d-sm-flex wow fadeInUp" style="margin: 35px;" data-wow-duration="1.5s" data-wow-delay="1.4s">
                    <div class="about-content media-body">
                        <h4 class="about-title">:پس اگر تصمیم دارید از همین امروز تمامیت را از خود نشان دهید، باید بگویم که</h4>
                        <p class="text"> .اولین گام آن ثبت‌نام در این وبینار و آشنایی با آن است </p>
                        <h4 class="text about-title" style="margin: 25px;" >تاریخ برگزاری این وبینار </h4>
                        <h4 class="text about-title" style="margin: 25px 0 15px 0;"  >مدرسین وبینار </h4>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="single-about text-justify d-sm-flex mt-30 wow fadeInUp rtl" data-wow-duration="1.5s" data-wow-delay="1.6s">
                        <div class="about-icon">
                            <img src="{{asset('/images/neda.jpg')}}" alt="Icon">
                        </div>
                        <div class="about-content media-body">
                            <h4 class="about-title">خانم ندا مفاخری </h4>
                            <p class="text">خانم مفاخری مدیرعامل مدیران ایران، مربی حرفه‌ای توسعه فردی و سازمانی ICF هستند. ایشان دارای مدرک DBA، نویسنده صدها مقاله و مطلب مدیریتی بوده و در این حوزه سخنران و مدرس هم می‌باشند. خانم مفاخری به مطالبی در مورد مفهوم تمامیت، تمامیت و تحول، تمامیت در زندگی شخصی و تمامیت در فضای کسب‌وکار خواهند پرداخت.</p>
                        </div>
                    </div> <!-- single about -->
                </div>
                <div class="col-lg-6">
                    <div class="single-about text-justify d-sm-flex mt-30 wow fadeInUp rtl" data-wow-duration="1.5s" data-wow-delay="1.8s">
                        <div class="about-icon">
                            <img src="{{asset('/images/yaser.jpg')}}" alt="Icon">
                        </div>
                        <div class="about-content media-body">
                            <h4 class="about-title">استاد یاسر متحدین </h4>
                            <p class="text">استاد یاسر متحدین مؤسس مرکز آموزش کوچینگ ایران، بنیان‌گذار بنیاد کوچ‌های حرفه‌ای ایران دارای مدرک دکترای حرفه‌ای مدیریت کسب‌وکار DBA، عضو فدراسیون بین‌المللی کوچینگ ICF و کوچ حرفه‌ای بین‌المللی PCC هستند. ایشان سرپرست هیئت‌علمی آموزشگاه فراکوچ و مدیر مرکز مشاوره و اطلاع‌رسانی کارآفرینی در خراسان رضوی بوده و سابقه بیش از 1000 نفر ساعت تجربه تدریس و اجرای کوچینگ برای افراد، مدیران و سازمان‌های خصوصی و دولتی دارند. آقای متحدین بیشتر در مورد کاربردهای تمامیت در زندگی برای ما خواهند گفت.</p>
                        </div>
                    </div> <!-- single about -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>

    <!--====== ABOUT PART ENDS ======-->

    <!--====== portfolio PART START ======-->

    <section id="portfolio" class="portfolio-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section-title text-center pb-20">
                        <h3 class="title">Our Portfolio</h3>
                        <p class="text">Stop wasting time and money designing and managing a website that doesn’t get results. Happiness guaranteed!</p>
                    </div> <!-- row -->
                </div>
            </div> <!-- row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="portfolio-menu pt-30 text-center rtl">
                        <ul>
                            <li data-filter="*" class="active">پلتفرم برگزاری وبینار </li>
                            <li data-filter=".branding-3">هزینه</li>
                            <li data-filter=".marketing-3">مزایا</li>
                            <li data-filter=".planning-3">نحوه ثبت‌نام</li>
                        </ul>
                    </div> <!-- portfolio menu -->
                </div>
            </div> <!-- row -->
            <div class="row grid">
                <div class="col-lg-4 col-sm-6 branding-3 planning-3">
                    <div class="single-portfolio mt-30 wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="0.2s">
                        <div class="portfolio-image">
                            <img src="assets/images/portfolio-1.png" alt="">
                            <div class="portfolio-overlay d-flex align-items-center justify-content-center">
                                <div class="portfolio-content">
                                    <div class="portfolio-icon">
                                        <a class="image-popup" href="assets/images/portfolio-1.png"><i class="lni-zoom-in"></i></a>
                                    </div>
                                    <div class="portfolio-icon">
                                        <a href="#"><i class="lni-link"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="portfolio-text rtl">
                            <h4 class="portfolio-title"><a href="#">پلتفرم برگزاری وبینار</a></h4>
                            <p class="text">این وبینار بی‌نظیر در فضای اسکای روم برگزار می‌شود که امکان حضور را پس از تکمیل ثبت‌نام و دریافت یوزر و پسورد از همکاران ما در بخش ثبت‌نام، خواهید داشت.</p>
                        </div>
                    </div> <!-- single portfolio -->
                </div>
                <div class="col-lg-4 col-sm-6 marketing-3 research-3">
                    <div class="single-portfolio mt-30 wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="0.4s">
                        <div class="portfolio-image">
                            <img src="assets/images/portfolio-2.png" alt="">
                            <div class="portfolio-overlay d-flex align-items-center justify-content-center">
                                <div class="portfolio-content">
                                    <div class="portfolio-icon">
                                        <a class="image-popup" href="assets/images/portfolio-2.png"><i class="lni-zoom-in"></i></a>
                                    </div>
                                    <div class="portfolio-icon">
                                        <a href="#"><i class="lni-link"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="portfolio-text rtl">
                            <h4 class="portfolio-title"><a href="#">هزینه شرکت در وبینار</a></h4>
                            <p class="text">400 تومن ولی الان رایگانه</p>
                        </div>
                    </div> <!-- single portfolio -->
                </div>
                <div class="col-lg-4 col-sm-6 branding-3 marketing-3">
                    <div class="single-portfolio mt-30 wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="0.7s">
                        <div class="portfolio-image">
                            <img src="assets/images/portfolio-3.png" alt="">
                            <div class="portfolio-overlay d-flex align-items-center justify-content-center">
                                <div class="portfolio-content">
                                    <div class="portfolio-icon">
                                        <a class="image-popup" href="assets/images/portfolio-3.png"><i class="lni-zoom-in"></i></a>
                                    </div>
                                    <div class="portfolio-icon">
                                        <a href="#"><i class="lni-link"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="portfolio-text rtl">
                            <h4 class="portfolio-title"><a href="#">مزایای شرکت در این وبینار</a></h4>
                            <ol class="text"><li>درک مفهوم تمامیت و تلاش برای به‌کارگیری آن به‌منظور افزایش کیفیت زندگی</li>
                                <li>درک اهمیت تمامیت و نقش آن در زندگی اجتماعی امروزی</li>
                                <li>به‌کارگیری آن در تمامی جوانب زندگی و محل کار</li>
                                <li>متعهد شدن به آنچه می‌گوییم و باور داریم و ...</li>
                            </ol>
                        </div>
                    </div> <!-- single portfolio -->
                </div>
            </div>
            <!--<div class="row grid text-center ">
                <div class="col-lg-6 col-sm-12 ">
                    <div class="single-portfolio mt-30 wow fadeInUp " data-wow-duration="1.5s" data-wow-delay="0.2s">
                        <div class="portfolio-image ">
                            <img class="" src="assets/images/portfolio-4.png" alt="">
                            <div class="portfolio-overlay d-flex align-items-center justify-content-center">
                                <div class="portfolio-content">
                                    <div class="portfolio-icon">
                                        <a class="image-popup" href="assets/images/portfolio-4.png"><i class="lni-zoom-in"></i></a>
                                    </div>
                                    <div class="portfolio-icon">
                                        <a href="#"><i class="lni-link"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="portfolio-text">
                            <h4 class="portfolio-title"><a href="#">Graphics Design</a></h4>
                            <p class="text">Short description for the ones who look for something new. Awesome!</p>
                        </div>
                    </div>--> <!-- single portfolio -->
            <!--</div>
        </div>-->
        </div> <!-- container -->
    </section>

    <!--====== portfolio PART ENDS ======-->

    <!--====== PRINICNG STYLE EIGHT START ======-->

    <section id="pricing" class="pricing-area">
        <div class="container">
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
                    <div class="col-md-4 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('ثبت نام') }}
                        </button>
                        <a class="btn btn-link" href="/login">
                            {{ __('ورود') }}
                        </a>
                    </div>
                </div>
            </form>
        </div> <!-- container -->
    </section>

@endsection

@section('footerScript')
    <footer>
        <a href="#top" class="back-to-top button icon invert plain fixed bottom z-1 is-outline hide-for-medium circle active " id="top-link">
            <i class="icon-angle-up"></i></a>

        <!--====== jquery js ======-->
        <script src='{{ asset("/tamamiat/js/vendor/modernizr-3.6.0.min.js") }}'></script>
        <script src='{{ asset("/tamamiat/js/vendor/jquery-1.12.4.min.js") }}'></script>


        <!--====== Slick js ======-->
        <script src='{{ asset("/tamamiat/js/slick.min.js") }}'></script>

        <!--====== Isotope js ======-->
        <script src='{{ asset("/tamamiat/js/isotope.pkgd.min.js") }}'></script>

        <!--====== Images Loaded js ======-->
        <script src='{{ asset("/tamamiat/js/imagesloaded.pkgd.min.js") }}'></script>

        <!--====== Magnific Popup js ======-->
        <script src='{{ asset("/tamamiat/js/jquery.magnific-popup.min.js") }}'></script>

        <!--====== Scrolling js ======-->
        <script src='{{ asset("/tamamiat/js/scrolling-nav.js") }}'></script>
        <script src='{{ asset("/tamamiat/js/jquery.easing.min.js") }}'></script>

        <!--====== wow js ======-->
        <script src='{{ asset("/tamamiat/js/wow.min.js") }}'></script>

        <!--====== Main js ======-->
        <script src='{{ asset("/tamamiat/js/main.js") }}'></script>
    </footer>
@endsection

