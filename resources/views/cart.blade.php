@extends('master.index')
@section('row1')
    <div class="container mt-5">
        <div class="row">
            <div class="col-sm-12 col-md-10 col-md-offset-1 table-responsive bg-light">
                @if($cart->count()>0)
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>محصول</th>

                            <th class="text-center">
                                قیمت
                                <small class="text-muted d-block">تومان</small>
                            </th>
                            <th class="text-center">
                                تخفیف
                                <small class="text-muted d-block">%/نقد</small>
                            </th>
                            <th class="text-center">
                                قیمت نهایی
                                <small class="text-muted d-block">تومان</small>
                            </th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $sum_fi=0;
                            $sum_final_off=0;
                        @endphp

                        @foreach($cart as $item)

                            <tr>
                                <td class="col-sm-8 col-md-6">
                                    <div class="media">
                                        <div class="media-body">

                                            @if($item->duration_booking==1)
                                                <span>جلسه معارفه</span>
                                            @elseif($item->duration_booking==2)

                                                <span>جلسه کوچینگ</span>
                                            @endif
                                                <span>ساعت{{$item->booking->start_time}} در تاریخ {{$item->booking->start_date}}</span>
                                            <h4 class="media-heading"><a href="#"></a></h4>
                                            <p class="media-heading"> کوچ <a href="/coach/{{$item->booking->coach->user->username}}">{{$item->booking->coach->user->fname." ".$item->booking->coach->user->lname}}</a></p>
                                        </div>
                                    </div></td>


                                <td class="col-sm-1 col-md-1 text-center">
                                    <strong>{{number_format($item->fi) }}</strong>
                                </td>
                                <td class="col-sm-1 col-md-1 text-center">
                                    <strong>{{$item->off}}</strong>
                                    <small>{{$item->type_discount }}</small>
                                </td>
                                <td class="col-sm-1 col-md-1 text-center">
                                    <strong>{{number_format($item->final_off)}} تومان</strong>
                                </td>
                                @php
                                    $sum_fi=$sum_fi+$item->fi;
                                    $sum_final_off=$sum_final_off+$item->final_off;
                                @endphp
                                <td class="col-sm-1 col-md-1">
                                    <form method="post" action="/reserve/{{$item->reserves_id}}" onsubmit="return confirm('آیا از حذف زمان مطمئن هستید؟');">
                                        {{csrf_field()}}
                                        {{method_field('DELETE')}}
                                        <button type="submit" class="btn btn-danger">
                                            <i class="bi bi-x-lg"></i> حذف
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                        <tr>
                            <td colspan="3">  </td>
                            <td><span>جمع قیمت</span></td>
                            <td class="text-right"><h5><strong> {{number_format($sum_fi)}}</strong></h5></td>
                        </tr>
                        <tr>
                            <td colspan="3">  </td>
                            <td><span>قیمت نهایی</span></td>
                            <td class="text-right">
                                <h5>
                                    <strong>{{number_format($sum_final_off)}}</strong>
                                </h5>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">کد تخفیف</td>
                            <td colspan="3">
                                <form method="POST" action="/coupon/checkoff" class="d-inline-block">
                                    {{csrf_field()}}
                                    <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <button class="btn btn-outline-secondary" type="submit" id="button-addon1">اعمال</button>
                                            </div>
                                            <input type="text" class="form-control" placeholder="کد تخفیف" aria-label="Example text with button addon" aria-describedby="button-addon1" name="coupon" />
                                    </div>
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">  </td>
                            <td>
                                <form method="POST" action="/reserve/insert">
                                    {{csrf_field()}}
                                    <button type="submit" class="btn btn-success btn-block">
                                        ثبت <span class="glyphicon glyphicon-play"></span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                @else
                    <div class="alert alert-warning">
                        سبد خرید شما خالی است
                    </div>
                @endif
            </div>
            <div class="col-12">
                asdasdasdasd
            </div>
        </div>
    </div>
@endsection
