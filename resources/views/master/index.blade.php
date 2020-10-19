<!doctype html>
<html lang="fa">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" >
    <link href="css/bootstrap-rtl.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="slick-1.8.1/slick-1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="slick-1.8.1/slick-1.8.1/slick/slick-theme.css"/>
    <link href="css/style2.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />


    <title>Hello, world!</title>
</head>
<body>
<nav class="navbar sticky-top navbar-expand-lg navbar-light" id="navbartop">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" dir="rtl" id="navbarTogglerDemo01">
        <a class="navbar-brand" href="#">
            <img src="images/white-logo.png" alt="" />
        </a>
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    آموزش کوچینگ
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="#">پکیج رایگان آموزش کوچینگ</a>
                    <a class="dropdown-item" href="#">درخواست کوچینگ سازمانی</a>
                    <a class="dropdown-item" href="#">درخواست مشاوره دوره آموزش کوچینگ</a>
                    <a class="dropdown-item" href="#">آموزش آنلاین کوچینگ و مزایای آن</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    جلسات کوچینگ
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink1">
                    <a class="dropdown-item" href="#">لیست کوچ های حرفه ای</a>
                    <a class="dropdown-item" href="#">درخواست جلسه کوچینگ</a>
                    <a class="dropdown-item" href="#">همکاری به عنوان کوچ</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    کوچینگ چیست
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink1">
                    <a class="dropdown-item" href="#">کوچینگ چیست</a>
                    <a class="dropdown-item" href="#">سفر کوچینگ</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    فراکوچ
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink1">
                    <a class="dropdown-item" href="#">اخبار و اطلاعیه ها</a>
                    <a class="dropdown-item" href="#">چشم انداز و بیانیه ماموریت</a>
                    <a class="dropdown-item" href="#">درباره ما</a>
                    <a class="dropdown-item" href="#">تیم فراکوچ</a>
                    <a class="dropdown-item" href="#">فرصت‌های شغلی فراکوچ</a>
                    <a class="dropdown-item" href="#">فرم بازخورد</a>
                </div>
            </li>
        </ul>
        <a href="">
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-cart3" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
            </svg>
        </a>
        <a href="#" class="btn btn-primary" role="button" aria-pressed="true" id="btnRegister">ورود / ثبت نام</a>

    </div>
