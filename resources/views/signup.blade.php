@extends('master.index')
@section('row1')
    <div class="container" id="form_signup_crm">
        <div class="stepwizard">
            <div class="stepwizard-row setup-panel">
                <div class="stepwizard-step col-xs-3">
                    <a href="#step-1" type="button" class="btn btn-success btn-circle">1</a>
                    <p class="mr-5"><small>توضیحات</small></p>
                </div>
                <div class="stepwizard-step col-xs-3">
                    <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                    <p><small>اطلاعات شخصی</small></p>
                </div>
                <div class="stepwizard-step col-xs-3">
                    <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                    <p><small>اطلاعات کاربری</small></p>
                </div>
                <div class="stepwizard-step col-xs-3">
                    <a href="#step-4" type="button" class="btn btn-default btn-circle" disabled="disabled">4</a>
                    <p><small>سکونت</small></p>
                </div>
                <div class="stepwizard-step col-xs-3">
                    <a href="#step-4" type="button" class="btn btn-default btn-circle" disabled="disabled">4</a>
                    <p><small>نحوه آشنایی</small></p>
                </div>
                <div class="stepwizard-step col-xs-3">
                    <a href="#step-5" type="button" class="btn btn-default btn-circle" disabled="disabled">5</a>
                    <p><small>مدارک</small></p>
                </div>
                <!--
                <div class="stepwizard-step col-xs-3">
                    <a href="#step-6" type="button" class="btn btn-default btn-circle" disabled="disabled">6</a>
                    <p><small>اطلاعات کاربری</small></p>
                </div>
                <div class="stepwizard-step col-xs-3">
                    <a href="#step-7" type="button" class="btn btn-default btn-circle" disabled="disabled">7</a>
                    <p><small>قوانین</small></p>
                </div>
                -->
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-6 col-lg-6">
            @if(session('msg') && (session('errorStatus')))
               <div class="alert alert-{{session('errorStatus')}}">
                    <p>{{session('msg')}}</p>
               </div>
            @endif
            @if($errors->any())
                @foreach($errors->all() as $item)
                    <div class="alert alert-danger">
                        <li>{{$item}}</li>
                    </div>
                @endforeach
            @endif
            <form role="form" method="POST" action="/crm/user/insert" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="panel panel-primary setup-content" id="step-1">
                    <div class="panel-heading">
                        <h3 class="panel-title">توضیحات</h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <p>توضیحات مربوط به فرم در این مکان درج خواهد شد</p>
                        </div>

                        <button class="btn btn-primary nextBtn pull-right" type="button">مرحله بعد</button>
                    </div>
                </div>

                <div class="panel panel-primary setup-content" id="step-2">
                    <div class="panel-heading">
                        <h3 class="panel-title">اطلاعات شخصی</h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="control-label">نام:*</label>
                            <input maxlength="20" type="text" required="required" class="form-control" placeholder="لطفا نام را وارد کنید" name="fname"   value="{{old('fname')}}" />
                        </div>
                        <div class="form-group">
                            <label class="control-label">نام خانوادگی:*</label>
                            <input maxlength="50" type="text" required="required" class="form-control" placeholder="نام خانوادگی را وارد کنید"  name="lname"  value="{{old('lname')}}" />
                        </div>
                        <div class="form-group">
                            <label class="control-label">جنسیت:*</label>
                            <div class="custom-control custom-radio d-inline">
                                <input type="radio" id="sexRadio1" name="sex" class="custom-control-input" value="1" required="required" {{ old('sex')=="1" ? 'checked='.'"'.'checked'.'"' : '' }}/>
                                <label class="custom-control-label" for="sexRadio1">آقا</label>
                            </div>
                            <div class="custom-control custom-radio d-inline">
                                <input type="radio" id="sexRadio2" name="sex" class="custom-control-input" value="0"  {{ old('sex')=="0" ? 'checked='.'"'.'checked'.'"' : '' }} />
                                <label class="custom-control-label" for="sexRadio2">خانم</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">کد ملی:*</label>
                            <input maxlength="15" type="text" required="required" class="form-control" placeholder="کد ملی را وارد کنید" name="codemelli" value="{{old('codemelli')}}" />
                        </div>

                        <div class="form-group">
                            <label class="control-label">شماره همراه*:</label>
                            <input maxlength="20" type="text"  class="form-control" placeholder="تلفن همراه را وارد کنید"  name="tel"  value="{{old('tel')}}" />
                        </div>

                        <button class="btn btn-primary nextBtn pull-right" type="button">مرحله بعد</button>
                    </div>
                </div>

                <div class="panel panel-primary setup-content" id="step-3">
                    <div class="panel-heading">
                        <h3 class="panel-title">اطلاعات کاربری</h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="control-label">پست الکترونیکی:*</label>
                            <input  type="email" class="form-control" placeholder="لطفا پست الکترونیکی را وارد کنید" name="email" required="required" value="{{old('user_email')}}" />
                        </div>
                        <div class="form-group">
                            <label class="control-label">رمز عبور:*</label>
                            <input type="password" class="form-control" placeholder="رمز عبور را وارد کنید"  name="password" required="required"   />
                        </div>
                        <div class="form-group">
                            <label class="control-label">تکرار رمز عبور:*</label>
                            <input type="password" class="form-control" placeholder="رمز عبور را تکرار کنید" name="repassword" required="required" />
                        </div>
                    </div>




                    <!--
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="control-label">مقطع تحصیلی:*</label>
                            <select class="custom-select" required="required" name="education">
                                <option selected disabled>تعیین مقطع تحصیلی</option>
                                <option value="سیکل" {{ old('education')=="سیکل" ? 'selected='.'"'.'selected'.'"' : '' }}>سیکل</option>
                                <option value="دیپلم" {{ old('education')=="دیپلم" ? 'selected='.'"'.'selected'.'"' : '' }}>دیپلم</option>
                                <option value="فوق دیپلم" {{ old('education')=="فوق دیپلم" ? 'selected='.'"'.'selected'.'"' : '' }}>فوق دیپلم</option>
                                <option value="لیسانس" {{ old('education')=="لیسانس" ? 'selected='.'"'.'selected'.'"' : '' }}>لیسانس</option>
                                <option value="فوق لیسانس" {{ old('education')=="فوق لیسانس" ? 'selected='.'"'.'selected'.'"' : '' }}>فوق لیسانس</option>
                                <option value="دکتری و بالاتر" {{ old('education')=="دکتری و بالاتر" ? 'selected='.'"'.'selected'.'"' : '' }}>دکتری و بالاتر</option>
                            </select>

                        </div>
                        <div class="form-group">
                            <label class="control-label">رشته تحصیلی:</label>
                            <input maxlength="50" type="text"  class="form-control" placeholder="رشته تحصیلی را وارد کنید" name="reshteh"  value="{{old('reshteh')}}" />
                        </div>-->
                        <button class="btn btn-primary nextBtn pull-right" type="button">مرحله بعد</button>
                    </div>
                </div>

                <div class="panel panel-primary setup-content" id="step-4">
                    <div class="panel-heading">
                        <h3 class="panel-title">مدارک</h3>
                    </div>
                    <div class="panel-body">
                        <div class="input-group mb-3 col-md-6">
                            <input type="text" class="form-control" >
                            <div class="input-group-prepend">
                              <button class="btn btn-outline-secondary" type="button" id="introduced_verify">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-binoculars-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4.5 1A1.5 1.5 0 0 0 3 2.5V3h4v-.5A1.5 1.5 0 0 0 5.5 1h-1zM7 4v1h2V4h4v.882a.5.5 0 0 0 .276.447l.895.447A1.5 1.5 0 0 1 15 7.118V13H9v-1.5a.5.5 0 0 1 .146-.354l.854-.853V9.5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v.793l.854.853A.5.5 0 0 1 7 11.5V13H1V7.118a1.5 1.5 0 0 1 .83-1.342l.894-.447A.5.5 0 0 0 3 4.882V4h4zM1 14v.5A1.5 1.5 0 0 0 2.5 16h3A1.5 1.5 0 0 0 7 14.5V14H1zm8 0v.5a1.5 1.5 0 0 0 1.5 1.5h3a1.5 1.5 0 0 0 1.5-1.5V14H9zm4-11H9v-.5A1.5 1.5 0 0 1 10.5 1h1A1.5 1.5 0 0 1 13 2.5V3z"/>
                                </svg>
                              </button>
                            </div>
                          </div>
                    </div>
                </div>



                <div class="panel panel-primary setup-content" id="step-5">
                    <div class="panel-heading">
                        <h3 class="panel-title">مدارک</h3>
                    </div>
                    <div class="panel-body">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupupload_pic">عکس پرسنلی</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="upload_pic" aria-describedby="inputGroupupload_pic" name="personal_image" />
                                <label class="custom-file-label" for="upload_pic">بارگذاری عکس</label>
                            </div>
                        </div>
                        <!--
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupupload_shenasname">عکس شناسنامه</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="upload_shenasname" aria-describedby="inputGroupupload_shenasname" name="shenasnameh_image" />
                                <label class="custom-file-label" for="upload_shenasname">بارگذاری شناسنامه</label>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupupload_cardmelli">عکس کارت ملی</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="upload_cardmelli" aria-describedby="inputGroupupload_cardmelli" name="cartmelli_image" />
                                <label class="custom-file-label" for="upload_cardmelli">بارگذاری کارت ملی</label>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupupload_tahsili">عکس آخرین مدرک تحصیلی</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="upload_tahsili" aria-describedby="inputGroupupload_tahsili" name="education_image" />
                                <label class="custom-file-label" for="upload_tahsili">بارگذاری آخرین مدرک تحصیلی</label>
                            </div>
                        </div>
                        -->
                        <button class="btn btn-primary nextBtn pull-right" type="button">مرحله بعد</button>
                    </div>
                </div>

                <!--
                <div class="panel panel-primary setup-content" id="step-4">
                    <div class="form-group">
                        <label class="control-label">شماره شناسنامه:</label>
                        <input maxlength="15" type="text"  class="form-control" placeholder="شماره شناسنامه را وارد کنید"  name="shenasname" value="{{old('shenasname')}}"/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">نام پدر:</label>
                        <input maxlength="20" type="text" class="form-control" placeholder="نام پدر را وارد کنید" name="father" value="{{old('father')}}" />
                    </div>
                    <div class="form-group">
                        <label class="control-label">محل تولد:</label>
                        <input maxlength="50" type="text"  class="form-control" placeholder="محل تولد را وارد کنید" name="born" value="{{old('born')}}" />
                    </div>

                    <div class="form-group">
                        <label class="control-label">وضعیت تاهل:</label>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="customRadio1" name="married" class="custom-control-input" value="0" {{ old('married')=="0" ? 'checked='.'"'.'checked'.'"' : '' }} />
                            <label class="custom-control-label" for="customRadio1">مجرد</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="customRadio2" name="married" class="custom-control-input" value="1" {{ old('married')=="1" ? 'checked='.'"'.'checked'.'"' : '' }} />
                            <label class="custom-control-label" for="customRadio2">متاهل</label>
                        </div>
                    </div>

                    <div class="panel-heading">
                        <h3 class="panel-title">سکونت</h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="control-label">استان*</label>
                            <select class="custom-select" required="required" name="state">
                                <option selected disabled>استان سکونت</option>
                                <option value="تهران" {{ old('education')=="تهران" ? 'selected='.'"'.'selected'.'"' : '' }}>تهران</option>
                                <option value="خراسان رضوی" {{ old('education')=="خراسان رضوی" ? 'selected='.'"'.'selected'.'"' : '' }}>خراسان رضوی</option>
                                <option value="خراسان جنوبی" {{ old('education')=="خراسان جنوبی" ? 'selected='.'"'.'selected'.'"' : '' }}>خراسان جنوبی</option>
                                <option value="خراسان شمالی" {{ old('education')=="خراسان شمالی" ? 'selected='.'"'.'selected'.'"' : '' }}>خراسان شمالی</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">شهر*</label>
                            <input maxlength="50" type="text" class="form-control" placeholder="شهر سکونت را وارد کنید" name="city" required="required" value="{{old('city')}}" />
                        </div>
                        <div class="form-group">
                            <label class="control-label">آدرس*</label>
                            <input maxlength="50" type="text" class="form-control" placeholder="آدرس سکونت را وارد کنید" name="address" required="required" value="{{old('address')}}"  />
                        </div>
                        <button class="btn btn-primary nextBtn pull-right" type="button">مرحله بعد</button>
                    </div>
                </div>



                <div class="panel panel-primary setup-content" id="step-6">
                    <div class="panel-heading">
                        <h3 class="panel-title">اطلاعات شخصی</h3>
                    </div>
                    <div class="panel-body">


                        <button class="btn btn-primary nextBtn pull-right" type="button">مرحله بعد</button>
                    </div>
                </div>
                -->
                <div class="panel panel-primary setup-content" id="step-5">
                    <div class="panel-heading">
                        <h3 class="panel-title">قوانین و موافقت نامه</h3>
                    </div>
                    <div class="panel-body">
                        <p>قوانین و موافقت نامه</p>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1" name="rules" />
                            <label class="form-check-label" for="inlineCheckbox1">قوانین را کامل و با دقت مطالعه کردم و موافقم</label>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary nextBtn pull-right" type="submit">ثبت نام</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection


