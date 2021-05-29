<div class="col-12 mt-3 border-top pt-3">
    <p>برای رزرو زمان مشخص شده لطفا فرم زیر را پر کنید</p>
    <form method="post" action="/{{$booking->id}}" id="reserveForm">
        {{csrf_field()}}
        <div class="alert alert-info text-center" role="alert">
            تاریخ {{$booking->start_date}} در ساعت {{$booking->start_time}} تا {{$booking->end_time}}
        </div>
        <input type="hidden" value="{{$booking->id}}" name="booking_id">
        <div class="form-group">
            <label for="subject">موضوع جلسه درخواستی:*</label>
            <input type="text" class="form-control form-control-lg" id="subject"  name="subject" placeholder="لطفا در مورد هر موضوع خلاصه ای یک سطری بنویسید" />
            <small>لطفا در مورد هر موضوع خلاصه ای یک سطری بنویسید</small>
        </div>
        <div class="form-group">
            <label for="type_coach">نوع جلسه*</label>
            <select class="form-control form-control-lg" id="type_coach" name="type_booking">
                <option disabled selected>انتخاب کنید</option>
                <option value="1">حضوری</option>
                <option value="2">آنلاین</option>
                <option value="0">فرقی ندارد</option>
            </select>
        </div>
        <div class="form-group">
            <label for="details">توضیحات</label>
            <textarea class="form-control form-control-lg" id="details" rows="3" name="details"></textarea>
        </div>
        <button type="button" class="btn btn-primary btn-lg btn-block " id="mohasebe">محاسبه هزینه</button>
        <div class="card" >
            <div class="card-body" id="div_mohasebe">

            </div>
        </div>
    </form>
</div>
<script>
    $('#mohasebe').click(function()
    {
        var loading = '<div class="col-12 text-center"><div class="spinner-border text-primary text-center" role="status"><span class="sr-only">Loading...</span></div></div>';
            $("#div_mohasebe").html(loading);
            var data=$('#reserveForm').serialize();
            $.ajax({
                type: 'POST',
                url: "/booking/mohasebe" ,
                data:data,
                statusCode: {
                    422: function() {
                        $("#div_mohasebe").html('<div class="alert alert-danger" role="alert">لطفا تمامی فیلدها رو پر کنید</div>');
                    },
                    500:function()
                    {
                        $("#div_mohasebe").html("خطا 500");
                    }
                },
                success: function (data) {
                        $("#div_mohasebe").html(data);
                },
                error:function(data)
                {
                    $("#div_mohasebe").html(data);
                }
            });


    });
</script>
