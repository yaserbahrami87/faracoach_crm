@extends('user.master.index')
@section('content')
    <div class="col-md-12">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-toggle="tab" data-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">توضیحات</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-toggle="tab" data-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">اطلاعات کاربر</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="contact-tab" data-toggle="tab" data-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Contact</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="card-body" id="frmSearchUserAdmin">

                    </div>

            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <form method="post" action="/admin/profile/update/{{$scholarship->user->id}}" enctype="multipart/form-data">
                    {{csrf_field()}}
                    {{method_field('PATCH')}}
                    <div class="card">
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
                            <div class="card-body collapse bg-secondary-light border-1 border-secondary" id="infoProfile">
                                <div class="row">
                                    <div class="col-md-6 px-1">
                                        <div class="form-group">
                                            <label>نام</label>
                                            <input type="text" class="form-control @if(strlen($scholarship->user->fname)==0) is-invalid  @else is-valid  @endif" placeholder="نام را وارد کنید"  value='{{old('fname',$scholarship->user->fname)}}'  name="fname"  />
                                        </div>
                                    </div>
                                    <div class="col-md-6 px-1">
                                        <div class="form-group">
                                            <label>نام خانوادگی</label>
                                            <input type="text" class="form-control @if(strlen($scholarship->user->lname)==0) is-invalid  @else is-valid  @endif" placeholder="نام خانوادگی را وارد کنید" value='{{old('lname',$scholarship->user->lname)}}'  name="lname"  lang="fa" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 px-1">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">جنسیت</label>
                                            <div class="form-group">
                                                <select class="form-control p-0 @if(strlen($scholarship->user->sex)==0) is-invalid  @else is-valid  @endif" id="exampleFormControlSelect1" name="sex" >
                                                    <option selected disabled>انتخاب کنید</option>
                                                    <option value="0"  {{ old('sex',$scholarship->user->sex)=="0" ? 'selected='.'"'.'selected'.'"' : '' }}  >زن</option>
                                                    <option value="1"  {{ old('sex',$scholarship->user->sex)=="1" ? 'selected='.'"'.'selected'.'"' : '' }}>مرد</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 px-1">
                                        <div class="form-group">
                                            <label for="codemelli">کد ملی</label>
                                            <input type="text" class="form-control @if(strlen($scholarship->user->codemelli)==0) is-invalid  @else is-valid  @endif" placeholder="کد ملی را وارد کنید" value='{{old('codemelli',$scholarship->user->codemelli)}}'  id="codemelli" name="codemelli" {{strlen($scholarship->user->codemelli)===0?"": "disabled" }} />
                                        </div>
                                    </div>
                                    <div class="col-md-6 px-1">
                                        <div class="form-group">
                                            <label>شماره شناسنامه</label>
                                            <input type="text" class="form-control @if(strlen($scholarship->user->shenasname)==0) is-invalid  @else is-valid  @endif" placeholder="شماره شناسنامه را وارد کنید"  value='{{old('shenasname',$scholarship->user->shenasname)}}' name="shenasname"  />
                                        </div>
                                    </div>
                                    <div class="col-md-6 px-1">
                                        <div class="form-group">
                                            <label>تاریخ تولد</label>
                                            <input type="text" class="form-control @if(strlen($scholarship->user->datebirth)==0) is-invalid  @else is-valid  @endif" placeholder="تاریخ تولد را وارد کنید" value='{{old('datebirth',$scholarship->user->datebirth)}}' name="datebirth" id="datebirth" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 px-1">
                                        <div class="form-group">
                                            <label>عکس پروفایل</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input @if(strlen($scholarship->user->personal_image)==0) is-invalid  @else is-valid  @endif" id="inputpersonal_image" name="personal_image"/>
                                                <label class="custom-file-label" for="inputpersonal_image">انتخاب فایل</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 px-1">
                                        <div class="form-group">
                                            <label>نام کاربری</label>
                                            <input type="text" class="form-control @if(strlen($scholarship->user->username)==0) is-invalid  @else is-valid  @endif" placeholder="نام کاربری خود را وارد کنید" value='{{old('username',$scholarship->user->username)}}' name="username" @if(strlen($scholarship->user->username)>0) disabled @endif/>
                                            <small class="text-muted  float-left" dir="ltr">نام کاربری شما</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                            <div class="card-body collapse bg-secondary-light border-1 border-secondary" id="infoContact">
                                <div class="row">
                                    <div class="col-md-6 px-1">
                                        <div class="form-group">
                                            <label>تلفن تماس</label>
                                            <input type="hidden" id="tel_org" value="{{old('tel',$scholarship->user->tel)}}" name="tel"/>
                                            <input type="tel" class="form-control @if(strlen($scholarship->user->tel)==0) is-invalid  @else is-valid  @endif" placeholder="تلفن تماس را وارد کنید" value='{{old('tel',$scholarship->user->tel)}}'  id="tel"  @if(strlen($scholarship->user->tel)>0 ) disabled  @endif  />
                                        </div>
                                    </div>
                                    <div class="col-md-6 pr-1">
                                        <div class="form-group">
                                            <label for="email">پست الکترونیکی</label>
                                            <input type="email" class="form-control @if(strlen($scholarship->user->email)==0) is-invalid  @else is-valid  @endif" placeholder="پست الکترونیکی را وارد کنید" value='{{old('email',$scholarship->user->email)}}' name="email"  id="email"  @if(strlen($scholarship->user->email)>0) disabled  @endif />
                                        </div>
                                    </div>
                                    <div class="col-md-6 pl-1">
                                        <div class="form-group">
                                            <label>استان</label>
                                            <select class="custom-select @if(strlen($scholarship->user->state)==0) is-invalid  @else is-valid  @endif"  name="state"  id="state">
                                                <option selected disabled>استان را انتخاب کنید</option>
                                                @foreach($states as $item)
                                                    <option value="{{$item->id}}"   {{ old('state',$scholarship->user->state)==$item->id ? 'selected='.'"'.'selected'.'"' : '' }} >{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 px-1">
                                        <div class="form-group">
                                            <label>شهر</label>

                                            <select class="custom-select @if(strlen($scholarship->user->city)==0) is-invalid  @else is-valid  @endif"  name="city"  id="city">
                                                @if (!is_null($city))
                                                    <option value="{{$city->id}}">@if(!is_null($city))  {{$city->name}}  @endif </option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 px-1">
                                        <div class="form-group">
                                            <label>آدرس</label>
                                            <input type="text" class="form-control @if(strlen($scholarship->user->address)==0) is-invalid  @else is-valid  @endif" placeholder="آدرس را وارد کنید"  value='{{old('address',$scholarship->user->address)}}' name="address"  lang="fa" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 px-1">
                                        <div class="form-group">
                                            <label>اینستاگرام</label>
                                            <input type="text" class="form-control @if(strlen($scholarship->user->instagram)==0) is-invalid  @else is-valid  @endif" placeholder="صفحه اینستاگرام خود را وارد کنید"  value='{{old('instagram',$scholarship->user->instagram)}}' name="instagram"  />
                                        </div>
                                    </div>
                                    <div class="col-md-6 px-1">
                                        <div class="form-group">
                                            <label>تلگرام</label>
                                            <input type="text" class="form-control @if(strlen($scholarship->user->telegram)==0) is-invalid  @else is-valid  @endif" placeholder="آیدی تلگرام خود را وارد کنید" value='{{old('telegram',$scholarship->user->telegram)}}' name="telegram"  />
                                        </div>
                                    </div>
                                    <div class="col-md-6 px-1">
                                        <div class="form-group">
                                            <label>لینکدین</label>
                                            <input type="text" class="form-control @if(strlen($scholarship->user->linkedin)==0) is-invalid  @else is-valid  @endif" placeholder="آیدی لینکدین خود را وارد کنید"  value='{{old('linkedin',$scholarship->user->linkedin)}}' name="linkedin"  />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                            <div class="card-body collapse bg-secondary-light border-1 border-secondary" id="infoConstract">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="alert alert-warning" role="alert">
                                            <small>این اطلاعات صرفاجهت عقد قراردادهای آموزشی و ارائه خدمات کوچینگ مورد نیاز است</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6 px-1">
                                        <div class="form-group">
                                            <label>نام پدر</label>
                                            <input type="text" class="form-control @if(strlen($scholarship->user->father)==0) is-invalid  @else is-valid  @endif" placeholder=" نام پدر را وارد کنید"  value='{{old('father',$scholarship->user->father)}}'  name="father" />
                                        </div>
                                    </div>

                                    <div class="col-md-6 px-1">
                                        <div class="form-group">
                                            <label>تاهل</label>
                                            <div class="form-group">
                                                <select class="form-control p-0 @if(strlen($scholarship->user->married)==0) is-invalid  @else is-valid  @endif" id="exampleFormControlSelect1" name="married" >
                                                    <option selected disabled>انتخاب کنید</option>
                                                    <option value="0" {{ old('married',$scholarship->user->married)=="0" ? 'selected='.'"'.'selected'.'"' : '' }} >مجرد</option>
                                                    <option value="1" {{ old('married',$scholarship->user->married)=="1" ? 'selected='.'"'.'selected'.'"' : '' }} >متاهل</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 pl-1">
                                        <div class="form-group">
                                            <label>شهر تولد</label>
                                            <input type="text" class="form-control @if(strlen($scholarship->user->born)==0) is-invalid  @else is-valid  @endif" placeholder="شهر تولد را وارد کنید"  value='{{old('born',$scholarship->user->born)}}' name="born" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 px-1">
                                        <div class="form-group">
                                            <label>تحصیلات</label>
                                            <select id="education" class="form-control p-0 @if(strlen($scholarship->user->education)==0) is-invalid  @else is-valid  @endif  @error('education') is-invalid @enderror" name="education">
                                                <option selected disabled>انتخاب کنید</option>
                                                <option {{ old('education',$scholarship->user->education)=="زیردیپلم" ? 'selected='.'"'.'selected'.'"' : '' }}   >زیردیپلم</option>
                                                <option {{ old('education',$scholarship->user->education)=="دیپلم" ? 'selected='.'"'.'selected'.'"' : '' }}>دیپلم</option>
                                                <option {{ old('education',$scholarship->user->education)=="فوق دیپلم" ? 'selected='.'"'.'selected'.'"' : '' }}>فوق دیپلم</option>
                                                <option {{ old('education',$scholarship->user->education)=="لیسانس" ? 'selected='.'"'.'selected'.'"' : '' }}>لیسانس</option>
                                                <option {{ old('education',$scholarship->user->education)=="فوق لیسانس" ? 'selected='.'"'.'selected'.'"' : '' }}>فوق لیسانس</option>
                                                <option {{ old('education',$scholarship->user->education)=="دکتری و بالاتر" ? 'selected='.'"'.'selected'.'"' : '' }}>دکتری و بالاتر</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 pr-1">
                                        <div class="form-group">
                                            <label>رشته</label>
                                            <div class="form-group">
                                                <input type="text" class="form-control @if(strlen($scholarship->user->reshteh)==0) is-invalid  @else is-valid  @endif" placeholder="رشته را وارد کنید" value='{{old('reshteh',$scholarship->user->reshteh)}}'  name="reshteh"  />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 pr-1">
                                        <div class="form-group">
                                            <label>شغل</label>
                                            <div class="form-group">
                                                <input type="text" class="form-control @if(strlen($scholarship->user->job)==0) is-invalid  @else is-valid  @endif" placeholder="شغل را وارد کنید" value='{{old('job',$scholarship->user->job)}}'  name="job" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 px-1">
                                        <div class="form-group">
                                            <label>عکس شناسنامه</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input @if(strlen($scholarship->user->shenasnameh_image)==0) is-invalid  @else is-valid  @endif" id="inputshenasnameh_image" aria-describedby="inputshenasnameh_image" name="shenasnameh_image" />
                                                <label class="custom-file-label" for="inputshenasnameh_image">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 px-1">
                                        <div class="form-group">
                                            <label>عکس کارت ملی</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input @if(strlen($scholarship->user->cartmelli_image)==0) is-invalid  @else is-valid  @endif" id="inputcartmelli_image" aria-describedby="inputcartmelli_image" name="cartmelli_image">
                                                <label class="custom-file-label" for="inputcartmelli_image">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 px-1">
                                        <div class="form-group">
                                            <label>عکس مدرک تحصیلی</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input @if(strlen($scholarship->user->education_image)==0) is-invalid  @else is-valid  @endif" id="inputeducation_image" aria-describedby="inputeducation_image" name="education_image" />
                                                <label class="custom-file-label" for="inputeducation_image">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 px-1">
                                        <div class="form-group">
                                            <label>رزومه</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input @if(strlen($scholarship->user->resume)==0) is-invalid  @else is-valid  @endif " id="resume" aria-describedby="resume" name="resume" />
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
                            <div class="card-body collapse bg-secondary-light border-1 border-secondary " id="infogettingKnow">
                                <div class="row">
                                    <div class="col-md-6 px-1">
                                        <div class="form-group">
                                            <label>نحوه آشنایی</label>

                                            <select id="gettingknow_parent" class="form-control p-0 @if(strlen($scholarship->user->gettingknow)==0) is-invalid  @else is-valid  @endif  @error('gettingknow') is-invalid @enderror" name="gettingKnow_parent">
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
                                                <label>عنوان آشنایی</label>
                                                <select id="gettingknow" class="form-control p-0 @if(strlen($scholarship->user->gettingknow)==0) is-invalid  @else is-valid  @endif  @error('gettingknow') is-invalid @enderror" name="gettingknow">
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
                                                <select id="gettingknow" class="form-control p-0 @if(strlen($scholarship->user->gettingknow)==0) is-invalid  @else is-valid  @endif  @error('gettingknow') is-invalid @enderror" name="gettingknow">
                                                    <option selected disabled>انتخاب کنید</option>

                                                </select>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="col-md-6 px-1">
                                        <div class="form-group">
                                            <label>معرف</label>

                                            <input type="text" class="form-control @if(strlen($scholarship->user->introduced)==0) is-invalid  @else is-valid  @endif"  @if(!is_null($scholarship->user->getIntroduced))  value="{{$scholarship->user->getIntroduced->fname.' '.$scholarship->user->getIntroduced->lname }}" @endif  id="introduced" />
                                            <span id="feedback_introduced" ></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 px-1">
                                        <div class="form-group">
                                            <label>نحوه ورود به فراکوچ</label>
                                            <input type="text" class="form-control @if(strlen($scholarship->user->resource)==0) is-invalid  @else is-valid  @endif" disabled="disabled"  value="{{old('resource',$scholarship->user->resource)}}" name="resource"  />
                                        </div>
                                    </div>
                                    <div class="col-md-6 px-1">
                                        <div class="form-group">
                                            <label>عنوان ورود</label>
                                            <div class="form-group">
                                                <input type="text" class="form-control @if(strlen($scholarship->user->detailsresource)==0) is-invalid  @else is-valid  @endif" disabled="disabled" value="{{old('detailsresource',$scholarship->user->detailsresource)}} " name="detailsresource" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card">
                            <div class="card card-user">
                                <div class="card-header bg-light">
                                    <a type="button" class="row border-bottom" data-toggle="collapse" data-target="#infoscholarship" aria-expanded="false" aria-controls="infoscholarship">
                                        <div class="col-md-8">
                                            <h6 class="card-title m-0">بورسیه</h6>
                                        </div>

                                        <div class="col-md-4  text-right">
                                        </div>
                                    </a>
                                </div>
                                <div class="card-body collapse bg-secondary-light border-1 border-secondary" id="infoscholarship">
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



                                    <div class="form-group row">
                                        <label for="executive" class="col-md-4 col-form-label text-md-right">سوابق اجرایی خود را مرقوم فرمایید: <span class="text-danger">*</span></label>

                                        <div class="col-md-6">
                                            <input id="executive" type="text" class="form-control @error('executive') is-invalid @enderror"  name="executive"  required autocomplete="executive" autofocus  />

                                            @error('executive')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="introduce" class="col-md-4 col-form-label text-md-right">نام فردی را  که عضو هیئت علمی و یا دانشپذیر موسسه  فراکوچ است، به عنوان معرف درج کنید: </label>

                                        <div class="col-md-6">
                                            <input id="introduce" type="text" class="form-control @error('introduce') is-invalid @enderror"  name="introduce"    />

                                            @error('introduce')
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
                                                    <label class="custom-control-label" for="gender2" >سطح 2</label>
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
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row mb-1">
                        <div class="update m-auto m-auto">
                            <button type="submit" class="btn btn-primary btn-round">بروزرسانی اطلاعات</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
        </div>





    </div>



@endsection
