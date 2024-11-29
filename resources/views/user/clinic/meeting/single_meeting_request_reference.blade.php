@extends('user.master.index')

@section('headerScript')

    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{asset('css/table/style.css')}}">

    <link href="{{asset('/css/kamadatepicker.min.css')}}" rel="stylesheet" />
    <link href="{{asset('/css/timepicker.min.css')}}" rel="stylesheet" />
    <link href="{{asset('css/style_customer.css')}}" rel="stylesheet"/>

    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>

        <!--Table css    -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>


    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
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

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="/trumbowyg-2.25.1/dist/ui/trumbowyg.min.css" rel="stylesheet" />
@endsection
@section('content')


    <div class="container bootstrap snippets bootdeys">
        <div class="row" id="user-profile">
            <div class="col-lg-3 col-md-4 col-sm-4">
                <div class="main-box clearfix">

                    <h2>{{$reserves[0]->user_coach['fname'].' '.$reserves[0]->user_coach['lname']}}  </h2>
                    <div class="profile-status">

                    </div>
                    <img src="{{asset('images/'.$reserves[0]->user_coach['personal_image'])}}" alt="" class="profile-img img-responsive center-block">
<!--
                    <div class="profile-label">
                        <span class="label label-danger">Admin</span>
                    </div>
-->
                    <div class="profile-stars">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>
                    </div>


                    <div class="profile-since">
                        تاریخ ثبت نام : {{$reserves[0]->user_coach['created_at']}}
                    </div>

                    <div class="profile-details">
                        <ul class="fa-ul">
                            <li><i class="fa-li fa fa-truck"></i>تعداد جلسات : <span>456</span></li>
                            <li><i class="fa-li fa fa-comment"></i>جلسات برگذار شده : <span>828</span></li>
                            <li><i class="fa-li fa fa-tasks"></i>جلسات برگذار نشده <span>1024</span></li>
                            <li><i class="fa-li fa fa-tasks"></i>جلسات نامشخص   <span>1024</span></li>
                        </ul>
                    </div>

                    <div class="profile-message-btn center-block text-center">
                        <a href="#" class="btn btn-success">
                            <i class="fa fa-envelope"></i> ارسال پیام
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-8 col-sm-8">
                <div class="main-box clearfix">
                    <div class="profile-header">
                        <h3><span>اطلاعات مراجع</span></h3>
<!--                        <a href="#" class="btn btn-primary edit-profile">
                            <i class="fa fa-pencil-square fa-lg"></i> Edit profile
                        </a>-->
                    </div>


                    <div class="row profile-user-info">
                        <div class="col-sm-5">
                            <div class="profile-user-details clearfix">
                                <div class="profile-user-details-label">
                                      نــام :
                                </div>
                                <div class="profile-user-details-value">
                                   {{$reserves[0]->user_coach['fname']}}
                                </div>
                            </div>
                            <div class="profile-user-details clearfix">
                                <div class="profile-user-details-label">
                                    نام خانوادگی :
                                </div>
                                <div class="profile-user-details-value">
                                    {{$reserves[0]->user_coach['lname']}}
                                </div>
                            </div>
                            <div class="profile-user-details clearfix">
                                <div class="profile-user-details-label">
                                    تولد :
                                </div>
                                <div class="profile-user-details-value">
                                    {{$reserves[0]->user_coach['datebirth']}}
                                </div>

                            </div>

<!--                            <div class="profile-user-details clearfix">
                                <div class="profile-user-details-label">
                                    شغـل :
                                </div>
                                <div class="profile-user-details-value">
                                    برنامه نویس
                                </div>
                            </div>
                            <div class="profile-user-details clearfix">
                                <div class="profile-user-details-label">
                                    تحصیـلات :
                                </div>
                                <div class="profile-user-details-value">
                                    لیسانس
                                </div>
                            </div>-->
                        </div>
                        <div class="col-sm-7">

