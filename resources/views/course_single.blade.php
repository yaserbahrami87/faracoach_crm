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
                <div class="col-md-6">
                    <img class="card-img-top mb-5 mb-md-0" src="{{asset('/documents/'.$course->image)}}" alt="..." height="600px"/>
                </div>
                <div class="col-md-6">
                    <div class="mb-2"></div>
                    <h1 class="font-weight-bold">{{$course->course}}</h1>
                    <div class="fs-5 mb-2 mt-4">
                        قیمت:
                        <span class="text-decoration-line-through mr-5">{{number_format($course->fi)}} تومان</span>
                        <p class="font-weight-bold d-inline">{{number_format($course->fi_off)}} تومان</p>
                    </div>

                    <div>
                        <p>
                            مدرس:
                            <span>{{$course->teacher_id}}</span>
                        </p>
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
                            @if($course->type_peymant_id==1 || $course->type_peymant_id==3)
                                <div class="col-12 mb-2">
                                    <div class="row">
                                        <form method="post" action="/cart">
                                            {{csrf_field()}}
                                            <input type="hidden" value="{{$course->id}}" name="product_id" />
                                            <input type="hidden" value="course" name="type" />
                                            <button class="btn btn-outline-primary" type="submit">
                                                <i class="bi-cart-fill me-1"></i>
                                                خرید
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endif

                            @if($course->type_peymant_id==2 || $course->type_peymant_id==3)
                                <div class="col-12">
                                    <div class="row">
                                        <form method="post" action="/cart">
                                            {{csrf_field()}}
                                            <input type="hidden" value="{{$course->id}}" name="product_id" />
                                            <input type="hidden" value="course" name="type" />
                                            <input type="hidden" value="{{$tedadGhest}}" name="tedadGhest" />


                                                <!--
                                                <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#staticBackdrop">
                                                    <i class="bi-cart-fill me-1"></i>
                                                    پرداخت قسط
                                                </button>-->

                                                <!-- ****** MODAL *** -->
                                                <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel">شرایط پرداخت خود را وارد کنید</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <label for="prepayment">کوپن تخفیف</label>
                                                                <div class="input-group mb-3">
                                                                    <input type="text" class="form-control" />
                                                                    <div class="input-group-prepend">
                                                                        <button class="btn btn-outline-secondary" type="button">اعمال</button>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="prepayment">مبلغ نقدی (تومان)</label>
                                                                    <small>حداقل مبلغ پرداختی {{$course->prepayment}} تومان</small>
                                                                    <input type="number" class="form-control" id="prepayment" name="prepayment">
                                                                    <small class="">میزان {{$course->peymant_off}}% تخفیف در میزان پرداخت نقدی</small>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="ghest">تعداد اقساط</label>
                                                                    <select class="custom-select" id="ghest">
                                                                        <option selected disabled>انتخاب کنید</option>
                                                                        @for($i=1;$i<=$tedadGhest;$i++)
                                                                            <option value="{{$i}}">{{$i}}</option>
                                                                        @endfor
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="button" value="محاسبه"  onclick="mohasebe()"/>
                                                                </div>
                                                                <div class="col-12 d-none" id="faktor">
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <p class="float-right">قیمت: <span class="font-weight-bold">{{number_format($course->fi_off) }} تومان </span> </p>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <p class="float-right" >پرداخت نقدی: <span class="font-weight-bold" id="prepaymant_faktor"> </span> </p>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <p class="float-right">درصد تخفیف نقدی: <span class="font-weight-bold">{{$course->peymant_off}}% </span> </p>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <p class="float-right">نقدی نهایی: <span class="font-weight-bold" id="fi_takhfif"></span> </p>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <p class="float-right">باقیمانده: <span class="font-weight-bold" id="baghimandeh_faktor"></span></p>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <p class="float-right">اقساط: <span class="font-weight-bold" id="ghest_faktor"></span></p>
                                                                        </div>
                                                                        <button type="button" class="btn btn-success" id="btn_pardakht">پرداخت</button>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="button" class="btn btn-primary">Understood</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>





                                                <div class="collapse mt-2" id="collapseExample">
                                                    <div class="card card-header bg-light">
                                                        <p class="font-weight-bold text-dark m-0">شرایط پرداخت خود را وارد کنید</p>
                                                    </div>
                                                    <div class="card card-body">
                                                        <label for="prepayment">کوپن تخفیف</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="form-control" />
                                                            <div class="input-group-prepend">
                                                                <button class="btn btn-outline-secondary" type="button">اعمال</button>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="prepayment">مبلغ نقدی (تومان)</label>
                                                            <small>حداقل مبلغ پرداختی {{$course->prepayment}} تومان</small>
                                                            <input type="number" class="form-control" id="prepayment" name="prepayment">
                                                            <small class="">میزان {{$course->peymant_off}}% تخفیف در میزان پرداخت نقدی</small>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="ghest">تعداد اقساط</label>
                                                            <select class="custom-select" id="ghest">
                                                                <option selected disabled>انتخاب کنید</option>
                                                                @for($i=1;$i<=$tedadGhest;$i++)
                                                                    <option value="{{$i}}">{{$i}}</option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="button" value="محاسبه"  onclick="mohasebe()"/>
                                                        </div>
                                                        <div class="col-12 d-none" id="faktor">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <p class="float-right">قیمت: <span class="font-weight-bold">{{number_format($course->fi_off) }} تومان </span> </p>
                                                                </div>
                                                                <div class="col-12">
                                                                    <p class="float-right" >پرداخت نقدی: <span class="font-weight-bold" id="prepaymant_faktor"> </span> </p>
                                                                </div>
                                                                <div class="col-12">
                                                                    <p class="float-right">درصد تخفیف نقدی: <span class="font-weight-bold">{{$course->peymant_off}}% </span> </p>
                                                                </div>
                                                                <div class="col-12">
                                                                    <p class="float-right">باقیمانده: <span class="font-weight-bold" id="baghimandeh_faktor"></span></p>
                                                                </div>
                                                                <div class="col-12">
                                                                    <p class="float-right">اقساط: <span class="font-weight-bold" id="ghest_faktor"></span></p>
                                                                </div>
                                                                <button type="button" class="btn btn-success" id="btn_pardakht">پرداخت</button>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        </div>


                    </div>
                </div>
                <div class="col-12 mt-5">
                    <p class="font-weight-bold">توضیحات:</p>
                    {!! $course->infocourse !!}
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
    </script>
@endsection
