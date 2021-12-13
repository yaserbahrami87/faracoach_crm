@extends('user.master.index')
@section('headerScript')
    <style>
        a
        {
            color:#000000;
        }
        .listFriends .btn
        {
            border-radius: 5px;
        }

        .listFriends .btn
        {
            width: auto;
            height: auto;
        }

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

        .listFriends div.hovercard .avatar img {
            width: 100px !important;
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

        #colors span
        {
            width: 25px;
            height: 25px;
        }
    </style>
@endsection
@section('content')


            <div class="col-12 m-5 border-bottom">
                <h3>لیست جلسات رزرو شده</h3>
            </div>
            <div class="col-12" id="colors">
                <div class="row">
                    <div class="col-6 col-sm-1 col-lg-1 col-md-1 col-xl-1 text-center p-0 m-0">
                        <span class="d-inline-block bg-success rounded-circle" ></span>
                    </div>
                    <div class="col-6 col-sm-11 col-lg-2 col-md-2 col-xl-2 p-0 m-0">
                        <p class=" p-0 m-0"> جلسات برگزار شده</p>
                    </div>
                    <div class="col-6 col-sm-1 col-lg-1 col-md-1 col-xl-1 text-center p-0 m-0">
                        <span class="d-inline-block bg-warning rounded-circle" ></span>
                    </div>
                    <div class="col-6 col-sm-11 col-lg-2 col-md-2 col-xl-2 p-0 m-0">
                        <p class=" p-0 m-0"> جلسات رزرو شده بلاتکلیف</p>
                    </div>

                </div>

            </div>
            <div class="col-12 table-responsive">
                <table class="table table-bordered table-striped">
                    @foreach($booking as $item)
                        <tr class="@if($item->caption_status=='رزرو شد') bg-warning @elseif($item->caption_status=='برگزارشد') bg-success @endif">
                            <td>{{$item->iteration}}</td>
                            <td class="p-0">
                                <img src="{{asset('/documents/users/'.$item->personal_image)}}" class="rounded-circle "  width="50px" height="50px" />
                            </td>
                            <td>
                                    <a class="btn-modal-introduced" href="{{$item->id}}"   >{{$item->fname}} {{$item->lname}}</a>
                            </td>

                            <td>
                                <p class="text-dark">{{$item->start_date}}</p>
                            </td>
                            <td>
                                <p class="text-dark">{{$item->start_time}}</p>
                            </td>
                            <td>
                                <p class="text-dark">{{$item->duration_booking}}</p>
                            </td>
                            <td>
                                <p class="text-dark">
                                    <span class="float-right">ارزیابی  @if(is_null($item->feedback_coachings_id))<i class="bi bi-x-lg" ></i>@else <i class="bi bi-check-lg" ></i> @endif</span>
                                    <span class="float-left">پیش جلسه  @if(is_null($item->presession))<i class="bi bi-x-lg"></i>@else <i class="bi bi-check-lg"></i> @endif</span>
                                </p>

                            </td>
                            <td>
                                <p class="text-dark">
                                    {{$item->caption_status}}
                                </p>
                            </td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="/panel/booking/{{$item->id}}" title="نمایش" >
                                    <i class="bi bi-eye-fill"></i>
                                </a>
                            </td>
                            <td>
                                @if($item->start_date>$dateNow)
                                    <form class="d-inline-block" method="POST" action="/booking/{{$item->booking_id}}" onsubmit="return confirm('آیا از لغو جلسه اطمینان دارید؟')">
                                        {{csrf_field()}}
                                        {{method_field('PATCH')}}
                                        <input type="hidden" name="status" value="4" />
                                        <button type="submit" class="btn btn-danger">
                                            لغو جلسه
                                        </button>
                                    </form>

                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>


@endsection
