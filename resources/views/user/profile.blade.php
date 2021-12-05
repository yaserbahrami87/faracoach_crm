@extends('user.master.index')

@section('headerScript')
    <link href="{{asset('/css/kamadatepicker.min.css')}}" rel="stylesheet" />
    <link href="{{asset('/css/timepicker.min.css')}}" rel="stylesheet" />
@endsection
@section('content')

    <div class="col-md-4">
        @include('user.boxProfile')
        @include('user.boxMadarak')

    </div>
    <div class="col-md-8">
        <div class="row">
            <div class="col-12 alert alert-warning mb-1">
                <i class="bi bi-exclamation-triangle-fill"></i>
                فیلدهای ستاره دار اجباریست
            </div>
        </div>
        <form method="post" action="/panel/profile/update/{{$user->id}}" enctype="multipart/form-data">
            {{csrf_field()}}
            {{method_field('PATCH')}}
            <div class="card card-user">
                <div class="card-header bg-secondary">
                    <h5 class="card-title m-0 p-0 text-light">اطلاعات شخصی</h5>
                </div>
                <div class="card-body bg-secondary-light" id="infoProfile">
                    <div class="row">
                        <div class="col-md-6 px-1">
                            <div class="form-group">
                                <label>نام<span class="text-danger font-weight-bold">*</span></label>
                                <input type="text" class="form-control @if(strlen($user->fname)<>0) is-valid @endif" placeholder="نام را وارد کنید" @if(old('fname')) value='{{old('fname')}}' @else value="{{$user->fname}}" @endif name="fname"  autocomplete="autocomplete"  />
                            </div>
                        </div>
                        <div class="col-md-6 px-1">
                            <div class="form-group">
                                <label>نام خانوادگی<span class="text-danger font-weight-bold">*</span></label>
                                <input type="text" class="form-control @if(strlen($user->lname)<>0) is-valid @endif" placeholder="نام خانوادگی را وارد کنید" @if(old('lname')) value='{{old('lname')}}' @else value="{{$user->lname}}" @endif name="lname"   autocomplete="autocomplete" />
                            </div>
                        </div>
                        <div class="col-md-6 px-1">
                            <div class="form-group">
                                <label for="codemelli">کد ملی<span class="text-danger font-weight-bold">*</span></label>
                                <input type="text" class="form-control  @if(strlen($user->codemelli)<>0) is-valid @endif" placeholder="کد ملی را وارد کنید" @if(strlen($user->codemelli)>0) value="{{$user->codemelli}}" disabled @endif id="codemelli" name="codemelli"  autocomplete="autocomplete" />
                            </div>
                        </div>
                        <div class="col-md-6 px-1">
                            <div class="form-group">
                                <label>شماره شناسنامه</label>
                                <input type="text" class="form-control  @if(strlen($user->shenasname)<>0) is-valid @endif" placeholder="شماره شناسنامه را وارد کنید" @if(old('shenasname')) value='{{old('shenasname')}}' @else value="{{$user->shenasname}}" @endif name="shenasname"  autocomplete="autocomplete" />
                            </div>
                        </div>
                        <div class="col-md-6 px-1">
                            <div class="form-group">
                                <label>تاریخ تولد<span class="text-danger font-weight-bold">*</span></label>
                                <input type="text" class="form-control @if(strlen($user->datebirth)<>0) is-valid @endif" placeholder="تاریخ تولد را وارد کنید" @if(old('datebirth')) value='{{old('datebirth')}}' @else value="{{$user->datebirth}}" @endif name="datebirth" id="datebirth" autocomplete="autocomplete" />
                            </div>
                        </div>
                        <div class="col-md-6 px-1">
                            <div class="form-group">
                                <label>عکس پروفایل</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input @if(is_null($user->getOriginal('personal_image'))) is-valid @endif" id="inputpersonal_image" aria-describedby="inputpersonal_image" name="personal_image"/>
                                    <label class="custom-file-label" for="inputpersonal_image">Choose file</label>
                                </div>
                                <small class="text-muted">فایل های مجاز: JPG و PNG و حداکثر اندازه مجاز: 600KB</small>
                            </div>
                        </div>
                        <div class="col-md-6 px-1">
                            <div class="form-group">
                                <label>نام کاربری</label>
                                <label class="text-danger" data-toggle="tooltip" data-placement="top" title="نام کاربری باید انگلیسی و غیرقابل تغییر می باشد">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                        <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                    </svg>
                                </label>
                                <input type="text" class="form-control @if(strlen($user->username)<>0) is-valid @endif" placeholder="نام کاربری خود را وارد کنید" @if(old('username')) value='{{old('username')}}' @else value="{{$user->username}}" @endif name="username" @if(strlen($user->username)>0) disabled @endif/>
                                <small class="text-muted " dir="ltr">نام کاربری به صورت انگلیسی و تنها کارکترهای مجاز . و _ میباشد
                                    <label class="text-danger" data-toggle="tooltip" data-placement="top" title="فقط مجاز به استفاده از . و _ هستید">
                                        <i class="bi bi-info-circle-fill"></i>
                                    </label>
                                </small>

                            </div>
                        </div>
                        <div class="col-md-12 px-1">
                            <div class="form-group">
                                <label>درباره من</label>
                                <textarea class="form-control @if(strlen($user->aboutme)<>0) is-valid @endif" id="aboutme" name="aboutme" rows="3">@if(old('aboutme')) {{old('aboutme')}} @else {{$user->aboutme}} @endif</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-success mb-5">بروزرسانی</button>

        </form>
    </div>
@endsection




@section('footerScript')

    <script>
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
                    $("#gettingknow").html(data);
                }
            });
        })
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

@endsection
