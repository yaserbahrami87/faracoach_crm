@extends('admin.master.index')

@section('content')
    <div class="col-12 table-responsive">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">لاگ درگاه</a>
                <a class="nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Profile</a>
                <a class="nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</a>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>مشخصات</th>
                        <th>محصول</th>
                        <th>واریزی(تومان)</th>
                        <th>توضیحات</th>
                        <th>تاریخ</th>
                        <th>کد</th>
                    </tr>
                    @foreach($checkout as $item)
                        <tr class="@if($item->status==1) bg-success  @endif">
                            <td>{{$item->fname.' '.$item->lname}}</td>
                            <td>{{$item->product}}</td>
                            <td>{{number_format($item->price)}}</td>
                            <td>{{$item->description}}</td>
                            <td class="text-right">{{$item->dateTime}}</td>
                            <td class="text-right">{{$item->authority}}</td>
                        </tr>
                    @endforeach

                </table>
                {{$checkout->links()}}

            </div>
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">...</div>
            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">...</div>
        </div>

    </div>
@endsection

