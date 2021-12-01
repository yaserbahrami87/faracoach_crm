@extends('admin.master.index')

@section('headerScript')
    <style>

        .listFriends .card .avatar
        {
            width: auto;
            height: auto;
        }

        .listFriends .card {
            padding-top: 20px;
            margin: 10px 0 20px 0;
            background-color: rgba(214, 224, 226, 0.2);
            border-top-width: 0;
            border-bottom-width: 2px;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
            -webkit-box-shadow: none;
            -moz-box-shadow: none;
            box-shadow: none;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        .listFriends .card .card-heading {
            padding: 0 20px;
            margin: 0;
        }

        .listFriends .card .card-heading.simple {
            font-size: 20px;
            font-weight: 300;
            color: #777;
            border-bottom: 1px solid #e5e5e5;
        }

        .listFriends .card .card-heading.image img {
            display: inline-block;
            width: 46px;
            height: 46px;
            margin-right: 15px;
            vertical-align: top;
            border: 0;
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            border-radius: 50%;
        }

        .listFriends .card .card-heading.image .card-heading-header {
            display: inline-block;
            vertical-align: top;
        }

        .listFriends .card .card-heading.image .card-heading-header h3 {
            margin: 0;
            font-size: 14px;
            line-height: 16px;
            color: #262626;
        }

        .listFriends .card .card-heading.image .card-heading-header span {
            font-size: 12px;
            color: #999999;
        }

        .listFriends .card .card-body {
            padding: 0 20px;
            margin-top: 20px;
        }

        .listFriends .card .card-media {
            padding: 0 20px;
            margin: 0 -14px;
        }

        .listFriends .card .card-media img {
            max-width: 100%;
            max-height: 100%;
        }

        .listFriends .card .card-actions {
            min-height: 30px;
            padding: 0 20px 20px 20px;
            margin: 20px 0 0 0;
        }

        .listFriends .card .card-comments {
            padding: 20px;
            margin: 0;
            background-color: #f8f8f8;
        }

        .listFriends .card .card-comments .comments-collapse-toggle {
            padding: 0;
            margin: 0 20px 12px 20px;
        }

        .listFriends .card .card-comments .comments-collapse-toggle a,
        .listFriends .card .card-comments .comments-collapse-toggle span {
            padding-right: 5px;
            overflow: hidden;
            font-size: 12px;
            color: #999;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .listFriends .card-comments .media-heading {
            font-size: 13px;
            font-weight: bold;
        }

        .listFriends .card.people {
            position: relative;
            display: inline-block;
            width: 170px;
            height: 300px;
            padding-top: 0;
            margin-left: 20px;
            overflow: hidden;
            vertical-align: top;
        }

        .listFriends .card.people:first-child {
            margin-left: 0;
        }

        .listFriends .card.people .card-top {
            position: absolute;
            top: 0;
            left: 0;
            display: inline-block;
            width: 170px;
            height: 150px;
            background-color: #ffffff;
        }

        .listFriends .card.people .card-top.green {
            background-color: #53a93f;
        }

        .listFriends .card.people .card-top.blue {
            background-color: #427fed;
        }

        .listFriends .card.people .card-info {
            position: absolute;
            top: 150px;
            display: inline-block;
            width: 100%;
            height: 101px;
            overflow: hidden;
            background: #ffffff;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        .listFriends .card.people .card-info .title {
            display: block;
            margin: 8px 14px 0 14px;
            overflow: hidden;
            font-size: 16px;
            font-weight: bold;
            line-height: 18px;
            color: #404040;
        }

        .listFriends .card.people .card-info .desc {
            display: block;
            margin: 8px 14px 0 14px;
            overflow: hidden;
            font-size: 12px;
            line-height: 16px;
            color: #737373;
            text-overflow: ellipsis;
        }

        .listFriends .card.people .card-bottom {
            position: absolute;
            bottom: 0;
            left: 0;
            display: inline-block;
            width: 100%;
            padding: 10px 20px;
            line-height: 29px;
            text-align: center;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        .listFriends .card.hovercard {
            position: relative;
            padding-top: 0;
            overflow: hidden;
            text-align: center;
            background-color: rgba(214, 224, 226, 0.2);
        }

        .listFriends .card.hovercard .cardheader {
            background: url("http://lorempixel.com/850/280/nature/4/");
            background-size: cover;
            height: 135px;
        }

        .listFriends .card.hovercard .avatar {
            position: relative;
            top: -50px;
            margin-bottom: -50px;
        }

        .listFriends .card.hovercard .avatar img {
            width: 100px;
            height: 100px;
            max-width: 100px;
            max-height: 100px;
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            border-radius: 50%;
            border: 5px solid rgba(255,255,255,0.5);
        }

        .listFriends .card.hovercard .info {
            padding: 4px 8px 10px;
        }

        .listFriends .card.hovercard .info .title {
            margin-bottom: 4px;
            font-size: 16px;
            line-height: 1;
            color: #262626;
            vertical-align: middle;
        }

        .listFriends .card.hovercard .info .desc {
            overflow: hidden;
            font-size: 12px;
            line-height: 20px;
            color: #737373;
            text-overflow: ellipsis;
        }

        .listFriends .card.hovercard .bottom {
            padding: 0 20px;
            margin-bottom: 17px;
        }

        .listFriends .btn{
            border-radius: 50%;
            width:32px;
            height:32px;
            line-height:24px;
        }
    </style>
@endsection
@section('content')
    <div class="container shadow pt-3">
        <div class="row">
            <div class="col-12 col-md-3">
                <form method="get" action="/admin/education/students/search">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="در جستجوی دانشجو"  name="q" />
                        <div class="input-group-prepend">
                            <button class="btn btn-outline-secondary" type="submit" id="button-addon1">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                        <small class="text-muted">نام یا نام خانوادگی و یا شماره همراه دانشجو را وارد کنید</small>
                    </div>
                </form>
            </div>


            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 border" >
                <!-- <form method="GET" action="/admin/users/categorybyAdmin/"> -->
                <form method="GET" action="/admin/education/students/advancesearch">
                    <div class="row  mb-1">
                        <div class="col-xs-12 col-md-2 col-lg-2 col-xl-2">
                            <small>نمایش براساس دوره</small>
                            <!-- <form method="get" action="/admin/users/list_user_gettingknow"> -->
                            <div class="input-group">
                                <div class="input-group">
                                    <select class="custom-select" id="course" name="course" >
                                        <option selected disabled>انتخاب کنید</option>
                                        @foreach($course as $item)
                                            <option value="{{$item->id}}" >{{$item->course}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- </form> -->
                        </div>
                        <div class="col-xs-12 col-md-2 col-lg-2 col-xl-2">
                            <small>نمایش بر اساس کیفیت</small>
                            <!-- <form method="get" action="/admin/users/list_user_gettingknow"> -->
                            <div class="input-group">
                                <div class="input-group">
                                    <select class="custom-select" id="list_$problem" name="problem" >
                                        <option selected disabled>انتخاب کنید</option>

                                    </select>
                                </div>
                            </div>
                            <!-- </form> -->
                        </div>
                        <div class="col-xs-12 col-md-2 col-lg-2 col-xl-2">
                            <small class="btn-block">نمایش</small>
                            <button class="btn btn-secondary ">
                                <i class="bi bi-binoculars-fill"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            @if($students->count()==0)
                <div class="col-12 alert alert-warning">
                    <i class="bi bi-exclamation-diamond"></i>
                    اطلاعاتی یافت نشد
                </div>
            @else
                @foreach($students as $item)
                    <div class="col-lg-3 col-sm-6" id="listFriends">
                        <div class="card hovercard  shadow-sm">
                            <div class="cardheader">

                            </div>
                            <div class="avatar">
                                @if($item->getOriginal('personal_image'))
                                    <img alt="" src="{{asset('documents/users/'.$item->personal_image)}}">
                                @else
                                    <img alt="" src="{{asset('documents/users/default-avatar.png')}}">
                                @endif
                            </div>
                            <div class="info">
                                <div class="title">
                                    <a class="btn-modal-introduced" href="/admin/user/{{$item->id}}"   >{{$item->fname}} {{$item->lname}}</a>
                                </div>
                                <div class="desc">{{$item->tel}}</div>
                            </div>
                            <div class="bottom">
                                <p class="border-bottom pb-4">
                                    <span class="float-left">
                                        <i class="fas fa-book-reader"></i>
                                        {{$item->course}}
                                    </span>
                                    <span class="float-right">

                                    </span>
                                </p>
                                <p class="border-bottom">

                                </p>
                                <p>{{$item->caption_status}}</p>
                                <a class="btn btn-primary btn-sm" href="/admin/user/{{$item->id}}" title="نمایش" >
                                    <i class="bi bi-eye-fill"></i>
                                </a>

                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="col-12">
                    {{$students->links()}}
                </div>
            @endif
        </div>
    </div>
@endsection
