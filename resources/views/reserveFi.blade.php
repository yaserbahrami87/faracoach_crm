@if($status==true)
    <div class="alert alert-success">کوپن تخفیف اعمال شد</div>
@else
    <div class="alert alert-danger">خطا در اعمال کوپن تخفیف</div>
@endif


    <span class="float-right">قیمت </span>
    <span class="float-left">100 هزارتومان</span>
    <br/>
    <span class="float-right">کوپن تخفیف </span>
    <span class="float-left">{{$reserve->coupon}} </span>
    <br/>
    <span class="float-right">کد تخفیف </span>
    <span class="float-left">{{$reserve->off}} %</span>
    <br/>
    <span class="float-right">قیمت نهایی</span>
    <span class="float-left">{{number_format($reserve->final_off) }} تومان</span>
