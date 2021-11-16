@extends('master.index')
@section('headerscript')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css"/>
    <style>
        .back{
            width:100%;
            height: 550px;
            background-color: rgba(2,1,19,.81);
        }
        #title{
            color:#fff;
        }
        .btn-i{
            color:rgb(253 192 7);
        }
        .name, .fallow{
            border: 5px solid #fff;
            border-radius: 5px;
        }
        .fallow{
            background-color: #fff;
            height:300px
        }
        .name{
            background-image: url("{{asset('images/esfahan1.png')}}");
            background-size:100% 100%;
        }
        .fallow2{
            background-color: antiquewhite;
        }
        #date{
            background-color:#f5f5f5;
            height:100px;
            border-radius: 10px;
        }
        .rectangle{
            background-color: #ffc107;
            position: absolute;
            width: 6px;
            height: 55px;
            margin-right: -18px;
            margin-top: -6px;
        }

        #personal_link
        {
            direction: ltr;
            cursor: pointer;
        }

        #link_webinar
        {
            white-space: nowrap;
            overflow: auto;
        }


        @media only screen and (min-width:320px)
        {
            .name
            {
                height: auto;
            }
        }

    </style>
@endsection

@section('row1')
    <div class="row" id="">
        <div class="col-12 back">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-md-6 col-sm-12 col-sx-12 align-right mt-5" id="title">
                        <h1> {{$event->event}} </h1>
                        <p>  {{$event->description}} </p>
                        <p class="float-left mr-5"> <i class="bi bi-geo-alt-fill"></i>@if($event->type==2) به صورت آنلاین  @else  {{$event->address}}  @endif </p>
                        <p class="float-left mr-5"> <i class="bi bi-clock-fill"></i>  ساعت {{$event->start_time}}  الی {{$event->end_time}}   </p>
                        <p> <i class="bi bi-calendar-check-fill"></i>  {{$event->eventDate}} </p>
                        <p> <i class="bi bi-tags-fill"></i> دسته بندی:  </p>
                    </div>
                    <div class="col-xl-6 col-md-6 col-sm-12 col-sx-12 align-right mt-5 " >
                        <!--
                            <button type="button" class="btn btn-outline-warning btn-lg mt-5 "> <i class="bi bi-calendar-check-fill btn-i mr-2"></i>افزودن به تقویم </button>
                            <button type="button" class="btn btn-outline-warning btn-lg mt-5 "> <i class="bi bi-bookmark-check-fill btn-i"></i> ذخیره </button>
                        -->
                    </div>
                </div>
                <div class="row mt-3 mb-5">
                    <div class="col-xl-4 col-md-4 col-sm-12 col-sx-12 ">
                        <!--
                        <div class="card fallow text-center">
                            <div class="card-body ">

                                <button type="button" class="btn btn-success mt-5 ">
                                    <i class="bi bi-hand-thumbs-up-fill"></i>دنبال کردن
                                </button>
                            </div>
                        </div>
                        -->
                        <div class="card">
                            <div class="card-body  ">
                                <div class="col-12 ">
                                    <h5 class="float-left mr-5"> زمان</h5>
                                    <h5 class="float-right mr-5"> موضوع</h5>
                                </div>
                                <div class="col-12 mt-5" id="date">
                                    <div class="row text-center ">
                                        <div class="col-6 pt-5 font-weight-bold">
                                            {{$event->event}}
                                        </div>
                                        <div class="col-6 pt-3 font-weight-bold">
                                            {{$event->start_time}}
                                            <p class="p-0 m-1">&darr;</p>
                                            {{$event->end_time}}
                                        </div>
                                    </div>
                                </div>

                                @if(!Auth::check())
                                    <div class="col-12 pt-1 text-center">
                                        <div class="alert alert-warning">
                                            برای شرکت در دوره باید وارد سایت شوید

                                            <button type="button" class="btn btn-primary mt-2" data-toggle="modal" data-target="#login">
                                                ورود / ثبت نام
                                            </button>
                                        </div>
                                        <!-- Modal -->
                                        <div class="modal fade" id="login" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">ورود / ثبت نام</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <nav>
                                                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                                <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">ورود</a>
                                                                <a class="nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">ثبت نام</a>
                                                            </div>
                                                        </nav>
                                                        <div class="tab-content mt-3" id="nav-tabContent">
                                                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                                                <div class="col-12" id="result_login">
                                                                </div>
                                                                <form method="POST"  id="loginAjax">
                                                                    {{csrf_field()}}
                                                                    <div class="form-group row">
                                                                        <div class="col-md-6 offset-md-3">
                                                                            <div class="input-group mb-3">
                                                                                <div class="input-group-prepend">
                                                                                    <span class="input-group-text" id="basic-addon1">
                                                                                        <i class="bi bi-person-fill"></i>
                                                                                    </span>
                                                                                </div>
                                                                                <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"   required autocomplete="tel" autofocus placeholder="نام کاربری / ایمیل خود را وارد کنید" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-md-6 offset-md-3">
                                                                            <div class="input-group mb-3">
                                                                                <div class="input-group-prepend">
                                                                                        <span class="input-group-text" id="basic-addon1">
                                                                                            <i class="bi bi-key-fill"></i>
                                                                                        </span>
                                                                                </div>
                                                                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}"   required  placeholder=" رمز خود را وارد کنید" />
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row mb-0">
                                                                        <div class="col-12">
                                                                            <button type="button" class="btn btn-primary" id="btn_submit" >
                                                                                {{ __('ورود') }}
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                                                <div class="col-12" id="result_signup"></div>
                                                                <form method="POST" id="frm_signup">
                                                                    {{csrf_field()}}
                                                                    <div class="form-group row">
                                                                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('پست الکترونیکی:*') }}</label>

                                                                        <div class="col-md-6">
                                                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                                                            @error('email')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row">
                                                                        <label for="tel" class="col-md-4 col-form-label text-md-right">{{ __('تلفن همراه:*') }}</label>
                                                                        <div class="col-md-6">
                                                                            <div class="input-group">
                                                                                <input id="tel" type="text" class="form-control @error('tel') is-invalid @enderror" name="tel" value="{{ old('tel') }}" required autocomplete="tel">
                                                                                @error('tel')
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $message }}</strong>
                                                                                </span>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row">
                                                                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('رمز عبور:*') }}</label>

                                                                        <div class="col-md-6">
                                                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                                                            @error('password')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row">
                                                                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('تکرار رمز عبور:*') }}</label>

                                                                        <div class="col-md-6">
                                                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row mb-0">
                                                                        <div class="col-md-6 offset-md-4">
                                                                            <button type="button" class="btn btn-primary" id="btn_signup">
                                                                                {{ __('ثبت نام') }}
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else

                                    @if(($eventReserve->count()==0) && ($event->status_event=='در حال ثبت نام'))
                                        <p class="mt-3 text-center font-weight-bold">ظرفیت باقیمانده: {{$event->capacity}} نفر</p>
                                        <div class="col-12 text-center">
                                            <input type="button"  class="btn btn-primary mt-3" value="شرکت در دوره" data-toggle="modal" data-target="#eventreserve" />
                                        </div>
                                        <div class="modal fade" id="eventreserve" tabindex="-1" aria-labelledby="eventreserveModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">شرکت در دوره</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <div class="col-12" id="result_reserve"></div>
                                                        <h3>{{$event->event}}</h3>
                                                        <p>برای شرکت در رویداد لطفا کد ارسال شده به همراهتون را وارد کنید</p>
                                                        <form method="POST" id="frm_checkCode">
                                                            {{csrf_field()}}
                                                            <input type="number" class="form-control mt-3 mb-3" value="کد ارسال شده را وارد کنید" name="code"/>
                                                            <input type="hidden" class="form-control mt-3 mb-3" value="event" name="type"/>
                                                            <input type="button" class="btn btn-success" value="ثبت کد" id="btn-checkCode" />
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @elseif($event->status_event=='تکمیل ظرفیت')
                                        <div class="col-12 text-center">
                                            <input type="button"  class="btn btn-warning mt-3" value="تکمیل ظرفیت شد"  />
                                        </div>
                                    @elseif($event->status_event=='برگزار شد')
                                        <div class="col-12 text-center">
                                            <input type="button"  class="btn btn-danger mt-3" value="برگزار شد"  />
                                        </div>
                                    @elseif($eventReserve->count()!=0)
                                        <div class="col-12 text-center">
                                            <input type="button"  class="btn btn-primary mt-3" value="شما در این دوره ثبت نام کرده اید"  />
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>

                        @if(Auth::check())
                            <div class="card mt-4" >
                                <div class="card-body text-center">
                                    <h5>لینک دعوت اختصاصی شما</h5>
                                    <p class="text-light bg-secondary p-2 dir-rtl text-center"  id="personal_link">{{asset('/event/'.$event->shortlink)."?q=".Auth::user()->id}}</p>
                                </div>
                            </div>

                            @if($eventReserve->count()>0 && ($event->type==2))
                                <div class="card mt-4" >
                                    <div class="card-body overflow-auto text-center">
                                        <h5>لینک حضور در دوره</h5>
                                        <p class="bg-secondary p-2" id="link_webinar">
                                            <a href="{{$event->address}}" class=" text-center dir-rtl text-light " target="_blank">
                                            {{$event->address}}}}
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            @endif
                        @endif
                        <!--
                        <div class="card mt-4 ">
                            <div class="card-body text-center">
                                <img src="{{asset('/images/Yaser-Motahedin.png')}}" class="d-block "/>
                                <h4> برگزارکننده: </h4>
                                <button type="button" class="btn btn-success mt-5 "> <i class="bi bi-hand-thumbs-up-fill"></i>دنبال کردن</button>

                            </div>
                        </div>
                        -->
                    </div>
                    <div class="col-xl-8 col-md-8 col-sm-12 col-sx-12 mb-5 ">
                        <div class="card name">
                            <div class="card-body ">
                                <img src="{{asset('/documents/events/'.$event->image)}}" class="img-fluid" />
                            </div>
                        </div>
                        @if(!is_null($event->video))
                            <div class="card mt-4">
                                <div class="card-body ">
                                    <div class="rounded-rectangle rectangle" >
                                    </div>
                                    <h2>
                                        ویدئوی معرفی وبینار
                                    </h2>
                                    {!! $event->video !!}
                                </div>
                            </div>
                        @endif

                        @if(!is_null($event->event_text))
                            <div class="card mt-4">
                                <div class="card-body ">
                                    <div class="rounded-rectangle rectangle" >
                                    </div>
                                    <h2>
                                        توضیحات وبینار
                                    </h2>
                                    {!! $event->event_text !!}
                                </div>
                            </div>
                        @endif

                        @if(! is_null($event->heading))
                            <div class="card mt-4">
                                <div class="card-body ">
                                    <div class="rounded-rectangle rectangle " >
                                    </div>
                                    <h2>
                                        سرفصل‌های وبینار
                                    </h2>
                                    {!! $event->heading !!}
                                </div>
                            </div>
                        @endif

                        @if(!is_null($event->contacts))
                            <div class="card mt-4">
                                <div class="card-body ">
                                    <div class="rounded-rectangle rectangle" >
                                    </div>
                                    <h2>
                                        مخاطبین وبینار
                                    </h2>
                                    {!! $event->contacts !!}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row">

                </div>
            </div>

        </div>
    </div>
