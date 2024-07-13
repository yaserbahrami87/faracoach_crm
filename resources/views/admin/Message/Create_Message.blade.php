
@extends('admin.master.index')
@section('headerScript')
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <style>

        div.bootdey h5
        {
            margin: 0px 16px 25px 0px;
            padding: 15px;
            box-shadow: 0 5px 7px #eeeeef;
        }
        #accordion h4 a span:nth-child(1)
        {
            margin-right: 15px;
        }
        #accordion div.panel-title a {
            display: block;
            position: relative;
            padding: 10px 60px 10px 15px;
            font-weight: 400;
            font-size: 18px;
            line-height: 1.6;
            color: #6d7194;
        }
        #accordion a:hover{
            text-decoration:none;
        }
        .drop-accordion .panel-default {
            overflow: hidden;
            border: 0;
            border-radius: 0;
            -webkit-box-shadow: none;
            box-shadow: none;
        }
        .drop-accordion .panel-heading {
            overflow: hidden;
            margin-bottom: 5px;
            padding: 0;
            border: 1px solid #d9d7d7;
            background: #fafafa;
            border-radius: 0;
        }
        .leaf-ui .drop-accordion .panel-heading,
        .circlus-ui .drop-accordion .panel-heading {
            border-radius: 4px;
        }
        .panel-title a {
            display: block;
            position: relative;
            padding: 10px 60px 10px 15px;
            font-weight: 400;
            font-size: 18px;
            line-height: 1.6;
            color: #6d7194;
        }
        .panel-title span {

        }
        .panel-title .expand-icon-wrap {
            position: absolute;
            right: 0;
            top: 0;
            bottom: 0;
            border-left: 1px solid #d9d7d7;
            font-size: 24px;
            line-height: 46px;
            color: #03C6FE;
        }
        .expand-icon-wrap:before {
            content: '';
            display: inline-block;
            height: 100%;
            vertical-align: middle;
        }
        .panel-title .expand-icon {
            padding: 0 18px;
            vertical-align: middle;
        }
        .panel-title .expand-icon:before {
            content: "\f055";
        }
        .drop-accordion .panel-body {
            position: relative;
            border: 1px solid #d9d7d7;
        }
        .circlus-ui .drop-accordion .panel-body,
        .leaf-ui .drop-accordion .panel-body {
            border-radius: 4px;
        }
        .panel-body
        {
            padding-right: 55px;
        }
        .panel-body-icon {
            width: 75px;
            float: left;
            padding: 0px 10px 0px 10px;
        }
        .panel-body-icon i {
            font-size: 35px;
            color: #03C6FE;
        }
        .drop-accordion .tab-collapsed {
            border: transparent;
            background: #03C6FE;
            -webkit-transition: .5s;
            -o-transition: .5s;
            transition: .5s;
        }
        .tab-collapsed a {
            color: #fff;
        }
        .tab-collapsed div.panel-body-icon i
        {
            color: #fff;
        }
        .tab-collapsed .expand-icon-wrap {
            border-color: #fff;
            color: #fff;
        }
        .tab-collapsed .expand-icon:before {
            content: "\f056";
        }
         div.justify-content-end
        {
            padding-left: 60px;
        }
         div.panel-body form
         {
             margin-top: 15px;
         }
         #category
         {
             box-shadow: 0 5px 7px #eeeeef;
             margin: 0px 15px 25px 0px!important;
         }
         #category div:nth-child(1) input[type=text]
         {
            width: 330px;
         }
    </style>
