@extends('user.master.index')

@section('headerScript')
    <link href="{{asset('/css/kamadatepicker.min.css')}}" rel="stylesheet" />
    <link href="{{asset('/css/timepicker.min.css')}}" rel="stylesheet" />
    <style>
        #collabration label.d-block
        {
            font-size: 16px;
        }
        .form-check label
        {
            font-size: 14px;
        }
    </style>
@endsection
@section('content')

    <div class="col-md-12">

    </div>
    <div class="col-md-8">
        <div class="row">
            <div class="col-12 alert alert-warning mb-1">
                <i class="bi bi-exclamation-triangle-fill"></i>
                فیلدهای ستاره دار اجباریست
            </div>
        </div>
        <ul class="nav nav-pills nav-fill" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="true">اطلاعات شخصی</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="pills-contacts-tab" data-toggle="pill" href="#pills-contacts" role="tab" aria-controls="pills-contacts" aria-selected="false">اطلاعات تماس</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="pills-introduction-tab" data-toggle="pill" href="#pills-introduction" role="tab" aria-controls="pills-introduction" aria-selected="false">رزومه و سوابق</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="pills-contract-tab" data-toggle="pill" href="#pills-contract" role="tab" aria-controls="pills-contract" aria-selected="false">اطلاعات قرارداد</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="pills-collabration-tab" data-toggle="pill" href="#pills-collabration" role="tab" aria-controls="pills-collabration" aria-selected="false">اطلاعات همکاری</a>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <form method="post" action="/panel/profile/update/{{Auth::user()->id}}" enctype="multipart/form-data">
                    {{csrf_field()}}
                    {{method_field('PATCH')}}
                    <div class="card card-user">
                        <div class="card-body bg-secondary-light" id="infoProfile">
                            <div class="row">
                                <div class="col-md-6 px-1">
                                    <div class="form-group">
                                        <label>نام<span class="text-danger font-weight-bold">*</span></label>
                                        <input type="text" class="form-control @if(strlen(Auth::user()->fname)<>0) is-valid @endif" placeholder="نام را وارد کنید" @if(old('fname')) value='{{old('fname')}}' @else value="{{old('fname',Auth::user()->fname) }}" @endif name="fname"  autocomplete="autocomplete"  />
                                    </div>
                                </div>
                                <div class="col-md-6 px-1">
                                    <div class="form-group">
                                        <label>نام خانوادگی<span class="text-danger font-weight-bold">*</span></label>
                                        <input type="text" class="form-control @if(strlen(Auth::user()->lname)<>0) is-valid @endif" placeholder="نام خانوادگی را وارد کنید" @if(old('lname')) value='{{old('lname')}}' @else value="{{old('lname',Auth::user()->lname)}}" @endif name="lname"   autocomplete="autocomplete" />
                                    </div>
                                </div>

                                <div class="col-md-6 px-1">
                                    <div class="form-group">
                                        <label>نام انگلیسی<span class="text-danger font-weight-bold">*</span></label>
                                        <input type="text" class="form-control @if(strlen(Auth::user()->fname_en)<>0) is-valid @endif" placeholder="نام انگلیسی را وارد کنید" @if(old('fname_en')) value='{{old('fname_en')}}' @else value="{{old('fname_en',Auth::user()->fname_en) }}" @endif name="fname_en"  autocomplete="autocomplete" @if(strlen(Auth::user()->fname_en)<>0) disabled @endif />
                                    </div>
                                </div>
                                <div class="col-md-6 px-1">
                                    <div class="form-group">
                                        <label>نام خانوادگی انگلیسی<span class="text-danger font-weight-bold">*</span></label>
                                        <input type="text" class="form-control @if(strlen(Auth::user()->lname_en)<>0) is-valid @endif" placeholder="نام خانوادگی انگلیسی را وارد کنید" @if(old('lname_en')) value='{{old('lname_en')}}' @else value="{{old('lname_en',Auth::user()->lname_en)}}" @endif name="lname_en"   autocomplete="autocomplete" @if(strlen(Auth::user()->lname_en)<>0) disabled @endif />
                                    </div>
                                </div>

                                <div class="col-md-6 px-1">
                                    <div class="form-group">
                                        <label for="codemelli">کد ملی</label>
                                        <input type="text" class="form-control  @if(strlen(Auth::user()->codemelli)<>0) is-valid @endif" placeholder="کد ملی را وارد کنید" @if(strlen(Auth::user()->codemelli)>0) value="{{old('codemelli',Auth::user()->codemelli)}}" disabled @endif id="codemelli" name="codemelli"  autocomplete="off" />
                                    </div>
                                </div>
                                <div class="col-md-6 px-1">
                                    <div class="form-group">
                                        <label>شماره شناسنامه</label>
                                        <input type="text" class="form-control  @if(strlen(Auth::user()->shenasname)<>0) is-valid @endif" placeholder="شماره شناسنامه را وارد کنید" value='{{old('shenasname',Auth::user()->shenasname)}}'  name="shenasname"  autocomplete="off" />
                                    </div>
                                </div>
                                <div class="col-md-6 px-1">
                                    <div class="form-group">
                                        <label>تاریخ تولد</label>
                                        <input type="text" class="form-control @if(strlen(Auth::user()->datebirth)<>0) is-valid @endif" placeholder="تاریخ تولد را وارد کنید"  value='{{old('datebirth',Auth::user()->datebirth)}}' name="datebirth" id="datebirth" autocomplete="off" />
                                    </div>
                                </div>
                                <div class="col-md-6 px-1">
                                    <div class="form-group">
                                        <label>عکس پروفایل</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input @if(is_null(Auth::user()->getOriginal('personal_image'))) is-valid @endif" id="inputpersonal_image" aria-describedby="inputpersonal_image" name="personal_image"/>
                                            <label class="custom-file-label" for="inputpersonal_image">Choose file</label>
                                        </div>
                                        <small class="text-muted">فایل های مجاز: JPG و PNG و حداکثر اندازه مجاز: 600KB</small>
                                    </div>
                                </div>
                                <div class="col-md-6 px-1">
                                    <div class="form-group">
                                        <label>نام کاربری</label>
                                        <span class="text-danger font-weight-bold">*</span>
                                        <label class="text-danger" data-toggle="tooltip" data-placement="top" title="فقط حروف انگلیسی مورد تایید است. نام کاربری ثابت و غیرقابل تغییر می باشد.">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                            </svg>
                                        </label>

                                        <input type="text" class="form-control @if(strlen(Auth::user()->username)<>0) is-valid @endif" placeholder="نام کاربری خود را وارد کنید" @if(old('username')) value='{{old('username')}}' @else value="{{Auth::user()->username}}" @endif name="username" @if(strlen(Auth::user()->username)>0) disabled @endif/>


                                    </div>
                                </div>
                                <div class="col-md-12 px-1">
                                    <div class="form-group">
                                        <label>درباره من</label>
                                        <textarea class="form-control @if(strlen(Auth::user()->aboutme)<>0) is-valid @endif" id="aboutme" name="aboutme" rows="3">@if(old('aboutme')) {{old('aboutme')}} @else {{Auth::user()->aboutme}} @endif</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success mb-5">بروزرسانی</button>

                </form>
            </div>
            <div class="tab-pane fade" id="pills-contacts" role="tabpanel" aria-labelledby="pills-contacts-tab">
                <form method="post" action="/panel/profile/update/{{Auth::user()->id}}" enctype="multipart/form-data">
                    {{csrf_field()}}
                    {{method_field('PATCH')}}
                    <div class="card card-user">
                        <!--
                        <div class="card-header bg-secondary">
                            <h5 class="card-title m-0 p-0 text-light">اطلاعات تماس</h5>
                        </div>
                        -->
                        <div class="card-body bg-secondary-light" id="infoProfile">
                            <div class="row">
                                <div class="col-md-6 px-1">
                                    <div class="form-group">
                                        <label>تلفن تماس</label>
                                        <input type="hidden" id="tel_org" value="{{old('tel',Auth::user()->tel)}}" name="tel"/>
                                        <input type="tel" dir="ltr" class="form-control @if(strlen(Auth::user()->tel)==0) is-invalid  @else is-valid  @endif" placeholder="تلفن تماس را وارد کنید" value='{{old('tel',Auth::user()->tel)}}'  id="tel"  @if(strlen(Auth::user()->tel)>0 ) disabled  @endif  />
                                    </div>
                                </div>
                                <div class="col-md-6 pr-1">
                                    <div class="form-group">
                                        <label for="email">پست الکترونیکی</label>
                                        <input type="email" class="form-control @if(strlen(Auth::user()->email)<>0) is-valid @endif" placeholder="پست الکترونیکی را وارد کنید" @if(strlen(Auth::user()->email)>0) value="{{Auth::user()->email}}" disabled @endif name="email"  id="email"  />
                                    </div>
                                </div>
                                <div class="col-md-6 pl-1">
                                    <div class="form-group">

                                        <label>استان</label>
                                        <select class="custom-select @if(strlen(Auth::user()->state)<>0) is-valid @endif"  name="state" id="state">
                                            <option selected disabled>استان را انتخاب کنید</option>
                                            @foreach ($states as $item)
                                                <option value="{{$item->id}}" @if($item->id==Auth::user()->state) selected @endif>{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 px-1">
                                    <div class="form-group">
                                        <label>شهر</label>
                                        <select class="custom-select @if(strlen(Auth::user()->city)<>0) is-valid @endif" name="city" id="city">
                                            @foreach($cities as $city)
                                                 <option value="{{Auth::user()->city}}" @if (Auth::user()->city==$city->id) selected="selected" @endif> {{$city->name}}  </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12 px-1">
                                    <div class="form-group">
                                        <label>آدرس</label>
                                        <input type="text" class="form-control @if(strlen(Auth::user()->address)<>0) is-valid  @endif" placeholder="آدرس را وارد کنید"  @if(old('address')) value='{{old('address')}}' @else value="{{Auth::user()->address}}" @endif name="address"  lang="fa" />
                                    </div>
                                </div>
                                <div class="col-md-4 px-1">
                                    <div class="form-group">
                                        <label>اینستاگرام</label>
                                        <input type="text" class="form-control @if(strlen(Auth::user()->instagram)<>0) is-valid  @endif" placeholder="صفحه اینستاگرام خود را وارد کنید" @if(old('instagram')) value='{{old('instagram')}}' @else value="{{Auth::user()->instagram}}" @endif name="instagram"  />
                                    </div>
                                </div>
                                <div class="col-md-4 px-1">
                                    <div class="form-group">
                                        <label>تلگرام</label>
                                        <input type="text" class="form-control @if(strlen(Auth::user()->telegram)<>0) is-valid  @endif" placeholder="آیدی تلگرام خود را وارد کنید" @if(old('telegram')) value='{{old('telegram')}}' @else value="{{Auth::user()->telegram}}" @endif name="telegram"  />
                                    </div>
                                </div>
                                <div class="col-md-4 px-1">
                                    <div class="form-group">
                                        <label>لینکدین</label>
                                        <input type="text" class="form-control @if(strlen(Auth::user()->linkedin)<>0) is-valid  @endif" placeholder="آیدی لینکدین خود را وارد کنید" @if(old('linkedin')) value='{{old('linkedin')}}' @else value="{{Auth::user()->linkedin}}" @endif name="linkedin"  />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success mb-5">بروزرسانی</button>
                </form>
            </div>
            <div class="tab-pane fade" id="pills-introduction" role="tabpanel" aria-labelledby="pills-introduction-tab">
                <form method="post" action="/panel/profile/update/{{Auth::user()->id}}" enctype="multipart/form-data">
                    {{csrf_field()}}
                    {{method_field('PATCH')}}
                    <div class="card card-user " id="infogettingKnow">
                        <div class="card-body bg-secondary-light">
                            <div class="row">
                                <div class="col-md-6 px-1">
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success mb-5">بروزرسانی</button>

                </form>
            </div>
            <div class="tab-pane fade" id="pills-contract" role="tabpanel" aria-labelledby="pills-contract-tab">
                <form method="post" action="/panel/profile/update/{{Auth::user()->id}}" enctype="multipart/form-data">
                    {{csrf_field()}}
                    {{method_field('PATCH')}}
                    <div class="card card-user">
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
                                        <input type="text" class="form-control @if(strlen(Auth::user()->father)<>0) is-valid  @endif" placeholder=" نام پدر را وارد کنید" @if(old('father')) value='{{old('father')}}' @else value="{{Auth::user()->father}}" @endif name="father"  lang="fa" />
                                    </div>
                                </div>
                                <div class="col-md-4 px-1">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">جنسیت</label>
                                        <div class="form-group">
                                            <select class="form-control p-0 @if(strlen(Auth::user()->sex)<>0) is-valid  @endif" id="exampleFormControlSelect1" name="sex" >
                                                <option selected disabled>انتخاب کنید</option>
                                                <option value="0"  {{ Auth::user()->sex =="0" ? 'selected='.'"'.'selected'.'"' : '' }}>زن</option>
                                                <option value="1" {{ Auth::user()->sex =="1" ? 'selected='.'"'.'selected'.'"' : '' }}>مرد</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 pr-1">
                                    <div class="form-group">
                                        <label>تاهل</label>
                                        <div class="form-group">
                                            <select class="form-control p-0 @if(strlen(Auth::user()->married)<>0) is-valid  @endif" id="exampleFormControlSelect1" name="married" >
                                                <option selected disabled>انتخاب کنید</option>
                                                <option value="0" {{ Auth::user()->married =="0" ? 'selected='.'"'.'selected'.'"' : '' }}>مجرد</option>
                                                <option value="1" {{ Auth::user()->married =="1" ? 'selected='.'"'.'selected'.'"' : '' }}>متاهل</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 pl-1">
                                    <div class="form-group">
                                        <label>شهر تولد</label>
                                        <input type="text" class="form-control @if(strlen(Auth::user()->born)<>0) is-valid  @endif" placeholder="شهر تولد را وارد کنید" @if(old('born')) value='{{old('born')}}' @else value="{{Auth::user()->born}}" @endif name="born"   lang="fa"/>
                                    </div>
                                </div>
                                <div class="col-md-4 px-1">
                                    <div class="form-group">
                                        <label>تحصیلات</label>
                                        <select class="custom-select @if(strlen(Auth::user()->education)<>0) is-valid  @endif" name="education" id="education">
                                            <option selected disabled>انتخاب کنید</option>
                                            <option {{ old('education',Auth::user()->education)=="زیردیپلم" ? 'selected='.'"'.'selected'.'"' : '' }}   >زیردیپلم</option>
                                            <option {{ old('education',Auth::user()->education)=="دیپلم" ? 'selected='.'"'.'selected'.'"' : '' }}>دیپلم</option>
                                            <option {{ old('education',Auth::user()->education)=="فوق دیپلم" ? 'selected='.'"'.'selected'.'"' : '' }}>فوق دیپلم</option>
                                            <option {{ old('education',Auth::user()->education)=="لیسانس" ? 'selected='.'"'.'selected'.'"' : '' }}>لیسانس</option>
                                            <option {{ old('education',Auth::user()->education)=="فوق لیسانس" ? 'selected='.'"'.'selected'.'"' : '' }}>فوق لیسانس</option>
                                            <option {{ old('education',Auth::user()->education)=="دکتری و بالاتر" ? 'selected='.'"'.'selected'.'"' : '' }}>دکتری و بالاتر</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 pr-1">
                                    <div class="form-group">
                                        <label>رشته</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control @if(strlen(Auth::user()->reshteh)<>0) is-valid  @endif" placeholder="رشته را وارد کنید" @if(old('reshteh')) value='{{old('reshteh')}}' @else value="{{Auth::user()->reshteh}}" @endif name="reshteh"   lang="fa"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 px-1">
                                    <div class="form-group">
                                        <label>شغل</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control @if(strlen(Auth::user()->job)<>0) is-valid  @endif" placeholder="شغل را وارد کنید" @if(old('job')) value='{{old('job')}}' @else value="{{Auth::user()->job}}" @endif name="job" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 px-1">
                                    <div class="form-group">
                                        <label>عکس شناسنامه</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input @if(strlen(Auth::user()->shenasnameh_image)<>0) is-valid  @endif" id="inputshenasnameh_image" aria-describedby="inputshenasnameh_image" name="shenasnameh_image" />
                                            <label class="custom-file-label" for="inputshenasnameh_image">Choose file</label>
                                        </div>
                                        <small class="text-muted"> فایل های مجاز: JPG و PNG و حداکثر اندازه مجاز: 600KB</small>
                                    </div>
                                </div>
                                <div class="col-md-6 px-1">
                                    <div class="form-group">
                                        <label>عکس کارت ملی</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input @if(strlen(Auth::user()->cartmelli_image)<>0) is-valid  @endif" id="inputcartmelli_image" aria-describedby="inputcartmelli_image" name="cartmelli_image">
                                            <label class="custom-file-label" for="inputcartmelli_image">Choose file</label>
                                        </div>
                                        <small class="text-muted"> فایل های مجاز: JPG و PNG و حداکثر اندازه مجاز: 600KB</small>
                                    </div>
                                </div>
                                <div class="col-md-6 px-1">
                                    <div class="form-group">
                                        <label>عکس مدرک تحصیلی</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input @if(strlen(Auth::user()->education_image)<>0) is-valid  @endif" id="inputeducation_image" aria-describedby="inputeducation_image" name="education_image" />
                                            <label class="custom-file-label" for="inputeducation_image">Choose file</label>
                                        </div>
                                        <small class="text-muted"> فایل های مجاز: JPG و PNG و حداکثر اندازه مجاز: 600KB</small>
                                    </div>
                                </div>
                                <div class="col-md-6 px-1">
                                    <div class="form-group">
                                        <label>رزومه</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input @if(strlen(Auth::user()->resume)<>0) is-valid  @endif" id="resume" aria-describedby="resume" name="resume" />
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
            <div class="tab-pane fade" id="pills-collabration" role="tabpanel" aria-labelledby="pills-collabration-tab">

                    <form method="post" action="/panel/profile/update/{{Auth::user()->id}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        {{method_field('PATCH')}}
                        <div class="card card-user " id="collabration">
                            <div class="card-body bg-secondary-light">
                                <div class="row">
                                    <div class="col-md-12 px-1">
                                        <div class="form-group">
                                            <label for="service" class="d-block">انتخاب خدمت :</label>
                                            @foreach($services as $services)
                                                <div class="form-check form-check-inline">
                                                        <input class="form-check-input services" type="checkbox" id="inlineCheckbox{{$services->id}}" value="{{$services->id}}">
                                                        <label class="form-check-label" for="inlineCheckbox{{$services->id}}">{{$services->title}}</label>
                                                </div>
                                            @endforeach
                                            <label for="service" class="d-block">انتخاب تخصص :</label>
                                            @foreach($speciality as $speciality_item)
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox{{$speciality_item->id}}" value="{{$speciality_item->id}}">
                                                    <label class="form-check-label" for="inlineCheckbox{{$speciality_item->id}}">{{$speciality_item->title}}</label>
                                                </div>
                                            @endforeach
                                            <label for="service" class="d-block">انتخاب گرایش :</label>
                                            @foreach($orientation as $orientation_item)
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox{{$orientation_item->id}}" value="{{$orientation_item->id}}">
                                                    <label class="form-check-label" for="inlineCheckbox{{$orientation_item->id}}">{{$orientation_item->title}}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success mb-5">ذخیره</button>

                    </form>

            </div>
        </div>
    </div>
@endsection




@section('footerScript')

    <script>
        $(".services").click(function()
        {
            if($(this).prop('checked'))
            {
                console.log( $(this).val());
            }

            // var loading='<div class="col-12 text-center"><div class="spinner-border text-primary text-center" role="status"><span class="sr-only">Loading...</span></div></div>';
            //
            // var content=$(this).val();
            // $.ajax({
            //     type:'GET',
            //     url:"/showListChildGettingKnow/"+content,
            //     success:function(data)
            //     {
            //         $("#gettingknow2").css('display','flex');
            //         $("#gettingknow").html(data);
            //     }
            // });
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

    <script>
        var input = document.querySelector("#tel");
        var intl=intlTelInput(input,{
            formatOnDisplay:false,
            separateDialCode:true,
            autoPlaceholder:'off',
            preferredCountries:["ir", "gb"]
        });

        input.addEventListener("countrychange", function() {
            document.querySelector("#tel_org").value=intl.getNumber();
        });

        $('#tel').change(function()
        {
            document.querySelector("#tel_org").value=intl.getNumber();
        });

        // تلفن معرف
        var input = document.querySelector("#introduced_profile");

        var intl=intlTelInput(input,{
            formatOnDisplay:false,
            separateDialCode:true,
            preferredCountries:["ir", "gb"]
        });

        input.addEventListener("countrychange", function() {
            document.querySelector("#introduced").value=intl.getNumber();
        });
        $('#introduced_profile').change(function()
        {
            document.querySelector("#introduced").value=intl.getNumber();
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
