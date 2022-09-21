@extends('admin.master.index')
@section('headerScript')
    <link href="{{asset('/css/kamadatepicker.min.css')}}" rel="stylesheet" />
    <link href="{{asset('/css/timepicker.min.css')}}" rel="stylesheet" />
@endsection

@section('content')

    <div class="col-12 col-sm-12 col-md-3 col-lg-3 text-center ">
        @if(is_null($scholarship->user->personal_image))
            <img src="{{asset('/documents/users/default-avatar.png')}}" width="100px" height="100px"  class="rounded-circle border border-3"/>
        @else
            <img src="{{asset('/documents/users/'.$scholarship->user->personal_image)}}" width="100px" height="100px" class="rounded-circle border border-3 " />
        @endif
        <p>
            <a href="/admin/user/{{$scholarship->user_id}}">
                {{$scholarship->user->fname." ".$scholarship->user->lname}}
            </a>
        </p>
        <p>وضعیت:
            @switch($scholarship->status)
                @case(0)بررسی نشده
                    @break
                @case(1)قبول درخواست
                    @break
                @case(2)رد درخواست
                    @break
                @case(3)در حال بررسی
                    @break
                @case(4)اصلاح درخواست
                    @break
                @default خطا
            @endswitch
        </p>
    </div>
    <div class="col-12">
        <div class="row">
            <div class="col-12">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="contact-tab" data-toggle="tab" data-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">اطلاعات بورسیه</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-toggle="tab" data-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">اطلاعات کاربر</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link " id="introduce-tab" data-toggle="tab" data-target="#introduce" type="button" role="tab" aria-controls="introduce" aria-selected="false">معرفی دوستان</button>
                    </li>
                    <li class="nav-item" role="learn">
                        <button class="nav-link @if($scholarship->confirm_webinar)==1) bg-success @else  bg-danger  @endif" id="exam-tab" data-toggle="tab" data-target="#learn" type="button" role="tab" aria-controls="learn" aria-selected="false">آموزش</button>
                    </li>
                    <li class="nav-item" role="exam">
                        <button class="nav-link @if(count($scholarship->user->get_scholarshipexam)==0) bg-warning @elseif($scholarship->confirm_exam==1) bg-success @elseif($scholarship->confirm_exam==0) bg-danger @endif" id="exam-tab" data-toggle="tab" data-target="#exam" type="button" role="tab" aria-controls="exam" aria-selected="false">آزمون</button>
                    </li>
                    @if($scholarship->confirm_webinar==1 && $scholarship->confirm_exam==1)
                        <li class="nav-item" role="certificate">
                            <button class="nav-link" id="certificate-tab" data-toggle="tab" data-target="#certificate" type="button" role="tab" aria-controls="certificate" aria-selected="false">مدرک</button>
                        </li>
                    @endif
                    <li class="nav-item" role="introductionLetter">
                        <button class="nav-link @if(!is_null($scholarship->introductionletter)) bg-success @endif " id="introductionLetter-tab" data-toggle="tab" data-target="#introductionLetter" type="button" role="tab" aria-controls="introductionLetter" aria-selected="false">معرفی نامه</button>
                    </li>
                    <li class="nav-item" role="interview">
                        <button class="nav-link" id="interview-tab" data-toggle="tab" data-target="#interview" type="button" role="tab" aria-controls="interview" aria-selected="false">مصاحبه</button>
                    </li>
                    <li class="nav-item" role="result">
                        <button class="nav-link" id="result-tab" data-toggle="tab" data-target="#result" type="button" role="tab" aria-controls="result" aria-selected="false">نتیجه</button>
                    </li>
                </ul>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        @include('admin.scholarship.contact')
                        <button class="btn btn-primary" id="contact-tab2" onclick="document.getElementById('contact-tab').click()">مرحله بعد</button>
                    </div>
                    <div class="tab-pane fade show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        @include('admin.scholarship.profile')
                    </div>
                    <div class="tab-pane fade show" id="introduce" role="tabpanel" aria-labelledby="introduce-tab">
                        @include('admin.scholarship.introduce')
                    </div>
                    <div class="tab-pane fade " id="learn" role="tabpanel" aria-labelledby="learn-tab">
                        @if($scholarship->confirm_webinar==1)
                            <div class="alert alert-success">
                                کد شرکت در وبینار به درستی وارد شده است
                            </div>
                        @elseif($scholarship->user->get_recieveCodeUsers->count()>=3)
                             <div class="alert alert-danger">
                                 کاربر تعداد مجاز برای وارد کردن کد را انجام داده است
                             </div>
                        @else
                             <div class="alert alert-warning">
                                 تعداد دفعات ورود کد {{$scholarship->user->get_recieveCodeUsers->count()}}  بار می باشد
                             </div>
                        @endif

                        @if($scholarship->confirm_webinar==1)
                            <div class="row">
                                <div class="mx-auto col-12 col-md-4 text-center">
                                    <p>امتیاز از آموزش :  10 امتیاز</p>
                                </div>
                            </div>
                        @else
                                <div class="row">
                                    <div class="mx-auto col-12 col-md-4 text-center">
                                        <p>امتیاز از آموزش :  0 امتیاز</p>
                                    </div>
                                </div>
                        @endif
                    </div>
                    <div class="tab-pane fade" id="exam" role="tabpanel" aria-labelledby="exam-tab">

                        @if(count($scholarship->user->get_scholarshipexam)==0)
                            <div class="alert alert-warning">در آزمون شرکت نکرده است</div>
                            <div class="row">
                                <div class="mx-auto col-12 col-md-4 text-center">
                                        <p>امتیاز از آزمون :  0 امتیاز</p>
                                </div>
                            </div>
                        @elseif($scholarship->user->get_scholarshipexam->last()->score>50)
                            <div class="alert alert-success">
                                در آزمون با نتیجه {{$scholarship->user->get_scholarshipexam->last()->score}} قبول شده است
                            </div>
                            <div class="row">
                                <div class="mx-auto col-12 col-md-4 text-center">
                                    @if(($scholarship->user->get_scholarshipexam->last()->score) >= 50 && ($scholarship->user->get_scholarshipexam->last()->score) <= 70)
                                        <p>امتیاز از آزمون :  10 امتیاز</p>
                                    @elseif(($scholarship->user->get_scholarshipexam->last()->score) > 70)
                                        <p>امتیاز از آزمون :  20 امتیاز</p>
                                    @endif
                                </div>
                            </div>
                        @elseif($scholarship->user->get_scholarshipexam->last()->score<50)
                            @foreach($scholarship->user->get_scholarshipExam as $item)
                                <div class="alert alert-warning">آزمون {{$loop->iteration}} نمره =  {{$item->score}}</div>
                            @endforeach
                            <div class="row">
                                <div class="mx-auto col-12 col-md-4 text-center">
                                    <p>امتیاز از آزمون :  0 امتیاز</p>
                                </div>
                            </div>
                        @endif

                    </div>
                    <div class="tab-pane fade " id="certificate" role="tabpanel" aria-labelledby="certificate-tab">
                        <a href="{{asset('/admin/scholarship/certificate/'.$scholarship->user->id.'/download')}}" class="btn btn-primary">دانلود رزومه</a>
                    </div>

                    <div class="tab-pane fade " id="introductionLetter" role="tabpanel" aria-labelledby="introductionLetter-tab">
                        @if(is_null($scholarship->introductionletter))
                            <div class="alert alert-warning">
                                کاربر معرفی نامه ارسال نکرده است
                            </div>
                        @else
                            <div class="alert alert-success">
                                کاربر معرفی نامه ارسال کرده است
                                <a href="{{'/documents/scholarship/'.$scholarship->introductionletter}}" class="btn btn-primary">دانلود</a>
                            </div>
                        @endif

                        <form method="post" action="/admin/scholarship/{{$scholarship->id}}/score_store">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="mx-auto col-12 col-md-4 text-center">
                                    <small class="text-muted">امتیاز بین 0 تا 10</small>
                                    <div class="input-group ">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-outline-secondary" type="submit" id="button-addon1"> امتیاز معرفی نامه</button>
                                        </div>
                                        <input type="number" class="form-control" name="score_introductionletter" min="0" max="30" value="{{$scholarship->score_introductionletter}}"  />
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>

                    <div class="tab-pane fade " id="interview" role="tabpanel" aria-labelledby="interview-tab">
                        @include('admin.scholarship.interview')
                    </div>
                    <div class="tab-pane fade " id="result" role="tabpanel" aria-labelledby="result-tab">
                        <div class="row">
                            <div class="col-12 col-md-4 mx-auto">
                                <table class="table table-striped table-bordered text-center">
                                    <tr>
                                        <th class="text-center">عناوین</th>
                                        <th class="text-center">امتیاز</th>
                                    </tr>
                                    <tr>
                                        <td class="text-center">رزومه و سوابق</td>
                                        <td class="text-center">
                                            @if(is_null($scholarship->score_profile))
                                                0 امتیاز
                                            @else
                                                {{$scholarship->score_profile}}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">آموزش</td>
                                        <td class="text-center">
                                            @if(is_null($scholarship->confirm_webinar==1))
                                                0
                                            @else
                                                 10
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">امتیاز معرف</td>
                                        <td class="text-center">{{$count_scholarshipIntroduce}} </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            آزمون
                                        </td>
                                        <td>
                                            @if(count($scholarship->user->get_scholarshipexam)==0 || $scholarship->user->get_scholarshipexam->last()->score<50)
                                                0
                                            @elseif(($scholarship->user->get_scholarshipexam->last()->score) >= 50 && ($scholarship->user->get_scholarshipexam->last()->score) <= 70)
                                                10
                                            @elseif(($scholarship->user->get_scholarshipexam->last()->score) > 70)
                                                20
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            مصاحبه
                                        </td>
                                        <td>
                                            @if(is_null($scholarship->user->get_scholarshipInterview))
                                                0
                                            @else
                                                {{$scholarship->user->get_scholarshipInterview->score}}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>جمع امتیاز</th>
                                        <th>{{$result_final}}</th>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>


