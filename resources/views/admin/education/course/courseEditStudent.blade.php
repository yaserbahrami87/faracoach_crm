@extends('admin.master.index')

@section('headerScript')
    <link href="{{asset('/css/kamadatepicker.min.css')}}" rel="stylesheet" />
@endsection
@section('content')
    <div class="col-6">
        <div class="form-group">
            <label for="user">دانشجو:</label>
            <input id="user" type="text" class="form-control "  value="{{$student->user->fname.' '.$student->user->lname}}" disabled    />
        </div>
        <form method="post" action="/admin/education/students/{{$student->id}}">
            {{csrf_field()}}
            {{method_field('PATCH')}}
            <input type="hidden" value="{{$student->user_id}}" name="user_id"/>
            <input type="hidden" value="{{$student->course_id}}" name="course_id"/>
            <div class="form-group">
                <label for="date">تاریخ ثبت نام:</label>
                <input type="text" class="form-control" id="date" name="date_fa" autocomplete="off" value="{{$student->date_fa}}"  />
            </div>
            <div class="form-group">
                <label for="status">وضعیت
                    <span class="text-danger text-bold">*</span>
                </label>

                <select class="form-control" id="status" name="status">
                    <option disabled selected>انتخاب کنید</option>
                    <option value="1" @if($student->status==1) selected @endif>دانشجو</option>
                    <option value="2" @if($student->status==2) selected @endif >انصراف</option>
                    <option value="3" @if($student->status==3) selected @endif data-toggle="collapse" aria-controls="collapseStatus" href="#collapseStatus"  >
                        فارغ التحصیل
                    </option>
                    <option value="4" @if($student->status==4) selected @endif >مرخصی</option>
                    <option value="5" @if($student->status==5) selected @endif >بلاتکلیف</option>
                </select>

                <div class="collapse @if($student->status==3) show @endif" id="collapseStatus">
                    <div class="form-group">
                        <label for="code">شماره دانشجویی</label>
                        <input type="text" class="form-control" id="code" name="code" value="{{$student->code}}"/>
                    </div>
                    <div class="form-group">
                        <label for="date_gratudate">تاریخ فارغ التحصیلی</label>
                        <input type="text" class="form-control" id="date_gratudate" name="date_gratudate"  value="{{$student->date_gratudate}}" />
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">ویرایش</button>
        </form>
    </div>
@endsection

@section('footerScript')
    <!--  DATE SHAMSI PICKER  --->
    <script src="{{asset('js/kamadatepicker.min.js')}}"></script>
    <script src="{{asset('js/kamadatepicker.holidays.js')}}"></script>

    <script>
        kamaDatepicker('date_gratudate',
            {
                markHolidays:true,
                markToday:true,
                twodigit:true,
                closeAfterSelect:true,
                nextButtonIcon: "fa fa-arrow-circle-right",
                previousButtonIcon: "fa fa-arrow-circle-left"
            });


        kamaDatepicker('date',
            {
                markHolidays:true,
                markToday:true,
                twodigit:true,
                closeAfterSelect:true,
                nextButtonIcon: "fa fa-arrow-circle-right",
                previousButtonIcon: "fa fa-arrow-circle-left"
            });

            $('#status').change(function()
            {
                if($('#status').val()==3)
                {
                    $('#collapseStatus').attr('class','form-group');
                }
                else
                {
                    $('#collapseStatus').attr('class','form-group d-none');
                }


            });
    </script>
@endsection
