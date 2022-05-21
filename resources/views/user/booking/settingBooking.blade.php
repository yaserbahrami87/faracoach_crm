@extends('user.master.index')
@section('content')
    <div class="col-12 col-md-6">
        <form method="post" action="/panel/settings/booking/{{Auth::user()->coach->id}}">
            {{csrf_field()}}
            {{method_field('PATCH')}}
            <div class="form-group">
                <label for="type_holding">نوع برگزاری جلسه:  <span class="text-danger">*</span></label>
                <select class="form-control" id="type_holding" name="type_holding">
                    <option disabled selected>انتخاب کنید</option>
                    <option value="1" @if(old('type_holding',$settings->type_holding)==1) selected @endif>حضوری</option>
                    <option value="2" @if(old('type_holding',$settings->type_holding)==2) selected @endif>آنلاین</option>
                    <option value="0" @if(old('type_holding',$settings->type_holding)==0) selected @endif>هر دو</option>
                </select>
            </div>
            <div class="form-group">
                <label for="address">آدرس حضوری:</label>
                <input type="text" class="form-control" id="address" name="address" value="{{old('address',$settings->address)}}" />
            </div>
            <div class="form-group">
                <label for="online_platform">پلتفرم جلسه آنلاین:</label>
                <input type="text" class="form-control" id="online_platform" name="online_platform" value="{{old('online_platform',$settings->online_platform)}}" />
            </div>
            <div class="form-group">
                <label for="tel">شماره تماس نمایشی جهت هماهنگی های مراجع:</label>
                <input type="text" class="form-control" id="online_platform" name="tel" value="{{old('tel',$settings->tel)   }}" />
                <small class="text-muted">در صورت وارد نکردن شماره همراه شماره ای که با آن ثبت نام کرده اید نمایش داده خواهد شد</small>
            </div>
            <div class="form-group">
                <label for="today_meeting">جلسات روز جاری: <span class="text-danger">*</span></label>
                <small class="text-muted">روزهای جاری قابلیت رزرو برای مراجع را داشته باشد</small>
                <select class="form-control" id="today_meeting" name="today_meeting">
                    <option disabled selected>انتخاب کنید</option>
                    <option value="0" @if(old('today_meeting',$settings->today_meeting)==0) selected @endif>خیر رزرو نشود</option>
                    <option value="1" @if(old('today_meeting',$settings->today_meeting)==1) selected @endif>بلی رزرو شود</option>
                </select>
            </div>
            <label for="introduction_discount">تخفیف جلسات معارفه:<span class="text-danger">*</span></label>
            <div class="input-group">
                <input type="number" class="form-control" id="introduction_discount" name="introduction_discount" min="0" max="100" value="{{old('introduction_discount',$settings->introduction_discount)}}"/>
                <div class="input-group-prepend">
                    <span class="input-group-text" >%</span>
                </div>
            </div>
            <input type="submit" value="بروزرسانی" class="btn btn-success">
        </form>
    </div>
@endsection
