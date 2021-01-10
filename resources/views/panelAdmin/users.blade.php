@extends('panelAdmin.master.index')
@section('rowcontent')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">اعضا</h4>
            </div>
            <div class="card-body" id="frmSearchUserAdmin">
                <div class="row">
                    <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4" >
                        <label>جستجو اعضا</label>
                        <form method="GET" action="/admin/users/search/">
                            {{csrf_field()}}
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="جستجو..." name="q"/>
                                <div class="input-group-prepend">
                                    <button class="btn btn-outline-secondary text-light bg-secondary" type="submit">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
                                            <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4" >
                        <label>نمایش براساس دسته بندی</label>
                        <form method="GET" action="/admin/users/category/">
                            <div class="input-group mb-3">
                                <select class="form-control p-0" name="categoryUsers">
                                    <option disabled="disabled" selected="selected">انتخاب کنید</option>
                                    <option value="0">نمایش همه</option>
                                    <option value="notfollowup">پیگیری نشده</option>
                                    <option value="continuefollowup">در حال مذاکره</option>
                                    <option value="waiting">در انتظار تصمیم</option>
                                    <option value="cancelfollowup">انصراف</option>
                                    <option value="noanswering">عدم پاسخگویی</option>
                                    <option value="students">رضایت کامل / مشتری</option>
                                    <option value="todayFollowup">پیگیری امروز</option>
                                    <option value="expireFollowup">پیگیری تاریخ گذشته</option>
                                </select>
                                <div class="input-group-prepend">
                                    <button class="btn btn-outline-secondary text-light bg-secondary" type="submit">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-binoculars-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M4.5 1A1.5 1.5 0 0 0 3 2.5V3h4v-.5A1.5 1.5 0 0 0 5.5 1h-1zM7 4v1h2V4h4v.882a.5.5 0 0 0 .276.447l.895.447A1.5 1.5 0 0 1 15 7.118V13H9v-1.5a.5.5 0 0 1 .146-.354l.854-.853V9.5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v.793l.854.853A.5.5 0 0 1 7 11.5V13H1V7.118a1.5 1.5 0 0 1 .83-1.342l.894-.447A.5.5 0 0 0 3 4.882V4h4zM1 14v.5A1.5 1.5 0 0 0 2.5 16h3A1.5 1.5 0 0 0 7 14.5V14H1zm8 0v.5a1.5 1.5 0 0 0 1.5 1.5h3a1.5 1.5 0 0 0 1.5-1.5V14H9zm4-11H9v-.5A1.5 1.5 0 0 1 10.5 1h1A1.5 1.5 0 0 1 13 2.5V3z"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4" >
                        <label class="d-block">عضو جدید</label>
                        <a href="/admin/add" class="btn btn-primary m-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                                <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                            </svg>
                        </a>
                    </div>
                    <div class="col-12">
                        <p>
                            <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                فیلترها
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-funnel-fill" viewBox="0 0 16 16">
                                    <path d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5v-2z"/>
                                </svg>
                            </a>
                        </p>
                        <div class="collapse" id="collapseExample">
                            <div class="card card-body">
                                <form method="GET" action="/admin/users/categoryTags/">
                                    {{csrf_field()}}
                                    <ul class="list-group list-group-horizontal-sm">
                                        @foreach($tags as $item)
                                            <div class="form-check-inline">
                                                <label class="form-check-label pr-0" for="tag{{$item->id}}">{{$item->tag}}</label>
                                                <input class="form-check-input text-dark mr-2" type="checkbox" value="{{$item->id}}" id="tag{{$item->id}}" name="tags[]">
                                            </div>
                                        @endforeach
                                    </ul>
                                    <input type="submit" class="btn btn-primary" value="اعمال فیلتر" >
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <label>دسترسی سریع</label>
                        <ul class="list-group list-group-horizontal">
                            <a href="/admin/users/category/?categoryUsers=0" class="list-group-item">نمایش همه</a>
                            <a href="/admin/users/category/?categoryUsers=notfollowup" class="list-group-item">پیگیری نشده</a>
                            <a href="/admin/users/category/?categoryUsers=myfollowup" class="list-group-item">پیگیری های خودم</a>
                        </ul>
                    </div>
                </div>




                <div class="table-responsive overflow-auto">

                    <table class="table">
                        <thead class=" text-dark">
                        <th>نام </th>
                        <th>نام خانوادگی </th>
                        <th>شماره همراه</th>
                        <th>پست الکترونیکی </th>
                        <th>تاریخ ورود</th>
                        <th>وضعیت</th>
                        </thead>
                        <tbody>
                            @foreach($users as $item)
                                @if($item->type==1)
                                    <tr class="warning_bg_admin">
                                @elseif($item->type==11)
                                    <tr class="primary_bg_admin">
                                @elseif($item->type==12)
                                    <tr class="danger_bg_admin">
                                @elseif($item->type==13)
                                    <tr class="bg-info text-light">
                                @elseif($item->type==14)
                                    <tr class="bg-secondary text-light">
                                @elseif($item->type==20)
                                    <tr class="success_bg_admin">
                                @endif
                                        <td>
                                            <a href="/admin/user/{{$item->id}}">
                                                {{$item->fname}}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="/admin/user/{{$item->id}}">
                                                {{$item->lname}}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="/admin/user/{{$item->id}}">
                                                 {{$item->tel}}
                                            </a>
                                        </td>
                                        <td >
                                            <a href="/admin/user/{{$item->id}}">
                                                 {{$item->email}}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="/admin/user/{{$item->id}}">
                                                {{$item->created_at}}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="/admin/user/{{$item->id}}">
                                            @switch($item->type)
                                                @case(1)
                                                    <p>بررسی نشده</p>
                                                    @break
                                                @case(11)
                                                    <p>در حال مذاکره</p>
                                                    @break
                                                @case(12)
                                                    <p>انصراف</p>
                                                    @break
                                                @case(13)
                                                    <p>در انتظار تصمیم</p>
                                                    @break
                                                @case(20)
                                                    <p>رضایت کامل/مشتری</p>
                                                    @break
                                                @default
                                                    <p>خطا</p>
                                                    @break

                                            @endswitch
                                            </a>
                                        </td>

                                    </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
            {{$users->links()}}
        </div>
    </div>
@endsection

