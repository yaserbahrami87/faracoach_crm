<div class="card-body" >
    <p>آکادمی بین المللی فراکوچ به  عنوان  اولین آموزشگاه مجاز کوچینگ در ایران و با اعتبار بین المللی تا کنون با پذیرش بیش از 1000 دانشپذیر در دوره های مختلف آموزش کوچینگ، بزرگترین  موسسه  آموزش کوچینگ در ایران محسوب می شود.</p>
    <p class="text-justify">پس از استقبال کم نظیر مشتاقان مسیر توسعه فردی و کسب و کار و کوچینگ از فرصت بی نظیر و البته محدود بورسیه کوچینگ جهت ورود به این اکوسیستم، بر آن شدیم که برای افراد مستعد، نخبه و توانمند جامعه به ویژه اساتید، پژوهشگران، اندیشمندان، مدیران و دانشجویان برتر علی الخصوص رشته های مدیریت، روانشاسی و مشاوره، علوم رفتاری و آموزشی، منابع انسانی و ... شناسایی کرده و تحت عنوان "بورسیه کوچینگ"  از آنها حمایت نماییم.                    </p>
    <p>سرفصل ها:</p>
    <ol>
        <li>باورهای بنیادین کوچینگ </li>
        <li>کاربرد علوم مختلف مثل روانشناسی ومدیریت در کوچینگ</li>
        <li>جایگاه کوچینگ در ایران و جهان</li>
        <li>کوچ کیست؟</li>
        <li>تعریف کوچینگ از دیدگاه سازمان جهانی کوچینگ ICF</li>
        <li>نظام ارزشها چیست و جایگاه آن در کوچینگ</li>
    </ol>
    <p>آزمون و گواهینامه بین المللی:</p>
    <p>در ادامه ارزیابی و بررسی رزومه های دریافتی، متقاضیان حضور در بورسیه پس از برگزاری وبینار، موظفند در آزمون ورود به دوره اصلی که از محتوای این وبینار طراحی شده است شرکت نموده و نمره قبولی را کسب نمایند. </p>
    <p>از طرف آکادمی فراکوچ برای قبول شدگان در این آزمون، گواهینامه معتبر بین المللی CCE که مورد تائید فدراسیون جهانی کوچینگ ICF می باشد صادر و اعطا خواهد شد.</p>

    <div class="row">
        <div class="col-12 col-md-6 mb-1">
            <b class="d-block mb-2 text-center bg-primary text-white p-2">گام اول: تماشا فیلم آموزشی</b>
            <style>.h_iframe-aparat_embed_frame{position:relative;}.h_iframe-aparat_embed_frame .ratio{display:block;width:100%;height:auto;}.h_iframe-aparat_embed_frame iframe{position:absolute;top:0;left:0;width:100%;height:100%;}</style><div class="h_iframe-aparat_embed_frame"><span style="display: block;padding-top: 57%"></span><iframe src="https://www.aparat.com/video/video/embed/videohash/yCEac/vt/frame" allowFullScreen="true" webkitallowfullscreen="true" mozallowfullscreen="true"></iframe></div>
        </div>
        <div class="col-12 col-md-6">
            <b class="d-block mb-2 text-center bg-primary text-white p-2">گام دوم: ثبت نام در وبینار</b>
            <a href="https://evnd.co/dkf4a" target="_blank">
                <img src="{{asset('/images/scholarship_webinar.jpg')}}" class="img-fluid" />
                <p class="text-center btn btn-primary btn-block">ثبت نام</p>
            </a>
        </div>

        <div class="d-sm-none d-md-block col-lg-4"></div>
        <div class="col-12 col-lg-4 d-sm-none d-md-block">
            <p class="text-center">کد حضور در وبینار</p>
            <div id="result_checkCodeWebinar"></div>
            @if($scholarship->confirm_webinar==1)
                <div class="alert alert-success">کد شرکت در وبینار با موفقیت ثبت شده است</div>
            @elseif($scholarship->user->get_recieveCodeUsers->count()>=3)
                <div class="alert alert-danger">تعداد مجاز ورود دفعات کد وبینار بورسیه 3 بار می باشد</div>
            @else
                <form method="post" class="text-center"  id="frm_checkCodeWebinar">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-4 col-md-4">
                            <label for="code1">کد سوم</label>
                            <input type="number" class="form-control code text-center" id="code3"  maxlength="2" name="code3"/>
                        </div>
                        <div class="col-4 col-md-4">
                            <label for="code2">کد دوم</label>
                            <input type="number" class="form-control code text-center" id="code2"   maxlength="2" name="code2"/>
                        </div>
                        <div class="col-4 col-md-4">
                            <label for="code3">کد اول</label>
                            <input type="number" class="form-control code text-center" id="code1"   maxlength="2" name="code1"/>
                        </div>
                        <button type="button" class="btn btn-primary mb-2 d-block btn-block mt-1 mb-1" onclick="checkCodeWebinar()">ورود کد کلاسی و کسب امتیاز</button>
                    </div>
                </form>
            @endif
        </div>
        <div class="d-sm-none d-md-block col-lg-4"></div>
    </div>
</div>