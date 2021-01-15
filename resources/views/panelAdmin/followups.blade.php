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
                @switch($item->type)
                    @case ("در حال پیگیری")
                                <div class="row  border-primary border border-bottom-0 rounded-lg">
                                @break
                    @case ("انصراف")
                                <div class="row  border-danger border border-bottom-0 rounded-lg">
                                @break
                    @case("در انتظار تصمیم")
                                <div class="row  border-info border border-bottom-0 rounded-lg">
                                @break
                    @case("عدم پاسخگویی")
                                <div class="row  border-secondary border border-bottom-0 rounded-lg">
                                @break
                    @case("مشتری")
                                <div class="row  border-success border border-bottom-0 rounded-lg">
                                @break
                    @default
                                <div class="row  border border-bottom-0 rounded-lg">
                                @break
                @endswitch

                    <div class="col-12">
                        <div class="row px-1">
                            <div class="col-md-2 p-0 pt-4 text-center">
                                <h6>پیگیری {{$i++}}</h6>
                            </div>
                            <div class="col-md-3 p-0">
                                <div class="form-group">
                                    <label>نتیجه پیگیری</label>
                                    <input type="text" class="form-control"  value="{{$item->problem}}" name="state" disabled="disabled"  />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>وضعیت</label>
                                    @switch($item->type)
                                        @case ("در حال پیگیری")
                                            <input type="text" class="form-control primary_bg_admin"  value="{{$item->type}}" name="state" disabled="disabled"  />
                                            @break
                                        @case ("انصراف")
                                            <input type="text" class="form-control danger_bg_admin text-light"  value="{{$item->type}}" name="state" disabled="disabled"  />
                                            @break
                                        @case("در انتظار تصمیم")
                                            <input type="text" class="form-control bg-info text-light"  value="{{$item->type}}" name="state" disabled="disabled"  />
                                            @break
                                        @case("عدم پاسخگویی")
                                            <input type="text" class="form-control bg-secondary text-light"  value="{{$item->type}}" name="state" disabled="disabled"  />
                                            @break
                                        @case("مشتری")
                                        <input type="text" class="form-control success_bg_admin"  value="{{$item->type}}" name="state" disabled="disabled"  />
                                            @break
                                    @endswitch
                                </div>
                            </div>
                            <div class="col-md-12 ">
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
                </div>

                @switch($item->type)
                    @case ("در حال پیگیری")
                            <div class="row  border-primary border rounded-lg border-top-0">
                            @break
                    @case ("انصراف")
                            <div class="row  border-danger border rounded-lg border-top-0">
                            @break
                    @case("در انتظار تصمیم")
                           <div class="row  border-info border rounded-lg border-top-0">
                           @break
                    @case("عدم پاسخگویی")
                           <div class="row  border-secondary border rounded-lg border-top-0">
                           @break
                    @case("مشتری")
                           <div class="row  border-success border rounded-lg border-top-0">
                           @break
                    @default
                           <div class="row border rounded-lg border-top-0">
                    @endswitch

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

