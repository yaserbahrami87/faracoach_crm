@extends('admin.master.index')
@section('content')
    <div class="col-12">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-all" role="tab" aria-controls="nav-all" aria-selected="true">همه درخواست ها <span class="badge badge-secondary">{{$scholarships->count()}}</span></a>
                <a class="nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-notaccept" role="tab" aria-controls="nav-notaccept" aria-selected="false">پدیرش نشده ها <span class="badge badge-danger">{{$scholarships->where('status','<>',1)->count()}}</span></a>
                <a class="nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-accept" role="tab" aria-controls="nav-accept" aria-selected="false">پذیرش شده ها<span class="badge badge-success">{{$scholarships->where('status','=',1)->count()}}</span></a>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-all" role="tabpanel" aria-labelledby="nav-all-tab">
                <div class="col-12 table-responsive">
                    <table  class="table_data table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr class="text-center">
                                <th>ردیف</th>
                                <th>نام و نام خانوادگی</th>
                                <th>کد ملی</th>
                                <th>تلفن</th>
                                <th>کد پیگیری</th>
                                <th>وضعیت</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($scholarships as $item)
                                <tr>
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td class="text-center">
                                        <a href="/admin/scholarship/{{$item->id}}">{{$item->user->fname.' '.$item->user->lname}}</a>
                                    </td>
                                    <td class="text-center" dir="ltr">{{$item->user->codemelli}}</td>
                                    <td class="text-center" dir="ltr">{{$item->user->tel}}</td>
                                    <td class="text-center" dir="ltr">{{$item->trackingcode}}</td>
                                    <td class="text-center">
                                        @switch($item->status)
                                            @case(0)بررسی نشده
                                            @break
                                            @case(1)تائید شده
                                            @break
                                            @case(2)رد درخواست
                                            @break
                                            @case(3)در حال بررسی
                                            @break
                                            @case(4)اصلاح درخواست
                                            @break
                                            @default خطا

                                        @endswitch
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-notaccept" role="tabpanel" aria-labelledby="nav-notaccept-tab">
                <div class="tab-pane fade show active" id="nav-all" role="tabpanel" aria-labelledby="nav-all-tab">
                    <div class="col-12 table-responsive">
                        <table  class="table_data table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr class="text-center">
                                <th>ردیف</th>
                                <th>نام و نام خانوادگی</th>
                                <th>کد ملی</th>
                                <th>تلفن</th>
                                <th>کد پیگیری</th>
                                <th>وضعیت</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($scholarships->where('status','<>',1) as $item)
                                <tr>
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td class="text-center">
                                        <a href="/admin/scholarship/{{$item->id}}">{{$item->user->fname.' '.$item->user->lname}}</a>
                                    </td>
                                    <td class="text-center" dir="ltr">{{$item->user->codemelli}}</td>
                                    <td class="text-center" dir="ltr">{{$item->user->tel}}</td>
                                    <td class="text-center" dir="ltr">{{$item->trackingcode}}</td>
                                    <td class="text-center">
                                        @switch($item->status)
                                            @case(0)بررسی نشده
                                            @break
                                            @case(1)تائید شده
                                            @break
                                            @case(2)رد درخواست
                                            @break
                                            @case(3)در حال بررسی
                                            @break
                                            @case(4)اصلاح درخواست
                                            @break
                                            @default خطا

                                        @endswitch
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-accept" role="tabpanel" aria-labelledby="nav-accept-tab">
                <div class="tab-pane fade show active" id="nav-all" role="tabpanel" aria-labelledby="nav-all-tab">
                    <div class="col-12 table-responsive">
                        <table  class="table_data table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr class="text-center">
                                <th>ردیف</th>
                                <th>نام و نام خانوادگی</th>
                                <th>کد ملی</th>
                                <th>تلفن</th>
                                <th>کد پیگیری</th>
                                <th>وضعیت</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($scholarships->where('status','=',1) as $item)
                                <tr>
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td class="text-center">
                                        <a href="/admin/scholarship/{{$item->id}}">{{$item->user->fname.' '.$item->user->lname}}</a>
                                    </td>
                                    <td class="text-center" dir="ltr">{{$item->user->codemelli}}</td>
                                    <td class="text-center" dir="ltr">{{$item->user->tel}}</td>
                                    <td class="text-center" dir="ltr">{{$item->trackingcode}}</td>
                                    <td class="text-center">
                                        @switch($item->status)
                                            @case(0)بررسی نشده
                                                    @break
                                            @case(1)تائید شده
                                                    @break
                                            @case(2)رد درخواست
                                                    @break
                                            @case(3)در حال بررسی
                                                    @break
                                            @case(4) اصلاح درخواست
                                                    @break
                                            @default خطا

                                        @endswitch
                                        @if($item->status==0)
                                            بررسی نشده
                                        @elseif($item->status==1)
                                            تایید شده
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footerScript')
    <script src="{{asset('/dashboard/assets/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('/dashboard/assets/js/dataTables.bootstrap4.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('.table_data').DataTable();
        } );
    </script>
@endsection
