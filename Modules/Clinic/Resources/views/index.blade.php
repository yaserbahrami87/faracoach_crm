@extends('clinic::master.index')


@section('content')
    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center justify-content-center">
        <div class="container" data-aos="fade-up">
            <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="150">
                <div class="col-xl-6 col-lg-8">
                    <h1>فـــراکـوچ </h1>
                    <h2>اعتبار کوچینگ ایران</h2>
                </div>
            </div>
            <div class="row gy-4 mt-5 justify-content-center" data-aos="zoom-in" data-aos-delay="250">
                @foreach($ClinicBasicInfo as $clinic_basic_info)
                    @foreach($clinic_basic_info->children as $item)
                        <div class="col-xl-2 col-md-4">
                            <div class="icon-box">

                                <img src="/images/clinic/tel.png" width="80px" class="d-inline mb-3" />
                                <h3><a href="/coaches/category/{{$item->title}}">{{$item->title}}</a></h3>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
    </section><!-- End Hero -->

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container" data-aos="fade-up">

            <div class="row">
                <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
                    <img src="/images/clinic/coaching.jpg" class="img-fluid" alt="">
                </div>
                <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content" data-aos="fade-right" data-aos-delay="100">
                    <h3 class=mb-4">جلسه کوچینگ چیست؟ </h3>
                    <p class="fst-italic">
                        جلسات کوچینگ را میتوان گفت‌وگویی هدفمند بین کوچ و مراجع(کوچی) تلقی کرد. جلسه کوچینگ، مجموعه‌ای از اقدامات بین کوچ و مراجع است که در آن درباره مسائلی چون عملکرد، موقعیت‌ها، اهداف بلند و کوتاه مدت، پیشرفت شغلی، مشکلات شخصی و کاری و… بحث شده و تلاش می‌شود تا در آن وضعیت شخص بهبود یابد. کوچ با پرسیدن سوالات جهت دار و هدفمند، به مراجع خود کمک میکند چالش خود را ریشه یابی کرده و دید درستی نسبت به خود بیاید. به بیان دیگر در جلسات کوچینگ مراجع با کمک کوچ، می تواند به مشکلاتش دید بهتری به دست آورده و مهارت حل مسئله را در خود بهبود بخشد..
                    </p>
                </div>
            </div>
        </div>
    </section><!-- End About Section -->

    <!-- ======= Clients Section ======= -->
    <section id="clients" class="clients">
        <div class="container" data-aos="zoom-in">

            <div class="clients-slider swiper">
                <div class="swiper-wrapper align-items-center">
                    <div class="swiper-slide"><img src="/images/bank refah.png" class="img-fluid" alt=""></div>
                    <div class="swiper-slide"><img src="/images/digikala.png" class="img-fluid" alt=""></div>
                    <div class="swiper-slide"><img src="/images/elmofanavari.png" class="img-fluid" alt=""></div>
                    <div class="swiper-slide"><img src="/images/hamrahaval.png" class="img-fluid" alt=""></div>
                    <div class="swiper-slide"><img src="/images/oloom_pezeshki.png" class="img-fluid" alt=""></div>
                    <div class="swiper-slide"><img src="/images/shahrdari_mashhad.png" class="img-fluid" alt=""></div>
                    <div class="swiper-slide"><img src="/images/naft.png" class="img-fluid" alt=""></div>
                    <div class="swiper-slide"><img src="/images/roshdana.png" class="img-fluid" alt=""></div>
                </div>
                <div class="swiper-pagination"></div>
            </div>

        </div>
    </section><!-- End Clients Section -->

    <!-- ======= Features Section ======= -->
    <section id="features" class="features">
        <div class="container" data-aos="fade-up">
            <div class="row">
                <div id="73537936991"  class="image col-lg-6" data-aos="fade-right"><script type="text/JavaScript" src="https://www.aparat.com/embed/Wc0pO?data[rnddiv]=73537936991&data[responsive]=yes"></script></div>
                <div class="col-lg-6" data-aos="fade-left" data-aos-delay="100">
                    <div class="icon-box mt-5 mt-lg-0" data-aos="zoom-in" data-aos-delay="150">
                        <h4>مزایای استفاده از جلسات کوچینگ چیست؟ </h4>
                        <p>توانایی هدف گذاری، برنامه ریزی، حل مسئله، تغییر دیدگاه و مدیریت زمان، افزایش خودشناسی، خودآگاهی و مسئولیت پذیری، تصمیم گیری موثر، شناخت نقاط قوت و ضعف، افزایش اعتماد به نفس، افزایش یادگیری، ایجاد حس آرامش و مفید بودن، تاثیرگذاری، افزایش تعادل کارو زندگی، بهبود ارتباطات موثر، باز شدن گره های ذهنی، رفع موانع فردی، توانایی مدیریت برخورد، ریشه یابی مهارت های فردی و…
                            در نظر داشته باشید که یک کوچ حرفه ای، در جلسه کوچینگ به دور از هرگونه قضاوت، پیش داوری و تصوری از مراجع به سخنان وی گوش میدهد. به همین دلیل می توانید یقین داشته باشید که راه حل به دست آمده در یک جلسه کوچینگ کاملا زاییده ذهن خودتان است.</p>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Features Section -->
    <!-- ======= Services Section ======= -->
    <section id="services" class="services">
        <div class="container" data-aos="fade-up">

            <div class="section-title">

                <p>خدمات ما به شما</p>
            </div>
            <div class="row">
                @foreach($ClinicBasicInfo as $clinic_basic_info)
                    @foreach($clinic_basic_info->children as $item)
                        <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                            <div class="icon-box">
                                <div class="icon"><i class="bx bxl-dribbble">
                                        <img src="/images/clinic/tel.png" width="80px" class="d-inline mb-3" />
                                    </i></div>
                                <h4><a href="/coaches/category/{{$item->title}}">{{$item->title}}</a></h4>
                                <p>متن تستی خدمات ما به شما</p>
                            </div>
                        </div>
                    @endforeach
                @endforeach
                <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                    <div class="icon-box">
                        <div class="icon"><i class="bx bxl-dribbble">
                                <img src="/images/clinic/tel.png" width="80px" class="d-inline mb-3" />
                            </i></div>
                        <h4><a href="/coaches/category/">منابع انسانی</a></h4>
                        <p>متن تستی خدمات ما به شما</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                    <div class="icon-box">
                        <div class="icon"><i class="bx bxl-dribbble">
                                <img src="/images/clinic/tel.png" width="80px" class="d-inline mb-3" />
                            </i></div>
                        <h4><a href="/coaches/category/">منابع انسانی</a></h4>
                        <p>متن تستی خدمات ما به شما</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                    <div class="icon-box">
                        <div class="icon"><i class="bx bxl-dribbble">
                                <img src="/images/clinic/tel.png" width="80px" class="d-inline mb-3" />
                            </i></div>
                        <h4><a href="/coaches/category/">منابع انسانی</a></h4>
                        <p>متن تستی خدمات ما به شما</p>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Services Section -->

    <!-- ======= Cta Section ======= -->
    <section id="cta" class="cta">
        <div class="container" data-aos="zoom-in">

            <div class="text-center">
                <h3> درخواست همکاری </h3>
                <p> کلینیک فراکوچ به عنوان یکی از مراکز مشاوره، اطلاع‌رسانی و خدمات کارآفرینی اداره کل تعاون کار و رفاه اجتماعی خراسان رضوی، به صورت رسمی در حوزه توسعه فردی، کسب و کار و ارائه خدمات کوچینگ فعالیت می‌نماید. در همین راستا، از کلیه دانش‌آموختگان و فارغ‌التحصیلان کوچینگ آکادمی های معتبر داخلی و خارجی که متقاضی همکاری با این کلینیک هستند دعوت می‌شود با تکمیل فرم همکاری و ارسال مدارک و سوابق کاری، آمادگی خود را جهت همکاری اعلام نمایند.</p>
                <a class="cta-btn" href="#">درخواست همکاری</a>
            </div>
        </div>
    </section>
    <!-- End Cta Section -->


    <!-- ======= Team Section ======= -->
    <section id="team" class="team">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>تیم فراکوچ</h2>
                <p> کوچ های منتخب این ماه  </p>
            </div>

            <div class="row">
                <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                    <div class="member" data-aos="fade-up" data-aos-delay="100">
                        <div class="member-img">
                            <img src="/images/clinic/yaser.jpg" class="img-fluid" alt="">
                            <div class="social">
                                <a href=""><i class="bi bi-twitter"></i></a>
                                <a href=""><i class="bi bi-facebook"></i></a>
                                <a href=""><i class="bi bi-instagram"></i></a>
                                <a href=""><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                        <div class="member-info">
                            <h4>یاسر متحدین</h4>
                            <span>مدیرعامل فراکوچ</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                    <div class="member" data-aos="fade-up" data-aos-delay="200">
                        <div class="member" data-aos="fade-up" data-aos-delay="300">
                            <div class="member-img">
                                <img src="/images/clinic/yaser.jpg" class="img-fluid" alt="">
                                <div class="social">
                                    <a href=""><i class="bi bi-twitter"></i></a>
                                    <a href=""><i class="bi bi-facebook"></i></a>
                                    <a href=""><i class="bi bi-instagram"></i></a>
                                    <a href=""><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                            <div class="member-info">
                                <h4>یاسر متحدین</h4>
                                <span>مدیرعامل فراکوچ</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                    <div class="member" data-aos="fade-up" data-aos-delay="300">
                        <div class="member-img">
                            <img src="/images/clinic/yaser.jpg" class="img-fluid" alt="">
                            <div class="social">
                                <a href=""><i class="bi bi-twitter"></i></a>
                                <a href=""><i class="bi bi-facebook"></i></a>
                                <a href=""><i class="bi bi-instagram"></i></a>
                                <a href=""><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                        <div class="member-info">
                            <h4>یاسر متحدین</h4>
                            <span>مدیرعامل فراکوچ</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                    <div class="member" data-aos="fade-up" data-aos-delay="400">
                        <div class="member" data-aos="fade-up" data-aos-delay="300">
                            <div class="member-img">
                                <img src="/images/clinic/yaser.jpg" class="img-fluid" alt="">
                                <div class="social">
                                    <a href=""><i class="bi bi-twitter"></i></a>
                                    <a href=""><i class="bi bi-facebook"></i></a>
                                    <a href=""><i class="bi bi-instagram"></i></a>
                                    <a href=""><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                            <div class="member-info">
                                <h4>یاسر متحدین</h4>
                                <span>مدیرعامل فراکوچ</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section><!-- End Team Section -->

@endsection


