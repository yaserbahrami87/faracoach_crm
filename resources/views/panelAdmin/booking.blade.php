@extends('panelAdmin.master.index')
@section('rowcontent')
    <?php
    $roozha="'Sunday','Friday'";
    ?>

    <div id="app" class="col-md-4">
       <!--  @{{message}}
        @{{dates}}
        @{{time}}-->

    <!-- <date-picker :disable="['1397/05/07', '1397/05/08', 'Friday']" /> -->
        <p>ایجاد رزرو جدید</p>
        <form method="post" action="/admin/booking" id="formBooking">
            {{csrf_field()}}
            <date-picker
                type="date"
                v-model="dates"
                multiple
                format="jYYYY-jMM-jDD"
                display-format="jYYYY/jMM/jDD"
                :disable="[{{$roozha}}]"
                name="start_date"
                min="{{$dateNow}}"
            ></date-picker>

            <date-picker
                v-model="time"
                type="time"
                jump-minute="10"
                :round-minute=true
                name="start_time"
            ></date-picker>
            <select class="custom-select" name="duration_booking">
                <option selected disabled>نوع جلسه مشخص شود</option>
                <option value="1">معارفه 30 دقیقه ای</option>
                <option value="2">کوچینگ 60 دقیقه ای</option>
            </select>
            <button type="submit" class="btn btn-success">ایجاد رزرو</button>
        </form>
    </div>


    <div class="col-md-12 mt-3">
        <table class="table border table-hover table-striped">
            <tr>
                <th scope="col">#</th>
                <th scope="col">تاریخ شروع</th>
                <th scope="col">ساعت شروع</th>
                <th scope="col">تاریخ پایان</th>
                <th scope="col">ساعت پایان</th>
                <th scope="col">مدت جلسه</th>
                <th scope="col">وضعیت</th>
                <th scope="col">ویرایش</th>
                <th scope="col">حذف</th>
            </tr>
            @foreach($booking as $item)

                @switch($item['status'])
                    @case('1')   <tr class="table-warning">
                                @break
                    @case('2')   <tr class="table-success">
                                @break
                    @case('3')   <tr class="table-danger">
                                @break
                    @default    <tr>
                                @break
                @endswitch

                    <td>#</td>
                    <td>{{$item->start_date}}</td>
                    <td>{{$item->start_time}}</td>
                    <td>{{$item->end_date}}</td>
                    <td>{{$item->end_time}}</td>
                    <td>{{$item->duration_booking}}</td>
                    <td>{{$item->caption_status}}</td>
                    <td></td>
                    <td></td>
                </tr>
            @endforeach
        </table>
        {{$booking->links()}}
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
                message:'asdasdasd'
            }

        });


    </script>



@endsection
