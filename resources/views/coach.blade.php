@extends('master.index')

@section('headerscript')
    <link href="{{asset('/dashboard/assets/css/datepicker.css')}}"  rel="stylesheet"/>
    <style>
        body
        {
            background-color: #fcfcfc;
        }
    </style>


@endsection

@section('row1')
    <div class="container" >
        <div class="row mb-5">
            <div class="shadow col-xs-12 col-md-8 col-lg-8 col-xl-8 mt-5 text-left pt-5" id="coach_profile_details">
                <div class="card hovercard mb-3">
                    <div class="cardheader">

                    </div>
                    <div class="row">
                        <div class="avatar col-sm-12 col-md-6 col-xs-6 col-lg-6">
                            <img alt="" src="{{asset('/documents/users/'.$coach->personal_image)}}">
                        </div>
                        <div class="info col-sm-12 col-md-6 col-xs-6 col-lg-6">
                            <div class="title">
                                <a href="#">{{$coach->fname}} {{$coach->lname}}</a>
                            </div>

                            <div class="desc">{{$coach->education}}</div>
                            <div class="desc">شهر سکونت: {{$coach->city}}</div>

                            @if(strlen($coach->instagram)>0)
                                <a class="social btn btn-primary btn-primary btn-sm" href="https://www.instagram.com/{{$coach->instagram}}" target="_blank">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                                        <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"/>
                                    </svg>
                                </a>
                            @endif

                            @if(strlen($coach->telegram)>0)
                                <a class="social btn btn-danger btn-sm" href="https://www.{{$coach->telegram}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telegram" viewBox="0 0 16 16">
                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.287 5.906c-.778.324-2.334.994-4.666 2.01-.378.15-.577.298-.595.442-.03.243.275.339.69.47l.175.055c.408.133.958.288 1.243.294.26.006.549-.1.868-.32 2.179-1.471 3.304-2.214 3.374-2.23.05-.012.12-.026.166.016.047.041.042.12.037.141-.03.129-1.227 1.241-1.846 1.817-.193.18-.33.307-.358.336a8.154 8.154 0 0 1-.188.186c-.38.366-.664.64.015 1.088.327.216.589.393.85.571.284.194.568.387.936.629.093.06.183.125.27.187.331.236.63.448.997.414.214-.02.435-.22.547-.82.265-1.417.786-4.486.906-5.751a1.426 1.426 0 0 0-.013-.315.337.337 0 0 0-.114-.217.526.526 0 0 0-.31-.093c-.3.005-.763.166-2.984 1.09z"/>
                                    </svg>
                                </a>
                            @endif
                            @if(strlen($coach->email)>0)
                                <a class="social btn btn-primary btn-sm" href="mailto:{{$coach->email}}" title="پست الکترونیکی">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                                        <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555zM0 4.697v7.104l5.803-3.558L0 4.697zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757zm3.436-.586L16 11.801V4.697l-5.803 3.546z"/>
                                    </svg>
                                </a>
                            @endif

                            @if(strlen($coach->tel)>0)
                                <a class="social btn btn-primary btn-twitter btn-sm" href="tel:{{$coach->tel}}" title="شماره همراه">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
                                    </svg>
                                </a>
                            @endif
                        </div>
                    </div>
                    <div class="bottom">

                    </div>
                </div>
                <div class="col-12 pb-3">
                    <div class="accordion" id="accordionExample">
                        <div class="card">
                            <div class="card-header" id="headingSix">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                        درباره من
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionExample">
                                <div class="card-body">
                                    <p>{{$coach->aboutme}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        سوابق تحصیلی
                                    </button>
                                </h2>
                            </div>

                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="card-body">
                                    <p>{{$coach->education_background}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingTwo">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        مدارک
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                <div class="card-body">
                                    <p>{{$coach->certificates}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingThree">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        سوابق شغلی
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                <div class="card-body">
                                    <p>{{$coach->experience}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingFour">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                        مهارت ها
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                                <div class="card-body">
                                    <p>{{$coach->skills}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingFive">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                        مقالات و تحقیقات
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
                                <div class="card-body">
                                    <p>{{$coach->researches}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    {!! $coach->biography !!}
                </div>

            </div>
            <div class=" col-xs-12 col-md-4 col-lg-4 col-xl-4 mt-5" id="coach_profile">
                <div class="card shadow">
                    <div class="card-header">
                        رزرو جلسه کوچینگ
                    </div>
                    <div class="card-body">
                        @if(Auth::check())
                            <p class="text-bold border-bottom mb-2 pb-2">انتخاب روز</p>
                            <div class="calender"></div>
                            <input type="hidden" id="calenderSelector" />
                            <input type="hidden" id="coach_id" value="{{$coach->id}}" />
                            <p class="text-bold mb-2 mt-3 pb-2 border-bottom">انتخاب ساعت</p>

                            <div class="col-12 p-0" id="show_bookings">
                                <div class="alert alert-warning" role="alert">لطفا یک تاریخ را انتخاب کنید</div>
                            </div>
                            <div class="row" id="reserve">

                            </div>
                        @else
                            <div class="alert alert-warning text-center">
                                <p>برای رزرو جلسه باید وارد سایت شوید</p>
                                <a href="/login" class="btn btn-outline-primary">ورود به سایت</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="container mb-5 " id="show_comments_blog">
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
                            <p class="p-0 m-0">{{session('msg')}}</p>
                        </div>
                    </div>
                @endif
                @if(Auth::check())

                        <form method="post" action="/post/addcomment/{{'asd'}}"class="mb-5">
                            {{csrf_field()}}
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    @if(is_null(Auth::user()->personal_image))
                                        <img src="{{asset('/documents/users/default-avatar.png')}}"  width="50px" height="50px" />
                                    @else
                                        <img src="{{asset('/documents/users/'.Auth::user()->personal_image)}}" width="50px" height="50px"/>
                                    @endif
                                    <span>{{Auth::user()->fname}} {{Auth::user()->lname}}</span>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="comment">ارسال دیدگاه:</label>
                                    <textarea class="form-control" id="comment" name="comment" rows="5"></textarea>
                                </div>
                                <button class="btn btn-success">ارسال</button>
                            </div>
                        </form>

                @else
                    <div class="alert alert-warning" role="alert">
                        برای ارسال دیدگاه لطفا <a href="/login">وارد</a> شوید
                    </div>
                @endif
                <div class="row">
                    <div class="panel panel-default widget" >
                        <div class="panel-heading">
                            <span class="glyphicon glyphicon-comment"></span>
                            <h5 class="panel-title">تعداد نظرات </h5>
                            <span class="label label-info"></span>
                        </div>
                        <!--
                        <div class="panel-body">
                            <ul class="list-group pl-0">
                                <li class="list-group-item border-bottom text-justify" >
                                    <div class="row">
                                        <div class="col-xs-2 col-md-1">
                                            <img src="{{asset('/documents/users/')}}" class="img-circle img-responsive" width="50px" height="50px" /></div>
                                        <div class="col-xs-10 col-md-11">
                                            <div>
                                                <a href="#">#</a>
                                                <div class="mic-info ">

                                                </div>
                                            </div>
                                            <div class="comment-text">

                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div> -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-link active" id="nav-comments-tab" data-toggle="tab" href="#nav-comments" role="tab" aria-controls="nav-comments" aria-selected="true">دیدگاه ها</a>
                                <a class="nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">بازخورد جلسات</a>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <!-- TAB COMMENTS -->
                            <div class="tab-pane fade show active" id="nav-comments" role="tabpanel" aria-labelledby="nav-home-tab">
                                <ul class="list-group pl-0">
                                    <li class="list-group-item border-bottom text-justify" >
                                        <div class="row">
                                            <div class="col-xs-2 col-md-1">
                                                <img src="{{asset('/documents/users/')}}" class="img-circle img-responsive" width="50px" height="50px" /></div>
                                            <div class="col-xs-10 col-md-11">
                                                <div>
                                                    <a href="#">#</a>
                                                    <div class="mic-info ">

                                                    </div>
                                                </div>
                                                <div class="comment-text">

                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                            <!-- TAB FEEDBACKS -->
                            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                @if(count($feedbacks)>0)
                                    <ul class="list-group pl-0">
                                        @foreach($feedbacks as $item)
                                            <li class="list-group-item border-bottom text-justify" >
                                                <div class="row">
                                                    <div class="col-xs-2 col-md-1">
                                                        <img src="{{asset('/documents/users/'.$item->personal_image)}}" class="img-circle img-responsive" width="50px" height="50px" /></div>
                                                    <div class="col-xs-10 col-md-11">
                                                        <div>
                                                            <a href="#">#</a>
                                                            <div class="mic-info mb-2">
                                                                @if($item->satisfaction==1)
                                                                    <strong class="text-success">
                                                                        این کوچ را توصیه میکنم
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hand-thumbs-up-fill" viewBox="0 0 16 16">
                                                                            <path d="M6.956 1.745C7.021.81 7.908.087 8.864.325l.261.066c.463.116.874.456 1.012.965.22.816.533 2.511.062 4.51a9.84 9.84 0 0 1 .443-.051c.713-.065 1.669-.072 2.516.21.518.173.994.681 1.2 1.273.184.532.16 1.162-.234 1.733.058.119.103.242.138.363.077.27.113.567.113.856 0 .289-.036.586-.113.856-.039.135-.09.273-.16.404.169.387.107.819-.003 1.148a3.163 3.163 0 0 1-.488.901c.054.152.076.312.076.465 0 .305-.089.625-.253.912C13.1 15.522 12.437 16 11.5 16H8c-.605 0-1.07-.081-1.466-.218a4.82 4.82 0 0 1-.97-.484l-.048-.03c-.504-.307-.999-.609-2.068-.722C2.682 14.464 2 13.846 2 13V9c0-.85.685-1.432 1.357-1.615.849-.232 1.574-.787 2.132-1.41.56-.627.914-1.28 1.039-1.639.199-.575.356-1.539.428-2.59z"/>
                                                                        </svg>
                                                                    </strong>
                                                                @elseif($item->satisfaction==0)
                                                                    <strong class="text-danger">
                                                                        این کوچ را توصیه نمیکنم
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hand-thumbs-down-fill" viewBox="0 0 16 16">
                                                                            <path d="M6.956 14.534c.065.936.952 1.659 1.908 1.42l.261-.065a1.378 1.378 0 0 0 1.012-.965c.22-.816.533-2.512.062-4.51.136.02.285.037.443.051.713.065 1.669.071 2.516-.211.518-.173.994-.68 1.2-1.272a1.896 1.896 0 0 0-.234-1.734c.058-.118.103-.242.138-.362.077-.27.113-.568.113-.856 0-.29-.036-.586-.113-.857a2.094 2.094 0 0 0-.16-.403c.169-.387.107-.82-.003-1.149a3.162 3.162 0 0 0-.488-.9c.054-.153.076-.313.076-.465a1.86 1.86 0 0 0-.253-.912C13.1.757 12.437.28 11.5.28H8c-.605 0-1.07.08-1.466.217a4.823 4.823 0 0 0-.97.485l-.048.029c-.504.308-.999.61-2.068.723C2.682 1.815 2 2.434 2 3.279v4c0 .851.685 1.433 1.357 1.616.849.232 1.574.787 2.132 1.41.56.626.914 1.28 1.039 1.638.199.575.356 1.54.428 2.591z"/>
                                                                        </svg>
                                                                    </strong>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="comment-text">
                                                            {{$item->comment}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <div class="alert alert-warning">هیچ بازخوردی ثبت نشده است</div>
                                @endif
                                {{$feedbacks->links()}}
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('footerScript')



    <script src="{{asset('/dashboard/assets/js/datepicker.js')}}"> </script>
    <script>
        $(".calender").datepicker({
            altField : "#calenderSelector",
            //altSecondaryField : "#calenderSecondarySelector",
            format : "short",
            today    :true,
            date:'{{$date_Miladi}}',
            minDate  :'{{$dateNow}}',
            view:'day',
            select: {
                highlight(formatted, dateMoment, checkingFor) {
                    let attributes = {'title': 'Today is ' + formatted};
                    if (checkingFor === 'day' && formatted === '1400-02-28'){
                        attributes['class'] = 'highlighted-1';
                        attributes['title'] = 'جشن چهارشنبه سوری';
                    }
                    if (checkingFor === 'day' && formatted === '2021/04/29'){
                        attributes['class'] = 'highlighted-2';
                        attributes['title'] = 'روز ملی شدن صنعت نفت';
                    }
                    return attributes;
                }
            }

        });
   function changes_datepicker(){

           var coach=$("#coach_id").val();
           var calenderSelector=$("#calenderSelector").val();
           if((coach==0) &&(calenderSelector==0) )
           {
               var loading = '<div class="alert alert-warning" role="alert">خطا در انتخاب رزروها</div>';
           }
           else {
               var loading = '<div class="col-12 text-center"><div class="spinner-border text-primary text-center" role="status"><span class="sr-only">Loading...</span></div></div>';
               $("#show_bookings").html(loading);
               $.ajax({
                   type: 'GET',
                   url: "/booking/createajax?coach=" + coach + "&calenderSelector=" + calenderSelector,
                   success: function (data) {
                       $("#show_bookings").html(data);
                   }
               });
           }

        }



    function toggleIcon(e) {
        $(e.target)
            .prev('.panel-heading')
            .find(".more-less")
            .toggleClass('glyphicon-plus glyphicon-minus');
    }
    $('.panel-group').on('hidden.bs.collapse', toggleIcon);
    $('.panel-group').on('shown.bs.collapse', toggleIcon);
    </script>
@endsection
