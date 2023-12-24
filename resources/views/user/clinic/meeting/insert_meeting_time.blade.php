@extends('admin.master.index')
@section('content')
    <div class="col-12">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-info border-info">
                    <h4 class="card-title m-0">تنظیم زمان جلسه جدید  </h4>
                </div>
                <div class="card-body" >
                    <form method="post" action="/admin/clinic_basic_info" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="title">تاریخ جلسه :</label>
                            <input type="text" class="form-control" id="title" name="title" >
                        </div>
                        <div class="form-group">
                            <label for="description">توضیحات</label>
                            <input type="text" class="form-control" id="description" name="description" >
                        </div>
                        <button type="submit" class="btn btn-primary">افزودن</button>
                    </form>
                </div>
            </div>

        </div>
    </div>






@endsection
