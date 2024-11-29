
@extends('admin.master.index')
@section('content')
    <div class="col-12 col-md-10 mx-auto" >
        <div class="card">
            <div class="card-header">ویرایش خبر</div>
            <div class="card-body">
                <form method="post" action="/admin/news/{{$news->id}}" >
                    {{csrf_field()}}
                    {{method_field('patch')}}
                    <div class="form-group">
                        <label for="title">عنوان خبر<span class="text text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{old('title',$news->title)}}"/>
                    </div>

                    <div class="form-group">
                        <label for="summery_news">توضیح کوتاه</label>
                        <input type="text" class="form-control @error('summery_news') is-invalid @enderror" id="summery_news" name="summery_news" value="{{old('summery_news',$news->summery_news)}}" />
                    </div>
                    <div class="form-group">
                        <label for="news">متن خبر<span class="text text-danger">*</span></label>
                        <textarea id="news" name="news" class="@error('news') is-invalid @enderror" style="width: 100%;">{{old('news',$news->news)}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="status">وضعیت خبر</label>
                        <select class="form-control" id="status" name="status">
                            <option class="disabled" selected>انتخاب کنید</option>
                            <option value="1"  @if($news->status==1)  selected  @endif >فعال</option>
                            <option value="0" @if($news->status==0)  selected  @endif >غیرفعال</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">ثبت تغییرات</button>
                </form>
            </div>
        </div>
    </div>
@endsection
