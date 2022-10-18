@if(!is_null($scholarship->financial))
    <div class="col-12 mx-auto">
        <div class="alert alert-success">
            {{Auth::user()->fname.' '.Auth::user()->lname}} عزیز شما با کد رهگیری {{$scholarship->financial}} پیش پرداخت دوره را انجام داده اید.
        </div>
    </div>
@else
<div class="row">
    <div class="col-12 border shadow shadow-sm mb-3">
        <p>{{Auth::user()->fname.' عزیز '}} ،  بابت رسیدن  به این  مرحله از بورسیه  بهت  تبریک  میگیم .</p>
        <p class="text-justify">هر کدوم از مراحل بورسیه شامل یک امتیاز مشخص هست که با تکمیل پروفایل ، حضور در دوره آموزشی ، انجام آزمون ، ارسال معرفی نامه و معرفی دوستان به بورسیه و در نهایت مصاحبه، امتیاز مد نظر رو کسب کردی . </p>
        <p class="text-justify">جدول زیر نشون دهنده امتیازی هست که تو از بورسیه بدست آوردی و مطابق با اون از تخفیف ویژه دوره برخوردار شدی . </p>
        <ul>
            <li>در جدول، مبلغ پایه دوره قیمت اولیه ست .</li>
            <li>ستون امتیاز بورسیه شامل مجموع امتیازاتی ست که از تمام مراحل بورسیه کسب کردین .</li>
            <li>مبلغ نهایی شامل هزینه ای است که شما برای ثبت نام دوره متناسب با درصد کسب شده از بورسیه ، پرداخت میکنین .</li>
        </ul>
        <p class="text-justify">و نهایتا ستون پیش پرداخت که پرداخت اولیه شماست و پرداخت دوم که یک ماه بعد از پرداخت اولیه انجام میشه .</p>
        <p class="text-justify font-weight-bold">توجه : وام بلاعوض صندوق شکوفایی موسسه به افرادی تعلق میگیره که امتیاز بورسیه بالای 50 درصد رو کسب کردن و معادل 10 درصد ، از تعهد همکاری کسر میشه .</p>
        <p>برای تکمیل این مرحله و ثبت نام قطعی در دوره ، با انتخاب گزینه پیش پرداخت ، واریز اولیه رو انجام بده تا به عنوان یکی از پذیرفته شدگان طرح بورسیه رزروت قطعی بشه .</p>
        <p>به دلیل مشکلات ناشی از قطعی اینترنت  برنامه هامون کمی با  تاخیر مواجه شد  که  مطمئنا درک میکنی ،  اما صمیمانه و با افتخار در کنارت هستیم.</p>


    </div>
    <div class="col-12 table-responsive">
        <table class="table table-striped  table-bordered text-center">
            <tr>
                <td colspan="3" class="p-2">اطلاعات دوره</td>
                <td colspan="7" class="p-2">محاسبه بورسیه</td>
            </tr>
            <tr>
                <th>عنوان دوره</th>
                <th>نحوه برگزاری</th>
                <th>مدرس</th>
                <th>مبلغ پایه</th>
                <th>امتیاز بورسیه</th>
                <th>سهم پرداخت نقدی</th>
                <th>پیش پرداخت</th>
                <th>قسط دوم</th>
                <th>موعد قسط دوم</th>
                <th>جزئیات</th>
            </tr>
            @if(!is_null($courses))
                @foreach($courses as $item)
                    <tr>
                        <td class="text-center">
                            {{$item->course}}
                        </td>
                        <td class="text-center">
                            @if($item->type_course==1)
                                انلاین
                            @elseif($item->type_course==2)
                                حضوری
                            @endif

                        </td>
                        <td>
                            {{$item->teacher->fname.' '.$item->teacher->lname}}
                        </td>
                        <td class="text-center">
                            {{number_format($item->fi_off)}}
                        </td>
                        <td class="text-center">
                            {{$result_final}}%
                        </td>
                        <td>
                            @php
                                $gheymat_nahaei=($item->fi_off-(($item->fi_off*$result_final)/100));
                            @endphp

                            {{number_format($gheymat_nahaei)}}
                        </td>
                        <td class="text-center">
                            <form method="post" action="/panel/scholarship_payment">
                                {{csrf_field()}}
                                <input type="hidden" value="{{$item->id}}" name="course_id" />
                                <button class="btn btn-primary btn-block">{{number_format(5000000)}} <br/>پرداخت کنید  </button>
                            </form>
                        </td>
                        <td class="text-center">
                            @php
                                $pardakht_dovom=$gheymat_nahaei-5000000
                            @endphp
                            @if($pardakht_dovom<=0)
                                @php
                                    $pardakht_dovom=0;
                                @endphp
                            @endif
                            {{number_format($pardakht_dovom) }}
                        </td>
                        <td>
                            {{$nextMonth}}
                        </td>
                        <td>
                            <a href="" class="btn btn-primary" data-toggle="modal" data-target="#ModalPaymentCourse{{$item->id}}">جزئیات پرداخت</a>
                            <!-- Modal -->
                            <div class="modal fade" id="ModalPaymentCourse{{$item->id}}" tabindex="-1" aria-labelledby="ModalPaymentCourse{{$item->id}}Label" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">اطلاعات صندوق شکوفایی</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <img src="{{(asset('/images/'.$item->image))}}" class="img-fluid" />
                                                        @php
                                                            $boorsieh=($item->fi_off*$result_final)/100;
                                                        @endphp
                                                        <table class="table table-bordered">
                                                            <tr >
                                                                <td class="p-2">مبلغ تعهد همکاری</td>
                                                                <td class="p-2">{{number_format($boorsieh)}} تومان </td>
                                                            </tr>
                                                            <tr>
                                                                @if($result_final<50)
                                                                    <td class="p-2" >کسر 0% وام صندوق شکوفایی فراکوچ به ارزش</td>
                                                                    <td class="p-2" >{{number_format(($boorsieh*0)/100)  }} تومان </td>
                                                                @else
                                                                    <td class="p-2" >کسر 10% وام صندوق شکوفایی فراکوچ به ارزش</td>
                                                                    <td class="p-2" >{{number_format(($boorsieh*10)/100)  }} تومان </td>
                                                                @endif

                                                            </tr>
                                                            <tr>
                                                                <td class="p-2" >مبلغ نهایی تعهد همکاری</td>
                                                                @if($result_final<50)
                                                                    <td class="p-2" >{{number_format($boorsieh-(($boorsieh*0)/100))}} تومان</td>
                                                                @else
                                                                    <td class="p-2" >{{number_format($boorsieh-(($boorsieh*10)/100))}} تومان</td>
                                                                @endif
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @endif
        </table>
    </div>
    <div class="col-12" id="show_payment_scholarship">

    </div>

</div>
@endif

