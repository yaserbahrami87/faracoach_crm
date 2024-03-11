@extends('user.master.index')

@section('headerScript')
    <link href="{{asset('/css/kamadatepicker.min.css')}}" rel="stylesheet" />
    <link href="{{asset('/css/timepicker.min.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('fonts/material-icon/css/material-design-iconic-font.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/nouislider/nouislider.min.css')}}">
    <link href="{{asset('/css/Collabration_request.css')}}" rel="stylesheet">
    <link href="'https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script>
    import Buttons from "../../../public/dashboard/pages/UI/buttons.html";
    export default {
        components: {Buttons}
    }
</script>
    <style>
        body{
            color:#4d5053;
        }
        #collabration label.d-block
        {
            font-size: 16px;
        }
        .form-check label
        {
            font-size: 14px;
        }
        .trumbowyg-editor
        {
            background-color: white;
        }
        p.step-number-content
        {
            font-size: 16px;
        }
        .container div.card
        {
            width: 950px;
        }

        .text p
        {
            color:#6a6c70;
        }
        .nav-tabs .nav-link.active
        {
            border-color: #475F7B !important;
            background-color: #475F7B !important;
            color: #FFFFFF;
        }
        .main
        {
            padding: 0px!important;
        }
        .container div.card
        {
            width: 100%;
        }
        @media (min-width: 1200px) {
            .container{
            max-width: 1350px;
        }
        }
        #save_user
        {
            margin-left: 40px!important;
        }

    </style>
    <link href="/trumbowyg-2.25.1/dist/ui/trumbowyg.min.css" rel="stylesheet" />
