@extends('admin.master.index')
@section('headerScript')
    <style>
        a
        {
            color:#000000;
        }

        #colors span
        {
            width: 25px;
            height: 25px;
        }
    </style>
@endsection
@section('content')
    <div class="container bg-secondary-light">
        <div class="row p-1">
            <div class="col-12 mb-3 border-bottom">

                <h4>لیست افراد شرکت کننده در دوره {{$event->event}}</h4>
            </div>
            <div class="col-12">
                <div class="row table-responsive">
                    @if($event->eventreserves->count()>0)
                        <table class="table">
                            <tr>
                                <th></th>
                                <th>مشخصات</th>
                                <th>شماره تماس</th>
                                <th>تاریخ</th>
                                <th>ساعت</th>
                                <th>نوع کاربر</th>
                                <th>واریزی</th>
                            </tr>
                            @foreach($eventreserves as $item)

                                <tr>
                                    <td>
                                        <img class="rounded-circle" src="{{asset('documents/users/'.$item->user->personal_image)}}" width="50px" height="50px">
                                    </td>
                                    <td>{{$item->user->fname}} {{$item->user->lname}}</td>
                                    <td dir="ltr">{{$item->user->tel}}</td>
                                    <td>{{$item->date_fa}}</td>
                                    <td>{{$item->time_fa}}</td>
                                    <td class="text-center">
                                        @if($item->user->created_at>=$event->created_at)
                                            کاربر جدید
                                        @elseif($item->user->created_at<=$event->created_at)
                                            @if($item->user->type==20)
                                                دانشجو
                                            @else
                                                کاربر قدیمی
                                            @endif
                                        @endif

                                    </td>
                                    <td>

                                        @if(is_null($item->user->checkout))
                                            رایگان
                                        @else
                                            {{$item->user->checkout->where('type','event')->where('product_id',$event->id)->where('description','خرید
                                            انجام شد')->price}}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <div class="col-12 alert alert-warning">
                            <i class="bi bi-exclamation-triangle-fill"></i>
                            تاکنون کسی در رویداد مورد نظر شرکت نکرده است
                        </div>
                    @endif
                </div>
                {{$eventreserves->links()}}
            </div>
        </div>
    </div>
@endsection
