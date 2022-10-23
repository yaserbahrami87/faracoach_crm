@extends('user.master.index')

@section('headerScript')
    <link href="{{asset('/css/kamadatepicker.min.css')}}" rel="stylesheet" />
    <link href="{{asset('/css/timepicker.min.css')}}" rel="stylesheet" />
    <link src="{{asset('/css/jquery-book.css')}}"></link>
    <style>
        #fff{
            border: 2px solid rgba(2,1,19,.81);
            border-radius:20px;
        }
        .progress {position:relative;
        }

        .progress span {
            position:absolute;
            left:0;
            width:100%;
            text-align:center;
            z-index:2;
            font-weigh:bold;
        }

        .progress{
            height: 25px;
            background: #262626;
            padding: 5px;
            overflow: visible;
            border-radius: 20px;
            border-top: 1px solid #000;
            border-bottom: 1px solid #7992a8;
            margin-top: 50px;
        }

        .progress .progress-bar{
            border-radius: 20px;
            position: relative;
            animation: animate-positive 2s;
        }

        .progress .progress-value{
            display: block;
            padding: 3px 7px;
            font-size: 13px;
            color: #fff;
            border-radius: 4px;
            background: #191919;
            border: 1px solid #000;
            position: absolute;
            top: -40px;
            right: -10px;
        }

        .progress .progress-value:after{
            content: "";
            border-top: 10px solid #191919;
            border-left: 10px solid transparent;
            border-right: 10px solid transparent;
            position: absolute;
            bottom: -6px;
            left: 26%;
        }

        .progress-bar.active{
            animation: reverse progress-bar-stripes 0.40s linear infinite, animate-positive 2s;
        }

        @-webkit-keyframes animate-positive{
            0% { width: 0; }
        }

        @keyframes animate-positive{
            0% { width: 0; }
        }
    </style>
@endsection