@endsection
@section('content')
    <div class="container">
        <div class="card">
            <div class="form">
                <div class="left-side">
                    <div class="left-heading">
                        <i class="bi bi-people-fill"></i><h4>سفیر کوچینگ</h4>
                        <hr>
                    </div>
                    <div class="steps-content">
                        <i class="bi bi-caret-left"></i><h5> مـرحله<span class="step-number"> @if(Auth::user()->introduced_verified==2)3 @else 1 @endif </span></h5>
                        <p class="step-number-content active">عزیزانتان را به مسیر شکوفایی دعوت کنید.</p>

                    </div>
                    <ul class="progress-bar">
                        <li  class="@if(Auth::user()->introduced_verified!=2) active @endif">توضیحات  </li>
                        <li>تفاهمنامه</li>
                        <li class="@if(Auth::user()->introduced_verified==2) active @endif" >داشبورد سفیر</li>
                    </ul>
                </div>
                <div class="right-side">
                    <div class="main @if(Auth::user()->introduced_verified!=2) active @endif">
                        <div class="text-center mt-1">
                            <h5 >  سفیر عشق باش </h5>

                            <h6>اگر طعم کوچینگ را در عمق جانتان چشیده و از آن بهره برده‌اید،</h6>
                            <h6>  عزیزانتان را به مسیر شکوفایی دعوت کنید. </h6>

                            <p class="text-left"> طرح سفیران کوچینگ، جهت گسترش فرهنگ کوچینگ در جامعه و آشنایی افراد نخبه و مستعد جامعه و فارسی‌زبانان دنیا، به تمامیت همه کوچ‌های حرفه‌ای نیاز دارد.؛ افرادی که جایشان خالی است و به شدت مشتاق دیدارشان هستیم. کسانی هستند که هم وجود آنها برای کوچینگ و جامعه فرهیختگان کوچ¬های حرفه‌ای مناسب است و هم کوچینگ می‌تواند در سطوح مختلف به کمک آنها بیاید.</p>
                            <img src="https://my.faracoach.com/images/introduced.jpg" width="50%" />
                            <h5 class="text-left"> 6 گروه عمده که کوچینگ برای آنها بسیار مفید است: </h5>
                            <b class="text-left d-block mb-1">دسته اول (دیدگاه توسعه غیرمالی و فردی):</b>
                            <ol class="text-left ml-2 " >
                                <li > کسانی که در مسیر توسعه شخصی خود هستند و دغدغه رشد و تعالی فردی دارند</li>
                                <li> کسانی که می‌خواهند برای اطرافیان، دوستان، خانواده و فرزندان عزیز خود مؤثر باشند </li>
                                <li> کسانی که دغدغه رشد و توسعه حرفه‌ای در شغل و کسب‌وکارشان را دارند </li>
                            </ol>
                            <b class="text-left d-block mb-1">دسته دوم (دیدگاه توسعه کسب‌وکار):</b>
                            <ol class="text-left ml-2 " start="4" >
                                <li > تمام افرادی که در جایگاه رهبر، مدیر، معلم و مدرس، روان‌شناس، درمانگر، مشاور و... با طیف گسترده‌ای از افراد سروکار دارند و می‌خواهند به ابزارهای بهتری برای ارتباط و اثربخشی حرفه‌ای مجهز شوند.</li>
                                <li> کسانی که می‌خواهند علاوه بر این موارد از کوچینگ به‌عنوان شغل دوم خود استفاده و کسب درآمد کنند. </li>
                                <li> و در نهایت افرادی که می‌خواهند به کوچینگ به‌عنوان شغل اصلی و پر درآمد ملی و بین‌المللی می‌نگرند و در این مسیر حرفه‌ای قدم بردارند </li>
                            </ol>
                            <h5 class="text-left">بونس (حق معرفی): </h5>
                            <p class="text-left">این توافق در حوزه مسئولیت اجتماعی طرفین است؛ اما در عین حال، تلاش سفیران محترم به اشکال مختلف ارج نهاده و مبلغی به عنوان بونس مشارکت به شرح ذیل محاسبه و پرداخت می‌شود:</p>
                            <ul class="text-left ">
                                <li>6 درصد از مبلغ کل فروش در صورت «معرفی افراد به آکادمی جهت ورود به دوره های آموزش کوچینگ»؛ توضیحات تکمیلی در خصوص نحوه و مسیر معرفی افراد به آکادمی در اختیار سفیران گرامی قرار خواهد گرفت؛</li>
                                <li>3 درصد مازاد جهت نهایی‌سازی ارتباط «خرید مستقیم و بدون نیاز به ارجاع و مشاوره کارشناسان واحد ثبت‌نام»؛</li>
                                <li>در صورت احراز شرایط و ارتقا به سطح «سفیر ارشد» (نماینده استانی)، این بونس تا 20 درصد قابل ‌افزایش است.</li>
                            </ul>
                            <h6>جهت اطلاع از جزئیات طرح و مفاد تفاهم‌نامه همکاری وارد مرحله بعدی شوید ! </h6>
                        </div>
                        <div class="buttons">
                            <button class="next_button">مرحله بعد</button>
                        </div>
                    </div>

                    <div class="main">
                        <div class="text" >

                            {!! $options->option_value !!}
                            @if(Auth::user()->introduced_verified!=0)
                                <input class="d-inline form-check text-success" type="checkbox" value="1" id="introduced_verified" name="introduced_verified" checked disabled >
                                <label class="d-inline form-check text-success" for="introduced_verified">
                                    شرایط و قوانین  بالا را مطالعه کردم و قبول دارم
                                </label>
                            @else
                                <form method="post" action="/panel/introduced/introduced_verified">
                                    {{csrf_field()}}
                                    <div class="form">
                                        <input class="d-inline form-check text-dark" type="checkbox" value="1" id="introduced_verified" name="introduced_verified" @if(Auth::user()->introduced_verified==1) checked @endif>
                                        <label class="d-inline form-check text-dark" for="introduced_verified">
                                            شرایط و قوانین  بالا را مطالعه کردم و قبول دارم
                                        </label>

                                    </div>
                                    <button type="submit" class="btn btn-success d-block">موافقم</button>
                                </form>
                            @endif
                        </div>

                        @if(Auth::user()->introduced_verified==2)
                            <div class="buttons button_space">
                                <button class="back_button">مرحله قبل</button>
                                <button class="next_button">مرحله بعد</button>
                            </div>
                        @endif
                    </div>

                    <div class="main @if(Auth::user()->introduced_verified==2) active @endif">

                        <!------------------------------- CAPTION ----------------------------->
                            <!------------------------------- Form ----------------------------->
                            <section class="col-12 mt-1">
                                <div class="col-12 border mt-1">
                                    <!___________________________ top main tab -------------------------->
                                    <nav>
                                        <div class="nav nav-tabs mt-1" id="nav-tab" role="tablist">
                                            <button class="nav-link active" id="nav-introduced-tab" data-toggle="tab" data-target="#nav-introduced" type="button" role="tab" aria-controls="nav-introduced" aria-selected="true">معرفی</button>
                                            <button class="nav-link" id="nav-factors-tab" data-toggle="tab" data-target="#nav-factors" type="button" role="tab" aria-controls="nav-factors" aria-selected="false">فاکتور ها</button>
                                            <button class="nav-link" id="nav-position-tab" data-toggle="tab" data-target="#nav-position" type="button" role="tab" aria-controls="nav-position" aria-selected="false">جایگاه شما</button>
                                        </div>
                                    </nav>
                                    <div class="tab-content" id="nav-tabContent">

                                        <!________________________secend tab ______    معرفی  -------------------------->
                                        <div class="tab-pane fade show active" id="nav-introduced" role="tabpanel" aria-labelledby="nav-introduced-tab">
                                            <ul class="nav nav-pills " id="pills-tab" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link active" id="pills-home-tab" data-toggle="pill" data-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">مستقیم</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="pills-profile-tab" data-toggle="pill" data-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">لینک</button>
                                                </li>
                                            </ul>
                                            <div class="tab-content" id="pills-tabContent">
                                                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                                    <h6>مشخصات دوستان خود را جهت دعوت به فراکوچ وارد کنید</h6>
                                                    <form method="post" action="/panel/introduced/add" >
                                                        <div class="row pt-1 mt-1  " id="formAddIntroduce">
                                                            {{csrf_field()}}


                                                            <div class="col-12 col-md-3">
                                                                <div class="form-group">
                                                                    <label for="fname">نام:</label>
                                                                    <input type="text" class="form-control" placeholder="مثلا :علی  " name="fname" id="fname" value="{{old('fname')}}"/>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-3">
                                                                <div class="form-group">
                                                                    <label for="lname">نام خانوادگی:</label>
                                                                    <input type="text" class="form-control" placeholder="مثلا: محمدی" name="lname" value="{{old('lname')}}" />
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-3">
                                                            <div class="form-group ">
                                                                    <label for="lname">تلفن:</label>
                                                                    <input type="hidden" id="tel_org" value="{{old('tel')}}" name="tel"/>
                                                                    <input id="tel" dir="ltr" type="tel" class="form-control" placeholder="مثلا : 9123456789" value="{{old('tel')}}" />
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-3">
                                                            <div class="form-group mt-2 pt-1 ">
                                                                    <label for="sex0">جنسیت:</label>
                                                                    <div class="form-check form-check-inline">
                                                                        <input type="radio" id="sex1" name="sex" class="form-check-input" value="1" {{ old('sex')=="1" ? 'checked='.'"'.'checked'.'"' : '' }} >
                                                                        <label class="form-check-label" for="sex1">آقا</label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input type="radio" id="sex0" name="sex" class="form-check-input" value="0" {{ old('sex')=="0" ? 'checked='.'"'.'checked'.'"' : '' }} >
                                                                        <label class="form-check-label" for="sex0">خانم</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-5 mt-1">
                                                                <div class="form-group">
                                                                    <label class="form-check-label">پیگیری توسط :</label>
                                                                    @foreach($getFollowbyCategory as $item)
                                                                        <div class="form-check form-check-inline">
                                                                            <input type="radio" id="customRadio{{$item->id}}" name="followby_id" class="form-check-input" value="{{$item->id}}">
                                                                            <label class="form-check-label" for="customRadio{{$item->id}}" @if($item->id==1)  data-toggle="tooltip" data-placement="bottom" title="در مواقعی که خودم فرصت یا شرایط پیگیری تا ثبت نام این فرد را ندارم، میخواهم توسط کارشناسان واحد ثبت نام فراکج مشاوره صورت بگیرد ." @endif>{{$item->followby}} @if($item->id==1)<i class="bi bi-exclamation-circle" style="color:red"></i> @endif</label>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>

                                                            <div class="col-12 col-md-7 mt-1">
                                                                <div class="form-group">
                                                                    <label class="form-check-label">نوع خدمت :</label>


                                                                        <div class="form-check form-check-inline">
                                                                            <input type="radio" id="type2" name="type" class="form-check-input" value="1">
                                                                            <label class="form-check-label" for="type2"> آموزش کوچینگ  </label>
                                                                        </div>

                                                                    <div class="form-check form-check-inline">
                                                                        <input type="radio" id="type30" name="type" class="form-check-input" value="30">
                                                                        <label class="form-check-label" for="type30">جلسه کوچینگ </label>
                                                                    </div>
                                                                    <!--
                                                                    <div class="form-check form-check-inline">
                                                                        <input type="radio" id="customRadio{{$item->id}}" name="followby_id" class="form-check-input" value="{{$item->id}}">
                                                                        <label class="form-check-label" for="customRadio{{$item->id}}">سایر </label>
                                                                        <input type="text" style="width: 100px!important" >
                                                                    </div>
                                                                    -->
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-5">
                                                                <div class="form-group">
                                                                    <label class="form-check-label d-block">ارسال پیامک دعوت:</label>
                                                                    <div class="form-check form-check-inline">
                                                                        <input type="radio" id="sms0" name="sms" class="form-check-input" value="0" checked>
                                                                        <label class="form-check-label" for="sms0">ارسال شود</label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input type="radio" id="sms1" name="sms" class="form-check-input" value="1" >
                                                                        <label class="form-check-label" for="sms1">ارسال نشود</label>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="comment">توضیحات:</label>
                                                                        <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                                                                    </div>


                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-4">
                                                                <div class="">
                                                                    <b class="d-block">متن پیامک:</b>
                                                                    <p>به فراکوچ خوش آمدید<br/> شما توسط {{Auth::user()->fname.' '.Auth::user()->lname}}  به فراکوچ دعوت شدید <br/> رمز عبور: **** </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-12 " dir="ltr" >
                                                                <div class="input-group mb-2 mt-1 btn-send ">
                                                                    <!-- <button type="button" class="btn btn-primary" id="addFormIntroduce" title="اضافه کردن فرم جدید">+</button>-->
                                                                    <button type="submit" id="save_user" class="btn  btn-secondary px-3 ">ثبت کاربر </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <!_______________ Tab tables -------------------------->

                                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                        <li class="nav-item" role="presentation">
                                                            <button class="nav-link active" id="home-tab" data-toggle="tab" data-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">متقاضی</button>
                                                        </li>
                                                        <li class="nav-item" role="presentation">
                                                            <button class="nav-link" id="profile-tab" data-toggle="tab" data-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">مشتری</button>
                                                        </li>
                                                        <li class="nav-item" role="presentation">
                                                            <button class="nav-link" id="contact-tab" data-toggle="tab" data-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">انصراف</button>
                                                        </li>
                                                    </ul>
                                                    <div class="tab-content" id="myTabContent">

                                                        <!___________________________ مستیم _ متقاضی -------------------------->
                                                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                                            <section class="col-12 table-responsive">
                                                                <table class="table table-striped">
                                                                    <thead>
                                                                    <tr>
                                                                        <th scope="col">ردیف</th>
                                                                        <th scope="col">    </th>
                                                                        <th scope="col">نام و نام خانوادگی </th>
                                                                        <th scope="col">شماره تماس</th>
                                                                        <th scope="col">تاریخ ثبت</th>
                                                                        <th scope="col"> تعداد پیگیری</th>
                                                                        <th scope="col"> آخرین ورود</th>
                                                                        <th scope="col">مسئول پیگیری</th>
                                                                        <th scope="col">امتیاز</th>
                                                                        <th scop="col"></th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    @foreach ($listIntroducedUser->wherenotin('type',[-1,20]) as $item )
                                                                        <tr class="text-center">
                                                                            <td>
                                                                                {{$loop->iteration}}
                                                                            </td>
                                                                            <td>
                                                                                <img class="profile rounde" src="{{asset('documents/users/'.$item->personal_image)}}" alt="" width="25px"/>
                                                                            </td>
                                                                            <td>
                                                                                <div class="box-title">{{$item->fname.' '.$item->lname}}</div>
                                                                            </td>
                                                                            <td>
                                                                                <span>
                                                                                    <a href="tel:{{$item->tel}} " dir="ltr">{{$item->tel}}</a>
                                                                                </span>
                                                                            </td>
                                                                            <td>
                                                                                <div class="box-title">{{substr($item->changeTimestampToShamsi($item->created_at),7)}}</div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="icons">
                                                                                    <div class="box-title">{{$item->followups()->count()}}</div>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="icons">
                                                                                    <div class="box-title">@if ($item->logs->count()>0) {{$item->last_login_at}}  @endif</div>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="icons">
                                                                                    <div class="box-title">
                                                                                        @if(! is_null($item->get_followbyExpert))
                                                                                            {{$item->get_followbyExpert->fname. ' '.$item->get_followbyExpert->lname}}
                                                                                        @endif
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="icons">
                                                                                    <div class="box-title">
                                                                                      00
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <form method="post" action="/panel/introduced/changeType/{{$item->id}}">
                                                                                    {{csrf_field()}}
                                                                                    <input type="hidden" value="-1" name="type"/>
                                                                                    <button type="submit" class="btn btn-warning">انصراف</button>
                                                                                </form>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                    </tbody>
                                                                </table>
                                                                <!------------------------------------------ Modal ------------------------->
                                                                <div class="modal fade" id="modal_introduced_profile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" dir="rtl">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleModalLabel">مشخصات دوستان</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="col-12 text-center">
                                                                                    <div class="spinner-border text-primary text-center" role="status">
                                                                                        <span class="sr-only">Loading...</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 text-center">

                                                                </div>
                                                            </section>
                                                        </div>

                                                        <!___________________________ مستیم _ مشتری -------------------------->

                                                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                                            <section class="col-12 table-responsive">
                                                                <table class="table table-striped">
                                                                    <thead>
                                                                    <tr>
                                                                        <th scope="col">ردیف</th>
                                                                        <th scope="col">    </th>
                                                                        <th scope="col">نام و نام خانوادگی </th>
                                                                        <th scope="col">شماره تماس</th>
                                                                        <th scope="col">تعداد محصول</th>
                                                                        <th scope="col"> مبلغ خرید</th>
                                                                        <th scope="col">امتیاز</th>

                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    @foreach ($listIntroducedUser->where('type','20') as $item)
                                                                           <tr class="text-center">
                                                                            <td>
                                                                                {{$loop->iteration}}
                                                                            </td>
                                                                            <td>
                                                                                <img class="profile rounde" src="{{asset('documents/users/'.$item->personal_image)}}" alt="" width="25px"/>
                                                                            </td>
                                                                            <td>
                                                                                <div class="box-title">{{$item->fname.' '.$item->lname}}</div>
                                                                            </td>
                                                                            <td>
                                                                                <span>
                                                                                    <a href="tel:{{$item->tel}} " dir="ltr">{{$item->tel}}</a>
                                                                                </span>
                                                                            </td>
                                                                            <td>
                                                                                <div class="box-title">تعداد محصول</div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="icons">
                                                                                    <div class="box-title">مبلغ خرید</div>
                                                                                </div>
                                                                            </td>
                                                                               <td>
                                                                                   <div class="icons">
                                                                                       <div class="box-title">امتیاز</div>
                                                                                   </div>
                                                                               </td>
                                                                        </tr>
                                                                    @endforeach
                                                                    </tbody>
                                                                </table>
                                                                <!------------------------------------------ Modal ------------------------->
                                                                <div class="modal fade" id="modal_introduced_profile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" dir="rtl">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleModalLabel">مشخصات دوستان</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="col-12 text-center">
                                                                                    <div class="spinner-border text-primary text-center" role="status">
                                                                                        <span class="sr-only">Loading...</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 text-center">

                                                                </div>
                                                            </section>
                                                        </div>

                                                        <!___________________________ مستیم _ انصراف -------------------------->
                                                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                                            <section class="col-12 table-responsive">
                                                                <table class="table table-striped">
                                                                    <thead>
                                                                    <tr>
                                                                        <th scope="col">ردیف</th>
                                                                        <th scope="col">     </th>
                                                                        <th scope="col">نام و نام خانوادگی </th>
                                                                        <th scope="col">شماره تماس</th>
                                                                        <th scope="col">امتیاز</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    @foreach ($listIntroducedUser->where('type','-1') as $item)
                                                                        <tr class="text-center">
                                                                            <td>
                                                                                {{$loop->iteration}}
                                                                            </td>
                                                                            <td>
                                                                                <img class="profile rounde" src="{{asset('documents/users/'.$item->personal_image)}}" alt="" width="25px"/>
                                                                            </td>
                                                                            <td>
                                                                                <div class="box-title">{{$item->fname.' '.$item->lname}}</div>
                                                                            </td>
                                                                            <td>
                                                                                <span>
                                                                                    <a href="tel:{{$item->tel}} " dir="ltr">{{$item->tel}}</a>
                                                                                </span>
                                                                            </td>
                                                                            <td>
                                                                                <span>
                                                                                   00 امتیاز
                                                                                </span>
                                                                            </td>
                                                                            <td>
                                                                                <form method="post" action="/panel/introduced/changeType/{{$item->id}}">
                                                                                    {{csrf_field()}}
                                                                                    <input type="hidden" value="11" name="type"/>
                                                                                    <button type="submit" class="btn btn-warning">پیگیری مجدد</button>
                                                                                </form>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                    </tbody>
                                                                </table>
                                                                <!------------------------------------------ Modal ------------------------->
                                                                <div class="modal fade" id="modal_introduced_profile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" dir="rtl">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleModalLabel">مشخصات دوستان</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="col-12 text-center">
                                                                                    <div class="spinner-border text-primary text-center" role="status">
                                                                                        <span class="sr-only">Loading...</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 text-center">

                                                                </div>
                                                            </section>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!________________________ لینک ________________________>
                                                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">

                                                    <div class="form-group mb-4">
                                                        <label for="general-link" class="font-medium-1 mb-1"> لینک عمومی معرفی شما : </label>
                                                        <input type="text" class="form-control"  name="fname" id="general-link" value="" disabled="disabled"/>
                                                    </div>



                                                    <!______________secend Tab tables _ link part -------------------------->

                                                    <nav>
                                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                            <button class="nav-link active" id="nav-home-tab" data-toggle="tab" data-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">متقاضی</button>
                                                            <button class="nav-link" id="nav-profile-tab" data-toggle="tab" data-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">مشتری</button>
                                                            <button class="nav-link" id="nav-contact-tab" data-toggle="tab" data-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">انصراف</button>
                                                        </div>
                                                    </nav>
                                                    <div class="tab-content" id="nav-tabContent">
                                                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                                            <section class="col-12 table-responsive">
                                                                <table class="table table-striped">
                                                                    <thead>
                                                                    <tr>
                                                                        <th scope="col">ردیف</th>
                                                                        <th scope="col">    </th>
                                                                        <th scope="col">نام و نام خانوادگی </th>
                                                                        <th scope="col">شماره تماس</th>
                                                                        <th scope="col">تاریخ ثبت</th>
                                                                        <th scope="col"> تعداد پیگیری</th>
                                                                        <th scope="col"> آخرین ورود</th>
                                                                        <th scope="col">مسئول پیگیری</th>
                                                                        <th scope="col">امتیاز</th>
                                                                        <th scop="col"></th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>

                                                                    </tbody>
                                                                </table>
                                                                <!------------------------------------------ Modal ------------------------->
                                                                <div class="modal fade" id="modal_introduced_profile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" dir="rtl">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleModalLabel">مشخصات دوستان</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="col-12 text-center">
                                                                                    <div class="spinner-border text-primary text-center" role="status">
                                                                                        <span class="sr-only">Loading...</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 text-center">

                                                                </div>
                                                            </section>
                                                        </div>
                                                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                                            <section class="col-12 table-responsive">
                                                                <table class="table table-striped">
                                                                    <thead>
                                                                    <tr>
                                                                        <th scope="col">ردیف</th>
                                                                        <th scope="col">    </th>
                                                                        <th scope="col">نام و نام خانوادگی </th>
                                                                        <th scope="col">شماره تماس</th>
                                                                        <th scope="col">تعداد محصول</th>
                                                                        <th scope="col"> مبلغ خرید</th>
                                                                        <th scope="col">امتیاز</th>

                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>

                                                                    </tbody>
                                                                </table>
                                                                <!------------------------------------------ Modal ------------------------->
                                                                <div class="modal fade" id="modal_introduced_profile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" dir="rtl">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleModalLabel">مشخصات دوستان</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="col-12 text-center">
                                                                                    <div class="spinner-border text-primary text-center" role="status">
                                                                                        <span class="sr-only">Loading...</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 text-center">

                                                                </div>
                                                            </section>
                                                        </div>
                                                        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                                            <section class="col-12 table-responsive">
                                                                <table class="table table-striped">
                                                                    <thead>
                                                                    <tr>
                                                                        <th scope="col">ردیف</th>
                                                                        <th scope="col">     </th>
                                                                        <th scope="col">نام و نام خانوادگی </th>
                                                                        <th scope="col">شماره تماس</th>
                                                                        <th scope="col">امتیاز</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    </tbody>
                                                                </table>
                                                                <!------------------------------------------ Modal ------------------------->
                                                                <div class="modal fade" id="modal_introduced_profile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" dir="rtl">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleModalLabel">مشخصات دوستان</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="col-12 text-center">
                                                                                    <div class="spinner-border text-primary text-center" role="status">
                                                                                        <span class="sr-only">Loading...</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 text-center">

                                                                </div>
                                                            </section>
                                                        </div>
                                                    </div>



                                                </div>
                                            </div>
                                        </div>

                                        <!___________________________ فاکتور -------------------------->
                                        <div class="tab-pane fade" id="nav-factors" role="tabpanel" aria-labelledby="nav-factors-tab">...</div>

                                        <!___________________________ جایگاه شما  -------------------------->
                                        <div class="tab-pane fade" id="nav-position" role="tabpanel" aria-labelledby="nav-position-tab">

                                            <h5 style="color: #3a283d" class="m-2">
                                              {{--
                                                *  جایگاه شما در فصل اخیر نفر <mark><bold>{{$currentPosition}}</bold></mark> از {{$getAmbassador_tmp->count()}} نفر است  *
                                                --}}
                                            </h5>

                                            <section class="col-12 table-responsive">
                                                <table class="table table-striped">
                                                    <thead>
                                                    <tr class="text-center">
                                                        <th scope="col">ردیف</th>
                                                        <th scope="col">  </th>
                                                        <th scope="col">نام و نام خانوادگی </th>
                                                        <th scope="col">تعداد معرفی</th>
                                                        <th scope="col">امتیاز</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach ($getAmbassador as $items )
                                                        <tr class="text-center">
                                                            <td>
                                                                {{$loop->iteration}}
                                                            </td>
                                                            <td>
                                                                <img class="profile rounde" src="{{asset('documents/users/'.$item->personal_image)}}" alt="" width="25px"/>
                                                            </td>
                                                            <td>
                                                                <div class="box-title">{{$items->fname.' '.$items->lname}}</div>
                                                            </td>
                                                            <td>
                                                                <div class="box-title"><b>{{($items->get_invitations->count())}}</b></div>
                                                            </td>
                                                            <td>
                                                                <div class="box-title"></div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                                {{$getAmbassador->links()}}
                                                <!------------------------------------------ Modal ------------------------->
                                                <div class="modal fade" id="modal_introduced_profile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" dir="rtl">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">مشخصات دوستان</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="col-12 text-center">
                                                                    <div class="spinner-border text-primary text-center" role="status">
                                                                        <span class="sr-only">Loading...</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 text-center">

                                                </div>
                                            </section>



                                        </div>
                                    </div>





                                </div>
                            </section>

                            <!------------------------------- FOLLWO UP ----------------------------->


                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('footerScript')
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/jquery-validation/dist/jquery.validate.min.js')}}"></script>
    <script src="{{asset('vendor/jquery-validation/dist/additional-methods.min.js')}}"></script>
    <script src="{{asset('vendor/jquery-steps/jquery.steps.min.js')}}"></script>
    <script src="{{asset('vendor/minimalist-picker/dobpicker.js')}}"></script>
    <script src="{{asset('vendor/nouislider/nouislider.min.js')}}"></script>
    <script src="{{asset('vendor/wnumb/wNumb.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>

    <script src="{{asset('/panel_assets/intl_tel/js/intlTelInput.js')}}"></script>
    <script src="{{asset('/panel_assets/intl_tel/js/utils.js')}}"></script>
    <!--_________________Time line Step by step    -->
    <script>
        var next_click=document.querySelectorAll(".next_button");
        var main_form=document.querySelectorAll(".main");
        var step_list = document.querySelectorAll(".progress-bar li");

        var num = document.querySelector(".step-number");

        @if(Auth::user()->introduced_verified==2)
            let formnumber=3;
        @else
            let formnumber=0;
        @endif

        next_click.forEach(function(next_click_form){
            next_click_form.addEventListener('click',function(){
                if(!validateform()){
                    return false
                }
                formnumber++;
                updateform();
                progress_forward();
                contentchange();
            });
        });

        var back_click=document.querySelectorAll(".back_button");
        back_click.forEach(function(back_click_form){
            back_click_form.addEventListener('click',function(){
                formnumber--;

                updateform();
                progress_backward();
                contentchange();
            });
        });

        var username=document.querySelector("#user_name");
        var shownname=document.querySelector(".shown_name");


        var submit_click=document.querySelectorAll(".submit_button");
        submit_click.forEach(function(submit_click_form){
            submit_click_form.addEventListener('click',function(){
                shownname.innerHTML= username.value;
                formnumber++;
                updateform();
            });
        });
        var heart=document.querySelector(".fa-heart");
        heart.addEventListener('click',function(){
            heart.classList.toggle('heart');
        });
        var share=document.querySelector(".fa-share-alt");
        share.addEventListener('click',function(){
            share.classList.toggle('share');
        });

        function updateform(){
            main_form.forEach(function(mainform_number){
                mainform_number.classList.remove('active');
            })
            main_form[formnumber].classList.add('active');
        }

        function progress_forward(){
            // step_list.forEach(list => {

            //     list.classList.remove('active');

            // });


            num.innerHTML = formnumber+1;
            step_list[formnumber].classList.add('active');
        }

        function progress_backward(){
            var form_num = formnumber+1;
            step_list[form_num].classList.remove('active');
            num.innerHTML = form_num;
        }

        var step_num_content=document.querySelectorAll(".step-number-content");

        function contentchange(){
            step_num_content.forEach(function(content){
                content.classList.remove('active');
                content.classList.add('d-none');
            });
            step_num_content[formnumber].classList.add('active');
        }
        function validateform(){
            validate=true;
            var validate_inputs=document.querySelectorAll(".main.active input");
            validate_inputs.forEach(function(vaildate_input){
                vaildate_input.classList.remove('warning');
                if(vaildate_input.hasAttribute('require')){
                    if(vaildate_input.value.length==0){
                        validate=false;
                        vaildate_input.classList.add('warning');
                    }
                }
            });
            return validate;
        }

    </script>
    <!--__________________style_Selected________________________________________________-->
    <!--  DATE SHAMSI PICKER  --->
    <script src="{{asset('js/kamadatepicker.min.js')}}"></script>
    <script src="{{asset('js/kamadatepicker.holidays.js')}}"></script>
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

        $('#services').change(function()
        {
            $('#orientation').html("");

            $.ajax({
                url:'/panel/clinic_basic_info/speciality/'+$(this).val(),
                type:'get',
                success(data)
                {
                    //errorsHtml='<option disabled selected>انتخاب کنید</option>';
                    errorsHtml='';
                    $.each( data, function( key, value ) {
                        errorsHtml += '<div class="form-check form-check-inline"> <input class="form-check-input speciality" type="checkbox" value="'+value.id+'" id="speciality'+value.id+'" onclick="speciality_change()"><label class="form-check-label" for="speciality'+value.id+'">'+value.title+'</label></div>'

                    });
                    $( '#speciality' ).html( errorsHtml );

                }
            })
        });

        function speciality_change()
        {
            if($('.speciality:checked').length>0)
            {
                errorsHtml='';
                $('.speciality').each(function (){
                    if($(this).is(':checked'))
                    {
                        $.ajax({
                            url:'/panel/clinic_basic_info/speciality/'+$(this).val(),
                            type:'get',
                            success(data)
                            {

                                $.each( data, function( key, value ) {
                                    errorsHtml += '<div class="form-check form-check-inline"> <input class="form-check-input" type="checkbox" value="'+value.id+'" id="orientation'+value.id+'" name="fk_orientations[]"><label class="form-check-label" for="orientation'+value.id+'">'+value.title+'</label></div>'

                                });

                                $( '#orientation' ).html(errorsHtml);

                            }
                        })
                    }
                });
            }
            else
            {
                $( '#orientation' ).html('');
            }


            // console.log($('.speciality').val());

        }

    </script>
    <script src="/trumbowyg-2.25.1/dist/trumbowyg.min.js"></script>
    <script src="/trumbowyg-2.25.1/dist/langs/fa.js"></script>
    <script>
        $('.textarea').trumbowyg({
            lang:'fa',
            btns: [
                ['undo', 'redo'], // Only supported in Blink browsers
                ['formatting'],
                ['strong', 'em', 'del'],
                ['superscript', 'subscript'],
                //['link'],
                ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
                ['unorderedList', 'orderedList'],
                ['horizontalRule'],
                ['removeformat'],
                ['fullscreen']
            ]
        })
    </script>
<!------------------------list introduced user   --------------------------------- -->

    <script>

        var input = document.querySelector("#tel");
        var intl=intlTelInput(input,{
            formatOnDisplay:false,
            separateDialCode:true,
            preferredCountries:["ir", "gb"]
        });



        input.addEventListener("countrychange", function() {
            document.querySelector("#tel_org").value=intl.getNumber();
        });

        $('#tel').change(function()
        {
            document.querySelector("#tel_org").value=intl.getNumber();
        });
    </script>
    <script src="{{asset('/trumbowyg-2.25.1/dist/trumbowyg.min.js')}}"></script>
    <script src="{{asset('/trumbowyg-2.25.1/dist/langs/fa.js')}}"></script>
    <script>
        $('#tweet').trumbowyg({
            lang:'fa',
            btns: [
                ['undo', 'redo'], // Only supported in Blink browsers
                ['formatting'],
                ['strong', 'em', 'del'],
                ['superscript', 'subscript'],
                ['link'],
                ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
                ['unorderedList', 'orderedList'],
                ['horizontalRule'],
                ['removeformat'],
                ['fullscreen']
            ]
        })
    </script>
    <script>
        function show()
        {
            document.getElementById("viwe").style.display="block";
        }

    </script>
@endsection
