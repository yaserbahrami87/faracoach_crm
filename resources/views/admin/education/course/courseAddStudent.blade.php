@extends('admin.master.index')

@section('headerScript')
    <script src="{{asset('/panel_assets/intl_tel/js/intlTelInput.js')}}"></script>
    <script src="{{asset('/panel_assets/intl_tel/js/utils.js')}}"></script>
@endsection
@section('content')
    <div class="col-6">
        <form>
            <div class="form-group">
                <label for="user">جستجو کاربر:</label>
                <input id="user" type="text" class="form-control @error('user') is-invalid @enderror"  value="{{ old('user') }}" required />
            </div>
            <div id="show"></div>
            <div class="form-group">
                <label for="tel">تاریخ ثبت نام:</label>
                <input type="text" class="form-control" id="tel" />
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
            </div>


            <button type="submit" class="btn btn-primary">اضافه</button>
        </form>
    </div>
@endsection

@section('footerScript')
    <script>

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
                            users="<table class='table table-striped'>";
                            $.each( data, function( key, value ) {
                                users += '<tr>' +
                                    '           <td>' +
                                    '                   <img src="/documents/users/'+ value.personal_image + '" width=50px height="50px" class="rounded-circle" />' +
                                    '           </td>' +
                                    '           <td>'+ value.fname + '</td>' +
                                    '           <td>'+ value.lname + '</td>' +
                                    '           <td>' +
                                    '               <button type="button" class="btn btn-primary students" data="'+value+'" >انتخاب</button>' +
                                    '           </td>' +
                                    '</tr>';
                            });
                            users=users+"</table>"
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

        function detailsStudent(student)
        {
            alert(student);
        }
    </script>
@endsection
