@section('headerScript')
    <style>
        #board p
        {
            font-size: 16px;
        }
    </style>
@endsection

@if(Auth::user()->tel_verified==0)
    <!--
    <div class="col-12">

        @if ($verifyStatus==false)
            <div class="alert alert-danger">
                <i class="bi bi-exclamation-triangle-fill"></i>
                برای ادامه فعالیت باید تلفن همراه خود را در سیستم فراکوچ ثبت کنید
                <form class="d-inline" method="get" action="/panel/active/mobile/">
                    <button class="btn btn-info text-light btn-sm text-dark" type="submit" id="activeMobile" data-toggle="modal" data-target="#ModalMobile">ارسال کد فعال سازی</button>
                </form>
            </div>

        @else
            <div class="alert alert-warning">
                جهت فعال سازی کد ارسال شده به تلفن همراه را وارد کنید
                <form method="post" action="/panel/active/mobile/code" class="mt-2">
                    {{csrf_field()}}
                    <div class="input-group">
                        <input id="tel" type="text" class="form-control @error('tel') is-invalid @enderror" name="tel" value="{{ old('tel') }}" required autocomplete="tel">
                        <div class="input-group-prepend ">
                            <button class="btn btn-outline-secondary btn-info text-light m-0" type="submit" id="activeMobile" data-toggle="modal" data-target="#ModalMobile">فعال سازی</button>
                        </div>
                    </div>
                </form>
            </div>

        @endif
    </div>
    -->
@endif

@if((is_null(Auth::user()->fname))||(is_null(Auth::user()->lname))||(is_null(Auth::user()->username)))
    <div class="col-12">
        <div class="alert alert-danger">
            لطفا اطلاعات پروفایل خود را کامل کنید <a href="/panel/profile" class="btn btn-primary">اینجا</a>
        </div>
    </div>
@endif


<div class="container-fluid  " >
    <div class="row pt-3" id="board">

        <div class="col-12 border-bottom border-1">
            <h5>
                <i class="bi bi-pen-fill"></i>
                میز کار
            </h5>
        </div>
        <div class="col-12 text-center mt-1">
            <a href="/panel/scholarship/me" class="btn btn-block btn-primary">
                <p>پنل آموزش رایگان کوچینگ + گواهینامه</p>
            </a>
        </div>

        @if(Auth::user()->status_coach==0)
            <div class="col-lg-3 col-md-6 col-sm-6 text-center mt-1 items">
                <a href="panel/coach/create"  class="btn btn-info shadow-lg">
                    <i class="bi bi-person-circle" ></i>
                    <p>همکاری به عنوان کوچ</p>
                </a>
            </div>
        @elseif(Auth::user()->status_coach=='-1')
            <div class="col-lg-3 col-md-6 col-sm-6 text-center mt-1 items">
                <a href="#"  class="btn btn-info shadow-lg">
                    <i class="bi bi-person-circle" ></i>
                    <p>درخواست همکاری شما در حال بررسی است</p>
                </a>
            </div>
        @elseif(Auth::user()->status_coach==1)
            <div class="col-lg-3 col-md-6 col-sm-6   text-center mt-1 items ">
                <a href="/panel/coach/{{Auth::user()->id_coaches_table}}/edit"  class="btn btn-info  shadow-lg">
                    <i class="bi bi-person-circle" ></i>
                    <p>شما یک کوچ هستید</p>
                </a>
            </div>
        @elseif(Auth::user()->status_coach==-2)
            <div class="col-lg-3 col-md-6 col-sm-6  text-center mt-1 items">
                <a href="/panel/coach/{{Auth::user()->id_coaches_table}}/edit"  class="btn btn-info shadow-lg">
                    <i class="bi bi-person-circle" ></i>
                    <p>درخواست همکاری شما رد شد</p>
                </a>
            </div>
        @endif
        <div class="col-lg-3 col-md-6 col-sm-6 text-center mt-1 items">
            <a href="/panel/integrity/files"  class="btn btn-success">
                <i class="bi bi-camera-reels-fill" ></i>
                <p> ویدئوی وبینار تمامیت</p>
            </a>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 text-center mt-1 items">
            <a href="/panel/scientific_support/create"  class="btn btn-success">
                <i class="bi bi-person-circle" ></i>
                <p>همکاری به عنوان پشتیبان علمی </p>
            </a>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 text-center mt-1 items">
            <a href="/panel/integrityTest"  class="btn btn-success">
                <i class="bi bi-pentagon-half" ></i>
                <p> تست تمامیت شخصی</p>
            </a>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 text-center mt-1 items">
            <a href="/panel/effectiveListenings/create" class="btn btn-success">
                <i class="bi bi-ear-fill"></i>
                <p>ارزیابی گوش دادن موثر</p>
            </a>
        </div>



        <div class="col-12 mt-2 border-bottom border-1">
            <h5>آخرین دوره های ثبت نام شده</h5>
        </div>
        <div class="col-12">
            <ul type="none">

            </ul>


            <div class="list-group">
                @if(Auth::user()->students->count()>0)

                    @foreach(Auth::user()->students as $item)
                        <a href="#" class="list-group-item list-group-item-action" target="_blank">{{$item->course->course}}</a>
                    @endforeach
                @else
                    <div class="alert alert-warning">
                        تا کنون دوره ای ثبت نام نکرده اید
                    </div>
                @endif

            </div>

        </div>


    </div>
</div>
