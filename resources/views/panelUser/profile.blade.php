@extends('panelUser.master.index')
@section('rowcontent')

    <div class="col-md-4">
        @include('panelUser.boxProfile')
        @include('panelUser.boxMadarak')
        @include('panelUser.boxAmoozeshi')
    </div>
    <div class="col-md-8">
        <form method="post" action="/panel/profile/update/{{$user->id}}" enctype="multipart/form-data">
            {{csrf_field()}}
            {{method_field('PATCH')}}
            <div class="card card-user">
                <div class="card-header">
                    <h5 class="card-title">اطلاعات شخصی</h5>
                </div>
                <div class="card-body" id="infoProfile">
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
                                <label for="codemelli">کد ملی</label>
                                <input type="text" class="form-control" placeholder="کد ملی را وارد کنید" @if(strlen($user->codemelli)>0) value="{{$user->codemelli}}" disabled @endif id="codemelli" name="codemelli" />
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
                                <label>عکس پروفایل</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="inputpersonal_image" aria-describedby="inputpersonal_image" name="personal_image"/> >
                                    <label class="custom-file-label" for="inputpersonal_image">Choose file</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-user">
                <div class="card-header">
                    <h5 class="card-title">اطلاعات تماس</h5>
                </div>
                <div class="card-body" id="infoProfile">
                    <div class="row">
                        <div class="col-md-6 px-1">
                            <div class="form-group">
                                <label>تلفن تماس</label>
                                <input type="text" class="form-control" placeholder="تلفن تماس را وارد کنید" @if(strlen($user->tel)>0) value="{{$user->tel}}" disabled @endif name="tel"  />
                            </div>
                        </div>
                        <div class="col-md-6 pr-1">
                            <div class="form-group">
                                <label for="email">پست الکترونیکی</label>
                                <input type="email" class="form-control" placeholder="پست الکترونیکی را وارد کنید" @if(strlen($user->email)>0) value="{{$user->email}}" disabled @endif name="email"  id="email"  />
                            </div>
                        </div>
                        <div class="col-md-6 pl-1">
                            <div class="form-group">
                                <label>استان</label>
                                <select class="custom-select" name="state" id="state">
                                     <option selected disabled>استان را انتخاب کنید</option>
                                     @foreach ($states as $item)
                                         <option value="{{$item->id}}" @if($item->id==$user->state) selected @endif>{{$item->name}}</option>
                                     @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 px-1">
                            <div class="form-group">
                                <label>شهر</label>
                                <select class="custom-select" name="city" id="city">
                                    <option value="{{$user->city}}">@if(!is_null($city))  {{$city->name}}  @endif </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 px-1">
                            <div class="form-group">
                                <label>آدرس</label>
                                <input type="text" class="form-control" placeholder="آدرس را وارد کنید" value="{{$user->address}}" name="address"  lang="fa" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-user">
                <div class="card-header">
                    <h5 class="card-title">اطلاعات قرارداد</h5>
                </div>
                <div class="card-body" id="infoProfile">
                    <div class="row">
                        <div class="col-12">
                            <div class="alert alert-warning" role="alert">
                                <small>این اطلاعات صرفاجهت عقد قراردادهای آموزشی و ارائه خدمات کوچینگ مورد نیاز است</small>
                            </div>
                        </div>
                        <div class="col-md-4 pl-1">
                            <div class="form-group">
                                <label>نام پدر</label>
                                <input type="text" class="form-control" placeholder=" نام پدر را وارد کنید" value="{{$user->father}}" name="father"  lang="fa" />
                            </div>
                        </div>
                        <div class="col-md-4 px-1">
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
                        <div class="col-md-4 pr-1">
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
                        <div class="col-md-4 pl-1">
                            <div class="form-group">
                                <label>شهر تولد</label>
                                <input type="text" class="form-control" placeholder="شهر تولد را وارد کنید" value="{{$user->born}}" name="born"   lang="fa"/>
                            </div>
                        </div>
                        <div class="col-md-4 px-1">
                            <div class="form-group">
                                <label>تحصیلات</label>
                                <select class="custom-select" name="education" id="education">
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
                                    <input type="text" class="form-control" placeholder="رشته را وارد کنید" value="{{$user->reshteh}}" name="reshteh"   lang="fa"/>
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

                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-outline-success">بروزرسانی</button>

        </form>
    </div>
@endsection