<!--                            <div class="profile-user-details clearfix">
                                <div class="profile-user-details-label">
                                    وضعیت تاهل :
                                </div>
                                <div class="profile-user-details-value">
                                    متاهل
                                </div>
                            </div>-->
                            <div class="profile-user-details clearfix">
                                <div class="profile-user-details-label">
                                    شهـر :
                                </div>
                                <div class="profile-user-details-value">
                                    {{$reserves[0]->user->city}}
                                </div>

                            </div>
                            <div class="profile-user-details clearfix">
                                <div class="profile-user-details-label">
                                    شماره تماس :
                                </div>
                                <div class="profile-user-details-value">
                                    {{$reserves[0]->user->tel}}
                                </div>

                            </div>
                            <div class="profile-user-details clearfix">
                                <div class="profile-user-details-label">
                                    ایمیـل :
                                </div>
                                <div class="profile-user-details-value">
                                    {{$reserves[0]->user->email}}
                                </div>
                            </div>

                        </div>
<!--                        <div class="col-sm-1 profile-social">
                            <ul class="fa-ul">
                                <li><i class="fa-li fa fa-twitter-square"></i><a href="#"></a>ش </li>
                                <li><i class="fa-li fa fa-linkedin-square"></i><a href="#"></a> ش</li>
                                <li><i class="fa-li fa fa-facebook-square"></i><a href="#"></a>ش </li>
                                <li><i class="fa-li fa fa-skype"></i><a href="#"></a>ش </li>
                                <li><i class="fa-li fa fa-instagram"></i><a href="#"></a>ش </li>
                            </ul>
                        </div>-->
                    </div>
                    <div class="tabs-wrapper profile-tabs">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab-activity" data-toggle="tab">تنظیمات جلسات</a></li>
                            <li><a href="#tab-friends" data-toggle="tab">درباره مراجع</a></li>
                            <li><a href="#tab-chat" data-toggle="tab">مکاتبات</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="tab-activity">
                                <!------ Include the above in your HEAD tag ---------->

                                <div class="panel panel-default panel-table">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-md-4 col-xs-6">
                                                <h3 class="panel-title">برنامه ریزی جلسات</h3>
                                            </div>
                                            <div class="col-md-8 col-xs-6 text-right">
                                                <div class="pull-right">
                                                    <div class="btn-group" data-toggle="buttons">
                                                        <label class="btn btn-success btn-filter active" data-target="completed">
                                                            <input type="radio" name="options" id="option1" autocomplete="off" checked>
                                                            جلسات برگزار شده
                                                        </label>
                                                        <label class="btn btn-warning btn-filter" data-target="pending">
                                                            <input type="radio" name="options" id="option2" autocomplete="off"> جلسات نامشخص
                                                        </label>
                                                        <label class="btn  btn-color btn-filter" data-target="all">
                                                            <input type="radio" name="options" id="option3" autocomplete="off"> همه جلسات
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <form method="post" action="">
                                            {{csrf_field()}}
                                                <table id="mytable" class="table table-striped table-bordered table-list">
                                                    <thead>
                                                    <tr>
<!--                                                                    <th class="col-check"><input type="checkbox" id="checkall" onclick="test()"/></th>-->
                                                        <th class="hidden-xs" >ردیف</th>
                                                        <th class="col-text"> تاریخ جلسه</th>
                                                        <th class="col-text"> ساعت جلسه</th>
                                                        <th class="col-text">وضعیت جلسه </th>
                                                        <th class="col-text">ارزیابی مراجع </th>
                                                        <th class="col-text">توضیحات </th>
