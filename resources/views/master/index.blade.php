<!doctype html>
<html lang="fa">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Bootstrap CSS -->
    <link href={{asset("css/bootstrap.min.css")}} rel="stylesheet" />
    <link href={{asset("css/bootstrap-rtl.min.css")}} rel="stylesheet" />
    <link href={{asset("css/style.css")}} rel="stylesheet" />
    <link href={{asset("css/landing.css")}} rel="stylesheet" />
    <link href={{asset("css/stepwizard.css")}} rel="stylesheet" />
    <link href={{asset("slick-1.8.1/slick-1.8.1/slick/slick.css")}} rel="stylesheet" type="text/css" />
    <link href={{asset("slick-1.8.1/slick-1.8.1/slick/slick-theme.css")}} rel="stylesheet" type="text/css" />
      <link rel="icon" href="{{asset('images/logo.png')}}"  />

      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

     @yield('headerscript')

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



    @yield('footerScript')
  </body>
</html>
