@extends('panelUser.master.index')
@section('headerScript')
    <style>
        #listFriends .btn
        {
            border-radius: 5px;
        }

        #listFriends .btn
        {
            width: auto;
            height: auto;
        }
    </style>
@endsection
@section('rowcontent')
    <div class="container">
        <div class="row shadow-lg">
            <div class="col-12 m-5 border-bottom">
                <h3>لیست جلسات رزرو شده</h3>
            </div>
            @foreach($booking as $item)
            <div class="col-lg-3 col-sm-6" id="listFriends">
                <div class="card hovercard  shadow-sm">
                    <div class="cardheader">

                    </div>
                    <div class="avatar">
                        <img alt="" src="{{asset('documents/users/'.$item->personal_image)}}">
                    </div>
                    <div class="info">
                        <div class="title">
                            <a class="btn-modal-introduced" href="{{$item->id}}"  data-toggle="modal" data-target="#modal_introduced_profile"   >{{$item->fname}} {{$item->lname}}</a>
                        </div>
                        <div class="desc">{{$item->tel}}</div>
                    </div>
                    <div class="bottom">
                        <p class="border-bottom pb-4">
                            <span class="float-right">
                                <i class="bi bi-calendar-date-fill"></i>
                                {{$item->start_date}}
                            </span>
                            <span class="float-left">
                                <i class="bi bi-clock-fill"></i>
                                {{$item->start_time}}
                            </span>
                        </p>
                        <p class="border-bottom">
                            {{$item->duration_booking}}
                        </p>
                        <p>{{$item->caption_status}}</p>
                        <a class="btn btn-primary btn-sm" href="/panel/booking/{{$item->id}}" title="نمایش" >
                            <i class="bi bi-eye-fill"></i>
                        </a>
                        <form class="d-inline-block" method="POST" action="/booking/{{$item->booking_id}}" onsubmit="return confirm('آیا از لغو جلسه اطمینان دارید؟')">
                            {{csrf_field()}}
                            {{method_field('PATCH')}}
                            <input type="hidden" name="status" value="4" />
                            <button type="submit" class="btn btn-danger">
                                لغو جلسه
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection
