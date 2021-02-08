@extends('panelAdmin.master.index')
@section('rowcontent')
    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
        <form method="post" action="/admin/sms/">
            {{csrf_field()}}
            <div class="form-group">
                <label for="tel_recieves">شماره تلفن ها</label>
                <input type="text" class="form-control" id="tel_recieves" name="tel_recieves" />
                <small class="text-muted">به عنوان مثال: 09121234567,09151234567</small>
            </div>
            <div class="form-group">
                <label for="categories" >دسته بندی</label>
                <select class="form-control  p-0" id="categories" name="categories[]" multiple>
                    <option disabled="disabled  p-0" selected>انتخاب کنید</option>
                    @foreach($categories as $item)
                        <option value="{{$item->detailsresource}}">{{$item->resource}} {{$item->detailsresource}}</option>
                    @endforeach
                </select>
            </div>
            <div class="row" id="filters">
                <div class="form-group col-sm-12 col-md-4 col-lg-4 col-xl-4 " >
                    <label for="fields">فیلد</label>
                    <select class="form-control  p-0" id="fields" name="fields[]">
                        <option disabled="disabled  p-0" selected>انتخاب کنید</option>
                        <option value="fname">نام</option>
                        <option value="lname">نام خانوادگی</option>
                        <option value="state">استان</option>
                        <option value="city">شهر</option>
                        <option value="email">پست الکترونیکی</option>
                        <option value="datebirth">تاریخ تولد</option>
                        <option value="sex">جنسیت</option>
                        <option value="tel">تلفن همراه</option>
                        <option value="born">متولد</option>
                        <option value="education">تحصیلات</option>
                    </select>
                </div>
                <div class="form-group col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <label for="comparison" >مقایسه</label>
                    <select class="form-control  p-0" id="comparison" name="comparison[]">
                        <option disabled="disabled  p-0" selected>انتخاب کنید</option>
                        <option>=</option>
                        <option><></option>
                        <option><</option>
                        <option> > </option>
                    </select>
                </div>
                <div class="form-group col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <label for="values">مقدار</label>
                    <input type="text" class="form-control" id="values" name="values[]" />
                </div>
            </div>
            <div id="add_fileds" class="row"></div>
            <button class="btn btn-primary" type="button" id="btn_fileds">+</button>

            <div class="form-group">
                <label for="comment" >متن پیامک</label>
                <textarea class="form-control" id="comment" rows="3" name="comment"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">ارسال پیامک</button>

        </form>
    </div>
@endsection
