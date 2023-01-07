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
                            <th>دوره</th>
                            <th>مبلغ دوره</th>
                            <th>ثبت ناام اولیه (تومان)</th>
                            <th>میزان بورسیه</th>
                            <th>صندوق شکوفایی</th>
                            <th>مبلغ باقیمانده</th>
                            @foreach($collabration_details as $item)
                                <th>{{($item->title)}}</th>
                            @endforeach

                        </tr>
                        </thead>

                        <tbody>
                        @foreach($scholarships as $item)
                            <tr class="text-center" style="@if(!is_null($item->financial)) background-color: #9fff80; @endif">
                                <td class="text-center">{{$loop->iteration}}</td>
                                <td class="text-center">
                                    <a href="/admin/scholarship/{{$item->id}}" target="_blank">{{$item->user->fname.' '.$item->user->lname}}</a>
                                </td>

                                <td class="text-center" dir="ltr">{{$item->user->tel}}</td>
                                <td class="text-center" dir="ltr">
                                    {{$item->get_financial->scholarship_course['course']}}
                                </td>
                                <td>
                                    {{number_format($item->get_financial->schoalrshipPayment['fi'])}}
                                </td>

                                <td>
                                    {{number_format($item->get_financial['price'])}}
                                </td>
                                <td>{{($item->get_financial->schoalrshipPayment['score'])}}</td>
                                <td>{{($item->get_financial->schoalrshipPayment['loan'])}}</td>
                                <td>{{number_format($item->get_financial->schoalrshipPayment['remaining'])}}</td>
                                @foreach($collabration_details as $item_details)
                                    <td>
                                        @foreach($item->user->collabration_accept as $item_accept)
                                            @if($item_accept->collabration_detail_id==$item_details->id)
                                                {{number_format($item_accept->calculate)}}
                                            @endif
                                        @endforeach
                                    </td>
                                @endforeach
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
                dom: 'Bfrltip',
                buttons: [
                    'excel',
                ]
            } );
        } );
    </script>
@endsection
