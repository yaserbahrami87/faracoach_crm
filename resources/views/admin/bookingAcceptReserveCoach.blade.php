@extends('admin.master.index')
@section('headerScript')

    <link href="{{asset('/dashboard/assets/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
    <style>
        a
        {
            color:#000000;
        }


        #colors span
        {
            width: 25px;
            height: 25px;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="row shadow-lg">
            <div class="col-12 m-5 border-bottom">
                <h3>لیست جلسات رزرو شده</h3>
            </div>
            <div class="col-12">
                <div id="app" class="col-md-4">
                    <form method="get" action="/admin/booking/accept" id="formBooking">
                        {{csrf_field()}}
                        <date-picker
                            type="date"
                            v-model="dates"
                            range
                            format="jYYYY-jMM-jDD"
                            display-format="jYYYY/jMM/jDD"
                            name="start_date"
                            id="start_date"
                        ></date-picker>
                        <!--
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="type" id="inlineRadio1" value="رزرو شده">
                            <label class="form-check-label" for="inlineRadio1">رزرو شده</label>
                        </div>
                        -->
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="type" id="inlineRadio2" value="روز برگزاری">
                            <label class="form-check-label" for="inlineRadio2">روز برگزاری</label>
                        </div>
                        <button type="submit" class="btn btn-success">بگرد</button>
                    </form>
                </div>
            </div>


            <div class="col-12" id="colors">
                <div class="row">
                    <div class="col-6 col-sm-1 col-lg-1 col-md-1 col-xl-1 text-center p-0 m-0">
                        <span class="d-inline-block bg-success rounded-circle" ></span>
                    </div>
                    <div class="col-6 col-sm-11 col-lg-2 col-md-2 col-xl-2 p-0 m-0">
                        <p class=" p-0 m-0"> جلسات برگزار شده</p>
                    </div>
                    <div class="col-6 col-sm-1 col-lg-1 col-md-1 col-xl-1 text-center p-0 m-0">
                        <span class="d-inline-block bg-warning rounded-circle" ></span>
                    </div>
                    <div class="col-6 col-sm-11 col-lg-2 col-md-2 col-xl-2 p-0 m-0">
                        <p class=" p-0 m-0"> جلسات رزرو شده بلاتکلیف</p>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <table class="dataTable table table-striped table-bordered" style="width:100%">
                    <thead>
                    <tr>
                        <th>کوچ</th>
                        <th>مراجع</th>
                        <th>نوع جلسه</th>
                        <th>تاریخ</th>
                        <th>ساعت</th>
                        <th>پیش جلسه</th>
                        <th>ارزیابی</th>
                        <th>وضعیت</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($booking as $item)
                            <tr class="@if($item->status==0) bg-warning @elseif($item->status==4) bg-success @endif">
                                <td>
                                    <a href="/admin/booking/{{$item->id}}/showadminbooking">
                                         {{$item->coach['user']['fname'].' '.$item->coach->user['lname'] }}
                                    </a>
                                </td>
                                <td>
                                    <a href="/admin/booking/{{$item->id}}/showadminbooking">

                                    {{$item->reserve['user']['fname'].' '.$item->reserve['user']['lname'] }}
                                    </a>
                                </td>
                                <td></td>
                                <td>{{$item->start_date}}</td>
                                <td>{{$item->start_time}}</td>
                                <td>
                                    @if(is_null($item->feedback_coachings_id))
                                        <i class="bi bi-x-lg" ></i>
                                    @else
                                        <i class="bi bi-check-lg" ></i>
                                    @endif
                                </td>
                                <td>
                                    @if(is_null($item->presession))
                                        <i class="bi bi-x-lg"></i>
                                    @else
                                        <i class="bi bi-check-lg"></i>
                                    @endif
                                </td>
                                <td>
                                    @if($item->start_date>$dateNow)
                                        <form class="d-inline-block" method="POST" action="/booking/{{$item->booking_id}}" onsubmit="return confirm('آیا از لغو جلسه اطمینان دارید؟')">
                                            {{csrf_field()}}
                                            {{method_field('PATCH')}}
                                            <input type="hidden" name="status" value="4" />
                                            <button type="submit" class="btn btn-danger">
                                                لغو جلسه
                                            </button>
                                        </form>

                                    @endif
                                </td>
                            </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection


@section('footerScript')
    <script src="{{asset('/dashboard/assets/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('/dashboard/assets/js/dataTables.bootstrap4.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('.dataTable').DataTable();
        } );
    </script>

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
            }

        });


    </script>
@endsection
