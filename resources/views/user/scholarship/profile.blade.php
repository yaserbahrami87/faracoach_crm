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
                <button class="nav-link active @if(strlen($scholarship->user->fname)>0 ||strlen($scholarship->user->lname)>0||strlen($scholarship->user->sex)>0||strlen($scholarship->user->codemelli)>0||strlen($scholarship->user->lname)>0||strlen($scholarship->user->shenasname)>0||strlen($scholarship->user->datebirth)>0||strlen($scholarship->user->personal_image)>0) btn-danger @endif" id="home-tab" data-toggle="tab" data-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">توضیحات</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link " id="contact-tab" data-toggle="tab" data-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">اطلاعات بورسیه</button>
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
                <button class="nav-link" id="exam-tab" data-toggle="tab" data-target="#exam" type="button" role="tab" aria-controls="exam" aria-selected="false">آزمون</button>
            </li>
            <li class="nav-item" role="introductionLetter">
                <button class="nav-link disabled" id="introductionLetter-tab" data-toggle="tab" data-target="#introductionLetter" type="button" role="tab" aria-controls="introductionLetter" aria-selected="false">معرفی نامه</button>
            </li>
            <li class="nav-item" role="interview">
                <button class="nav-link disabled" id="interview-tab" data-toggle="tab" data-target="#interview" type="button" role="tab" aria-controls="interview" aria-selected="false">مصاحبه</button>
            </li>

            <li class="nav-item" role="result">
                <button class="nav-link disabled" id="result-tab" data-toggle="tab" data-target="#result" type="button" role="tab" aria-controls="result" aria-selected="false">نتیجه</button>
            </li>
            <li class="nav-item" role="rante">
                <button class="nav-link disabled" id="result-tab" data-toggle="tab" data-target="#rante" type="button" role="tab" aria-controls="rante" aria-selected="false">وام دانشجویی</button>
            </li>



        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <h3 class="d-block text-dark text-center" style="line-height: 2">طرح اعطای بورسیه کوچینگ آکادمی بین المللی فراکوچ</h3>
                <div class="card">
                    <div class="card-body shadow shadow-sm">
                        <p style="line-height: 2" class="text-center">شناسایی و دعوت از افراد نخبه و با استعداد جهت حضور ویژه</p>
                        <p style="line-height: 2;text-align: justify">آکادمی بین المللی فراکوچ فرصت بی نظیری را به منظور ورود و پیوستن جمع بیشتری از افراد مستعد ، نخبه و فرهیخته جامعه - به ویژه اساتید ،  پژوهشگران، اندیشمندان، مدیران و دانشجویان برتر - به دنیای حرفه ای کوچینگ از طریق ایجاد شرایط ویژه حضور آنان در دوره های آموزش و تربیت کوچ حرفه ای ، فراهم کرده است.</p>

                    </div>
                </div>
                <button class="btn btn-primary" id="contact-tab2" onclick="document.getElementById('contact-tab').click()">مرحله بعد</button>


            </div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                <form method="POST" action="/panel/scholarship/answerstatus" enctype="multipart/form-data">
                    {{csrf_field()}}

                    @if(count($messages)>0)
                        <input type="hidden" value="{{$messages[0]->user_id_send}}" name="user_id_send"/>
                    @endif



                    <div class="form-group row">
                        <label for="target" class="col-md-4 col-form-label text-md-right">هدف شما از شرکت در دوره آموزش کوچینگ: </label>
                        <div class="col-md-6">
                            <div class="input-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="target1" name="target[]" @if(in_array('1',$scholarship->target)) checked @endif @if(!$scholarship->confirm_target) disabled @endif/>
                                    <label class="form-check-label" for="target1">
                                        برای توسعه مهارت فردی در زندگی و کسب و کار (اثرگذار باشم)
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="2" id="target2" name="target[]" @if(in_array('2',$scholarship->target)) checked @endif @if(!$scholarship->confirm_target) disabled @endif />
                                    <label class="form-check-label" for="target2">
                                        میخواهم کوچ حرفه ای شوم (بعنوان شغل دوم و یا اصلی)
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="3" id="target3" name="target[]" @if(in_array('3',$scholarship->target)) checked @endif @if(!$scholarship->confirm_target) disabled @endif />
                                    <label class="form-check-label" for="target3">
                                        در شغل و کسب و کار خودم از این مهارت استفاده کنم
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="4" id="target4" name="target[]" @if(in_array('4',$scholarship->target)) checked @endif @if(!$scholarship->confirm_target) disabled @endif />
                                    <label class="form-check-label" for="target4">
                                        مایلم بعد از گذراندن دوره آموزشی با موسسه همکاری کنم
                                    </label>
                                </div>
                            <!--
                                                <select id="target" class="form-control p-0  @error('target') is-invalid @enderror" name="target[]" multiple>
                                                    <option selected disabled>انتخاب کنید</option>
                                                    <option {{ old('target')==1 ? 'selected='.'"'.'selected'.'"' : '' }} value="1" >برای توسعه مهارت فردی در زندگی و کسب و کار (اثرگذار باشم)</option>
                                                    <option {{ old('target')==2 ? 'selected='.'"'.'selected'.'"' : '' }} value="2">میخواهم کوچ حرفه ای شوم (بعنوان شغل دوم و یا اصلی)</option>
                                                    <option {{ old('target')==3 ? 'selected='.'"'.'selected'.'"' : '' }} value="3">در شغل و کسب و کار خودم از این مهارت استفاده کنم</option>
                                                    <option {{ old('target')==4 ? 'selected='.'"'.'selected'.'"' : '' }} value="4">مایلم بعد از گذراندن دوره آموزشی با موسسه همکاری کنم</option>
                                                </select>
                                                -->
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="types" class="col-md-4 col-form-label text-md-right">به  کدام  حوزه اصلی کوچینگ علاقمندید: </label>

                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="defaultCheck1" name="types[]" @if(in_array('1',$scholarship->types)) checked @endif  @if(!$scholarship->confirm_types) disabled @endif   />
                                <label class="form-check-label" for="defaultCheck1">
                                    لایف کوچینگ
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="2" id="defaultCheck2" name="types[]"  @if(in_array('2',$scholarship->target)) checked @endif  @if(!$scholarship->confirm_types) disabled @endif />
                                <label class="form-check-label" for="defaultCheck2">
                                    بیزنس کوچینگ
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="gettingknow" class="col-md-4 col-form-label text-md-right">میزان آشنایی شما با کوچینگ: </label>

                        <div class="col-md-6">
                            <div class="input-group">
                                <select id="gettingknow" class="form-control p-0" name="gettingknow" @if(!$scholarship->confirm_gettingknow) disabled @endif  >
                                    <option selected disabled>انتخاب کنید</option>
                                    <option {{ old('gettingknow',$scholarship->gettingknow)==1 ? 'selected='.'"'.'selected'.'"' : ''}} value="1"  >اطلاعات کامل دارم </option>
                                    <option {{ old('gettingknow',$scholarship->gettingknow)==2 ? 'selected='.'"'.'selected'.'"' : ''}} value="2">آگاهی مختصری دارم</option>
                                    <option {{ old('gettingknow',$scholarship->gettingknow)==3 ? 'selected='.'"'.'selected'.'"' : ''}} value="3">آشنایی ندارم</option>
                                </select>
                            </div>
                        </div>
                    </div>
                <!--
                                    <div class="form-group row">
                                        <label for="description" class="col-md-4 col-form-label text-md-right"> توضیح بیشتری درباره  ویژگیها و توانمندی و علاقمندی خود مرقوم بفرمایید: </label>
                                        <div class="col-md-6">
                                            <textarea class="form-control" id="description" rows="3" name="description"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="scientific" class="col-md-4 col-form-label text-md-right">سوابق علمی خود را مرقوم فرمایید: <span class="text-danger">*</span></label>

                                        <div class="col-md-6">
                                            <input id="scientific" type="text" class="form-control @error('scientific') is-invalid @enderror"  name="scientific"  required autocomplete="scientific" autofocus  />

                                            @error('scientific')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                    </div>
                </div>





