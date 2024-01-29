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

                <th>نام و نام خانوادگی</th>
                <th>تلفن</th>
                <th>وضعیت</th>
                <th>تغییر وضعیت</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr class="text-center">

                    <td >
                        <a href="/admin/user/{{$user->id}}">{{$user->fname.' '.$user->lname}}</a>

                    </td>
                    <td>{{$user->tel}}</td>
                    <td>
                        @if($user->introduced_verified==1)
                            در انتظار تایید
                        @elseif($user->introduced_verified==2)
                            تایید شده
                        @endif
                    </td>



                    <td>
                        <form method="post" action="/admin/introduced/{{$user->id}}">
                            {{csrf_field()}}
                            {{method_field('PATCH')}}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button class="btn btn-outline-secondary" type="submit">اعمال</button>
                                </div>
                                <select class="custom-select" id="Introduced_verified" name="introduced_verified">
                                    <option selected>انتخاب کنید</option>
                                    <option value="1" @if($user->introduced_verified==1) selected @endif >در انتظار تایید</option>
                                    <option value="2" @if($user->introduced_verified==2) selected @endif >تایید شده</option>
                                </select>
                            </div>
                        </form>

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
