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
                <th>نحوه برگزاری</th>
                <th>مدرس</th>
                <th>مبلغ پایه</th>
                <th>امتیاز بورسیه</th>
                <th>سهم پرداخت نقدی</th>
                <th>پیش پرداخت</th>
                <th>تسویه سهم نقدی</th>
            </tr>
            @if(!is_null($courses))
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
                                <button class="btn btn-primary btn-block">{{number_format(5000000)}} <br/>کلیک کنید  </button>
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
                    </tr>
                @endforeach
            @endif
        </table>
    </div>
</div>
@endif

