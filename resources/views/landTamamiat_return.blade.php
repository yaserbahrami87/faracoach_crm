@extends('master.index')

@section('headerscript')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <style>
        *
        {
            font-size:18px;
        }

        #link_copy
        {
            cursor: pointer;
        }
    </style>
@endsection
@section('row1')
    <div class="container mt-5" id="int">
        <div class="row justify-content-center">
            <div class="col-md-12 mb-5 mt-2">
                 <img src="{{asset('/images/int.png')}}" target="_blank" class="img-fluid img-thumbnail " id="banner" />
            </div>
            <div class="col-12">
                <p class="font-weight-bold text-center text-success mb-5">با تشکر،  مرحله اول رزرو در وبینار تمامیت با موفقیت انجام شد</p>
                <p class="text-center">ما بدلیل ارزش این مساله و دسترسی آحاد جامعه ،  این  دوره را به  شما هدیه  میدهیم. لطفا شما هم در آگاهی جامعه نسبت به مقوله مهم « تمامیت » یاری کننده باشید.</p>
                <p class="text-center">شما هم میتوانید در راستای مسئولیت اجتماعی خود، در حد توان نسبت به اطلاع رسانی این وبینار سهیم باشید. </p>
                <p>من داوطلبانه نسبت به :</p>
            </div>
            <div class="col-sm-12 col-md-6 col-xl-6">
                @if($errors->any())
                    <div class="col-12">
                        <div class="alert alert-danger" role="alert">
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </div>
                    </div>
                @endif
                <form method="post" action="/landPage/{{$land->id}}">
                    {{csrf_field()}}
                    {{method_field('PATCH')}}
                    <div class="form-group">
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="item1" name="options[]" value="انتشار پوستر وبینار در صفحه اینستاگرامم" />
                            <label class="form-check-label" for="item1">
                                انتشار پوستر وبینار در صفحه اینستاگرامم
                            </label>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox"  id="item2" name="options[]" value="ارسال لینک ثبت نام برای دوستان و عزیزانم اقدام خواهم کرد">
                            <label class="form-check-label" for="item2">
                                ارسال لینک ثبت نام برای دوستان و عزیزانم اقدام خواهم کرد
                            </label>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">تعداد میهمان همراه :</span>
                            </div>
                            <input type="text" class="form-control" name="count" />
                            <div class="input-group-append">
                                <span class="input-group-text">نفر</span>
                            </div>
                        </div>
                        <input type="submit"  class="btn btn-success mb-3" value="اقدام میکنم" />
                        <br/>
                    </div>
                </form>
                <b>لینک اختصاصی معرفی دوستان: </b>
                <p class="p-3 bg-light rounded text-center" id="link_copy" >{{asset('/integrity?q='.$land->id)}}</p>
            </div>
            <div class="col-sm-12 col-md-6 col-xl-6 text-center">
                <a href="{{asset('/images/story1-small.jpg')}}" class="btn btn-primary m-2" target="_blank">
                    دانلود پوستر سایز استوری
                    <i class="bi bi-download"></i>
                </a>

                <a href="{{asset('/images/int.png')}}"  class="btn btn-primary" target="_blank" >
                    دانلود پوستر سایز پست
                    <i class="bi bi-download"></i>
                </a>

            </div>
        </div>
    </div>

@endsection

@section('footerScript')
    <script>

        $("#link_copy").click(function()
        {
            var links=this.innerHTML;
            navigator.clipboard.writeText(links);
            alert('لینک اختصاصی کپی شد');
        });

    </script>

@endsection
