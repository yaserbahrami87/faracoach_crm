@extends('panelAdmin.master.index')
@section('headerScript')

    <link href="{{asset('/css/kamadatepicker.min.css')}}" rel="stylesheet" />
    <link href="{{asset('/css/timepicker.min.css')}}" rel="stylesheet" />
    <link href="{{asset('/trumbowyg-2.25.1/dist/ui/trumbowyg.min.css')}}" rel="stylesheet" />
    <style>
        form
        {
            display: contents;
        }
    </style>
@endsection


@section('rowcontent')
    <div class="container bg-light shadow-lg">
        <div class="row p-5">
            <div class="col-12 border-bottom mb-5">
                <h4>ایجاد رویداد جدید</h4>
            </div>
            <form>
                <div class="col-12 col-sm-6 col-md-6 col-xl-6 col-lg-6 ">
                        <div class="form-group">
                            <label for="event">موضوع رویداد*</label>
                            <input type="text" class="form-control" id="event" name="event" />
                        </div>
                        <div class="form-group">
                            <label for="shortlink">لینک اختصاصی*</label>
                            <input type="text" class="form-control" id="shortlink" name="shortlink" />
                            <small>لینک اختصاصی نباید تکراری باشد</small>
                        </div>
                        <div class="form-group">
                            <label for="description">توضیح کوتاه*</label>
                            <input type="text" class="form-control" id="description" name="description" />
                            <small>حداکثر 150 کارکتر</small>
                        </div>
                        <div class="form-group">
                            <label for="capacity">ظرفیت*</label>
                            <input type="number" class="form-control" id="capacity" name="capacity" />
                            <small class="text-muted">در صورت نامحدود بودن عدد 1- را وارد کنید</small>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="image">آدرس عکس شاخص*</label>
                                    <input type="text" class="form-control" id="image" name="image" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="custom-file">
                                    <label for="video">آدرس ویدئو</label>
                                    <input type="file" class="custom-file-input" id="video" name="video" />
                                    <label class="custom-file-label" for="video">Choose file</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="start_date">تاریخ شروع رویداد*</label>
                                    <input type="text" class="form-control" id="start_date" name="start_date"  autocomplete="off"  />
                                </div>
                            </div>
                            <div class="col-md-6 ">
                                <div class="form-group">
                                    <label for="start_date">ساعت شروع رویداد*</label>
                                    <input type="text" class="form-control time" id="start_time" name="start_time"  autocomplete="off"  />
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="end_date">تاریخ پایان رویداد*</label>
                                    <input type="text" class="form-control" id="end_date" name="end_date"  autocomplete="off"  />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="end_time">ساعت پایان رویداد*</label>
                                    <input type="text" class="form-control time" id="end_time" name="end_time"  autocomplete="off"  />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="expire_date">تاریخ پایان ثبت نام*</label>
                            <input type="text" class="form-control" id="expire_date" name="expire_date"  autocomplete="off"  />
                        </div>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-xl-6 col-lg-6 ">
                    <div class="form-group">
                        <a class="btn btn-outline-info d-block mb-2" data-toggle="collapse" href="#collapseEventText" role="button" aria-expanded="false" aria-controls="collapseEventText">
                            توضیحات رویداد
                        </a>
                        <div class="collapse" id="collapseEventText">
                            <div class="card card-body">
                                <textarea class="form-control" id="event_text" name="event_text"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <a class="btn btn-outline-info d-block mb-2" data-toggle="collapse" href="#collapseheading" role="button" aria-expanded="false" aria-controls="collapseheading">
                            سرفصلها
                        </a>
                        <div class="collapse" id="collapseheading">
                            <div class="card card-body">
                                <textarea class="form-control" id="heading" name="heading"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <a class="btn btn-outline-info d-block mb-2" data-toggle="collapse" href="#collapsecontacts" role="button" aria-expanded="false" aria-controls="collapsecontacts">
                            مخاطبین
                        </a>
                        <div class="collapse" id="collapsecontacts">
                            <div class="card card-body">
                                <textarea class="form-control" id="contacts" name="contacts"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <a class="btn btn-outline-info d-block mb-2" data-toggle="collapse" href="#collapsefaq" role="button" aria-expanded="false" aria-controls="collapsefaq">
                            سوالات متداول
                        </a>
                        <div class="collapse" id="collapsefaq">
                            <div class="card card-body">
                                 <textarea class="form-control" id="faq" name="faq"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <a class="btn btn-outline-info d-block mb-2" data-toggle="collapse" href="#collapselinks" role="button" aria-expanded="false" aria-controls="collapselinks">
                            راه های ارتباطی
                        </a>
                        <div class="collapse" id="collapselinks">
                            <div class="card card-body">
                                <textarea class="form-control" id="links" name="links"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">ثبت رویداد</button>
            </form>
        </div>
    </div>

@endsection

@section('footerScript')
    <!--  DATE SHAMSI PICKER  --->
    <script src="{{asset('js/kamadatepicker.min.js')}}"></script>
    <script src="{{asset('js/kamadatepicker.holidays.js')}}"></script>
    <script>
        kamaDatepicker('start_date',
            {
                markHolidays:true,
                markToday:true,
                twodigit:true,
                closeAfterSelect:true,
                nextButtonIcon: "fa fa-arrow-circle-right",
                previousButtonIcon: "fa fa-arrow-circle-left"
            });

        kamaDatepicker('end_date',
            {
                markHolidays:true,
                markToday:true,
                twodigit:true,
                closeAfterSelect:true,
                nextButtonIcon: "fa fa-arrow-circle-right",
                previousButtonIcon: "fa fa-arrow-circle-left"
            });

        kamaDatepicker('expire_date',
            {
                markHolidays:true,
                markToday:true,
                twodigit:true,
                closeAfterSelect:true,
                nextButtonIcon: "fa fa-arrow-circle-right",
                previousButtonIcon: "fa fa-arrow-circle-left"
            });


    </script>


    <script src="{{asset('/trumbowyg-2.25.1/dist/trumbowyg.min.js')}}"></script>
    <script src="{{asset('/trumbowyg-2.25.1/dist/langs/fa.js')}}"></script>
    <script>
        $('textarea').trumbowyg({
            lang:'fa',
            btns: [
                ['undo', 'redo'], // Only supported in Blink browsers
                ['formatting'],
                ['strong', 'em', 'del'],
                ['superscript', 'subscript'],
                ['link'],
                ['insertImage'],
                ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
                ['unorderedList', 'orderedList'],
                ['horizontalRule'],
                ['removeformat'],
                ['fullscreen']
            ]
        })
    </script>

    <script src="{{asset('js/timepicker.js')}}"></script>
    <script>
        jQuery.noConflict();
        jQuery('#start_time').timepicker();
        jQuery('#end_time').timepicker();
    </script>
@endsection
