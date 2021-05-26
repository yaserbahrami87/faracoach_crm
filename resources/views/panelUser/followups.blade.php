<div class="card card-user">
    <div class="card-header bg-info">
        <h5 class="card-title">پیگیری ها</h5>
    </div>
    <div class="card-body">
        <form method="post" action="" enctype="multipart/form-data">
            {{csrf_field()}}
            {{method_field('PATCH')}}
            @foreach($followUps as $item)
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>دوره پیگیری شده</label>
                            <input type="text" class="form-control "  value="{{$item->course_id}}" name="course_id" disabled="disabled"  />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>وضعیت</label>
                            <input type="text" class="form-control "  value="{{$item->status_followups}}" name="state" disabled="disabled"  />
                        </div>
                    </div>
                    <div class="col-md-4 p-0">
                        <div class="form-group">
                            <label>کیفیت پیگیری</label>
                            <input type="text" class="form-control"  value="{{$item->problem}}" name="state" disabled="disabled"  style="background-color: {{$item->color}}"/>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>مکالمه(دقیقه)</label>
                            <input type="text" class="form-control"  value="{{$item->talktime}}" name="state" disabled="disabled"  />
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="form-group">
                            <label>توضیحات</label>
                            <textarea class="form-control textarea" disabled="disabled">{{$item->comment}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 px-1">
                        <div class="form-group">
                            <label>تاریخ پیگیری</label>
                            <input type="text" class="form-control"  value="{{$item->datetime_fa}}" name="state" disabled="disabled" />
                        </div>
                    </div>
                    <div class="col-md-6 px-1">
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
