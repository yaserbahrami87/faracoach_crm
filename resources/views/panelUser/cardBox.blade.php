@if($user->tel_verified==0)
    <div class="col-12">
        <div class="alert alert-danger">
            <i class="bi bi-exclamation-triangle-fill"></i>
            برای ادامه فعالیت باید تلفن همراه خود را در سیستم فراکوچ ثبت کنید
        </div>
        @if ($verifyStatus==false)
            <form method="get" action="/panel/active/mobile/">
                <button class="btn btn-outline-secondary btn-info text-light mb-2" type="submit" id="activeMobile" data-toggle="modal" data-target="#ModalMobile">ارسال کد فعال سازی</button>
            </form>
        @else
            <div class="alert alert-warning">
                جهت فعال سازی کد ارسال شده به تلفن همراه را وارد کنید
            </div>
            <form method="post" action="/panel/active/mobile/code">
                {{csrf_field()}}
                <div class="input-group">
                    <input id="tel" type="text" class="form-control @error('tel') is-invalid @enderror" name="tel" value="{{ old('tel') }}" required autocomplete="tel">
                    <div class="input-group-prepend ">
                        <button class="btn btn-outline-secondary btn-info text-light m-0" type="submit" id="activeMobile" data-toggle="modal" data-target="#ModalMobile">فعال سازی</button>
                    </div>
                </div>
            </form>
        @endif

    </div>
@endif

<div class="col-lg-3 col-md-6 col-sm-6">
    <div class="info-box">
        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-envelope"></i></span>
        <div class="info-box-content">
            <span class="info-box-text">
                <a href="/panel/messages/">خوانده نشده</a>
            </span>
            <span class="info-box-number">
                  {{$unreadMessage}}
                  <small>پیام</small>
                </span>
        </div>
    </div>
</div>
<div class="col-lg-3 col-md-6 col-sm-6">
    <div class="info-box">
        <span class="info-box-icon bg-warning elevation-1 text-light"><i class="fas fa-project-diagram"></i></span>
        <div class="info-box-content">
            <span class="info-box-text">
                <a href="/panel/introduced">افراد دعوت شده</a>
            </span>
            <span class="info-box-number">
                  {{$countIntroducedUser}}
                  <small>نفر</small>
            </span>
        </div>
    </div>
</div>
<div class="col-lg-3 col-md-6 col-sm-6">
    <div class="info-box">
        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-medal"></i></span>
        <div class="info-box-content">
            <span class="info-box-text">
                <a href="#" data-toggle="modal" data-target="#ScoreModal">امتیازات</a>
            </span>
            <span class="info-box-number">
                  {{$score}}
                  <small>امتیاز</small>
            </span>
        </div>
    </div>
