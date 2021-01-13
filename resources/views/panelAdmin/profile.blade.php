@extends('panelAdmin.master.index')
@section('rowcontent')

    <div class="col-md-4 ">
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
                            <svg class="float-left text-muted" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
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
                        <div class="col-md-12 px-1">
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
                <div class="card-header bg-light">
                    <a type="button" class="row  border-bottom" data-toggle="collapse" data-target="#infoContact" aria-expanded="false" aria-controls="infoContact">
                        <div class="col-md-8">
                            <h6 class="card-title m-0 mb-3">اطلاعات تماس</h6>
                        </div>
                        <div class="col-md-4">
                            <svg class="float-left text-muted" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16">
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
                <div class="card-header bg-light">
                    <a class="row border-bottom" type="button" data-toggle="collapse" data-target="#infoConstract" aria-expanded="false" aria-controls="infoConstract">
                        <div class="col-md-8">
                            <h6 class="card-title m-0 mb-3">اطلاعات قرارداد</h6>
                        </div>
                        <div class="col-md-4">
                            <svg class="float-left text-muted" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-text-fill" viewBox="0 0 16 16">
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
                <div class="card-header bg-light">
                    <a class="row border-bottom" type="button" data-toggle="collapse" data-target="#infogettingKnow" aria-expanded="false" aria-controls="infogettingKnow">
                        <div class="col-8">
                            <h6 class="card-title m-0 mb-3">آشنایی</h6>
                        </div>
                        <div class="col-4">
                            <svg class="float-left text-muted" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-person" viewBox="0 0 16 16">
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
        @include('panelAdmin.followups')
        <hr/>
        @include('panelAdmin.insertFollowUp')
    </div>
@endsection
