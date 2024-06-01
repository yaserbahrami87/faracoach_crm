<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" integrity="sha256-mmgLkCYLUQbXn0B1SRqzHar6dCnv9oZFPEC1g1cwlkk=" crossorigin="anonymous" />
<div class="container">
    <div class="row shadow" id="link">
        <div class="col-12 col-sm-5 col-md-5 col-lg-5 col-xl-5">
            <p>لینک دعوت اختصاصی شما جهت اشتراک گذاری با دوستان:</p>
        </div>
        <div class="col-12 col-sm-7 col-md-55 col-lg-7 col-xl-7">
            <p class=" dir-rtl text-center"  id="personal_link">
                {{asset('/sch2024/register?introduce='.Auth::user()->id)}}</p>
        </div>
    </div>
    <div class="row">
        <!--end col-->
        <div class="col-lg-6 col-md-6 col-12 order-1 order-md-2 mt-5">
            <div class="section-title ml-lg-5">
                <h3 class="text-custom font-weight-normal mb-3">معرفی دوستان</h3>
                <h5 class="title mb-4">
                    یکی از مهمترین اهداف طرح بورسیه کوچینگ، <br />
                    شناسایی افراد اثرگذار، مستعد و نخبه جامعه و تسهیل فضای آموزش حرفه ای برای این افراد است.
                </h5>
                <p class=" mb-0">
                    لذا با توجه به اینکه ظرفیت اطلاع رسانی ما محدود است، از شما درخواست میکنیم که دوستان واجد شرایط خود را به این برنامه دعوت کنید و از مزایای این معرفی بهره مند شوید.
                </p>
                <p class="point">
                    چنانچه فردی که معرفی میکنید (از طریق لینک شما ثبت نام نموده است)، تمام مراحل را با موفقیت طی کند ، 10 امتیاز به ازای هر نفر به مجموع امتیازات شما اضافه شده و در ارزیابی نهایی موثر خواهد بود.
                </p>
                <p>شما میتوانید با انتشار محتواهای زیر  به همراه لینک اختصاصی خود در شبکه های اجتماعی، دوستان خود را به بورسیه دعوت کنید
                <div class="row">
                    <div class="col-lg-6 mt-4 pt-2">
                        <div class="media align-items-center rounded shadow p-3">
                            <i class="bi bi-camera-video-fill text-custom  h4 mb-0"></i>
                            <h6 class="ml-3 mb-0">  <a href="/images/scholarship/video.mp4" target="_blank">دانلود فیلم</a></h6>
                        </div>
                    </div>
                    <div class="col-lg-6 mt-4 pt-2">
                        <div class="media align-items-center rounded shadow p-3">

                            <i class="bi bi-file-earmark-arrow-down-fill text-custom mb-0"></i>
                            <h6 class=" ml-1 mb-0"><a href="{{asset('/images/scholarship/Video_cover_sch.jpg')}}"  target="_blank">دانلود پوستر</a></h6>
                        </div>
                    </div>
                    <div class="col-lg-6 mt-4 pt-2">
                        <div class="media align-items-center rounded shadow p-3">
                            <i class="bi bi-file-earmark-arrow-down-fill text-custom mb-0"></i>
                            <h6 class="ml-1 mb-0"><a href="{{asset('/images/scholarship/sch_insta.jpg')}}"  target="_blank">استوری بورسیه</a></h6>
                        </div>
                    </div>
                    {{--                    <div class="col-lg-6 mt-4 pt-2">--}}
                    {{--                        <div class="media align-items-center rounded shadow p-3">--}}
                    {{--                            <i class="fa fa-image h4 mb-0 text-custom"></i>--}}
                    {{--                            <h6 class="ml-3 mb-0"><a href="javascript:void(0)" class="text-dark">Development</a></h6>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 order-2 order-md-1 mt-5 pt-2 mt-sm-0 opt-sm-0">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-6">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 mt-4 pt-2">
                            <div class="card work-desk rounded border-0 shadow-lg overflow-hidden">
                                <img src="{{asset('images/scholarship/Video_cover_sch.jpg')}}" class="img-fluid" alt="Image" />
                                <div class="img-overlay bg-dark"></div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 mt-1 pt-1">
                            <div class="card work-desk rounded border-0 shadow-lg overflow-hidden">
                                <video controls class="img-fluid "  height="">
                                    <source src="/images/scholarship/video.mp4" >
                                </video>
                                {{--                                <img src="https://www.bootdey.com/image/600x401/FF7F50/000000" class="img-fluid" alt="Image" />--}}
                                <div class="img-overlay bg-dark"></div>
                            </div>
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->
                </div>
                <!--end col-->

                <div class="col-lg-6 col-md-6 col-6" style="margin-top: 50px">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="card work-desk rounded border-0 shadow-lg overflow-hidden">
                                <img src="{{asset('images/scholarship/sch_insta.jpg')}}" class="img-fluid" alt="Image" />
                                <div class="img-overlay bg-dark"></div>
                            </div>
                        </div>
                        <!--end col-->


                        <!--end col-->
                    </div>
                    <!--end row-->
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>
        <!--end col-->
    </div>
    <!--enr row-->


    <div class="row mt-5" id="introduced_table">

        <div class="col-12 col-sm-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <i class="bi bi-people-fill"></i>
                    <h5>لیست افراد دعوت شده توسط شما</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive" id="proTeamScroll" tabindex="2" style="height: 400px; overflow: hidden; outline: none;">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>ردیف</th>
                                <th></th>
                                <th>نام و نام خانوادگی</th>
                                <th>وضعیت</th>
                                <th>امتیاز شما</th>
                                {{--                                        <th>Edit</th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(Auth::user()->sch2024_introduced as $item)

                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td class="table-img"><img src="https://bootdey.com/img/Content/avatar/avatar8.png" alt="">
                                    </td>
                                    <td>
                                        <p class="m-0 font-12" dir="ltr">
                                            <span class="col-green font-weight-bold">{{is_null($item->user->fname)?$item->user->tel:$item->user->fname.' '.$item->user->lname}}</span>
                                        </p>
                                    </td>
                                    <td class="align-middle">
                                        <!--
                                        <div class="progress-text">20%</div>
                                        <div class="progress" data-height="6" style="height: 6px;">
                                            <div class="progress-bar bg-red" data-width="50%" style="width: 20%;"></div>
                                        </div>
                                        -->
                                    </td>
                                    <td>
                                        <!-- 10 -->
                                    </td>
                                    {{--                                        <td>--}}
                                    {{--                                            <a data-toggle="tooltip" title="" data-original-title="Edit"><i class="fas fa-pencil-alt"></i></a>--}}
                                    {{--                                            <a data-toggle="tooltip" title="" data-original-title="Delete"><i class="far fa-trash-alt"></i></a>--}}
                                    {{--                                        </td>--}}
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>
