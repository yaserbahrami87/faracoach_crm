@extends('admin.master.index')

@section('headerScript')
    <link href="{{asset('/dashboard/assets/css/buttons.dataTables.min.css')}}" rel="stylesheet" />
    <link href="{{asset('/dashboard/assets/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />


@endsection


@section('content')
    <div class="col-12">
            <div id="app" style="width: 310px">
                <form method="GET" action="/admin/introduced">
                    <div class="form-group">
                        <label for="start_date">بازه نمایش را وارد کنید</label>
                        <date-picker
                            type="date"
                            v-model="dates"
                            range
                            format="jYYYY-jMM-jDD"
                            display-format="jYYYY/jMM/jDD"
                            name="start_date"
                            id="start_date"
                        ></date-picker>
                        <button type="submit" class="btn btn-success btn-sm" name="range">نمایش بده</button>
                    </div>
                </form>
            </div>


        <ul class="nav nav-tabs col-md-12 mt-3" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active btn-warning" id="pending-tab" data-toggle="tab" data-target="#pending" type="button" role="tab" aria-controls="pending" aria-selected="true">درانتظار تایید</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link btn-success" id="accept-tab" data-toggle="tab" data-target="#accept" type="button" role="tab" aria-controls="accept" aria-selected="false">تایید شده</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link btn-danger" id="reject-tab" data-toggle="tab" data-target="#reject" type="button" role="tab" aria-controls="reject" aria-selected="false">رد شده</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="pending-tab">

                <div class="col-12 table-responsive">
                    <table class="table table-striped" id="pending_search">
                        <thead>
                        <tr class="text-center">
                            <th>ردیف</th>
                            <th>نام و نام خانوادگی</th>
                            <th>تعداد دعوت</th>
                            <th>تعداد مشتری</th>
                            <th>مبلغ خرید</th>
                            <th>آخرین دعوت شده</th>
                            <th>دوره</th>
                            <th>امتیاز</th>
                            <th>تغییر وضعیت</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users->where('introduced_verified','1') as $user)
                            <tr class="text-center">
                                <td>{{$loop->iteration}}</td>
                                <td >
                                    <a href="/admin/user/{{$user->id}}">{{$user->fname.' '.$user->lname}}</a>
                                </td>

                                <td>

                                        <b>{{$user->get_invitations->count()}} </b>
                                </td>
                                <td>{{$user->get_invitations->where('type',20)->count()}}</td>
                                <td></td>
                                <td>
                                    @if(!is_null($user->get_invitations->last()))
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
{{--                                    {{ceil(\App\Services\ScoreService::score($user)['Score_final'])}}--}}
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

            </div>
            <div class="tab-pane fade" id="accept" role="tabpanel" aria-labelledby="accept-tab">

                <div class="col-12 table-responsive">
                    <table class="table table-striped" id="accept_search">
                        <thead>
                        <tr class="text-center">
                            <th>ردیف</th>
                            <th>نام و نام خانوادگی</th>
                            <th>تعداد دعوت</th>
                            <th>تعداد مشتری</th>
                            <th>مبلغ خرید</th>
                            <th>آخرین دعوت شده</th>
                            <th>دوره</th>
                            <th>امتیاز</th>
                            <th>تغییر وضعیت</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users->where('introduced_verified','2') as $user)
                            <tr class="text-center">
                                <td>{{$loop->iteration}}</td>
                                <td >
                                    <a href="/admin/user/{{$user->id}}">{{$user->fname.' '.$user->lname}}</a>
                                </td>

                                <td>
                                        <b>{{$user->get_invitations->count()}} </b>
                                    <!-- Modal invitation -->

                                </td>
                                <td>{{$user->get_invitations->where('type',20)->count()}}</td>
                                <td></td>
                                <td>
                                    @if(!is_null($user->get_invitations->last()))
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
{{--                                    {{ceil(\App\Services\ScoreService::score($user)['Score_final'])}}--}}
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

            </div>
            <div class="tab-pane fade" id="reject" role="tabpanel" aria-labelledby="reject-tab">

                <div class="col-12 table-responsive">
                    <table class="table table-striped" id="reject_search">
                        <thead>
                        <tr class="text-center">
                            <th>ردیف</th>
                            <th>نام و نام خانوادگی</th>
                            <th>تعداد دعوت</th>
                            <th>تعداد مشتری</th>
                            <th>مبلغ خرید</th>
                            <th>آخرین دعوت شده</th>
                            <th>دوره</th>
                            <th>امتیاز</th>
                            <th>تغییر وضعیت</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users->where('introduced_verified','3') as $user)
                            <tr class="text-center">
                                <td>{{$loop->iteration}}</td>
                                <td >
                                    <a href="/admin/user/{{$user->id}}">{{$user->fname.' '.$user->lname}}</a>
                                </td>
                                <td>
                                    <b>{{$user->get_invitations->count()}}</b>
                                    <!-- Modal invitation -->
                                </td>
                                <td>{{$user->get_invitations->where('type',20)->count()}}</td>
                                <td>
                                </td>
                                <td>
                                    @if(!is_null($user->get_invitations->last()))
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
{{--                                        <div class="modal fade" id="courseModal{{$user->id}}" tabindex="-1" aria-labelledby="courseModalModalLabel" aria-hidden="true">--}}
{{--                                            <div class="modal-dialog">--}}
{{--                                                <div class="modal-content">--}}
{{--                                                    <div class="modal-header">--}}
{{--                                                        <h5 class="modal-title" id="exampleModalLabel">دوره ها</h5>--}}
{{--                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                                                            <span aria-hidden="true">&times;</span>--}}
{{--                                                        </button>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="modal-body">--}}
{{--                                                        <table class="table table-bordered table-striped table-striped">--}}
{{--                                                            <tr>--}}
{{--                                                                <th>ردیف</th>--}}
{{--                                                                <th>دوره</th>--}}

