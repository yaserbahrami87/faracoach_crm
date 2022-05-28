@extends('admin.master.index')
@section('content')
    <div class="col-xs-12 col-md-8 col-lg-8 col-xl-8">
        <div class="card-header bg-secondary">
            <h5 class="card-title text-light">تنظیمات کلینیک</h5>
        </div>
        <div class="card-body bg-secondary-light">
            <form method="post" action="/panel/coupon/{{$options}}" >
                {{csrf_field()}}
                {{method_field('PATCH')}}
                <div class="form-group">
                    <label for="coupon">متن توضیحات پیش از جلسه معارفه:<span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('coupon') is-invalid @enderror" id="coupon" name="coupon" value="{{old('coupon',$options)}}" />
                    <small class="text-muted">نام کوپن تخفیف را به انگلیسی وارد کنید</small>
                </div>
                <button type="submit" class="btn btn-primary">بروزرسانی</button>
            </form>
        </div>
    </div>
@endsection