@endsection
@section('content')

    <div class="container bootstrap snippets bootdey">
        <h5 >
            ارسال پیام به مخاطبین
        </h5>
        <div class="div">
            <form method="POST" action="/admin/message" >
                {{ csrf_field() }}
            <div class="row" id="category">
                <div class="col-12">
                    <label>
                         جستجو بر اساس نام یا نام خانوادگی یا تلفن
                    </label>
                    <input type="text" id="subject" name="personal" class="form-control text-left"  placeholder="نام یا نام خانوادگی " value="" dir="ltr" />
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label>کاربرها </label>
                        <select class="form-control" name="user_category[]" multiple>
                            <option value="-1">مارکتینگ 1</option>
                            <option value="-2">مارکتینگ 2</option>
                            <option value="-3">مارکتینگ 3</option>
                            <option value="20">مشتری</option>
                            <option value="11">تور پیگیری</option>
                        </select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label>رویدادها </label>
                        <select class="form-control" name="events_id[]" multiple>
                            @foreach($events as $item)
                                <option value="{{$item->id}}">{{$item->event}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label>دوره ها </label>
                        <select class="form-control" name="course_id[]" multiple>
                            @foreach($courses as $item)
                                <option value="{{$item->id}}">{{$item->course}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

            </div>

            <div class="col-sm-9">
                    <div class="panel-group drop-accordion" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading tab-collapsed" role="tab" id="headingOne">
                                <h4 class="panel-title">
                                    <a class="collapse-controle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <span>  ارسال پیام از طریق پیامک </span>
                                        <div class="panel-body-icon"><i class="bi bi-chat-left-text-fill"></i></div>
                                        <span class="expand-icon-wrap"><i class="fa expand-icon"></i></span>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne" aria-expanded="true">
                                <div class="panel-body">
                                        <input type="hidden" name="type" value="sms" />
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label>موضوع<span class="text-danger">*</span></label>
                                                        <input type="text" id="subject" name="subject" class="form-control text-left" required placeholder="موضوع " value="" dir="ltr" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>متن پیام<span class="text-danger">*</span></label>
                                                    <textarea class="form-control" id="comment" name="comment" required rows="3" placeholder="متن پیام خود را وارد کنید ..."></textarea>
                                                </div>
                                            </div>

                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingTwo">
                                <h4 class="panel-title">
                                    <a class="collapse-controle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        <span>ارسال پیام از طریق تیکت</span>
                                        <div class="panel-body-icon"><i class="bi bi-chat-square-quote-fill"></i></div>
                                        <span class="expand-icon-wrap"><i class="fa expand-icon"></i></span>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo" aria-expanded="false" style="height: 0px;">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label>موضوع</label>
                                                    <input type="text" id="subject" name="subject_ticket" class="form-control text-left"  placeholder="موضوع " value="" dir="ltr" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>متن پیام</label>
                                                <textarea class="form-control" id="comment" name="comment_ticket"  rows="3" placeholder="متن پیام خود را وارد کنید ..."></textarea>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingThree">
                                <h4 class="panel-title">
                                    <a class="collapsed collapse-controle" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        <span>ارسال پیام از طریق ایمیل</span>
                                        <div class="panel-body-icon"><i class="bi bi-envelope-fill"></i></div>
                                        <span class="expand-icon-wrap"><i class="fa expand-icon"></i></span>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree" aria-expanded="false">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label>موضوع</label>
                                                    <input type="text" id="subject" name="subject_email" class="form-control text-left"  placeholder="موضوع " value="" dir="ltr" disabled />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>متن پیام</label>
                                                <textarea class="form-control" id="comment" name="comment_email"  rows="3" placeholder="متن پیام خود را وارد کنید ..." disabled></textarea>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingFour">
                                <h4 class="panel-title">
                                    <a class="collapsed collapse-controle" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">

                                        <span>ارسال پیام از طریق تلگرام</span>
                                        <div class="panel-body-icon"><i class="bi bi-telegram"></i></div>
                                        <span class="expand-icon-wrap"><i class="fa expand-icon"></i></span>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour" aria-expanded="false">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label>موضوع</label>
                                                    <input type="text" id="subject" name="subject_telegram" disabled class="form-control text-left"  placeholder="موضوع " value="" dir="ltr" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>متن پیام</label>
                                                <textarea class="form-control" id="comment" name="comment_telegram" disabled rows="3" placeholder="متن پیام خود را وارد کنید ..."></textarea>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingFive">
                                <h4 class="panel-title">
                                    <a class="collapsed collapse-controle" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                        <span>ارسال پیام از طریق واتساپ</span>
                                        <div class="panel-body-icon"><i class="bi bi-whatsapp"></i></div>
                                        <span class="expand-icon-wrap"><i class="fa expand-icon"></i></span>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive" aria-expanded="false">
                                <div class="panel-body">
                                    <input type="hidden" name="type" value="sms" />
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label>موضوع</label>
                                                    <input type="text" id="subject" name="subject_whatsapp" disabled class="form-control text-left"  placeholder="موضوع " value="" dir="ltr" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>متن پیام</label>
                                                <textarea class="form-control" id="comment" name="comment_whatsapp" disabled  rows="3" placeholder="متن پیام خود را وارد کنید ..."></textarea>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                        <button type="submit" class="btn btn-primary glow mr-sm-1 mb-1">ارسال پیام</button>


                <!-- /#accordion -->
            </div>
            </form>
        </div>
    </div>
@endsection
@section('footerScript')
    <script>
        $(function(){
        $('.panel-heading').click(function(e) {
        $('.panel-heading').removeClass('tab-collapsed');
        var collapsCrnt = $(this).find('.collapse-controle').attr('aria-expanded');
        if (collapsCrnt != 'true') {
        $(this).addClass('tab-collapsed');
        }
        });
        })
    </script>

@endsection
