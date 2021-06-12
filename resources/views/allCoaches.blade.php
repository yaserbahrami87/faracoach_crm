@extends('master.index')
@section('row1')
    <div class="col-12 mt-5">
        <div class="row">
            <div class="col-12 border-bottom mb-4">
                <h3>لیست کوچ های فراکوچ</h3>
            </div>
            <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3">
                <div class="card mb-3" >
                    <div class="card-header bg-info text-light">جستجو</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="search">جستجوی کوچ:</label>
                            <input type="text" class="form-control" id="search" placeholder="نام خانوادگی را وارد کنید">
                        </div>
                        <button class="btn btn-success btn-block">فیلتر کن</button>

                    </div>
                </div>
                <div class="card mb-3" >
                    <div class="card-header bg-info text-light">فیلترها</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="categoryCoaches">دسته بندی کوچ ها</label>
                            <select class="form-control" id="categoryCoaches" name="categoryCoaches">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                        <label>جنسیت:</label>
                        <div class="form-group">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline1" name="customRadioInline" class="custom-control-input">
                                <label class="custom-control-label" for="customRadioInline1">آقا</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline2" name="customRadioInline" class="custom-control-input">
                                <label class="custom-control-label" for="customRadioInline2">خانم</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline3" name="customRadioInline" class="custom-control-input">
                                <label class="custom-control-label" for="customRadioInline3">فرقی ندارد</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="experience_time">حداقل ساعت سابقه کوچ</label>
                            <small id="total_experience_time"></small>
                            <input type="range" class="custom-range" id="experience_time" min="10" max="200" step="5">
                        </div>
                        <button class="btn btn-success btn-block">فیلتر کن</button>

                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-9 col-lg-9 col-xl-9">
                <div class="row">
                    @foreach($coaches as $item)
                        <div class="col-xs-12 col-sm-4 col-lg-3 col-xl-3  box-products ">
                            <div class="card p-1 text-center d-block shadow">
                                <img src="{{asset('/documents/users/'.$item->personal_image)}}" class="img-circle" alt="..." width="150px">
                                <div class="card-body  text-center">
                                    <p class="text-bold">{{$item->fname}} {{$item->lname}}</p>
                                    <a href="/coach/{{$item->username}}" class="btn btn-primary btn-sm" >مشاهده اطلاعات </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection



@section('footerScript')
    <script>
        $("#experience_time").change(function()
        {
            $('#total_experience_time').html($(this).val());

        });
    </script>
@endsection

