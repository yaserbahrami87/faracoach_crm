@extends('master.index')
@section('row1')
    <div class="col-12 mt-5">
        <div class="row">
            <div class="col-12 border-bottom mb-4">
                <h3>لیست کوچ های فراکوچ</h3>
            </div>
            <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 border-left">
                <div class="card mb-3" >
                    <div class="card-header bg-info text-light">جستجو</div>
                    <div class="card-body">
                        <form method="get" action="/coaches/all/">
                            <div class="form-group">
                                <label for="search">جستجوی کوچ:</label>
                                <input type="text" class="form-control" id="search" placeholder="نام خانوادگی را وارد کنید" name="q">
                            </div>
                            <button class="btn btn-success btn-block" type="submit" name="search">فیلتر کن</button>
                        </form>
                    </div>
                </div>
                <div class="card mb-3" >
                    <div class="card-header bg-info text-light">فیلترها</div>
                    <div class="card-body">
                        <form method="get" action="/coaches/all/">
                            <div class="form-group">
                                <label for="categoryCoaches">دسته بندی کوچ ها</label>
                                <select class="form-control" id="categoryCoaches" name="categoryCoaches">
                                    <option disabled selected>انتخاب کنید</option>
                                    @foreach($category_coaches as $item)
                                        <option value="{{$item->id}}">{{$item->category}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <label>جنسیت:</label>
                            <div class="form-group">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInline1" name="gender" class="custom-control-input" value="1">
                                    <label class="custom-control-label" for="customRadioInline1">آقا</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInline2" name="gender" class="custom-control-input" value="2">
                                    <label class="custom-control-label" for="customRadioInline2">خانم</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success btn-block" name="filterCoach">فیلتر کن</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-9 col-lg-9 col-xl-9">
                <div class="row">
                    @if($coaches->count()==0)
                        <div class="alert alert-warning col-12">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                            </svg>
                            موردی برای نمایش پیدا نشد
                        </div>
                    @else
                        @foreach($coaches as $item)
                            <div class="col-xs-12 col-sm-4 col-lg-3 col-xl-3  box-products ">
                                <div class="card p-1 text-center d-block shadow">
                                    <img src="{{asset('/documents/users/'.$item->personal_image)}}" class="img-circle" alt="..." width="150px" height="150px">
                                    <div class="card-body  text-center">
                                        <p class="text-bold">{{$item->fname}} {{$item->lname}}</p>
                                        <a href="/coach/{{$item->username}}" class="btn btn-primary btn-sm" >مشاهده اطلاعات </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection



@section('footerScript')

@endsection