</nav>
<main class="container-fluid" dir="rtl">

    <!--************* SLIDESHOW ***************-->
    <header class="row" id="slider">
        <div class="col-12">

        </div>
    </header>

    @yield('row1')

    @yield('row2')

    @yield('row3')

    @yield('row4')

    @yield('row5')

    @yield('row6')

    @yield('row7')

    @yield('row8')

    @yield('row9')
















    <footer class="row">
        <div class="col-12" id="logoFooter">
            <a href="" >
                <img src="images/white-logo.png" />
            </a>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <article class="col-12 titleFooter">
                        <h2>درباره فراکوچ</h2>
                    </article>
                    <div class="col-12 linefooter"></div>
                    <article>
                        <p class="contentFooter">پس از قریب به نیم دهه فعالیت‌های علمی، تحقیقاتی و پژوهشی در حوزه کوچینگ و مباحث توسعه فردی و کسب‌وکار، از سال ۱۳۹۶ مؤسسه «توسعه مربیگری فراکوچ ایرانیان» با هدف «آموزش کوچ‌های حرفه‌ای»، ارائه «خدمات کوچینگ فردی و سازمانی» و «مربیگری و مشاوره توسعه مهارت‌های فردی و شغلی در کسب‌وکار» فعالیت خود را با مجوزهای رسمی توسعه داده است. موسسه فراکوچ در ۵ حوزه کلی خدمات تخصصی خود را ارائه می‌دهد… ادامه مطلب                 </p>
                    </article>
                    <article class="col-12 titleFooter">
                        <h2>ارتباط با فراکوچ</h2>
                    </article>
                    <div class="col-12 linefooter"></div>
                    <article>
                        <p class="contentFooter">در صورت داشتن هر گونه سوال ، انتقاد و پیشنهاد کارشناسان ما آماده پاسخگویی به شما عزیزان می باشند. با ما تماس بگیرید.
                            آدرس : مشهد – خیابان احمد آباد – راهنمایی 20/1 – پ 28 ساختمان آرمان واحد 6</p>
                        <p class="contentFooter">دفتر مرکزی : 05138469020 </p>
                        <p class="contentFooter">مشاوره دوره ها و ثبت نام: 09190179020</p>
                        <p class="contentFooter">واحد هماهنگی جلسات کوچینگ : 09198000747</p>
                        <p class="contentFooter">واحد ثبت نام : 09190119020</p>
                        <p class="contentFooter">روابط عمومی : 09197060068                  </p>
                    </article>
                </div>

                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <article class="col-12 titleFooter">
                        <h2>لینکهای مفید</h2>
                    </article>
                    <div class="col-12 linefooter"></div>
                    <article>
                        <ul >
                            <li class="contentFooter">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-book-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/>
                                </svg>
                                <a href="">آموزش رایگان کوچینگ</a>
                            </li>
                            <li class="contentFooter">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-book-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/>
                                </svg>
                                <a href="">هر آن‌چه در مورد کوچینگ باید بدانید</a>
                            </li>
                        </ul>
                    </article>
                    <article class="col-12 titleFooter">
                        <h2></h2>
                    </article>
                    <div class="col-12 linefooter"></div>
                    <article>
                        <img src="images/location.JPG" class="w-100" />
                    </article>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <article class="col-12 titleFooter">
                        <h2>خبرنامه</h2>
                    </article>
                    <div class="col-12 linefooter"></div>
                    <article id="newsHome">
                        <p class="contentFooter">برای ارسال خبرنامه و اطلاع از جدیدترین دوره‌ها کارگاه‌ها و محصولات آموزشی و فروش‌های ویژه، همین الان ایمیل‌تان را وارد کنید تا به شما خبر بدهیم!
                        </p>
                        <form>
                            <div class="form-group">
                                <input type="email" class="form-control" aria-describedby="emailHelp" placeholder="آدرس پست الکترونیکی خود را وارد  کنید">
                            </div>
                            <button type="submit" class="btn btn-primary w-100">عضویت در خبرنامه</button>
                        </form>
                    </article>
                </div>
                <div class="col-12">
                    <article class="col-12 titleFooter"></article>
                    <div class="col-12 linefooter"></div>
                    <article class="col-12 contentFooter">
                        <p>تمامی حقوق این سایت متعلق به مرکز آموزش کوچینگ ایران فراکوچ است. این سایت در زمینه آموزش کوچینگ و توسعه فردی و سازمانی و تحت قوانین جمهوری اسلامی ایران فعالیت می‌کند.
                        </p>
                    </article>
                </div>
            </div>
        </div>
    </footer>
</main>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="js/jquery-3.5.1.slim.min.js" ></script>
<script src="js/popper.min.js" ></script>
<script src="js/bootstrap.min.js" ></script>
<script type="text/javascript" src="slick-1.8.1/slick-1.8.1/slick/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="slick-1.8.1/slick-1.8.1/slick/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="slick-1.8.1/slick-1.8.1/slick/slick.min.js"></script>
<script>
    $(document).ready(function()
    {
        $('.your-class').slick({
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 3,
            responsive:[
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });

        $('.itemComments').slick(
                {
                    dots:true,
                    arrows:false
                }
        );

        $('.achievement').slick({
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 3,
            autoplay:true,
            dots:false,
            arrows:false,
            responsive:[
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });

        $('.customersItem').slick({
            infinite: true,
            slidesToShow: 4,
            slidesToScroll: 4,
            autoplay:true,
            dots:false,
            arrows:false,
            autoplaySpeed:2000,
            responsive:[
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });

    });
</script>

<script src="js/java.js"></script>
</body>
</html>