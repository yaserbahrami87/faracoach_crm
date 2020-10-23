@extends('panelUser.master.index')
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
                    <p class="description">
                        {{$user->fname}} {{$user->lname}}
                    </p>
                </div>
                <p class="description text-center">
                    "I like the way you work it <br>
                    No diggity <br>
                    I wanna bag it up"
                </p>
            </div>
            <div class="card-footer">
                <hr>

            </div>
        </div>

        <!-- *********** Groohaye Amoozeshi -->
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">گروه های آموزشی</h4>
            </div>
            <div class="card-body">
                <ul class="list-unstyled team-members">
                    <li>
                        <div class="row">
                            <div class="col-md-2 col-2">
                                <div class="avatar">
                                    <img src={{asset("../dashboard/assets/img/default-avatar.png")}} alt="Circle Image" class="img-circle img-no-padding img-responsive">
                                </div>
                            </div>
                            <div class="col-md-7 col-7">گروه 1
                                <br />
                                <span class="text-warning"><small>در حال انجام</small></span>
                            </div>
                            <div class="col-md-3 col-3 text-right">
                                <btn class="btn btn-sm btn-outline-success btn-round btn-icon"><i class="fa fa-group"></i></btn>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="row">
                            <div class="col-md-2 col-2">
                                <div class="avatar">
                                    <img src={{asset("../dashboard/assets/img/default-avatar.png")}}  class="img-circle img-no-padding img-responsive" />
                                </div>
                            </div>
                            <div class="col-md-7 col-7">گروه 2
                                <br />
                                <span class="text-danger"><small>کنسل شده</small></span>
                            </div>
                            <div class="col-md-3 col-3 text-right">
                                <btn class="btn btn-sm btn-outline-success btn-round btn-icon"><i class="fa fa-group"></i></btn>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="row">
                            <div class="col-md-2 col-2">
                                <div class="avatar">
                                    <img src={{asset("../dashboard/assets/img/default-avatar.png")}} alt="Circle Image" class="img-circle img-no-padding img-responsive">
                                </div>
                            </div>
                            <div class="col-ms-7 col-7">گروه 3
                                <br />
                                <span class="text-success"><small>تمام شده</small></span>
                            </div>
                            <div class="col-md-3 col-3 text-right">
                                <btn class="btn btn-sm btn-outline-success btn-round btn-icon"><i class="fa fa-group"></i></btn>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <!--  *********** Madarek ********************-->
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">مدارک</h4>
            </div>
            <div class="card-body">
                <ul class="list-unstyled team-members">
                    <li>
                        <div class="row">
                            <div class="col-md-2 col-2">
                                <btn class="btn btn-sm btn-outline-success btn-round btn-icon"><i class="fa fa-group"></i></btn>
                            </div>
                            <div class="col-md-7 col-7">عکس
                                <br />
                                @if(is_null($user->personal_image))
                                    <span class="text-danger"><small>موجود نیست</small></span>
                                @else
                                    <span class="text-success"><small>موجود است</small></span>
                                @endif
                            </div>
                            <div class="col-md-3 col-3 text-right">
                                @if(is_null($user->personal_image))
                                    <a class="btn btn-sm btn-danger" role="button">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-dash-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                            <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/>
                                        </svg>
                                    </a>
                                @else
                                    <a class="btn btn-sm btn-primary" href="{{asset('/documents/users/'.$user->personal_image)}}" target="_blank" role="button" title="دانلود">
                                        <i class="fa fa-download"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="row">
                            <div class="col-md-2 col-2">
                                <btn class="btn btn-sm btn-outline-success btn-round btn-icon"><i class="fa fa-group"></i></btn>
                            </div>
                            <div class="col-md-7 col-7">شناسنامه
                                <br />
                                @if(is_null($user->shenasnameh_image))
                                    <span class="text-danger"><small>موجود نیست</small></span>
                                @else
                                    <span class="text-success"><small>موجود است</small></span>
                                @endif
                            </div>
                            <div class="col-md-3 col-3 text-right">
                                @if(is_null($user->shenasnameh_image))
                                    <a class="btn btn-sm btn-danger"  role="button">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-dash-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                            <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/>
                                        </svg>
                                    </a>
                                @else
                                    <a class="btn btn-sm btn-primary" href="{{asset('/documents/users/'.$user->shenasnameh_image)}}" target="_blank" role="button"  title="دانلود">
                                        <i class="fa fa-download"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="row">
                            <div class="col-md-2 col-2">
                                <btn class="btn btn-sm btn-outline-success btn-round btn-icon"><i class="fa fa-group"></i></btn>
                            </div>
                            <div class="col-md-7 col-7">کارت ملی
                                <br />
                                @if(is_null($user->cartmelli_image))
                                    <span class="text-danger"><small>موجود نیست</small></span>
                                @else
                                    <span class="text-success"><small>موجود است</small></span>
                                @endif
                            </div>
                            <div class="col-md-3 col-3 text-right">
                                @if(is_null($user->cartmelli_image))
                                    <a class="btn btn-sm btn-danger"  role="button">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-dash-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                            <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/>
                                        </svg>
                                    </a>
                                @else
                                    <a class="btn btn-sm btn-primary" href="{{asset('/documents/users/'.$user->cartmelli_image)}}" target="_blank" role="button"  title="دانلود">
                                        <i class="fa fa-download"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="row">
                            <div class="col-md-2 col-2">
                                <btn class="btn btn-sm btn-outline-success btn-round btn-icon"><i class="fa fa-group"></i></btn>
                            </div>
                            <div class="col-md-7 col-7">مدرک تحصیلی
                                <br />
                                @if(is_null($user->education_image))
                                    <span class="text-danger"><small>موجود نیست</small></span>
                                @else
                                    <span class="text-success"><small>موجود است</small></span>
                                @endif
                            </div>
                            <div class="col-md-3 col-3 text-right">
                                @if(is_null($user->education_image))
                                    <a class="btn btn-sm btn-danger"  role="button">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-dash-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                            <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/>
                                        </svg>
                                    </a>
                                @else
                                    <a class="btn btn-sm btn-primary" href="{{asset('/documents/users/'.$user->education_image)}}" target="_blank" role="button"  title="دانلود">
                                        <i class="fa fa-download"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card card-user">
            <div class="card-header">
                <h5 class="card-title">اطلاعات پروفایل</h5>
            </div>
            <div class="card-body">
                <form method="post" action="/panel/profile/update/{{$user->id}}" enctype="multipart/form-data">
                    {{csrf_field()}}
                    {{method_field('PATCH')}}
                    <div class="row">
                        <div class="col-md-5 pl-1">
                            <div class="form-group">
                                <label>کد ملی</label>
                                <input type="text" class="form-control" readonly="readonly" placeholder="کد ملی را وارد کنید" value="{{$user->codemelli}}" name="codemelli" {{strlen($user->codemelli)===0?"": "disabled" }} />
                            </div>
                        </div>
                        <div class="col-md-3 px-1">
                            <div class="form-group">
                                <label>تلفن تماس</label>
                                <input type="text" class="form-control" placeholder="تلفن تماس را وارد کنید" value="{{$user->tel}}" name="tel"  />
                            </div>
                        </div>
                        <div class="col-md-4 pr-1">
                            <div class="form-group">
                                <label for="exampleInputEmail1">پست الکترونیکی</label>
                                <input type="email" class="form-control" placeholder="پست الکترونیکی را وارد کنید" value="{{$user->email}}" name="email"  {{strlen($user->email)===0?"": "disabled" }} />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 pl-1">
                            <div class="form-group">
                                <label>نام</label>
                                <input type="text" class="form-control" placeholder="نام را وارد کنید" value="{{$user->fname}}" name="fname"  />
                            </div>
                        </div>
                        <div class="col-md-6 pr-1">
                            <div class="form-group">
                                <label>نام خانوادگی</label>
                                <input type="text" class="form-control" placeholder="نام خانوادگی را وارد کنید" value="{{$user->lname}}" name="lname"  />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>آدرس</label>
                                <input type="text" class="form-control" placeholder="آدرس را وارد کنید" value="{{$user->address}}" name="address"  />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 pl-1">
                            <div class="form-group">
                                <label>نام پدر</label>
                                <input type="text" class="form-control" placeholder=" نام پدر را وارد کنید" value="{{$user->father}}" name="father"  />
                            </div>
                        </div>
                        <div class="col-md-4 px-1">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">جنسیت</label>
                                <div class="form-group">
                                    <select class="form-control" id="exampleFormControlSelect1" name="sex" >
                                        <option value="0"  {{ $user->sex =="0" ? 'selected='.'"'.'selected'.'"' : '' }}>زن</option>
                                        <option value="1" {{ $user->sex =="1" ? 'selected='.'"'.'selected'.'"' : '' }}>مرد</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 pr-1">
                            <div class="form-group">
                                <label>شماره شناسنامه</label>
                                <input type="text" class="form-control" placeholder="شماره شناسنامه را وارد کنید" value="{{$user->shenasname}}" name="shenasname"  />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 pl-1">
                            <div class="form-group">
                                <label>استان</label>
                                <input type="text" class="form-control" placeholder="استان را وارد کنید" value="{{$user->state}}" name="state"  />
                            </div>
                        </div>
                        <div class="col-md-4 px-1">
                            <div class="form-group">
                                <label>شهر</label>
                                <input type="text" class="form-control" placeholder="شهر را وارد کنید" value="{{$user->city}}" name="city"  />
                            </div>
                        </div>
                        <div class="col-md-4 pr-1">
                            <div class="form-group">
                                <label>تاهل</label>
                                <div class="form-group">
                                    <select class="form-control" id="exampleFormControlSelect1" name="married" >
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
                                <label>متولد</label>
                                <input type="text" class="form-control" placeholder="شهر تولد را وارد کنید" value="{{$user->born}}" name="born"  />
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
                                    <input type="text" class="form-control" placeholder="رشته را وارد کنید" value="{{$user->reshteh}}" name="reshteh"  />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 pl-1">
                            <div class="form-group">
                                <label>عکس پروفایل</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="inputpersonal_image" aria-describedby="inputpersonal_image" name="personal_image"/> >
                                    <label class="custom-file-label" for="inputpersonal_image">Choose file</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 pr-1">
                            <div class="form-group">
                                <label>عکس شناسنامه</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="inputshenasnameh_image" aria-describedby="inputshenasnameh_image" name="shenasnameh_image" />
                                    <label class="custom-file-label" for="inputshenasnameh_image">Choose file</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 pl-1">
                            <div class="form-group">
                                <label>عکس کارت ملی</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="inputcartmelli_image" aria-describedby="inputcartmelli_image" name="cartmelli_image">
                                    <label class="custom-file-label" for="inputcartmelli_image">Choose file</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 pr-1">
                            <div class="form-group">
                                <label>عکس مدرک تحصیلی</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="inputeducation_image" aria-describedby="inputeducation_image" name="education_image" />
                                    <label class="custom-file-label" for="inputeducation_image">Choose file</label>
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
            </div>
        </div>
    </div>
@endsection