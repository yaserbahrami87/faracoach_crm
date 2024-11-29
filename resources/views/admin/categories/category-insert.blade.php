@extends('admin.master.index')

@section('content')
    <<div class="col-12 col-md-6 mx-auto" >
        <div class="card">
            <div class="card-header">افزودن دسته بندی</div>
            <div class="card-body">
                <form method="post" action="/admin/category" >
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="category">نام دسته بندی<span class="text text-danger">*</span></label>
                        <input type="text" class="form-control @error('category') is-invalid @enderror" id="category" name="category" value="{{old('category')}}"/>
                    </div>
                    <div class="form-group">
                        <label for="type">نوع<span class="text text-danger">*</span></label>
                        <select class="form-control" id="type" name="type">
                            <option value="product" {{old('type')=='product'?'selected':''}}>محصول</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status">وضعیت</label>
                        <select class="form-control" id="status" name="status">
                            <option disabled selected>انتخاب کنید</option>
                            <option value="1" {{old('status')==1?'selected':''}}>فعال</option>
                            <option value="0" {{old('status')==2?'selected':''}}>غیر فعال</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">افزودن</button>
                </form>
            </div>
        </div>
    </div>
@endsection
