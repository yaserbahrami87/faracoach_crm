@extends('master.index')

@section('headerscript')
    <style>
        @import url('https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
        #team {
            background: #eee !important;
        }

        .btn-primary:hover,
        .btn-primary:focus {
            /*
            background-color: #108d6f;
            border-color: #108d6f;*/
            box-shadow: none;
            outline: none;
        }

        .btn-primary {
            color: #fff;
           /* background-color: #007b5e;
            border-color: #007b5e;*/
        }

        section {
            padding: 60px 0;
        }

        section .section-title {
            text-align: center;
            /*color: #007b5e;*/
            margin-bottom: 50px;
            text-transform: uppercase;
        }

        #team .card {
            border: none;
            background: #ffffff;
        }

        .image-flip:hover .backside,
        .image-flip.hover .backside {
            -webkit-transform: rotateY(0deg);
            -moz-transform: rotateY(0deg);
            -o-transform: rotateY(0deg);
            -ms-transform: rotateY(0deg);
            transform: rotateY(0deg);
            border-radius: .25rem;
        }

        .image-flip:hover .frontside,
        .image-flip.hover .frontside {
            -webkit-transform: rotateY(180deg);
            -moz-transform: rotateY(180deg);
            -o-transform: rotateY(180deg);
            transform: rotateY(180deg);
        }

        .mainflip {
            -webkit-transition: 1s;
            -webkit-transform-style: preserve-3d;
            -ms-transition: 1s;
            -moz-transition: 1s;
            -moz-transform: perspective(1000px);
            -moz-transform-style: preserve-3d;
            -ms-transform-style: preserve-3d;
            transition: 1s;
            transform-style: preserve-3d;
            position: relative;
        }

        .frontside {
            position: relative;
            -webkit-transform: rotateY(0deg);
            -ms-transform: rotateY(0deg);
            z-index: 2;
            margin-bottom: 30px;
        }

        .backside {
            position: absolute;
            top: 0;
            left: 0;
            background: white;
            -webkit-transform: rotateY(-180deg);
            -moz-transform: rotateY(-180deg);
            -o-transform: rotateY(-180deg);
            -ms-transform: rotateY(-180deg);
            transform: rotateY(-180deg);
            -webkit-box-shadow: 5px 7px 9px -4px rgb(158, 158, 158);
            -moz-box-shadow: 5px 7px 9px -4px rgb(158, 158, 158);
            box-shadow: 5px 7px 9px -4px rgb(158, 158, 158);
        }

        .frontside,
        .backside {
            -webkit-backface-visibility: hidden;
            -moz-backface-visibility: hidden;
            -ms-backface-visibility: hidden;
            backface-visibility: hidden;
            -webkit-transition: 1s;
            -webkit-transform-style: preserve-3d;
            -moz-transition: 1s;
            -moz-transform-style: preserve-3d;
            -o-transition: 1s;
            -o-transform-style: preserve-3d;
            -ms-transition: 1s;
            -ms-transform-style: preserve-3d;
            transition: 1s;
            transform-style: preserve-3d;
        }

        .frontside .card,
        .backside .card {
            min-height: 312px;
        }

        .backside .card a {
            font-size: 18px;
            /* color: #007b5e !important;*/
        }

        .frontside .card .card-title,
        .backside .card .card-title {
            /*color: #007b5e !important; */
        }

        .frontside .card .card-body img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
        }
    </style>
