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

                        <form method="GET" action="/admin/users/search/">
                            {{csrf_field()}}
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="جستجو..." name="q"/>
                                <div class="input-group-prepend">
                                    <button class="btn btn-outline-secondary" type="submit">
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
                        <form method="GET" action="/admin/users/category/">
                            <div class="input-group mb-3">
                                <select class="form-control" name="categoryUsers">
                                    <option disabled="disabled" selected="selected">انتخاب کنید</option>
                                    <option value="0">نمایش همه</option>
                                    <option value="notfollowup">پیگیری نشده</option>
                                    <option value="continuefollowup">در حال پیگیری</option>
                                    <option value="cancelfollowup">انصراف</option>
                                    <option value="students">دانشجو</option>
                                    <option value="todayFollowup">پیگیری امروز</option>
                                    <option value="expireFollowup">پیگیری تاریخ گذشته</option>
                                </select>
                                <div class="input-group-prepend">
                                    <button class="btn btn-outline-secondary" type="submit">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-binoculars-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M4.5 1A1.5 1.5 0 0 0 3 2.5V3h4v-.5A1.5 1.5 0 0 0 5.5 1h-1zM7 4v1h2V4h4v.882a.5.5 0 0 0 .276.447l.895.447A1.5 1.5 0 0 1 15 7.118V13H9v-1.5a.5.5 0 0 1 .146-.354l.854-.853V9.5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v.793l.854.853A.5.5 0 0 1 7 11.5V13H1V7.118a1.5 1.5 0 0 1 .83-1.342l.894-.447A.5.5 0 0 0 3 4.882V4h4zM1 14v.5A1.5 1.5 0 0 0 2.5 16h3A1.5 1.5 0 0 0 7 14.5V14H1zm8 0v.5a1.5 1.5 0 0 0 1.5 1.5h3a1.5 1.5 0 0 0 1.5-1.5V14H9zm4-11H9v-.5A1.5 1.5 0 0 1 10.5 1h1A1.5 1.5 0 0 1 13 2.5V3z"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>




                <div class="table-responsive">

                    <table class="table">
                        <thead class=" text-dark">
                        <th>نام </th>
                        <th>نام خانوادگی </th>
                        <th>کد ملی </th>
                        <th>شماره تماس </th>
                        <th>نمایش </th>
                        </thead>
                        <tbody>
                            @foreach($users as $item)
                                @if($item->type==1)
                                    <tr class="warning_bg_admin">
                                @elseif($item->type==11)
                                    <tr class="primary_bg_admin">
                                @elseif($item->type==12)
                                    <tr class="danger_bg_admin">
                                @elseif($item->type==20)
                                    <tr class="success_bg_admin">
                                @endif
                                        <td>
                                            {{$item->fname}}
                                        </td>
                                        <td>
                                            {{$item->lname}}
                                        </td>
                                        <td>
                                            {{$item->codemelli}}
                                        </td>
                                        <td >
                                            <a href="tel:{{$item->tel}}">{{$item->tel}}</a>
                                        </td>
                                        <td>
                                            <a href="/admin/user/{{$item->id}}">
                                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                                    <path fill-rule="evenodd" d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                                </svg>
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

