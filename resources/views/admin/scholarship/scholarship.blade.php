@extends('admin.master.index')
@section('content')

    <div class="col-12 col-sm-12 col-md-3 col-lg-3 text-center ">
        @if(is_null($scholarship->user->personal_image))
            <img src="{{asset('/documents/users/default-avatar.png')}}" width="100px" height="100px"  class="rounded-circle border border-3"/>
        @else
            <img src="{{asset('/documents/users/'.$scholarship->user->personal_image)}}" width="100px" height="100px" class="rounded-circle border border-3 " />
        @endif
        <p>
            <a href="/admin/user/{{$scholarship->user_id}}">
                {{$scholarship->user->fname." ".$scholarship->user->lname}}
            </a>
        </p>
        <p>وضعیت:
            @switch($scholarship->status)
                @case(0)بررسی نشده
                    @break
                @case(1)قبول درخواست
                    @break
                @case(2)رد درخواست
                    @break
                @case(3)در حال بررسی
                    @break
                @case(4)اصلاح درخواست
                    @break
                @default خطا
            @endswitch
        </p>
    </div>
    <div class="col-12">
        <div class="row">
            <div class="col-12">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="contact-tab" data-toggle="tab" data-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">اطلاعات بورسیه</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-toggle="tab" data-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">اطلاعات کاربر</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link " id="introduce-tab" data-toggle="tab" data-target="#introduce" type="button" role="tab" aria-controls="introduce" aria-selected="false">معرفی دوستان</button>
                    </li>
                    <li class="nav-item" role="learn">
                        <button class="nav-link @if($scholarship->confirm_webinar)==1) bg-success @else  bg-danger  @endif" id="exam-tab" data-toggle="tab" data-target="#learn" type="button" role="tab" aria-controls="learn" aria-selected="false">آموزش</button>
                    </li>
                    <li class="nav-item" role="exam">
                        <button class="nav-link @if(count($scholarship->user->get_scholarshipexam)==0) bg-warning @elseif($scholarship->confirm_exam==1) bg-success @elseif($scholarship->confirm_exam==0) bg-danger @endif" id="exam-tab" data-toggle="tab" data-target="#exam" type="button" role="tab" aria-controls="exam" aria-selected="false">آزمون</button>
                    </li>
                    <li class="nav-item" role="introductionLetter">
                        <button class="nav-link @if(!is_null($scholarship->introductionletter)) bg-success @endif " id="introductionLetter-tab" data-toggle="tab" data-target="#introductionLetter" type="button" role="tab" aria-controls="introductionLetter" aria-selected="false">معرفی نامه</button>
                    </li>
                    <li class="nav-item" role="interview">
                        <button class="nav-link disabled" id="interview-tab" data-toggle="tab" data-target="#interview" type="button" role="tab" aria-controls="interview" aria-selected="false">مصاحبه</button>
                    </li>

                    <li class="nav-item" role="result">
                        <button class="nav-link disabled" id="result-tab" data-toggle="tab" data-target="#result" type="button" role="tab" aria-controls="result" aria-selected="false">نتیجه</button>
                    </li>
                </ul>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        <div class="card">
                            <div class="card-body shadow shadow-sm">
                                <form method="post" action="/admin/scholarship/{{$scholarship->id}}/changestatus">
                                    {{csrf_field()}}
                                    <div class="card card-user">
                                        <div class="card-header bg-light">
                                            <a class="row border-bottom" type="button" data-toggle="collapse" data-target="#infoScholarship" aria-expanded="false" aria-controls="infoScholarship">
                                                <div class="col-md-8">
                                                    <h6 class="card-title m-0">اطلاعات بورسیه</h6>
                                                </div>
                                                <div class="col-md-4 text-right">
                                                    <svg  xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-text-fill" viewBox="0 0 16 16">
                                                        <path d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM5 4h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1zm-.5 2.5A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zM5 8h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1zm0 2h3a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1z"/>
                                                    </svg>
                                                </div>
                                            </a>
                                        </div>

                                        <div class="card-body collapse bg-secondary-light border-1 border-secondary show" id="infoScholarship">
                                            <div class="form-group row">
                                                <label for="target" class="col-md-4 col-form-label text-md-right">
                                                    <input type="checkbox" name="confirm_target"  value="1" >
                                                    هدف شما از شرکت در دوره آموزش کوچینگ: </label>
                                                <div class="col-md-6">
                                                    <div class="input-group">

                                                        <select id="target" class="form-control p-0 " name="target" disabled multiple>
                                                            @foreach(explode(',',$scholarship->target) as $item_target)
                                                                @switch($item_target)
                                                                    @case (1)<option >برای توسعه مهارت فردی در زندگی و کسب و کار (اثرگذار باشم)</option>
                                                                                @break
                                                                    @case(2)<option >میخواهم کوچ حرفه ای شوم (بعنوان شغل دوم و یا اصلی)</option>
                                                                                @break
                                                                    @case(3)<option >در شغل و کسب و کار خودم از این مهارت استفاده کنم</option>
                                                                                @break
                                                                    @case(4)<option >مایلم بعد از گذراندن دوره آموزشی با موسسه همکاری کنم</option>
                                                                                @break
                                                                @endswitch
                                                            @endforeach


                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">

                                                <label for="types" class="col-md-4 col-form-label text-md-right">
                                                    <input type="checkbox" name="confirm_types" value="1" >
                                                    به  کدام  حوزه اصلی کوچینگ علاقمندید:
                                                </label>
                                                <div class="col-md-6">
                                                    @foreach($scholarship->types as $item)
                                                        @switch($item)
                                                            @case('1')
                                                            لایف کوچینگ
                                                            @break
                                                            @case('2')
                                                            بیزنس کوچینگ
                                                            @break
                                                        @endswitch
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="form-group row">

                                                <label for="gettingknow" class="col-md-4 col-form-label text-md-right">
                                                    <input type="checkbox" name="confirm_gettingknow"  value="1" >
                                                    میزان آشنایی شما با کوچینگ: </label>

                                                <div class="col-md-6">
                                                    <div class="input-group">
                                                        <select id="gettingknow" class="form-control p-0  " name="gettingknow" disabled>
                                                            <option selected disabled>انتخاب کنید</option>
                                                            <option {{ $scholarship->gettingknow==1 ? 'selected='.'"'.'selected'.'"' : '' }} >اطلاعات کامل دارم </option>
                                                            <option {{ $scholarship->gettingknow==2 ? 'selected='.'"'.'selected'.'"' : '' }} >آگاهی محتصری دارم</option>
                                                            <option {{ $scholarship->gettingknow==3 ? 'selected='.'"'.'selected'.'"' : '' }} >آشنایی ندارم</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="types" class="col-md-4 col-form-label text-md-right">
                                                    <input type="checkbox" name="confirm_applicant" value="1">
                                                    متقاضی کدام سطح اموزش هستید: </label>
                                                <div class="col-md-6">

                                                    @switch($scholarship->applicant)
                                                        @case('1')
                                                        سطح 1
                                                        @break
                                                        @case('2')
                                                        سطح 2
                                                        @break
                                                    @endswitch

                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="cooperation" class="col-md-4 col-form-label text-md-right">
                                                    <input type="checkbox" name="confirm_cooperation" value="1" >
                                                    چه علاقمندی و یا توانمندی ویژه ای جهت همکاری با آکادمی فراکوچ دارید ؟ (حین و بعد از اتمام دوره آموزشی)</label>

                                                <div class="col-md-6">
                                                    <textarea class="form-control" id="cooperation" name="cooperation" rows="3" disabled >{{$scholarship->cooperation}}</textarea>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="resume" class="col-md-4 col-form-label text-md-right">
                                                    <input type="checkbox" name="confirm_resume" value="1">
                                                    رزومه  خورد را بارگزاری نمایید: <span class="text-danger">*</span></label>
                                                <div class="col-md-6">
                                                    <a href="{{asset('/documents/scholarship/'.$scholarship->resume)}}">رزومه</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="status">وضعیت</label>
                                        <select class="form-control" id="status" name="status">
                                            <option selected disabled>انتخاب کنید</option>
                                            <option value="1" @if($scholarship->status==1) selected @endif>قبول درخواست</option>
                                            <option value="2" @if($scholarship->status==2) selected @endif>رد درخواست</option>
                                            <option value="3" @if($scholarship->status==3) selected @endif>در حال بررسی</option>
                                            <option value="4" @if($scholarship->status==4) selected @endif>اصلاح درخواست</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="comment">توضیحات:</label>
                                        <textarea class="form-control" id="comment" rows="3" name="comment"></textarea>
                                    </div>
                                    <input type="submit" value="ارسال" class="btn btn-success" />
                                </form>

                                @foreach($messages as $item)
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">{{$item->date_fa.' '.$item->time_fa}}</label>
                                        <textarea class="form-control"  rows="3" disabled>{{$item->comment}}</textarea>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                        <button class="btn btn-primary" id="contact-tab2" onclick="document.getElementById('contact-tab').click()">مرحله بعد</button>


                    </div>
                    <div class="tab-pane fade show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <ul class="nav nav-pills nav-fill">
                            <li class="nav-item">
                                <a class="nav-link active @if(strlen($scholarship->user->fname)>0 && strlen($scholarship->user->lname)>0 && strlen($scholarship->user->sex)>0&&strlen($scholarship->user->codemelli)>0&&strlen($scholarship->user->shenasname)>0&&strlen($scholarship->user->datebirth)>0&&strlen($scholarship->user->personal_image)>0) btn-success  @else btn-danger @endif" id="nav-infoUser-tab" data-toggle="tab" data-target="#nav-infoUser" type="button" role="tab" aria-controls="nav-home" aria-selected="true">اطلاعات شخصی</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if(strlen($scholarship->user->tel)>0 && strlen($scholarship->user->email)>0 && strlen($scholarship->user->state)>0&&strlen($scholarship->user->city)>0&&strlen($scholarship->user->address)>0) btn-success  @else btn-danger @endif " id="nav-infoTelUser-tab" data-toggle="tab" data-target="#nav-infoTelUser" type="button" role="tab" aria-controls="nav-infoTelUser" aria-selected="false">اطلاعات تماس</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if(strlen($scholarship->user->father)>0 && strlen($scholarship->user->married)>0 && strlen($scholarship->user->born)>0&&strlen($scholarship->user->education)>0&&strlen($scholarship->user->reshteh)>0&&strlen($scholarship->user->job)>0&&strlen($scholarship->user->resume)>0) btn-success  @else btn-danger @endif" id="nav-contract-tab" data-toggle="tab" data-target="#nav-contract" type="button" role="tab" aria-controls="nav-contract" aria-selected="false">اطلاعات قرارداد</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="nav-introduce-tab" data-toggle="tab" data-target="#nav-introduce" type="button" role="tab" aria-controls="nav-introduce" aria-selected="false">اطلاعات آشنایی</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-infoUser" role="tabpanel" aria-labelledby="nav-infoUser-tab">
                                <form method="post" action="/admin/profile/update/{{$scholarship->user->id}}" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    {{method_field('PATCH')}}
                                    <div class="col-12 col-md-6">
                                        <div class="card card-user">
                                            <div class="card-header bg-light">
                                                <a type="button" class="row border-bottom" data-toggle="collapse" data-target="#infoProfile" aria-expanded="false" aria-controls="infoProfile">
                                                    <div class="col-md-8">
                                                        <h6 class="card-title m-0">اطلاعات شخصی</h6>
                                                    </div>

                                                    <div class="col-md-4  text-right">
                                                        <svg class=" @if((strlen($scholarship->user->fname)>0)&&(strlen($scholarship->user->lname)>0)&&(strlen($scholarship->user->codemelli)>0)&&(strlen($scholarship->user->shenasname)>0)&& (strlen($scholarship->user->personal_image)>0)&& (strlen($scholarship->user->datebirth)>0)&&(strlen($scholarship->user->sex)>0)) text-muted @else  text-danger  @endif" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                                                            <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z"/>
                                                        </svg>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="card-body bg-secondary-light border-1 border-secondary" id="infoProfile">
                                                <div class="row">
                                                    <div class="col-md-6 px-1">
                                                        <div class="form-group">
                                                            <label>
                                                                نام:
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="text" class="form-control @if(!strlen($scholarship->user->fname)==0)  is-valid  @endif" placeholder="نام را وارد کنید"  value='{{old('fname',$scholarship->user->fname)}}'  name="fname" required  />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 px-1">
                                                        <div class="form-group">
                                                            <label>نام خانوادگی:
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="text" class="form-control @if(!strlen($scholarship->user->lname)==0) is-valid  @endif" placeholder="نام خانوادگی را وارد کنید" value='{{old('lname',$scholarship->user->lname)}}'  name="lname"  required />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 px-1">
                                                        <div class="form-group">
                                                            <label for="exampleFormControlSelect1">جنسیت:
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <div class="form-group">
                                                                <select class="form-control p-0 @if(!strlen($scholarship->user->sex)==0) is-valid  @endif" id="exampleFormControlSelect1" name="sex" required >
                                                                    <option selected disabled>انتخاب کنید</option>
                                                                    <option value="0"  {{ old('sex',$scholarship->user->sex)=="0" ? 'selected='.'"'.'selected'.'"' : '' }}  >زن</option>
                                                                    <option value="1"  {{ old('sex',$scholarship->user->sex)=="1" ? 'selected='.'"'.'selected'.'"' : '' }}>مرد</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 px-1">
                                                        <div class="form-group">
                                                            <label for="codemelli">کد ملی:
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="text" class="form-control @if(!strlen($scholarship->user->codemelli)==0)  is-valid  @endif" placeholder="کد ملی را وارد کنید" value='{{old('codemelli',$scholarship->user->codemelli)}}'  id="codemelli" name="codemelli" {{strlen($scholarship->user->codemelli)===0?"": "disabled" }} required />
                                                            <small class="text-muted">به عنوان مثال:0941234567</small>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 px-1">
                                                        <div class="form-group">
                                                            <label>شماره شناسنامه:
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="number" class="form-control @if(!strlen($scholarship->user->shenasname)==0) is-valid  @endif" placeholder="شماره شناسنامه را وارد کنید"  value='{{old('shenasname',$scholarship->user->shenasname)}}' name="shenasname" required  />
                                                            <small class="text-muted">به عنوان مثال:1234</small>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 px-1">
                                                        <div class="form-group">
                                                            <label>تاریخ تولد:
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="text" class="form-control @if(!strlen($scholarship->user->datebirth)==0)  is-valid  @endif" placeholder="تاریخ تولد را وارد کنید" value='{{old('datebirth',$scholarship->user->datebirth)}}' name="datebirth" id="datebirth" required />
                                                            <small class="text-muted">به عنوان مثال:1365/01/01</small>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 px-1">
                                                        <div class="form-group">
                                                            <label>عکس پروفایل
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input @if(!strlen($scholarship->user->personal_image)==0) is-valid  @endif" id="inputpersonal_image" name="personal_image"/>
                                                                <label class="custom-file-label" for="inputpersonal_image">انتخاب فایل</label>
                                                            </div>
                                                            <small class="text-muted">فرمت فایل:jpg , jpeg , png  -;حجم حداکثر 600 کیلوبایت</small>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 px-1">
                                                        <div class="form-group">
                                                            <label>نام کاربری:</label>
                                                            <input type="text" class="form-control @if(!strlen($scholarship->user->username)==0) is-valid  @endif" placeholder="نام کاربری خود را وارد کنید" value='{{old('username',$scholarship->user->username)}}' name="username" @if(strlen($scholarship->user->username)>0) disabled @endif required  />
                                                            <small class="text-muted">به عنوان مثال: hesamaghaei</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-1 ">
                                        <div class="update m-auto m-auto">
                                            <button type="submit" class="btn btn-primary btn-round" id="update_profile">بروزرسانی اطلاعات</button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                            <div class="tab-pane fade" id="nav-infoTelUser" role="tabpanel" aria-labelledby="nav-infoTelUser-tab">
                                <form method="post" action="/admin/profile/update/{{$scholarship->user->id}}" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    {{method_field('PATCH')}}
                                    <div class="col-12 col-md-6">
                                        <div class="card card-user ">
                                            <div class="card-header bg-light">
                                                <a type="button" class="row  border-bottom" data-toggle="collapse" data-target="#infoContact" aria-expanded="false" aria-controls="infoContact">
                                                    <div class="col-md-8">
                                                        <h6 class="card-title m-0">اطلاعات تماس</h6>
                                                    </div>
                                                    <div class="col-md-4 text-right">
                                                        <svg class="@if((strlen($scholarship->user->tel)>0)&&(strlen($scholarship->user->email)>0)&&(strlen($scholarship->user->state)>0)&&(strlen($scholarship->user->city)>0)&& (strlen($scholarship->user->address)>0)) text-muted @else  text-danger  @endif" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
                                                        </svg>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="card-body bg-secondary-light border-1 border-secondary" id="infoContact">
                                                <div class="row">
                                                    <div class="col-md-6 px-1">
                                                        <div class="form-group">
                                                            <label>تلفن تماس:
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="hidden" id="tel_org" value="{{old('tel',$scholarship->user->tel)}}" name="tel"/>
                                                            <input type="tel" class="form-control @if(strlen($scholarship->user->tel)==0) is-invalid  @else is-valid  @endif" placeholder="تلفن تماس را وارد کنید" value='{{old('tel',$scholarship->user->tel)}}'  id="tel"  @if(strlen($scholarship->user->tel)>0 ) disabled  @endif  />
                                                            <small class="text-muted">به عنوان مثال:09151234567</small>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 pr-1">
                                                        <div class="form-group">
                                                            <label for="email">پست الکترونیکی:
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="email" class="form-control @if(strlen($scholarship->user->email)==0) is-invalid  @else is-valid  @endif" placeholder="پست الکترونیکی را وارد کنید" value='{{old('email',$scholarship->user->email)}}' name="email"  id="email"  @if(strlen($scholarship->user->email)>0) disabled  @endif  required />
                                                            <small class="text-muted">به عنوان مثال:faracoach@gmail.com</small>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 pl-1">
                                                        <div class="form-group">
                                                            <label>استان:
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <select class="custom-select @if(strlen($scholarship->user->state)==0)   @else is-valid  @endif"  name="state"  id="state" required>
                                                                <option selected disabled>استان را انتخاب کنید</option>
                                                                @foreach($states as $item)
                                                                    <option value="{{$item->id}}"   {{ old('state',$scholarship->user->state)==$item->id ? 'selected='.'"'.'selected'.'"' : '' }} >{{$item->name}}</option>
                                                                @endforeach
                                                            </select>
                                                            <small class="text-muted">به عنوان مثال:خراسان رضوی</small>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 px-1">
                                                        <div class="form-group">
                                                            <label>شهر:
                                                                <span class="text-danger">*</span>
                                                            </label>

                                                            <select class="custom-select @if(strlen($scholarship->user->city)==0)   @else is-valid  @endif"  name="city"  id="city" required>
                                                                @foreach($cities as $item_city)
                                                                    <option value="{{$item_city->id}}" @if(!is_null($scholarship->user->city) && ($scholarship->user->city==$item_city->id)) selected  @endif >  {{$item_city->name}} </option>
                                                                @endforeach


                                                                @if (!is_null($city))
                                                                    <option value="{{$scholarship->user->city}}">@if(!is_null($city))  {{$city->name}}  @endif </option>
                                                                @endif
                                                            </select>
                                                            <small class="text-muted">به عنوان مثال: مشهد</small>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 px-1">
                                                        <div class="form-group">
                                                            <label>آدرس:
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="text" class="form-control @if(strlen($scholarship->user->address)==0) is-invalid  @else is-valid  @endif" placeholder="آدرس را وارد کنید"  value='{{old('address',$scholarship->user->address)}}' name="address"  required />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 px-1">
                                                        <div class="form-group">
                                                            <label>اینستاگرام:</label>
                                                            <input type="text" class="form-control @if(strlen($scholarship->user->instagram)==0) is-invalid  @else is-valid  @endif" placeholder="صفحه اینستاگرام خود را وارد کنید"  value='{{old('instagram',$scholarship->user->instagram)}}' name="instagram" required  />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 px-1">
                                                        <div class="form-group">
                                                            <label>تلگرام:</label>
                                                            <input type="text" class="form-control @if(strlen($scholarship->user->telegram)==0) is-invalid  @else is-valid  @endif" placeholder="آیدی تلگرام خود را وارد کنید" value='{{old('telegram',$scholarship->user->telegram)}}' name="telegram" required />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 px-1">
                                                        <div class="form-group">
                                                            <label>لینکدین:

                                                            </label>
                                                            <input type="text" class="form-control @if(strlen($scholarship->user->linkedin)==0) is-invalid  @else is-valid  @endif" placeholder="آیدی لینکدین خود را وارد کنید"  value='{{old('linkedin',$scholarship->user->linkedin)}}' name="linkedin"  />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-1 ">
                                        <div class="update m-auto m-auto">
                                            <button type="submit" class="btn btn-primary btn-round" id="update_profile">بروزرسانی اطلاعات</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="nav-contract" role="tabpanel" aria-labelledby="nav-contract-tab">
                                <form method="post" action="/admin/profile/update/{{$scholarship->user->id}}" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    {{method_field('PATCH')}}
                                    <div class="col-12 col-md-6">
                                        <div class="card card-user">
                                            <div class="card-header bg-light">
                                                <a class="row border-bottom" type="button" data-toggle="collapse" data-target="#infoConstract" aria-expanded="false" aria-controls="infoConstract">
                                                    <div class="col-md-8">
                                                        <h6 class="card-title m-0">اطلاعات قرارداد</h6>
                                                    </div>
                                                    <div class="col-md-4 text-right">
                                                        <svg class="@if((strlen($scholarship->user->father)>0)&&(strlen($scholarship->user->married)>0)&&(strlen($scholarship->user->born)>0)&& (strlen($scholarship->user->education)>0)&& (strlen($scholarship->user->reshteh)>0)&& (strlen($scholarship->user->shenasnameh_image)>0)&& (strlen($scholarship->user->cartmelli_image)>0)&& (strlen($scholarship->user->education_image)>0)&& (strlen($scholarship->user->job)>0)) text-muted @else  text-danger  @endif" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-text-fill" viewBox="0 0 16 16">
                                                            <path d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM5 4h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1zm-.5 2.5A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zM5 8h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1zm0 2h3a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1z"/>
                                                        </svg>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="card-body bg-secondary-light border-1 border-secondary" id="infoConstract">
                                                <div class="row">
                                                    <div class="col-md-6 px-1">
                                                        <div class="form-group">
                                                            <label>نام پدر:
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="text" class="form-control @if(strlen($scholarship->user->father)==0) is-invalid  @else is-valid  @endif" placeholder=" نام پدر را وارد کنید"  value='{{old('father',$scholarship->user->father)}}'  name="father" required />
                                                            <small class="text-muted">به عنوان مثال: علی</small>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 px-1">
                                                        <div class="form-group">
                                                            <label>تاهل:
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <div class="form-group">
                                                                <select class="form-control p-0 @if(strlen($scholarship->user->married)==0) is-invalid  @else is-valid  @endif" id="exampleFormControlSelect1" name="married" required >
                                                                    <option selected disabled>انتخاب کنید</option>
                                                                    <option value="0" {{ old('married',$scholarship->user->married)=="0" ? 'selected='.'"'.'selected'.'"' : '' }} >مجرد</option>
                                                                    <option value="1" {{ old('married',$scholarship->user->married)=="1" ? 'selected='.'"'.'selected'.'"' : '' }} >متاهل</option>
                                                                </select>
                                                                <small class="text-muted">به عنوان مثال: مجرد</small>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 pl-1">
                                                        <div class="form-group">
                                                            <label>شهر تولد:
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="text" class="form-control @if(strlen($scholarship->user->born)==0) is-invalid  @else is-valid  @endif" placeholder="شهر تولد را وارد کنید"  value='{{old('born',$scholarship->user->born)}}' name="born" required />
                                                            <small class="text-muted">به عنوان مثال: مشهد</small>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 px-1">
                                                        <div class="form-group">
                                                            <label>تحصیلات:
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <select id="education" class="form-control p-0 @if(strlen($scholarship->user->education)==0) is-invalid  @else is-valid  @endif  @error('education') is-invalid @enderror" name="education" required >
                                                                <option selected disabled>انتخاب کنید</option>
                                                                <option {{ old('education',$scholarship->user->education)=="زیردیپلم" ? 'selected='.'"'.'selected'.'"' : '' }}   >زیردیپلم</option>
                                                                <option {{ old('education',$scholarship->user->education)=="دیپلم" ? 'selected='.'"'.'selected'.'"' : '' }}>دیپلم</option>
                                                                <option {{ old('education',$scholarship->user->education)=="فوق دیپلم" ? 'selected='.'"'.'selected'.'"' : '' }}>فوق دیپلم</option>
                                                                <option {{ old('education',$scholarship->user->education)=="لیسانس" ? 'selected='.'"'.'selected'.'"' : '' }}>لیسانس</option>
                                                                <option {{ old('education',$scholarship->user->education)=="فوق لیسانس" ? 'selected='.'"'.'selected'.'"' : '' }}>فوق لیسانس</option>
                                                                <option {{ old('education',$scholarship->user->education)=="دکتری و بالاتر" ? 'selected='.'"'.'selected'.'"' : '' }}>دکتری و بالاتر</option>
                                                            </select>
                                                            <small class="text-muted">به عنوان مثال: لیسانس</small>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 pr-1">
                                                        <div class="form-group">
                                                            <label>رشته:
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control @if(strlen($scholarship->user->reshteh)==0) is-invalid  @else is-valid  @endif" placeholder="رشته را وارد کنید" value='{{old('reshteh',$scholarship->user->reshteh)}}'  name="reshteh" required />
                                                                <small class="text-muted">به عنوان مثال: روانشناسی</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 pr-1">
                                                        <div class="form-group">
                                                            <label>شغل:
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control @if(strlen($scholarship->user->job)==0) is-invalid  @else is-valid  @endif" placeholder="شغل را وارد کنید" value='{{old('job',$scholarship->user->job)}}'  name="job" required />
                                                                <small class="text-muted">به عنوان مثال: مشاور</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6 px-1">
                                                        <div class="form-group">
                                                            <label>عکس شناسنامه:</label>
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input @if(strlen($scholarship->user->shenasnameh_image)==0) is-invalid  @else is-valid  @endif" id="inputshenasnameh_image" aria-describedby="inputshenasnameh_image" name="shenasnameh_image" @if(strlen($scholarship->user->shenasnameh_image)==0) required @endif />
                                                                <label class="custom-file-label" for="inputshenasnameh_image">Choose file</label>
                                                            </div>
                                                            <small class="text-muted">فرمت فایل:jpg , jpeg , png  -;حجم حداکثر 600 کیلوبایت</small>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 px-1">
                                                        <div class="form-group">
                                                            <label>عکس کارت ملی: </label>
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input @if(strlen($scholarship->user->cartmelli_image)==0) is-invalid  @else is-valid  @endif" id="inputcartmelli_image" aria-describedby="inputcartmelli_image" name="cartmelli_image"  @if(strlen($scholarship->user->cartmelli_image)==0) required @endif />
                                                                <label class="custom-file-label" for="inputcartmelli_image">Choose file</label>
                                                            </div>
                                                            <small class="text-muted">فرمت فایل:jpg , jpeg , png  -;حجم حداکثر 600 کیلوبایت</small>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 px-1">
                                                        <div class="form-group">
                                                            <label>عکس مدرک تحصیلی:</label>
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input @if(strlen($scholarship->user->education_image)==0) is-invalid  @else is-valid  @endif" id="inputeducation_image" aria-describedby="inputeducation_image" name="education_image" @if(strlen($scholarship->user->education_image)==0) required @endif />
                                                                <label class="custom-file-label" for="inputeducation_image">Choose file</label>
                                                            </div>
                                                            <small class="text-muted">فرمت فایل:jpg , jpeg , png  -;حجم حداکثر 600 کیلوبایت</small>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 px-1">
                                                        <div class="form-group">
                                                            <label>رزومه:
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input @if(strlen($scholarship->user->resume)==0) is-invalid  @else is-valid  @endif " id="resume" aria-describedby="resume" name="resume" @if(strlen($scholarship->user->resume)==0) required @endif/>
                                                                <label class="custom-file-label" for="resume">Choose file</label>
                                                            </div>
                                                            <small class="text-muted">فرمت فایل:jpg , jpeg , PDF , DOC  -;حجم حداکثر 600 کیلوبایت</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-1 ">
                                        <div class="update m-auto m-auto">
                                            <button type="submit" class="btn btn-primary btn-round" id="update_profile">بروزرسانی اطلاعات</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="nav-introduce" role="tabpanel" aria-labelledby="nav-introduce-tab">
                                <form method="post" action="/panel/profile/update/{{$scholarship->user->id}}" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    {{method_field('PATCH')}}
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="card card-user ">
                                                <div class="card-header bg-light">
                                                    <a class="row border-bottom" type="button" data-toggle="collapse" data-target="#infogettingKnow" aria-expanded="false" aria-controls="infogettingKnow">
                                                        <div class="col-8">
                                                            <h6 class="card-title m-0">آشنایی</h6>
                                                        </div>
                                                        <div class="col-4 text-right">
                                                            <svg class="@if((strlen($scholarship->user->gettingknow)>0)&&(strlen($scholarship->user->introduced)>0)&&(strlen($scholarship->user->resource)>0)&&(strlen($scholarship->user->detailsresource)>0)) text-muted @else  text-danger  @endif" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-person" viewBox="0 0 16 16">
                                                                <path d="M12 1a1 1 0 0 1 1 1v10.755S12 11 8 11s-5 1.755-5 1.755V2a1 1 0 0 1 1-1h8zM4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4z"/>
                                                                <path d="M8 10a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                                            </svg>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="card-body bg-secondary-light border-1 border-secondary " id="infogettingKnow">
                                                    <div class="row">
                                                        <div class="col-md-6 px-1">
                                                            <div class="form-group">
                                                                <label>نحوه آشنایی:
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <select id="gettingknow_parent" class="form-control p-0 @if(strlen($scholarship->user->gettingknow)==0) is-invalid  @else is-valid  @endif  @error('gettingknow') is-invalid @enderror" name="gettingKnow_parent" required >
                                                                    <option selected disabled>انتخاب کنید</option>
                                                                    @foreach($gettingKnow_parent_list as $item)
                                                                        <option value="{{$item->id}}"  {{ old('gettingKnow_parent',$scholarship->user->gettingknow_parent_user)==$item->id ? 'selected='.'"'.'selected'.'"' : '' }} >{{$item->category}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>


                                                        @if(!is_null($scholarship->user->gettingknow))
                                                            <div class="col-md-6 px-1" id="gettingknow2" >
                                                                <div class="form-group">
                                                                    <label>عنوان آشنایی:
                                                                        <span class="text-danger">*</span>
                                                                    </label>
                                                                    <select id="gettingknow_profile" class="form-control p-0 @if(strlen($scholarship->user->gettingknow)==0) is-invalid  @else is-valid  @endif  @error('gettingknow') is-invalid @enderror" name="gettingknow" required  >
                                                                        <option selected disabled>انتخاب کنید</option>
                                                                        @foreach($gettingKnow_child_list as $item)
                                                                            <option value="{{$item->id}}"  {{ old('gettingknow',$scholarship->user->gettingknow)==$item->id ? 'selected='.'"'.'selected'.'"' : '' }}   >{{$item->category}}</option>
                                                                        @endforeach
                                                                    </select>

                                                                </div>
                                                            </div>
                                                        @else
                                                            <div class="col-md-6 px-1" id="gettingknow2">
                                                                <div class="form-group">
                                                                    <label>عنوان آشنایی</label>
                                                                    <select id="gettingknow" class="form-control p-0 @if(strlen($scholarship->user->gettingknow)==0) is-invalid  @else is-valid  @endif  @error('gettingknow') is-invalid @enderror" name="gettingknow" required>
                                                                        <option selected disabled>انتخاب کنید</option>

                                                                    </select>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        <div class="col-md-6 px-1">
                                                            <div class="form-group">
                                                                <label>معرف</label>
                                                                <input type="hidden" class="form-control"  @if(!is_null($scholarship->user->getIntroduced))  value="{{$scholarship->user->getIntroduced->fname.' '.$scholarship->user->getIntroduced->lname }}" @endif  id="introduced" />
                                                                <input dir="ltr"  type="text" class="form-control @if(strlen($scholarship->user->introduced)==0) is-invalid  @else is-valid  @endif"  @if(!is_null($scholarship->user->getIntroduced)) disabled value="{{$scholarship->user->getIntroduced->fname.' '.$scholarship->user->getIntroduced->lname }}" @endif  id="introduced_profile" />
                                                                <span id="feedback_introduced" ></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="update m-auto m-auto">
                                            <button type="submit" class="btn btn-primary btn-round" id="update_profile">بروزرسانی اطلاعات</button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade show" id="introduce" role="tabpanel" aria-labelledby="introduce-tab">
                        <table class="table text-center mt-1">
                            <tr>
                                <td>ردیف</td>
                                <td></td>
                                <td>نام و نام خانوادگی</td>
                                <td>تلفن</td>
                                <td>آخرین ورود</td>
                                <td>امتیاز بورسیه</td>
                                <td>امتیاز شما</td>

                            </tr>
                            @foreach($scholarship->user->get_invitations->where('resource','=','بورسیه تحصیلی') as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>
                                        @if(is_null($item->personal_image))
                                            <img class="rounded" src="{{asset('/documents/users/default-avatar.png')}}" width="50px" height="50px" />
                                        @else
                                            <img class="rounded" src="{{asset('/documnts/users/'.$item->personal_image)}}" width="50px" height="50px" />
                                        @endif
                                    </td>
                                    <td>{{$item->fname.' '.$item->lname }}</td>
                                    <td dir="ltr">{{$item->tel}}</td>
                                    <td dir="ltr">-</td>
                                    <td dir="ltr">-</td>
                                </tr>
                            @endforeach
                            @for($i=(count($scholarship->user->get_invitations->where('resource','=','بورسیه تحصیلی'))+1);$i<=5;$i++)
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>
                                        <img class="rounded" src="{{asset('/documents/users/default-avatar.png')}}" width="50px" height="50px" />
                                    </td>
                                    <td></td>
                                    <td dir="ltr"></td>
                                    <td dir="ltr">-</td>
                                    <td dir="ltr">-</td>
                                </tr>
                            @endfor
                        </table>
                    </div>
                    <div class="tab-pane fade " id="learn" role="tabpanel" aria-labelledby="learn-tab">
                        @if($scholarship->confirm_webinar==1)
                            <div class="alert alert-success">
                                کد شرکت در وبینار به درستی وارد شده است
                            </div>
                        @elseif($scholarship->user->get_recieveCodeUsers->count()>=3)
                             <div class="alert alert-danger">
                                 کاربر تعداد مجاز برای وارد کردن کد را انجام داده است
                             </div>
                        @else
                             <div class="alert alert-warning">
                                 تعداد دفعات ورود کد {{$scholarship->user->get_recieveCodeUsers->count()}}  بار می باشد
                             </div>
                        @endif
                    </div>
                    <div class="tab-pane fade" id="exam" role="tabpanel" aria-labelledby="exam-tab">

                        @if(count($scholarship->user->get_scholarshipexam)==0)
                            <div class="alert alert-warning">در آزمون شرکت نکرده است</div>
                        @elseif($scholarship->user->get_scholarshipexam->last()->score>50)

                            <div class="alert alert-success">
                                در آزمون با نتیجه {{$scholarship->user->get_scholarshipexam->last()->score}} قبول شده است
                            </div>
                        @elseif($scholarship->user->get_scholarshipexam->last()->score<50)
                            @foreach($scholarship->user->get_scholarshipExam as $item)
                                <div class="alert alert-warning">آزمون {{$loop->iteration}} نمره =  {{$item->score}}</div>
                            @endforeach
                        @endif

                    </div>
                    <div class="tab-pane fade " id="introductionLetter" role="tabpanel" aria-labelledby="introductionLetter-tab">
                        @if(is_null($scholarship->introductionletter))
                            <div class="alert alert-warning">
                                کاربر معرفی نامه ارسال نکرده است
                            </div>
                        @else
                            <div class="alert alert-success">
                                کاربر معرفی نامه ارسال کرده است
                                <a href="{{'/documents/scholarship/'.$scholarship->introductionletter}}" class="btn btn-primary">دانلود</a>
                            </div>

                        @endif
                    </div>

                </div>

            </div>
        </div>
    </div>


@endsection