-->
                    <div class="form-group row">
                        <label for="cooperation" class="col-md-4 col-form-label text-md-right"> چه علاقمندی  و یا  توانمندی  ویژه ای جهت  همکاری  با  آکادمی فراکوچ دارید ؟ (حین و بعد از اتمام دوره آموزشی):</label>

                        <div class="col-md-6">
                        <!-- <input id="cooperation" type="text" class="form-control @error('cooperation') is-invalid @enderror"  name="cooperation"  required autocomplete="cooperation" autofocus  /> -->
                            <textarea class="form-control" id="cooperation" rows="3" name="cooperation" @if(!$scholarship->confirm_cooperation) disabled @endif >{{old('cooperation',$scholarship->cooperation)}}</textarea>

                            @error('cooperation')
                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="applicant" class="col-md-4 col-form-label text-md-right">متقاضی کدام سطح اموزش هستید؟</label>

                        <div class="col-md-6" >
                            <div class="custom-control custom-radio custom-control-inline">

                                <input type="radio" id="gender1" name="applicant" class="custom-control-input"  value="1"  @if(old('applicant')==1) checked @endif  @if($scholarship->applicant==1) checked @endif  @if(!$scholarship->confirm_applicant) disabled @endif />
                                <label class="custom-control-label" for="gender1" >سطح 1</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="gender2" name="applicant" class="custom-control-input" value="2" @if(old('applicant')==2) checked @endif @if($scholarship->applicant==2) checked @endif @if(!$scholarship->confirm_applicant) disabled @endif />
                                <label class="custom-control-label" for="gender2" >سطح 2 (ویژه کوچها و دانشپذیران سطح1)</label>
                            </div>

                            @error('applicant')
                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="resume" class="col-md-4 col-form-label text-md-right">رزومه  خورد را بارگزاری نمایید: </label>
                        <div class="col-md-6">
                            @if($scholarship->confirm_resume)
                                <input type="file" class="form-control-file" id="exampleFormControlFile1" name="resume">
                            @else
                                <a href="{{asset('')}}">دانلود رزومه</a>
                            @endif
                            <small class="text-muted ">فایل های قابل قبول: PDF , JPG , JPEG , DOC , PNG</small>
                            <small class="text-muted d-block">حداکثر حجم فایل: 600 کیلوبایت</small>
                            @error('resume')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    </div>

                    @if(count($messages)>0)
                        <div class="form-group">
                            <label for="comment">توضیحات:</label>
                            <textarea class="form-control" id="comment" rows="3" name="comment"></textarea>
                        </div>

                        <input type="submit" value="ارسال" class="btn btn-success" />
                        @foreach($messages as $item)
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">{{$item->date_fa.' '.$item->time_fa}}</label>
                                <textarea class="form-control"  rows="3" disabled>{{$item->comment}}</textarea>
                            </div>
                        @endforeach
                    @endif
                </form>
                <button class="btn btn-primary" id="contact-tab2" onclick="document.getElementById('profile-tab').click()">مرحله بعد</button>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                @if((strlen(Auth::user()->fname)>0) && (strlen(Auth::user()->lname)>0) && (strlen(Auth::user()->username)>0) && (strlen(Auth::user()->email)>0) && (strlen(Auth::user()->datebirth)>0) && (strlen(Auth::user()->father)>0) && (strlen(Auth::user()->codemelli)>0) && (strlen(Auth::user()->sex)>0) && (strlen(Auth::user()->tel)>0) && (strlen(Auth::user()->shenasname)>0) && (strlen(Auth::user()->born)>0) && (strlen(Auth::user()->education)>0) && (strlen(Auth::user()->reshteh)>0) && (strlen(Auth::user()->job)>0) && (strlen(Auth::user()->state)>0) && (strlen(Auth::user()->city)>0) && (strlen(Auth::user()->address)>0) && (strlen(Auth::user()->personal_image)>0) && (strlen(Auth::user()->shenasnameh_image)>0) && (strlen(Auth::user()->cartmelli_image)>0) && (strlen(Auth::user()->education_image)>0) && (strlen(Auth::user()->resume)>0) && (strlen(Auth::user()->married)>0) && (strlen(Auth::user()->shenasnameh_image)>0))
                    <div class="alert alert-success">اطلاعات پروفایل شما کامل می باشد</div>
                @else
                    <div class="border border-1 p-1 shadow shadow-sm text-center mb-2">
                        <i class="bi bi-exclamation-triangle text-warning mr-1" ></i>
                        اطلاعات پروفایل شما کامل نمیباشد.
                        <!--
                        <a href="/panel/profile" class="btn btn-danger btn-lg ml-1">تکمیل پروفایل</a>
                        -->
                    </div>


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
                            <form method="post" action="/panel/profile/update/{{$scholarship->user->id}}" enctype="multipart/form-data">
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
                                                        <label>عکس پروفایل</label>
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input @if(!strlen($scholarship->user->personal_image)==0) is-valid  @endif" id="inputpersonal_image" name="personal_image"/>
                                                            <label class="custom-file-label" for="inputpersonal_image">انتخاب فایل</label>
                                                        </div>
                                                        <small class="text-muted">فرمت فایل:jpg , jpeg , png  -;حجم حداکثر 600 کیلوبایت</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 px-1">
                                                    <div class="form-group">
                                                        <label>نام کاربری:
                                                            <span class="text-danger">*</span>
                                                        </label>
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
                            <form method="post" action="/panel/profile/update/{{$scholarship->user->id}}" enctype="multipart/form-data">
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
                                                        <label>اینستاگرام:
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" class="form-control @if(strlen($scholarship->user->instagram)==0) is-invalid  @else is-valid  @endif" placeholder="صفحه اینستاگرام خود را وارد کنید"  value='{{old('instagram',$scholarship->user->instagram)}}' name="instagram" required  />
                                                    </div>
                                                </div>
                                                <div class="col-md-6 px-1">
                                                    <div class="form-group">
                                                        <label>تلگرام:
                                                            <span class="text-danger">*</span>
                                                        </label>
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
                            <form method="post" action="/panel/profile/update/{{$scholarship->user->id}}" enctype="multipart/form-data">
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
                                                        <label>عکس شناسنامه:
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input @if(strlen($scholarship->user->shenasnameh_image)==0) is-invalid  @else is-valid  @endif" id="inputshenasnameh_image" aria-describedby="inputshenasnameh_image" name="shenasnameh_image" @if(strlen($scholarship->user->shenasnameh_image)==0) required @endif />
                                                            <label class="custom-file-label" for="inputshenasnameh_image">Choose file</label>
                                                        </div>
                                                        <small class="text-muted">فرمت فایل:jpg , jpeg , png  -;حجم حداکثر 600 کیلوبایت</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 px-1">
                                                    <div class="form-group">
                                                        <label>عکس کارت ملی:
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input @if(strlen($scholarship->user->cartmelli_image)==0) is-invalid  @else is-valid  @endif" id="inputcartmelli_image" aria-describedby="inputcartmelli_image" name="cartmelli_image"  @if(strlen($scholarship->user->cartmelli_image)==0) required @endif />
                                                            <label class="custom-file-label" for="inputcartmelli_image">Choose file</label>
                                                        </div>
                                                        <small class="text-muted">فرمت فایل:jpg , jpeg , png  -;حجم حداکثر 600 کیلوبایت</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 px-1">
                                                    <div class="form-group">
                                                        <label>عکس مدرک تحصیلی:
                                                            <span class="text-danger">*</span>
                                                        </label>
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
                @endif

                <button class="btn btn-primary" id="contact-tab2" onclick="document.getElementById('introduce-tab').click()">مرحله بعد</button>
            </div>
            <div class="tab-pane fade show" id="introduce" role="tabpanel" aria-labelledby="introduce-tab">
                <div class="card-body ">
                    <div class="card">
                        <div class="card-body border border-1 shadow-sm shadow ">
                            <p>یکی از مهمترین اهداف طرح بورسیه کوچینگ، شناسایی افراد اثرگذار، مستعد و نخبه جامعه و تسهیل فضای آموزش حرفه ای برای این افراد است. </p>
                            <p>لذا با توجه به اینکه ظرفیت اطلاع رسانی ما محدود است، از شما درخواست میکنیم که دوستان واجد شرایط خود را به این برنامه دعوت کنید و طبعا ما نیز از این اقدام شما قدردانی مینماییم.</p>

                            <p>چنانچه  فردی که معرفی میکنید و یا از طریق لینک شما  ثبت نام نموده است، تمام مراحل را با  موفقیت  طی کند (مثلا 50 امتیاز کسب کند) ، 10 درصد از امتیاز بورسیه آنها به امتیاز بورسیه  شما <span class="text-danger">اضافه</span> میگردد.</p>
                        </div>
                    </div>
                    <p>استفاده از امتیاز معرفی دو روش دارد:</p>



                    <ol>
                        <li>
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-8 ol-lg-8 col-xl-8">
                                    انتشار پوستر و ویدئو در یک پست 2 اسلایدی (اسلاید  اول عکس و اسلاید دوم ویدئوی معرفی) در صفحه اینستاگرام  شما  و  تگ  کردن  ایدی پیج آکادمی faracoach
                                    <div class="row mt-2 mb-2 ">
                                        <div class="col-12 text-center">
                                            <a href="{{asset('/videos/بورسیه.mp4')}}" class="btn btn-success mb" target="_blank">دانلود فیلم</a>
                                            <a href="{{asset('/images/بورسیه-کاور-ویدئو.jpg')}}" class="btn btn-success" target="_blank">دانلود پوستر</a>
                                            <a href="{{asset('/images/بورسیه-اینستاگرام.jpg')}}" class="btn btn-success" target="_blank">استوری بورسیه</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-4 ol-lg-4 col-xl-4">
                                    <div class="row">
                                        <div class="col-12 col-md-4 pb-sm-2 p-0">
                                            <video controls class="img-fluid img-thumbnail"  height="">
                                                <source src="{{asset('/videos/بورسیه.mp4')}}" >
                                            </video>
                                        </div>
                                        <div class="col-12 col-md-4 pb-sm-2">
                                            <img src="{{asset('/images/بورسیه-کاور-ویدئو.jpg')}}" class="img-fluid img-thumbnail" height="164px"/>
                                        </div>
                                        <div class="col-12 col-md-4 pb-sm-2">
                                            <img src="{{asset('/images/بورسیه-اینستاگرام.jpg')}}" class="img-fluid img-thumbnail" height="164px" />
                                        </div>
                                    </div>

                                </div>
                                <div class="card-body border border-1 shadow-sm shadow ">
                                    <p>با  توجه به  محدودیت  ظرفیت، فقط افرادی را بطور مستقیم دعوت کنید که یکی از شرایط زیر را داشته باشند:</p>
                                    <ol>
                                        <li> شناخت نسبی نسبت  به  رزومه  و توانمندی انها داشته باشید</li>
                                        <li>جزو اساتید شما  بوده  و یا  در حوزه های مرتبط، نخبه، مستعد  و یا بسیار علاقمند باشند.</li>
                                        <li>به  کوچینگ یا مباحث توسعه فردی و کسب و کار علاقمند باشند.</li>
                                        <li>زمینه فعالیت به  عنوان کوچ فردی و سازمانی و یا  بیزینس کوچینگ را داشته باشند و ...</li>
                                    </ol>
                                    <p>تا دعوت شما اثر بحش باشد و همچنین احتمال پذیرش و قبولی آنها در ساختار بورسیه زیاد باشد. 👌</p>
                                </div>
                            </div>
                            <div class="row  bg-success ">
                                <div class="col-12 col-sm-5 col-md-5 col-lg-5 col-xl-5">
                                    <h6 class="mt-2">لینک دعوت اختصاصی شما جهت اشتراک گذاری با دوستان:</h6>
                                </div>
                                <div class="col-12 col-sm-7 col-md-55 col-lg-7 col-xl-7">
                                    <p class=" p-2 dir-rtl text-center"  id="personal_link">{{asset('/scholarship/register?introduce='.Auth::user()->id)}}</p>
                                </div>
                            </div>






                        </li>

                        <li class="mt-1">معرفی 5 نفر بصورت مستقیم
                            @if(count($scholarship->user->get_invitations->where('resource','=','بورسیه تحصیلی'))<=5)
                                <!--
                                <b>معرفی مستقیم نفر {{($scholarship->user->get_invitations->where('resource','=','بورسیه تحصیلی')->count())+1}} از 5 افراد از طریق پورتال:</b>
                                -->
                                <form method="post" action="/panel/scholarship/addintroduced" class=" border-bottom mb-3">
                                    <div class="row pt-1 mt-1" id="formAddIntroduce">
                                        {{csrf_field()}}
                                        <input type="hidden" value="بورسیه تحصیلی" name="resource" />
                                        <div class="col-xs-12 col-md-2 col-lg-2 col-xl-2 mt-1">
                                            <small>جنسیت:<span class="text-danger">*</span></small>
                                            <div class="input-group mb-1">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="sex1" name="sex_introduced" class="custom-control-input" value="1" {{ old('sex_introduced')=="1" ? 'checked='.'"'.'checked'.'"' : '' }} >
                                                    <label class="custom-control-label" for="sex1">آقا</label>
                                                </div>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="sex0" name="sex_introduced" class="custom-control-input" value="0" {{ old('sex_introduced')=="0" ? 'checked='.'"'.'checked'.'"' : '' }} >
                                                    <label class="custom-control-label  ml-1" for="sex0">خانم</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-md-3 col-lg-3 col-xl-3 ">
                                            <small>نام:<span class="text-danger">*</span></small>
                                            <div class="input-group mb-1">
                                                <input type="text" class="form-control" placeholder="مثلا :علی" name="fname_introduced" value="{{old('fname_introduced')}}"/>
                                                <div class="input-group-prepend">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-md-3 col-lg-3 col-xl-3 ">
                                            <small>نام خانوادگی:<span class="text-danger">*</span></small>
                                            <div class="input-group mb-1">
                                                <input type="text" class="form-control" placeholder="مثلا: محمدی" name="lname_introduced" value="{{old('lname_introduced')}}" />
                                                <div class="input-group-prepend">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-md-3 col-lg-3 col-xl-3 ">
                                            <small>تلفن همراه:<span class="text-danger">*</span></small>
                                            <div class="input-group mb-1">
                                                <input type="hidden" id="tel_org_introduce"  name="tel_introduced"/>
                                                <input type="tel" dir="ltr" class="form-control" placeholder="تلفن تماس را وارد کنید" id="tel_introduce" />
                                                <div class="input-group-prepend">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-md-4 col-lg-4 col-xl-4 mt-1 d-none">
                                            <small>پیگیری توسط:<span class="text-danger">*</span></small>
                                            <div class="input-group mb-1">
                                                @foreach($getFollowbyCategory as $item)
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="customRadio{{$item->id}}" name="followby_id" class="custom-control-input" value="{{$item->id}}" @if($item->id==1) checked  @endif  >
                                                        <label class="custom-control-label  ml-1" for="customRadio{{$item->id}}">{{$item->followby}}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-md-4 col-lg-4 col-xl-4 mt-1 d-none">
                                            <small> ارسال پیامک دعوت</small>
                                            <div class="input-group mb-1">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="sms0" name="sms" class="custom-control-input" value="0" checked >
                                                    <label class="custom-control-label" for="sms0">ارسال شود</label>
                                                </div>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="sms1" name="sms" class="custom-control-input" value="1" >
                                                    <label class="custom-control-label ml-1" for="sms1">ارسال نشود</label>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-12 ">
                                            <div class="input-group mb-2 btn-send text-center">
                                                <!-- <button type="button" class="btn btn-primary" id="addFormIntroduce" title="اضافه کردن فرم جدید">+</button>-->
                                                <button type="submit" class="btn btn-secondary d-block">ارسال دعوتنامه </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            @else
                                <div class="alert alert-warning">
                                    شما 5 نفر افراد معرفی لیست خود را انجام داده اید
                                </div>
                            @endif
                        </li>
                    </ol>
                </div>



                <b >لیست افرادی که شما معرفی کرده اید:</b>
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
                <div class="card-body" >
                    <p>آکادمی بین المللی فراکوچ به  عنوان  اولین آموزشگاه مجاز کوچینگ در ایران و با اعتبار بین المللی تا کنون با پذیرش بیش از 1000 دانشپذیر در دوره های مختلف آموزش کوچینگ، بزرگترین  موسسه  آموزش کوچینگ در ایران محسوب می شود.</p>
                    <p class="text-justify">پس از استقبال کم نظیر مشتاقان مسیر توسعه فردی و کسب و کار و کوچینگ از فرصت بی نظیر و البته محدود بورسیه کوچینگ جهت ورود به این اکوسیستم، بر آن شدیم که برای افراد مستعد، نخبه و توانمند جامعه به ویژه اساتید، پژوهشگران، اندیشمندان، مدیران و دانشجویان برتر علی الخصوص رشته های مدیریت، روانشاسی و مشاوره، علوم رفتاری و آموزشی، منابع انسانی و ... شناسایی کرده و تحت عنوان "بورسیه کوچینگ"  از آنها حمایت نماییم.                    </p>
                    <p>سرفصل ها:</p>
                    <ol>
                        <li>باورهای بنیادین کوچینگ </li>
                        <li>کاربرد علوم مختلف مثل روانشناسی ومدیریت در کوچینگ</li>
                        <li>جایگاه کوچینگ در ایران و جهان</li>
                        <li>کوچ کیست؟</li>
                        <li>تعریف کوچینگ از دیدگاه سازمان جهانی کوچینگ ICF</li>
                        <li>نظام ارزشها چیست و جایگاه آن در کوچینگ</li>
                    </ol>
                    <p>آزمون و گواهینامه بین المللی:</p>
                    <p>در ادامه ارزیابی و بررسی رزومه های دریافتی، متقاضیان حضور در بورسیه پس از برگزاری وبینار، موظفند در آزمون ورود به دوره اصلی که از محتوای این وبینار طراحی شده است شرکت نموده و نمره قبولی را کسب نمایند. </p>
                    <p>از طرف آکادمی فراکوچ برای قبول شدگان در این آزمون، گواهینامه معتبر بین المللی CCE که مورد تائید فدراسیون جهانی کوچینگ ICF می باشد صادر و اعطا خواهد شد.</p>

                    <div class="row">
                        <div class="col-12 col-md-6 mb-1">
                            <b class="d-block mb-2 text-center bg-primary text-white p-2">گام اول: تماشا فیلم آموزشی</b>
                            <style>.h_iframe-aparat_embed_frame{position:relative;}.h_iframe-aparat_embed_frame .ratio{display:block;width:100%;height:auto;}.h_iframe-aparat_embed_frame iframe{position:absolute;top:0;left:0;width:100%;height:100%;}</style><div class="h_iframe-aparat_embed_frame"><span style="display: block;padding-top: 57%"></span><iframe src="https://www.aparat.com/video/video/embed/videohash/yCEac/vt/frame" allowFullScreen="true" webkitallowfullscreen="true" mozallowfullscreen="true"></iframe></div>
                        </div>
                        <div class="col-12 col-md-6">
                              <b class="d-block mb-2 text-center bg-primary text-white p-2">گام دوم: ثبت نام در وبینار</b>
                              <a href="https://evnd.co/dkf4a" target="_blank">
                                  <img src="{{asset('/images/scholarship_webinar.jpg')}}" class="img-fluid" />
                                  <p class="text-center btn btn-primary btn-block">ثبت نام</p>
                              </a>
                        </div>

                        <div class="d-sm-none d-md-block col-lg-4"></div>
                        <div class="col-12 col-lg-4 d-sm-none d-md-block">
                            <p class="text-center">کد حضور در وبینار</p>
                            <div id="result_checkCodeWebinar"></div>
                            @if($scholarship->confirm_webinar==1)
                                <div class="alert alert-success">کد شرکت در وبینار با موفقیت ثبت شده است</div>
                            @elseif($scholarship->user->get_recieveCodeUsers->count()>=3)
                                <div class="alert alert-danger">تعداد مجاز ورود دفعات کد وبینار بورسیه 3 بار می باشد</div>
                            @else
                                <form method="post" class="text-center"  id="frm_checkCodeWebinar">
                                    {{csrf_field()}}
                                    <div class="row">
                                        <div class="col-4 col-md-4">
                                            <label for="code1">کد سوم</label>
                                            <input type="number" class="form-control code text-center" id="code3"  maxlength="2" name="code3"/>
                                        </div>
                                        <div class="col-4 col-md-4">
                                            <label for="code2">کد دوم</label>
                                            <input type="number" class="form-control code text-center" id="code2"   maxlength="2" name="code2"/>
                                        </div>
                                        <div class="col-4 col-md-4">
                                            <label for="code3">کد اول</label>
                                            <input type="number" class="form-control code text-center" id="code1"   maxlength="2" name="code1"/>
                                        </div>
                                        <button type="button" class="btn btn-primary mb-2 d-block btn-block mt-1 mb-1" onclick="checkCodeWebinar()">کد وبینار</button>
                                    </div>
                                </form>
                            @endif
                        </div>
                        <div class="d-sm-none d-md-block col-lg-4"></div>
                    </div>
                </div>


            </div>
            <div class="tab-pane fade " id="introductionLetter" role="tabpanel" aria-labelledby="introductionLetter-tab">
                <div class="card-body" >
                    <b>نمونه متن معرفی نامه:</b>
                    <p>نامه در سر برگ ان  موسسه  با شماره  و  تاریخ</p>
                    <p></p>
                </div>
            </div>
            <div class="tab-pane fade " id="interview" role="tabpanel" aria-labelledby="interview-tab">
                <div class="card-body" >

                </div>

            </div>
            <div class="tab-pane fade " id="exam" role="tabpanel" aria-labelledby="exam-tab">
                <div class="card-body" >
                    @if(is_null($scholarship->user->get_scholarshipExam))
                        <div class="container pb-4 mt-5">
                            <div class="col-12 text-justify">
                                <p>سلام به آزمون دوره  مقدماتی خوش آمدید </p>
                                <p>این آزمون  هم از جهت  نمره  و امتیاز بورسیه اهمیت داره ( نمره زیر 50 بدون امتیاز ، 50 تا 70 ، فقط 10 و بالای 70 نمره  کامل  20 امتیاز ) و  هم برای صدور  گواهینامه  (فقط برای نمره  بالای 50 گواهینامه صادر میشه )</p>
                                <p>این آزمون شامل 25 سواله که برای  جواب درست ، مناسب ترین گزینه را انتخاب نمایید.</p>
                                <p>با آرزوی موفقیت، در مصاحبه میبینیمتون 🌺</p>
                            </div>
                        </div>
                        <div class="container pb-4 mt-5 " id="fff">
                            <div class=" d-flex justify-content-center">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12  progress">
                                    <div class="progress-bar progress-bar-success progress-bar-striped active" style="width: 0%;">
                                        <div class="progress-value">0%</div>
                                    </div>
                                </div>
                            </div>
                            <div class="container d-flex justify-content-center">
                                <div class=" col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <form name="demo" id="demo" method="POST" action="/panel/scholarship/exam" class="myBook mt-4">
                                        {{csrf_field()}}
                                        <section >
                                            <p>1- در کدام گزینه تعریف درستی از کوچینگ ارائه <u>نشده است</u>؟</p>
                                            <input class="page-next" type="radio" id="vehicle1_5" name="vehicle1" value="0" required />
                                            <label for="vehicle1_5"> کوچینگ یعنی کشف توانایی مراجع توسط مهارت یک کوچ</label><br>
                                            <input class="page-next" type="radio" id="vehicle1_4" name="vehicle1" value="0" required />
                                            <label for="vehicle1_4">کوچینگ یعنی تلاش برای رسیدن مراجع از دنیای موجود به دنیای مطلوب</label><br>
                                            <input class="page-next" type="radio" id="vehicle1_3" name="vehicle1" value="4" required />
                                            <label for="vehicle1_3"> کوچینگ یعنی راهنمایی مراجع برای رسیدن به هدف</label><br/>
                                            <input class="page-next" type="radio" id="vehicle1_2" name="vehicle1" value="0" required />
                                            <label for="vehicle1_2"> کوچینگ گفتگوی هدفدار بین کوچ و مراجع، برای کشف راه‌حل توسط مراجع</label><br>

                                            <div class="col-12 text-center mt-3">
                                                <button type="button" class="page-prev btn btn-danger col-3 ">قبلی</button>
                                                <button type="button" class="page-next btn btn-primary col-3">بعدی</button>
                                            </div>
                                        </section>
                                        <section >
                                            <p>2- کدام گزینه در مورد کوچینگ صحیح <u>نمی باشد</u>?</p>
                                            <input class="page-next" type="radio" id="vehicle2_5" name="vehicle2" value="4" required>
                                            <label for="vehicle2_5">در کوچینگ از طریق فرمول و پروتکل های از پیش تعیین شده مساله  مراجع حل می‌شود</label><br>
                                            <input class="page-next" type="radio" id="vehicle2_4" name="vehicle2" value="0" required>
                                            <label for="vehicle2_4"> در کوچینگ تمرکز بر روی حال و آینده مراجع است  </label><br>
                                            <input class="page-next" type="radio" id="vehicle2_3" name="vehicle2" value="0" required>
                                            <label for="vehicle2_3">در کوچینگ به حل مشکلات گذشته مراجع پرداخته نمی‌شود</label><br/>
                                            <input class="page-next" type="radio" id="vehicle2_2" name="vehicle2" value="0" required>
                                            <label for="vehicle2_2"> در کوچینگ منبع دانش مراجع است</label><br>
                                            <div class="col-12 text-center mt-3">
                                                <button type="button" class="page-prev btn btn-danger col-3 ">قبلی</button>
                                                <button type="button" class="page-next btn btn-primary col-3">بعدی</button>
                                            </div>
                                        </section>
                                        <section >
                                            <p>3- اگر کوچ در زمینه یا موضوع مراجع اطلاعات یا دانش تخصصی دارد: .
                                            </p>
                                            <input class="page-next" type="radio" id="vehicle3_5" name="vehicle3" value="0" required>
                                            <label for="vehicle3_5">با دریافت هزینه بیشتر این دانش و تخصص را به او ارائه می کند </label><br>
                                            <input class="page-next" type="radio" id="vehicle3_4" name="vehicle3" value="4" required>
                                            <label for="vehicle3_4">کوچ اجازه اعمال و انتقال اطلاعات یا دانش شخصی به مراجع را ندارد </label><br>
                                            <input class="page-next" type="radio" id="vehicle3_3" name="vehicle3" value="0" required>
                                            <label for="vehicle3_3">کوچ بعد از جلسه کوچینگ هم نمی‌تواند این اطلاعات یا دانش تخصصی را در اختیار مراجع قرار دهد</label><br/>
                                            <input class="page-next"  type="radio" id="vehicle3_2" name="vehicle3" value="0" required>
                                            <label for="vehicle3_2"> کوچ میتواند مستقیما راهکار لازم را  هر موقع صلاح ببیند، ارائه دهد</label><br>
                                            <div class="col-12 text-center mt-3">
                                                <button type="button" class="page-prev btn btn-danger col-3 ">قبلی</button>
                                                <button type="button" class="page-next btn btn-primary col-3">بعدی</button>
                                            </div>
                                        </section>
                                        <section >
                                            <p>4- اگر مراجع درخواست کند که کوچ برای او طرح کسب و کار بنویسد، کوچ چه کاری باید انجام دهد؟
                                            </p>
                                            <input class="page-next"  type="radio" id="vehicle4_5" name="vehicle4" value="0" required>
                                            <label for="vehicle4_5">در ازای دریافت هزینه بنویسد</label><br>
                                            <input class="page-next"  type="radio" id="vehicle4_4" name="vehicle4" value="0" required>
                                            <label for="vehicle4_4">ننویسد چون کوچ هنوز تجربه ای ندارد </label><br>
                                            <input class="page-next"  type="radio" id="vehicle4_3" name="vehicle4" value="0" required>
                                            <label for="vehicle4_3">نپذیرد چرا که این کار مشاوره است و کوچینگ نیست</label><br/>
                                            <input class="page-next"  type="radio" id="vehicle4_2" name="vehicle4" value="4" required>
                                            <label for="vehicle4_2"> با همراهی با  مراجع به  او  کمک کند تا  موانع نوشتن طرح کسب و کار را پیدا کند </label><br>

                                            <div class="col-12 text-center mt-3">
                                                <button type="button" class="page-prev btn btn-danger col-3 ">قبلی</button>
                                                <button type="button" class="page-next btn btn-primary col-3">بعدی</button>
                                            </div>
                                        </section>
                                        <section >
                                            <p>5- پایه ای ترین چیزهایی که باعث تغییر در تمام ابعاد زندگی ما می‌شود حوزه ..... /...... /....... / ...... است. .
                                            </p>
                                            <input class="page-next"  type="radio" id="vehicle5_5" name="vehicle5" value="0" required>
                                            <label for="vehicle5_5"> باورها / عقاید / تغییر/ نیاز </label><br>
                                            <input  class="page-next" type="radio" id="vehicle5_4" name="vehicle5" value="0" required>
                                            <label for="vehicle5_4">احساس / درک/ عقاید/ ارزش ها  </label><br>
                                            <input class="page-next"  type="radio" id="vehicle3" name="vehicle5" value="0" required>
                                            <label for="vehicle3">توانایی/ رفتار/ ارزش/ باور </label><br/>
                                            <input class="page-next"  type="radio" id="vehicle1" name="vehicle5" value="4" required>
                                            <label for="vehicle1"> افکار /عقاید / باورها / ارزش‌ها </label><br>

                                            <div class="col-12 text-center mt-3">
                                                <button type="button" class="page-prev btn btn-danger col-3 ">قبلی</button>
                                                <button type="button" class="page-next btn btn-primary col-3">بعدی</button>
                                            </div>
                                        </section>
                                        <section >
                                            <p>6- کدام گزینه گویای نظام ارزشها نیست؟ </p>
                                            <input class="page-next"  type="radio" id="vehicle6_5" name="vehicle6" value="0" required>
                                            <label for="vehicle6_5"> ارزش وابسته به زمان و مکان نیست </label><br>
                                            <input class="page-next"  type="radio" id="vehicle6_4" name="vehicle6" value="0" required>
                                            <label for="vehicle6_4">ارزش قابل دست  یافتن نیست </label><br>
                                            <input class="page-next"  type="radio" id="vehicle6_3" name="vehicle6" value="0" required>
                                            <label for="vehicle6_3"> منشا ارزش ها از باور ماست </label><br/>
                                            <input class="page-next"  type="radio" id="vehicle6_2" name="vehicle6" value="4" required>
                                            <label for="vehicle6_2"> توسعه و رشد یک ارزش محسوب می شود</label><br>

                                            <div class="col-12 text-center mt-3">
                                                <button type="button" class="page-prev btn btn-danger col-3 ">قبلی</button>
                                                <button type="button" class="page-next btn btn-primary col-3">بعدی</button>
                                            </div>
                                        </section>
                                        <section >
                                            <p>7- رفتارهایی که از ما سرمی زند سه دلیل دارد:
                                            </p>
                                            <input class="page-next"  type="radio" id="vehicle7_5" name="vehicle7" value="0" required>
                                            <label for="vehicle7_5"> کسب سود، ارضای نیازها، توسعه و رشد  </label><br>
                                            <input class="page-next"  type="radio" id="vehicle7_4" name="vehicle7" value="0" required>
                                            <label for="vehicle7_4"> شناساندن هویت، توسعه و رشد، دفع ضرر </label><br>
                                            <input  class="page-next" type="radio" id="vehicle7_3" name="vehicle7" value="0" required>
                                            <label for="vehicle7_3"> کسب تجربه، ابراز احساسات، بازخورد </label><br/>
                                            <input  class="page-next" type="radio" id="vehicle7_2" name="vehicle7" value="4" required>
                                            <label for="vehicle7_2"> کسب سود، دفع ضرر و رفتارهایی از سر عادت که عامل اصلی آن دیگر وجود ندارند </label><br>
                                            <div class="col-12 text-center mt-3">
                                                <button type="button" class="page-prev btn btn-danger col-3 ">قبلی</button>
                                                <button type="button" class="page-next btn btn-primary col-3">بعدی</button>
                                            </div>
                                        </section>
                                        <section >
                                            <p>8- از منظر حوزه تمرکز، کوچینگ با مشاوره به ترتیب چه تفاوتی دارد؟
                                            </p>
                                            <input  class="page-next" type="radio" id="vehicle8_5" name="vehicle8" value="0" required>
                                            <label for="vehicle8_5"> با هم تفاوتی ندارند </label><br>
                                            <input class="page-next"  type="radio" id="vehicle8_4" name="vehicle8" value="4" required>
                                            <label for="vehicle8_4">تحقق اهداف مراجع/ حل مشکلات مراجع از ظریق ارائه راهکار  </label><br>
                                            <input  class="page-next" type="radio" id="vehicle8_3" name="vehicle8" value="0" required>
                                            <label for="vehicle8_3">تحقق اهداف مراجع/ انتقال تجربه </label><br/>
                                            <input  class="page-next" type="radio" id="vehicle8_2" name="vehicle8" value="0" required>
                                            <label for="vehicle8_2"> حل مشکلات ناشی از گذشته/ انتقال تجربه </label><br>
                                            <div class="col-12 text-center mt-3">
                                                <button type="button" class="page-prev btn btn-danger col-3 ">قبلی</button>
                                                <button type="button" class="page-next btn btn-primary col-3">بعدی</button>
                                            </div>
                                        </section>
                                        <section >
                                            <p>9- به طور کلی کوچینگ از دو بعد کلی با دیگر روشهای پشتیبان متفاوت است:
                                            </p>
                                            <input class="page-next"  type="radio" id="vehicle9_5" name="vehicle9" value="4" required>
                                            <label for="vehicle9_5"> مخاطب/ رویکرد </label><br>
                                            <input class="page-next"  type="radio" id="vehicle9_4" name="vehicle9" value="0" required>
                                            <label for="vehicle9_4">هدف / برنامه ریزی </label><br>
                                            <input class="page-next"  type="radio" id="vehicle9_3" name="vehicle9" value="0" required>
                                            <label for="vehicle9_3"> تکنیک / مهارت </label><br/>
                                            <input  class="page-next" type="radio" id="vehicle9_2" name="vehicle9" value="0" required>
                                            <label for="vehicle9_2"> رویکرد /  هدف </label><br>

                                            <div class="col-12 text-center mt-3">
                                                <button type="button" class="page-prev btn btn-danger col-3 ">قبلی</button>
                                                <button type="button" class="page-next btn btn-primary col-3">بعدی</button>
                                            </div>
                                        </section>
                                        <section >
                                            <p>10- کوچینگ  بر کدام بخش وجودی انسان تمرکز دارد؟
                                            </p>
                                            <input class="page-next"  type="radio" id="vehicle10_5" name="vehicle10" value="0" required>
                                            <label for="vehicle10_5">نقاط ضعف </label><br>
                                            <input class="page-next"  type="radio" id="vehicle10_4" name="vehicle10" value="0" required>
                                            <label for="vehicle10_4">احساسات منفی </label><br>
                                            <input class="page-next"  type="radio" id="vehicle10_3" name="vehicle10" value="4" required>
                                            <label for="vehicle10_3">نقاط قوت و استعدادها</label><br/>
                                            <input class="page-next"  type="radio" id="vehicle10_2" name="vehicle10" value="0" required>
                                            <label for="vehicle10_2"> حل مشکلات ناشی از گذشته/ انتقال تجربه </label><br>

                                            <div class="col-12 text-center mt-3">
                                                <button type="button" class="page-prev btn btn-danger col-3 ">قبلی</button>
                                                <button type="button" class="page-next btn btn-primary col-3">بعدی</button>
                                            </div>
                                        </section>
                                        <section >
                                            <p>11-  ویژگیهای یک کوچ خوب چه چیزی <u>نیست</u> ؟</p>
                                            <input class="page-next"  type="radio" id="vehicle11_5" name="vehicle11" value="0" required>
                                            <label for="vehicle11_5">توانایی برقراری ارتباط موثر داشته باشد .</label><br>
                                            <input class="page-next"  type="radio" id="vehicle11_4" name="vehicle11" value="0" required>
                                            <label for="vehicle11_4">پرسشگری درست را یاد داشته باشد . </label><br>
                                            <input class="page-next"  type="radio" id="vehicle11_3" name="vehicle11" value="0" required>
                                            <label for="vehicle11_3">عاشق کمک به دیگران باشد،علاقمند به رشد ،تغییر و موفقیت آنها باشد .</label><br/>
                                            <input  class="page-next" type="radio" id="vehicle11_2" name="vehicle11" value="4" required>
                                            <label for="vehicle11_2"> بتواند  با  تکنیکهای حل مساله مشکل مراجع را حل نماید</label><br>

                                            <div class="col-12 text-center mt-3">
                                                <button type="button" class="page-prev btn btn-danger col-3 ">قبلی</button>
                                                <button type="button" class="page-next btn btn-primary col-3">بعدی</button>
                                            </div>
                                        </section>
                                        <section >
                                            <p>تفاوت کوچینگ و منتورینگ چه چیزی <u>نیست</u> ؟
                                            </p>
                                            <input class="page-next"  type="radio" id="vehicle12_5" name="vehicle12" value="0" required>
                                            <label for="vehicle12_5"> منتورینگ فرایند طولانی دارد اما کوچینگ فرآیند کوتاه مدت با تمرکز بر توسعه عملکرد افراد است</label><br>
                                            <input class="page-next"  type="radio" id="vehicle12_4" name="vehicle12" value="0"required >
                                            <label for="vehicle12_4">یک منتور اصولا در کسب و کار تجربیات جدی دارد اما کوچ لزوما نیازی به تجربه از موضوع ندارد . </label><br>
                                            <input class="page-next"  type="radio" id="vehicle12_3" name="vehicle12" value="0"required >
                                            <label for="vehicle12_3">وظیفه کوچ تسهیل فرآیند توسعه وعملکرد اما منتور از طریق انتقال تجربه آموزش میدهد</label><br/>
                                            <input class="page-next"  type="radio" id="vehicle12_2" name="vehicle12" value="4" required>
                                            <label for="vehicle12_2"> تفاوت آنها  در نوع برگزاری جلسات حرفه ای است</label><br>
                                            <div class="col-12 text-center mt-3">
                                                <button type="button" class="page-prev btn btn-danger col-3 ">قبلی</button>
                                                <button type="button" class="page-next btn btn-primary col-3">بعدی</button>
                                            </div>
                                        </section>
                                        <section >
                                            <p>13- کوچ پذیری یعنی چه ؟
                                            </p>
                                            <input class="page-next"  type="radio" id="vehicle13_5" name="vehicle13" value="0" required >
                                            <label for="vehicle13_5"> خود مراجع آماده  تغییر باشد</label><br>
                                            <input class="page-next"  type="radio" id="vehicle13_4" name="vehicle13" value="0" required >
                                            <label for="vehicle13_4">موضوع  مراجع ساده باشد </label><br>
                                            <input  class="page-next" type="radio" id="vehicle13_3" name="vehicle13" value="0" required >
                                            <label for="vehicle13_3">مراجع نیاز به ارجاع به درمان و مشاوره و آموزش نداشته باشد</label><br/>
                                            <input class="page-next"  type="radio" id="vehicle13_2" name="vehicle13" value="4" required >
                                            <label for="vehicle13_2"> الف و ج</label><br>
                                            <div class="col-12 text-center mt-3">
                                                <button type="button" class="page-prev btn btn-danger col-3 ">قبلی</button>
                                                <button type="button" class="page-next btn btn-primary col-3">بعدی</button>
                                            </div>
                                        </section>
                                        <section >
                                            <p>14-  فرایند کوچینگ از چه طریق به مراجع کمک می کند؟
                                            </p>
                                            <input  class="page-next" type="radio" id="vehicle14_5" name="vehicle14" value="0" required >
                                            <label for="vehicle14_5"> ارائه راهکار مناسب </label><br>
                                            <input  class="page-next" type="radio" id="vehicle14_4" name="vehicle14" value="4" required >
                                            <label for="vehicle14_4">همراهی در تغییر دیدگاه و نگرش جدید </label><br>
                                            <input class="page-next"  type="radio" id="vehicle14_3" name="vehicle14" value="0" required>
                                            <label for="vehicle14_3">پرسشگری جهتمند برای روشنگری و اتخاذ تصمیم مناسب</label><br/>
                                            <input class="page-next"  type="radio" id="vehicle14_2" name="vehicle14" value="0" required >
                                            <label for="vehicle14_2"> مراجع  خودش برای خودش تصمیم میگیرد</label><br>

                                            <div class="col-12 text-center mt-3">
                                                <button type="button" class="page-prev btn btn-danger col-3 ">قبلی</button>
                                                <button type="button" class="page-next btn btn-primary col-3">بعدی</button>
                                            </div>
                                        </section>
                                        <section >
                                            <p>15- کوچینگ در زندگی افراد چگونه عمل میکند؟
                                            </p>
                                            <input class="page-next"  type="radio" id="vehicle15_5" name="vehicle15" value="0" required >
                                            <label for="vehicle15_5">  ارائه توصیه های تخصصی</label><br>
                                            <input class="page-next"  type="radio" id="vehicle15_4" name="vehicle15" value="4" required>
                                            <label for="vehicle15_4"> تمرکز بر عملکرد و استفاده از ظرفیت های موجود و بالقوه </label><br>
                                            <input class="page-next"  type="radio" id="vehicle15_3" name="vehicle15" value="0" required>
                                            <label for="vehicle15_3"> به عنوان ناجی و حلال مشکلات عمل میکند</label><br/>
                                            <input class="page-next"  type="radio" id="vehicle15_2" name="vehicle15" value="0" required>
                                            <label for="vehicle15_2">  تمرکز بر کسب دانش و مهارتهای شخصی</label><br>

                                            <div class="col-12 text-center mt-3">
                                                <button type="button" class="page-prev btn btn-danger col-3 ">قبلی</button>
                                                <button type="button" class="page-next btn btn-primary col-3">بعدی</button>
                                            </div>
                                        </section>
                                        <section >
                                            <p>16- رویکرد کوچ، در ارزیابی عملکرد چگونه رویکردی است؟
                                            </p>
                                            <input class="page-next"  type="radio" id="vehicle16_5" name="vehicle16" value="0" required>
                                            <label for="vehicle16_5">کوچ رفتاری امیدوارکننده دارد.</label><br>
                                            <input class="page-next"  type="radio" id="vehicle16_4" name="vehicle16" value="0" required>
                                            <label for="vehicle16_4">کوچ رفتاری امیدوارکننده و انگیزه بخش دارد. </label><br>
                                            <input  class="page-next" type="radio" id="vehicle16_3" name="vehicle16" value="4" required>
                                            <label for="vehicle16_3">کوچ رفتاری بی طرفانه و بدون نظر دارد.</label><br/>
                                            <input class="page-next"  type="radio" id="vehicle16_2" name="vehicle16" value="0" required>
                                            <label for="vehicle16_2"> کوچ با درنظرگرفتن احساسات مراجع نظر خود را بیان می کند.</label><br>

                                            <div class="col-12 text-center mt-3">
                                                <button type="button" class="page-prev btn btn-danger col-3 ">قبلی</button>
                                                <button type="button" class="page-next btn btn-primary col-3">بعدی</button>
                                            </div>
                                        </section>
                                        <section >
                                            <p>17- مراجع به جلسه می‌آید با این موضوع که «در بورس سرمایه گذاری کنم یا ملک بخرم؟» کوچ در این مورد چه باید بکند؟
                                            </p>
                                            <input  class="page-next" type="radio" id="vehicle17_5" name="vehicle17" value="0" required>
                                            <label for="vehicle17_5">او را به بیزینس کوچ ارجاع دهد </label><br>
                                            <input class="page-next" type="radio" id="vehicle17_4" name="vehicle17" value="0" required>
                                            <label for="vehicle17_4">اگر کوچ در این زمینه تخصص دارد به او در جلسه کمک کند  </label><br>
                                            <input  class="page-next" type="radio" id="vehicle17_3" name="vehicle17" value="0" required>
                                            <label for="vehicle17_3">او را راهنمایی می کند و از او هزینه اضافه دریافت میکند </label><br/>
                                            <input class="page-next" type="radio" id="vehicle17_2" name="vehicle17" value="4" required>
                                            <label for="vehicle17_2">این گونه موارد نیاز به وزن دهی یا ارزیابی از سوی کارشناس در محیط عمل دارد و کوچ موظف به  ارجاع است</label><br>

                                            <div class="col-12 text-center mt-3">
                                                <button type="button" class="page-prev btn btn-danger col-3 ">قبلی</button>
                                                <button type="button" class="page-next btn btn-primary col-3">بعدی</button>
                                            </div>
                                        </section>
                                        <section >
                                            <p>18- اگر نتیجه مطلوب مراجع کاهش وزن باشد، یک کوچ سلامت می تواند
                                            </p>
                                            <input class="page-next" type="radio" id="vehicle18_5" name="vehicle18" value="0" required>
                                            <label for="vehicle18_5">مراجع با تردمیل کوچ تمرین کند</label><br>
                                            <input class="page-next" type="radio" id="vehicle18_4" name="vehicle18" value="0" required>
                                            <label for="vehicle18_4">در مورد روشهای کاهش وزن به مراجع مشاوره دهد </label><br>
                                            <input class="page-next"  type="radio" id="vehicle18_3" name="vehicle18" value="4" required>
                                            <label for="vehicle18_3">مشخص کنید مراجع در جلساتی که هدف ان دست یافتن به کاهش وزن است بدنبال چه چیزی است</label><br/>
                                            <input class="page-next"  type="radio" id="vehicle18_2" name="vehicle18" value="0" required>
                                            <label for="vehicle18_2"> کوچینگ را با هدف کاهش وزن آغاز کند</label><br>
                                            <div class="col-12 text-center mt-3">
                                                <button type="button" class="page-prev btn btn-danger col-3 ">قبلی</button>
                                                <button type="button" class="page-next btn btn-primary col-3">بعدی</button>
                                            </div>
                                        </section>
                                        <section >
                                            <p>19- زمانیکه مراجع می گوید رابطه اش با شریکش بخاطر عدم وجود احساس درحال از بین رفتن است،کوچ باید این کار را انجام دهد.
                                            </p>
                                            <input class="page-next" type="radio" id="vehicle19_5" name="vehicle19" value="4" required>
                                            <label for="vehicle19_5"> درحالیکه سکوت می کند منتظر بماند مراجع چیزهای بیشتری بگوید</label><br>
                                            <input class="page-next" type="radio" id="vehicle19_4" name="vehicle19" value="0" required>
                                            <label for="vehicle19_4">به مراجع بگوید همیشه همه چیز بهتر می شود </label><br>
                                            <input class="page-next" type="radio" id="vehicle19_3" name="vehicle19" value="0" required>
                                            <label for="vehicle19_3">از مراجع بپرسد پیشنهاد انجام چه کاری را می دهد</label><br/>
                                            <input class="page-next" type="radio" id="vehicle19_2" name="vehicle19" value="0" required>
                                            <label for="vehicle19_2"> از مراجع بپرسد چه احساسی دارد</label><br>

                                            <div class="col-12 text-center mt-3">
                                                <button type="button" class="page-prev btn btn-danger col-3 ">قبلی</button>
                                                <button type="button" class="page-next btn btn-primary col-3">بعدی</button>
                                            </div>
                                        </section>
                                        <section >
                                            <p>20- مراجعی که بشدت منفعل و ارام است. کوچ باید
                                            </p>
                                            <input class="page-next" type="radio" id="vehicle20_5" name="vehicle20" value="4" required>
                                            <label for="vehicle20_5"> این مساله را بررسی کرده و آنرا با مراجع به اشتراک بگذارد که دلیل کمبود انرژی وی چیست</label><br>
                                            <input class="page-next" type="radio" id="vehicle20_4" name="vehicle20" value="0" required>
                                            <label for="vehicle20_4">با مراجع خیلی پرانرژی صحبت کند و سعی کند به او روحیه بدهد </label><br>
                                            <input class="page-next" type="radio" id="vehicle20_3" name="vehicle20" value="0" required>
                                            <label for="vehicle20_3">برای روحیه دادن به او موسیقی راک پخش کند</label><br/>
                                            <input class="page-next" type="radio" id="vehicle20_2" name="vehicle20" value="0" required>
                                            <label for="vehicle20_2"> به او بگوید که افسرده است و او را به یک درمانگر ارجاع دهد</label><br>

                                            <div class="col-12 text-center mt-3">
                                                <button type="button" class="page-prev btn btn-danger col-3 ">قبلی</button>
                                                <button type="button" class="page-next btn btn-primary col-3">بعدی</button>
                                            </div>
                                        </section>
                                        <section >
                                            <p>21- برای حمایت از مراجعی که می خواهد به سختی الگوی فکری خود را تغییر دهد،کوچ باید
                                            </p>
                                            <input class="page-next" type="radio" id="vehicle21_5" name="vehicle21" value="0" required>
                                            <label for="vehicle21_5">مراجع را وادار کند تعداد دفعاتی که فکر می کند را بشمارد</label><br>
                                            <input class="page-next" type="radio" id="vehicle21_4" name="vehicle21" value="0" required>
                                            <label for="vehicle21_4">به مراجع تکنیکی را یاد بدهد که هنگام بروز ان الگوی فکری در ان اختلال ایجاد کند </label><br>
                                            <input class="page-next" type="radio" id="vehicle21_3" name="vehicle21" value="0" required>
                                            <label for="vehicle21_3">الگوی فکری جدیدی به او بیاموزد تا جایگزین الگوی قدیمی شود</label><br/>
                                            <input class="page-next" type="radio" id="vehicle21_2" name="vehicle21" value="4" required>
                                            <label for="vehicle21_2"> بررسی کند مراجع چه سودی از آن قالب فکری می برد</label><br>

                                            <div class="col-12 text-center mt-3">
                                                <button type="button" class="page-prev btn btn-danger col-3 ">قبلی</button>
                                                <button type="button" class="page-next btn btn-primary col-3">بعدی</button>
                                            </div>
                                        </section>
                                        <section >
                                            <p>22- کوچ چگونه می تواند به بهترین وجه به خوداگاهی مراجع خود کمک کند؟
                                            </p>
                                            <input class="page-next" type="radio" id="vehicle22_5" name="vehicle22" value="0" required>
                                            <label for="vehicle22_5"> با دادن مطالب خودیاری به مراجع</label><br>
                                            <input class="page-next" type="radio" id="vehicle22_4" name="vehicle22" value="0" required>
                                            <label for="vehicle22_4">با مشاوره دادن به مراجع درمورداینکه چه خوداگاهیهایی نیاز دارد </label><br>
                                            <input class="page-next" type="radio" id="vehicle22_3" name="vehicle22" value="4" required>
                                            <label for="vehicle22_3">با پرسیدن سوالات قدرتمند</label><br/>
                                            <input class="page-next" type="radio" id="vehicle22_2" name="vehicle22" value="0" required>
                                            <label for="vehicle22_2"> به مراجع اجازه دهد که درمورد زمانیکه به خوداگاهی رسید به کوچ اطلاع دهد</label><br>

                                            <div class="col-12 text-center mt-3">
                                                <button type="button" class="page-prev btn btn-danger col-3 ">قبلی</button>
                                                <button type="button" class="page-next btn btn-primary col-3">بعدی</button>
                                            </div>
                                        </section>
                                        <section >
                                            <p>23- مراجع برای انتخاب بین گزینه های شغلی معضل دارد. کوچ بررسی می کند که ...........
                                            </p>
                                            <input class="page-next" type="radio" id="vehicle23_5" name="vehicle23" value="4" required>
                                            <label for="vehicle23_5"> چه چیزی با ارزشها و اهداف بلند مدت مراجع همراستاست</label><br>
                                            <input class="page-next" type="radio" id="vehicle23_4" name="vehicle23" value="0" required>
                                            <label for="vehicle23_4">پرداخت بهتر در برابر کار کمتر چیست </label><br>
                                            <input class="page-next" type="radio" id="vehicle23_3" name="vehicle23" value="0" required>
                                            <label for="vehicle23_3"> با انجام چه کاری به خانواده و دوستانش بهتر خدمت می کند</label><br/>
                                            <input class="page-next" type="radio" id="vehicle23_2" name="vehicle23" value="0" required>
                                            <label for="vehicle23_2"> بپرسد بر مبنای مقیاس 10 چه رتبه ای به این گزینه ها می دهد</label><br>

                                            <div class="col-12 text-center mt-3">
                                                <button type="button" class="page-prev btn btn-danger col-3 ">قبلی</button>
                                                <button type="button" class="page-next btn btn-primary col-3">بعدی</button>
                                            </div>
                                        </section>
                                        <section >
                                            <p>24- مراجع به دلیل داشتن رئیس سخت گیر می خواهد شغل خود را ترک کند.کوچ باید.
                                            </p>
                                            <input class="page-next" type="radio" id="vehicle24_5" name="vehicle24" value="0" required>
                                            <label for="vehicle24_5"> به مراجع کمک کند تا گزینه های ترک شغل را بررسی کند</label><br>
                                            <input class="page-next" type="radio" id="vehicle24_4" name="vehicle24" value="4" required>
                                            <label for="vehicle24_4">مساله را بررسی کند تا ببیند مراجع چگونه می تواند با رئیسش ارتباط برقرار کند </label><br>
                                            <input class="page-next" type="radio" id="vehicle24_3" name="vehicle24" value="0" required>
                                            <label for="vehicle24_3">نیاز به جرات ورزی را به مراجعش اموزش دهد</label><br/>
                                            <input class="page-next" type="radio" id="vehicle24_2" name="vehicle24" value="0" required>
                                            <label for="vehicle24_2"> از مراجع در مورد اینکه همکارانش چه احساسی درمورد رئیسشان دارند ،بپرسد</label><br>
                                            <div class="col-12 text-center mt-3">
                                                <button type="button" class="page-prev btn btn-danger col-3 ">قبلی</button>
                                                <button type="button" class="page-next btn btn-primary col-3">بعدی</button>
                                            </div>
                                        </section>
                                        <section >
                                            <p>25- اکثر کوچینگها به کوچینگ زندگی ختم می شود زیرا
                                            </p>
                                            <input class="page-next" type="radio" id="vehicle25_5" name="vehicle25" value="0" required>
                                            <label for="vehicle25_5"> کوچ و مراجع هنوز زندگی می کنند</label><br>
                                            <input class="page-next" type="radio" id="vehicle25_4" name="vehicle25" value="0" required>
                                            <label for="vehicle25_4">زندگی دائما با مسائل مختلفی معلق است </label><br>
                                            <input class="page-next" type="radio" id="vehicle25_3" name="vehicle25" value="4" required>
                                            <label for="vehicle25_3"> مباحث اصلی در مورد فرضیات،باورها و ارزشهاست</label><br/>
                                            <input class="page-next" type="radio" id="vehicle25_2" name="vehicle25" value="0" required>
                                            <label for="vehicle25_2"> شخص کار می کند که زندگی کند</label><br>

                                            <div class="col-12 text-center mt-3">
                                                <button type="button" class="page-prev btn btn-danger col-3 ">قبلی</button>
                                                <button type="button" class="page-next btn btn-primary col-3">بعدی</button>
                                            </div>
                                        </section>

                                        <section class="page">
                                            <!-- <a href="#">Terms of Service</a><br/>
                                            <input type="checkbox" id="ts" name="ts" value="1" required />
                                            <label for="ts"> I agree</label><br />
                                            -->
                                            <button type="button" class="page-prev btn btn-danger col-3">قبلی</button>
                                            <button type="submit" class="page-next btn btn-success col-3" id="sendForm">پایان آزمون</button>
                                        </section>
                                        <!--
                                        <section class="page" style="margin:auto;text-align:center">
                                            فرم شما تکمیل شد.
                                        </section>
                                        -->
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        @if($scholarship->user->get_scholarshipExam->score>50)
                            <div class="alert alert-success">
                                تبریک شما در آزمون مقدماتی بورسیه کوچینگ قبول شده اید
                            </div>
                        @else
                            <div class="alert alert-danger">
                                متاسفانه امتیاز شما در آزمون مقدماتی به حد نصاب ممکن نرسید
                            </div>
                        @endif
                    @endif

                </div>

            </div>
            <div class="tab-pane fade " id="result" role="tabpanel" aria-labelledby="result-tab">
                <div class="card-body" >

                </div>

            </div>
            <div class="tab-pane fade " id="rante" role="tabpanel" aria-labelledby="rante-tab">
                <div class="card-body" >

                </div>

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

        //

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