@endsection
@section('row1')
    <div class="col-12 mt-5">
        <div class="row">
            <div class="col-12 border-bottom mb-4">
                <h3>لیست کوچ های فراکوچ</h3>
            </div>
            <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 border-left">
                <div class="card mb-3" >
                    <div class="card-header bg-info text-light">جستجو</div>
                    <div class="card-body">
                        <form method="get" action="/coaches/all/">
                            <div class="form-group">
                                <label for="search">جستجوی کوچ:</label>
                                <input type="text" class="form-control" id="search" placeholder="نام خانوادگی را وارد کنید" name="q">
                            </div>
                            <button class="btn btn-success btn-block" type="submit" name="search">فیلتر کن</button>
                        </form>
                    </div>
                </div>
                <div class="card mb-3" >
                    <div class="card-header bg-info text-light">فیلترها</div>
                    <div class="card-body">
                        <form method="get" action="/coaches/all/">
                            <div class="form-group">
                                <label for="categoryCoaches">دسته بندی کوچ ها</label>
                                <select class="form-control" id="categoryCoaches" name="categoryCoaches">
                                    <option disabled selected>انتخاب کنید</option>
                                    @foreach($category_coaches as $item)
                                        <option value="{{$item->id}}">{{$item->category}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <label>جنسیت:</label>
                            <div class="form-group">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInline1" name="gender" class="custom-control-input" value="1">
                                    <label class="custom-control-label" for="customRadioInline1">آقا</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInline2" name="gender" class="custom-control-input" value="2">
                                    <label class="custom-control-label" for="customRadioInline2">خانم</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success btn-block" name="filterCoach">فیلتر کن</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-9 col-lg-9 col-xl-9">
                <div class="row">
                    @if($coaches->count()==0)
                        <div class="alert alert-warning col-12">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                            </svg>
                            موردی برای نمایش پیدا نشد
                        </div>
                    @else
                        <section id="team" class="pb-5">
                            <div class="container">
                                <div class="row">
                                    <!-- Team member -->
                                    @foreach($coaches as $item)
                                        <div class="col-xs-12 col-sm-6 col-md-4">
                                            <div class="image-flip" >
                                                <div class="mainflip flip-0">
                                                    <div class="frontside">
                                                        <div class="card">
                                                            <div class="card-body text-center">
                                                                <p>
                                                                    @if(strlen($item->personal_image)>0)
                                                                        <img src="{{asset('/documents/users/'.$item->personal_image)}}" class="rounded-circle img-fluid" alt="..." />
                                                                    @else
                                                                        <img src="{{asset('/documents/users/default-avatar.png')}}" class="rounded-circle img-fluid" />
                                                                    @endif
                                                                <h4 class="card-title">{{$item->fname}} {{$item->lname}}</h4>
                                                                <p class="card-text">{{$item->aboutme}}</p>
                                                                <a href="/coach/{{$item->username}}" class="btn btn-primary btn-block">مشاهده اطلاعات</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="backside">
                                                        <div class="card">
                                                            <div class="card-body text-center mt-4">
                                                                <a href="/coach/{{$item->username}}">
                                                                    <h4 class="card-title">{{$item->fname}} {{$item->lname}}</h4>
                                                                </a>

                                                                <p class="card-text">{{$item->aboutme}}</p>
                                                                <ul class="list-inline">
                                                                    @if(strlen($item->instagram)>0)
                                                                        <li class="list-inline-item">
                                                                            <a class="social-icon text-xs-center" target="_blank" href="https://www.instagram.com/{{$item->instagram}}">
                                                                                <i class="fa fa-instagram"></i>
                                                                            </a>
                                                                        </li>
                                                                    @endif

                                                                    @if(strlen($item->telegram)>0)
                                                                        <li class="list-inline-item">
                                                                            <a class="social-icon text-xs-center" target="_blank" href="https://t.me/{{$item->telegram}}">
                                                                                <i class="fa fa-telegram"></i>
                                                                            </a>
                                                                        </li>
                                                                    @endif
                                                                    @if(strlen($item->email)>0)
                                                                        <li class="list-inline-item">
                                                                            <a class="social-icon text-xs-center" target="_blank" href="mailto:{{$item->email}}">
                                                                                <i class="fa fa-envelope"></i>
                                                                            </a>
                                                                        </li>
                                                                    @endif
                                                                    <li class="list-inline-item">
                                                                        <a class="social-icon text-xs-center" target="_blank" href="tel:02191091121">
                                                                            <i class="fa fa-phone"></i>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                                <a href="/coach/{{$item->username}}" class="btn btn-primary btn-block">مشاهده اطلاعات</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <!-- ./Team member -->

                                </div>
                            </div>
                        </section>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection



@section('footerScript')
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
@endsection

