@extends('master.index')

@section('headerscript')
    <style>
        h1
        {
            font-size: 2rem ;
            color:#003366 !important;
        }
        #tooltip_txt{
            color:grey;
            font-size: 12px;
            text-align: center;
        }
    </style>
@endsection

@section('row1')
    <section class="py-5 bg-light ">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5">
                <div class="col-md-7">
                    <img class="card-img-top mb-5 mb-md-0" src="{{$product->image}}" alt="..." height="600px"/>
                </div>
                <div class="col-md-5">
                    <div class="mb-2"></div>
                    <h1 class="font-weight-bold">{{$product->course}}</h1>
                    <div class="fs-5 mb-2 mt-4">
                        قیمت:

                        <span class="text-decoration-line-through mr-5">{{number_format($product->fi)}} تومان</span>

                        <p class="font-weight-bold d-inline">{{number_format($product->fi_off)}} تومان</p>
                    </div>

                    <div>

                    </div>

                    <div class="d-flex mt-5 mb-5">

                        <div class="row">
                            @if(!Auth::check())
                                <small>برای خرید لطفا وارد سایت شوید</small>
                                <a href="/login" class="btn btn-primary">ورود به سایت</a>
                            @else
                                <form method="post" action="/cart">
                                    {{csrf_field()}}
                                    <input type="hidden" value="{{$product->id}}" name="product_id" />
                                    <input type="hidden" value="product" name="type" />
                                    @if(!is_null(Auth::user()->purchases))
                                        @if(Auth::user()->purchases->where('product_id','=',$product->id)->count()>0)
                                            <h6>شما قبل این محصول را خریداری کرده اید !</h6>
                                        @endif
                                    @endif
                                    <button class="btn btn-outline-primary" type="submit">
                                    <i class="bi-cart-fill me-1"></i>
                                    خرید
                                    </button>
                                </form>
                                <div class="card mt-4" >
                                    <div class="card-body">
                                        <h5>لینک دعوت اختصاصی شما</h5>
                                        <p class="text-light bg-secondary p-2 text-right"  id="personal_link" dir="ltr">{{asset('/product/'.$product->shortlink)."?q=".Auth::user()->id}}</p>
                                        <p id="tooltip_txt">برای کپی شدن لینک برروی باکس بالا کلیک کنید !</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-5">
                    <p class="font-weight-bold">توضیحات:</p>
                    {!! $product->info !!}
                </div>
            </div>
            <div class="row">
                <div class="container mb-5 " id="show_comments_blog">
                    @if($errors->any())
                        <div class="col-12">
                            <div class="alert alert-danger" role="alert">
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    @if(session('msg') && (session('errorStatus')))
                        <div class="col-12">
                            <div class="alert alert-{{session('errorStatus')}}">
                                <p class="p-0 m-0">{{session('msg')}}</p>
                            </div>
                        </div>
                    @endif
                    @if(Auth::check())
                        <form method="post" action="/panel/comments"class="pb-2 border-bottom">
                            {{csrf_field()}}
                            <input type="hidden" name="post_id" value="{{$product->id}}">
                            <input type="hidden" name="type" value="product">
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
                                        @foreach($comments as $item)
                                            <li class="list-group-item border-bottom text-justify" >
                                                <div class="row">
                                                    <div class="col-xs-2 col-md-1">
                                                        <img src="{{asset('/documents/users/'.$item->personal_image)}}" class="img-circle img-responsive" width="50px" height="50px" />
                                                    </div>
                                                    <div class="col-xs-10 col-md-11">
                                                        <div  class="mb-2">
                                                            <a href="#">{{$item->fname.' '.$item->lname}}</a>
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
        $("#personal_link").click(function()
        {
            navigator.clipboard.writeText($('#personal_link').text());
            alert('لینک دعوت اختصاصی شما کپی شد');
        });
    </script>
@endsection
