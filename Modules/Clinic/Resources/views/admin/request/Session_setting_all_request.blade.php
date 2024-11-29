@extends('admin.master.index')
@section('headerScript')
    <link href="{{asset('/dashboard/assets/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
@endsection
@section('content')
    <div class="col-12 table-responsive">
        <table class="dataTable table table-striped table-bordered text-center">
            <tr>
                <th>ردیف </th>
                <th> درخواست دهنده </th>
                <th>نوع درخواست</th>
                <th>تاریخ درخواست </th>
                <th> وضعیت درخواست </th>
            </tr>
            @foreach($all_request as $all_request)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>
                        <a href="/admin/session_setting/admin_show/{{$all_request->id}}">
                            {{$all_request->user->fname.' '.$all_request->user->lname}}
                        </a>
                    </td>
                    <td>
                        @foreach($all_request->user->session_settings as $session_setting)
                            {{($session_setting->Clinic_basic_info->title).' ,  '}}
                        @endforeach
                    </td>
                    <td>{{$all_request->date_request}}</td>
                    <td>
                        @foreach($all_request->user->session_settings as $session_setting)

                            @if ($session_setting->status==0)
                                خوانده نشده ,
                             @elseif ($session_setting->status==1)
                                درحال بررسی ,
                             @elseif ($session_setting->status==2)
                                تایید شده ,
                             @elseif ($session_setting->status==3)
                                ارسال برای اصلاح ,
                            @elseif($session_setting->status==4)
                                رد شده,
                            @endif
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
@section('footerScript')
    <script src="{{asset('/dashboard/assets/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('/dashboard/assets/js/dataTables.bootstrap4.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('.dataTable').DataTable();
        } );
    </script>
@endsection

