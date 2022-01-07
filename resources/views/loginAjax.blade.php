<div class="col-12 pt-1 text-center">
    <div class="alert alert-warning">
        <button type="button" class="btn btn-primary mt-2" data-toggle="modal" data-target="#login">
            ورود / ثبت نام
        </button>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="login" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ورود / ثبت نام</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">ورود</a>
                            <a class="nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">ثبت نام</a>
                        </div>
                    </nav>
                    <div class="tab-content mt-3" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <div class="col-12" id="result_login">
                            </div>
                            <form method="POST"  id="loginAjax">
                                {{csrf_field()}}
                                <div class="form-group row">
                                    <div class="col-md-6 offset-md-3">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="bi bi-person-fill"></i>
                                                </span>
                                            </div>
                                            <input type="hidden" id="tel_org_login" value="{{ old('email') }}" name="email"/>
                                            <input type="tel"  id="tel_login" class="form-control @error('email') is-invalid @enderror"  value="{{ old('email') }}"   required autocomplete="tel" autofocus placeholder="تلفن همراه خود را وارد کنید" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6 offset-md-3">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="bi bi-key-fill"></i>
                                                </span>
                                            </div>
                                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}"   required  placeholder=" رمز خود را وارد کنید" />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-12">
                                        <button type="button" class="btn btn-primary" id="btn_submit" >
                                            {{ __('ورود') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <div class="col-12" id="result_signup"></div>
                            <form method="POST" id="frm_signup">
                                {{csrf_field()}}
                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('پست الکترونیکی:') }}<span class="font-weight-bold text-danger">*</span></label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="tel" class="col-md-4 col-form-label text-md-right">{{ __('تلفن همراه:') }}<span class="font-weight-bold text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input type="hidden" id="tel_org_register" value="{{ old('tel') }}" name="tel"/>
                                            <input id="tel" type="tel" dir="ltr" class="form-control @error('tel') is-invalid @enderror"  value="{{ old('tel') }}" required autocomplete="tel"  />
                                            @error('tel')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('رمز عبور:') }} <span class="font-weight-bold text-danger">*</span></label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('تکرار رمز عبور:') }}<span class="font-weight-bold text-danger">*</span></label>

                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="button" class="btn btn-primary" id="btn_signup">
                                            {{ __('ثبت نام') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@section('footerScript')
<script src="{{asset('/panel_assets/intl_tel/js/intlTelInput.js')}}"></script>
<script src="{{asset('/panel_assets/intl_tel/js/utils.js')}}"></script>
<script>
    var input_register = document.querySelector("#tel");
    var intl_register=intlTelInput(input_register,{
        formatOnDisplay:false,
        separateDialCode:true,
        preferredCountries:["ir", "gb"]
    });


    var input = document.querySelector("#tel_login");
    var intl=intlTelInput(input,{
        formatOnDisplay:false,
        separateDialCode:true,
        preferredCountries:["ir", "gb"]
    });

    input_register.addEventListener("countrychange", function() {
        document.querySelector("#tel_org_register").value=intl_register.getNumber();
    });

    $('#tel').change(function()
    {
        document.querySelector("#tel_org_register").value=intl_register.getNumber();
    });

    input.addEventListener("countrychange", function() {
        document.querySelector("#tel_org_login").value=intl.getNumber();
    });

    $('#tel_login').change(function()
    {
        document.querySelector("#tel_org_login").value=intl.getNumber();
    });
</script>
<script>
    //لاگین ایجکس
    $("#btn_submit").click(function()
    {
        $('#result_login').html('<div class="spinner-border text-primary mb-3" role="status"> <span class="sr-only">لطفا صبر کنید...</span> </div>');
        var data=$('#loginAjax').serialize();
        $.ajax(
            {
                type:"POST",
                url:'/login',
                data:data,

                success: function (data) {
                    $('#result_login').html("<div class='alert alert-success'>ورود با موفقیت انجام شد</div>");
                    location.reload();
                },
                error : function(data)
                {

                    $('#result_login').text(data.responseJSON.errors);
                    console.log(data.responseJSON.errors);
                    errorsHtml='<div class="alert alert-danger text-left"><ul>';
                    $.each( data.responseJSON.errors, function( key, value ) {
                        errorsHtml += '<li>'+ value[0] + '</li>'; //showing only the first error.
                    });
                    errorsHtml += '</ul></div>';

                    $( '#result_login' ).html( errorsHtml );
                }
            }
        )
    });

    $("#btn_signup").click(function()
    {
        var data=$('#frm_signup').serialize();
        $('#result_signup').html('<div class="spinner-border text-primary mb-3" role="status"> <span class="sr-only">لطفا صبر کنید...</span> </div>');
        $.ajax({
            type:'POST',
            url:'/signupAjax',
            data:data,
            success:function (data)
            {
                $("#result_signup").html(data);
            },
            error : function(data)
            {

                $('#result_signup').text(data.responseJSON.errors);
                console.log(data.responseJSON.errors);
                errorsHtml='<div class="alert alert-danger text-left"><ul>';
                $.each( data.responseJSON.errors, function( key, value ) {
                    errorsHtml += '<li>'+ value[0] + '</li>'; //showing only the first error.
                });
                errorsHtml += '</ul></div>';

                $( '#result_signup' ).html( errorsHtml );
            }
        })
    });
</script>
@endsection
