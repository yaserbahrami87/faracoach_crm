@if(count($followUps)>0)
<div class="card card-user">
    <div class="card-header border-bottom">
        <h5 class="card-title">پیگیری ها</h5>
    </div>
    <div class="card-body">
        <form method="post" action="" enctype="multipart/form-data">
            {{csrf_field()}}
            {{method_field('PATCH')}}
            <?php $i=1; ?>
            @foreach($followUps as $item)
                <div class="row">
                    <div class="col-12 text-center">
                        <h6>پیگیری {{$i++}}</h6>
                    </div>
                    <div class="row px-1">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>نوع پیگیری</label>
                                <input type="text" class="form-control"  value="{{$item->problem}}" name="state" disabled="disabled"  />
                            </div>
                        </div>
                        <div class="col-md-8 ">
                            <div class="form-group">
                                <label>تگ ها</label>
                                <ul class="list-group list-group-horizontal">
                                    @foreach($item->tags as $tag)
                                        <li class="list-group-item p-2">
                                            <small class="text-dark">{{$tag}}</small>
                                        </li>
                                    @endforeach
                                </ul>
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
                    <div class="col-md-3 px-1">
                        <div class="form-group">
                            <label>تاریخ پیگیری</label>
                            <input type="text" class="form-control"  value="{{$item->datetime_fa}}" name="state" disabled="disabled" />
                        </div>
                    </div>
                    <div class="col-md-3 px-1">
                        <div class="form-group">
                            <label>تاریخ ویرایش</label>
                            <input type="text" class="form-control" value="{{$item->updated_at}}" name="city" disabled="disabled"  />
                        </div>
                    </div>
                    <div class="col-md-3 px-1">
                        <div class="form-group">
                            <label>ثبت شده توسط</label>
                            <input type="text" class="form-control" value="{{$item->insert_user_id}}" name="city" disabled="disabled" />
                        </div>
                    </div>
                    <div class="col-md-3 px-1">
                        <div class="form-group">
                            <label>تاریخ پیگیری بعد</label>
                            <input type="text" class="form-control" value="{{$item->nextfollowup_date_fa}}" name="nextfollowup" disabled="disabled" />
                        </div>
                    </div>
                </div>
                <hr/>
            @endforeach
        </form>
    </div>
</div>
@endif

