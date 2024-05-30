
    <link src="{{asset('/css/jquery-book.css')}}"></link>
    <style>

        #exam-title
        {
            padding-right: 50px;
            text-align: right;
            margin-top: 30px;
        }

        #fff{
            /*border: 2px solid rgba(2,1,19,.81);*/
            /*border-radius:20px;*/
            margin: 25px 50px 0px 0px;
            padding: 20px;
            box-shadow: 6px 0px 20px #c6c9cc;
        }
        .progress {position:relative;
        }

        .progress span {
            position:absolute;
            left:0;
            width:100%;
            text-align:center;
            z-index:2;
            font-weigh:bold;
        }

        #exam-progress{
            height: 25px;
            background: #475F7B!important;
            padding: 5px;
            overflow: visible;
            border-radius: 20px;
            border-top: 1px solid #475F7B;
            border-bottom: 1px solid #475F7B;
            margin-top: 50px;
        }

        #exam-progress div.progress-bar{
            border-radius: 20px;
            position: relative;
            animation: animate-positive 2s;
            background-color: #ea5456;
            box-shadow: 0 0px 0px 0px rgb(234, 94, 94);
        }

        .progress .progress-value{
            display: block;
            padding: 3px 7px;
            font-size: 13px;
            color: #fff;
            border-radius: 4px;
            background: #475F7B ;
            border: 1px solid #000;
            position: absolute;
            top: -40px;
            right: -10px;
        }

        .progress .progress-value:after{
            content: "";
            border-top: 10px solid #191919;
            border-left: 10px solid transparent;
            border-right: 10px solid transparent;
            position: absolute;
            bottom: -6px;
            left: 26%;
        }

        .progress-bar.active{
            animation: reverse progress-bar-stripes 0.40s linear infinite, animate-positive 2s;
        }
        #demo p , #demo label
        {
            text-align: right;
        }
        #demo p
        {
            font-weight: bold;
        }
        #demo label
        {
            font-size: 13px;
        }
        #demo input
        {
            /*float: right;*/
            /*margin-top: 8px;*/
            /*margin-left: 15px;*/
        }

        @media only screen and (max-width: 750px)  {
            #fff
            {
                margin: 0px;
            }
            #exam-title
            {
                padding-right: 25px;
            }
            #exam-title h6
            {
                font-size: 13px;
            }

        }
        @-webkit-keyframes animate-positive{
            0% { width: 0; }
        }

        @keyframes animate-positive{
            0% { width: 0; }
        }
    </style>
            <div class="col-md-12 mb-2" id="exam-title">
                <h6>
                    دانشپذیر گرامی سلام<br>
                    به آزمون دوره مقدماتی خوش آمدید.<br>
                    باکسب حداقل 60 نمره از 100 شما در این آزمون قبول شده و میتوانید گواهینامه 2 ساعته بین المللی خود را دریافت کنید .                <br> درصورت عدم قبولی در مرحله اول، نهایتا یک بار دیگر فرصت آزمون خواهید داشت.<br>
                    امتیاز این آزمون در ارزیابی نهایی لحاظ خواهد شد اما قبولی در آزمون ، پیش نیاز حضور در دوره فاندامنتال نیست و میتوانید وارد مراحل بعد شوید .
                    با آرزوی موفقیت برای شما.
                </h6>
            </div>

    @if(Auth::user()->get_scholarshipExam->where('resource','sch2024')->count()<2 && Auth::user()->sch2024->confirm_exam==0 )
            <div  class="col-md-11 " id="fff">
                <div class=" d-flex justify-content-center">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12  progress" id="exam-progress">
                        <div class="progress-bar progress-bar-success progress-bar-striped active" style="width: 0%;">
                            <div class="progress-value">0%</div>
                        </div>
                    </div>
                </div>
                <div class=" d-flex justify-content-center">
                       <div class=" col-xl-6 col-lg-6 col-md-6 col-sm-12">
                        <form name="demo" id="demo" method="POST" action="/panel/sch2024/exam" class="myBook mt-4">
                            {{csrf_field()}}
                            <section >
                                <p>1- در کدام گزینه تعریف درستی از کوچینگ ارائه <u>نشده است</u>؟</p>
                                <div class="form-group">
                                    <input class="page-next" type="radio" id="vehicle1_5" name="vehicle1" value="0" required />
                                    <label for="vehicle1_5"> کوچینگ یعنی کشف توانایی مراجع توسط مهارت یک کوچ</label><br>
                                </div>
                               <div class="form-group">
                                   <input class="page-next" type="radio" id="vehicle1_4" name="vehicle1" value="0" required />
                                   <label for="vehicle1_4">کوچینگ یعنی تلاش برای رسیدن مراجع از دنیای موجود به دنیای مطلوب</label><br>
                               </div>
                                <div class="form-group">
                                    <input class="page-next" type="radio" id="vehicle1_3" name="vehicle1" value="4" required />
                                    <label for="vehicle1_3"> کوچینگ یعنی راهنمایی مراجع برای رسیدن به هدف</label><br/>
                                </div>
                               <div class="form-group">
                                   <input class="page-next" type="radio" id="vehicle1_2" name="vehicle1" value="0" required />
                                   <label for="vehicle1_2"> کوچینگ گفتگوی هدفدار بین کوچ و مراجع، برای کشف راه‌حل توسط مراجع</label><br>
                               </div>
                                <div class="col-12 text-center mt-4 form-group">
                                    <button type="button" class="page-prev btn btn-danger col-5 ">سوال قبلی</button>
                                    <button type="button" class="page-next btn btn-primary col-5"> سوال بعدی </button>
                                </div>
                            </section>
                            <section>
                                <p>2- کدام گزینه در مورد کوچینگ صحیح <u>نمی باشد</u>؟</p>
                                <div class="form-group">
                                    <input class="page-next" type="radio" id="vehicle2_5" name="vehicle2" value="0" required>
                                    <label for="vehicle2_5">در کوچینگ از طریق فرمول و پروتکل های از پیش تعیین شده مساله  مراجع حل می‌شود</label>
                                </div>
                               <div class="form-group">
                                   <input class="page-next" type="radio" id="vehicle2_4" name="vehicle2" value="4" required>
                                   <label for="vehicle2_4"> در کوچینگ تمرکز بر روی حال و آینده مراجع است  </label>
                               </div>
                                <div class="form-group">
                                    <input class="page-next" type="radio" id="vehicle2_3" name="vehicle2" value="0" required>
                                    <label for="vehicle2_3">در کوچینگ به حل مشکلات گذشته مراجع پرداخته نمی‌شود</label>
                                </div>
                                <div class="form-group">
                                    <input class="page-next" type="radio" id="vehicle2_2" name="vehicle2" value="0" required>
                                    <label for="vehicle2_2"> در کوچینگ منبع دانش مراجع است</label><br>
                                </div>

                                <div class="col-12 text-center mt-3 form-group">
                                    <button type="button" class="page-prev btn btn-danger col-5 ">سوال قبلی</button>
                                    <button type="button" class="page-next btn btn-primary col-5"> سوال بعدی </button>
                                </div>
                            </section>
                            <section >
                                <p>3- اگر کوچ در زمینه یا موضوع مراجع اطلاعات یا دانش تخصصی دارد:
                                </p>
                                <div class="form-group">
                                    <input class="page-next" type="radio" id="vehicle3_5" name="vehicle3" value="0" required>
                                    <label for="vehicle3_5">با دریافت هزینه بیشتر این دانش و تخصص را به او ارائه می کند </label><br>
                                </div>
                                <div class="form-group">
                                    <input class="page-next" type="radio" id="vehicle3_4" name="vehicle3" value="4" required>
                                    <label for="vehicle3_4">کوچ اجازه اعمال و انتقال اطلاعات یا دانش شخصی به مراجع را ندارد </label><br>
                                </div>
                               <div class="form-group">
                                   <input class="page-next" type="radio" id="vehicle3_3" name="vehicle3" value="0" required>
                                   <label for="vehicle3_3">کوچ بعد از جلسه کوچینگ هم نمی‌تواند این اطلاعات یا دانش تخصصی را در اختیار مراجع قرار دهد</label><br/>
                               </div>
                               <div class="form-group">
                                   <input class="page-next"  type="radio" id="vehicle3_2" name="vehicle3" value="0" required>
                                   <label for="vehicle3_2"> کوچ میتواند مستقیما راهکار لازم را  هر موقع صلاح ببیند، ارائه دهد</label><br>
                               </div>

                                <div class="col-12 text-center mt-3 form-group">
                                    <button type="button" class="page-prev btn btn-danger col-5 ">سوال قبلی</button>
                                    <button type="button" class="page-next btn btn-primary col-5">سوال بعدی</button>
                                </div>
                            </section>
                            <section >
                                <p>4- اگر مراجع درخواست کند که کوچ برای او معرفی کسب و کار بنویسد، کوچ چه کاری باید انجام دهد؟
                                </p>
                                <div class="form-group">
                                    <input class="page-next"  type="radio" id="vehicle4_5" name="vehicle4" value="0" required>
                                    <label for="vehicle4_5">در ازای دریافت هزینه بنویسد</label><br>
                                </div>
                                <div class="form-group">
                                    <input class="page-next"  type="radio" id="vehicle4_4" name="vehicle4" value="0" required>
                                    <label for="vehicle4_4">ننویسد چون کوچ هنوز تجربه ای ندارد </label><br>
                                </div>
                                <div class="form-group">
                                    <input class="page-next"  type="radio" id="vehicle4_3" name="vehicle4" value="0" required>
                                    <label for="vehicle4_3">نپذیرد چرا که این کار مشاوره است و کوچینگ نیست</label><br/>
                                </div>

                               <div class="form-group">
                                   <input class="page-next"  type="radio" id="vehicle4_2" name="vehicle4" value="4" required>
                                   <label for="vehicle4_2"> با کمک کردن به مراجع تا موانع کسب درامد را پیدا کند با او همراهی کند</label><br>
                               </div>


                                <div class="col-12 text-center mt-3 form-group">
                                    <button type="button" class="page-prev btn btn-danger col-5 "> سوال قبلی</button>
                                    <button type="button" class="page-next btn btn-primary col-5">سوال بعدی</button>
                                </div>
                            </section>
                            <section >
                                <p>5- پایه ای ترین چیزهایی که باعث تغییر در تمام ابعاد زندگی ما می‌شود حوزه ..... /...... /....... / ...... است.
                                </p>
                                <div class="form-group">
                                    <input class="page-next"  type="radio" id="vehicle5_5" name="vehicle5" value="0" required>
                                    <label for="vehicle5_5"> باورها / عقاید / تغییر/ نیاز </label><br>
                                </div>
                                <div class="form-group">
                                    <input  class="page-next" type="radio" id="vehicle5_4" name="vehicle5" value="0" required>
                                    <label for="vehicle5_4">احساس / درک/ عقاید/ ارزش ها  </label><br>
                                </div>
                                <div class="form-group">
                                    <input class="page-next"  type="radio" id="vehicle3" name="vehicle5" value="0" required>
                                    <label for="vehicle3">توانایی/ رفتار/ ارزش/ باور </label><br/>
                                </div>
                               <div class="form-group">
                                   <input class="page-next"  type="radio" id="vehicle1" name="vehicle5" value="4" required>
                                   <label for="vehicle1"> افکار /عقاید / باورها / ارزش‌ها </label><br>
                               </div>


                                <div class="col-12 text-center mt-3 form-group">
                                    <button type="button" class="page-prev btn btn-danger col-5 ">سوال قبلی</button>
                                    <button type="button" class="page-next btn btn-primary col-5">سوال بعدی</button>
                                </div>
                            </section>
                            <section >
                                <p>6- کدام گزینه گویای نظام ارزشها نیست؟ </p>
                                <div class="form-group">
                                    <input class="page-next"  type="radio" id="vehicle6_5" name="vehicle6" value="0" required>
                                    <label for="vehicle6_5"> ارزش وابسته به زمان و مکان نیست </label><br>
                                </div>
                                <div class="form-group">
                                    <input class="page-next"  type="radio" id="vehicle6_4" name="vehicle6" value="0" required>
                                    <label for="vehicle6_4">ارزش قابل دست  یافتنی نیست </label><br>
                                </div>
                                <div class="form-group">
                                    <input class="page-next"  type="radio" id="vehicle6_3" name="vehicle6" value="0" required>
                                    <label for="vehicle6_3"> منشا ارزش ها از باور ماست </label><br/>
                                </div>
                                <div class="form-group">
                                    <input class="page-next"  type="radio" id="vehicle6_2" name="vehicle6" value="4" required>
                                    <label for="vehicle6_2"> توسعه و رشد یک ارزش محسوب می شود</label><br>
                                </div>
                                <div class="col-12 text-center mt-3 form-group">
                                    <button type="button" class="page-prev btn btn-danger col-5 ">سوال قبلی</button>
                                    <button type="button" class="page-next btn btn-primary col-5">سوال بعدی</button>
                                </div>
                            </section>
                            <section >
                                <p>7- رفتارهایی که از ما سرمی زند سه دلیل دارد:
                                </p>
                                <div class="form-group">
                                    <input class="page-next"  type="radio" id="vehicle7_5" name="vehicle7" value="0" required>
                                    <label for="vehicle7_5"> کسب سود، ارضای نیازها، توسعه و رشد  </label><br>
                                </div>
                               <div class="form-group">
                                   <input class="page-next"  type="radio" id="vehicle7_4" name="vehicle7" value="0" required>
                                   <label for="vehicle7_4"> شناساندن هویت، توسعه و رشد، دفع ضرر </label><br>
                               </div>
                                <div class="form-group">
                                    <input  class="page-next" type="radio" id="vehicle7_3" name="vehicle7" value="0" required>
                                    <label for="vehicle7_3"> کسب تجربه، ابراز احساسات، بازخورد </label><br/>
                                </div>
                                <div class="form-group">
                                    <input  class="page-next" type="radio" id="vehicle7_2" name="vehicle7" value="4" required>
                                    <label for="vehicle7_2"> کسب سود، دفع ضرر و رفتارهایی از سر عادت که عامل اصلی آن دیگر وجود ندارند </label><br>
                                </div>
                                <div class="col-12 text-center mt-3 form-group">
                                    <button type="button" class="page-prev btn btn-danger col-5 ">سوال قبلی</button>
                                    <button type="button" class="page-next btn btn-primary col-5">سوال بعدی</button>
                                </div>
                            </section>
                            <section >
                                <p>8- از منظر حوزه تمرکز، کوچینگ با مشاوره به ترتیب چه تفاوتی دارد؟
                                </p>
                                <div class="form-group">
                                    <input  class="page-next" type="radio" id="vehicle8_5" name="vehicle8" value="0" required>
                                    <label for="vehicle8_5"> با هم تفاوتی ندارند </label><br>
                                </div>
                                <div class="form-group">
                                    <input class="page-next"  type="radio" id="vehicle8_4" name="vehicle8" value="4" required>
                                    <label for="vehicle8_4">تحقق اهداف مراجع/ حل مشکلات مراجع  </label><br>
                                </div>
                                <div class="form-group">
                                    <input  class="page-next" type="radio" id="vehicle8_3" name="vehicle8" value="0" required>
                                    <label for="vehicle8_3">تحقق اهداف مراجع/ انتقال تجربه </label><br/>
                                </div>
                                <div class="form-group">
                                    <input  class="page-next" type="radio" id="vehicle8_2" name="vehicle8" value="0" required>
                                    <label for="vehicle8_2"> حل مشکلات ناشی از گذشته/ انتقال تجربه </label><br>
                                </div>
                                <div class="col-12 text-center mt-3 form-group">
                                    <button type="button" class="page-prev btn btn-danger col-5 ">سوال قبلی</button>
                                    <button type="button" class="page-next btn btn-primary col-5">سوال بعدی</button>
                                </div>
                            </section>
                            <section>
                                <p>9- کوچینگ از دو بعد کلی با دیگر روشهای پشتیبان متفاوت است:
                                </p>
                                <div class="form-group">
                                    <input class="page-next"  type="radio" id="vehicle9_5" name="vehicle9" value="4" required>
                                    <label for="vehicle9_5"> مخاطب/ رویکرد </label><br>
                                </div>
                                <div class="form-group">
                                    <input class="page-next"  type="radio" id="vehicle9_4" name="vehicle9" value="0" required>
                                    <label for="vehicle9_4">هدف / برنامه ریزی </label><br>
                                </div>
                                <div class="form-group">
                                    <input class="page-next"  type="radio" id="vehicle9_3" name="vehicle9" value="0" required>
                                    <label for="vehicle9_3"> تکنیک / مهارت </label><br/>
                                </div>
                                <div class="form-group">
                                    <input  class="page-next" type="radio" id="vehicle9_2" name="vehicle9" value="0" required>
                                    <label for="vehicle9_2"> رویکرد /  هدف </label><br>
                                </div>
                                <div class="col-12 text-center mt-3 form-group">
                                    <button type="button" class="page-prev btn btn-danger col-5 ">سوال قبلی</button>
                                    <button type="button" class="page-next btn btn-primary col-5">سوال بعدی</button>
                                </div>
                            </section>
                            <section >
                                <p>10- کوچینگ  بر کدام بخش وجودی انسان تمرکز دارد؟
                                </p>
                                <div class="form-group">
                                    <input class="page-next"  type="radio" id="vehicle10_5" name="vehicle10" value="0" required>
                                    <label for="vehicle10_5">نقاط ضعف </label><br>
                                </div>
                                <div class="form-group">
                                    <input class="page-next"  type="radio" id="vehicle10_4" name="vehicle10" value="0" required>
                                    <label for="vehicle10_4">احساسات منفی </label><br>
                                </div>
                                <div class="form-group">
                                    <input class="page-next"  type="radio" id="vehicle10_3" name="vehicle10" value="4" required>
                                    <label for="vehicle10_3">نقاط قوت و استعدادها</label><br/>
                                </div>
                                <div class="form-group">
                                    <input class="page-next"  type="radio" id="vehicle10_2" name="vehicle10" value="0" required>
                                    <label for="vehicle10_2"> حل مشکلات ناشی از گذشته/ انتقال تجربه </label><br>
                                </div>
                                <div class="col-12 text-center mt-3 form-group">
                                    <button type="button" class="page-prev btn btn-danger col-5 ">سوال قبلی</button>
                                    <button type="button" class="page-next btn btn-primary col-5">سوال بعدی</button>
                                </div>
                            </section>
                            <section >
                                <p>11-  ویژگیهای یک کوچ خوب چه چیزی <u>نیست</u> ؟</p>

                                <div class="form-group">
                                    <input class="page-next"  type="radio" id="vehicle11_5" name="vehicle11" value="0" required>
                                    <label for="vehicle11_5">توانایی برقراری ارتباط موثر داشته باشد .</label><br>
                                </div>
                                <div class="form-group">
                                    <input class="page-next"  type="radio" id="vehicle11_4" name="vehicle11" value="0" required>
                                    <label for="vehicle11_4">پرسشگری درست را یاد داشته باشد . </label><br>
                                </div>
                                <div class="form-group">
                                    <input class="page-next"  type="radio" id="vehicle11_3" name="vehicle11" value="0" required>
                                    <label for="vehicle11_3">عاشق کمک به دیگران باشد،علاقمند به رشد ،تغییر و موفقیت آنها باشد .</label><br/>
                                </div>
                                <div class="form-group">
                                    <input  class="page-next" type="radio" id="vehicle11_2" name="vehicle11" value="4" required>
                                    <label for="vehicle11_2"> بتواند  با  تکنیکهای حل مساله مشکل مراجع را حل نماید</label><br>
                                </div>
                                <div class="col-12 text-center mt-3 form-group">
                                    <button type="button" class="page-prev btn btn-danger col-5 ">سوال قبلی</button>
                                    <button type="button" class="page-next btn btn-primary col-5">سوال بعدی</button>
                                </div>
                            </section>
                            <section >
                                <p>تفاوت کوچینگ و منتورینگ چه چیزی <u>نیست</u> ؟
                                </p>
                                <div class="form-group">
                                    <input class="page-next"  type="radio" id="vehicle12_5" name="vehicle12" value="0" required>
                                    <label for="vehicle12_5"> منتورینگ فرایند طولانی دارد اما کوچینگ فرآیند کوتاه مدت با تمرکز بر توسعه عملکرد افراد است</label><br>
                                </div>
                                <div class="form-group">
                                    <input class="page-next"  type="radio" id="vehicle12_4" name="vehicle12" value="0"required >
                                    <label for="vehicle12_4">یک منتور اصولا در کسب و کار تجربیات جدی دارد اما کوچ لزوما نیازی به تجربه از موضوع ندارد . </label><br>
                                </div>
                                <div class="form-group">
                                    <input class="page-next"  type="radio" id="vehicle12_3" name="vehicle12" value="0"required >
                                    <label for="vehicle12_3">وظیفه کوچ تسهیل فرآیند توسعه وعملکرد اما منتور از طریق انتقال تجربه آموزش میدهد</label><br/>
                                </div>
                                <div class="form-group">
                                    <input class="page-next"  type="radio" id="vehicle12_2" name="vehicle12" value="4" required>
                                    <label for="vehicle12_2"> تفاوت آنها  در نوع برگزاری جلسات حرفه ای است</label><br>
                                </div>

                                <div class="col-12 text-center mt-3 form-group">
                                    <button type="button" class="page-prev btn btn-danger col-5 ">سوال قبلی</button>
                                    <button type="button" class="page-next btn btn-primary col-5">سوال بعدی</button>
                                </div>
                            </section>
                            <section >
                                <p>13- کوچ پذیری یعنی چه ؟
                                </p>
                                <div class="form-group">
                                    <input class="page-next"  type="radio" id="vehicle13_5" name="vehicle13" value="0" required >
                                    <label for="vehicle13_5"> خود مراجع آماده  تغییر باشد</label><br>
                                </div>
                                <div class="form-group">
                                    <input class="page-next"  type="radio" id="vehicle13_4" name="vehicle13" value="0" required >
                                    <label for="vehicle13_4">موضوع  مراجع ساده باشد </label><br>
                                </div>
                                <div class="form-group">
                                    <input  class="page-next" type="radio" id="vehicle13_3" name="vehicle13" value="0" required >
                                    <label for="vehicle13_3">مراجع نیاز به ارجاع به درمان و مشاوره و آموزش نداشته باشد</label><br/>
                                </div>
                                <div class="form-group">
                                    <input class="page-next"  type="radio" id="vehicle13_2" name="vehicle13" value="4" required >
                                    <label for="vehicle13_2"> الف و ج</label><br>
                                </div>
                                <div class="col-12 text-center mt-3 form-group">
                                    <button type="button" class="page-prev btn btn-danger col-5 ">سوال قبلی</button>
                                    <button type="button" class="page-next btn btn-primary col-5">سوال بعدی</button>
                                </div>
                            </section>
                            <section >
                                <p>14-  فرایند کوچینگ از چه طریق به مراجع کمک می کند؟
                                </p>
                                <div class="form-group">
                                    <input  class="page-next" type="radio" id="vehicle14_5" name="vehicle14" value="0" required >
                                    <label for="vehicle14_5"> ارائه راهکار مناسب </label><br>
                                </div>
                                <div class="form-group">
                                    <input  class="page-next" type="radio" id="vehicle14_4" name="vehicle14" value="4" required >
                                    <label for="vehicle14_4">همراهی در تغییر دیدگاه و نگرش جدید </label><br>
                                </div>
                                <div class="form-group">
                                    <input class="page-next"  type="radio" id="vehicle14_3" name="vehicle14" value="0" required>
                                    <label for="vehicle14_3">پرسشگری جهتمند برای روشنگری و اتخاذ تصمیم مناسب</label><br/>
                                </div>
                                <div class="form-group">
                                    <input class="page-next"  type="radio" id="vehicle14_2" name="vehicle14" value="0" required >
                                    <label for="vehicle14_2"> مراجع  خودش برای خودش تصمیم میگیرد</label><br>
                                </div>

                                <div class="col-12 text-center mt-3 form-group">
                                    <button type="button" class="page-prev btn btn-danger col-5 ">سوال قبلی</button>
                                    <button type="button" class="page-next btn btn-primary col-5">سوال بعدی</button>
                                </div>
                            </section>
                            <section >
                                <p>15- کوچینگ در زندگی افراد چگونه عمل میکند؟
                                </p>
                                <div class="form-group">
                                    <input class="page-next"  type="radio" id="vehicle15_5" name="vehicle15" value="0" required >
                                    <label for="vehicle15_5">  ارائه توصیه های تخصصی</label><br>
                                </div>
                                <div class="form-group">
                                    <input class="page-next"  type="radio" id="vehicle15_4" name="vehicle15" value="4" required>
                                    <label for="vehicle15_4"> تمرکز بر عملکرد و استفاده از ظرفیت های موجود و بالقوه </label><br>
                                </div>
                                <div class="form-group">
                                    <input class="page-next"  type="radio" id="vehicle15_3" name="vehicle15" value="0" required>
                                    <label for="vehicle15_3"> به عنوان ناجی و حلال مشکلات عمل میکند</label><br/>
                                </div>
                                <div class="form-group">
                                    <input class="page-next"  type="radio" id="vehicle15_2" name="vehicle15" value="0" required>
                                    <label for="vehicle15_2">  تمرکز بر کسب دانش و مهارتهای شخصی</label><br>
                                </div>

                                <div class="col-12 text-center mt-3 form-group">
                                    <button type="button" class="page-prev btn btn-danger col-5 ">سوال قبلی</button>
                                    <button type="button" class="page-next btn btn-primary col-5">سوال بعدی</button>
                                </div>
                            </section>
                            <section >
                                <p>16- رویکرد کوچ، در ارزیابی عملکرد چگونه رویکردی است؟
                                </p>
                                <div class="form-group">
                                    <input class="page-next"  type="radio" id="vehicle16_5" name="vehicle16" value="0" required>
                                    <label for="vehicle16_5">کوچ رفتاری امیدوارکننده دارد.</label><br>
                                </div>
                                <div class="form-group">
                                    <input class="page-next"  type="radio" id="vehicle16_4" name="vehicle16" value="0" required>
                                    <label for="vehicle16_4">کوچ رفتاری امیدوارکننده و انگیزه بخش دارد. </label><br>
                                </div>
                                <div class="form-group">
                                    <input  class="page-next" type="radio" id="vehicle16_3" name="vehicle16" value="4" required>
                                    <label for="vehicle16_3">کوچ رفتاری بی طرفانه و بدون نظر دارد.</label><br/>
                                </div>
                                <div class="form-group">
                                    <input class="page-next"  type="radio" id="vehicle16_2" name="vehicle16" value="0" required>
                                    <label for="vehicle16_2"> کوچ با درنظرگرفتن احساسات مراجع نظر خود را بیان می کند.</label><br>
                                </div>

                                <div class="col-12 text-center mt-3 form-group">
                                    <button type="button" class="page-prev btn btn-danger col-5 ">سوال قبلی</button>
                                    <button type="button" class="page-next btn btn-primary col-5">سوال بعدی</button>
                                </div>
                            </section>
                            <section >
                                <p>17- اگر مراجع درخواست کند که کوچ برای او معرفی کسب و کار بنویسد، کوچ چه کاری باید انجام دهد؟
                                </p>
                                <div class="form-group">
                                    <input  class="page-next" type="radio" id="vehicle17_5" name="vehicle17" value="0" required>
                                    <label for="vehicle17_5">در ازای دریافت هزینه بنویسد</label><br>
                                </div>
                               <div class="form-group">
                                   <input class="page-next" type="radio" id="vehicle17_4" name="vehicle17" value="0" required>
                                   <label for="vehicle17_4">ننویسد چون کوچ هنوز تجربه ای ندارد </label><br>
                               </div>
                                <div class="form-group">
                                    <input  class="page-next" type="radio" id="vehicle17_3" name="vehicle17" value="0" required>
                                    <label for="vehicle17_3">نپذیرد چرا که این کار مشاوره است و کوچینگ نیست</label><br/>
                                </div>
                                <div class="form-group">
                                    <input class="page-next" type="radio" id="vehicle17_2" name="vehicle17" value="4" required>
                                    <label for="vehicle17_2"> با کمک کردن به مراجع تا موانع کسب درامد را پیدا کند با او همراهی کند</label><br>
                                </div>

                                <div class="col-12 text-center mt-3 form-group">
                                    <button type="button" class="page-prev btn btn-danger col-5 ">سوال قبلی</button>
                                    <button type="button" class="page-next btn btn-primary col-5">سوال بعدی</button>
                                </div>
                            </section>
                            <section >
                                <p>18- اگر نتیجه مطلوب مراجع کاهش وزن باشد، یک کوچ سلامت می تواند
                                </p>
                                <div class="form-group">
                                    <input class="page-next" type="radio" id="vehicle18_5" name="vehicle18" value="0" required>
                                    <label for="vehicle18_5">مراجع با تردمیل کوچ تمرین کند</label><br>
                                </div>
                                <div class="form-group">
                                    <input class="page-next" type="radio" id="vehicle18_4" name="vehicle18" value="0" required>
                                    <label for="vehicle18_4">در مورد روشهای کاهش وزن به مراجع مشاوره دهد </label><br>
                                </div>
                                <div class="form-group">
                                    <input class="page-next"  type="radio" id="vehicle18_3" name="vehicle18" value="4" required>
                                    <label for="vehicle18_3">مشخص کنید مراجع در جلساتی که هدف ان دست یافتن به کاهش وزن است بدنبال چه چیزی است</label><br/>
                                </div>
                                <div class="form-group">
                                    <input class="page-next"  type="radio" id="vehicle18_2" name="vehicle18" value="0" required>
                                    <label for="vehicle18_2"> کوچینگ را با هدف کاهش وزن آغاز کند</label><br>
                                </div>

                                <div class="col-12 text-center mt-3 form-group">
                                    <button type="button" class="page-prev btn btn-danger col-5 ">سوال قبلی</button>
                                    <button type="button" class="page-next btn btn-primary col-5">سوال بعدی</button>
                                </div>
                            </section>
                            <section >
                                <p>19- زمانیکه مراجع می گوید رابطه اش با شریکش بخاطر عدم وجود احساس درحال از بین رفتن است،کوچ باید این کار را انجام دهد.
                                </p>
                                <div class="form-group">
                                    <input class="page-next" type="radio" id="vehicle19_5" name="vehicle19" value="4" required>
                                    <label for="vehicle19_5"> درحالیکه سکوت می کند منتظر بماند مراجع چیزهای بیشتری بگوید</label><br>
                                </div>
                                <div class="form-group">
                                    <input class="page-next" type="radio" id="vehicle19_4" name="vehicle19" value="0" required>
                                    <label for="vehicle19_4">به مراجع بگوید همیشه همه چیز بهتر می شود </label><br>
                                </div>
                                <div class="form-group">
                                    <input class="page-next" type="radio" id="vehicle19_3" name="vehicle19" value="0" required>
                                    <label for="vehicle19_3">از مراجع بپرسد پیشنهاد انجام چه کاری را می دهد</label><br/>
                                </div>
                                <div class="form-group">
                                    <input class="page-next" type="radio" id="vehicle19_2" name="vehicle19" value="0" required>
                                    <label for="vehicle19_2"> از مراجع بپرسد چه احساسی دارد</label><br>
                                </div>
                                <div class="col-12 text-center mt-3 form-group">
                                    <button type="button" class="page-prev btn btn-danger col-5 ">سوال قبلی</button>
                                    <button type="button" class="page-next btn btn-primary col-5">سوال بعدی</button>
                                </div>
                            </section>
                            <section >
                                <p>20- مراجعی که بشدت منفعل و ارام است. کوچ باید
                                </p>
                                <div class="form-group">
                                    <input class="page-next" type="radio" id="vehicle20_5" name="vehicle20" value="4" required>
                                    <label for="vehicle20_5"> این مساله را بررسی کرده و آنرا با مراجع به اشتراک بگذارد که دلیل کمبود انرژی وی چیست</label><br>
                                </div>
                                <div class="form-group">
                                    <input class="page-next" type="radio" id="vehicle20_4" name="vehicle20" value="0" required>
                                    <label for="vehicle20_4">با مراجع خیلی پرانرژی صحبت کند و سعی کند به او روحیه بدهد </label><br>
                                </div>
                                <div class="form-group">
                                    <input class="page-next" type="radio" id="vehicle20_3" name="vehicle20" value="0" required>
                                    <label for="vehicle20_3">برای روحیه دادن به او موسیقی راک پخش کند</label><br/>
                                </div>
                                <div class="form-group">
                                    <input class="page-next" type="radio" id="vehicle20_2" name="vehicle20" value="0" required>
                                    <label for="vehicle20_2"> به او بگوید که افسرده است و او را به یک درمانگر ارجاع دهد</label><br>
                                </div>
                                <div class="col-12 text-center mt-3 form-group">
                                    <button type="button" class="page-prev btn btn-danger col-5 ">سوال قبلی</button>
                                    <button type="button" class="page-next btn btn-primary col-5">سوال بعدی</button>
                                </div>
                            </section>
                            <section >
                                <p>21- برای حمایت از مراجعی که می خواهد به سختی الگوی فکری خود را تغییر دهد،کوچ باید
                                </p>
                                <div class="form-group">
                                    <input class="page-next" type="radio" id="vehicle21_5" name="vehicle21" value="0" required>
                                    <label for="vehicle21_5">مراجع را وادار کند تعداد دفعاتی که فکر می کند را بشمارد</label><br>
                                </div>
                                <div class="form-group">
                                    <input class="page-next" type="radio" id="vehicle21_4" name="vehicle21" value="0" required>
                                    <label for="vehicle21_4">به مراجع تکنیکی را یاد بدهد که هنگام بروز ان الگوی فکری در ان اختلال ایجاد کند </label><br>
                                </div>

                                <div class="form-group">
                                    <input class="page-next" type="radio" id="vehicle21_3" name="vehicle21" value="0" required>
                                    <label for="vehicle21_3">الگوی فکری جدیدی به او بیاموزد تا جایگزین الگوی قدیمی شود</label><br/>
                                </div>
                                <div class="form-group">
                                    <input class="page-next" type="radio" id="vehicle21_2" name="vehicle21" value="4" required>
                                    <label for="vehicle21_2"> بررسی کند مراجع چه سودی از آن قالب فکری می برد</label><br>
                                </div>

                                <div class="col-12 text-center mt-3 form-group">
                                    <button type="button" class="page-prev btn btn-danger col-5 ">سوال قبلی</button>
                                    <button type="button" class="page-next btn btn-primary col-5">سوال بعدی</button>
                                </div>
                            </section>
                            <section >
                                <p>22- کوچ چگونه می تواند به بهترین وجه به خوداگاهی مراجع خود کمک کند؟
                                </p>
                                <div class="form-group">
                                    <input class="page-next" type="radio" id="vehicle22_5" name="vehicle22" value="0" required>
                                    <label for="vehicle22_5"> با دادن مطالب خودیاری به مراجع</label><br>
                                </div>
                                <div class="form-group">
                                    <input class="page-next" type="radio" id="vehicle22_4" name="vehicle22" value="0" required>
                                    <label for="vehicle22_4">با مشاوره دادن به مراجع درمورداینکه چه خوداگاهیهایی نیاز دارد </label><br>
                                </div>
                                <div class="form-group">
                                    <input class="page-next" type="radio" id="vehicle22_3" name="vehicle22" value="4" required>
                                    <label for="vehicle22_3">با پرسیدن سوالات قدرتمند</label><br/>
                                </div>
                                <div class="form-group">
                                    <input class="page-next" type="radio" id="vehicle22_2" name="vehicle22" value="0" required>
                                    <label for="vehicle22_2"> به مراجع اجازه دهد که درمورد زمانیکه به خوداگاهی رسید به کوچ اطلاع دهد</label><br>
                                </div>

                                <div class="col-12 text-center mt-3 form-group">
                                    <button type="button" class="page-prev btn btn-danger col-5 ">سوال قبلی</button>
                                    <button type="button" class="page-next btn btn-primary col-5">سوال بعدی</button>
                                </div>
                            </section>
                            <section >
                                <p>23- مراجع برای انتخاب بین گزینه های شغلی معضل دارد. کوچ بررسی می کند که ...........
                                </p>
                                <div class="form-group">
                                    <input class="page-next" type="radio" id="vehicle23_5" name="vehicle23" value="4" required>
                                    <label for="vehicle23_5"> چه چیزی با ارزشها و اهداف بلند مدت مراجع همراستاست</label><br>
                                </div>
                                <div class="form-group">
                                    <input class="page-next" type="radio" id="vehicle23_4" name="vehicle23" value="0" required>
                                    <label for="vehicle23_4">پرداخت بهتر در برابر کار کمتر چیست </label><br>
                                </div>
                                <div class="form-group">
                                    <input class="page-next" type="radio" id="vehicle23_3" name="vehicle23" value="0" required>
                                    <label for="vehicle23_3"> با انجام چه کاری به خانواده و دوستانش بهتر خدمت می کند</label><br/>
                                </div>
                                <div class="form-group">
                                    <input class="page-next" type="radio" id="vehicle23_2" name="vehicle23" value="0" required>
                                    <label for="vehicle23_2"> بپرسد بر مبنای مقیاس 10 چه رتبه ای به این گزینه ها می دهد</label><br>
                                </div>

                                <div class="col-12 text-center mt-3 form-group">
                                    <button type="button" class="page-prev btn btn-danger col-5 ">سوال قبلی</button>
                                    <button type="button" class="page-next btn btn-primary col-5">سوال بعدی</button>
                                </div>
                            </section>
                            <section >
                                <p>24- مراجع به دلیل داشتن رئیس سخت گیر می خواهد شغل خود را ترک کند.کوچ باید.
                                </p>
                                <div class="form-group">
                                    <input class="page-next" type="radio" id="vehicle24_5" name="vehicle24" value="0" required>
                                    <label for="vehicle24_5"> به مراجع کمک کند تا گزینه های ترک شغل را بررسی کند</label><br>
                                </div>

                                <div class="form-group">
                                    <input class="page-next" type="radio" id="vehicle24_4" name="vehicle24" value="4" required>
                                    <label for="vehicle24_4">مساله را بررسی کند تا ببیند مراجع چگونه می تواند با رئیسش ارتباط برقرار کند </label><br>
                                </div>

                                <div class="form-group">
                                    <input class="page-next" type="radio" id="vehicle24_3" name="vehicle24" value="0" required>
                                    <label for="vehicle24_3">نیاز به جرات ورزی را به مراجعش اموزش دهد</label><br/>
                                </div>
                                <div class="form-group">
                                    <input class="page-next" type="radio" id="vehicle24_2" name="vehicle24" value="0" required>
                                    <label for="vehicle24_2"> از مراجع در مورد اینکه همکارانش چه احساسی درمورد رئیسشان دارند ،بپرسد</label><br>
                                </div>
                                <div class="col-12 text-center mt-3 form-group">
                                    <button type="button" class="page-prev btn btn-danger col-5 ">سوال قبلی</button>
                                    <button type="button" class="page-next btn btn-primary col-5">سوال بعدی</button>
                                </div>
                            </section>
                            <section >
                                <p>25- اکثر کوچینگها به کوچینگ زندگی ختم می شود زیرا
                                </p>
                                <div class="form-group">
                                    <input class="page-next" type="radio" id="vehicle25_5" name="vehicle25" value="0" required>
                                    <label for="vehicle25_5"> کوچ و مراجع هنوز زندگی می کنند</label><br>
                                </div>
                                <div class="form-group">
                                    <input class="page-next" type="radio" id="vehicle25_4" name="vehicle25" value="0" required>
                                    <label for="vehicle25_4">زندگی دائما با مسائل مختلفی معلق است </label><br>
                                </div>
                                <div class="form-group">
                                    <input class="page-next" type="radio" id="vehicle25_3" name="vehicle25" value="4" required>
                                    <label for="vehicle25_3"> مباحث اصلی در مورد فرضیات،باورها و ارزشهاست</label><br/>
                                </div>
                                <div class="form-group">
                                    <input class="page-next" type="radio" id="vehicle25_2" name="vehicle25" value="0" required>
                                    <label for="vehicle25_2"> شخص کار می کند که زندگی کند</label><br>
                                </div>
                                <div class="col-12 text-center mt-3 form-group">
                                    <button type="button" class="page-prev btn btn-danger col-5 ">سوال قبلی</button>
                                    <button type="button" class="page-next btn btn-primary col-5">سوال بعدی</button>
                                </div>
                            </section>

                            <section class="page">
                                <!-- <a href="#">Terms of Service</a><br/>
                                <input type="checkbox" id="ts" name="ts" value="1" required />
                                <label for="ts"> I agree</label><br />
                                -->
                                <button type="button" class="page-prev btn btn-danger col-3">قبلی</button>
                                <button type="submit" class="page-next btn btn-success col-3" id="sendForm">تکمیل شد</button>
                            </section>
                            <!--
                            <section class="page" style="margin:auto;text-align:center">
                                فرم شما تکمیل شد.
                            </section>
                            -->
                        </form>
                    </div>
                </div>
            </div>
    @else
        @if(Auth::user()->sch2024->confirm_exam==1)
            <div class="col-12 col-md-7 mx-auto text-center">
                <div class="alert alert-success">
                    تبریک شما در آزمون مقدماتی بورسیه کوچینگ قبول شده اید
                </div>
            </div>
            @foreach(Auth::user()->get_scholarshipExam->where('resource','sch2024') as $item)
                @if($loop->iteration==1)
                    <div class="col-12 col-md-7 mx-auto text-center">
                        <div class="alert alert-warning">نمره کسب شده در آزمون نوبت اول : {{$item->score}}</div>
                    </div>
                @elseif($loop->iteration==2)
                    <div class="col-12 col-md-7 mx-auto text-center">
                         <div class="alert alert-warning">نمره کسب شده در آزمون نوبت دوم : {{$item->score}}</div>
                    </div>
                @endif
            @endforeach
            <div class="col-12 col-md-7 mx-auto text-center">
                <h5 class="text-center">برای صدور مدرک آزمون باید نام و نام خانوادگی خود را به انگلیسی وارد کنید</h5>
            </div>
            {{-- @if(($scholarship->confirm_webinar==1) && ($scholarship->confirm_exam==1)) --}}

            @if( (Auth::user()->sch2024->confirm_exam==1))
                <div class="col-12 col-md-7 mx-auto text-center">
                    <form method="post" action="/panel/profile/update/{{Auth::user()->id}}" enctype="multipart/form-data" class="mb-4">
                    {{method_field('PATCH')}}
                    {{csrf_field()}}
                    <div class="col-md-6 px-1">
                        <div class="form-group">
                            <label>نام انگلیسی<span class="text-danger font-weight-bold">*</span></label>
                            <input type="text" class="form-control @if(strlen(Auth::user()->fname_en)<>0) is-valid @endif" placeholder="نام انگلیسی را وارد کنید" @if(old('fname_en'))   value='{{old('fname_en')}}' @else value="{{old('fname_en',Auth::user()->fname_en) }}" @endif name="fname_en"  autocomplete="autocomplete"  @if(strlen(Auth::user()->fname_en)<>0) disabled @endif />
                        </div>
                    </div>
                    <div class="col-md-6 px-1">
                        <div class="form-group">
                            <label>نام خانوادگی انگلیسی<span class="text-danger font-weight-bold">*</span></label>
                            <input type="text" class="form-control @if(strlen(Auth::user()->lname_en)<>0) is-valid @endif" placeholder="نام خانوادگی انگلیسی را وارد کنید" @if(old('lname_en')) value='{{old('lname_en')}}' @else value="{{old('lname_en',Auth::user()->lname_en)}}" @endif name="lname_en"   autocomplete="autocomplete" @if(strlen(Auth::user()->lname_en)<>0) disabled @endif/>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-success " value="بروزرسانی">
                </form>
                </div>
                <div class="col-12 col-md-7 mx-auto">
                    <div class="text-center">
                        <form method="post" action="/panel/certificates/get_certificate_CCE_2hours">
                            {{csrf_field()}}
                            <button type="submit" class="btn btn-primary">دانلود گواهینامه</button>
                        </form>

                    </div>
                </div>
            @endif
        @else
                <div class="col-12 col-md-7 mx-auto text-center mb-3">
                    <div class=" alert alert-danger">متاسفانه امتیاز شما در آزمون مقدماتی به حد نصاب ممکن نرسید</div>
                </div>
            @foreach(Auth::user()->get_scholarshipExam->where('resource','sch2024') as $item)
                <div class="col-12 col-md-7 mx-auto text-center">
                    <div class="alert alert-warning">
                        آزمون {{$loop->iteration}} نمره =  {{$item->score}}
                    </div>
                </div>

            @endforeach
        @endif
    @endif

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="{{asset('/js/jquery-ui.min.js')}}" ></script>
    <script src="{{asset('/js/jquery-book.js')}}" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>

    <script>
        $thing = $('#demo').book({
            onPageChange: updateProgress,
            speed:200}
        ).validate();


        function updateProgress(prevPageIndex, currentPageIndex, pageCount, pageName){
            t = (currentPageIndex / (pageCount-1)) * 100;
            $('.progress-bar').attr('aria-valuenow', t);
            $('.progress-bar').css('width', t+'%');
            //$('.progress span').text('Completed: '+Math.trunc(t)+'%');
            $('.progress-value').text(Math.trunc(t)+'%');
        }
    </script>
