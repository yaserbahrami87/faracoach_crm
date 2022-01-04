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
                            <th class="text-center">قیمت</th>
                            <th class="text-center">درصد تخفیف</th>
                            <th class="text-center">قیمت نهایی</th>
                            <th> </th>
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
                                    {{$item->product}}
                                </td>


                                <td class="col-sm-1 col-md-1 text-center">
                                    <strong>{{number_format($item->fi) }}</strong>
                                </td>
                                <td class="col-sm-1 col-md-1 text-center">
                                    <strong>{{$item->off}}%</strong>
                                </td>
                                <td class="col-sm-1 col-md-1 text-center">
                                    <strong>{{number_format($item->final_off)}}</strong>
                                </td>
                                @php
                                    $sum_fi=$sum_fi+$item->fi;
                                    $sum_final_off=$sum_final_off+$item->final_off;
                                @endphp
                                <td class="col-sm-1 col-md-1">
                                    <form method="get" action="/cart/{{$item->id}}" onsubmit="return confirm('آیا از حذف زمان مطمئن هستید؟');">
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
                            <td colspan="3">   </td>
                            <td><span>جمع قیمت</span></td>
                            <td class="text-right"><h5><strong> {{number_format($sum_fi)}}</strong></h5></td>
                        </tr>
                        <tr>
                            <td colspan="3">   </td>
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
                                <form method="POST" action="/coupon/checkCoupon" class="d-inline-block">
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
                            <td colspan="3">  </td>
                            <td colspan="2">
                                <form method="post" action="/cart/payment">
                                    {{csrf_field()}}
                                    <button type="submit" class="btn btn-success btn-block">
                                        مرحله بعد<i class="bi bi-arrow-left-circle"></i>
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
        </div>
    </div>
@endsection
