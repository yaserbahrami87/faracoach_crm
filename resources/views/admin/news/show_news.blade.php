@extends('admin.master.index')

@section('headerScript')
    <link href="{{asset('/dashboard/assets/css/buttons.dataTables.min.css')}}" rel="stylesheet" />
    <link href="{{asset('/dashboard/assets/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
@endsection

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">لیست اخبار</div>
            <div class="card-body table-responsive">
                <table class="table text-center">
                    <thead>

                    <th>عنوان خبر </th>
                    <th> خلاصه خبر</th>
                    <th>وضعیت خبر</th>
                    <th>ویرایش</th>
                    <th>حذف</th>
                    </thead>
                    <tbody>
                    @foreach($news as $news)
                        <tr>
                            <td class="text-center"><a href="/admin/news/{{$news->id}}/edit">{{$news->title}}</a></td>
                            <td class="text-center"><a href="/admin/news/{{$news->id}}/edit">{{$news->summery_news}}</a></td>
                            <td class="text-center"><a href="/admin/news/{{$news->id}}/edit">
                                    @if($news->status==1)
                                        فعال
                                    @else
                                        غیرفعال
                                    @endif</a>
                            </td>
                            <td>
                                <a href="/admin/news/{{$news->id}}/edit" class="btn btn-warning">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                            </td>
                            <td>
                                <form method="post" action="/admin/news/{{$news->id}}" onsubmit="return window.confirm('آیا از حذف خبر اطمینان دارید؟')">
                                    {{csrf_field()}}
                                    {{method_field('DELETE')}}
                                    <button type="submit" class="btn btn-danger">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
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
            $('.table').DataTable({
                dom: 'Bfrltip',
                buttons: [
                    'copy',  'excel'
                ]
            } );
        } );
    </script>
@endsection

