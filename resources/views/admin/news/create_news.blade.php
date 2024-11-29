@extends('admin.master.index')
@section('content')
    <div class="col-12 col-md-10 mx-auto" >
        <div class="card">
            <div class="card-header">افزودن خبر جدید</div>
            <div class="card-body">
                <form method="post" action="/admin/news" >
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="title">عنوان خبر<span class="text text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{old('title')}}"/>
                    </div>

                    <div class="form-group">
                        <label for="summery_news">توضیح کوتاه</label>
                        <input type="text" class="form-control @error('summery_news') is-invalid @enderror" id="summery_news" name="summery_news" value="{{old('summery_news')}}" />
                    </div>
                    <div class="form-group">
                        <label for="news">متن خبر<span class="text text-danger">*</span></label>
                        <textarea  id="news" name="news" class="@error('news') is-invalid @enderror" style="width: 100%;">{{old('news')}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="status"> وضعیت خبر<span class="text text-danger">*</span></label>
                        <select class="form-control" id="status" name="status">
                            <option class="disabled" selected>انتخاب کنید</option>
                            <option value="1">فعال</option>
                            <option value="0">غیرفعال</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">افزودن</button>
                </form>
            </div>
        </div>
    </div>
@endsection