<!--                                                                    <th class="col-tools"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span>-->
<!--                                                                    </th>-->
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    @foreach($reserves as $reserve)
                                                        <tr data-status="completed">
                                                            <!-- <td align="center"><input type="checkbox" class="checkthis"/></td>-->
                                                            <td class="hidden-xs">{{$loop->iteration}}</td>
                                                            <td><input type="text" id="meeting_date" placeholder="تاریخ را مشخص کنید" ></td>
                                                            <td><input type="text" id="meeting_time" placeholder="زمان را مشخص کنید"></td>
                                                            <td>
                                                                <select id="gettingknow" class="form-control p-0" name="gettingknow">
                                                                    <option selected  >تعیین نشده</option>
                                                                    <option >برگزار نشده</option>
                                                                    <option >برگزار شده</option>
                                                                    <option >لغو شده</option>
                                                                    <option >غیبت مراجع</option>
                                                                </select>
                                                            </td>
                                                            <td><textarea class="form-control" id="content" rows="1" name="assessment"></textarea></td>
                                                            <td><textarea class="form-control" id="content" rows="1" name="description"></textarea></td>

                                                        </tr>
                                                    @endforeach

                                                    </tbody>
                                                </table>
                                        </form>
                                    </div>
                                    <div class="panel-footer">
                                        <div class="row">

                                            <div class="col col-xs-3">
                                                <div class="pull-left">
                                                    <button type="button" class="btn btn-warning">
                                                    <span class="glyphicon glyphicon-plus"
                                                          aria-hidden="true"><a href="/admin/insert_meeting_time">
                                                            </a> </span>
                                                        اضافه کردن جلسه جدید
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>




                            </div>

                            <div class="tab-pane fade" id="tab-friends">
                                <span class="mt-3">
                                    موسس آکادمی بین المللی فراکوچ کوچ حرفه ای رهبران و مدیران عالی مدرس بین المللی دوره های استاندارد آموزش و تربیت کوچ حرفه ای تدوینگر استاندارد ملی آموزش کوچینگ توسعه فردی و کسب و کار در ایران
                                </span>
                            </div>

                            <div class="tab-pane fade" id="tab-chat">

                                    <h3>سابقه پیام ها</h3>
                                        <div class="form-group shadow-lg  bg-success ">

                                                <label for="comment"> پیام دریافت شده:</label>

                                                <label for="comment"> پیام ارسال شده:</label>

                                            <textarea class="form-control" id="comment" name="comment" rows="3" disabled readonly></textarea>
                                            <small class="font-weight-bold float-left"></small>
                                        </div>


                                    <form method="post" action="/panel/message/send">
                                        {{csrf_field()}}
                                        <input type="hidden" value="coach" name="type">
                                        <input type="hidden" value="" name="user_id_recieve">
                                        <div class="form-group">
                                            <label for="comment">ارسال پیام:<span class="text-danger">*</span></label>
                                            <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                                        </div>
                                        <button type="submit" class="col-4 mx-auto btn btn-primary" >ارسال پیام</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('footerScript')







    <!--  DATE SHAMSI PICKER  --->
    <script src="{{asset('js/kamadatepicker.min.js')}}"></script>
    <script src="{{asset('js/kamadatepicker.holidays.js')}}"></script>
    <script>
        kamaDatepicker('meeting_date',
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
    <script>
        $(document).ready(function()
        {
            jQuery.noConflict();
            jQuery('#meeting_time').timepicker();
        });
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
    <script>
        $(document).ready(function () {
            $('.btn-filter').on('click', function () {
                var $target = $(this).data('target');
                if ($target != 'all') {
                    $('.table tbody tr').css('display', 'none');
                    $('.table tr[data-status="' + $target + '"]').fadeIn('slow');
                } else {
                    $('.table tbody tr').css('display', 'none').fadeIn('slow');
                }
            });

            $('#checkall').on('click', function () {
                if ($("#mytable #checkall").is(':checked')) {
                    $("#mytable input[type=checkbox]").each(function () {
                        $(this).prop("checked", true);
                    });

                } else {
                    $("#mytable input[type=checkbox]").each(function () {
                        $(this).prop("checked", false);
                    });
                }
            });
        });

    </script>
@endsection
