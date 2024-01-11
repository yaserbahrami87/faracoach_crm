@extends('admin.master.index')

@section('headerScript')
    <link href="{{asset('/dashboard/assets/css/buttons.dataTables.min.css')}}" rel="stylesheet" />
    <link href="{{asset('/dashboard/assets/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
@endsection


@section('content')
    <div class="col-12 table-responsive">
        <table class="table table-striped" id="example">
            <thead>
                <tr class="text-center">
                    <th></th>
                    <th>شرکت کننده</th>
                    <th>آزمون</th>
                    <th>نمره</th>
                    <th>وضعیت</th>
                    <th>نمایش آزمون</th>
                    <th>تغییر وضعیت</th>
                </tr>
            </thead>
            <tbody>
                @foreach($takeExams as $takeExam)
                <tr class="text-center">
                    <td>{{$loop->iteration}}</td>
                    <td>{{$takeExam->user->fname.' '.$takeExam->user->lname}}</td>
                    <td>{{$takeExam->exam->exam}}</td>
                    <td>{{$takeExam->score}} از {{$takeExam->exam->pass}}</td>

                    @if($takeExam->status==0)
                        <td class="text-danger">
                            رد شده
                        </td>
                    @elseif($takeExam->status==1)
                        <td class="text-warning">
                            قبول در انتظار تایید
                        </td>
                    @endif
                    <td>
                        <a href="/admin/takeExam/{{$takeExam->id}}" class="btn btn-success">
                            <i class="bi bi-eye-fill"></i>
                        </a>
                    </td>
                    <td>
                        <a href="" class="btn btn-warning">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
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
            $('#example').DataTable({
                dom: 'Bfrltip',
                buttons: [
                    'copy',  'excel'
                ]
            } );
        } );
    </script>
@endsection
