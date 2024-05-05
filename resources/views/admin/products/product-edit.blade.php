@extends('admin.master.index')
@section('headerScript')


    <link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">

@endsection
@section('content')
    <div class="col-12 col-md-10 mx-auto" >
        <div class="card">
            <div class="card-header">افزودن محصول</div>
            <div class="card-body">
                <form method="post" action="/admin/product/{{$product->shortlink}}" >
                    {{csrf_field()}}
                    {{method_field('patch')}}
                    <div class="form-group">
                        <label for="product">نام محصول<span class="text text-danger">*</span></label>
                        <input type="text" class="form-control @error('product') is-invalid @enderror" id="product" name="product" value="{{old('product',$product->product)}}"/>
                    </div>
                    <div class="form-group">
                        <label for="shortlink">لینک کوتاه<span class="text text-danger">*</span></label>
                        <input type="text" class="form-control @error('shortlink') is-invalid @enderror" id="shortlink" name="shortlink" value="{{old('shortlink',$product->shortlink)}}" />
                    </div>
                    <div id="tagImages">
                        <div class="input-group">
                            <label class="d-block">عکس<span class="text text-danger">*</span></label>
                            <div class="custom-file">
                                <input type="text" id="image_label" class="form-control" name="image" aria-label="Image" aria-describedby="button-image" value="{{old('image',$product->image)}}">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" id="button-image">انتخاب عکس</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
{{--                        {{dd($product->categories->wherein('id',[2]))}}--}}
                        <label for="teacher">دسته بندی<span class="text text-danger">*</span></label>
                        <select id="category_id" class="form-control p-0 @error('category_id') is-invalid @enderror" name="category_id[]" multiple>
                            <option selected disabled>انتخاب کنید</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}" @if($product->categories->wherein('id',$category->id)->count()>0) selected @endif >{{$category->category}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group ml-2">
                        <input class="form-check-input text-dark " type="checkbox" value="1" name="is_scholarship"@if($product->is_scholarship==1) checked @endif >
                        <label class="form-check-label" for="tag">بورسیه</label>
                    </div>
                    <div class="form-group">
                        <label for="fi">هزینه دوره (تومان)<span class="text text-danger">*</span></label>
                        <input type="text" class="form-control @error('fi') is-invalid @enderror" id="fi" name="fi" value="{{old('fi',$product->fi)}}"  />
                    </div>
                    <div class="form-group">
                        <label for="fi_off"> هزینه دوره با تخفیف (تومان)<span class="text text-danger">*</span></label>
                        <input type="text" class="form-control @error('fi_off') is-invalid @enderror" id="fi_off" name="fi_off" value="{{old('fi_off',$product->fi_off)}}" />
                    </div>
                    <div class="form-group">
                        <label for="description">توضیحات مختصر : </label>
                        <input type="text" class="form-control" id="description" name="description" value="{{old('description',$product->description)}}" />
                    </div>
                    <div class="form-group">
                        <label for="info">مطالب دوره<span class="text text-danger">*</span></label>
                        <textarea id="info" name="info" class="@error('info') is-invalid @enderror">{{old('info',$product->info)}}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">افزودن</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('footerScript')
    <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
    <script>
        CKEDITOR.replace( 'info' ,
            {
                filebrowserImageBrowseUrl: '/file-manager/ckeditor'
            });
    </script>
    <script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>
    <script>
        let i=1;
        document.addEventListener("DOMContentLoaded", function()
        {
            document.getElementById('button-image').addEventListener('click', (event) => {
                event.preventDefault();
                window.open('/file-manager/fm-button', 'fm', 'width=900,height=800');
            });
        });

        // set file link
        function fmSetLink($url) {
            document.getElementById('image_label').value = $url;
        }


        function  add()
        {

        }
    </script>

@endsection
