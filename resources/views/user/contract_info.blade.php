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
                    <h5 class="card-title m-0 p-0 text-light">اطلاعات قرارداد</h5>
                </div>
                <div class="card-body bg-secondary-light" id="infoProfile">
                    <div class="row">
                        <div class="col-12">
                            <div class="alert alert-warning" role="alert">
                                <small>این اطلاعات صرفاجهت عقد قراردادهای آموزشی و ارائه خدمات کوچینگ مورد نیاز است</small>
                            </div>
                        </div>
                        <div class="col-md-4 pl-1">
                            <div class="form-group">
                                <label>نام پدر</label>
                                <input type="text" class="form-control @if(strlen($user->father)<>0) is-valid  @endif" placeholder=" نام پدر را وارد کنید" @if(old('father')) value='{{old('father')}}' @else value="{{$user->father}}" @endif name="father"  lang="fa" />
                            </div>
                        </div>
                        <div class="col-md-4 px-1">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">جنسیت</label>
                                <div class="form-group">
                                    <select class="form-control p-0 @if(strlen($user->sex)<>0) is-valid  @endif" id="exampleFormControlSelect1" name="sex" >
                                        <option selected disabled>انتخاب کنید</option>
                                        <option value="0"  {{ $user->sex =="0" ? 'selected='.'"'.'selected'.'"' : '' }}>زن</option>
                                        <option value="1" {{ $user->sex =="1" ? 'selected='.'"'.'selected'.'"' : '' }}>مرد</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 pr-1">
                            <div class="form-group">
                                <label>تاهل</label>
                                <div class="form-group">
                                    <select class="form-control p-0 @if(strlen($user->married)<>0) is-valid  @endif" id="exampleFormControlSelect1" name="married" >
                                        <option selected disabled>انتخاب کنید</option>
                                        <option value="0" {{ $user->married =="0" ? 'selected='.'"'.'selected'.'"' : '' }}>مجرد</option>
                                        <option value="1" {{ $user->married =="1" ? 'selected='.'"'.'selected'.'"' : '' }}>متاهل</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 pl-1">
                            <div class="form-group">
                                <label>شهر تولد</label>
                                <input type="text" class="form-control @if(strlen($user->born)<>0) is-valid  @endif" placeholder="شهر تولد را وارد کنید" @if(old('born')) value='{{old('born')}}' @else value="{{$user->born}}" @endif name="born"   lang="fa"/>
                            </div>
                        </div>
                        <div class="col-md-4 px-1">
                            <div class="form-group">
                                <label>تحصیلات</label>
                                <select class="custom-select @if(strlen($user->education)<>0) is-valid  @endif" name="education" id="education">
                                    <option selected disabled>انتخاب کنید</option>
                                    <option @if($user->education=='سیکل') selected   @endif>سیکل</option>
                                    <option @if($user->education=='دیپلم') selected   @endif>دیپلم</option>
                                    <option @if($user->education=='فوق دیپلم') selected   @endif>فوق دیپلم</option>
                                    <option @if($user->education=='لیسانس') selected   @endif>لیسانس</option>
                                    <option @if($user->education=='فوق لیسانس') selected   @endif>فوق لیسانس</option>
                                    <option @if($user->education=='دکتری و بالاتر') selected   @endif>دکتری و بالاتر</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 pr-1">
                            <div class="form-group">
                                <label>رشته</label>
                                <div class="form-group">
                                    <input type="text" class="form-control @if(strlen($user->reshteh)<>0) is-valid  @endif" placeholder="رشته را وارد کنید" @if(old('reshteh')) value='{{old('reshteh')}}' @else value="{{$user->reshteh}}" @endif name="reshteh"   lang="fa"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 px-1">
                            <div class="form-group">
                                <label>شغل<span class="text-danger font-weight-bold">*</span></label>
                                <div class="form-group">
                                    <input type="text" class="form-control @if(strlen($user->job)<>0) is-valid  @endif" placeholder="شغل را وارد کنید" @if(old('job')) value='{{old('job')}}' @else value="{{$user->job}}" @endif name="job" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 px-1">
                            <div class="form-group">
                                <label>عکس شناسنامه</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input @if(strlen($user->shenasnameh_image)<>0) is-valid  @endif" id="inputshenasnameh_image" aria-describedby="inputshenasnameh_image" name="shenasnameh_image" />
                                    <label class="custom-file-label" for="inputshenasnameh_image">Choose file</label>
                                </div>
                                <small class="text-muted"> فایل های مجاز: JPG و PNG و حداکثر اندازه مجاز: 600KB</small>
                            </div>
                        </div>
                        <div class="col-md-6 px-1">
                            <div class="form-group">
                                <label>عکس کارت ملی</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input @if(strlen($user->cartmelli_image)<>0) is-valid  @endif" id="inputcartmelli_image" aria-describedby="inputcartmelli_image" name="cartmelli_image">
                                    <label class="custom-file-label" for="inputcartmelli_image">Choose file</label>
                                </div>
                                <small class="text-muted"> فایل های مجاز: JPG و PNG و حداکثر اندازه مجاز: 600KB</small>
                            </div>
                        </div>
                        <div class="col-md-6 px-1">
                            <div class="form-group">
                                <label>عکس مدرک تحصیلی</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input @if(strlen($user->education_image)<>0) is-valid  @endif" id="inputeducation_image" aria-describedby="inputeducation_image" name="education_image" />
                                    <label class="custom-file-label" for="inputeducation_image">Choose file</label>
                                </div>
                                <small class="text-muted"> فایل های مجاز: JPG و PNG و حداکثر اندازه مجاز: 600KB</small>
                            </div>
                        </div>
                        <div class="col-md-6 px-1">
                            <div class="form-group">
                                <label>رزومه</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input @if(strlen($user->resume)<>0) is-valid  @endif" id="resume" aria-describedby="resume" name="resume" />
                                    <label class="custom-file-label" for="resume">Choose file</label>
                                </div>
                                <small class="text-muted"> فایل های مجاز: JPG , DOC و PDF و حداکثر اندازه مجاز: 600KB</small>
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
