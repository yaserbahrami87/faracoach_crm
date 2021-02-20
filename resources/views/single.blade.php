@extends('blogMaster.index')
@section('rowcontent')
    <div class="card mb-4">
        <img class="card-img-top" src="{{$posts->image}}" alt="Card image cap">
        <div class="card-body">
            <h2 class="card-title">{{$posts->title}}</h2>
            <p class="card-text">{!!  $posts->content !!}</p>
        </div>
        <div class="card-footer text-muted">نوشته شده در ساعت {{$posts->time_fa}} در تاریخ {{$posts->date_fa}}
            <div class="d-inline float-left">
                <span>پسندیده 1</span>
                <span>نظرات 1</span>
            </div>
        </div>
    </div>
@endsection
