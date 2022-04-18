@extends('user.master.index')
@section('content')
    <?php
//    $roozha="'Sunday','Friday'";
    $roozha="";
    ?>

    @if(Auth::user()->status_coach==1)
        <div id="app" class="col-md-4">
           <!--  @{{message}}
            @{{dates}}
            @{{time}}-->

        <!-- <date-picker :disable="['1397/05/07', '1397/05/08', 'Friday']" /> -->
            <p>اختصاص وقت جدید</p>
            <form method="post" action="/panel/booking" id="formBooking">
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

                <div class="form-check form-check-inline pr-3">
                    <input class="form-check-input" type="radio" name="duration_booking" id="duration_booking1" value="1">
                    <label class="form-check-label" for="duration_booking1">معارفه 30 دقیقه ای</label>
                </div>
                <div class="form-check form-check-inline text-left">
                    <input class="form-check-input" type="radio" name="duration_booking" id="duration_booking2" value="2">
                    <label class="form-check-label" for="duration_booking2">کوچینگ 60 دقیقه ای</label>
                </div>


                <button type="submit" class="btn btn-success">ایجاد رزرو</button>
            </form>
        </div>
    @endif


    <div class="col-md-12 mt-3 table-responsive">
        <table class="table border table-hover table-striped">
            <tr>
                <th></th>
                <th>کد جلسه</th>
                <th scope="col">تاریخ شروع</th>
                <th scope="col">ساعت شروع</th>
                <th scope="col">ساعت پایان</th>
                <th scope="col">مدت جلسه</th>
                @if(Auth::user()->status_coach==1)
                    <th scope="col">وضعیت</th>
                @endif
                @if(Auth::user()->status_coach==1)
                    <th scope="col">حذف</th>
                @else
                    <th>لغو جلسه</th>
                @endif
            </tr>

            @foreach($booking as $item)

                @switch($item['status'])
                    @case('1')   <tr class="table-warning">
                                @break
                    @case('0')   <tr class="table-success">
                                @break
                    @case('4')   <tr class="table-danger">
                                @break
                    @default    <tr>
                                @break
                @endswitch

                    <td>
                        <img src="{{asset('/documents/users/'.$item->user['personal_image'])}}" class="img-circle"  width="50px" height="50px"/>
                    </td>
                    <td class="text-center">
                        @if($item->status==1  || ($item->caption_status=='باطل شده'))
                            {{$item->id}}
                        @else
                            <a href="/panel/booking/{{$item->id}}">{{$item->id}}</a>
                        @endif
                    </td>
                    <td class="text-center">

                        @if(Auth::user()->status_coach==1 )

                            @if($item->status==1  || ($item->caption_status=='باطل شده'))
                                {{$item->start_date}}
                            @else
                                <a href="/panel/booking/{{$item->id}}">{{$item->start_date}}</a>
                            @endif
                        @else
                            <a href="/panel/booking/{{$item->id}}">{{$item->booking->start_date}}</a>
                        @endif
                    </td>
                    <td class="text-center">{{$item->start_time}}</td>
                    <td class="text-center">{{$item->end_time}}</td>
                    <td class="text-center">{{$item->duration_booking}}</td>
                    @if(Auth::user()->status_coach==1)
                        <td>{{$item->caption_status}}</td>
                    @endif

                    @if((($item->start_date>$dateNow && Auth::user()->status_coach==1) && (($item['status'])!=0)&&($item['status']!=4)))
                        <td>
                            <form method="post" action="/panel/booking/{{$item->id}}" onsubmit="return confirm('آیا از حذف زمان رزرو اطمینان دارید؟');">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button  class="btn btn-danger" type="submit">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </form>
                        </td>
                    @elseif($item->start_date>$dateNow && ($item['status']!=4))
                        <td>
                            <form method="POST" action="/panel/booking/{{$item->id}}" onsubmit="return confirm('آیا از لغو جلسه اطمینان دارید؟')">
                                {{csrf_field()}}
                                {{method_field('PATCH')}}
                                <input type="hidden" name="status" value="4" />
                                <button type="submit" class="btn btn-danger">لغو جلسه
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            </form>
                        </td>
                    @endif
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