</div>
<div class="container-fluid">
    @if($user->status_coach==0)
        <div class="col-lg-4 col-md-6 col-sm-6 p-0">
            <a href="panel/coach/create"  class="btn btn-info btn-lg">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-square" viewBox="0 0 16 16">
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                    <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1v-1c0-1-1-4-6-4s-6 3-6 4v1a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12z"/>
                </svg>
                <p>همکاری به عنوان کوچ</p>
            </a>
        </div>
    @elseif($user->status_coach=='-1')
        <div class="col-lg-4 col-md-6 col-sm-6 p-0">
            <a href="#"  class="btn btn-warning btn-lg">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-square" viewBox="0 0 16 16">
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                    <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1v-1c0-1-1-4-6-4s-6 3-6 4v1a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12z"/>
                </svg>
                <p>درخواست همکاری شما در حال بررسی است</p>
            </a>
        </div>
    @elseif($user->status_coach==1)

        <div class="col-lg-4 col-md-4 col-sm-6 p-0">
            <a href="/panel/coach/{{$user->id_coaches_table}}/edit"  class="btn btn-success btn-lg">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-square" viewBox="0 0 16 16">
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                    <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1v-1c0-1-1-4-6-4s-6 3-6 4v1a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12z"/>
                </svg>
                <p>شما یک کوچ هستید</p>
            </a>
        </div>
    @elseif($user->status_coach==-2)
        <div class="col-lg-4 col-md-4 col-sm-6 p-0">
            <a href="/panel/coach/{{$user->id_coaches_table}}/edit"  class="btn btn-danger btn-lg">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-square" viewBox="0 0 16 16">
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                    <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1v-1c0-1-1-4-6-4s-6 3-6 4v1a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12z"/>
                </svg>
                <p>درخواست همکاری شما رد شد</p>
            </a>
        </div>
    @endif

    <div class="col-12 mt-3">
        <a href="/panel/integrity/files" class="btn btn-success btn-block mt-3 btn-lg" target="_blank" >لینک مشاهده ویدئوی وبینار تمامیت</a>
    </div>
    <div class="col-12 mt-3">
        <!--
        <p class="text-center text-bold">قوانین و مقررات شرکت در دوره‌ آنلاین</p>
        <ol>
            <li class="">دوره‌های آنلاین موسسه فراکوچ توسط سایت اسکای روم برگزار می‌شود و نیاز به نصب برنامه خاصی بر روی کامپیوتر یا گوشی موبایل نیست. </li>
            <li>برای شرکت در دوره نیاز به اینترنت پر سرعت ندارید. سرعت اینترنت گوشی‌های موبایل پاسخگوی کلاس خواهد بود. </li>
            <li> این وبینار در تاریخ 1 مهر روز پنجشنبه، از ساعت ۱۷ تا ساعت ۲۰ برگزار خواهد شد.</li>
            <li> فایل صوتی کلاس توسط موسسه ضبط خواهد شد و پس از پایان دوره در غالب یک لینک دانلود به شرکت کننده داده خواهد شد تا ایشان بتواند فایل صوتی کلاس را دانلود کند تا بتواند بعدها با مرور آن مبحث را برای خودش مرور کند. </li>
            <li>اگر برای وصل شدن به صفحه کلاس نیاز به راهنمایی داشته باشید می‌توانید روز قبل از کارگاه، از کاربران فنی موسسه راهنمایی بگیرید. این امکان در لحظه شروع کلاس عملا مقدور نخواهد بود. </li>
            <li>تصویر شرکت کنندگان توسط مربی و سایر شرکت کنندگان دیده نخواهد شد. هر فردی می‌تواند پوشش خاص خودش را داشته باشد. </li>
            <li>در صورت داشتن سوال، افراد مانند کلاس‌های حضوری می‌توانند با بلند کردن دست و وصل شدن میکروفون توسط استاد، سوال خود را مطرح کنند.</li>
            <li>ثبت نام در دوره آموزشی به منزله پذیرش تمامی موارد فوق است.</li>
        </ol>
        -->
        <a href="/panel/integrityTest" class="btn btn-block btn-lg btn-warning mb-5">برای آشنایی اولیه با موضوع تمامیت این تست را انجام دهید</a>
    </div>

</div>

<!-- Modal Scores-->
<div class="modal fade" id="ScoreModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">گزارش امتیازات</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
              <div class="col-12 mr-3">
                <ul class="list-group p-0 border-0">

                    <li class="list-group-item">
                        <div class="row border pt-2">
                            <div class="col-md-6 col-2">
                                <p> افراد دعوت شده {{$countIntroducedUser}} نفر</p>
                            </div>
                            <div class="col-md-6 col-3 text-right">
                                <p>{{$scoreIntroducedUser}} امتیاز</p>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row border pt-2">
                            <div class="col-md-6 col-2">
                                <p> ثبت شماره همراه</p>
                            </div>
                            <div class="col-md-6 col-3 text-right">
                                <p>{{$scoreTelverify}} امتیاز</p>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row border pt-2">
                            <div class="col-md-6 col-2">
                                <p> ثبت پست الکترونیکی</p>
                            </div>
                            <div class="col-md-6 col-3 text-right">
                                <p>{{$scoreEmailverify}} امتیاز</p>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row border pt-2">
                            <div class="col-md-6 col-2">
                                <p>دانشجوی معرفی شده {{$SuccessIntroduced}} نفر</p>
                            </div>
                            <div class="col-md-6 col-3 text-right">
                                <p>{{$scoreSuccess}} امتیاز</p>
                            </div>
                        </div>
                    </li>
                </ul>

            </div>
          </div>
        </div>
        <div class="modal-footer">

        </div>
      </div>
    </div>
  </div>