@section('content')
    <div class="col-md-12">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active " id="home-tab" data-toggle="tab" data-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">توضیحات</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link " id="contact-tab" data-toggle="tab" data-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">فرم اولیه بورسیه</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-toggle="tab" data-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">اطلاعات کاربر</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="introduce-tab" data-toggle="tab" data-target="#introduce" type="button" role="tab" aria-controls="introduce" aria-selected="false">معرفی دوستان</button>
            </li>
            <li class="nav-item" role="learn">
                <button class="nav-link" id="learn-tab" data-toggle="tab" data-target="#learn" type="button" role="tab" aria-controls="learn" aria-selected="false">دوره آموزشی</button>
            </li>
            <li class="nav-item" role="exam">
                <button class="nav-link" id="exam-tab" data-toggle="tab" data-target="#exam" type="button" role="tab" aria-controls="exam" aria-selected="false">آزمون و گواهینامه</button>
            </li>
            <!--
            <li class="nav-item" role="certificate">
                <button class="nav-link @if(($scholarship->confirm_webinar==1) && ($scholarship->confirm_exam==1))  @else disabled @endif" id="certificate-tab" data-toggle="tab" data-target="#certificate" type="button" role="tab" aria-controls="certificate" aria-selected="false">گواهینامه</button>
            </li>
            -->
            <li class="nav-item" role="introductionLetter">
                <button class="nav-link" id="introductionLetter-tab" data-toggle="tab" data-target="#introductionLetter" type="button" role="tab" aria-controls="introductionLetter" aria-selected="false">معرفی نامه</button>
            </li>
            <li class="nav-item" role="interview">
                <button class="nav-link" id="interview-tab" data-toggle="tab" data-target="#interview" type="button" role="tab" aria-controls="interview" aria-selected="false">مصاحبه</button>
            </li>
            <li class="nav-item" role="result">
                <button class="nav-link" id="result-tab" data-toggle="tab" data-target="#result" type="button" role="tab" aria-controls="result" aria-selected="false">نتیجه</button>
            </li>
            <li class="nav-item" role="payment">
                <button class="nav-link @if(is_null($scholarship->user->get_scholarshipInterview)) disabled @endif" id="payment-tab" data-toggle="tab" data-target="#payment" type="button" role="tab" aria-controls="payment" aria-selected="false">ثبت نام</button>
            </li>
            <li class="nav-item" role="support">
                <button class="nav-link" id="support-tab" data-toggle="tab" data-target="#support" type="button" role="tab" aria-controls="support" aria-selected="false">پشتیبان</button>
            </li>


        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <h3 class="d-block text-dark text-center" style="line-height: 2">طرح اعطای بورسیه کوچینگ آکادمی بین المللی فراکوچ</h3>
                <div class="card">
                    <div class="card-body shadow shadow-sm text-center">
                        <p style="line-height: 2" class="text-center">شناسایی و دعوت از افراد نخبه و با استعداد جهت حضور ویژه</p>
                        <p style="line-height: 2;text-align: justify">آکادمی بین المللی فراکوچ فرصت بی نظیری را به منظور ورود و پیوستن جمع بیشتری از افراد مستعد ، نخبه و فرهیخته جامعه - به ویژه اساتید ،  پژوهشگران، اندیشمندان، مدیران و دانشجویان برتر - به دنیای حرفه ای کوچینگ از طریق ایجاد شرایط ویژه حضور آنان در دوره های آموزش و تربیت کوچ حرفه ای ، فراهم کرده است.</p>
                        <b class="d-block mb-2">نمونه مدرک </b>
                        <img src="{{asset('/images/ICF_scholarship_example.jpg')}}" class="text-center" />
                    </div>
                </div>
                <button class="btn btn-primary" id="contact-tab2" onclick="document.getElementById('contact-tab').click()">مرحله بعد</button>

            </div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                @include('user.scholarship.contact')
                <button class="btn btn-primary" id="contact-tab2" onclick="document.getElementById('profile-tab').click()">مرحله بعد</button>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                @include('user.scholarship.profile_schoalrship')
                <button class="btn btn-primary" id="contact-tab2" onclick="document.getElementById('introduce-tab').click()">مرحله بعد</button>
            </div>
            <div class="tab-pane fade show" id="introduce" role="tabpanel" aria-labelledby="introduce-tab">
                @include('user.scholarship.introduce')
            </div>
            <div class="tab-pane fade " id="learn" role="tabpanel" aria-labelledby="learn-tab">
                @include('user.scholarship.learn')
            </div>
            <div class="tab-pane fade " id="introductionLetter" role="tabpanel" aria-labelledby="introductionLetter-tab">
                @include('user.scholarship.introductionLetter')
            </div>

            <div class="tab-pane fade " id="exam" role="tabpanel" aria-labelledby="exam-tab">
                @include('user.scholarship.exam')

            </div>

            <!--
            <div class="tab-pane fade " id="certificate" role="tabpanel" aria-labelledby="certificate-tab">
                <p>برای کسب مدرک ICF بورسیه کوچینگ باید مراحل زیر را طی کنید:</p>
                <ul>
                    <li>شرکت در وبینار آموزشی بورسیه کوچینگ و وارد کرد کد های داده شده در بخش آموزش</li>
                    <li>شرکت در آزمون بورسیه کوچینگ و کسب نمره قبولی در آزمون</li>
                    <li>وارد کردن نام و نام خانوادگی خود به صورت انگلیسی در قسمت پروفایل</li>
                </ul>
                <div class="text-center">
                    <a href="{{asset('/panel/scholarship/certificate/download')}}" class="btn btn-primary">دانلود مدرک</a>
                </div>

            </div>
            -->


            <div class="tab-pane fade " id="interview" role="tabpanel" aria-labelledby="interview-tab">
                <div class="card-body" >
                    @if($scholarship->view_score==1)
                        @if(is_null($scholarship->user->get_scholarshipInterview))
                            <div class="alert alert-warning">شما هنوز در مصاحبه شرکت نکرده اید</div>
                        @else
                            <div class="alert alert-primary">شما در مصاحبه بورسیه کوچینگ {{$scholarship->user->get_scholarshipInterview->score}} امتیاز کسب کرده اید</div>
                        @endif
                    @else
                        <div class="alert alert-warning">
                            امتیاز بورسیه شما در سیستم ثبت شد
                        </div>
                    @endif
                </div>

            </div>
            <div class="tab-pane fade " id="result" role="tabpanel" aria-labelledby="result-tab">
                <div class="card-body" >
                    @include('user.scholarship.result')
                </div>

            </div>
            <div class="tab-pane fade " id="rante" role="tabpanel" aria-labelledby="rante-tab">
                <div class="card-body" >

                </div>

            </div>
            <div class="tab-pane fade " id="payment" role="tabpanel" aria-labelledby="payment-tab">
                @include('user.scholarship.payment')
            </div>
            <div class="tab-pane fade " id="support" role="tabpanel" aria-labelledby="support-tab">
                @include('user.scholarship.support')
            </div>



        </div>
    </div>
@endsection


