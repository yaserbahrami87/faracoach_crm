
<div class="container" style="text-align: right" id="training_main">
    <div class="row">
        <h4 class="m-auto p-3"> دوره رایگان آموزش مقدماتی کوچینگ با ارائه مدرک بین المللی معتبر CCE</h4>
    </div>
    <div class="row mt-3">
        <div class="col-md-6 ">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5 style="float: right">توضیحات دوره</h5>
                </div>
                <div class="ibox-content profile-content">

                    <p><i class="fa fa-clock-o"></i> این دوره به مدت 3 ساعت می باشد که در طول دوره 3 کد معرفی می شود، این کدها در واقع رمز ورود شما به آزمون دوره برای دریافت مدرک می باشد</p>
                    <h5><i class="bi bi-book-fill"></i>
                        دوره رایگان آموزش مقدماتی کوچینگ شامل سرفصل های زیر می باشد:
                    </h5>
                    <ol class="text-right line-height-2">
                        <li>باورهای بنیادین کوچینگ </li>
                        <li>کاربرد علوم مختلف مثل روانشناسی ومدیریت در کوچینگ</li>
                        <li>جایگاه کوچینگ در ایران و جهان</li>
                        <li>کوچ کیست؟</li>
                        <li>تعریف کوچینگ از دیدگاه سازمان جهانی کوچینگ ICF</li>
                        <li>نظام ارزشها چیست و جایگاه آن در کوچینگ</li>
                    </ol>
                    <div class="row m-t-md">
                        <h5><i class="bi bi-mortarboard-fill"></i>
                            آزمون و گواهینامه بین المللی:
                        </h5>
                        <p style="margin-right:40px;text-align: justify">در ادامه ارزیابی و بررسی رزومه های دریافتی، متقاضیان حضور در بورسیه پس از برگزاری وبینار، موظفند در آزمون ورود به دوره اصلی که از محتوای این وبینار طراحی شده است شرکت نموده و نمره قبولی را کسب نمایند. </p>
                        <p style="margin-right:40px;text-align: justify">از طرف آکادمی فراکوچ برای قبول شدگان در این آزمون، گواهینامه معتبر بین المللی CCE که مورد تائید فدراسیون جهانی کوچینگ ICF می باشد صادر و اعطا خواهد شد.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title ">
                    <h5 class="float-right">ویدئو آموزشی</h5>
                </div>
                <div class="ibox-content" style="margin-top: 10px">
{{--                    <style>.h_iframe-aparat_embed_frame{position:relative;}.h_iframe-aparat_embed_frame .ratio{display:block;width:100%;height:auto;}.h_iframe-aparat_embed_frame iframe{position:absolute;top:0;left:0;width:100%;height:100%;}</style><div class="h_iframe-aparat_embed_frame"><span style="display: block;padding-top: 57%"></span><iframe src="https://www.aparat.com/video/video/embed/videohash/yCEac/vt/frame" allowFullScreen="true" webkitallowfullscreen="true" mozallowfullscreen="true"></iframe></div>--}}
                    <a href="https://www.skyroom.online/ch/faracoach/sc2024"   target="_blank">
                        <img src="/images/scholarship/banner-webinar.jpg" class="img-fluid mb-3">
                    </a>

                   <div>
                        <p class="text-center mt-3">کد حضور در دوره آموزشی</p>
                        <div id="result_checkCodeWebinar"></div>

                        @if(Auth::user()->sch2024->confirm_webinar==1)
                                <div class="alert alert-success">کد شرکت در دوره آموزشی با موفقیت ثبت شده است</div>
                        @elseif(Auth::user()->get_recieveCodeUsers->where('type','sch2024')->count()>=3)
                                <div class="alert alert-danger">تعداد مجاز ورود دفعات کد دوره آموزشی  3 بار می باشد</div>
                        @else
                            <form method="post" class="text-center"  id="frm_checkCodeWebinar">
                                {{csrf_field()}}
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <label for="code3">کد اول</label>
                                        <input type="number" class="form-control code text-center" id="code1" max="99"   maxlength="2" name="code1"/>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label for="code2">کد دوم</label>
                                        <input type="number" class="form-control code text-center" id="code2"   maxlength="2" name="code2"/>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label for="code1">کد سوم</label>
                                        <input type="number" class="form-control code text-center" id="code3"  maxlength="2" name="code3"/>
                                    </div>
                                    <button type="button" class="btn btn-primary mb-2 d-block btn-block mt-3 mb-1" onclick="checkCodeWebinar()">ورود کد کلاسی و کسب امتیاز</button>
                                </div>
                            </form>
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>
</div>
