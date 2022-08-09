@extends('admin.master.index')

@section('headerScript')
    <link rel="stylesheet" href="{{asset('/css/bootstrap-multiselect.min.css')}}" type="text/css"/>
@endsection
@section('content')
    <div class="col-12">
        <form>
            <div class="row">
                <div class="col-3">
                    <div class="input-group is-invalid">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="gender">جنسیت</label>
                        </div>
                        <select class="custom-select selectpicker" id="gender" name="gender" multiple>
                            <option value="1">مرد</option>
                            <option value="0">زن</option>
                        </select>
                    </div>
                </div>
                <div class="col-3">
                    <div class="input-group is-invalid">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="married">تاهل</label>
                        </div>
                        <select class="custom-select selectpicker" id="married" name="married" multiple>
                            <option value="0">مجرد</option>
                            <option value="1">متاهل</option>
                        </select>
                    </div>
                </div>
                <div class="col-3">
                    <div class="input-group is-invalid">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="state">استان</label>
                        </div>
                        <select class="custom-select selectpicker"  id="state" name="state" multiple>
                            <option >همه استانها</option>
                            <option value="1">مرد</option>
                        </select>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="instagram" id="instagram">
                        <label class="form-check-label" for="instagram">
                            اینستاگرام داشته باشد
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="telegram" id="telegram">
                        <label class="form-check-label" for="telegram">
                            تلگرام داشته باشد
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="linkedin" id="linkedin">
                        <label class="form-check-label" for="linkedin">
                            لینکدین داشته باشد
                        </label>
                    </div>
                </div>

                <div class="col-3">
                    <div class="input-group is-invalid">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="education">تحصیلات</label>
                        </div>
                        <select class="custom-select selectpicker" multiple="multiple" id="education" name="education" >
                            <option>زیردیپلم</option>
                            <option>دیپلم</option>
                            <option>فوق دیپلم</option>
                            <option>لیسانس</option>
                            <option>فوق لیسانس</option>
                            <option>دکتری و بالاتر</option>
                        </select>
                    </div>
                </div>
                <div class="col-3">
                    <div class="input-group is-invalid">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="gettingknow_parent">تحصیلات</label>
                        </div>
                        <select class="custom-select" id="gettingknow_parent" name="gettingknow_parent">
                            <option disabled selected>انتخاب کنید</option>
                            <option>1</option>

                        </select>
                    </div>
                </div>
                <div class="col-3">

                    <div class="input-group mr-sm-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">@</div>
                        </div>
                        <input type="text" class="form-control" id="inlineFormInputGroupUsername2" placeholder="Username">
                    </div>
                </div>

            </div>
        </form>
    </div>
@endsection

@section('footerScript')
    <script src="{{asset('/js/bootstrap-multiselect.min.js')}}"></script>
    <script type="text/javascript">
        $(function () {
            $('.selectpicker').multiselect();
        });
    </script>
@endsection
