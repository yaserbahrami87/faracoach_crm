@extends('admin.master.index')
@section('headerScript')
    <link href="{{asset('/dashboard/assets/css/buttons.dataTables.min.css')}}" rel="stylesheet" />
@endsection

@section('content')
    <div class="col-12">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-all" role="tab" aria-controls="nav-all" aria-selected="true">همه درخواست ها <span class="badge badge-secondary">{{$scholarships->count()}}</span></a>

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
                                <th>تلفن</th>
                                <th>مسئول پیگیری</th>
                                <th >تحصیلات</th>
                                <th >تاریخ ثبت نام</th>
                                <th >دوره ثبت نامی</th>
                                <th >کد رهگیری</th>
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
                                    <a href="/admin/scholarship/{{$item->id}}" target="_blank">{{$item->user->fname.' '.$item->user->lname}}</a>

                                </td>
                                <td class="text-center" dir="ltr">{{$item->user->tel}}</td>
                                <td class="text-center" dir="ltr">
                                    @if(!is_null($item->user->get_followbyExpert))
                                        {{$item->user->get_followbyExpert->fname.' '.$item->user->get_followbyExpert->lname}}
                                    @endif
                                </td>
                                <td class="text-center" dir="ltr">{{$item->user->education}}</td>
                                <td class="text-center" dir="ltr">
                                    @if(!is_null($item->user->state))
                                        {{$item->user->get_state->name}}
                                    @endif
                                </td>
                                <td class="text-center" dir="ltr" >
                                    @if(count($item->user->get_scholarshipexam)>0)
                                        {{($item->user->get_scholarshipexam->last()->date_fa)}}
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
                    'excel',
                ]
            } );
        } );
    </script>
@endsection
