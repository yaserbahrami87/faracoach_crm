@extends('admin.master.index')

@section('headerScript')
    <link rel="stylesheet" href="{{asset('/css/bootstrap-multiselect.min.css')}}" type="text/css"/>
    <link href="{{asset('/dashboard/assets/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
    <style>
        .clickable-row
        {
            cursor: pointer;
        }
    </style>
@endsection
@section('content')
    <div class="col-12">
        <form method="get" action="/admin/reports/advance" id="advance_form">
            {{csrf_field()}}
            <div class="row">
                <div class="col-3 mb-1" id="app">
                    <div class="form-group">
                        <date-picker
                            type="date"
                            v-model="range"
                            range
                            format="jYYYY-jMM-jDD"
                            display-format="jYYYY/jMM/jDD"
                            name="range_date"
                            max="{{$dateNow}}"
                            id="start_date"
                        ></date-picker>

                    </div>
                </div>
                <div class="col-3 mb-1">
                    <div class="input-group is-invalid">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="gender">دسته </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="kind" id="kind1" value="پیگیری">
                            <label class="form-check-label" for="kind1">پیگیری شده</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="kind" id="kind2" value="ثبت">
                            <label class="form-check-label" for="kind2">ثبت شده</label>
                        </div>
                    </div>

                </div>
                <div class="col-3 mb-1">
                    <div class="input-group is-invalid">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="gender">جنسیت</label>
                        </div>
                        <select class="custom-select selectpicker" id="gender" name="gender[]" multiple>
                            <option value="NULL">نامشخص</option>
                            <option value="1">مرد</option>
                            <option value="0">زن</option>
                        </select>
                    </div>
                </div>
                <div class="col-3 mb-1">
                    <div class="input-group is-invalid">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="married">تاهل</label>
                        </div>
                        <select class="custom-select selectpicker" id="married" name="married[]" multiple>
                            <option value="0">مجرد</option>
                            <option value="1">متاهل</option>
                        </select>
                    </div>
                </div>
                <div class="col-3  mb-1">
                    <div class="input-group is-invalid">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="state">استان</label>
                        </div>
                        <select class="custom-select selectpicker"  id="state" name="state[]" multiple>
                            @foreach($states as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-3  mb-1">
                    <div class="input-group is-invalid">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="education">تحصیلات</label>
                        </div>
                        <select class="custom-select selectpicker" multiple="multiple" id="education" name="education[]" >
                            <option>زیردیپلم</option>
                            <option>دیپلم</option>
                            <option>فوق دیپلم</option>
                            <option>لیسانس</option>
                            <option>فوق لیسانس</option>
                            <option>دکتری و بالاتر</option>
                        </select>
                    </div>
                </div>

                <!--
                <div class="col-3  mb-1">

                    <div class="input-group mr-sm-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">@</div>
                        </div>
                        <input type="text" class="form-control" id="inlineFormInputGroupUsername2" placeholder="Username">
                    </div>
                </div>
                -->
                <div class="col-3  mb-1">
                    <div class="input-group is-invalid">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="social">شبکه های مجازی</label>
                        </div>
                        <select class="custom-select selectpicker" id="social" name="social[]" multiple>
                            <option value="instagram">اینستاگرام داشته باشد</option>
                            <option value="telegram">تلگرام داشته باشد</option>
                            <option value="linkedin">لینکدین داشته باشد</option>

                        </select>
                    </div>
                </div>
                <div class="col-3  mb-1">
                    <div class="input-group is-invalid">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="types">دسته بندی</label>
                        </div>
                        <select class="custom-select selectpicker" id="types" name="types[]" multiple>
                            @foreach($userType as $item)
                                <option value="{{$item->code}}">{{$item->type}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @foreach($tagsParent as $item)
                <div class="col-3  mb-1">
                    <div class="input-group is-invalid">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="types">تگ {{$item->category}}</label>
                        </div>
                        <select class="custom-select selectpicker" id="types" name="tags[]" multiple>
                                @foreach($item->tags as $item_tags)
                                    <option value="{{$item_tags->id}}">{{$item_tags->tag}}</option>
                                @endforeach

                        </select>

                    </div>
                </div>
                @endforeach


                <div class="col-3  mb-1">
                    <input type="submit" class="btn btn-success" value="جستجو" id="btn_search">
                </div>
                <div class="col-12 mt-2 border border-top" id="result_search">
                    <table class="dataTable table table-striped table-bordered table-hover" style="width:100%">
                        <thead>
                        <tr>
                            <th>ردیف</th>
                            <th>نام</th>
                            <th>نام خانوادگی</th>
                            <th>شماره تماس</th>
                        </tr>
                        </thead>
                        <tbody>
                            @isset($users)
                                @foreach($users as $item)
                                    <tr class='clickable-row' data-href='{{asset('/admin/user/'.$item->id)}}'>
                                        <td>
                                            <a href="{{asset('/admin/user/'.$item->id)}}">{{$item->fname}}</a>

                                        </td>
                                        <td>
                                            <a href="{{asset('/admin/user/'.$item->id)}}">{{$item->lname}}</a>
                                        </td>
                                        <td>s3</td>
                                        <td>s4</td>
                                    </tr>
                                @endforeach
                            @endisset
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('footerScript')
    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment-jalaali@0.7.4/build/moment-jalaali.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue-persian-datetime-picker/dist/vue-persian-datetime-picker-browser.js"></script>
    <script>
        var app = new Vue({
            el: '#app',
            components: {
                DatePicker: VuePersianDatetimePicker
            },
            data: {
                time:"{{old('time')}}",
                dates: [],
                range:[],
            }

        });


    </script>


    <script src="{{asset('/js/bootstrap-multiselect.min.js')}}"></script>
    <script type="text/javascript">
        $(function () {
            $('.selectpicker').multiselect({
                includeSelectAllOption: true,
                enableFiltering: true,
                maxHeight: 150
            });
        });
    </script>


    <script src="{{asset('/dashboard/assets/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('/dashboard/assets/js/dataTables.bootstrap4.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('.dataTable').DataTable();
        } );
    </script>


    <script>
            $(document).ready(function() {
                $(".clickable-row").click(function() {
                    window.location = $(this).data("href");
                    console.log($(this).data("href"));
                });
            });

            // $('#btn_search').click(function (e)
            // {
            //     e.preventDefault();
            //     $.ajax({
            //         type:'POST',
            //         url:'/admin/reports/advance/',
            //         data:$("#advance_form").serialize(),
            //         success:function(data)
            //         {
            //             var i=1;
            //             //errorsHtml='<tr>';
            //             errorsHtml='';
            //             $.each( data, function( key, value ) {
            //                 console.log(value['fname']);
            //                 errorsHtml += '<tr><td>'+ value['fname'] + '</td><td>'+(i++)+'</td></tr>'; //showing only the first error.
            //             });
            //             //errorsHtml += '</tr>';
            //             $( '#result_search tbody' ).html(errorsHtml);
            //
            //         },
            //         error:function(data)
            //         {
            //             $('#error_div').text(data.responseJSON.errors);
            //             errorsHtml='<div class="alert alert-danger text-left"><ul>';
            //             $.each( data.responseJSON.errors, function( key, value ) {
            //                 errorsHtml += '<li>'+ value[0] + '</li>'; //showing only the first error.
            //             });
            //             errorsHtml += '</ul></div>';
            //
            //             $( '#error_div' ).html( errorsHtml );
            //         }
            //     },
            //     )
            //
            // });
    </script>
@endsection
