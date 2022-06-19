@extends('admin.master.index')

@section('headerScript')
<link href="{{asset('/dashboard/assets/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
    <style>
        .img_profile
        {
            animation: images_effect 2s infinite;
            animation-direction: alternate;

        }

        @keyframes images_effect {
            from{
                border:5px solid red;
                transition: 1s;
            }

            to{
                border:0px solid red;
            }
        }

        #users_tags a
        {
            font-size: 12px;
        }

        #example
        {
            font-size:12px;
        }
    </style>
@endsection

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-info border-info">
                <h4 class="card-title m-0">اعضا</h4>
            </div>
            <div class="card-body" id="frmSearchUserAdmin">
                <div class="row">
                    <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3" >
                        <small>جستجو اعضا</small>
                        <form method="GET" action="/admin/users/search/">
                            {{csrf_field()}}
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="جستجو..." name="q" lang="fa"/>
                                <div class="input-group-prepend">
                                    <button class="btn btn-outline-secondary text-light" type="submit">
                                        <i class="bi bi-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-12 col-md-2 col-lg-2 col-xl-2" >
                        <small class="d-block">عضو جدید</small>
                        <a href="/admin/add" class="btn btn-primary m-0">
                            <i class="bi bi-person-plus-fill"></i>
                            ثبت عضو جدید
                        </a>
                    </div>
                </div>

                <div class="table-responsive overflow-auto">

                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th></th>
                            <th>نام</th>
                            <th>نام خانوادگی</th>
                            <th>شماره همراه</th>
                            <th>ثبت کننده</th>
                            <th>معرف</th>
                            <th> ورود</th>
                            <th>مسئول پیگیری</th>
                            <th>تعداد پیگیری</th>
                            <th>آخرین محصول پیگیری شده</th>
                            <th>آخرین پیگیری</th>
                            <th> پیگیری بعد</th>
                            <th>وضعیت</th>
                            <th>اخرین ورود</th>

                            @if(Auth::user()->type==2)
                                <th>حذف</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $item)
                            <tr style="background-color: {{$item->quality_color}}" >
                                <td class="p-0">
                                    <a href="/admin/user/{{$item->id}}">
                                        <img src="{{asset('/documents/users/'.$item->personal_image)}}" class="rounded-circle "  width="50px" height="50px" />
                                    </a>
                                </td>
                                <td class="p-0">
                                    <a href="/admin/user/{{$item->id}}" class="text-dark d-block">
                                        {{$item->fname}}
                                    </a>
                                </td>
                                <td class="p-0">
                                    <a href="/admin/user/{{$item->id}}" class="text-dark d-block">
                                        {{$item->lname}}
                                    </a>
                                </td>
                                <td class="p-0">
                                    <a href="/admin/user/{{$item->id}}" class="text-dark d-block">
                                        {{$item->tel}}
                                    </a>
                                </td>
                                <td class="p-0">{{$item['insert_user']}}</td>
                                <td class="p-0">{{$item->introduced}}</td>


                                <td class="p-0">
                                    <a href="/admin/user/{{$item->id}}" class="text-dark d-block">
                                        {{$item->resource}}
                                    </a>
                                </td>
                                <td class="p-0">
                                    {{$item->followby_expert}}
                                </td>
                                <td class="p-0">
                                    {{$item->countFollowup}}
                                </td>
                                <td class="p-0">
                                    {{$item['lastFollowupCourse']}}
                                </td>
                                <td class="p-0">{{$item->lastDateFollowup}}</td>
                                <td class="p-0">
                                    <a href="/admin/user/{{$item->id}}" class="text-dark d-block">

                                        {{$item->nextfollowup_date_fa}}
                                    </a>
                                </td>
                                <td class="p-0">
                                    <a href="/admin/user/{{$item->id}}" class="text-dark d-block">
                                        {{$item->status_followups}}
                                    </a>
                                </td>
                                <td class="p-0">
                                    <a href="/admin/user/{{$item->id}}" class="text-dark d-block">
                                        {{$item->last_login_at}}
                                    </a>
                                </td>

                                @if(Auth::user()->type==2)

                                    <td class="p-0">
                                        <a href="/admin/user/{{$item->id}}/delete" class="text-dark del">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                            </svg>
                                        </a>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th class="p-0"></th>
                            <th class="p-0">نام</th>
                            <th class="p-0">نام خانوادگی</th>
                            <th class="p-0">شماره همراه	</th>
                            <th class="p-0">ثبت کننده</th>
                            <th class="p-0">معرف</th>
                            <th class="p-0"> آشنایی</th>
                            <th class="p-0">ورود</th>
                            <th class="p-0">مسئول پیگیری</th>
                            <th class="p-0">تعداد پیگیری</th>
                            <th class="p-0">آخرین محصول پیگیری شده</th>
                            <th class="p-0">آخرین پیگیری</th>
                            <th class="p-0">وضعیت</th>
                            <th class="p-0">اخرین ورود</th>

                            @if(Auth::user()->type==2)
                                <th>حذف</th>
                            @endif
                        </tr>
                        </tfoot>
                    </table>

                </div>
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

