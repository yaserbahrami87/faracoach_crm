<!doctype html>
<html lang="fa">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Bootstrap CSS -->
    <link href={{asset("css/bootstrap.min.css")}} rel="stylesheet" />
    <link href={{asset("css/bootstrap_cerulean.min.css")}} rel="stylesheet" />
    <link href={{asset("css/bootstrap-rtl.min.css")}} rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href={{asset("css/style.css")}} rel="stylesheet" />
    <link href={{asset("css/landing.css")}} rel="stylesheet" />
    <link href={{asset("css/stepwizard.css")}} rel="stylesheet" />
    <link href={{asset("slick-1.8.1/slick-1.8.1/slick/slick.css")}} rel="stylesheet" type="text/css" />
    <link href={{asset("slick-1.8.1/slick-1.8.1/slick/slick-theme.css")}} rel="stylesheet" type="text/css" />
      <link rel="icon" href="{{asset('images/logo.png')}}"  />
      <link rel="stylesheet" type="text/css" href="{{ asset('/panel_assets/intl_tel/css/intlTelInput.css') }}" />

      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

     @yield('headerscript')
      <script type="text/javascript">window.$crisp=[];window.CRISP_WEBSITE_ID="05ea1956-7561-4af6-a7ab-1c599909f103";(function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();</script>

      <title>فراکوچ | آموزش کوچینگ</title>
  </head>
  <body>
    @include('master.navbarTop')
    <main class="container-fluid" dir="rtl">
    @include('sweet::alert')
      <!--************* SLIDESHOW ***************-->
      @yield('header')

      @yield('row1')

      @yield('row2')


      @yield('row3')

      @yield('row4')

      @yield('row5')

      @yield('row6')

      @yield('row7')

      @yield('row8')

      @yield('row9')

      @yield('footer')
    </main>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{asset('/js/jquery-3.5.1.min.js')}}"></script>
    <script src={{asset("/js/popper.min.js")}} ></script>
    <script src={{asset("/js/bootstrap.min.js")}} ></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    <script src="http://127.0.0.1:8000/dashboard/assets/js/java.js"></script>
    <script src="{{asset('/panel_assets/intl_tel/js/intlTelInput.js')}}"></script>
    <script src="{{asset('/panel_assets/intl_tel/js/utils.js')}}"></script>



    @yield('footerScript')
  </body>
</html>
