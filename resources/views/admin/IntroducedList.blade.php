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
                <th>ردیف</th>
                <th>نام و نام خانوادگی</th>

                <th>تعداد دعوت</th>
                <th>آخرین دعوت شده</th>
                <th>دوره</th>

                <th>تغییر وضعیت</th>
            </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr class="text-center">
                        <td>{{$loop->iteration}}</td>
                        <td >
                            <a href="/admin/user/{{$user->id}}">{{$user->fname.' '.$user->lname}}</a>

                        </td>

                        <td>
                            <a href="#" data-toggle="modal" data-target="#invitationModal{{$user->id}}">
                                <b> {{$user->get_invitations->count()}} نفر</b>
                            </a>
                            <!-- Modal invitation -->
                            <div class="modal fade" id="invitationModal{{$user->id}}" tabindex="-1" aria-labelledby="invitationModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">دعوت شده ها</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body table-responsive">
                                            <table class="table table-bordered table-striped table-striped">
                                                <tr>
                                                    <th>ردیف</th>
                                                    <th>عکس</th>
                                                    <th>نام و نام خانوادگی</th>
                                                    <th>وضعیت</th>
                                                    <th>تاریخ عضویت</th>
                                                </tr>

                                                @foreach($user->get_invitations as $item)
                                                    <tr>
                                                        <td>{{$loop->iteration}}</td>
                                                        <td>
                                                            <img src="{{asset('/documents/users/'.$item->personal_image)}}" width="50px" height="50px" class="rounded-circle" />
                                                        </td>
                                                        <td>
                                                            <a href="/admin/user/{{$item->id}}" target="_blank">
                                                                {{$item->fname.' '.$item->lname}}
                                                            </a>
                                                        </td>
                                                        <td>
                                                            {{$item->userType()}}
                                                        </td>
                                                        <td>{{$item->created_at}}</td>
                                                    </tr>
                                                @endforeach
                                            </table>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            @if(!is_null($user->get_invitations))
                                {{substr($user->get_invitations->last()->changeTimestampToShamsi($user->get_invitations->last()->created_at),7)}}
                            @endif
                        </td>


                        <td>
                            @if($user->students()->count()==0)
                                کاربر عادی
                            @else
                                <a href="#" data-toggle="modal" data-target="#courseModal{{$user->id}}">
                                    <i class="bi bi-eye-fill"></i>

                                </a>
                                <!-- Modal invitation -->
                                    <div class="modal fade" id="courseModal{{$user->id}}" tabindex="-1" aria-labelledby="courseModalModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">دوره ها</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <table class="table table-bordered table-striped table-striped">
                                                        <tr>
                                                            <th>ردیف</th>
                                                            <th>دوره</th>

                                                        </tr>

                                                        @foreach($user->students as $student)
                                                            <tr>
                                                                <td>{{$loop->iteration}}</td>
                                                                <td>
                                                                    {{$student->course->course}}
                                                                </td>

                                                            </tr>
                                                        @endforeach
                                                    </table>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                                    <select class="custom-select @if($user->introduced_verified==1) bg-warning @elseif($user->introduced_verified==2) bg-success @elseif($user->introduced_verified==3) bg-danger @endif " id="Introduced_verified" name="introduced_verified">
                                        <option selected>انتخاب کنید</option>
                                        <option value="1" @if($user->introduced_verified==1)  selected @endif >در انتظار تایید</option>
                                        <option value="2" @if($user->introduced_verified==2) selected @endif >تایید شده</option>
                                        <option value="3" @if($user->introduced_verified==3) selected @endif >رد شد</option>
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
