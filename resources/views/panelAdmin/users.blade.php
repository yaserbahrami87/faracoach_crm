@extends('panelAdmin.master.index')
@section('rowcontent')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">اعضا</h4>
            </div>
            <div class="card-body" id="frmSearchUserAdmin">
                <div class="row">
                    <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3" >
                        <label>جستجو اعضا</label>
                        <form method="GET" action="/admin/users/search/">
                            {{csrf_field()}}
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="جستجو..." name="q" lang="fa"/>
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
                    @if(Auth::user()->type==2)
                        <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3" >
                            <label>نمایش براساس کاربر</label>
                            <form method="GET" action="/admin/users/categorybyAdmin/">
                                <div class="input-group mb-3">
                                    <select class="form-control p-0" name="user">
                                        <option disabled="disabled" selected="selected">انتخاب کنید</option>
                                        @foreach($usersAdmin  as $item)
                                            <option value="{{$item->id}}">{{$item->fname}} {{$item->lname}}</option>
                                        @endforeach
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
                    @endif
                    <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3" >
                        <label class="d-block">عضو جدید</label>
                        <a href="/admin/add" class="btn btn-primary m-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                                <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                            </svg>
                            ثبت عضو جدید
                        </a>
                    </div>
                    <div class="col-12">
                        <small class="m-0">انتخاب تگ ها</small>
                        <form method="GET" action="/admin/users/categoryTags/">
                            {{csrf_field()}}
                            @foreach($parentCategory as $item)
                                <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample{{$item->id}}" role="button" aria-expanded="false" aria-controls="collapseExample{{$item->id}}">
                                    {{$item->category}}
                                </a>
                                <div class="collapse" id="collapseExample{{$item->id}}">
                                    <div class="card card-body">
                                        {{csrf_field()}}
                                        <div class="form row">
                                            @foreach($tags as $tag)
                                                @if($tag->category_tags_id==$item->id)
                                                   <div class="col-xs-6 col-md-3 col-lg-3 col-xl-3">
                                                        <label class="form-check-label m-0 pr-0" for="tag{{$tag->id}}">{{$tag->tag}}</label>
                                                        <input class="form-check-input text-dark mr-2" type="checkbox" value="{{$tag->id}}" id="tag{{$tag->id}}" name="tags[]">
                                                   </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <button type="submit" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-funnel-fill" viewBox="0 0 16 16">
                                    <path d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5v-2z"/>
                                </svg>
                            </button>
                        </form>
                    </div>

                    @if(Auth::user()->type==2)
                        <!-- Advance Search -->
                        <!--
                        <div class="col-12">
                            <form method="get" action="/admin/users/search/advance">
                                <div class="row">
                                    <div class="col-sm-12 col-md-3 col-lg-2 col-xl-2" >
                                        <label>انتخاب کاربر</label>
                                        <div class="form-group mb-3">
                                            <select class="form-control p-0" name="user">
                                                <option disabled="disabled" selected="selected">انتخاب کنید</option>
                                                @foreach($usersAdmin  as $item)
                                                    <option value="{{$item->id}}">{{$item->fname}} {{$item->lname}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-2 col-lg-2 col-xl-2" >
                                        <label>نمایش براساس دسته بندی</label>
                                        <div class="form-group mb-3">
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
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-1 col-lg-1 col-xl-1" >
                                        <label>جستجو</label>
                                        <button class="btn btn-primary m-0 d-block" type="submit">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        -->
                    @endif

                    @if(Auth::user()->type==2)
                        <div class="col-12">
                            <label class="text-dark">دسترسی سریع</label>
                            <ul class="list-group list-group-horizontal" id="users_tags">
                                <a href="/admin/users/category/?categoryUsers=0&user={{$user}}" class="list-group-item p-0 border-0 mr-3 p-1 @if(request()->is('admin/users')) bg-info  @endif ">نمایش همه</a>
                                <a href="/admin/users/category/?categoryUsers=todayFollowup&user={{$user}}" class="list-group-item p-0 border-0 mr-3 p-1 @if(request()->is('admin/users/category/?categoryUsers=todayFollowup')) bg-info  @endif">پیگیری روز<span class="text-danger"> {{$todayFollowup}} </span></a>
                                <a href="/admin/users/category/?categoryUsers=notfollowup&user={{$user}}" class="list-group-item p-0 border-0 mr-3 p-1 @if(request()->is('admin/users/category/?categoryUsers=notfollowup')) bg-info  @endif ">پیگیری نشده<span class="text-danger"> {{$notfollowup}} </span></a>
                                <a href="/admin/users/category/?categoryUsers=continuefollowup&user={{$user}}" class="list-group-item p-0 border-0 mr-2 p-1">تور پیگیری<span class="text-danger"> {{$continuefollowup}} </span></a>
                                <a href="/admin/users/category?categoryUsers=waiting&user={{$user}}" class="list-group-item p-0 border-0 mr-3 p-1">در انتظار تصمیم<span class="text-danger"> {{$waiting}} </span></a>
                                <a href="/admin/users/category/?categoryUsers=cancelfollowup&user={{$user}}" class="list-group-item p-0 border-0 mr-3 p-1">انصراف<span class="text-danger"> {{$cancelfollowup}} </span></a>
                                <a href="/admin/users/category/?categoryUsers=students&user={{$user}}" class="list-group-item p-0 border-0 mr-3 p-1">مشتری<span class="text-danger"> {{$students}} </span></a>
                                <a href="/admin/users/category/?categoryUsers=noanswering&user={{$user}}" class="list-group-item p-0 border-0 mr-3 p-1">عدم پاسخ<span class="text-danger"> {{$noanswering}} </span></a>
                                <a href="/admin/users/category/?categoryUsers=myfollowup&user={{$user}}" class="list-group-item  p-0 border-0 mr-3 p-1"> پیگیری های خودم<span class="text-danger"> {{$myfollowup}} </span></a>
                                <a href="/admin/users/category/?categoryUsers=followedToday&user={{$user}}" class="list-group-item  p-0 border-0 mr-3 p-1"> پیگیری شده های امروز<span class="text-danger"> {{$followedToday}} </span></a>
                                <a href="/admin/users/category/?categoryUsers=trashuser&user={{$user}}" class="list-group-item  p-0 border-0 mr-3 p-1">سطل زباله<span class="text-danger"> {{$trashuser}} </span></a>
                            </ul>
                        </div>
                    @else
                        <div class="col-12">
                            <label class="text-dark">دسترسی سریع</label>
                            <ul class="list-group list-group-horizontal" id="users_tags">
                                <a href="/admin/users/category/?categoryUsers=0" class="list-group-item p-0 border-0 mr-3 p-1 @if(request()->is('admin/users')) bg-info  @endif ">نمایش همه</a>
                                <a href="/admin/users/category/?categoryUsers=todayFollowup" class="list-group-item p-0 border-0 mr-3 p-1 @if(request()->is('admin/users/category/?categoryUsers=todayFollowup')) bg-info  @endif">پیگیری روز<span class="text-danger"> {{$todayFollowup}} </span></a>
                                <a href="/admin/users/category/?categoryUsers=notfollowup" class="list-group-item p-0 border-0 mr-3 p-1 @if(request()->is('admin/users/category/?categoryUsers=notfollowup')) bg-info  @endif ">پیگیری نشده<span class="text-danger"> {{$notfollowup}} </span></a>
                                <a href="/admin/users/category/?categoryUsers=continuefollowup" class="list-group-item p-0 border-0 mr-2 p-1">تور پیگیری<span class="text-danger"> {{$continuefollowup}} </span></a>
                                <a href="/admin/users/category?categoryUsers=waiting" class="list-group-item p-0 border-0 mr-3 p-1">در انتظار تصمیم<span class="text-danger"> {{$waiting}} </span></a>
                                <a href="/admin/users/category/?categoryUsers=cancelfollowup" class="list-group-item p-0 border-0 mr-3 p-1">انصراف<span class="text-danger"> {{$cancelfollowup}} </span></a>
                                <a href="/admin/users/category/?categoryUsers=students" class="list-group-item p-0 border-0 mr-3 p-1">مشتری<span class="text-danger"> {{$students}} </span></a>
                                <a href="/admin/users/category/?categoryUsers=noanswering" class="list-group-item p-0 border-0 mr-3 p-1">عدم پاسخ<span class="text-danger"> {{$noanswering}} </span></a>
                                <a href="/admin/users/category/?categoryUsers=myfollowup" class="list-group-item  p-0 border-0 mr-3 p-1"> پیگیری های خودم<span class="text-danger"> {{$myfollowup}} </span></a>
                                <a href="/admin/users/category/?categoryUsers=followedToday" class="list-group-item  p-0 border-0 mr-3 p-1"> پیگیری شده های امروز<span class="text-danger"> {{$followedToday}} </span></a>
                            </ul>
                        </div>
                    @endif


                </div>

                <div class="table-responsive overflow-auto">

                    <table id="usersTable" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>نام</th>
                            <th>نام خانوادگی</th>
                            <th>شماره همراه	</th>
                            <th>تاریخ ثبت	</th>
                            @if(Auth::user()->type==2)
                                <th>مسئول پیگیری</th>
                            @endif
                            <th>تعداد پیگیری</th>
                            <th>آخرین محصول پیگیری شده</th>
                            <th>آخرین پیگیری</th>
                            <th>کیفیت</th>
                            <th>وضعیت</th>
                            <th>اخرین ورود</th>
                            @if(Auth::user()->type==2)
                                <th>حذف</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $item)
                            <tr style="background-color: {{$item->quality_color}}">
                                <td>
                                    <a href="/admin/user/{{$item->id}}" class="text-dark">
                                        {{$item->fname}}
                                    </a>
                                </td>
                                <td>
                                    <a href="/admin/user/{{$item->id}}" class="text-dark">
                                        {{$item->lname}}
                                    </a>
                                </td>
                                <td>
                                    <a href="/admin/user/{{$item->id}}" class="text-dark">
                                        {{$item->tel}}
                                    </a>
                                </td>

                                <td>
                                    <a href="/admin/user/{{$item->id}}" class="text-dark">
                                        {{$item->created_at}}
                                    </a>
                                </td>
                                @if(Auth::user()->type==2)
                                    <td>
                                        {{$item->followby_expert}}
                                    </td>
                                @endif
                                <td>
                                    {{$item->countFollowup}}
                                </td>
                                <td>
                                    {{$item->lastFollowupCourse}}
                                </td>
                                <td>
                                    <a href="/admin/user/{{$item->id}}" class="text-dark">
                                        {{$item->lastDateFollowup}}
                                    </a>
                                </td>
                                <td>
                                    {{$item->quality}}
                                </td>
                                <td>
                                    <a href="/admin/user/{{$item->id}}" class="text-dark">
                                        {{$item->type}}
                                    </a>
                                </td>
                                <td>
                                    <a href="/admin/user/{{$item->id}}" class="text-dark">
                                        {{$item->last_login_at}}
                                    </a>
                                </td>
                                @if(Auth::user()->type==2)
                                    <td>
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
                            <th>نام</th>
                            <th>نام خانوادگی</th>
                            <th>شماره همراه	</th>
                            <th>تاریخ ثبت	</th>
                            @if(Auth::user()->type==2)
                                <th>مسئول پیگیری</th>
                            @endif
                            <th>تعداد پیگیری</th>
                            <th>آخرین محصول پیگیری شده</th>
                            <th>آخرین پیگیری</th>
                            <th>کیفیت</th>
                            <th>وضعیت</th>
                            <th>اخرین ورود</th>
                            @if(Auth::user()->type==2)
                                <th>حذف</th>
                            @endif
                        </tr>
                        </tfoot>
                    </table>
                    {{$users->links()}}
                </div>
            </div>

        </div>
    </div>
@endsection

