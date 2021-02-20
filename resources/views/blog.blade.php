@extends('blogMaster.index')
@section('rowcontent')
        <!-- Blog Post -->
        @foreach($posts as $item)
        <div class="card mb-4">
            <img class="card-img-top" src="{{$item->image}}" alt="Card image cap">
            <div class="card-body">
                <h2 class="card-title">{{$item->title}}</h2>
                <p class="card-text">{!!  \Illuminate\Support\Str::limit($item->content, $limit = 250, $end = '...') !!}</p>
                <a href="/{{$user->username}}/post/{{$item->shortlink}}" class="btn btn-primary">ادامه مطلب</a>
            </div>
            <div class="card-footer text-muted">نوشته شده در ساعت {{$item->time_fa}} در تاریخ {{$item->date_fa}}
                <div class="d-inline float-left">
                    <span>پسندیده 1</span>
                    <span>نظرات 1</span>
                </div>
            </div>
        </div>
        @endforeach
        <!-- Pagination -->
        {{$posts->links()}}
@endsection