{{--                                                            </tr>--}}

{{--                                                            @foreach($user->students as $student)--}}
{{--                                                                <tr>--}}
{{--                                                                    <td>{{$loop->iteration}}</td>--}}
{{--                                                                    <td>--}}
{{--                                                                        {{$student->course->course}}--}}
{{--                                                                    </td>--}}

{{--                                                                </tr>--}}
{{--                                                            @endforeach--}}
{{--                                                        </table>--}}

{{--                                                    </div>--}}
{{--                                                    <div class="modal-footer">--}}
{{--                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                    @endif
                                </td>
                                <td>
{{--                                    {{ceil(\App\Services\ScoreService::score($user)['Score_final'])}}--}}
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

            </div>
        </div>
    </div>







@endsection


@section('footerScript')

    <script src="{{asset('/js/vue@2.js')}}"></script>
    <script src="{{asset('/js/moment.js')}}"></script>
    <script src="{{asset('/js/moment-jalaali.js')}}"></script>
    <script src="{{asset('/js/vue-persian-datetime-picker-browser.js')}}"></script>
    <script>
        var app = new Vue({
            el: '#app',
            components: {
                DatePicker: VuePersianDatetimePicker
            },
            data: {
                dates: [],
            }

        });


    </script>


    <script src="{{asset('/dashboard/assets/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('/dashboard/assets/js/dataTables.bootstrap4.min.js')}}"></script>

    <script src="{{asset('/panel_assets/js/scripts/datatables/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('/panel_assets/js/scripts/datatables/jszip.min.js')}}"></script>
    <script src="{{asset('/panel_assets/js/scripts/datatables/vfs_fonts.js')}}"></script>
    <script src="{{asset('/panel_assets/js/scripts/datatables/buttons.html5.min.js')}}"></script>
    <script src="{{asset('/panel_assets/js/scripts/datatables/buttons.print.min.js')}}"></script>

    <script>
        $(document).ready(function() {
            $('#pending_search').DataTable({
                dom: 'Bfrltip',
                buttons: [
                    'copy',  'excel'
                ]
            } );
        } );
        $(document).ready(function() {
            $('#accept_search').DataTable({
                dom: 'Bfrltip',
                buttons: [
                    'copy',  'excel'
                ]
            } );
        } );
        $(document).ready(function() {
            $('#reject_search').DataTable({
                dom: 'Bfrltip',
                buttons: [
                    'copy',  'excel'
                ]
            } );
        } );
    </script>

@endsection
