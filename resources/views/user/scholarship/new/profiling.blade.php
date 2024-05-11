
<!-- multi step form -->
<div class="container">
        <div id="profiling">
            <div id="msform"   >

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
                    <form method="post" action="/panel/profile/update_sch2024_part1/{{Auth::user()->id}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        {{method_field('PATCH')}}
                            <h2 class="fs-title">اطـلاعـات شخصـی</h2>

                            <div class="" id="infoProfile">
                                <div class="row">
                                    <div class="col-md-4 px-1">
                                        <div class="form-group">
                                            <label>
                                                نام:
                                                <span>*</span>
                                            </label>

                                            <input type="text" class="form-control " placeholder="نام را وارد کنید" name="fname" value="{{old('fname',Auth::user()->fname)}}" required  />
                                            @error('fname')
                                                <p class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4 px-1">
                                        <div class="form-group">
                                            <label>نام خانوادگی:
                                                <span>*</span>
                                            </label>
                                            <input type="text" class="form-control " placeholder="نام خانوادگی را وارد کنید" name="lname" value="{{old('lname',Auth::user()->lname)}}"   />
                                            @error('lname')
                                                <p class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4 px-1">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">جنسیت:
                                                <span >*</span>
                                            </label>
                                            <div class="form-group">
                                                <select class="form-control p-0 " id="exampleFormControlSelect1" name="sex"   >
                                                    <option selected disabled>انتخاب کنید</option>
                                                    <option value="0" {{old('sex',Auth::user()->sex)==0?'selected':''}} >زن</option>
                                                    <option value="1" {{old('sex',Auth::user()->sex)==1?'selected':''}}>مرد</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 px-1">
                                        <div class="form-group">
                                            <label>نام انگلیسی<span class=" font-weight-bold">*</span></label>
                                            <input type="text" class="form-control  " placeholder="نام انگلیسی را وارد کنید"   value="{{Auth::user()->fname_en}}"  {{is_null(Auth::user()->fname_en)? "name='fname_en' ": 'disabled'}}   autocomplete="autocomplete"  />
                                        </div>
                                    </div>
                                    <div class="col-md-4 px-1">
                                        <div class="form-group">
                                            <label>نام خانوادگی انگلیسی<span class=" font-weight-bold">*</span></label>
                                            <input type="text" class="form-control " placeholder="نام خانوادگی انگلیسی را وارد کنید" value="{{Auth::user()->lname_en}}"  {{is_null(Auth::user()->lname_en)? "name='lname_en' ": 'disabled'}}   autocomplete="autocomplete"/>
                                        </div>
                                    </div>
                                    <div class="col-md-4 px-1">
                                        <div class="form-group">
                                            <label>تاریخ تولد:
                                                <span>*</span><small > نمونه:1365/01/01</small>
                                            </label>
                                            <input type="text" class="form-control " placeholder="تاریخ تولد را وارد کنید" value='{{old('datebirth',Auth::user()->datebirth)}}' name="datebirth" id="datebirth"  />

                                        </div>
                                    </div>
                                    <div class="col-md-4 px-1">
                                        <div class="form-group">
                                            <label for="codemelli">کد ملی:
                                                <span>*</span>
                                            </label>
                                            <input type="text" class="form-control" placeholder="کد ملی را وارد کنید" value='{{old('codemelli',Auth::user()->codemelli)}}'  id="codemelli" name="codemelli"   />
                                        </div>
                                    </div>
                                    <div class="col-md-4 px-1">
                                        <div class="form-group">
                                            <label>شماره شناسنامه:
                                                <span >*</span>
                                            </label>
                                            <input type="number" class="form-control " placeholder="شماره شناسنامه را وارد کنید"  value='{{old('shenasname',Auth::user()->shenasname)}}' name="shenasname"   />

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
                                            <div class="custom-file">
                                                <img src="{{asset('/images/ICF_scholarship_example.jpg')}}" class="img-fluid text-center" />
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
                            </div>


                            <input type="submit"  class="next action-button" value="ثبت" />
                    </form>
                    <input type="button" name="next" class="next action-button" value="بعدی" />
                </fieldset>
                <!-- end step one form -->
                <!-- start step two form -->
                <fieldset>
                    <form method="post" action="/panel/profile/update_sch2024_part2/{{Auth::user()->id}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        {{method_field('PATCH')}}
                        <h2 class="fs-title">اطلاعات تماس</h2>
                        <div class="row">
                               <div class="col-md-4 pl-1">
                                <div class="form-group">
                                    <label>استان:
                                        <span >*</span>
                                    </label>
                                    <select class="custom-select"  name="state"  id="state" required>
                                        <option selected disabled>استان را انتخاب کنید</option>
                                        @foreach($states as $item)
                                            <option value="{{$item->id}}"   {{ old('state',Auth::user()->state)==$item->id ? 'selected='.'"'.'selected'.'"' : '' }} >{{$item->name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 px-1">
                                <div class="form-group">
                                    <label>شهر:
                                        <span >*</span>
                                    </label>
                                    <select class="custom-select "  name="city"  id="city" required>

                                        <option disabled selected >انتخاب کنید</option>
                                        @foreach($cities as $item_city)
                                            <option value="{{$item_city->id}}" @if(!is_null(Auth::user()->city) && (Auth::user()->city==$item_city->id)) selected  @endif >  {{$item_city->name}} </option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-4 px-1">
                                <div class="form-group">
                                    <label>تلفن تماس:
                                        <span>*</span>
                                    </label>
                                    <input type="tel" class="form-control " placeholder="تلفن تماس را وارد کنید" value='{{Auth::user()->tel}}'  id="tel"  disabled  />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 px-1">
                            <div class="form-group">
                                <label>آدرس:
                                    <span >*</span>
                                </label>
                                <input type="text" class="form-" placeholder="آدرس را وارد کنید"  value='{{old('address',Auth::user()->address)}}' name="address"  required />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 pr-1">
                                <div class="form-group">
                                    <label for="email"><i class="bi bi-envelope-at-fill"></i>
                                        <span >*</span>
                                    </label>
                                    <input type="email" class="form-control " placeholder="پست الکترونیکی را وارد کنید" value='{{old('email',Auth::user()->email)}}' name="email"  id="email"   required />
                                    <small class="text-muted">نمونه:faracoach@gmail.com</small>
                                </div>
                            </div>
                            <div class="col-md-3 px-1">
                                <div class="form-group">
                                    <label><i class="bi bi-instagram"></i>
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control " placeholder="صفحه اینستاگرام خود راوارد کنید"  value='{{old('instagram',Auth::user()->instagram)}}' name="instagram" required  />
                                </div>
                            </div>
                            <div class="col-md-3 px-1">
                                <div class="form-group">
                                    <label><i class="bi bi-telegram"></i>
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control " placeholder="آیدی تلگرام خود را وارد کنید" value='{{old('telegram',Auth::user()->telegram)}}' name="telegram" required />

                                </div>
                            </div>
                            <div class="col-md-3 px-1">
                                <div class="form-group">
                                    <label><i class="bi bi-linkedin"></i>
                                    </label>
                                    <input type="text" class="form-control " placeholder="آدرس  لینکدین خود را وارد کنید"  value='{{old('linkedin',Auth::user()->linkedin)}}' name="linkedin"  />
                                </div>
                            </div>
                        </div>
                        <input type="submit"  class=" action-button" value="ثبت" />
                    </form>
                    <input type="button" name="previous" class="previous action-button" value="قبلی" />
                    <input type="button" name="next" class="next action-button" value="بعدی" />
                </fieldset>
                <!-- end step two form -->
                <!-- start step three form -->
                <fieldset>
                    <form method="post" action="/panel/profile/update_sch2024_part3/{{Auth::user()->id}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        {{method_field('PATCH')}}
                        <h2 class="fs-title"> اطلاعات تکمیلی</h2>
                        <div class="row">
                            <div class="col-md-4 px-1">
                                <div class="form-group">
                                    <label>نام پدر:
                                        <span>*</span>
                                    </label>
                                    <input type="text" class="form-control" placeholder=" نام پدر را وارد کنید"  value='{{old('father',Auth::user()->father)}}'  name="father" required />
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
                                            <option value="0" {{old('married',Auth::user()->married)==0? 'selected':''}}  >مجرد</option>
                                            <option value="1" {{old('married',Auth::user()->married)==1? 'selected':''}} >متاهل</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 pl-1">
                                <div class="form-group">
                                    <label>شهر تولد:
                                        <span>*</span>
                                    </label>
                                    <input type="text" class="form-control " placeholder="شهر تولد را وارد کنید"  value='{{old('born',Auth::user()->born)}}' name="born" required />
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
                                        <option {{old('education',Auth::user()->education)=='زیردیپلم'? 'selected':''}} value="زیردیپلم" >زیردیپلم</option>
                                        <option {{old('education',Auth::user()->education)=='دیپلم'? 'selected':''}} value="دیپلم" >دیپلم</option>
                                        <option {{old('education',Auth::user()->education)=='لیسانس'? 'selected':''}} value="لیسانس" >لیسانس</option>
                                        <option {{old('education',Auth::user()->education)=='فوق لیسانس'? 'selected':''}} value="فوق لیسانس" >فوق لیسانس</option>
                                        <option {{old('education',Auth::user()->education)=='دکتری و بالاتر'? 'selected':''}} value="دکتری و بالاتر" >دکتری و بالاتر</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 pr-1">
                                <div class="form-group">
                                    <label>رشته:
                                        <span>*</span>
                                    </label>
                                    <div class="form-group">
                                        <input type="text" class="form-control " placeholder="رشته را وارد کنید" value='{{old('reshteh',Auth::user()->reshteh)}}'  name="reshteh" required />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 pr-1">
                                <div class="form-group">
                                    <label>شغل:
                                        <span>*</span>
                                    </label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="شغل را وارد کنید" value='{{old('job',Auth::user()->job)}}'  name="job" required />
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

                        </div>
                        <input type="submit"   class=" action-button" value="ثبت" />
                    </form>
                    <input type="button" name="previous" class="previous action-button" value="قبلی" />
                    <input type="button" name="next" class="next action-button" value="بعدی" />
                </fieldset>
                <fieldset>
                    <form method="post" action="/panel/profile/update_sch2024_part4/{{Auth::user()->id}}" >
                        {{csrf_field()}}
                        {{method_field('PATCH')}}
                        <h2 class="fs-title"> اطلاعات آشنایی</h2>
                        <div class="row">
                            <div class="col-md-6 px-1">
                                <div class="form-group">
                                    <label>نحوه آشنایی:
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select id="gettingknow_parent" class="form-control p-0 " name="gettingKnow_parent" required >
                                        <option selected disabled>انتخاب کنید</option>
                                        @if(!is_null(Auth::user()->get_gettingknow))
                                            @foreach($gettingKnow_parent_list as $item)
                                                <option value="{{$item['id']}}"  {{ old('gettingKnow_parent',Auth::user()->get_gettingknow->parent['id'])==$item['id'] ? 'selected='.'"'.'selected'.'"' : '' }} >{{$item->category}}</option>
                                            @endforeach
                                        @else
                                            @foreach($gettingKnow_parent_list as $item)
                                                <option value="{{$item->id}}"  {{ old('gettingKnow_parent')==$item->id ? 'selected='.'"'.'selected'.'"' : '' }} >{{$item->category}}</option>
                                            @endforeach
                                        @endif

                                    </select>
                                </div>
                            </div>
                                <div class="col-md-6 px-1" id="gettingknow2" >
                                    <div class="form-group">
                                        <label>عنوان آشنایی:
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select id="gettingknow" class="form-control p-0 " name="gettingknow" required  >
                                            <option selected disabled>انتخاب کنید</option>
                                            @if(!is_null(Auth::user()->get_gettingknow) && (!is_null(Auth::user()->get_gettingknow->parent)))
                                                @foreach(Auth::user()->get_gettingknow->parent->child_lists as $item)
                                                    <option value="{{$item->id}}"  {{ old('gettingknow',Auth::user()->gettingknow)==$item->id ? 'selected='.'"'.'selected'.'"' : '' }}   >{{$item->category}}</option>
                                                @endforeach
                                            @endif
                                        </select>

                                    </div>
                                </div>


                            <div class="col-md-6 px-1">
                                <div class="form-group">
                                    <label>معرف</label>
                                    <input type="hidden" class="form-control"  @if(!is_null(Auth::user()->getIntroduced))  value="{{Auth::user()->getIntroduced->fname.' '.Auth::user()->getIntroduced->lname }}" @endif  id="introduced" />
                                    <input dir="ltr"  type="text" class="form-control @if(strlen(Auth::user()->introduced)==0) is-invalid  @else is-valid  @endif"  @if(!is_null(Auth::user()->getIntroduced)) disabled value="{{Auth::user()->getIntroduced->fname.' '.Auth::user()->getIntroduced->lname }}" @endif  id="introduced_profile" />
                                    <span id="feedback_introduced" ></span>
                                </div>
                            </div>
                        </div>
                        <input type="submit" class=" action-button" value="ثبت" />
                    </form>
                    <input type="button" name="previous" class="previous action-button" value="قبلی" />

                </fieldset>
                <!-- end step three form -->
            </div>
        </div>

</div>
<!-- jQuery -->
<!-- This template has been downloaded from Webrubik.com -->
