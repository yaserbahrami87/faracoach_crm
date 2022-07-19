@extends('admin.master.index')
@section('content')
    <div class="col-12 col-sm-12 col-md-3 col-lg-3 text-center ">
        @if(is_null($scholarship->user->personal_image))
            <img src="{{asset('/documents/users/default-avatar.png')}}" width="100px" height="100px"  class="rounded-circle border border-3"/>
        @else
            <img src="{{asset('/documents/users/'.$scholarship->user->personal_image)}}" width="100px" height="100px" class="rounded-circle border border-3 " />
        @endif
        <p>{{$scholarship->user->fname." ".$scholarship->user->lname}}</p>
    </div>
    <div class="col-12">
        <div class="row">
            <div class="col-4">
                <div class="card card-user">
                    <div class="card-header bg-light">
                        <a type="button" class="row border-bottom" data-toggle="collapse" data-target="#infoProfile" aria-expanded="false" aria-controls="infoProfile">
                            <div class="col-md-8">
                                <h6 class="card-title m-0">اطلاعات شخصی</h6>
                            </div>

                            <div class="col-md-4  text-right">
                                <svg  xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                                    <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z"/>
                                </svg>
                            </div>
                        </a>
                    </div>
                    <div class="card-body collapse bg-secondary-light border-1 border-secondary show" id="infoProfile">
                        <div class="row">
                            <div class="col-md-6 px-1">
                                <div class="form-group">
                                    <label>نام</label>
                                    <input type="text" class="form-control " placeholder="نام را وارد کنید"  value='{{old('fname',$scholarship->user->fname)}}'  name="fname"  disabled  />
                                </div>
                            </div>
                            <div class="col-md-6 px-1">
                                <div class="form-group">
                                    <label>نام خانوادگی</label>
                                    <input type="text" class="form-control " placeholder="نام خانوادگی را وارد کنید" value='{{old('lname',$scholarship->user->lname)}}'  name="lname"  disabled />
                                </div>
                            </div>
                            <div class="col-md-6 px-1">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">جنسیت</label>
                                    <div class="form-group">
                                        <select class="form-control p-0 " id="exampleFormControlSelect1" name="sex"  disabled>
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
                                    <input type="text" class="form-control " placeholder="کد ملی را وارد کنید" value='{{old('codemelli',$scholarship->user->codemelli)}}'  id="codemelli" name="codemelli" disabled />
                                </div>
                            </div>
                            <div class="col-md-6 px-1">
                                <div class="form-group">
                                    <label>شماره شناسنامه</label>
                                    <input type="text" class="form-control" placeholder="شماره شناسنامه را وارد کنید"  value='{{old('shenasname',$scholarship->user->shenasname)}}' name="shenasname"  disabled />
                                </div>
                            </div>
                            <div class="col-md-6 px-1">
                                <div class="form-group">
                                    <label>تاریخ تولد</label>
                                    <input type="text" class="form-control " placeholder="تاریخ تولد را وارد کنید" value='{{old('datebirth',$scholarship->user->datebirth)}}' name="datebirth" id="datebirth" disabled />
                                </div>
                            </div>

                            <div class="col-md-12 px-1">
                                <div class="form-group">
                                    <label>نام کاربری</label>
                                    <input type="text" class="form-control" placeholder="نام کاربری خود را وارد کنید" value='{{old('username',$scholarship->user->username)}}' name="username" disabled/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-4">
                <div class="card card-user ">
                    <div class="card-header bg-light">
                        <a type="button" class="row  border-bottom" data-toggle="collapse" data-target="#infoContact" aria-expanded="false" aria-controls="infoContact">
                            <div class="col-md-8">
                                <h6 class="card-title m-0">اطلاعات تماس</h6>
                            </div>
                            <div class="col-md-4 text-right">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
                                </svg>
                            </div>
                        </a>
                    </div>
                    <div class="card-body collapse bg-secondary-light border-1 border-secondary show" id="infoContact">
                        <div class="row">
                            <div class="col-md-6 px-1">
                                <div class="form-group">
                                    <label>تلفن تماس</label>
                                    <input type="hidden" id="tel_org" value="{{old('tel',$scholarship->user->tel)}}" name="tel"/>
                                    <input type="tel" class="form-control" placeholder="تلفن تماس را وارد کنید" value='{{old('tel',$scholarship->user->tel)}}'  id="tel"  disabled  />
                                </div>
                            </div>
                            <div class="col-md-6 pr-1">
                                <div class="form-group">
                                    <label for="email">پست الکترونیکی</label>
                                    <input type="email" class="form-control" placeholder="پست الکترونیکی را وارد کنید" value='{{old('email',$scholarship->user->email)}}' name="email"  id="email"  disabled />
                                </div>
                            </div>
                            <div class="col-md-6 pl-1">
                                <div class="form-group">
                                    <label>استان</label>
                                    <select class="custom-select"  name="state"  id="state" disabled>
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

                                    <select class="custom-select"  name="city"  id="city" disabled>
                                        @if (!is_null($city))
                                            <option value="{{$city->id}}">@if(!is_null($city))  {{$city->name}}  @endif </option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 px-1">
                                <div class="form-group">
                                    <label>آدرس</label>
                                    <input type="text" class="form-control" placeholder="آدرس را وارد کنید"  value='{{old('address',$scholarship->user->address)}}' name="address" disabled />
                                </div>
                            </div>
                            <div class="col-md-6 px-1">
                                <div class="form-group">
                                    <label>اینستاگرام</label>
                                    <input type="text" class="form-control" placeholder="صفحه اینستاگرام خود را وارد کنید"  value='{{old('instagram',$scholarship->user->instagram)}}' name="instagram" disabled />
                                </div>
                            </div>
                            <div class="col-md-6 px-1">
                                <div class="form-group">
                                    <label>تلگرام</label>
                                    <input type="text" class="form-control" placeholder="آیدی تلگرام خود را وارد کنید" value='{{old('telegram',$scholarship->user->telegram)}}' name="telegram" disabled />
                                </div>
                            </div>
                            <div class="col-md-6 px-1">
                                <div class="form-group">
                                    <label>لینکدین</label>
                                    <input type="text" class="form-control " placeholder="آیدی لینکدین خود را وارد کنید"  value='{{old('linkedin',$scholarship->user->linkedin)}}' name="linkedin" disabled />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card card-user">
                    <div class="card-header bg-light">
                        <a class="row border-bottom" type="button" data-toggle="collapse" data-target="#infoConstract" aria-expanded="false" aria-controls="infoConstract">
                            <div class="col-md-8">
                                <h6 class="card-title m-0">اطلاعات قرارداد</h6>
                            </div>
                            <div class="col-md-4 text-right">
                                <svg  xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-text-fill" viewBox="0 0 16 16">
                                    <path d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM5 4h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1zm-.5 2.5A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zM5 8h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1zm0 2h3a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1z"/>
                                </svg>
                            </div>
                        </a>
                    </div>
                    <div class="card-body collapse bg-secondary-light border-1 border-secondary show" id="infoConstract">
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-warning" role="alert">
                                    <small>این اطلاعات صرفاجهت عقد قراردادهای آموزشی و ارائه خدمات کوچینگ مورد نیاز است</small>
                                </div>
                            </div>
                            <div class="col-md-6 px-1">
                                <div class="form-group">
                                    <label>نام پدر</label>
                                    <input type="text" class="form-control " placeholder=" نام پدر را وارد کنید"  value='{{old('father',$scholarship->user->father)}}'  name="father" disabled />
                                </div>
                            </div>

                            <div class="col-md-6 px-1">
                                <div class="form-group">
                                    <label>تاهل</label>
                                    <div class="form-group">
                                        <select class="form-control p-0 " id="exampleFormControlSelect1" name="married" disabled >
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
                                    <input type="text" class="form-control" placeholder="شهر تولد را وارد کنید"  value='{{old('born',$scholarship->user->born)}}' name="born" disabled />
                                </div>
                            </div>
                            <div class="col-md-6 px-1">
                                <div class="form-group">
                                    <label>تحصیلات</label>
                                    <select id="education" class="form-control p-0 " name="education" disabled >
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
                                        <input type="text" class="form-control " placeholder="رشته را وارد کنید" value='{{old('reshteh',$scholarship->user->reshteh)}}'  name="reshteh" disabled  />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 pr-1">
                                <div class="form-group">
                                    <label>شغل</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control " placeholder="شغل را وارد کنید" value='{{old('job',$scholarship->user->job)}}'  name="job" disabled />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
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
                            <label for="target" class="col-md-4 col-form-label text-md-right">هدف شما از شرکت در دوره آموزش کوچینگ: <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <div class="input-group">
                                    <select id="target" class="form-control p-0 " name="target" disabled>
                                        <option {{ $scholarship->target==1 ? 'selected='.'"'.'selected'.'"' : '' }}   >برای توسعه مهارت فردی در زندگی و کسب و کار (اثرگذار باشم)</option>
                                        <option {{ $scholarship->target==2 ? 'selected='.'"'.'selected'.'"' : '' }}>میخواهم کوچ حرفه ای شوم (بعنوان شغل دوم و یا اصلی)</option>
                                        <option {{ $scholarship->target==3 ? 'selected='.'"'.'selected'.'"' : '' }}>در شغل و کسب و کار خودم از این مهارت استفاده کنم</option>
                                        <option {{ $scholarship->target==4 ? 'selected='.'"'.'selected'.'"' : '' }}>مایلم بعد از گذراندن دوره آموزشی با موسسه همکاری کنم</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="types" class="col-md-4 col-form-label text-md-right">به  کدام  حوزه اصلی کوچینگ علاقمندید: <span class="text-danger">*</span></label>
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
                            <label for="gettingknow" class="col-md-4 col-form-label text-md-right">میزان آشنایی شما با کوچینگ: <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <div class="input-group">
                                    <select id="gettingknow" class="form-control p-0  @error('gettingknow') is-invalid @enderror" name="gettingknow" disabled>
                                        <option selected disabled>انتخاب کنید</option>
                                        <option {{ $scholarship->gettingknow==1 ? 'selected='.'"'.'selected'.'"' : '' }}   >اطلاعات کامل دارم </option>
                                        <option {{ $scholarship->gettingknow==2 ? 'selected='.'"'.'selected'.'"' : '' }}>آگاهی محتصری دارم</option>
                                        <option {{ $scholarship->gettingknow==3 ? 'selected='.'"'.'selected'.'"' : '' }}>آشنایی ندارم</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">جهت افزایش کیفیت خدمات، توضیح بیشتری درباره خودتان و ویژگیها و توانمندی و علاقمندی خود مرقوم بفرمایید: </label>
                            <div class="col-md-6">
                                <textarea class="form-control" id="description" rows="3" name="description" disabled>{{$scholarship->description}}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="scientific" class="col-md-4 col-form-label text-md-right">سوابق علمی خود را مرقوم فرمایید: <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="scientific" type="text" class="form-control @error('scientific') is-invalid @enderror"  name="scientific"  value="{{$scholarship->scientific}}" disabled />

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
                                <input id="executive" type="text" class="form-control @error('executive') is-invalid @enderror"  name="executive" value="{{$scholarship->executive}}"  disabled />

                                @error('executive')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="introduce" class="col-md-4 col-form-label text-md-right">نام فردی را  که عضو هیئت علمی و یا دانشپذیر موسسه  فراکوچ است، به عنوان معرف درج کنید: <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="introduce" type="text" class="form-control @error('introduce') is-invalid @enderror"  name="introduce"  required value="{{$scholarship->introduce}}" disabled  />

                                @error('introduce')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="resume" class="col-md-4 col-form-label text-md-right">رزومه  خورد را بارگزاری نمایید: <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <a href="{{asset('/documents/scholarship/'.$scholarship->resume)}}">رزومه</a>
                                @error('resume')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>





            </div>
        </div>
    </div>


@endsection
