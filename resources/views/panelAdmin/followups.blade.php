<div class="card card-user">
    <div class="card-header">
        <h5 class="card-title">پیگیری ها</h5>
    </div>
    <div class="card-body">
        <form method="post" action="" enctype="multipart/form-data">
            {{csrf_field()}}
            {{method_field('PATCH')}}
            @foreach($followUps as $item)
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-4 pl-1">
                            <div class="form-group">
                                <label>نوع پیگیری</label>
                                <input type="text" class="form-control"  value="{{$item->problem}}" name="state" disabled="disabled"  />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>توضیحات</label>
                            <textarea class="form-control textarea" disabled="disabled">{{$item->comment}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 pl-1">
                        <div class="form-group">
                            <label>تاریخ ثبت</label>
                            <input type="text" class="form-control"  value="{{$item->datetime_fa}}" name="state" disabled="disabled" />
                        </div>
                    </div>
                    <div class="col-md-4 px-1">
                        <div class="form-group">
                            <label>تاریخ ویرایش</label>
                            <input type="text" class="form-control" value="{{$item->updated_at}}" name="city" disabled="disabled"  />
                        </div>
                    </div>
                    <div class="col-md-4 pr-1">
                        <div class="form-group">
                            <label>ثبت شده توسط</label>
                            <input type="text" class="form-control" value="{{$item->updated_at}}" name="city" disabled="disabled" />
                        </div>
                    </div>
                </div>
                <hr/>
            @endforeach
        </form>
    </div>
</div>