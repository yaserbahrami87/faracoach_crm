@extends('blogMaster.index')
@section('rowcontent')
        <!-- Blog Post -->
        @foreach($posts as $item)
        <div class="card mb-4">
            <img class="card-img-top" src="{{$item->image}}" alt="Card image cap">
            <div class="card-body">
                <h2 class="card-title">{{$item->title}}</h2>
                <small class="text-muted">دسته بندی:{{$item->category}}</small>
                <p class="card-text">{!!  \Illuminate\Support\Str::limit($item->content, $limit = 300, $end = '...') !!}</p>
                <a href="/{{$user->username}}/post/{{$item->shortlink}}" class="btn btn-primary">ادامه مطلب</a>
            </div>
            <div class="card-footer text-muted">
                <span>نوشته شده در ساعت {{$item->time_fa}} در تاریخ {{$item->date_fa}}</span>
                <div class="d-inline float-left">

                    <span>نظرات {{$item->comment}}</span>
                </div>
            </div>
        </div>
        @endforeach
        <!-- Pagination -->
        {{$posts->links()}}
@endsection

