@extends('user.master.index')

@section('headerScript')
    <link href="{{asset('/css/kamadatepicker.min.css')}}" rel="stylesheet" />
    <link href="{{asset('/css/timepicker.min.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('fonts/material-icon/css/material-design-iconic-font.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/nouislider/nouislider.min.css')}}">
    <link href="{{asset('/css/Collabration_request.css')}}" rel="stylesheet">
    <link href="'https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        #collabration label.d-block
        {
            font-size: 16px;
        }
        .form-check label
        {
            font-size: 14px;
        }
        .trumbowyg-editor
        {
            background-color: white;
        }
        p.step-number-content
        {
            font-size: 16px;
        }
        .container div.card
        {
            width: 950px;
        }
        .container .card .left-side
        {
            width: 25%;
        }
        .container .card .right-side
        {
            width: 75%;
        }
        .text p
        {
            color:#6a6c70;
        }
    </style>
    <link href="/trumbowyg-2.25.1/dist/ui/trumbowyg.min.css" rel="stylesheet" />
@endsection
@section('content')
    <div class="container">
        <div class="card">
            <div class="form">
                <div class="left-side">
                    <div class="left-heading">
                        <i class="bi bi-people-fill"></i><h4>سفیر کوچینگ</h4>
                        <hr>
                    </div>
                    <div class="steps-content">
                        <i class="bi bi-caret-left"></i><h5> مـرحله<span class="step-number"> @if(Auth::user()->introduced_verified==2)3 @else 1 @endif </span></h5>
                        <p class="step-number-content active">عزیزانتان را به مسیر شکوفایی دعوت کنید.</p>

                    </div>
                    <ul class="progress-bar">
                        <li  class="@if(Auth::user()->introduced_verified!=2) active @endif">توضیحات  </li>
                        <li>تفاهمنامه</li>
                        <li class="@if(Auth::user()->introduced_verified==2) active @endif" >معرفی افراد</li>
                    </ul>
                </div>
                <div class="right-side">
                    <div class="main @if(Auth::user()->introduced_verified!=2) active @endif">
                        <div class="text-center mt-3">
                            <h5 >سفیر عشق باش </h5>
                            <p></p>
                        </div>
                        <div class="buttons">
                            <button class="next_button">مرحله بعد</button>
                        </div>
                    </div>

                    <div class="main">
                        <div class="text" >

                            {!! $options->option_value !!}
                            @if(Auth::user()->introduced_verified!=0)
                                <input class="d-inline form-check text-success" type="checkbox" value="1" id="introduced_verified" name="introduced_verified" checked disabled >
                                <label class="d-inline form-check text-success" for="introduced_verified">
                                    شرایط و قوانین  بالا را مطالعه کردم و قبول دارم
                                </label>
                            @else
                                <form method="post" action="/panel/introduced/introduced_verified">
                                    {{csrf_field()}}
                                    <div class="form">
                                        <input class="d-inline form-check text-dark" type="checkbox" value="1" id="introduced_verified" name="introduced_verified" @if(Auth::user()->introduced_verified==1) checked @endif>
                                        <label class="d-inline form-check text-dark" for="introduced_verified">
                                            شرایط و قوانین  بالا را مطالعه کردم و قبول دارم
                                        </label>
                                        <button type="submit" class="btn btn-success">موافقم</button>
                                    </div>
                                </form>
                            @endif
                        </div>

                        @if(Auth::user()->introduced_verified==2)
                            <div class="buttons button_space">
                                <button class="back_button">مرحله قبل</button>
                                <button class="next_button">مرحله بعد</button>
                            </div>
                        @endif
                    </div>

                    <div class="main @if(Auth::user()->introduced_verified==2) active @endif">


                        <!------------------------------- CAPTION ----------------------------->
                            <!------------------------------- Form ----------------------------->
                            <section class="col-12 mt-1">
                                <div class="col-12 border mt-1">
                                    <h6 class="mt-2 mb-1">مشخصات دوستان خود را جهت دعوت به فراکوچ وارد کنید</h6>
                                    <form method="post" action="/panel/introduced/add">
                                        <div class="row pt-1 mt-1" id="formAddIntroduce">
                                            {{csrf_field()}}
                                                <div class="col-12 col-md-6">
                                                    <div class="form-group">
                                                        <label for="fname">نام:</label>
                                                        <input type="text" class="form-control" placeholder="مثلا :علی  " name="fname" id="fname" value="{{old('fname')}}"/>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="form-group">
                                                        <label for="lname">نام خانوادگی:</label>
                                                        <input type="text" class="form-control" placeholder="مثلا: محمدی" name="lname" value="{{old('lname')}}" />
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-6">
                                                    <div class="form-group">
                                                        <input type="hidden" id="tel_org" value="{{old('tel')}}" name="tel"/>
                                                        <input id="tel" dir="ltr" type="tel" class="form-control" placeholder="مثلا : 09123456789" value="{{old('tel')}}" />
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-6">
                                                    <div class="form-group">
                                                        <label for="sex0">جنسیت:</label>
                                                        <div class="form-check form-check-inline">
                                                            <input type="radio" id="sex1" name="sex" class="form-check-input" value="1" {{ old('sex')=="1" ? 'checked='.'"'.'checked'.'"' : '' }} >
                                                            <label class="form-check-label" for="sex1">آقا</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input type="radio" id="sex0" name="sex" class="form-check-input" value="0" {{ old('sex')=="0" ? 'checked='.'"'.'checked'.'"' : '' }} >
                                                            <label class="form-check-label" for="sex0">خانم</label>
                                                        </div>
                                                    </div>
                                                </div>

                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <label class="form-check-label">پیگیری توسط :</label>
                                                    @foreach($getFollowbyCategory as $item)
                                                        <div class="form-check form-check-inline">
                                                            <input type="radio" id="customRadio{{$item->id}}" name="followby_id" class="form-check-input" value="{{$item->id}}">
                                                            <label class="form-check-label" for="customRadio{{$item->id}}">{{$item->followby}}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <label class="form-check-label">ارسال پیامک دعوت</label>
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="sms0" name="sms" class="form-check-input" value="0" checked>
                                                        <label class="form-check-label" for="sms0">ارسال شود</label>
                                                    </div>
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="sms1" name="sms" class="form-check-input" value="1" >
                                                        <label class="form-check-label" for="sms1">ارسال نشود</label>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 ">
                                                <div class="input-group mb-2 btn-send">
                                                    <!-- <button type="button" class="btn btn-primary" id="addFormIntroduce" title="اضافه کردن فرم جدید">+</button>-->
                                                    <button type="submit" class="btn  btn-secondary px-3">ثبت کاربر </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </section>

                            <!------------------------------- FOLLWO UP ----------------------------->

                        <section class="col-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>

                                    <th scope="col">  </th>
                                    <th scope="col">نام و نام خانوادگی </th>
                                    <th scope="col">شماره تماس</th>
                                    <th scope="col">وضعیت </th>
                                    <th scop="col"> مشاهده </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($listIntroducedUser as $item)
                                    <tr class="text-center">

                                        <td>
                                            <img class="profile rounde" src="{{asset('documents/users/'.$item->personal_image)}}" alt="" width="25px"/>
                                        </td>
                                        <td>
                                            <div class="box-title">{{$item->fname.' '.$item->lname}}</div>
                                        </td>
                                        <td>
                                            <span>
                                                <a href="tel:{{$item->tel}}">{{$item->tel}}</a>
                                            </span>
                                        </td>
                                        <td>
                                            <a class="btn-modal-introduced btn btn-primary btn-sm" href="{{$item->id}}" title="نمایش" data-toggle="modal" data-target="#modal_introduced_profile">
                                                <i class="bi bi-eye-fill"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <div class="icons">
                                                <a class="btn-modal-introduced btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" href="/panel/followup/{{$item->id}}" title="پیگیری" >
                                                    <i class="bi bi-asterisk"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <!------------------------------------------ Modal ------------------------->
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



                            <div class="col-12 text-center">
                                {{$listIntroducedUser->links()}}
                            </div>
                        </section>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('footerScript')
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/jquery-validation/dist/jquery.validate.min.js')}}"></script>
    <script src="{{asset('vendor/jquery-validation/dist/additional-methods.min.js')}}"></script>
    <script src="{{asset('vendor/jquery-steps/jquery.steps.min.js')}}"></script>
    <script src="{{asset('vendor/minimalist-picker/dobpicker.js')}}"></script>
    <script src="{{asset('vendor/nouislider/nouislider.min.js')}}"></script>
    <script src="{{asset('vendor/wnumb/wNumb.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>

    <script src="{{asset('/panel_assets/intl_tel/js/intlTelInput.js')}}"></script>
    <script src="{{asset('/panel_assets/intl_tel/js/utils.js')}}"></script>
    <!--_________________Time line Step by step    -->
    <script>
        var next_click=document.querySelectorAll(".next_button");
        var main_form=document.querySelectorAll(".main");
        var step_list = document.querySelectorAll(".progress-bar li");

        var num = document.querySelector(".step-number");

        @if(Auth::user()->introduced_verified==2)
            let formnumber=3;
        @else
            let formnumber=0;
        @endif

        next_click.forEach(function(next_click_form){
            next_click_form.addEventListener('click',function(){
                if(!validateform()){
                    return false
                }
                formnumber++;
                updateform();
                progress_forward();
                contentchange();
            });
        });

        var back_click=document.querySelectorAll(".back_button");
        back_click.forEach(function(back_click_form){
            back_click_form.addEventListener('click',function(){
                formnumber--;

                updateform();
                progress_backward();
                contentchange();
            });
        });

        var username=document.querySelector("#user_name");
        var shownname=document.querySelector(".shown_name");


        var submit_click=document.querySelectorAll(".submit_button");
        submit_click.forEach(function(submit_click_form){
            submit_click_form.addEventListener('click',function(){
                shownname.innerHTML= username.value;
                formnumber++;
                updateform();
            });
        });
        var heart=document.querySelector(".fa-heart");
        heart.addEventListener('click',function(){
            heart.classList.toggle('heart');
        });
        var share=document.querySelector(".fa-share-alt");
        share.addEventListener('click',function(){
            share.classList.toggle('share');
        });

        function updateform(){
            main_form.forEach(function(mainform_number){
                mainform_number.classList.remove('active');
            })
            main_form[formnumber].classList.add('active');
        }

        function progress_forward(){
            // step_list.forEach(list => {

            //     list.classList.remove('active');

            // });


            num.innerHTML = formnumber+1;
            step_list[formnumber].classList.add('active');
        }

        function progress_backward(){
            var form_num = formnumber+1;
            step_list[form_num].classList.remove('active');
            num.innerHTML = form_num;
        }

        var step_num_content=document.querySelectorAll(".step-number-content");

        function contentchange(){
            step_num_content.forEach(function(content){
                content.classList.remove('active');
                content.classList.add('d-none');
            });
            step_num_content[formnumber].classList.add('active');
        }
        function validateform(){
            validate=true;
            var validate_inputs=document.querySelectorAll(".main.active input");
            validate_inputs.forEach(function(vaildate_input){
                vaildate_input.classList.remove('warning');
                if(vaildate_input.hasAttribute('require')){
                    if(vaildate_input.value.length==0){
                        validate=false;
                        vaildate_input.classList.add('warning');
                    }
                }
            });
            return validate;
        }

    </script>
    <!--__________________style_Selected________________________________________________-->
    <!--  DATE SHAMSI PICKER  --->
    <script src="{{asset('js/kamadatepicker.min.js')}}"></script>
    <script src="{{asset('js/kamadatepicker.holidays.js')}}"></script>
    <script>
        kamaDatepicker('datebirth',
            {
                markHolidays:true,
                markToday:true,
                twodigit:true,
                closeAfterSelect:true,
                nextButtonIcon: "fa fa-arrow-circle-right",
                previousButtonIcon: "fa fa-arrow-circle-left"
            });

        $('#services').change(function()
        {
            $('#orientation').html("");

            $.ajax({
                url:'/panel/clinic_basic_info/speciality/'+$(this).val(),
                type:'get',
                success(data)
                {
                    //errorsHtml='<option disabled selected>انتخاب کنید</option>';
                    errorsHtml='';
                    $.each( data, function( key, value ) {
                        errorsHtml += '<div class="form-check form-check-inline"> <input class="form-check-input speciality" type="checkbox" value="'+value.id+'" id="speciality'+value.id+'" onclick="speciality_change()"><label class="form-check-label" for="speciality'+value.id+'">'+value.title+'</label></div>'

                    });
                    $( '#speciality' ).html( errorsHtml );

                }
            })
        });

        function speciality_change()
        {
            if($('.speciality:checked').length>0)
            {
                errorsHtml='';
                $('.speciality').each(function (){
                    if($(this).is(':checked'))
                    {
                        $.ajax({
                            url:'/panel/clinic_basic_info/speciality/'+$(this).val(),
                            type:'get',
                            success(data)
                            {

                                $.each( data, function( key, value ) {
                                    errorsHtml += '<div class="form-check form-check-inline"> <input class="form-check-input" type="checkbox" value="'+value.id+'" id="orientation'+value.id+'" name="fk_orientations[]"><label class="form-check-label" for="orientation'+value.id+'">'+value.title+'</label></div>'

                                });

                                $( '#orientation' ).html(errorsHtml);

                            }
                        })
                    }
                });
            }
            else
            {
                $( '#orientation' ).html('');
            }


            // console.log($('.speciality').val());

        }

    </script>
    <script src="/trumbowyg-2.25.1/dist/trumbowyg.min.js"></script>
    <script src="/trumbowyg-2.25.1/dist/langs/fa.js"></script>
    <script>
        $('.textarea').trumbowyg({
            lang:'fa',
            btns: [
                ['undo', 'redo'], // Only supported in Blink browsers
                ['formatting'],
                ['strong', 'em', 'del'],
                ['superscript', 'subscript'],
                //['link'],
                ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
                ['unorderedList', 'orderedList'],
                ['horizontalRule'],
                ['removeformat'],
                ['fullscreen']
            ]
        })
    </script>
<!------------------------list introduced user   --------------------------------- -->

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
    <script src="{{asset('/trumbowyg-2.25.1/dist/trumbowyg.min.js')}}"></script>
    <script src="{{asset('/trumbowyg-2.25.1/dist/langs/fa.js')}}"></script>
    <script>
        $('#tweet').trumbowyg({
            lang:'fa',
            btns: [
                ['undo', 'redo'], // Only supported in Blink browsers
                ['formatting'],
                ['strong', 'em', 'del'],
                ['superscript', 'subscript'],
                ['link'],
                ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
                ['unorderedList', 'orderedList'],
                ['horizontalRule'],
                ['removeformat'],
                ['fullscreen']
            ]
        })
    </script>
    <script>
        function show()
        {
            document.getElementById("viwe").style.display="block";
        }

    </script>
@endsection
