
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>
        CRM Faracoach
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
    <!-- CSS Files -->
    <link href={{asset("../dashboard/assets/css/bootstrap.min.css")}} rel="stylesheet" />
    <link href={{asset("../dashboard/assets/css/paper-dashboard.css?v=2.0.1")}} rel="stylesheet" />
    <!-- FILE MANAGER -->
    <link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">


    <link href="{{asset('css/kamadatepicker.min.css')}}" rel="stylesheet" />
    <link href="{{asset('css/timepicker.min.css')}}" rel="stylesheet" />
    <link href={{asset('../css/bootstrap-rtl.min.css')}} rel="stylesheet" />
    <link href="{{asset('../dashboard/assets/css/style.css')}}" rel="stylesheet" />
</head>

<body class="">
<div class="wrapper " >
    <div class="sidebar" data-color="white" data-active-color="danger" dir="rtl">
        <div class="logo">
            <a href="/" class="simple-text logo-normal">
                <div class="logo-image-big">
                  <img src={{asset('../dashboard/assets/img/white-logo.png')}} />
                </div>
            </a>
        </div>
        @include('panelAdmin.master.leftNavbar')
    </div>
    <div class="main-panel" >
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
            <div class="container-fluid">
                <div class="navbar-wrapper">
                    <div class="navbar-toggle">
                        <button type="button" class="navbar-toggler">
                            <span class="navbar-toggler-bar bar1"></span>
                            <span class="navbar-toggler-bar bar2"></span>
                            <span class="navbar-toggler-bar bar3"></span>
                        </button>
                    </div>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navigation">
                    <ul class="navbar-nav">
                        <li class="nav-item btn-rotate dropdown">
                            <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="nc-icon nc-settings-gear-65"></i>
                                <p>
                                    <span class="d-lg-none d-md-block">Some Actions</span>
                                </p>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="{{ url('/logout') }}">خروج</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="content" >
            <div class="row" dir="rtl">
                @if($errors->any())
                    <div class="col-12">
                        <div class="alert alert-danger" role="alert">
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(session('msg') && (session('errorStatus')))
                    <div class="col-12">
                        <div class="alert alert-{{session('errorStatus')}}">
                            <p>{{session('msg')}}</p>
                        </div>
                    </div>
                @endif
                @yield('rowcontent')

            </div>
        </div>
        <footer class="footer footer-black  footer-white ">
            <div class="container-fluid">
                <div class="row">
                    <div class="credits ml-auto">
                      <span class="copyright">
                        © <script>
                              document.write(new Date().getFullYear())
                          </script> طراحی شده توسط<i class="fa fa-heart heart"></i> یاسر بهرامی
                      </span>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
<!--   Core JS Files   -->
<script src={{asset("../dashboard/assets/js/core/jquery.min.js")}}></script>
<script src={{asset("../dashboard/assets/js/java.js")}}></script>

<script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>

<script src={{asset("../dashboard/assets/js/core/popper.min.js")}}></script>
<script src={{asset("../dashboard/assets/js/core/bootstrap.min.js")}}></script>
<script src={{asset("../dashboard/assets/js/plugins/perfect-scrollbar.jquery.min.js")}}></script>


<!-- Chart JS -->
<script src={{asset("../dashboard/assets/js/plugins/chartjs.min.js")}}></script>
<!--  Notifications Plugin    -->
<script src={{asset("../dashboard/assets/js/plugins/bootstrap-notify.js")}}></script>
<!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->



<script src="{{asset('js/farsiType.js')}}"></script>
<!--  DATE SHAMSI PICKER  --->
<script src="{{asset('js/kamadatepicker.min.js')}}"></script>
<script src="{{asset('js/kamadatepicker.holidays.js')}}"></script>
<script>
    $(document).ready(function()
    {
        var customOptions={
                    gotoToday: true,
                    markHolidays:true,
                    markToday:true,
                    twodigit:true,
                    closeAfterSelect:true,
                    highlightSelectedDay:true,
                    nextButtonIcon: "fa fa-arrow-circle-right",
                    previousButtonIcon: "fa fa-arrow-circle-left",
                    sync:true,
                }
        kamaDatepicker('dateFollow',customOptions);

        kamaDatepicker('nextfollowup_date_fa',
            {
                markHolidays:true,
                markToday:true,
                twodigit:true,
                closeAfterSelect:true,
                nextButtonIcon: "fa fa-arrow-circle-right",
                previousButtonIcon: "fa fa-arrow-circle-left"
            });
    });
</script>
<!-- ****************  -->

<script src="{{asset('js/jquery-3.5.1.slim.min.js')}}"></script>
<script src="{{asset('js/timepicker.js')}}"></script>
<script>
    $(document).ready(function()
    {
        jQuery.noConflict();
        jQuery('#time_fa').timepicker();
    });


</script>


<script src="{{asset('../dashboard/assets/js/plugins/jquery.canvasjs.min.js')}}"></script>

<script>
    window.onload = function () {

        var options = {
            animationEnabled: true,
            theme: "light2",
            title:{
                text: "آمار سایت"
            },
            axisX:{
                valueFormatString: "DD MMM"
            },
            axisY: {
                title: "Number of Sales",
                suffix: "نفر",
                minimum: 0
            },
            toolTip:{
                shared:true
            },
            legend:{
                cursor:"pointer",
                verticalAlign: "bottom",
                horizontalAlign: "left",
                dockInsidePlotArea: true,
                itemclick: toogleDataSeries
            },
            data: [{
                type: "line",
                showInLegend: true,
                name: "ثبت نام شده",
                markerType: "square",
                xValueFormatString: "DD MMM, YYYY",
                color: "#F08080",
                yValueFormatString: "#,##0نفر",
                dataPoints: [
                    { x: new Date(1399, 10, 1), y: 63 },
                    { x: new Date(1399, 11, 2), y: 69 },
                    { x: new Date(1400, 11, 2), y: 65 },
                    { x: new Date(1401, 11, 2), y: 70 },
                ]
            },
                {
                    type: "line",
                    showInLegend: true,
                    name: "انصراف",
                    lineDashType: "dash",
                    yValueFormatString: "#,##0نفر",
                    dataPoints: [
                        { x: new Date(1399, 10, 1), y: 83 },
                        { x: new Date(1399, 11, 2), y: 99 },
                        { x: new Date(1400, 11, 2), y: 15 },
                        { x: new Date(1401, 11, 2), y: 20 },
                    ]
                }]
        };
        $("#chartContainer").CanvasJSChart(options);

        function toogleDataSeries(e){
            if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                e.dataSeries.visible = false;
            } else{
                e.dataSeries.visible = true;
            }
            e.chart.render();
        }

    }
</script>

</body>

</html>
