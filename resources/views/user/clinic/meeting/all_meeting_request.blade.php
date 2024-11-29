@extends('user.master.index')

@section('headerScript')

    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{asset('css/table/style.css')}}">

    <link href="{{asset('/css/kamadatepicker.min.css')}}" rel="stylesheet" />
    <link href="{{asset('/css/timepicker.min.css')}}" rel="stylesheet" />
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
    </style>


    <link href="/trumbowyg-2.25.1/dist/ui/trumbowyg.min.css" rel="stylesheet" />
@endsection
@section('content')

    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-4">
                    <h2 class="heading-section">لیست درخواست جلسات</h2>
                </div>
            </div>
            <div class="row" >
                <div class="col-md-12">
                    <div class="table-wrap">
                        <table class="table">
                            <thead class="thead-primary">
                            <tr>
                                <th>ردیف</th>
                                <th>&nbsp;</th>
                                <th> نام </th>
                                <th>نام خانوادگی</th>
                                <th>تاریخ درخواست </th>
                                <th>وضعیت درخواست</th>
                                <th>&nbsp;</th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr class="alert" role="alert">

                                <td>
                                    <label class="checkbox-wrap checkbox-primary">
                                        <input type="checkbox" checked>
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td>
                                    <div class="img" style="background-image: url({{asset('/images/Yaser-Motahedin.png')}});"></div>
                                </td>
                                <td>
                                    <div class="email">
                                        <span>یاسر </span>
                                        <span></span>
                                    </div>
                                </td>
                                <td>متحدین</td>
<!--                                <td class="quantity">
                                    <div class="input-group">
                                        <input type="text" name="quantity" class="quantity form-control input-number" value="2" min="1" max="100">
                                    </div>
                                </td>-->
                                <td>1402/09/09</td>
                                <td>بررسی نشده</td>
                                <td>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true"><i class="fa fa-close"></i></span>
                                    </button>
                                </td>
                            </tr>

                            <tr class="alert" role="alert">

                                <td>
                                    <label class="checkbox-wrap checkbox-primary">
                                        <input type="checkbox" checked>
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td>
                                    <div class="img" style="background-image: url({{asset('/images/Yaser-Motahedin.png')}});"></div>
                                </td>
                                <td>
                                    <div class="email">
                                        <span>یاسر </span>
                                        <span></span>
                                    </div>
                                </td>
                                <td>متحدین</td>
                                <!--                                <td class="quantity">
                                                                    <div class="input-group">
                                                                        <input type="text" name="quantity" class="quantity form-control input-number" value="2" min="1" max="100">
                                                                    </div>
                                                                </td>-->
                                <td>1402/09/09</td>
                                <td>بررسی نشده</td>
                                <td>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true"><i class="fa fa-close"></i></span>
                                    </button>
                                </td>
                            </tr>
                            <tr class="alert" role="alert">

                                <td>
                                    <label class="checkbox-wrap checkbox-primary">
                                        <input type="checkbox" checked>
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td>
                                    <div class="img" style="background-image: url({{asset('/images/Yaser-Motahedin.png')}});"></div>
                                </td>
                                <td>
                                    <div class="email">
                                        <span>یاسر </span>
                                        <span></span>
                                    </div>
                                </td>
                                <td>متحدین</td>
                                <!--                                <td class="quantity">
                                                                    <div class="input-group">
                                                                        <input type="text" name="quantity" class="quantity form-control input-number" value="2" min="1" max="100">
                                                                    </div>
                                                                </td>-->
                                <td>1402/09/09</td>
                                <td>بررسی نشده</td>
                                <td>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true"><i class="fa fa-close"></i></span>
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('footerScript')

    <!-- Table js -->

    <script src="{{asset('js/table/jquery.min.js')}}"></script>
    <script src="{{asset('js/table/popper.js')}}"></script>
    <script src="{{asset('js/table/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/table/main.js')}}"></script>



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
@endsection
