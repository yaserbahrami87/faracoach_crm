@component('user.master.index_component')

@slot('headerScript')
{{--    ----------main template style --}}
    <link href="/css/scholarship/bootstrap_sch.min.css" rel="stylesheet"/>
    <link href="#" rel="stylesheet"/>
    <link href="#" rel="stylesheet"/>
    <script type="text/javascript" src="{{asset('/js/scholarship/jquery_sch.min.js')}}"></script>
    <link href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/smart_wizard.min.css" rel="stylesheet" type="text/css"/>
    <link href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/smart_wizard_theme_dots.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{asset('/css/scholarship/smart_wizard.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('/css/scholarship/smart_wizard_theme_dots.min.css')}}" rel="stylesheet"/>
{{---------------end main style------------}}
{{---------------training_course_style-------}}
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{asset('/css/scholarship/training_course_style.css')}}" rel="stylesheet"/>
{{--------------end training_course_style-----}}
{{---------------profilng_css--}}
{{--<link rel="stylesheet" href="{{asset('/css/scholarship/profiling/reset.min.css')}}">--}}
<link type="text/css" href="{{asset('/css/scholarship/profiling/style.css')}}" rel="stylesheet" />

{{---------------introduced_css--}}
<link type="text/css" href="{{asset('/css/scholarship/introduced_style.css')}}" rel="stylesheet" />
<link href="/css/kamadatepicker.min.css" rel="stylesheet" />
{{---------------news css--}}
<link type="text/css" href="{{asset('/css/news/news_style.css')}}" rel="stylesheet" />

    <style>
        ::-webkit-scrollbar {
            width: 8px;
        }
        /* Track */
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #888;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
        body {
            background-color: #eee;
        }
        .form-control:focus {
            color: #495057;
            background-color: #fff;
            border-color: #80bdff;
            outline: 0;
            box-shadow: 0 0 0 0rem rgba(0, 123, 255, 0.25);
        }
        .btn-secondary:focus {
            box-shadow: 0 0 0 0rem rgba(108, 117, 125, 0.5);
        }
        .close:focus {
            box-shadow: 0 0 0 0rem rgba(108, 117, 125, 0.5);
        }
        .mt-200 {
            margin-top: 200px;
        }
        .sw-theme-dots > ul.step-anchor > li > a::after
        {
            left:-32%!important;
        }
        @media screen and (max-width: 768px) {
            .sw-theme-dots > ul.step-anchor > li > a::after
            {
                right: 110%;

            }
            @media screen and (max-width: 768px) {
                .sw-theme-dots > ul.step-anchor > li
                {
                    width:150px;

                }
            }
        }
    </style>
@endslot
<div class="container">

{{--  ------  news   --}}

        <div id="scroll-container">
            @if ($news->count()>0)
                <div class="scroll-text">
                        <ul>
                            @foreach($news as $news)
                                 <li style="margin-bottom: 20px"> {{$news->news}} <br></li>
                                <hr style="width: 60% ;background-color:#9c2d2e " >
                            @endforeach
                        </ul>
                </div>
                    @else
                <div class="scroll-default">
                        <h5> طرح فراخوان از پژوهشگران ، دانشگاهیان ، نخبگان وکلیه علاقه مندان به حوضه توسعه فردی و کسب و کار</h5>
                </div>
            @endif
        </div>

            <!-- Modal -->

            <h4 class="d-block text-dark text-center" style="line-height:2 ;margin-bottom: 30px">  طرح اعطای بورسیه کوچینگ آکادمی بین المللی فراکوچ </h4>
            <div id="smartwizard" class="sw-main sw-theme-dots">
                <ul class="nav nav-tabs step-anchor">
{{--                    <li class="nav-item active">--}}
{{--                        <a href="#step-1" class="nav-link">--}}
{{--                            مرحله اول<br/>--}}
{{--                            <small>توضیحات</small>--}}
{{--                        </a>--}}
{{--                    </li>--}}
                    <li class="nav-item active">
                        <a href="#step-1" class="nav-link">
                            مرحله اول<br />
                            <small>اطلاعات فردی</small>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#step-2" class="nav-link">
                            مرحله دوم<br />
                            <small>معرفی دوستان</small>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#step-3" class="nav-link">
                            مرحله سوم<br />
                            <small>دوره اموزشی</small>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#step-4" class="nav-link">
                            مرحله چهارم<br />
                            <small>آزمون وگواهینامه</small>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#step-5" class="nav-link">
                            مرحله پنجم<br />
                            <small>دوره فاندامنتال</small>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#step-6" class="nav-link">
                            مرحله ششم<br />
                            <small>معرفی نامه </small>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#step-7" class="nav-link">
                            مرحله هفتم<br />
                            <small>مصاحبه </small>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#step-8" class="nav-link">
                            مرحله هشتم<br />
                            <small>نتیجه و ثبت نام </small>
                        </a>
                    </li>

                </ul>
                <div class="sw-container tab-content" style="min-height: 0px;">
{{--                    <div id="step-1" class="tab-pane step-content" style="display: block;">--}}
{{--                        <div class="row">--}}
{{--                        </div>--}}
{{--                        <div class="row mt-3">--}}
{{--                            <div class="card">--}}
{{--                                <div class="card-body shadow shadow-sm text-center">--}}
{{--                                    <p style="line-height: 2" class="text-center">شناسایی و دعوت از افراد نخبه و با استعداد جهت حضور ویژه</p>--}}
{{--                                    <p style="line-height: 2;text-align: justify">آکادمی بین المللی فراکوچ فرصت بی نظیری را به منظور ورود و پیوستن جمع بیشتری از افراد مستعد ، نخبه و فرهیخته جامعه - به ویژه اساتید ،  پژوهشگران، اندیشمندان، مدیران و دانشجویان برتر - به دنیای حرفه ای کوچینگ از طریق ایجاد شرایط ویژه حضور آنان در دوره های آموزش و تربیت کوچ حرفه ای ، فراهم کرده است.</p>--}}

{{--                                    <img src="/images/scholarship/info_sch.jpg" class="img-fluid text-center" />--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <div id="step-1" class="tab-pane step-content">
                        <div class="row">
                            @include('user.scholarship.new.profiling')
                        </div>
                    </div>
                    <div id="step-2" class="tab-pane step-content">
                            @include('user.scholarship.new.introduced_friends')
                    </div>
                    <div id="step-3" class="tab-pane step-content">
                        <div class="row">
{{--                            @include('user.scholarship.new.training_course')--}}
                                <div class="col-md-6 m-auto text-center" >
                                    <h5><mark>دوره آموزشی به صورت آنلاین در تاریخ 10 خرداد ماه 1403 برگزار میشود </mark></h5>
                                </div>
                        </div>
                    </div>
                    <div id="step-4" class="tab-pane step-content">
                        <div class="row">

                        </div>
                    </div>
                    <div id="step-5" class="tab-pane step-content">
                        <div class="row">

                        </div>
                    </div>
                    <div id="step-6" class="tab-pane step-content">
                        <div class="row">

                        </div>
                    </div>
                    <div id="step-7" class="tab-pane step-content">
                        <div class="row">

                        </div>
                    </div>
                    <div id="step-8" class="tab-pane step-content">
                        <div class="row">

                        </div>
                    </div>
                </div>
            </div>
</div>




@slot('footerScript')
{{-------------- news --}}
<script src="{{asset('js/news/bootstrap_news.min.js')}}"></script>
<script src="{{asset('js/news/popper.min.js')}}"></script>
<script src="{{asset('js/news/jquery-3.5.1.min.js')}}"></script>
<script>
    / optional
    $('#blogCarousel').carousel({
        interval: 5000
    });
</script>
{{-------------- profiling--}}

<script src="{{asset('js/scholarship/profiling/jquery-3.1.1.min.js')}}"></script>
<script src="{{asset('js/scholarship/profiling/jquery.easing.min.js')}}" type="text/javascript"></script>
<script  src="{{asset('js/scholarship/profiling/scripts.js')}}"></script>

{{--    ----------------Main template --}}

    <script type="text/javascript" src="{{asset('/js/scholarship/jquery.smartWizard.min.js')}}"></script>
    <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="#"></script>
    <script type="text/javascript" src="#"></script>
    <script type="text/javascript" src="#"></script>
    <script type="text/javascript" src="#"></script>
    <script type="text/javascript" src="#"></script>
    <script type="text/javascript" src="#"></script>
    <script type="text/javascript" src="#"></script>
    <script type="text/javascript" src="#"></script>
    <script type="text/javascript" src="#"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $("#smartwizard").smartWizard({
                selected: 0,
                theme: "dots",
                autoAdjustHeight: true,
                transitionEffect: "fade",
                showStepURLhash: false,
            });
        });
    </script>
    <script type="text/javascript">
        var myLink = document.querySelector('a[href="#"]');
        myLink.addEventListener("click", function (e) {
            e.preventDefault();
        });
    </script>
{{--    -----------end main template--}}
{{--    -----------treaining_course--}}
<script>
        $(function() {
        var $allVideos = $("iframe[src^='http://player.vimeo.com'], iframe[src^='http://www.youtube.com'], object, embed"),
        $fluidEl = $("figure");

        $allVideos.each(function() {
        $(this)
        // jQuery .data does not work on object/embed elements
        .attr('data-aspectRatio', this.height / this.width)
        .removeAttr('height')
        .removeAttr('width');
        });
        $(window).resize(function() {
        var newWidth = $fluidEl.width();
        $allVideos.each(function() {
        var $el = $(this);
        $el
        .width(newWidth)
        .height(newWidth * $el.attr('data-aspectRatio'));
        });
        }).resize();
        });
</script>

<!--  DATE SHAMSI PICKER  --->
<script src="{{asset('js/kamadatepicker.min.js')}}"></script>
<script src="{{asset('js/kamadatepicker.holidays.js')}}"></script>
<script>
    kamaDatepicker('datebirth',
        {
            markHolidays:true,
            markToday:true,
            twodigit:true,
            closeAfterSelect:true,
            nextButtonIcon: "fa fa-arrow-circle-right",
            previousButtonIcon: "fa fa-arrow-circle-left"
        });
</script>

<script>
    $("#gettingknow_parent").change(function()
    {
        var loading='<div class="col-12 text-center"><div class="spinner-border text-primary text-center" role="status"><span class="sr-only">Loading...</span></div></div>';
        var content=$(this).val();
        $.ajax({
            type:'GET',
            url:"/showListChildGettingKnow/"+content,
            success:function(data)
            {
                $("#gettingknow").html(data);
            }
        });
    })




    var input1 = document.querySelector("#introduced_profile");
    var intl1=intlTelInput(input1,{
        formatOnDisplay:false,
        separateDialCode:true,
        preferredCountries:["ir", "gb"]
    });

    input1.addEventListener("countrychange", function() {
        document.querySelector("#introduced").value=intl1.getNumber();
    });

    $('#introduced_profile').change(function()
    {
        document.querySelector("#introduced").value=intl1.getNumber();
        var loading='<div class="col-12 text-center"><div class="spinner-border text-primary text-center" role="status"><span class="sr-only">Loading...</span></div></div>';
        $("#feedback_introduced").html(loading);
        var data=$("#introduced").val();
        if(data.length>0)
        {
            $.ajax({
                type:'GET',
                url:"/check/user/"+data,
                success:function(data)
                {
                    $("#feedback_introduced").html(data);
                }
            });
        }
        else
        {
            data="<input type='hidden' value='' name='introduced'/>";
            $("#feedback_introduced").html(data);
        }
    });
</script>



@endslot
@endcomponent
