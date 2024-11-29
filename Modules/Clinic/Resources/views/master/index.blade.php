<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>کلینیک فراکوچ </title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="/images/img/favicon.png"rel="icon">
    <link href="/images/img/apple-touch-icon.png" rel="apple-touch-icon">


    <!-- Vendor CSS Files -->

    <link href="/vendor/aos/aos.css" rel="stylesheet">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/bootstrap-rtl.css" >
    <link href=/css/stepwizard.css rel="stylesheet" />

    <!-- Template Main CSS File -->
    <link href="/css/style_t.css" rel="stylesheet">

    <script src="/js/sweetalert.min.js"></script>

    @yield('headerScript')

</head>

<body>
<!-- ======= Header ======= -->

<header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center justify-content-lg-between">
        <h1 class="logo me-auto me-lg-0"><a href="index.html"><img src="{{asset('/images/img/CFC LOGO.png')}}" alt="" class="img-fluid"></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <nav id="navbar" class="navbar order-last order-lg-0" >
            <ul>
                <li><a class="nav-link scrollto active" href="/" > صفحه اصلی  </a></li>
                <li><a class="nav-link scrollto " href="/coaches/all">لیست کوچ ها</a></li>
                <li><a class="nav-link scrollto" href="/event">رویداد ها</a></li>
                <li><a class="nav-link scrollto" href="/courses">دوره ها </a></li>
                <li><a class="nav-link scrollto" href="#team">تست</a></li>
                <li><a class="nav-link scrollto" href="#contact">ارتباط با ما </a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->
        @if(Auth::check())
            <ul class="nav nav-pills">
                <li class="nav-item dropdown get-started-btn scrollto">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        {{Auth::user()->fname}} {{Auth::user()->lname}}
                        <i class="bi bi-person-circle"></i>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="/panel">صفحه مدیریت</a>
                        <a class="dropdown-item" href="/panel/user/password">تغییر رمز </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/logout">خروج</a>
                    </div>
                </li>
            </ul>
        @else
            <a href="/login" class="btn btn-primary" role="button" aria-pressed="true" id="btnRegister">ورود / ثبت نام</a>
        @endif
    </div>
</header><!-- End Header -->

<main id="main" >
    @include('sweet::alert')
    @yield('content')

</main><!-- End #main -->

<!-- ======= Footer ======= -->
<footer id="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="footer-info">
                        <h3>کلینیک فراکوچ</h3>
                        <p>
                            <strong>شماره تماس :</strong> 02191091121<br>
                            <strong>پست الکترونیک : </strong> faracoach@gmail.com<br>
                        </p>
                        <div class="social-links mt-3">
                            <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                            <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                            <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                            <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                            <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 footer-newsletter">
                    <h4>اخبار جدید  ما</h4>
                    <p>برای دریافت  اخرین اخبار تلفن خود را وارد کنید</p>
                    <form action="" method="post">
                        <input type="email" name="email"><input type="submit" value="شماره تماس">
                    </form>
                </div>
            </div>
        </div>
    </div>


</footer><!-- End Footer -->

<div id="preloader"></div>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="/js/jquery-3.5.1.min.js"></script>
<script src="/dashboard/plugins/jquery/jquery.slim.js"></script>
<script src="/js/popper.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="/vendor/aos/aos.js"></script>
<script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/vendor/glightbox/js/glightbox.min.js"></script>
<script src="/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="/vendor/swiper/swiper-bundle.min.js"></script>
<script src="/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="{{asset('/js/main.js')}}"></script>
@yield('footerScript')
</body>
</html>