@endsection


@section('footerScript')
    <!--  DATE SHAMSI PICKER  --->
    <script src="{{asset('/js/kamadatepicker.min.js')}}"></script>
    <script src="{{asset('/js/kamadatepicker.holidays.js')}}"></script>
    <script>
        kamaDatepicker('datebirth',
            {
                markHolidays:true,
                markToday:true,
                twodigit:true,
                closeAfterSelect:true,
                nextButtonIcon: "fa fa-arrow-circle-right",
                previousButtonIcon: "fa fa-arrow-circle-left"
            });


        var customOptions={
            gotoToday: true,
            markHolidays:true,
            markToday:true,
            twodigit:true,
            closeAfterSelect:true,
            highlightSelectedDay:true,
            nextButtonIcon: "fa fa-arrow-circle-right",
            previousButtonIcon: "fa fa-arrow-circle-left",
            sync:true,
        }
        kamaDatepicker('dateFollow',customOptions);

        kamaDatepicker('nextfollowup_date_fa',
            {
                markHolidays:true,
                markToday:true,
                twodigit:true,
                closeAfterSelect:true,
                nextButtonIcon: "fa fa-arrow-circle-right",
                previousButtonIcon: "fa fa-arrow-circle-left"
            });

        kamaDatepicker('start',
            {
                gotoToday: true,
                markHolidays:true,
                markToday:true,
                twodigit:true,
                closeAfterSelect:true,
                highlightSelectedDay:true,
                nextButtonIcon: "fa fa-arrow-circle-right",
                previousButtonIcon: "fa fa-arrow-circle-left",
                sync:true,
            });
        kamaDatepicker('end',
            {
                gotoToday: true,
                markHolidays:true,
                markToday:true,
                twodigit:true,
                closeAfterSelect:true,
                highlightSelectedDay:true,
                nextButtonIcon: "fa fa-arrow-circle-right",
                previousButtonIcon: "fa fa-arrow-circle-left",
                sync:true,
            });
        kamaDatepicker('exam',
            {
                gotoToday: true,
                markHolidays:true,
                markToday:true,
                twodigit:true,
                closeAfterSelect:true,
                highlightSelectedDay:true,
                nextButtonIcon: "fa fa-arrow-circle-right",
                previousButtonIcon: "fa fa-arrow-circle-left",
                sync:true,
            });

    </script>


    <script>
        $('#scholarship_motivation,#scholarship_ability,#scholarship_obligation,#scholarship_impact,#scholarship_validity').change(function()
        {

            if(isNaN(parseInt($("#scholarship_motivation").val())))
            {
                var motivation=0;
            }
            else
            {
                var motivation=parseInt($("#scholarship_motivation").val());
            }

            if(isNaN(parseInt($("#scholarship_ability").val())))
            {
                var  ability=0;
            }
            else
            {
                var ability=parseInt($("#scholarship_ability").val());
            }

            if(isNaN(parseInt($("#scholarship_obligation").val())))
            {
                obligation=0;
            }
            else
            {
                var obligation=parseInt($("#scholarship_obligation").val());
            }


            if(isNaN(parseInt($("#scholarship_impact").val())))
            {
                var impact=0;
            }
            else
            {
                var impact=parseInt($("#scholarship_impact").val());
            }

            if(isNaN(parseInt($("#scholarship_validity").val())))
            {
                var validity=0;
            }
            else
            {
                var validity=parseInt($("#scholarship_validity").val());
            }

            var score=motivation+ability+obligation+impact+validity;
            $("#scholarship_score").val(score);
        });
    </script>
@endsection
