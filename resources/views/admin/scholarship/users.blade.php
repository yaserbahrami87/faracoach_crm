@extends('admin.master.index')
@section('headerScript')
    <link href="{{asset('/dashboard/assets/css/buttons.dataTables.min.css')}}" rel="stylesheet" />
@endsection

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
                    <form method="get" action="/admin/scholarship/exportExcel">
                        {{csrf_field()}}
                        <button class="btn btn-primary" type="submit">
                            <i class="bi bi-file-earmark-excel-fill"></i>
                            خروجی اکسل
                        </button>
                    </form>
                    <table  class="table_data table table-striped table-bordered" style="width:100%">

                        <thead>
                            <tr class="text-center">
                                <th>ردیف</th>
                                <th>نام و نام خانوادگی</th>
                                <th>وضعیت پروفایل</th>
                                <th>وضعیت درخواست</th>
                                <th class="d-none">کد ملی</th>
                                <th>تلفن</th>
                                <th>تحصیلات</th>
                                <th>تاریخ ثبت نام</th>
                                <th>ساعت ثبت نام</th>
                                <th> افراد معرفی شده</th>
                                <th> افراد ثبت نام بورسیه</th>

                            </tr>
                        </thead>

                        <tbody>
                            @foreach($scholarships as $item)
                                <tr>
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td class="text-center">
                                        @if($item->user->created_at>'2022-07-20 00:00:00')
                                            <span class="text-danger">*</span>
                                        @endif
                                        <a href="/admin/scholarship/{{$item->id}}">{{$item->user->fname.' '.$item->user->lname}}</a>

                                    </td>
                                    <td class="text-center" dir="ltr">

                                        @if(strlen($item->user->username)>0 &&strlen($item->user->email)>0&&strlen($item->user->fname)>0&&strlen($item->user->lname)>0&&strlen($item->user->datebirth)>0&&strlen($item->user->father)>0&&strlen($item->user->codemelli)>0&&strlen($item->user->sex)>0&&strlen($item->user->tel)>0&&strlen($item->user->shenasname)>0&&strlen($item->user->born)>0&&strlen($item->user->education)>0&&strlen($item->user->reshteh)>0&&strlen($item->user->job)>0&&strlen($item->user->state)>0&&strlen($item->user->city)>0&&strlen($item->user->address)>0&&strlen($item->user->personal_image)>0&&strlen($item->user->shenasnameh_image)>0&&strlen($item->user->cartmelli_image)>0&&strlen($item->user->education_image)>0&&strlen($item->user->resume)>0&&strlen($item->user->married)>0&&strlen($item->user->telegram)>0&&strlen($item->user->instagram)>0&&strlen($item->user->linkedin)>0)
                                            <p class=" text-success">تکمیل شده</p>
                                        @else
                                            <p class=" text-danger">ناقص </p>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @switch($item->status)
                                            @case(0)<span class="text-info"> بررسی نشده</span>
                                            @break
                                            @case(1)<span class="text-success"> تائید شده</span>
                                            @break
                                            @case(2)<span class="text-danger">رد درخواست</span>
                                            @break
                                            @case(3)<span class="text-dark">در حال بررسی</span>
                                            @break
                                            @case(4) <span class="text-primary">اصلاح درخواست</span>
                                            @break
                                            @case(5)<span class="text-warning">اصلاح شده</span>
                                            @break
                                            @default خطا

                                        @endswitch
                                    </td>
                                    <td class="text-center d-none" dir="ltr">{{$item->user->codemelli}}</td>
                                    <td class="text-center" dir="ltr">{{$item->user->tel}}</td>
                                    <td class="text-center" dir="ltr">{{$item->user->education}}</td>
                                    <td class="text-center" dir="ltr">{{substr($item->created_at,0,10)  }}</td>
                                    <td class="text-center" dir="ltr">{{substr($item->created_at,12,4)  }}</td>
                                    <td class="text-center" dir="ltr">{{($item->user->get_invitations->where('resource','=','بورسیه تحصیلی')->count())  }}</td>
                                    <td class="text-center" dir="ltr">
                                        @php
                                        $i=0;
                                        @endphp
                                        @foreach($item->user->get_invitations->where('resource','=','بورسیه تحصیلی') as $item_invitation)
                                            @if(!is_null($item_invitation->scholarship))
                                                @php
                                                  $i++;
                                                @endphp
                                            @endif
                                        @endforeach
                                        {{$i}}
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
                                <th class="d-none">کد ملی</th>
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
                                    <td class="text-center d-none" dir="ltr">{{$item->user->codemelli}}</td>
                                    <td class="text-center" dir="ltr">{{$item->user->tel}}</td>
                                    <td class="text-center" dir="ltr">{{$item->trackingcode}}</td>
                                    <td class="text-center">
                                        @switch($item->status)
                                            @case(0)<span class="text-info"> بررسی نشده</span>
                                            @break
                                            @case(1)<span class="text-success"> تائید شده</span>
                                            @break
                                            @case(2)<span class="text-danger">رد درخواست</span>
                                            @break
                                            @case(3)<span class="text-dark">در حال بررسی</span>
                                            @break
                                            @case(4) <span class="text-primary">اصلاح درخواست</span>
                                            @break
                                            @case(5)<span class="text-warning">اصلاح شده</span>
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
                                <th class="d-none">کد ملی</th>
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
                                    <td class="text-center d-none" dir="ltr">{{$item->user->codemelli}}</td>
                                    <td class="text-center" dir="ltr">{{$item->user->tel}}</td>
                                    <td class="text-center" dir="ltr">{{$item->trackingcode}}</td>
                                    <td class="text-center">
                                        @switch($item->status)
                                            @case(0)<span class="text-info"> بررسی نشده</span>
                                            @break
                                            @case(1)<span class="text-success"> تائید شده</span>
                                            @break
                                            @case(2)<span class="text-danger">رد درخواست</span>
                                            @break
                                            @case(3)<span class="text-dark">در حال بررسی</span>
                                            @break
                                            @case(4) <span class="text-primary">اصلاح درخواست</span>
                                            @break
                                            @case(5)<span class="text-warning">اصلاح شده</span>
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
        </div>
    </div>
@endsection

@section('footerScript')
    <script src="{{asset('/dashboard/assets/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('/dashboard/assets/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('/panel_assets/js/scripts/datatables/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('/panel_assets/js/scripts/datatables/jszip.min.js')}}"></script>
    <script src="{{asset('/panel_assets/js/scripts/datatables/vfs_fonts.js')}}"></script>
    <script src="{{asset('/panel_assets/js/scripts/datatables/buttons.html5.min.js')}}"></script>
    <script src="{{asset('/panel_assets/js/scripts/datatables/buttons.print.min.js')}}"></script>


    <script>
        $(document).ready(function() {
            $('.table_data').DataTable({
                // columnDefs: [
                //     {
                //         target: 6,
                //         visible: false,
                //         searchable: false,
                //     }
                // ],
                dom: 'Bfrltip',
                buttons: [
                    'copy',  'excel',
                ]
            } );
        } );
    </script>
@endsection
