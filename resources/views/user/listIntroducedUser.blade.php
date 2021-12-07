@extends('user.master.index')
@section('content')

@if($countIntroducedUser<50)
    <div class="col-12 border-bottom">
        <form method="post" action="/panel/introduced/add">
            <small>مشخصات دوستان خود را جهت دعوت به فراکوچ وارد کنید</small>
            <div class="row pt-1" id="formAddIntroduce">
                {{csrf_field()}}
                <div class="col-xs-12 col-md-3 col-lg-3 col-xl-3 ">
                    <small>نام:<span class="text-danger">*</span></small>
                    <div class="input-group mb-1">
                        <input type="text" class="form-control" placeholder="نام وارد کنید" name="fname" value="{{old('fname')}}"/>
                        <div class="input-group-prepend">

                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-3 col-lg-3 col-xl-3 ">
                    <small>نام خانوادگی:<span class="text-danger">*</span></small>
                    <div class="input-group mb-1">
                        <input type="text" class="form-control" placeholder="نام خانوادگی وارد کنید" name="lname" value="{{old('lname')}}" />
                        <div class="input-group-prepend">

                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-3 col-lg-3 col-xl-3 ">
                    <small>تلفن همراه:<span class="text-danger">*</span></small>
                    <div class="input-group mb-1">
                        <input type="hidden" id="tel_org" value="{{old('tel')}}" name="tel"/>
                        <input id="tel" dir="ltr" type="tel" class="form-control" placeholder="شماره همراه وارد کنید" value="{{old('tel')}}" />
                        <div class="input-group-prepend">
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-3 col-lg-3 col-xl-3">
                    <small>جنسیت:<span class="text-danger">*</span></small>
                    <div class="input-group mb-1">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="sex1" name="sex" class="custom-control-input" value="1" {{ old('sex')=="1" ? 'checked='.'"'.'checked'.'"' : '' }} >
                            <label class="custom-control-label" for="sex1">آقا</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="sex0" name="sex" class="custom-control-input" value="0" {{ old('sex')=="0" ? 'checked='.'"'.'checked'.'"' : '' }} >
                            <label class="custom-control-label" for="sex0">خانم</label>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-3 col-lg-3 col-xl-3 ">
                    <small>پیگیری توسط:<span class="text-danger">*</span></small>
                    <div class="input-group mb-1">
                        @foreach($getFollowbyCategory as $item)
                            <div class="custom-control custom-radio">
                                <input type="radio" id="customRadio{{$item->id}}" name="followby_id" class="custom-control-input" value="{{$item->id}}">
                                <label class="custom-control-label" for="customRadio{{$item->id}}">{{$item->followby}}</label>
                            </div>
                        @endforeach
                    </div>
                </div><div class="col-xs-12 col-md-3 col-lg-3 col-xl-3 ">
                    <small> پیامک اطلاع رسانی</small>
                    <div class="input-group mb-1">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="sms0" name="sms" class="custom-control-input" value="1">
                            <label class="custom-control-label" for="sms0">ارسال شود</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="sms1" name="sms" class="custom-control-input" value="0" checked>
                            <label class="custom-control-label" for="sms1">ارسال نشود</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="input-group mb-1">
                        <!-- <button type="button" class="btn btn-primary" id="addFormIntroduce" title="اضافه کردن فرم جدید">+</button>-->
                        <button type="submit" class="btn btn-primary">ارسال دعوتنامه</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endif
<div class="col-12 ">
    <div class="row">
        <div class="col-xs-12 col-md-4 col-lg-4 col-xl-4 ">
            <small>نمایش دسته ها:</small>
            <form method="GET" action="/panel/introduced">
                <div class="input-group mb-1">
                    <select class="custom-select" name="category">
                        <option disabled="disabled" selected="selected">انتخاب کنید</option>
                        <option value="0">نمایش همه</option>
                        <option value="notfollowup">پیگیری نشده</option>
                        <option value="continuefollowup">در حال پیگیری</option>
                        <option value="cancelfollowup">انصراف</option>
                        <option value="students">دانشجو</option>
                    </select>
                    <div class="input-group-prepend">
                        <button class="btn btn-outline-secondary text-light m-0" type="submit">
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
                <div class="input-group mb-1">
                    <input type="text" class="form-control" name="q" />
                    <div class="input-group-prepend">
                        <button class="btn btn-outline-secondary  text-light m-0" type="submit">
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



<div class="col-12">
    <div class="row">
        <div class="col-12 border-bottom mb-1">
            <small data-bs-toggle="tooltip" data-bs-placement="top" title="در صورت تبدیل حداقل 5 نفر از دعوت شدگان شما به دانشجو امکان ثبت بیشتر از 50 نفر فعال خواهد شد">تعداد دوستان دعوت شده: <b>{{$countIntroducedUser}}  نفر </b> از 50 نفر </small>
        </div>
        @foreach ($listIntroducedUser as $item)
        <div class="col-lg-3 col-sm-6 listFriends " id="">
            <div class="box shadow-lg">
                <img class="profile" src="{{asset('documents/users/'.$item->personal_image)}}" alt=""/>

                <div class="box-title">{{$item->fname.' '.$item->lname}}</div>

                <div class="box-text mt-1" dir="ltr">
                    <span>
                        <a href="tel:{{$item->tel}}">{{$item->tel}}</a>
                    </span>
                </div>

                <div class="icons">
                    <a class="btn-modal-introduced btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" href="/panel/followup/{{$item->id}}" title="پیگیری" >
                        <i class="bi bi-asterisk"></i>
                    </a>
                    <a class="btn-modal-introduced btn btn-primary btn-sm" href="{{$item->id}}" title="نمایش" data-toggle="modal" data-target="#modal_introduced_profile">
                        <i class="bi bi-eye-fill"></i>
                    </a>
                    <a href="#"><i class="fa fa-tumblr"></i></a>
                    <a href="#"><i class="fa fa-linkedin"></i></a>
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



@section('footerScript')
    <script src="{{asset('/panel_assets/intl_tel/js/intlTelInput.js')}}"></script>
    <script src="{{asset('/panel_assets/intl_tel/js/utils.js')}}"></script>
    <script>

        var input = document.querySelector("#tel");
        var intl=intlTelInput(input,{
            formatOnDisplay:false,
            separateDialCode:true,
            preferredCountries:["ir", "gb"]
        });



        input.addEventListener("countrychange", function() {
            document.querySelector("#tel_org").value=intl.getNumber();
        });

        $('#tel').change(function()
        {
            document.querySelector("#tel_org").value=intl.getNumber();
        });
    </script>
@endsection