@endsection


@section('footerScript')
   <script>
       $("#personal_link").click(function()
       {
           navigator.clipboard.writeText($('#personal_link').text());
           alert('لینک دعوت اختصاصی شما کپی شد');
       });



       //ارسال کد فعال سازی
       $('#eventreserve').on('show.bs.modal', function (event) {
            $.ajax(
                {
                    type:'post',
                    url:'/verify',
                    data:{
                        "_token"    : "{{ csrf_token() }}",
                        type:'event',
                        event:'{{$event->event}}',
                    },
                    success:function(data)
                    {
                        $( '#result_reserve' ).html( data );
                    },
                    error : function(data)
                    {
                        $('#result_reserve').text(data.responseJSON.errors);
                        console.log(data.responseJSON.errors);
                        errorsHtml='<div class="alert alert-danger text-left"><ul>';
                        $.each( data.responseJSON.errors, function( key, value ) {
                            errorsHtml += '<li>'+ value[0] + '</li>'; //showing only the first error.
                        });
                        errorsHtml += '</ul></div>';

                        $( '#result_reserve' ).html( errorsHtml );
                    }

                }
            );
       })

        //بررسی کد فعال سازی
       $("#btn-checkCode").click(function()
       {
           $('#result_reserve').html('<div class="spinner-border text-primary mb-3" role="status"> <span class="sr-only">لطفا صبر کنید...</span> </div>');
           var data=$('#frm_checkCode').serialize();
           $.ajax(
               {
                   data:data,
                   url:'/verifyCode',
                   type:'POST',
                   success: function (data) {
                       // $('#result_reserve').html(data);

                       if(typeof(data)!='object')
                       {
                           $('#result_reserve').html("<div class='alert alert-danger'>کد اشتباه است</div>");
                       }
                       else
                       {
                           $('#result_reserve').html("<div class='alert alert-success'>کد صحیح وارد شد</div>");
                           $.post('/panel/eventreserve', { event_id: '{{$event->id}}'},
                               function(returnedData){
                                   if(typeof(data)=='object')
                                   {
                                       $('#result_reserve').html("<div class='alert alert-success'>رزرو دوره با موفقیت انجام شد</div>");
                                       location.reload();
                                   }
                                   else
                                   {
                                       $('#result_reserve').html("<div class='alert alert-danger'>خطا در رزرو</div>");
                                   }
                               });
                       }
                       console.log(typeof (data));

                   },
                   error : function(data)
                   {

                       $('#result_reserve').text(data.responseJSON.errors);
                       console.log(data.responseJSON.errors);
                       errorsHtml='<div class="alert alert-danger text-left"><ul>';
                       $.each( data.responseJSON.errors, function( key, value ) {
                           errorsHtml += '<li>'+ value[0] + '</li>'; //showing only the first error.
                       });
                       errorsHtml += '</ul></div>';

                       $( '#result_reserve' ).html( errorsHtml );
                   }
               }
           )
       });

        //لاگین ایجکس
        $("#btn_submit").click(function()
        {
            $('#result_login').html('<div class="spinner-border text-primary mb-3" role="status"> <span class="sr-only">لطفا صبر کنید...</span> </div>');
            var data=$('#loginAjax').serialize();
            $.ajax(
                {
                    type:"POST",
                    url:'/login',
                    data:data,

                    success: function (data) {
                        $('#result_login').html("<div class='alert alert-success'>ورود با موفقیت انجام شد</div>");
                        location.reload();
                    },
                    error : function(data)
                    {

                        $('#result_login').text(data.responseJSON.errors);
                        console.log(data.responseJSON.errors);
                        errorsHtml='<div class="alert alert-danger text-left"><ul>';
                        $.each( data.responseJSON.errors, function( key, value ) {
                            errorsHtml += '<li>'+ value[0] + '</li>'; //showing only the first error.
                        });
                        errorsHtml += '</ul></div>';
                        $( '#result_login' ).html( errorsHtml );
                    }
                }
            )
        });

        $("#btn_signup").click(function()
        {
            var data=$('#frm_signup').serialize();
            $('#result_signup').html('<div class="spinner-border text-primary mb-3" role="status"> <span class="sr-only">لطفا صبر کنید...</span> </div>');
            $.ajax({
                    type:'POST',
                    url:'/signupAjax',
                    data:data,
                    success:function (data)
                    {
                        $("#result_signup").html(data);
                    },
                    error : function(data)
                    {

                        $('#result_signup').text(data.responseJSON.errors);
                        console.log(data.responseJSON.errors);
                        errorsHtml='<div class="alert alert-danger text-left"><ul>';
                        $.each( data.responseJSON.errors, function( key, value ) {
                            errorsHtml += '<li>'+ value[0] + '</li>'; //showing only the first error.
                        });
                        errorsHtml += '</ul></div>';

                        $( '#result_signup' ).html( errorsHtml );
                    }
                })
        });
   </script>
@endsection
