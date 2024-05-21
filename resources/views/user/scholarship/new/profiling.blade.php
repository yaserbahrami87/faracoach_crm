
<!-- multi step form -->
<div class="container">
        <div id="profiling">
            <form id="msform">
                <!-- start progressbar -->
                <ul id="progressbar">
                    <li class="active">اطلاعات شخصی</li>
                    <li>اطلاعات تماس</li>
                    <li>اطلاعات تکمیلی</li>
                    <li>اطلاعات آشنایی</li>
                </ul>
                <!-- end progressbar -->
                <!-- start step one form -->
                <fieldset>
                   <h2 class="fs-title">اطـلاعـات شخصـی</h2>

{{--                    <form method="post" action="/panel/profile/update/" enctype="multipart/form-data">--}}
{{--                        {{csrf_field()}}--}}
{{--                        {{method_field('PATCH')}}--}}
{{--                        <div class="col-12 col-md-6">--}}
{{--                            <div class="card card-user">--}}
                                <div class="" id="infoProfile">
                                    <div class="row">
                                        <div class="col-md-4 px-1">
                                            <div class="form-group">
                                                <label>
                                                    نام:
                                                    <span>*</span>
                                                </label>
                                                <input type="text" class="form-control " placeholder="نام را وارد کنید"  value=''  name="fname" required  />
                                            </div>
                                        </div>
                                        <div class="col-md-4 px-1">
                                            <div class="form-group">
                                                <label>نام خانوادگی:
                                                    <span>*</span>
                                                </label>
                                                <input type="text" class="form-control " placeholder="نام خانوادگی را وارد کنید" value=''  name="lname"  required />
                                            </div>
                                        </div>
                                        <div class="col-md-4 px-1">
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">جنسیت:
                                                    <span >*</span>
                                                </label>
                                                <div class="form-group">
                                                    <select class="form-control p-0 " id="exampleFormControlSelect1" name="sex" required >
                                                        <option selected disabled>انتخاب کنید</option>
                                                        <option value="0" >زن</option>
                                                        <option value="1" >مرد</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 px-1">
                                            <div class="form-group">
                                                <label>نام انگلیسی<span class=" font-weight-bold">*</span></label>
                                                <input type="text" class="form-control  " placeholder="نام انگلیسی را وارد کنید"   value=""  name="fname_en"  autocomplete="autocomplete"  />
                                            </div>
                                        </div>
                                        <div class="col-md-4 px-1">
                                            <div class="form-group">
                                                <label>نام خانوادگی انگلیسی<span class=" font-weight-bold">*</span></label>
                                                <input type="text" class="form-control " placeholder="نام خانوادگی انگلیسی را وارد کنید" value=""  name="lname_en"   autocomplete="autocomplete"/>
                                            </div>
                                        </div>
                                        <div class="col-md-4 px-1">
                                            <div class="form-group">
                                                <label>تاریخ تولد:
                                                    <span>*</span><small > نمونه:1365/01/01</small>
                                                </label>
                                                <input type="text" class="form-control " placeholder="تاریخ تولد را وارد کنید" value='' name="datebirth" id="datebirth" required />

                                            </div>
                                        </div>
                                        <div class="col-md-4 px-1">
                                            <div class="form-group">
                                                <label for="codemelli">کد ملی:
                                                    <span>*</span>
                                                </label>
                                                <input type="text" class="form-control" placeholder="کد ملی را وارد کنید" value=''  id="codemelli" name="codemelli"  required />
                                            </div>
                                        </div>
                                        <div class="col-md-4 px-1">
                                            <div class="form-group">
                                                <label>شماره شناسنامه:
                                                    <span >*</span>
                                                </label>
                                                <input type="number" class="form-control " placeholder="شماره شناسنامه را وارد کنید"  value='' name="shenasname" required  />

                                            </div>
                                        </div>
                                        <div class="col-md-6 px-1">
                                            <div class="form-group">
                                                <label>عکس پروفایل</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="inputpersonal_image" name="personal_image"/>
                                                    <label class="custom-file-label" for="inputpersonal_image">انتخاب فایل</label>
                                                </div>
                                                <small class="text-muted">فرمت فایل:jpg , jpeg , png  -;حجم حداکثر 600 کیلوبایت</small>
                                            </div>
                                        </div>
                                        <div class="col-md-1 px-1">
                                        </div>
                                        <div class="col-md-4 px-1 ">
                                            <div class="form-group">
                                                <label>عکس پروفایل</label>
                                                <div >
                                                    @if(is_null(Auth::user()->personal_image))
                                                          <img src="/documents/users/default-avatar.png" width="200px" />
                                                    @else
                                                          <img src="{{'/documents/users/thumbnail-'.Auth::user()->personal_image}}" width="200px" />
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 px-1">
                                            <div class="form-group">
                                                <label>رزومه:
                                                    <span >*</span>
                                                </label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input  " id="resume" aria-describedby="resume" name="resume" />
                                                    <label class="custom-file-label" for="resume">Choose file</label>
                                                </div>
                                                <small class="text-muted">فرمت فایل:jpg , jpeg , PDF , DOC  -;حجم حداکثر 600 کیلوبایت</small>
                                            </div>
                                        </div>
                                    </div>
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>
{{--                    </form>--}}
                    <input type="button" name="next" class="next action-button" value="بعدی" />
                </fieldset>
                <!-- end step one form -->
                <!-- start step two form -->
                <fieldset>
                    <h2 class="fs-title">اطلاعات تماس</h2>
                    <div class="row">
                       <div class="col-md-4 pl-1">
                        <div class="form-group">
                            <label>استان:
                                <span >*</span>
                            </label>
                            <select class="custom-select"  name="state"  id="state" required>
                                <option selected disabled>استان را انتخاب کنید</option>

                                <option value="" ></option>

                            </select>
                        </div>
                    </div>
                        <div class="col-md-4 px-1">
                        <div class="form-group">
                            <label>شهر:
                                <span >*</span>
                            </label>
                            <select class="custom-select "  name="city"  id="city" required>
                                <option value="" ></option>
                                <option value=""></option>
                            </select>

                        </div>
                    </div>
                        <div class="col-md-4 px-1">
                            <div class="form-group">
                                <label>تلفن تماس:
                                    <span>*</span>
                                </label>
                                <input type="hidden" id="tel_org" value="" name="tel"/>
                                <input type="tel" class="form-control " placeholder="تلفن تماس را وارد کنید" value=''  id="tel"    />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 px-1">
                        <div class="form-group">
                            <label>آدرس:
                                <span >*</span>
                            </label>
                            <input type="text" class="form-" placeholder="آدرس را وارد کنید"  value='' name="address"  required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 pr-1">
                            <div class="form-group">
                                <label for="email"><i class="bi bi-envelope-at-fill"></i>
                                    <span >*</span>
                                </label>
                                <input type="email" class="form-control " placeholder="پست الکترونیکی را وارد کنید" value='' name="email"  id="email"   required />
                                <small class="text-muted">نمونه:faracoach@gmail.com</small>
                            </div>
                        </div>
                    <div class="col-md-3 px-1">
                        <div class="form-group">
                            <label><i class="bi bi-instagram"></i>
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control " placeholder="صفحه اینستاگرام خود راوارد کنید"  value='' name="instagram" required  />
                        </div>
                    </div>
                    <div class="col-md-3 px-1">
                        <div class="form-group">
                            <label><i class="bi bi-telegram"></i>
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control " placeholder="آیدی تلگرام خود را وارد کنید" value='' name="telegram" required />

                        </div>
                    </div>
                    <div class="col-md-3 px-1">
                        <div class="form-group">
                            <label><i class="bi bi-linkedin"></i>
                            </label>
                            <input type="text" class="form-control " placeholder="آدرس  لینکدین خود را وارد کنید"  value='' name="linkedin"  />
                        </div>
                    </div>
                    </div>
                    <input type="button" name="previous" class="previous action-button" value="قبلی" />
                    <input type="button" name="next" class="next action-button" value="بعدی" />
                </fieldset>
                <!-- end step two form -->
                <!-- start step three form -->
                <fieldset>
                    <h2 class="fs-title"> اطلاعات تکمیلی</h2>
                    <div class="row">
                        <div class="col-md-4 px-1">
                            <div class="form-group">
                                <label>نام پدر:
                                    <span>*</span>
                                </label>
                                <input type="text" class="form-control" placeholder=" نام پدر را وارد کنید"  value=''  name="father" required />
                            </div>
                        </div>
                        <div class="col-md-4 px-1">
                            <div class="form-group">
                                <label>تاهل:
                                    <span>*</span>
                                </label>
                                <div class="form-group">
                                    <select class="form-control p-0 " id="exampleFormControlSelect1" name="married" required >
                                        <option selected disabled>انتخاب کنید</option>
                                        <option value="0"  >مجرد</option>
                                        <option value="1"  >متاهل</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 pl-1">
                            <div class="form-group">
                                <label>شهر تولد:
                                    <span>*</span>
                                </label>
                                <input type="text" class="form-control " placeholder="شهر تولد را وارد کنید"  value='' name="born" required />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 px-1">
                            <div class="form-group">
                                <label>تحصیلات:
                                    <span>*</span>
                                </label>
                                <select id="education" class="form-control p-0 "name="education" required >
                                    <option selected disabled>انتخاب کنید</option>
                                    <option  >زیردیپلم</option>
                                    <option >دیپلم</option>
                                    <option >فوق دیپلم</option>
                                    <option >لیسانس</option>
                                    <option >فوق لیسانس</option>
                                    <option >دکتری و بالاتر</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 pr-1">
                            <div class="form-group">
                                <label>رشته:
                                    <span>*</span>
                                </label>
                                <div class="form-group">
                                    <input type="text" class="form-control " placeholder="رشته را وارد کنید" value=''  name="reshteh" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 pr-1">
                            <div class="form-group">
                                <label>شغل:
                                    <span>*</span>
                                </label>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="شغل را وارد کنید" value=''  name="job" required />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 px-1">
                            <div class="form-group">
                                <label>عکس شناسنامه:
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="inputshenasnameh_image" aria-describedby="inputshenasnameh_image" name="shenasnameh_image"  />
                                    <label class="custom-file-label" for="inputshenasnameh_image">Choose file</label>
                                </div>
                                <small class="text-muted">فرمت فایل:jpg , jpeg , png  -;حجم حداکثر 600 کیلوبایت</small>
                            </div>
                        </div>
                        <div class="col-md-4 px-1">
                            <div class="form-group">
                                <label>عکس کارت ملی:
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input " id="inputcartmelli_image" aria-describedby="inputcartmelli_image" name="cartmelli_image"   />
                                    <label class="custom-file-label" for="inputcartmelli_image">Choose file</label>
                                </div>
                                <small class="text-muted">فرمت فایل:jpg , jpeg , png  -;حجم حداکثر 600 کیلوبایت</small>
                            </div>
                        </div>
                        <div class="col-md-4 px-1">
                            <div class="form-group">
                                <label>عکس مدرک تحصیلی:
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input " id="inputeducation_image" aria-describedby="inputeducation_image" name="education_image"  />
                                    <label class="custom-file-label" for="inputeducation_image">Choose file</label>
                                </div>
                                <small class="text-muted">فرمت فایل:jpg , jpeg , png  -;حجم حداکثر 600 کیلوبایت</small>
                            </div>
                        </div>
{{--                        <div class="col-md-6 px-1">--}}
{{--                            <div class="form-group">--}}
{{--                                <label>نام کاربری:--}}
{{--                                    <span class="text-danger">*</span>--}}
{{--                                </label>--}}
{{--                                <input type="text" class="form-control " placeholder="نام کاربری خود را وارد کنید" value='' name="username"  required  />--}}
{{--                                <small class="text-muted">به عنوان مثال: hesamaghaei</small>--}}
{{--                            </div>--}}
{{--                        </div>--}}

                    </div>
                    <input type="button" name="previous" class="previous action-button" value="قبلی" />
                    <input type="button" name="next" class="next action-button" value="بعدی" />
                </fieldset>
                <fieldset>
                    <h2 class="fs-title"> اطلاعات آشنایی</h2>
                    <div class="row">
                        <div class="col-md-6 px-1">
                            <div class="form-group">
                                <label>نحوه آشنایی:
                                    <span class="text-danger">*</span>
                                </label>
                                <select id="gettingknow_parent" class="form-control p-0 " name="gettingKnow_parent" required >
                                    <option selected disabled>انتخاب کنید</option>
                                        <option value=""></option>
                                </select>
                            </div>
                        </div>
                            <div class="col-md-6 px-1" id="gettingknow2" >
                                <div class="form-group">
                                    <label>عنوان آشنایی:
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select id="gettingknow_profile" class="form-control p-0 " name="gettingknow" required  >
                                        <option selected disabled>انتخاب کنید</option>
                                            <option value=""  ></option>
                                    </select>

                                </div>
                            </div>

                            <div class="col-md-6 px-1" id="gettingknow2">
                                <div class="form-group">
                                    <label>عنوان آشنایی</label>
                                    <select id="gettingknow" class="form-control p-0 " name="gettingknow" required>
                                        <option selected disabled>انتخاب کنید</option>

                                    </select>
                                </div>
                            </div>

                        <div class="col-md-6 px-1">
                            <div class="form-group">
                                <label>معرف</label>
                                <input type="hidden" class="form-control"    id="introduced" />
                                <input dir="ltr"  type="text" class="form-control " id="introduced_profile" />
                                <span id="feedback_introduced" ></span>
                            </div>
                        </div>
                    </div>
                    <input type="button" name="previous" class="previous action-button" value="قبلی" />
                    <input type="submit" name="submit" class="submit action-button" value="ثبت" />
                </fieldset>
                <!-- end step three form -->
            </form>
        </div>

</div>
<!-- jQuery -->
<!-- This template has been downloaded from Webrubik.com -->
