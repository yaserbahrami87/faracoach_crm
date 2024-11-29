
@extends('admin.master.index')
@section('headerScript')
    <style>
        #v-pills-tab button
        {
            width: 185px!important;
            padding: 20px;
        }
    </style>
@endsection
@section('content')
    <div class="col-2">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                @if(!is_null($session_coach)) <button class="nav-link active" id="v-pills-home-tab" data-toggle="pill" data-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">تنظیم جلسات کوچینگ</button> @endif
                @if(!is_null($session_counseling)) <button class="nav-link" id="v-pills-profile-tab" data-toggle="pill" data-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">تنظیم جلسات مشاوره</button> @endif
                @if(!is_null($session_exam)) <button class="nav-link" id="v-pills-messages-tab" data-toggle="pill" data-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false"> تنظیم جلسه آزمون ها</button> @endif
                <button class="nav-link" id="v-pills-settings-tab" data-toggle="pill" data-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">مکاتبات</button>
            </div>
    </div>
    <div class="col-5">
        <div class="tab-content" id="v-pills-tabContent">
            @if(!is_null($session_coach))
                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        <div class="card">
                            <div class="card-header bg-info border-info">
                                <h4 class="card-title m-0"> تنظیم جلسات کوچینگ </h4>
                            </div>
                            <div class="card-body" >
                                <form method="post" action="/admin/session_setting/admin_update/{{$session_coach->id}}" >
                                    {{csrf_field()}}
                                    {{method_field('PATCH')}}
                                    <div class="form-group">
                                        <label for="service">انتخاب خدمت :</label>
                                        <select class="form-control" id="service" name="fk_services">
                                            <option class="disabled" selected>انتخاب کنید</option>
                                            @foreach($services as $item)
                                                <option value="{{$item->id}}" >{{$item->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group ">
                                        <label for="student_coach">آیا جلسات کوچ دانشجویی برگزار می کنید؟</label>
                                        <select class="form-control " id="student_coach" name="student_coach" disabled="disabled">
                                            <option class="disabled" selected>انتخاب کنید</option>
                                            <option value="1" @if(($session_coach['student_coach'])==1 ) selected @endif >بله</option>
                                            <option value="0" @if(($session_coach['student_coach'])==0 ) selected @endif >خیر</option>
                                        </select>
                                    </div>
                                    <div class="form-group @if(($session_coach['student_coach'])==0) d-none @endif " id="Student_price">
                                        <label for="Student_price">قیمت جلسات دانشجویی ( تومان) : </label>
                                        <input type="text" class="form-control " id="Student_price"  readonly="readonly" value="{{$session_coach->price_settings->price}}">
                                    </div>
                                    <div class="form-group @if(($session_coach['student_coach'])==0) d-none @endif " id="student_count">
                                        <label for="student_count">تعداد دانشجو :</label>
                                        <input type="text" class="form-control" id="student_count" disabled="disabled" name="student_count" value="{{$session_coach['student_count']}}" >
                                    </div>
                                    <div class="form-group">
                                        <label for="introduction">آیا جلسات معارفه برگزار می کنید؟</label>
                                        <select class="form-control" id="introduction" name="introduction" disabled="disabled">
                                            <option class="disabled" selected>انتخاب کنید</option>
                                            <option value="1" @if(($session_coach['introduction'])==1) selected @endif >بله</option>
                                            <option value="0" @if(($session_coach['introduction'])==0) selected @endif >خیر</option>
                                        </select>
                                    </div>
                                    <div class="form-group " id="introduction_price">
                                        <label for="introduction_price"> قیمت جلسه معارفه شما چقدر است؟ (عدد صفر به معنای جلسه رایگان می باشد !) </label>
                                        <input type="text" class="form-control" id="introduction_price" disabled="disabled" name="introduction_price" value="{{$session_coach['introduction_price']}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="Presentation">نحوه برگذاری جلسات : </label>
                                        <select class="form-control" id="Presentation" name="Presentation" disabled="disabled">
                                            <option class="disabled" selected>انتخاب کنید</option>
                                            <option value="1" @if(($session_coach['Presentation'])==1) selected @endif >حضوری</option>
                                            <option value="2" @if(($session_coach['Presentation'])==2) selected @endif >آنلاین</option>
                                            <option value="3" @if(($session_coach['Presentation'])==3) selected @endif >حضوری -آنلاین</option>
                                        </select>
                                    </div>
                                    <div class="form-group @if(($session_coach['Presentation'])==1) d-none @endif " id="online_price">
                                        <label for="online_price">قیمت جلسه آنلاین ( تومان) : </label>
                                        <input type="text" class="form-control" id="online_price" disabled="disabled" name="online_price" value="{{$session_coach['online_price']}}" >
                                    </div>
                                    <div class="form-group @if(($session_coach['Presentation'])==2) d-none @endif" id="appointment_price">
                                        <label for="appointment_price">قیمت جلسه حضوری ( تومان): </label>
                                        <input type="text" class="form-control" id="appointment_price" disabled="disabled" name="appointment_price" value="{{$session_coach['appointment_price']}}" >
                                    </div>
                                    <div class="form-group">
                                        <label for="description">توضیحات</label>
                                        <input type="text" class="form-control" id="description" disabled="disabled" name="description" value="{{$session_coach['description']}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="status">وضعیت درخواست </label>
                                        <select class="form-control" id="status" name="status" >
                                            <option class="disabled" selected>انتخاب کنید</option>
                                            <option value="1" @if(($session_coach['status'])==1) selected @endif >درحال بررسی</option>
                                            <option value="2" @if(($session_coach['status'])==2) selected @endif >تایید شده</option>
                                            <option value="3" @if(($session_coach['status'])==3) selected @endif >ارسال برای اصلاح</option>
                                            <option value="4" @if(($session_coach['status'])==4) selected @endif >رد شده </option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">  ذخیره تنظیمات جلسه کوچینگ</button>
                                </form>
                            </div>
                        </div>
                    </div>

            @endif
            @if(!is_null($session_counseling))

                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                        <div class="card">
                            <div class="card-header bg-info border-info">
                                <h4 class="card-title m-0"> تنظیم جلسات مشاوره</h4>
                            </div>
                            <div class="card-body" >
                                <form method="post" action="/admin/session_setting/admin_update/{{$session_counseling->id}}" >
                                    {{method_field('PATCH')}}
                                    {{csrf_field()}}

                                    <div class="form-group">
                                        <label for="service_counseling">انتخاب خدمت :</label>
                                        <select class="form-control" id="service_counseling" name="fk_services" >
                                            <option class="disabled" selected>انتخاب کنید</option>
                                            @foreach($services as $item)
                                                <option value="{{$item->id}}" >{{$item->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="introduction_Counseling">آیا جلسات معارفه برگزار می کنید؟</label>
                                        <select class="form-control" id="introduction_Counseling" name="introduction" disabled="disabled">
                                            <option class="disabled" selected>انتخاب کنید</option>
                                            <option value="1" @if(($session_counseling['introduction'])==1 ) selected @endif >بله</option>
                                            <option value="0" @if(($session_counseling['introduction'])==0 ) selected @endif >خیر</option>
                                        </select>
                                    </div>
                                    <div class="form-group @if(($session_counseling['introduction_price'])==0) d-none @endif " id="introduction_price_Counseling">
                                        <label for="introduction_price_Counseling"> قیمت جلسه معارفه شما چقدر است؟ (عدد صفر به معنای جلسه رایگان می باشد !) </label>
                                        <input type="text" class="form-control" id="introduction_price_Counseling" disabled="disabled" name="introduction_price" value="{{$session_counseling['introduction_price']}}" >
                                    </div>
                                    <div class="form-group">
                                        <label for="Presentation_Counseling">نحوه برگذاری جلسات : </label>
                                        <select class="form-control" id="Presentation_Counseling" name="Presentation" disabled="disabled">
                                            <option class="disabled" selected>انتخاب کنید</option>
                                            <option value="1" @if(($session_counseling['Presentation'])==1) selected @endif >حضوری</option>
                                            <option value="2" @if(($session_counseling['Presentation'])==2) selected @endif >آنلاین</option>
                                            <option value="3" @if(($session_counseling['Presentation'])==3) selected @endif >حضوری -آنلاین</option>
                                        </select>
                                    </div>
                                    <div class="form-group @if(($session_counseling['Presentation'])==1) d-none @endif" id="online_price_Counseling">
                                        <label for="online_price_Counseling">قیمت جلسه آنلاین ( تومان) : </label>
                                        <input type="text" class="form-control" id="online_price_Counseling" disabled="disabled" name="online_price"  value="{{$session_counseling['online_price']}}">
                                    </div>
                                    <div class="form-group @if(($session_counseling['Presentation'])==2) d-none @endif" id="appointment_price_Counseling">
                                        <label for="appointment_price_Counseling">قیمت جلسه حضوری ( تومان): </label>
                                        <input type="text" class="form-control" id="appointment_price_Counseling" disabled="disabled" name="appointment_price"  value="{{$session_counseling['appointment_price']}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="description_counseling">توضیحات</label>
                                        <input type="text" class="form-control" id="description_counseling" disabled="disabled" name="description"  value="{{$session_counseling['description']}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="status">وضعیت درخواست </label>
                                        <select class="form-control" id="status" name="status">
                                            <option class="disabled" selected>انتخاب کنید</option>
                                            <option value="1" @if(($session_counseling['status'])==1) selected @endif >درحال بررسی</option>
                                            <option value="2" @if(($session_counseling['status'])==2) selected @endif >تایید شده </option>
                                            <option value="3" @if(($session_counseling['status'])==3) selected @endif >ارسال برای اصلاح</option>
                                            <option value="4" @if(($session_counseling['status'])==4) selected @endif >رد شده </option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary"> ذخیره تنظیمات جلسه مشاوره </button>
                                </form>
                            </div>
                        </div>
                    </div>

                @endif
            @if(!is_null($session_exam))

                    <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab"> <div class="card">
                            <div class="card-header bg-info border-info">
                                <h4 class="card-title m-0"> تنظیم جلسه آزمون ها </h4>
                            </div>
                            <div class="card-body" >
                                <form method="post" action="/admin/session_setting/admin_update/{{$session_exam->id}}" >
                                    {{method_field('PATCH')}}
                                    {{csrf_field()}}
                                    @if(!is_null($session_exam))
                                        <input type="hidden" value="{{$session_exam->id}}" name="id">
                                    @endif
                                    <div class="form-group" >
                                        <label for="title">عنوان آزمون </label>
                                        <input type="text" class="form-control" id="title"  disabled="disabled">
                                    </div>
                                    <div class="form-group">
                                        <label for="Presentation">نحوه برگذاری آزمون : </label>
                                        <select class="form-control" id="Presentation_exam" name="Presentation" disabled="disabled">
                                            <option class="disabled" selected>انتخاب کنید</option>
                                            <option value="1" @if(($session_exam['Presentation'])==1) selected @endif >حضوری</option>
                                            <option value="2" @if(($session_exam['Presentation'])==2) selected @endif >آنلاین</option>
                                            <option value="3" @if(($session_exam['Presentation'])==3) selected @endif >حضوری -آنلاین </option>
                                        </select>
                                    </div>
                                    <div class="form-group @if(($session_exam['Presentation'])==1) d-none @endif " id="online_price_exam">
                                        <label for="online_price">قیمت آزمون انلاین ( تومان) : </label>
                                        <input type="text" class="form-control " id="online_price" disabled="disabled" name="online_price"  value="{{$session_exam['online_price']}}">
                                    </div>
                                    <div class="form-group @if(($session_exam['Presentation'])==2) d-none @endif " id="appointment_price_exam">
                                        <label for="appointment_price">قیمت آزمون حضوری ( تومان): </label>
                                        <input type="text" class="form-control" id="appointment_price" disabled="disabled" name="appointment_price" value="{{$session_exam['appointment_price']}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">توضیحات</label>
                                        <input type="text" class="form-control" id="description" name="description" disabled="disabled" value="{{$session_exam['description']}}" >
                                    </div>
                                    <div class="form-group">
                                        <label for="status">وضعیت درخواست </label>
                                        <select class="form-control" id="status" name="status">
                                            <option class="disabled" selected>انتخاب کنید</option>
                                            <option value="1" @if(($session_exam['status'])==1) selected @endif >درحال بررسی</option>
                                            <option value="2" @if(($session_exam['status'])==2) selected @endif >تایید شده</option>
                                            <option value="3" @if(($session_exam['status'])==3) selected @endif > ارسال برای اصلاح</option>
                                            <option value="4" @if(($session_exam['status'])==4) selected @endif >رد شده </option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary"> ذخیره تنظیمات آزمون  </button>
                                </form>
                            </div>
                        </div></div>
                    <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">...</div>

                @endif
        </div>
    </div>
    </div>

@endsection
@section('footerScript')
    <script>
        $('#introduction').change(function(){
            if( $('#introduction').val()==1)
            {
                $('#introduction_price').attr('class','form-group' );
            }
            else
            {
                $('#introduction_price').attr('class','form-group d-none' );
            }
        });
        $('#student_coach').change(function()
        {
            if( $('#student_coach').val()==1)
            {
                $('#Student_price').attr('class','form-group' );
                $('#student_count').attr('class','form-group');
            }
            else
            {
                $('#Student_price').attr('class','form-group d-none' );
                $('#student_count').attr('class','form-group  d-none');
            }
        });
        $('#Presentation').change(function()
        {
            if( $('#Presentation').val()==1)
            {
                $('#online_price').attr('class','form-group d-none' );
                $('#appointment_price').attr('class','form-group');
            }
            else if( $('#Presentation').val()==2)
            {
                $('#online_price').attr('class','form-group ' );
                $('#appointment_price').attr('class','form-group  d-none');
            }
            else if( $('#Presentation').val()==3)
            {
                $('#online_price').attr('class','form-group' );
                $('#appointment_price').attr('class','form-group');
            }
        });
        $('#introduction_Counseling').change(function()
        {
            if( $('#introduction_Counseling').val()==1)
            {
                $('#introduction_price_Counseling').attr('class','form-group' );
            }
            else
            {
                $('#introduction_price_Counseling').attr('class','form-group d-none' );
            }
        });
        $('#Presentation_Counseling').change(function() {
            if ($('#Presentation_Counseling').val() == 1)
            {
                $('#online_price_Counseling').attr('class', 'form-group d-none');
                $('#appointment_price_Counseling').attr('class', 'form-group');

            } else if ($('#Presentation_Counseling').val() == 2)
            {
                $('#online_price_Counseling').attr('class', 'form-group ');
                $('#appointment_price_Counseling').attr('class', 'form-group  d-none');

            } else if ($('#Presentation_Counseling').val() == 3)
            {
                $('#online_price_Counseling').attr('class', 'form-group');
                $('#appointment_price_Counseling').attr('class', 'form-group');
            }
        });
        $('#Presentation_exam').change(function() {
            if ($('#Presentation_exam').val() == 1)
            {
                $('#online_price_exam').attr('class', 'form-group d-none');
                $('#appointment_price_exam').attr('class', 'form-group');

            } else if ($('#Presentation_exam').val() == 2)
            {
                $('#online_price_exam').attr('class', 'form-group ');
                $('#appointment_price_exam').attr('class', 'form-group  d-none');

            } else if ($('#Presentation_exam').val() == 3)
            {
                $('#online_price_exam').attr('class', 'form-group');
                $('#appointment_price_exam').attr('class', 'form-group');
            }
        });
    </script>
@endsection
