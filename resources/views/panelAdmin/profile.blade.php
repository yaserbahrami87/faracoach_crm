@extends('panelAdmin.master.index')

@section('headerScript')
    <link href="{{asset('/css/kamadatepicker.min.css')}}" rel="stylesheet" />
    <link href="{{asset('/css/timepicker.min.css')}}" rel="stylesheet" />
@endsection

@section('rowcontent')
    <div class="col-md-4 ">
        <div class="card card-user">
            <div class="image">

            </div>
            <div class="card-body">
                <div class="author">
                    <a href="#">
                        @if(is_null($user->personal_image))
                            <img class="avatar border-gray" src={{asset("/images/default-avatar.jpg")}} alt="..." />
                        @else
                            <img class="avatar border-gray" src={{asset("/documents/users/".$user->personal_image)}} alt="..." />
                        @endif
                        <h5 class="title">{{$user->fname}} {{$user->lname}}</h5>
                    </a>
                    @if($user->type==1)
                        <p class="description text-warning">پیگیری نشده</p>
                    @elseif($user->type==11)
                        <p class="description text-primary">در حال پیگیری</p>
                    @elseif($user->type==12)
                        <p class="description text-danger">انصراف</p>
                    @elseif($user->type==20)
                        <p class="description text-success">دانشجو</p>
                    @endif
                    @if ($resourceIntroduce!=null)
                        <p> معرفی شده توسط <a href="/admin/user/{{$resourceIntroduce->id}}"> {{$resourceIntroduce->fname}} {{$resourceIntroduce->lname}}</a></p>
                    @endif
                    <p class="description text-dark"> پیگیری های انجام شده: <b> {{$countFollowups}} </b> نوبت</p>
                    <p class="d-inline"> تعداد افراد معرفی شده:</p><b> {{$countIntroducedUser}} نفر</b>
                </div>
                <p class="description text-center">

                </p>
            </div>
            <div class="card-footer">
                <a href="/admin/user/{{$user->tel}}/password" class="btn btn-primary d-block text-center">تغییر رمز عبور</a>
                <form method="post" action="/admin/user/{{$user->id}}/changeType">
                    {{csrf_field()}}
                    {{method_field('PATCH')}}
                    @if(Auth::user()->type==2)
                        <div class="input-group mb-3 mt-3 ">
                            <div class="input-group-prepend">
                                <button class="btn btn-outline-secondary" type="submit" id="button-addon1">تغییر وضعیت</button>
                            </div>

                            <select class="form-control p-0" name="type" >
                                <option selected disabled>یک گزینه را انتخاب کنید</option>
                                <option value="2" {{$user->type===2 ? "selected":""  }} >مدیر</option>
                                <option value="3" {{$user->type===3 ? "selected":""  }}>آموزش</option>
                                <option value="1" {{$user->type===1 ? "selected":""  }}>کاربر ساده</option>
                            </select>
                        </div>
                    @endif
                </form>
                <hr>
            </div>
        </div>

        <form method="post" action="/admin/profile/update/{{$user->id}}" enctype="multipart/form-data">
            {{csrf_field()}}
            {{method_field('PATCH')}}
            <div class="card card-user">
                <div class="card-header bg-light">
                    <a type="button" class="row border-bottom" data-toggle="collapse" data-target="#infoProfile" aria-expanded="false" aria-controls="infoProfile">
                        <div class="col-md-8">
                            <h6 class="card-title m-0 mb-3">اطلاعات شخصی</h6>
                        </div>

                        <div class="col-md-4 ">
                            <svg class="float-left @if((strlen($user->fname)>0)&&(strlen($user->lname)>0)&&(strlen($user->codemelli)>0)&&(strlen($user->shenasname)>0)&& (strlen($user->personal_image)>0)&& (strlen($user->datebirth)>0)&&(strlen($user->sex)>0)) text-muted @else  text-danger  @endif" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                                <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z"/>
                            </svg>
                        </div>
                    </a>
                </div>
                <div class="card-body collapse" id="infoProfile">
                    <div class="row">
                        <div class="col-md-6 px-1">
                            <div class="form-group">
                                <label>نام</label>
                                <input type="text" class="form-control" placeholder="نام را وارد کنید" value="{{$user->fname}}" name="fname"   lang="fa" />
                            </div>
                        </div>
                        <div class="col-md-6 px-1">
                            <div class="form-group">
                                <label>نام خانوادگی</label>
                                <input type="text" class="form-control" placeholder="نام خانوادگی را وارد کنید" value="{{$user->lname}}" name="lname"  lang="fa" />
                            </div>
                        </div>
                        <div class="col-md-6 px-1">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">جنسیت</label>
                                <div class="form-group">
                                    <select class="form-control p-0" id="exampleFormControlSelect1" name="sex" >
                                        <option selected disabled>انتخاب کنید</option>
                                        <option value="0"  {{ $user->sex =="0" ? 'selected='.'"'.'selected'.'"' : '' }}>زن</option>
                                        <option value="1" {{ $user->sex =="1" ? 'selected='.'"'.'selected'.'"' : '' }}>مرد</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 px-1">
                            <div class="form-group">
                                <label for="codemelli">کد ملی</label>
                                <input type="text" class="form-control" placeholder="کد ملی را وارد کنید" value="{{$user->codemelli}}" id="codemelli" name="codemelli" {{strlen($user->codemelli)===0?"": "disabled" }} />
                            </div>
                        </div>
                        <div class="col-md-6 px-1">
                            <div class="form-group">
                                <label>شماره شناسنامه</label>
                                <input type="text" class="form-control" placeholder="شماره شناسنامه را وارد کنید" value="{{$user->shenasname}}" name="shenasname"  />
                            </div>
                        </div>
                        <div class="col-md-6 px-1">
                            <div class="form-group">
                                <label>تاریخ تولد</label>
                                <input type="text" class="form-control" placeholder="تاریخ تولد را وارد کنید" value="{{$user->datebirth}}" name="datebirth" id="datebirth" />
                            </div>
                        </div>
                        <div class="col-md-6 px-1">
                            <div class="form-group">
                                <label>عکس پروفایل</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="inputpersonal_image" aria-describedby="inputpersonal_image" name="personal_image"/>
                                    <label class="custom-file-label" for="inputpersonal_image">Choose file</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 px-1">
                            <div class="form-group">
                                <label>نام کاربری</label>
                                <input type="text" class="form-control" placeholder="نام کاربری خود را وارد کنید" value="{{$user->username}}" name="username" @if(strlen($user->username)>0) disabled @endif/>
                                <small class="text-muted  float-left" dir="ltr">crm.faracoach.com/نام کاربری شما</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-user">
                <div class="card-header bg-light">
                    <a type="button" class="row  border-bottom" data-toggle="collapse" data-target="#infoContact" aria-expanded="false" aria-controls="infoContact">
                        <div class="col-md-8">
                            <h6 class="card-title m-0 mb-3">اطلاعات تماس</h6>
                        </div>
                        <div class="col-md-4">
                            <svg class="float-left @if((strlen($user->tel)>0)&&(strlen($user->email)>0)&&(strlen($user->state)>0)&&(strlen($user->city)>0)&& (strlen($user->address)>0)) text-muted @else  text-danger  @endif" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
                            </svg>
                        </div>
                    </a>
                </div>
                <div class="card-body collapse" id="infoContact">
                    <div class="row">
                        <div class="col-md-6 px-1">
                            <div class="form-group">
                                <label>تلفن تماس</label>
                                <input type="text" class="form-control" placeholder="تلفن تماس را وارد کنید" value="{{$user->tel}}" name="tel" @if(strlen($user->tel)>0 ) disabled  @endif  />
                            </div>
                        </div>
                        <div class="col-md-6 pr-1">
                            <div class="form-group">
                                <label for="email">پست الکترونیکی</label>

                                <input type="email" class="form-control" placeholder="پست الکترونیکی را وارد کنید" value="{{$user->email}}" name="email"  id="email"  @if(strlen($user->email)>0) disabled  @endif />
                            </div>
                        </div>
                        <div class="col-md-6 pl-1">
                            <div class="form-group">
                                <label>استان</label>
                                <select class="custom-select"  name="state"  id="state">
                                    <option selected disabled>استان را انتخاب کنید</option>
                                    @foreach($states as $item)
                                        <option value="{{$item->id}}" @if($item->id==$user->state) selected @endif  >{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 px-1">
                            <div class="form-group">
                                <label>شهر</label>

                                <select class="custom-select"  name="city"  id="city">
                                    @if (!is_null($city))
                                        <option value="{{$city->id}}">@if(!is_null($city))  {{$city->name}}  @endif </option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 px-1">
                            <div class="form-group">
                                <label>آدرس</label>
                                <input type="text" class="form-control" placeholder="آدرس را وارد کنید" value="{{$user->address}}" name="address"  lang="fa" />
                            </div>
                        </div>
                        <div class="col-md-6 px-1">
                            <div class="form-group">
                                <label>اینستاگرام</label>
                                <input type="text" class="form-control" placeholder="صفحه اینستاگرام خود را وارد کنید" value="{{$user->instagram}}" name="instagram"  />
                            </div>
                        </div>
                        <div class="col-md-6 px-1">
                            <div class="form-group">
                                <label>تلگرام</label>
                                <input type="text" class="form-control" placeholder="آیدی تلگرام خود را وارد کنید" value="{{$user->telegram}}" name="telegram"  />
                            </div>
                        </div>
                        <div class="col-md-6 px-1">
                            <div class="form-group">
                                <label>لینکدین</label>
                                <input type="text" class="form-control" placeholder="آیدی لینکدین خود را وارد کنید" value="{{$user->linkedin}}" name="linkedin"  />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-user">
                <div class="card-header bg-light">
                    <a class="row border-bottom" type="button" data-toggle="collapse" data-target="#infoConstract" aria-expanded="false" aria-controls="infoConstract">
                        <div class="col-md-8">
                            <h6 class="card-title m-0 mb-3">اطلاعات قرارداد</h6>
                        </div>
                        <div class="col-md-4">
                            <svg class="float-left @if((strlen($user->father)>0)&&(strlen($user->married)>0)&&(strlen($user->born)>0)&& (strlen($user->education)>0)&& (strlen($user->reshteh)>0)&& (strlen($user->shenasnameh_image)>0)&& (strlen($user->cartmelli_image)>0)&& (strlen($user->education_image)>0)&& (strlen($user->job)>0)) text-muted @else  text-danger  @endif" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-text-fill" viewBox="0 0 16 16">
                                <path d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM5 4h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1zm-.5 2.5A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zM5 8h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1zm0 2h3a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1z"/>
                            </svg>
                        </div>
                    </a>
                </div>
                <div class="card-body collapse" id="infoConstract">
                    <div class="row">
                        <div class="col-12">
                            <div class="alert alert-warning" role="alert">
                                <small>این اطلاعات صرفاجهت عقد قراردادهای آموزشی و ارائه خدمات کوچینگ مورد نیاز است</small>
                            </div>
                        </div>
                        <div class="col-md-6 px-1">
                            <div class="form-group">
                                <label>نام پدر</label>
                                <input type="text" class="form-control" placeholder=" نام پدر را وارد کنید" value="{{$user->father}}" name="father"  lang="fa" />
                            </div>
                        </div>

                        <div class="col-md-6 px-1">
                            <div class="form-group">
                                <label>تاهل</label>
                                <div class="form-group">
                                    <select class="form-control p-0" id="exampleFormControlSelect1" name="married" >
                                        <option selected disabled>انتخاب کنید</option>
                                        <option value="0" {{ $user->married =="0" ? 'selected='.'"'.'selected'.'"' : '' }}>مجرد</option>
                                        <option value="1" {{ $user->married =="1" ? 'selected='.'"'.'selected'.'"' : '' }}>متاهل</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 pl-1">
                            <div class="form-group">
                                <label>شهر تولد</label>
                                <input type="text" class="form-control" placeholder="شهر تولد را وارد کنید" value="{{$user->born}}" name="born"   lang="fa"/>
                            </div>
                        </div>
                        <div class="col-md-6 px-1">
                            <div class="form-group">
                                <label>تحصیلات</label>
                                <select id="education" class="form-control p-0 @error('education') is-invalid @enderror" name="education">
                                    <option selected disabled>انتخاب کنید</option>
                                    <option {{ $user->education =="زیردیپلم" ? 'selected='.'"'.'selected'.'"' : '' }}>زیردیپلم</option>
                                    <option {{ $user->education =="دیپلم" ? 'selected='.'"'.'selected'.'"' : '' }}>دیپلم</option>
                                    <option {{ $user->education =="فوق دیپلم" ? 'selected='.'"'.'selected'.'"' : '' }}>فوق دیپلم</option>
                                    <option {{ $user->education =="لیسانس" ? 'selected='.'"'.'selected'.'"' : '' }}>لیسانس</option>
                                    <option {{ $user->education =="فوق لیسانس" ? 'selected='.'"'.'selected'.'"' : '' }}>فوق لیسانس</option>
                                    <option {{ $user->education =="دکتری و بالاتر" ? 'selected='.'"'.'selected'.'"' : '' }}>دکتری و بالاتر</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 pr-1">
                            <div class="form-group">
                                <label>رشته</label>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="رشته را وارد کنید" value="{{$user->reshteh}}" name="reshteh"   lang="fa"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 pr-1">
                            <div class="form-group">
                                <label>شغل</label>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="شغل را وارد کنید" value="{{$user->job}}" name="job" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 px-1">
                            <div class="form-group">
                                <label>عکس شناسنامه</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="inputshenasnameh_image" aria-describedby="inputshenasnameh_image" name="shenasnameh_image" />
                                    <label class="custom-file-label" for="inputshenasnameh_image">Choose file</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 px-1">
                            <div class="form-group">
                                <label>عکس کارت ملی</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="inputcartmelli_image" aria-describedby="inputcartmelli_image" name="cartmelli_image">
                                    <label class="custom-file-label" for="inputcartmelli_image">Choose file</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 px-1">
                            <div class="form-group">
                                <label>عکس مدرک تحصیلی</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="inputeducation_image" aria-describedby="inputeducation_image" name="education_image" />
                                    <label class="custom-file-label" for="inputeducation_image">Choose file</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 px-1">
                            <div class="form-group">
                                <label>رزومه</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="resume" aria-describedby="resume" name="resume" />
                                    <label class="custom-file-label" for="resume">Choose file</label>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="card card-user">
                <div class="card-header bg-light">
                    <a class="row border-bottom" type="button" data-toggle="collapse" data-target="#infogettingKnow" aria-expanded="false" aria-controls="infogettingKnow">
                        <div class="col-8">
                            <h6 class="card-title m-0 mb-3">آشنایی</h6>
                        </div>
                        <div class="col-4">
                            <svg class="float-left @if((strlen($user->gettingknow)>0)&&(strlen($user->introduced)>0)&&(strlen($user->resource)>0)&&(strlen($user->detailsresource)>0)) text-muted @else  text-danger  @endif" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-person" viewBox="0 0 16 16">
                                <path d="M12 1a1 1 0 0 1 1 1v10.755S12 11 8 11s-5 1.755-5 1.755V2a1 1 0 0 1 1-1h8zM4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4z"/>
                                <path d="M8 10a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                            </svg>
                        </div>
                    </a>
                </div>
                <div class="card-body collapse " id="infogettingKnow">
                    <div class="row">
                        <div class="col-md-6 px-1">
                            <div class="form-group">
                                <label>نحوه آشنایی</label>
                                <select id="gettingknow" class="form-control p-0 @error('gettingknow') is-invalid @enderror" name="gettingknow">
                                    <option selected disabled>انتخاب کنید</option>
                                    <option {{ $user->gettingknow =="اینستاگرام" ? 'selected='.'"'.'selected'.'"' : '' }}>اینستاگرام</option>
                                    <option {{ $user->gettingknow =="تلگرام" ? 'selected='.'"'.'selected'.'"' : '' }}>تلگرام</option>
                                    <option {{ $user->gettingknow =="تبلیغاتی محیطی" ? 'selected='.'"'.'selected'.'"' : '' }}>تبلیغاتی محیطی</option>
                                    <option {{ $user->gettingknow =="تبلیغات فضای مجازی" ? 'selected='.'"'.'selected'.'"' : '' }}>تبلیغات فضای مجازی</option>
                                    <option {{ $user->gettingknow =="پکیج رایگان" ? 'selected='.'"'.'selected'.'"' : '' }}>پکیج رایگان</option>
                                    <option {{ $user->gettingknow =="واتساپ" ? 'selected='.'"'.'selected'.'"' : '' }}>واتساپ</option>
                                    <option {{ $user->gettingknow =="موتورهای جستجو" ? 'selected='.'"'.'selected'.'"' : '' }}>موتورهای جستجو</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 px-1">
                            <div class="form-group">
                                <label>معرف</label>
                                <input type="text" class="form-control" value="{{$user->introduced }}"  id="introduced" />
                                <span id="feedback_introduced" ></span>
                            </div>
                        </div>
                        <div class="col-md-6 px-1">
                            <div class="form-group">
                                <label>نحوه ورود به فراکوچ</label>
                                <input type="text" class="form-control" disabled="disabled"  value="{{$user->resource}}" name="resource"  lang="fa" />
                            </div>
                        </div>
                        <div class="col-md-6 px-1">
                            <div class="form-group">
                                <label>عنوان ورود</label>
                                <div class="form-group">
                                    <input type="text" class="form-control" disabled="disabled" value="{{$user->detailsresource}}" name="detailsresource"   lang="fa"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="update m-auto m-auto">
                    <button type="submit" class="btn btn-primary btn-round">بروزرسانی اطلاعات</button>
                </div>
            </div>
        </form>
        @include('panelAdmin.boxMadarak')
        @include('panelAdmin.listIntroducedUser')
        @include('panelAdmin.boxAmoozeshi')

    </div>
    <div class="col-md-8">
        @if((Auth::user()->id==$user->followby_expert)||(is_null($user->followby_expert)))
            @include('panelAdmin.insertFollowUp')
            <hr/>
        @endif
        @include('panelAdmin.followups')
    </div>
@endsection

@section('footerScript')
    <!--  DATE SHAMSI PICKER  --->
    <script src="{{asset('js/kamadatepicker.min.js')}}"></script>
    <script src="{{asset('js/kamadatepicker.holidays.js')}}"></script>
    <script>

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
    <!-- ****************  -->
    <script src="{{asset('js/timepicker.js')}}"></script>
    <script>
        $(document).ready(function()
        {
            jQuery.noConflict();
            jQuery('#time_fa').timepicker();
        });
    </script>
@endsection
