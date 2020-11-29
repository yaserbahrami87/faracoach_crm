@extends('panelUser.master.index')
@section('rowcontent')
<div class="col-12 border-bottom">
    <div class="row">
        <div class="col-xs-12 col-md-4 col-lg-4 col-xl-4 ">
            <small>نمایش دسته ها:</small>
            <form method="GET" action="/panel/introduced">
                <div class="input-group mb-3">
                    <select class="custom-select" name="category">
                        <option disabled="disabled" selected="selected">انتخاب کنید</option>
                        <option value="0">نمایش همه</option>
                        <option value="notfollowup">پیگیری نشده</option>
                        <option value="continuefollowup">در حال پیگیری</option>
                        <option value="cancelfollowup">انصراف</option>
                        <option value="students">دانشجو</option>
                    </select>
                    <div class="input-group-prepend">
                        <button class="btn btn-outline-secondary bg-dark text-light m-0" type="submit">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-binoculars-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.5 1A1.5 1.5 0 0 0 3 2.5V3h4v-.5A1.5 1.5 0 0 0 5.5 1h-1zM7 4v1h2V4h4v.882a.5.5 0 0 0 .276.447l.895.447A1.5 1.5 0 0 1 15 7.118V13H9v-1.5a.5.5 0 0 1 .146-.354l.854-.853V9.5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v.793l.854.853A.5.5 0 0 1 7 11.5V13H1V7.118a1.5 1.5 0 0 1 .83-1.342l.894-.447A.5.5 0 0 0 3 4.882V4h4zM1 14v.5A1.5 1.5 0 0 0 2.5 16h3A1.5 1.5 0 0 0 7 14.5V14H1zm8 0v.5a1.5 1.5 0 0 0 1.5 1.5h3a1.5 1.5 0 0 0 1.5-1.5V14H9zm4-11H9v-.5A1.5 1.5 0 0 1 10.5 1h1A1.5 1.5 0 0 1 13 2.5V3z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-xs-12 col-md-4 col-lg-4 col-xl-4">
            <small>جستجو:</small>
            <form method="GET" action="/panel/introduced/search">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="q" />
                    <div class="input-group-prepend">
                        <button class="btn btn-outline-secondary bg-dark text-light m-0" type="submit">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
                                <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="col-xs-12 col-md-4 col-lg-4 col-xl-4">
    <small>شماره دوستان خود را جهت دعوت به فراکوچ وارد کنید</small>
    <form method="post" action="/panel/introduced/add">
        {{csrf_field()}}
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="شماره همراه وارد کنید" name="tel" />
            <div class="input-group-prepend">
                <button class="btn btn-outline-secondary bg-dark text-light m-0" type="submit">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-plus-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm7.5-3a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                    </svg>
                </button>
            </div>
        </div>
    </form>
</div>

<div class="col-12">
    <div class="row">
        <div class="col-12 border-bottom">
            <small>تعداد دوستان دعوت شده: <b>{{$countIntroducedUser}} نفر</b></small>
        </div>
        @foreach ($listIntroducedUser as $item)
        <div class="col-lg-3 col-sm-6" id="listFriends">
            <div class="card hovercard">
                <div class="cardheader">

                </div>
                <div class="avatar">
                    <img alt="" src="{{asset('documents/users/'.$item->personal_image)}}">
                </div>
                <div class="info">
                    <div class="title">
                        <a target="_blank" href="https://scripteden.com/">{{$item->fname}} {{$item->lname}}</a>
                    </div>
                    <div class="desc">{{$item->tel}}</div>
                    <!--
                    <div class="desc">Curious developer</div>
                    <div class="desc">Tech geek</div>
                    -->
                </div>
                <div class="bottom">
                    <!--
                    <a class="btn btn-primary btn-twitter btn-sm" href="https://twitter.com/webmaniac">
                        <i class="fa fa-envelope"></i>
                    </a>
                    <a class="btn btn-danger btn-sm" rel="publisher"
                    href="https://plus.google.com/+ahmshahnuralam">
                        <i class="fa fa-google-plus"></i>
                    </a>
                    <a class="btn btn-primary btn-sm" rel="publisher"
                    href="https://plus.google.com/shahnuralam">
                        <i class="fa fa-facebook"></i>
                    </a>
                    -->
                    <a class="btn btn-success btn-sm" href="mailto:{{$item->email}}" title="ارسال پیام الکترونیکی">
                        <i class="fa fa-envelope"></i>
                    </a>
                    <a class="btn-modal-introduced btn btn-primary btn-sm" href="{{$item->id}}" title="نمایش" data-toggle="modal" data-target="#modal_introduced_profile">
                        <i class="fa fa-eye"></i>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
        <div class="col-12 text-center">
            {{$listIntroducedUser->links()}}
        </div>
    </div>
</div>
    <!-- ************* Modal User introduced -->
    <!-- Modal -->
    <div class="modal fade" id="modal_introduced_profile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" dir="rtl">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">مشخصات دوستان</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="col-12 text-center">
                    <div class="spinner-border text-primary text-center" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>

        </div>
        </div>
    </div>
@endsection
