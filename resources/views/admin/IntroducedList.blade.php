@extends('admin.master.index')

@section('headerScript')
    <link href="{{asset('/dashboard/assets/css/buttons.dataTables.min.css')}}" rel="stylesheet" />
    <link href="{{asset('/dashboard/assets/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="/dashboard/plugins/JalaliDatePicker-main/dist/jalalidatepicker.min.css">


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
                <button class="nav-link btn-success" id="Honorary_Ambassador-tab" data-toggle="tab" data-target="#Honorary_Ambassador" type="button" role="tab" aria-controls="Honorary_Ambassador" aria-selected="false">سفیران افتخاری تایید شده</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link btn-success" id="official_ambassador-tab" data-toggle="tab" data-target="#official_ambassador" type="button" role="tab" aria-controls="official_ambassador" aria-selected="false">سفیران رسمی تایید شده</button>
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
                            <th>تاریخ اعتبار</th>
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
                                    @if(!is_null($user->score))
                                        {{($user->score->score_introduced+$user->score->score_purchase+$user->score->score_re_entry)}}
                                    @endif

                                </td>

                                <form method="post" action="/admin/introduced/{{$user->id}}">
                                    {{csrf_field()}}
                                    {{method_field('PATCH')}}
                                    <td style="padding-left: 10px">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <input type="text" data-jdp name="Validity_date"  value="{{$user->Validity_date}}">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group">

                                            <select class="custom-select" id="Introduced_verified" name="introduced_verified"  style="padding-left: 1.8rem">
                                                <option selected>انتخاب کنید</option>
                                                <option value="1" @if($user->introduced_verified==1)  selected @endif  style="background-color: yellow ;color: #FFFFFF">در انتظار تایید</option>
                                                <option value="2" @if($user->introduced_verified==2) selected @endif  style="background-color: green ;color: #FFFFFF">سفیر افتخاری </option>
                                                <option value="4" @if($user->introduced_verified==4) selected @endif style="background-color: green  ;color: #FFFFFF">سفیر رسمی </option>
                                                <option value="3" @if($user->introduced_verified==3) selected @endif style="background-color: red ;color: #FFFFFF" >رد شد</option>
                                            </select>
                                            <div class="input-group-prepend">
                                                <button class="btn btn-outline-secondary" type="submit">اعمال</button>
                                            </div>
                                        </div>
                                    </td>
                                </form>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>

            </div>
            <div class="tab-pane fade" id="Honorary_Ambassador" role="tabpanel" aria-labelledby="Honorary_Ambassador-tab">

                <div class="col-12 table-responsive">
                    <table class="table table-striped" id="Honorary_Ambassador_search">
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
                            <th>تاریخ اعتبار</th>
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
                                    @if(!is_null($user->score))
                                        {{($user->score->score_introduced+$user->score->score_purchase+$user->score->score_re_entry)}}
                                    @endif

                                </td>


                                <form method="post" action="/admin/introduced/{{$user->id}}">
                                    {{csrf_field()}}
                                    {{method_field('PATCH')}}
                                    <td style="padding-left: 10px">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <input type="text"  data-jdp name="Validity_date" value="{{$user->Validity_date}}">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group">

                                            <select class="custom-select" id="Introduced_verified" name="introduced_verified" >
                                                <option selected>انتخاب کنید</option>
                                                <option value="1" @if($user->introduced_verified==1)  selected @endif  style="background-color: yellow ;color: #FFFFFF">در انتظار تایید</option>
                                                <option value="2" @if($user->introduced_verified==2) selected @endif  style="background-color: green ;color: #FFFFFF">سفیر افتخاری </option>
                                                <option value="4" @if($user->introduced_verified==4) selected @endif style="background-color: green  ;color: #FFFFFF">سفیر رسمی </option>
                                                <option value="3" @if($user->introduced_verified==3) selected @endif style="background-color: red ;color: #FFFFFF" >رد شد</option>
                                            </select>
                                            <div class="input-group-prepend">
                                                <button class="btn btn-outline-secondary" type="submit">اعمال</button>
                                            </div>
                                        </div>
                                    </td>
                                </form>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>

            </div>
            <div class="tab-pane fade" id="official_ambassador" role="tabpanel" aria-labelledby="official_ambassador-tab">

                <div class="col-12 table-responsive">
                    <table class="table table-striped" id="official_ambassador_search">
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
                            <th>تاریخ اعتبار</th>
                            <th>تغییر وضعیت</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users->where('introduced_verified','4') as $user)

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
                                    @if(!is_null($user->score))
                                        {{($user->score->score_introduced+$user->score->score_purchase+$user->score->score_re_entry)}}
                                    @endif

                                </td>


                                <form method="post" action="/admin/introduced/{{$user->id}}">
                                    {{csrf_field()}}
                                    {{method_field('PATCH')}}
                                    <td style="padding-left: 10px">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <input type="text" data-jdp name="Validity_date" value="{{$user->Validity_date}}">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group">

                                            <select class="custom-select" id="Introduced_verified" name="introduced_verified" >
                                                <option selected>انتخاب کنید</option>
                                                <option value="1" @if($user->introduced_verified==1)  selected @endif  style="background-color: yellow ;color: #FFFFFF">در انتظار تایید</option>
                                                <option value="2" @if($user->introduced_verified==2) selected @endif  style="background-color: green ;color: #FFFFFF">سفیر افتخاری </option>
                                                <option value="4" @if($user->introduced_verified==4) selected @endif style="background-color: green  ;color: #FFFFFF">سفیر رسمی </option>
                                                <option value="3" @if($user->introduced_verified==3) selected @endif style="background-color: red ;color: #FFFFFF" >رد شد</option>
                                            </select>
                                            <div class="input-group-prepend">
                                                <button class="btn btn-outline-secondary" type="submit">اعمال</button>
                                            </div>
                                        </div>
                                    </td>
                                </form>
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
                            <th>تاریخ اعتبار</th>
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
                                    @if(!is_null($user->score))
                                        {{($user->score->score_introduced+$user->score->score_purchase+$user->score->score_re_entry)}}
                                    @endif
                                </td>


                                <form method="post" action="/admin/introduced/{{$user->id}}">
                                    {{csrf_field()}}
                                    {{method_field('PATCH')}}

                                    <td style="padding-left: 10px">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <input type="text" data-jdp name="Validity_date" value="{{$user->Validity_date}}">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group">

                                            <select class="custom-select" id="Introduced_verified" name="introduced_verified" >
                                                <option selected>انتخاب کنید</option>
                                                <option value="1" @if($user->introduced_verified==1)  selected @endif  style="background-color: yellow ;color: #FFFFFF">در انتظار تایید</option>
                                                <option value="2" @if($user->introduced_verified==2) selected @endif  style="background-color: green ;color: #FFFFFF">سفیر افتخاری </option>
                                                <option value="4" @if($user->introduced_verified==4) selected @endif style="background-color: green  ;color: #FFFFFF">سفیر رسمی </option>
                                                <option value="3" @if($user->introduced_verified==3) selected @endif style="background-color: red ;color: #FFFFFF" >رد شد</option>
                                            </select>
                                            <div class="input-group-prepend">
                                                <button class="btn btn-outline-secondary" type="submit">اعمال</button>
                                            </div>
                                        </div>
                                    </td>
                                </form>
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

    <script type="text/javascript" src="/dashboard/plugins/JalaliDatePicker-main/dist/jalalidatepicker.js"></script>

    <script>
        jalaliDatepicker.startWatch({
          minDate: "attr",
          maxDate: "attr"
        });
{{--        /* Below is a js demo | you don't need to use */--}}
{{--        setTimeout(function(){--}}
{{--          var elm=document.getElementsByTagName("input")[0];--}}
{{--          elm.focus();--}}
{{--          jalaliDatepicker.hide();--}}
{{--          jalaliDatepicker.show(elm);--}}
{{--        }, 1000);--}}
    </script>




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
            $('#Honorary_Ambassador_search').DataTable({
                dom: 'Bfrltip',
                buttons: [
                    'copy',  'excel'
                ]
            } );
        } );
         $(document).ready(function() {
            $('#official_ambassador_search').DataTable({
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
