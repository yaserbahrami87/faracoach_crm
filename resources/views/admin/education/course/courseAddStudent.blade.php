@extends('admin.master.index')

@section('headerScript')
    <link href="{{asset('/css/kamadatepicker.min.css')}}" rel="stylesheet" />
@endsection
@section('content')
    <div class="col-6">
        <form>
            <div class="form-group">
                <label for="user">جستجو کاربر:</label>
                <input id="user" type="text" class="form-control @error('user') is-invalid @enderror"  value="{{ old('user') }}" autocomplete="off"   />
            </div>
            <div id="show"></div>
            <div class="form-group">
                <label for="date">تاریخ ثبت نام:</label>
                <input type="text" class="form-control" id="date" autocomplete="off"  />
            </div>
            <div class="form-group">
                <label for="date_fa">مبلغ واریزی:</label>
                <input type="text" class="form-control" id="date_fa" />
            </div>
            <div class="form-group">
                <label for="status">وضعیت</label>
                <select class="form-control" id="status">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select>

                <label for="exampleDataList" class="form-label">Datalist example</label>
                <input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Type to search...">
                <datalist id="datalistOptions">
                    <option value="San Francisco">
                    <option value="New York">
                    <option value="Seattle">
                    <option value="Los Angeles">
                    <option value="Chicago">
                </datalist>
            </div>


            <button type="submit" class="btn btn-primary">اضافه</button>
        </form>
    </div>
@endsection

@section('footerScript')
    <!--  DATE SHAMSI PICKER  --->
    <script src="{{asset('js/kamadatepicker.min.js')}}"></script>
    <script src="{{asset('js/kamadatepicker.holidays.js')}}"></script>

    <script>
        kamaDatepicker('date',
            {
                markHolidays:true,
                markToday:true,
                twodigit:true,
                closeAfterSelect:true,
                nextButtonIcon: "fa fa-arrow-circle-right",
                previousButtonIcon: "fa fa-arrow-circle-left"
            });



        $('#user').change(function()
        {
            user=$('#user').val();
            var data={
                user:user,
                _token: $('meta[name="csrf-token"]').attr('content'),
            }

            $.ajax({
                data: data,
                type:'post',
                url:'/admin/user/ajax/search',
                success:function (data)
                {

                    if(data.length==0)
                    {
                        errorsHtml='<div class="alert alert-danger text-left"><ul><li>کاربری یافت نشد</li></ul></div>';
                        $('#show').html( errorsHtml );
                    }
                    else
                    {

                        for (i=0;i<data.length;i++)
                        {
                            users="<label for=\"exampleFormControlSelect1\">دانشجو را انتخاب کنید</label>" +
                                "<select class=\"form-control\" id=\"exampleFormControlSelect1\">";
                            $.each( data, function( key, value ) {
                                // var item="{'fname':'"+value.fname+"', 'lname':'"+value.lname+"', 'id':'"+value.id+"'}";
                                var item=JSON.stringify('{"name":"John", "age":30, "city":"New York"}');

                                users += ''+
                                    '<option value="'+value.id+'">'+
                                        value.fname+' '+value.lname+' '+value.tel+
                                    '</option>';
                            });
                            users=users+"</select>"
                        }
                        $('#show').html(users);
                    }

                },
                error : function(data)
                {

                    $('#show').text(data.responseJSON.errors);
                    errorsHtml='<div class="alert alert-danger text-left"><ul>';
                    $.each( data.responseJSON.errors, function( key, value ) {
                        errorsHtml += '<li>'+ value[0] + '</li>'; //showing only the first error.
                    });
                    errorsHtml += '</ul></div>';

                    $( '#show' ).html( errorsHtml );
                }
            })
        });

        // $('body').on('click','.students',function(){

        function getStudent(data)
        {


            console.log(data);
            console.log(JSON.parse(data));
        };

    </script>
@endsection
