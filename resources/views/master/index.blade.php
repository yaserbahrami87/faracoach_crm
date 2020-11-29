<!doctype html>
<html lang="fa">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/bootstrap-rtl.min.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />
    <link href="css/landing.css" rel="stylesheet" />
    <link href="css/stepwizard.css" rel="stylesheet" />
    <link href="slick-1.8.1/slick-1.8.1/slick/slick.css" rel="stylesheet" type="text/css" />
    <link href="slick-1.8.1/slick-1.8.1/slick/slick-theme.css" rel="stylesheet" type="text/css" />

    <title>فراکوچ | دانلود رایگان دوره آموزش کوچینگ</title>
  </head>
  <body>
    @yield('navbarTop')
    <main class="container-fluid" dir="rtl">

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
    <script src="js/jquery-3.5.1.slim.min.js" ></script>
    <script src="js/popper.min.js" ></script>
    <script src="js/bootstrap.min.js" ></script>
    <script src="js/farsiType.js"></script>
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
                  slidesToShow: 3,
                  slidesToScroll: 3,
                  infinite: true,

                }
              },
              {
                breakpoint: 600,
                settings: {
                  slidesToShow: 2,
                  slidesToScroll: 2,

                }
              },
              {
                breakpoint: 480,
                settings: {
                  slidesToShow: 1,
                  slidesToScroll: 1
                }
              }
            ]
        });

      });

    </script>
  </body>
</html>
