@extends('user.master.index')
@section('headerScript')
    <style>
        .card-user form .form-group {
            margin-bottom: 20px; }

        .card-user .image
        {
            height: 70px;
        }

        .card-user .image img
        {
            border-radius: 12px;
        }

        .card-user .author {
            text-align: center;
            text-transform: none;
            margin-top: -77px; }
        .card-user .author a + p.description {
            margin-top: -7px; }

        .card-user .avatar {
            width: 124px;
            height: 124px;
            border: 1px solid #FFFFFF;
            position: relative;
            border-radius: 50%;
        }

        .card-user .card-body {
            min-height: 240px; }

        .card-user hr {
            margin: 5px 15px 15px; }

        .card-user .card-body + .card-footer {
            padding-top: 0; }

        .card-user .card-footer h5 {
            font-size: 1.25em;
            margin-bottom: 0; }

        .card-user .button-container {
            margin-bottom: 6px;
            text-align: center; }


        .card-title
        {
            float:right !important;
        }
    </style>
@endsection

@section('content')

    <div class="col-xs-12 col-md-4 col-lg-4 col-xl-4">
        @include('user.boxProfile')
    </div>
    <div class="col-xs-12 col-md-8 col-lg-8 col-xl-8">
        <div class="row">
            @include('user.cardBox')
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">تکمیل پروفایل</h5>
                </div>
                <div class="modal-body">
                    <p>لطفا جهت ادامه اطلاعات زیر را تکمیل نمایید:</p>
                    <form method="post" action="/panel/profile/update/{{Auth::user()->id}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        {{method_field('PATCH')}}
                        <div class="card card-user">
                                @php
                                $i=0;
                                @endphp
                                <div class="row">
                                    @if(is_null(Auth::user()->fname) &&($i!=2))
                                        <div class="col-md-6 px-1">
                                            <div class="form-group">
                                                <label>نام</label>
                                                <input type="text" class="form-control @if(strlen(Auth::user()->fname)==0) is-invalid  @else is-valid  @endif" placeholder="نام را وارد کنید"  value='{{old('fname',Auth::user()->fname)}}'  name="fname"   lang="fa" />
                                            </div>
                                        </div>
                                        @php
                                        $i++;
                                        @endphp
                                    @endif

                                    @if(is_null(Auth::user()->lname)&&($i!=2))
                                        <div class="col-md-6 px-1">
                                            <div class="form-group">
                                                <label>نام خانوادگی</label>
                                                <input type="text" class="form-control @if(strlen(Auth::user()->lname)==0) is-invalid  @else is-valid  @endif" placeholder="نام خانوادگی را وارد کنید" value='{{old('lname',Auth::user()->lname)}}'  name="lname"  lang="fa" />
                                            </div>
                                        </div>
                                        @php
                                            $i++;
                                        @endphp
                                    @endif

                                    @if(is_null(Auth::user()->sex)&&($i!=2))
                                        <div class="col-md-6 px-1">
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">جنسیت</label>
                                                <div class="form-group">
                                                    <select class="form-control p-0 @if(strlen(Auth::user()->sex)==0) is-invalid  @else is-valid  @endif" id="exampleFormControlSelect1" name="sex" >
                                                        <option selected disabled>انتخاب کنید</option>
                                                        <option value="0"  {{ old('sex',Auth::user()->sex)=="0" ? 'selected='.'"'.'selected'.'"' : '' }}  >زن</option>
                                                        <option value="1"  {{ old('sex',Auth::user()->sex)=="1" ? 'selected='.'"'.'selected'.'"' : '' }}>مرد</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        @php
                                            $i++;
                                        @endphp
                                    @endif

                                    @if(is_null(Auth::user()->codemelli)&&($i!=2))
                                        <div class="col-md-6 px-1">
                                            <div class="form-group">
                                                <label for="codemelli">کد ملی</label>
                                                <input type="text" class="form-control @if(strlen(Auth::user()->codemelli)==0) is-invalid  @else is-valid  @endif" placeholder="کد ملی را وارد کنید" value='{{old('codemelli',Auth::user()->codemelli)}}'  id="codemelli" name="codemelli" {{strlen(Auth::user()->codemelli)===0?"": "disabled" }} />
                                            </div>
                                        </div>
                                        @php
                                            $i++;
                                        @endphp
                                    @endif

                                    @if(is_null(Auth::user()->shenasname)&&($i!=2))
                                        <div class="col-md-6 px-1">
                                            <div class="form-group">
                                                <label>شماره شناسنامه</label>
                                                <input type="text" class="form-control @if(strlen(Auth::user()->shenasname)==0) is-invalid  @else is-valid  @endif" placeholder="شماره شناسنامه را وارد کنید"  value='{{old('shenasname',Auth::user()->shenasname)}}' name="shenasname"  />
                                            </div>
                                        </div>
                                        @php
                                            $i++;
                                        @endphp
                                    @endif

                                    @if(is_null(Auth::user()->datebirth)&&($i!=2))
                                        <div class="col-md-6 px-1">
                                            <div class="form-group">
                                                <label>تاریخ تولد</label>
                                                <input type="text" class="form-control @if(strlen(Auth::user()->datebirth)==0) is-invalid  @else is-valid  @endif" placeholder="تاریخ تولد را وارد کنید" value='{{old('datebirth',Auth::user()->datebirth)}}' name="datebirth" id="datebirth" />
                                            </div>
                                        </div>
                                        @php
                                            $i++;
                                        @endphp
                                    @endif


                                    @if(is_null(Auth::user()->personal_image)&&($i!=2))
                                        <div class="col-md-6 px-1">
                                            <div class="form-group">
                                                <label>عکس پروفایل</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input @if(strlen(Auth::user()->personal_image)==0) is-invalid  @else is-valid  @endif" id="inputpersonal_image" name="personal_image"/>
                                                    <label class="custom-file-label" for="inputpersonal_image">انتخاب فایل</label>
                                                </div>
                                            </div>
                                        </div>
                                            @php
                                                $i++;
                                            @endphp
                                    @endif

                                    @if(is_null(Auth::user()->username)&&($i!=2))
                                        <div class="col-md-6 px-1">
                                            <div class="form-group">
                                                <label>نام کاربری</label>
                                                <input type="text" class="form-control @if(strlen(Auth::user()->username)==0) is-invalid  @else is-valid  @endif" placeholder="نام کاربری خود را وارد کنید" value='{{old('username',Auth::user()->username)}}' name="username" @if(strlen(Auth::user()->username)>0) disabled @endif/>
                                                <small class="text-muted  float-left" dir="ltr">نام کاربری شما</small>
                                            </div>
                                        </div>
                                        @php
                                            $i++;
                                        @endphp
                                    @endif

                                    @if(is_null(Auth::user()->tel)&&($i!=2))
                                        <div class="col-md-6 px-1">
                                            <div class="form-group">
                                                <label>تلفن تماس</label>
                                                <input type="hidden" id="tel_org" value="{{old('tel',Auth::user()->tel)}}" name="tel"/>
                                                <input type="tel" class="form-control @if(strlen(Auth::user()->tel)==0) is-invalid  @else is-valid  @endif" placeholder="تلفن تماس را وارد کنید" value='{{old('tel',Auth::user()->tel)}}'  id="tel"  @if(strlen(Auth::user()->tel)>0 ) disabled  @endif  />
                                            </div>
                                        </div>
                                        @php
                                            $i++;
                                        @endphp
                                    @endif

                                    @if(is_null(Auth::user()->email)&&($i!=2))
                                        <div class="col-md-6 pr-1">
                                            <div class="form-group">
                                                <label for="email">پست الکترونیکی</label>
                                                <input type="email" class="form-control @if(strlen(Auth::user()->email)==0) is-invalid  @else is-valid  @endif" placeholder="پست الکترونیکی را وارد کنید" value='{{old('email',Auth::user()->email)}}' name="email"  id="email"  @if(strlen(Auth::user()->email)>0) disabled  @endif />
                                            </div>
                                        </div>
                                        @php
                                            $i++;
                                        @endphp
                                    @endif

                                    @if(is_null(Auth::user()->state)&&($i!=2))
                                        <div class="col-md-6 pl-1">
                                            <div class="form-group">
                                                <label>استان</label>
                                                <select class="custom-select @if(strlen(Auth::user()->state)==0) is-invalid  @else is-valid  @endif"  name="state"  id="state">
                                                    <option selected disabled>استان را انتخاب کنید</option>
                                                    @foreach($states as $item)
                                                        <option value="{{$item->id}}"   {{ old('state',Auth::user()->state)==$item->id ? 'selected='.'"'.'selected'.'"' : '' }} >{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        @php
                                            $i++;
                                        @endphp
                                    @endif


                                    @if(is_null(Auth::user()->city)&&($i!=2))

                                        <div class="col-md-6 px-1">
                                            <div class="form-group">
                                                <label>شهر</label>

                                                <select class="custom-select @if(strlen(Auth::user()->city)==0) is-invalid  @else is-valid  @endif"  name="city"  id="city">


                                                </select>
                                            </div>
                                        </div>
                                        @php
                                            $i++;
                                        @endphp
                                    @endif

                                    @if(is_null(Auth::user()->address)&&($i!=2))
                                        <div class="col-md-6 px-1">
                                            <div class="form-group">
                                                <label>آدرس</label>
                                                <input type="text" class="form-control @if(strlen(Auth::user()->address)==0) is-invalid  @else is-valid  @endif" placeholder="آدرس را وارد کنید"  value='{{old('address',Auth::user()->address)}}' name="address"  lang="fa" />
                                            </div>
                                        </div>
                                        @php
                                            $i++;
                                        @endphp
                                    @endif

                                    @if(is_null(Auth::user()->instagram)&&($i!=2))
                                        <div class="col-md-6 px-1">
                                            <div class="form-group">
                                                <label>اینستاگرام</label>
                                                <input type="text" class="form-control @if(strlen(Auth::user()->instagram)==0) is-invalid  @else is-valid  @endif" placeholder="صفحه اینستاگرام خود را وارد کنید"  value='{{old('instagram',Auth::user()->instagram)}}' name="instagram"  />
                                            </div>
                                        </div>
                                        @php
                                            $i++;
                                        @endphp
                                    @endif

                                    @if(is_null(Auth::user()->father)&&($i!=2))
                                        <div class="col-md-6 px-1">
                                            <div class="form-group">
                                                <label>نام پدر</label>
                                                <input type="text" class="form-control @if(strlen(Auth::user()->father)==0) is-invalid  @else is-valid  @endif" placeholder=" نام پدر را وارد کنید"  value='{{old('father',Auth::user()->father)}}'  name="father" />
                                            </div>
                                        </div>
                                        @php
                                            $i++;
                                        @endphp
                                    @endif


                                    @if(is_null(Auth::user()->married)&&($i!=2))
                                        <div class="col-md-6 px-1">
                                            <div class="form-group">
                                                <label>تاهل</label>
                                                <div class="form-group">
                                                    <select class="form-control p-0 @if(strlen(Auth::user()->married)==0) is-invalid  @else is-valid  @endif" id="exampleFormControlSelect1" name="married" >
                                                        <option selected disabled>انتخاب کنید</option>
                                                        <option value="0" {{ old('married',Auth::user()->married)=="0" ? 'selected='.'"'.'selected'.'"' : '' }} >مجرد</option>
                                                        <option value="1" {{ old('married',Auth::user()->married)=="1" ? 'selected='.'"'.'selected'.'"' : '' }} >متاهل</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        @php
                                            $i++;
                                        @endphp
                                    @endif


                                    @if(is_null(Auth::user()->born)&&($i!=2))
                                        <div class="col-md-6 pl-1">
                                            <div class="form-group">
                                                <label>شهر تولد</label>
                                                <input type="text" class="form-control @if(strlen(Auth::user()->born)==0) is-invalid  @else is-valid  @endif" placeholder="شهر تولد را وارد کنید"  value='{{old('born',Auth::user()->born)}}' name="born" />
                                            </div>
                                        </div>
                                        @php
                                            $i++;
                                        @endphp
                                    @endif

                                    @if(is_null(Auth::user()->education)&&($i!=2))
                                        <div class="col-md-6 px-1">
                                            <div class="form-group">
                                                <label>تحصیلات</label>
                                                <select id="education" class="form-control p-0 @if(strlen(Auth::user()->education)==0) is-invalid  @else is-valid  @endif  @error('education') is-invalid @enderror" name="education">
                                                    <option selected disabled>انتخاب کنید</option>
                                                    <option {{ old('education',Auth::user()->education)=="زیردیپلم" ? 'selected='.'"'.'selected'.'"' : '' }}   >زیردیپلم</option>
                                                    <option {{ old('education',Auth::user()->education)=="دیپلم" ? 'selected='.'"'.'selected'.'"' : '' }}>دیپلم</option>
                                                    <option {{ old('education',Auth::user()->education)=="فوق دیپلم" ? 'selected='.'"'.'selected'.'"' : '' }}>فوق دیپلم</option>
                                                    <option {{ old('education',Auth::user()->education)=="لیسانس" ? 'selected='.'"'.'selected'.'"' : '' }}>لیسانس</option>
                                                    <option {{ old('education',Auth::user()->education)=="فوق لیسانس" ? 'selected='.'"'.'selected'.'"' : '' }}>فوق لیسانس</option>
                                                    <option {{ old('education',Auth::user()->education)=="دکتری و بالاتر" ? 'selected='.'"'.'selected'.'"' : '' }}>دکتری و بالاتر</option>
                                                </select>
                                            </div>
                                        </div>
                                        @php
                                            $i++;
                                        @endphp
                                    @endif

                                    @if(is_null(Auth::user()->reshteh)&&($i!=2))
                                        <div class="col-md-6 pr-1">
                                            <div class="form-group">
                                                <label>رشته</label>
                                                <div class="form-group">
                                                    <input type="text" class="form-control @if(strlen(Auth::user()->reshteh)==0) is-invalid  @else is-valid  @endif" placeholder="رشته را وارد کنید" value='{{old('reshteh',Auth::user()->reshteh)}}'  name="reshteh"  />
                                                </div>
                                            </div>
                                        </div>
                                        @php
                                            $i++;
                                        @endphp
                                    @endif

                                </div>
                        </div>
                        <button type="submit" class="btn btn-primary">بروزرسانی</button>
                    </form>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>

@endsection

@section('footerScript')
    @if(session('complete_profile')==true)
        <script>

        @if(is_null(Auth::user()->fname) || is_null(Auth::user()->lname) || is_null(Auth::user()->reshteh) || is_null(Auth::user()->education)|| is_null(Auth::user()->born)|| is_null(Auth::user()->married)|| is_null(Auth::user()->father)|| is_null(Auth::user()->instagram)|| is_null(Auth::user()->address)|| is_null(Auth::user()->city)|| is_null(Auth::user()->state)|| is_null(Auth::user()->email)|| is_null(Auth::user()->tel)|| is_null(Auth::user()->username)|| is_null(Auth::user()->personal_image)|| is_null(Auth::user()->datebirth)|| is_null(Auth::user()->shenasname)|| is_null(Auth::user()->codemelli)|| is_null(Auth::user()->sex))
            $('#staticBackdrop').modal('show')
        @endif
    </script>
@endif
@endsection
