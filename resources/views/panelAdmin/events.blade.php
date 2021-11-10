@extends('panelAdmin.master.index')
@section('rowcontent')
    <div class="container bg-light p-5 shadow-lg">
        <div class="row">
            <div class="col-12 border-bottom mb-3">
                <h4>
                    <i class="bi bi-display"></i>
                    لیست رویداد ها
                </h4>
            </div>

            @foreach($events as $item)
                <div class="col-xs-6 col-md-3 col-lg-3 col-xl-3 mb-4  ">
                    <div class="card h-100">
                        <div class="h-50 mb-2">
                            <img src="{{asset('/documents/events/'.$item->image)}}" style="height: 180px !important;" class="img-fluid card-img-top" alt="...">
                        </div>
                        <div class="card-body text-center">
                            <a href="{{asset('/event/'.$item->shortlink)}}">
                                <h5 class="card-title text-center col-12 font-weight-bold">
                                    {{$item->event}}
                                </h5>
                            </a>
                            <p class="p-0 m-3 float-right  font-weight-bold">
                                <i class="bi bi-calendar-event-fill"></i> {{$item->start_date}}
                            </p>
                            <p class="p-0 m-3 float-left font-weight-bold">
                                <i class="bi bi-alarm-fill"></i> {{$item->start_time}}
                            </p>
                            <div class="col-12 text-center mt-5">
                                @if($item->status_event=='در حال ثبت نام')
                                    <a href="{{asset('/event/'.$item->shortlink)}}" class=" btn btn-outline-primary">{{$item->status_event}}</a>
                                @elseif($item->status_event=='تکمیل ظرفیت')
                                    <a href="{{asset('/event/'.$item->shortlink)}}" class=" btn btn-outline-warning">{{$item->status_event}}</a>
                                @elseif($item->status_event=='برگزار شد')
                                    <a href="{{asset('/event/'.$item->shortlink)}}" class=" btn btn-outline-danger">{{$item->status_event}}</a>
                                @endif
                            </div>
                            <div class="col-12 text-center mt-3">
                                <a href="/admin/event/{{$item->shortlink}}/edit" class="btn btn-warning" title="ویرایش رویداد" >
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                <a href="/admin/event/{{$item->shortlink}}/users" class="btn btn-success" title="افراد ثبت نام شده" >
                                    <i class="bi bi-people-fill" ></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
