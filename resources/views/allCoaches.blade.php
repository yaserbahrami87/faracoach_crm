@extends('master.index')
@section('row1')
    <div class="col-12 mt-5">
        <div class="row">
            <div class="col-12 border-bottom mb-4">
                <h3>لیست کوچ های فراکوچ</h3>
            </div>
            @foreach($coaches as $item)
                <div class="col-xs-12 col-sm-4 col-lg-3 col-xl-3  box-products ">
                    <div class="card p-1 text-center d-block shadow">
                        <img src="{{asset('/documents/users/'.$item->personal_image)}}" class="img-circle" alt="..." width="150px">
                        <div class="card-body  text-center">
                            <p class="text-bold">{{$item->fname}} {{$item->lname}}</p>
                            <a href="/coach/{{$item->username}}" class="btn btn-primary btn-sm" >مشاهده رزومه</a>
                            <a href="/coach/{{$item->username}}" class="btn btn-primary btn-sm" >رزرو جلسه</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