@section('footerScript')
    <!--  DATE SHAMSI PICKER  --->
    <script src="{{asset('/js/kamadatepicker.min.js')}}"></script>
    <script src="{{asset('/js/kamadatepicker.holidays.js')}}"></script>
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

        kamaDatepicker('start',
            {
                gotoToday: true,
                markHolidays:true,
                markToday:true,
                twodigit:true,
                closeAfterSelect:true,
                highlightSelectedDay:true,
                nextButtonIcon: "fa fa-arrow-circle-right",
                previousButtonIcon: "fa fa-arrow-circle-left",
                sync:true,
            });
        kamaDatepicker('end',
            {
                gotoToday: true,
                markHolidays:true,
                markToday:true,
                twodigit:true,
                closeAfterSelect:true,
                highlightSelectedDay:true,
                nextButtonIcon: "fa fa-arrow-circle-right",
                previousButtonIcon: "fa fa-arrow-circle-left",
                sync:true,
            });
        kamaDatepicker('exam',
            {
                gotoToday: true,
                markHolidays:true,
                markToday:true,
                twodigit:true,
                closeAfterSelect:true,
                highlightSelectedDay:true,
                nextButtonIcon: "fa fa-arrow-circle-right",
                previousButtonIcon: "fa fa-arrow-circle-left",
                sync:true,
            });

    </script>

    <script>

        var input = document.querySelector("#tel_introduce");
        var intl=intlTelInput(input,{
            formatOnDisplay:false,
            separateDialCode:true,
            preferredCountries:["ir", "gb"]
        });

        input.addEventListener("countrychange", function() {
            document.querySelector("#tel_org_introduce").value=intl.getNumber();
        });

        $('#tel_introduce').change(function()
        {
            document.querySelector("#tel_org_introduce").value=intl.getNumber();
        });


        // تلفن معرف
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


        $("#gettingknow_parent").change(function()
        {
            var loading='<div class="col-12 text-center"><div class="spinner-border text-primary text-center" role="status"><span class="sr-only">Loading...</span></div></div>';
            //$("#gettingknow2").html(loading);
            var content=$(this).val();
            $.ajax({
                type:'GET',
                url:"/showListChildGettingKnow/"+content,
                success:function(data)
                {
                    $("#gettingknow2").css('display','flex');
                    $("#gettingknow_profile").html(data);
                }
            });

        });


        $("#personal_link").click(function()
        {
            if (window.isSecureContext && navigator.clipboard) {
                navigator.clipboard.writeText($('#personal_link').text());
            } else {
                unsecuredCopyToClipboard($('#personal_link').text());
            }


            alert('لینک دعوت اختصاصی شما کپی شد');
        });


        function checkCodeWebinar()
        {
            $('#result_checkCodeWebinar').html('<div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div>');
            var data=$('#frm_checkCodeWebinar').serialize();
            data=
                {
                    "_token": "{{ csrf_token() }}",
                    'code1':$('#code1').val(),
                    'code2':$('#code2').val(),
                    'code3':$('#code3').val(),
                };
           $.ajax(
               {
                   data:data,
                   url:'/panel/scholarship/store_webinarCode',
                   type:'POST',
                   success: function (data) {
                       $('#result_checkCodeWebinar').html(data);

                       // $('#result_checkCodeWebinar').html("<div class='alert alert-success'>کد صحیح وارد شد</div>");
                   },
                   error : function(data)
                   {
                       $('#result_checkCodeWebinar').text(data.responseJSON.errors);
                       errorsHtml='<div class="alert alert-danger text-left"><ul>';
                       $.each( data.responseJSON.errors, function( key, value ) {
                           errorsHtml += '<li>'+ value[0] + '</li>'; //showing only the first error.
                       });
                       errorsHtml += '</ul></div>';
                       $( '#result_checkCodeWebinar' ).html( errorsHtml );
                   }
               }
           );
        };

        //نمایش جدول پرداخت بورسیه

        /*
        $('[name="paymentCourse_radio"]').change(function()
        {

            var loading='<div class="col-12 text-center"><div class="spinner-border text-primary text-center" role="status"><span class="sr-only">Loading...</span></div></div>';
            $("#show_payment_scholarship").html(loading);
            var data=$(this).val();

                $.ajax({
                    type:'POST',
                    url:"/panel/scholarship/ajax_payment",
                     data:
                     {
                         'id':$(this).val(),
                         '_token':"{{ csrf_token() }}",
                     },
                    success:function(data)
                    {
                        $("#show_payment_scholarship").html(data);
                    }
                });
        });*/

    </script>

    <script src="{{asset('/js/jquery.autotab.min.js')}}"></script>
    <script>
        $(function () {
            $('.code').autotab();
        });
    </script>


    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="{{asset('/js/jquery-ui.min.js')}}" ></script>
    <script src="{{asset('/js/jquery-book.js')}}" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>

    <script>
        $thing = $('#demo').book({
            onPageChange: updateProgress,
            speed:200}
        ).validate();


        function updateProgress(prevPageIndex, currentPageIndex, pageCount, pageName){
            t = (currentPageIndex / (pageCount-1)) * 100;
            $('.progress-bar').attr('aria-valuenow', t);
            $('.progress-bar').css('width', t+'%');
            //$('.progress span').text('Completed: '+Math.trunc(t)+'%');
            $('.progress-value').text(Math.trunc(t)+'%');
        }
    </script>


@endsection
