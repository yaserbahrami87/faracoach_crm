@extends('panelAdmin.master.index')
@section('rowcontent')

    <div class="col-md-4">
        <div class="card card-user">
            <div class="image">
                <img src={{asset('../dashboard/assets/img/damir-bosnjak.jpg')}} alt="...">
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
                    "I like the way you work it <br>
                    No diggity <br>
                    I wanna bag it up"
                </p>
            </div>
            <div class="card-footer">
                <a href="/admin/user/{{$user->tel}}/password" class="btn btn-primary d-block text-center">تغییر رمز عبور</a>
                <form method="post" action="/admin/user/{{$user->id}}/changeType">
                    {{csrf_field()}}
                    {{method_field('PATCH')}}
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
                </form>
                <hr>
            </div>
        </div>
        @include('panelAdmin.boxMadarak')
        @include('panelAdmin.listIntroducedUser')
        @include('panelAdmin.boxAmoozeshi')

    </div>
    <div class="col-md-8">
        <form method="post" action="/admin/profile/update/{{$user->id}}" enctype="multipart/form-data">
            {{csrf_field()}}
            {{method_field('PATCH')}}
            <div class="card card-user">
                <div class="card-header">
                    <a type="button" data-toggle="collapse" data-target="#infoProfile" aria-expanded="false" aria-controls="infoProfile">
                        <h6 class="card-title">اطلاعات شخصی</h6>
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
                    <a type="button" data-toggle="collapse" data-target="#infoContact" aria-expanded="false" aria-controls="infoContact">
                        <h6 class="card-title">اطلاعات تماس</h6>
                    </a>
                </div>
                <div class="card-body collapse" id="infoContact">
                    <div class="row">
                        <div class="col-md-6 px-1">
                            <div class="form-group">
                                <label>تلفن تماس</label>
                                <input type="text" class="form-control" placeholder="تلفن تماس را وارد کنید" value="{{$user->tel}}" name="tel"    />
                            </div>
                        </div>
                        <div class="col-md-6 pr-1">
                            <div class="form-group">
                                <label for="email">پست الکترونیکی</label>
                                <input type="email" class="form-control" placeholder="پست الکترونیکی را وارد کنید" value="{{$user->email}}" name="email"  id="email"   />
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
                    </div>
                </div>
            </div>
            <div class="card card-user">
                <div class="card-header">
                    <a type="button" data-toggle="collapse" data-target="#infoConstract" aria-expanded="false" aria-controls="infoConstract">
                        <h6 class="card-title">اطلاعات قرارداد</h6>
                    </a>
                </div>
                <div class="card-body collapse" id="infoConstract">
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
                                <input type="text" class="form-control" placeholder="تحصیلات را وارد کنید" value="{{$user->education}}" name="education"  />
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
            <div class="card card-user">
                <div class="card-header">
                    <a type="button" data-toggle="collapse" data-target="#infogettingKnow" aria-expanded="false" aria-controls="infogettingKnow">
                        <h6 class="card-title">آشنایی</h6>
                    </a>
                </div>
                <div class="card-body collapse " id="infogettingKnow">
                    <div class="row">
                        <div class="col-md-6 px-1">
                            <div class="form-group">
                                <label>نحوه آشنایی</label>
                                <input type="text" disabled="disabled" class="form-control" value="{{$user->gettingknow }}" name="gettingknow"   lang="fa"/>
                            </div>
                        </div>
                        <div class="col-md-6 px-1">
                            <div class="form-group">
                                <label>معرف</label>
                                <input type="text" disabled="disabled" class="form-control" value="{{$user->introduced }}" name="introduced"   lang="fa"/>
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
                    <div class="row">
                        <div class="update m-auto m-auto">
                            <button type="submit" class="btn btn-primary btn-round">بروزرسانی اطلاعات</button>
                        </div>
                    </div>

                </div>

            </div>
        </form>

        @include('panelAdmin.followups')
        <hr/>
        @include('panelAdmin.insertFollowUp')
    </div>
@endsection
