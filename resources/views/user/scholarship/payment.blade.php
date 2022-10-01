@if(!is_null($scholarship->financial))
    <div class="col-12 mx-auto">
        <div class="alert alert-success">
            {{Auth::user()->fname.' '.Auth::user()->lname}} عزیز شما با کد رهگیری {{$scholarship->financial}} پیش پرداخت دوره را انجام داده اید.
        </div>
    </div>
@else
<div class="row">
    <div class="col-12 table-responsive">
        <table class="table table-striped  table-bordered text-center">
            <tr>
                <th>عنوان دوره</th>
                <th>نوع دوره</th>
                <th>مدرس</th>
                <th>قیمت</th>
                <th class="text-success">وام بلاعوض صندوق شکوفایی فراکوچ</th>
                <th>قیمت نهایی</th>
                <th>امتیاز بورسیه</th>
                <th>مبلغ بورسیه</th>
                <th>قابل پرداخت</th>
                <th>پیش پرداخت</th>
                <th>پرداخت دوم</th>

            </tr>
            @foreach($courses as $item)
                <tr>
                    <td class="text-center">{{$item->course}}</td>
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
                    <td class="text-center text-success">10%</td>
                    <td class="text-center">
                        @php
                            $gheymat_nahaei=($item->fi_off-($item->fi_off*10)/100);
                        @endphp

                        {{number_format($gheymat_nahaei)}}
                    </td>
                    <td class="text-center">
                        {{$result_final}}%
                    </td>
                    <td class="text-center">
                        @php
                            $boorsieh=$gheymat_nahaei*$result_final/100;
                        @endphp
                        {{number_format($boorsieh) }}
                    </td>
                    <td class="text-center">
                        {{number_format($gheymat_nahaei-$boorsieh)}}
                    </td>
                    <td class="text-center">
                        <form method="post" action="/panel/scholarship_payment">
                            {{csrf_field()}}
                            <input type="hidden" value="{{$item->id}}" name="course_id" />
                            <button class="btn btn-primary">{{number_format(5000000)}}</button>
                        </form>
                    </td>
                    <td class="text-center">
                        @php
                            $pardakht_dovom=($gheymat_nahaei-$boorsieh)-5000000
                        @endphp
                        @if($pardakht_dovom<=0)
                            @php
                              $pardakht_dovom=0;
                            @endphp
                        @endif
                        {{number_format($pardakht_dovom) }}
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</div>
@endif

