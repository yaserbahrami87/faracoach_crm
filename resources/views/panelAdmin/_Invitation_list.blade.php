@extends('panelAdmin.master.index')

@section('headerScript')
    <link href="{{asset('/dashboard/assets/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
@endsection

@section('rowcontent')
    <div class="container">
        <div class="row">
            <div class="table-responsive overflow-auto bg-light">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                    <tr>
                        <th></th>
                        <th>نام</th>
                        <th>نام خانوادگی</th>
                        <th>شماره همراه</th>
                        <th>دانشجو دوره</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $item)

                        <tr style="background-color: {{$item->quality_color}}">
                            <td>
                                <a href="/admin/user/{{$item->id}}">
                                    <img src="{{asset('/documents/users/'.$item->personal_image)}}" class="img-circle"  width="50px" height="50px"/>
                                </a>
                            </td>
                            <td>
                                <a href="/admin/user/{{$item->id}}" class="text-dark d-block">
                                    {{$item->fname}}
                                </a>
                            </td>
                            <td>
                                <a href="/admin/user/{{$item->id}}" class="text-dark d-block">
                                    {{$item->lname}}
                                </a>
                            </td>
                            <td>
                                <a href="/admin/user/{{$item->id}}" class="text-dark d-block">
                                    {{$item->tel}}
                                </a>
                            </td>
                            <td>
                                {{$item->course}}
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th></th>
                        <th>نام</th>
                        <th>نام خانوادگی</th>
                        <th>شماره همراه	</th>
                        <th>دانشجو دوره</th>
                    </tr>
                    </tfoot>
                </table>

            </div>

        </div>
    </div>
@endsection

@section('footerScript')
    <script src="{{asset('/dashboard/assets/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('/dashboard/assets/js/dataTables.bootstrap4.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        } );
    </script>
@endsection
