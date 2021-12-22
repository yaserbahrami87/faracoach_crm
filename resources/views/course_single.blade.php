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
                    <div class="d-flex mt-5 mb-5">
                        <form method="post" action="/cart">
                            {{csrf_field()}}
                            <input type="hidden" value="{{$course->id}}" name="product_id" />
                            <input type="hidden" value="course" name="type" />
                            <button class="btn btn-primary" type="submit">
                                <i class="bi-cart-fill me-1"></i>
                                خرید
                            </button>
                        </form>
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
