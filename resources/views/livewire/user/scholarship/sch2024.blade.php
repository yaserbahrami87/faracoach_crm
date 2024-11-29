
<div>
    @slot('headerScript')
        {{--    ----------main template style --}}
        <link href="/css/scholarship/bootstrap_sch.min.css" rel="stylesheet"/>

        <script type="text/javascript" src="/js/scholarship/jquery_sch.min.js"></script>
        <link href="/css/scholarship/smart_wizard.min.css" rel="stylesheet" type="text/css"/>
        <link href="/css/scholarship//smart_wizard_theme_dots.min.css" rel="stylesheet" type="text/css"/>
        <link href="/css/scholarship/smart_wizard.min.css" rel="stylesheet" type="text/css"/>
        <link href="/css/scholarship/smart_wizard_theme_dots.min.css" rel="stylesheet"/>
        {{---------------end main style------------}}
        {{---------------training_course_style-------}}
        <link href="/css/scholarship/font-awesome.min.css" rel="stylesheet">
        <link href="/css/scholarship/training_course_style.css" rel="stylesheet"/>
        {{--------------end training_course_style-----}}
        {{---------------profilng_css--}}
        {{--<link rel="stylesheet" href="{{asset('/css/scholarship/profiling/reset.min.css')}}">--}}
        <link type="text/css" href="/css/scholarship/profiling/style.css" rel="stylesheet" />

        {{---------------introduced_css--}}
        <link type="text/css" href="/css/scholarship/introduced_style.css" rel="stylesheet" />
        <link type="text/css" href="/css/scholarship/introdcued_2.css" rel="stylesheet" />


    @endslot


        <div class="container">
            <!-- Modal -->
            <h4 class="d-block text-dark text-center" style="line-height:2 ;margin-bottom: 30px">  طرح اعطای بورسیه کوچینگ آکادمی بین المللی فراکوچ </h4>
            <div id="smartwizard" class="sw-main sw-theme-dots">
                <ul class="nav nav-tabs step-anchor">
                    <li class="nav-item active">
                        <a href="#step-1" class="nav-link">
                            مرحله اول<br/>
                            <small>توضیحات</small>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#step-2" class="nav-link">
                            مرحله دوم<br />
                            <small>اطلاعات فردی</small>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#step-3" class="nav-link">
                            مرحله سوم<br />
                            <small>معرفی دوستان</small>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#step-4" class="nav-link">
                            مرحله چهارم<br />
                            <small>دوره اموزشی</small>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#step-5" class="nav-link">
                            مرحله پنجم<br />
                            <small>آزمون وگواهینامه</small>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#step-6" class="nav-link">
                            مرحله ششم<br />
                            <small>دوره فاندامنتال</small>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#step-7" class="nav-link">
                            مرحله هفتم<br />
                            <small>معرفی نامه </small>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#step-8" class="nav-link">
                            مرحله هشتم<br />
                            <small>مصاحبه </small>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#step-9" class="nav-link">
                            مرحله نهم<br />
                            <small>نتیجه و ثبت نام </small>
                        </a>
                    </li>

                </ul>
                <div class="sw-container tab-content" style="min-height: 0px;">
                    <div id="step-1" class="tab-pane step-content" style="display: block;">
                        <div class="row">
                        </div>
                        <div class="row mt-3">
                            <div class="card">
                                <div class="card-body shadow shadow-sm text-center">
                                    <p style="line-height: 2" class="text-center">شناسایی و دعوت از افراد نخبه و با استعداد جهت حضور ویژه</p>
                                    <p style="line-height: 2;text-align: justify">آکادمی بین المللی فراکوچ فرصت بی نظیری را به منظور ورود و پیوستن جمع بیشتری از افراد مستعد ، نخبه و فرهیخته جامعه - به ویژه اساتید ،  پژوهشگران، اندیشمندان، مدیران و دانشجویان برتر - به دنیای حرفه ای کوچینگ از طریق ایجاد شرایط ویژه حضور آنان در دوره های آموزش و تربیت کوچ حرفه ای ، فراهم کرده است.</p>
                                    <b class="d-block mb-2">نمونه مدرک </b>
                                    <img src="{{asset('/images/ICF_scholarship_example.jpg')}}" class="img-fluid text-center" />
                                </div>
                            </div>


                        </div>
                    </div>
                    <div id="step-2" class="tab-pane step-content">
                        <div class="row">
                            @include('user.scholarship.new.profiling')
                        </div>
                    </div>
                    <div id="step-3" class="tab-pane step-content">
                        @include('user.scholarship.new.introduced_friends')
                    </div>
                    <div id="step-4" class="tab-pane step-content">
                        <div class="row">
                            @include('user.scholarship.new.training_course')
                        </div>
                    </div>
                    <div id="step-5" class="tab-pane step-content">
                        <div class="row">
                            @include('user.scholarship.new.training_course')
                        </div>
                    </div>
                    <div id="step-6" class="tab-pane step-content">
                        <div class="row">
                            @include('user.scholarship.new.training_course')
                        </div>
                    </div>
                    <div id="step-7" class="tab-pane step-content">
                        <div class="row">
                            @include('user.scholarship.new.training_course')
                        </div>
                    </div>
                    <div id="step-8" class="tab-pane step-content">
                        <div class="row">
                            @include('user.scholarship.new.training_course')
                        </div>
                    </div>
                    <div id="step-9" class="tab-pane step-content">
                        <div class="row">
                            @include('user.scholarship.new.training_course')
                        </div>
                    </div>
                </div>
            </div>
        </div>





    @slot('footerScript')
        {{-------------- profiling--}}

        <script src="/js/scholarship/profiling/jquery-3.1.1.min.js"></script>
        <script src="/js/scholarship/profiling/jquery.easing.min.js" type="text/javascript"></script>
        <script  src="/js/scholarship/profiling/scripts.js"></script>

        {{--    ----------------Main template --}}

        <script type="text/javascript" src="/js/scholarship/jquery.smartWizard.min.js"></script>
        <script type="text/javascript" src="/js/scholarship/bootstrap.bundle.min.js"></script>

            <script>
                window.addEventListener('plugins',()=>
                {
                    let head = document.getElementsByTagName('HEAD')[0];

                    let link16 = document.createElement('script');
                    link16.type="text/javascript";
                    link16.src = '/js/scholarship/profiling/jquery-3.1.1.min.js';
                    head.appendChild(link16);

                    let link17 = document.createElement('script');
                    link17.type="text/javascript";
                    link17.src = '/js/scholarship/jquery_sch.min.js';
                    head.appendChild(link17);

                    let link5 = document.createElement('link');
                    link5.rel = 'stylesheet';
                    link5.href = '/css/scholarship/bootstrap_sch.min.css';
                    head.appendChild(link5);

                    let link6 = document.createElement('link');
                    link6.rel = 'stylesheet';
                    link6.href = '/css/scholarship/smart_wizard.min.css';
                    head.appendChild(link6);

                    let link7 = document.createElement('link');
                    link7.rel = 'stylesheet';
                    link7.href = '/css/scholarship/smart_wizard_theme_dots.min.css';
                    head.appendChild(link7);

                    let link8 = document.createElement('link');
                    link8.rel = 'stylesheet';
                    link8.href = '/css/scholarship/smart_wizard.min.css';
                    head.appendChild(link8);

                    let link9 = document.createElement('link');
                    link9.rel = 'stylesheet';
                    link9.href = '/css/scholarship/smart_wizard_theme_dots.min.css';
                    head.appendChild(link9);

                    let link10 = document.createElement('link');
                    link10.rel = 'stylesheet';
                    link10.href = '/css/scholarship/font-awesome.min.css';
                    head.appendChild(link10);

                    let link11 = document.createElement('link');
                    link11.rel = 'stylesheet';
                    link11.href = '/css/scholarship/training_course_style.css';
                    head.appendChild(link11);

                    let link12 = document.createElement('link');
                    link12.rel = 'stylesheet';
                    link12.href = '/css/scholarship/profiling/style.css';
                    head.appendChild(link12);

                    let link13 = document.createElement('link');
                    link13.rel = 'stylesheet';
                    link13.href = '/css/scholarship/introduced_style.css';
                    head.appendChild(link13);

                    let link14 = document.createElement('link');
                    link14.rel = 'stylesheet';
                    link14.href = '/css/scholarship/introdcued_2.css';
                    head.appendChild(link14);

                    let link1 = document.createElement('script');
                    link1.type="text/javascript";
                    link1.src = '/js/scholarship/profiling/jquery.easing.min.js';
                    head.appendChild(link1);

                    let link2 = document.createElement('script');
                    link2.type="text/javascript";
                    link2.src = '/js/scholarship/profiling/scripts.js';
                    head.appendChild(link2);

                    let link3 = document.createElement('script');
                    link3.type="text/javascript";
                    link3.src = '/js/scholarship/jquery.smartWizard.min.js';
                    head.appendChild(link3);

                    let link4 = document.createElement('script');
                    link4.type="text/javascript";
                    link4.src = '/js/scholarship/bootstrap.bundle.min.js';
                    head.appendChild(link4);

                    $("#smartwizard").smartWizard({
                        selected: 0,
                        theme: "dots",
                        autoAdjustHeight: true,
                        transitionEffect: "fade",
                        showStepURLhash: false,
                    });

                    var myLink = document.querySelector('a[href="#"]');
                    myLink.addEventListener("click", function (e) {
                        e.preventDefault();
                    });
                });
            </script>



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


    @endslot

</div>
