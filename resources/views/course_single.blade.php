@extends('master.index')

@section('headerscript')
    <style>
        h1
        {
            font-size: 2rem ;
            color:#003366 !important;
        }
    </style>
@endsection

@section('row1')
    <section class="py-5 bg-light ">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5">
                <div class="col-md-7">
                    <img class="card-img-top mb-5 mb-md-0" src="{{asset('/documents/'.$course->image)}}" alt="..." height="600px"/>
                </div>
                <div class="col-md-5">
                    <div class="mb-2"></div>
                    <h1 class="font-weight-bold">{{$course->course}}</h1>
                    <div class="fs-5 mb-2 mt-4">
                        قیمت:
                        <!--
                        <span class="text-decoration-line-through mr-5">{{number_format($course->fi)}} تومان</span>
                        -->
                        <p class="font-weight-bold d-inline">{{number_format($course->fi_off)}} تومان</p>
                    </div>

                    <div>

                    </div>
                    <div>
                        <p>
                            مدت زمان دوره (ساعت):
                            <span class="font-weight-bold">{{$course->duration}}  ساعت</span>
                        </p>
                    </div>
                    <div>
                        <p>
                            مدت دوره (روز/هفته/ماه):
                            <span class="font-weight-bold">{{$course->duration_date}}</span>
                        </p>
                    </div>
                    <div>
                        <p>
                            تاریخ شروع دوره:
                            <span class="font-weight-bold">{{$course->start}}</span>
                        </p>
                    </div>
                    <div>
                        <p>
                            تاریخ اتمام دوره:
                            <span class="font-weight-bold">{{$course->end}}</span>
                        </p>
                    </div>
                    <div class="d-flex mt-5 mb-5">
                        <div class="row">
                            @if(!Auth::check())
                                @include('loginAjax')
                            @elseif($course->type_peymant_id==1 || $course->type_peymant_id==3)
                                <div class="col-12 mb-2">
                                    <div class="row">
                                        <form method="post" action="/cart">
                                            {{csrf_field()}}
                                            <input type="hidden" value="{{$course->id}}" name="product_id" />
                                            <input type="hidden" value="course" name="type" />
                                            <button class="btn btn-outline-primary" type="submit">
                                                <i class="bi-cart-fill me-1"></i>
                                                خرید / اقساط
                                            </button>
                                            <p class="font-weight-bold">میزان {{$course->peymant_off}}% تخفیف در صورت پرداخت نقدی </p>
                                        </form>
                                    </div>
                                </div>

                                <div class="card mt-4" >
                                    <div class="card-body">
                                        <h5>لینک دعوت اختصاصی شما</h5>
                                        <p class="text-light bg-secondary p-2 text-right"  id="personal_link" dir="ltr">{{asset('/courses/'.$course->shortlink)."?q=".Auth::user()->id}}</p>
                                    </div>
                                </div>
                            @endif


                            @if($course->type_peymant_id==2 || $course->type_peymant_id==3)
                                <div class="col-12">

                                </div>
                            @endif
                        </div>


                    </div>
                </div>
                <div class="col-12 mt-5">
                    <p class="font-weight-bold">توضیحات:</p>
                    {!! $course->infocourse !!}
                    @if(Auth::check())
                        <form method="post" action="/panel/comments"class="pb-2 border-bottom">
                            {{csrf_field()}}
                            <input type="hidden" name="post_id" value="{{$course->id}}">
                            <input type="hidden" name="type" value="course">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    @if(is_null(Auth::user()->personal_image))
                                        <img src="{{asset('/documents/users/default-avatar.png')}}"  width="50px" height="50px" />
                                    @else
                                        <img src="{{asset('/documents/users/'.Auth::user()->personal_image)}}" width="50px" height="50px"/>
                                    @endif
                                    <span>{{Auth::user()->fname}} {{Auth::user()->lname}}</span>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="comment">ارسال دیدگاه:</label>
                                    <textarea class="form-control" id="comment" name="comment" rows="5"></textarea>
                                </div>
                                <button class="btn btn-success">ارسال</button>
                            </div>
                        </form>
                    @else
                        <div class="col-12">
                            <p class="p-0 m-0">برای درج دیدگاه باید وارد سایت شوید</p>
                        </div>

                        @include('loginAjax')

                    @endif
                    <div class="row mt-2">
                        <div class="panel panel-default widget" >
                            <div class="panel-heading">
                                <span class="glyphicon glyphicon-comment"></span>
                                <h5 class="panel-title">تعداد نظرات </h5>
                                <span class="label label-info"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a class="nav-link active" id="nav-comments-tab" data-toggle="tab" href="#nav-comments" role="tab" aria-controls="nav-comments" aria-selected="true">دیدگاه ها</a>
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                <!-- TAB COMMENTS -->
                                <div class="tab-pane fade show active" id="nav-comments" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <ul class="list-group pl-0">
                                        @foreach($course->comments as $item)
                                            <li class="list-group-item border-bottom text-justify" >
                                                <div class="row">
                                                    <div class="col-xs-2 col-md-1">
                                                        @if(is_null($item->user))
                                                            <img src="{{asset('/documents/users/default-avatar.png')}}" class="img-circle img-responsive"  width="50px" height="50px" />
                                                        @else
                                                            <img src="{{asset('/documents/users/'.$item->user->personal_image)}}" class="img-circle img-responsive" width="50px" height="50px" />
                                                        @endif
                                                    </div>
                                                    <div class="col-xs-10 col-md-11">
                                                        <div  class="mb-2">
                                                            <a href="#">{{$item->user->fname.' '.$item->user->lname}}</a>
                                                            <div class="mic-info ">
                                                            </div>
                                                        </div>
                                                        <div class="comment-text">
                                                            {{$item->comment}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@section('footerScript')
    <script>
        const prepayment={{$course->prepayment}};
        const peymant_off={{$course->peymant_off}};
        const fi={{$course->fi_off}};
        const tedadGhest={{$tedadGhest}};

        function mohasebe()
        {

            var payment=$("#prepayment").val();
            if(payment>=prepayment && payment<=fi)
            {
                var ghest=$("#ghest").val();
                if(ghest>=1 && ghest<=tedadGhest)
                {
                    $('#faktor').attr('class','col-12');
                    $("#prepaymant_faktor").html(payment+" تومان ");
                    var fi_final_checkout=payment-((payment*peymant_off)/100);
                    var baghimandeh=fi-fi_final_checkout;
                    $("#baghimandeh_faktor").html(baghimandeh+" تومان ");
                    $("#fi_takhfif").html(fi_final_checkout + " تومان ");
                    var ghestha=(baghimandeh/ghest).toFixed(2);
                    $("#ghest_faktor").html("تعداد "+ghest+" قسط به مبلغ "+ghestha+" تومان ");
                    return true;

                }
                else
                {
                    alert('تعداد اقساط را وارد کنید');
                    $('#faktor').attr('class','col-12 d-none');
                }


            }
            else
            {
                alert('قیمت وارد شده صحیح نمی باشد');
                $('#faktor').attr('class','col-12 d-none');
            }
        };


        $("#btn_pardakht").click(function()
        {
            alert("AAAAAAA");
            if(mohasebe())
            {
               $.ajax({

               })
            }
        });




        $("#personal_link").click(function()
        {
            navigator.clipboard.writeText($('#personal_link').text());
            alert('لینک دعوت اختصاصی شما کپی شد');
        });
    </script>
@endsection
