<div class="card card-user rounded">
    <div class="card-header">
        <h5 class="card-title">پیگیری جدید</h5>
    </div>
    <div class="card-body">
        <div class="col-12">
            <div class="alert alert-warning" role="alert">
                <small>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                    </svg>
                    پر کردن تمامی فیلدها الزامی است
                </small>
            </div>
        </div>
        @if($errors->any())
            <div class="col-12">
                <div class="alert alert-danger" role="alert">
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </div>
            </div>
        @endif
        <form method="POST" action="/admin/followup/create" >
            {{csrf_field()}}
                <div class="row">
                    <input type="hidden" name="insert_user_id" value="{{$userAdmin->id}}" />
                    <input type="hidden" name="user_id" value="{{$user->id}}"/>
                    <div class="col-12">
                        <small>انتخاب تگ ها</small>
                        @foreach($parentCategory as $item)
                            <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample{{$item->id}}" role="button" aria-expanded="false" aria-controls="collapseExample{{$item->id}}">
                                {{$item->category}}
                            </a>
                            <div class="collapse" id="collapseExample{{$item->id}}">
                                <div class="card card-body">
                                    {{csrf_field()}}
                                    <div class="form row">
                                        @foreach($tags as $tag)
                                            @if($tag->category_tags_id==$item->id)
                                                <div class="col-3 text-right">
                                                    <label class="form-check-label m-0 pr-0 mr-3 ml-2 float-right" for="tag{{$tag->id}}">{{$tag->tag}}</label>
                                                    <input class="form-check-input text-dark mr-2 " type="checkbox" value="{{$tag->id}}" id="tag{{$tag->id}}" name="tags[]">
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-md-4 px-1">
                        <div class="form-group">
                            <label>نتیجه پیگیری</label>
                            <select class="form-control p-0" id="exampleFormControlSelect1" name="status_followups" >
                                <option disabled="disabled" selected >وضعیت را انتخاب کنید</option>
                                <option class="primary_bg_admin" value="11" >در حال مذاکره</option>
                                <option class="danger_bg_admin" value="12" >کنسل شد</option>
                                <option class="bg-info text-light" value="13">در انتظار تصمیم</option>
                                <option class="bg-secondary text-light" value="14">عدم پاسخگویی</option>
                                <option class="success_bg_admin" value="20" >مشتری</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 px-1">
                        <div class="form-group">
                            <label>کیفیت سنجی مشتری</label>
                            <select class="form-control p-0" id="exampleFormControlSelect1" name="followup" >
                                <option disabled="disabled" selected >نتیجه را مشخص کنید</option>
                                @foreach($problemFollowup as $item)
                                    <option value="{{$item->id}}" >{{$item->problem}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4 px-1">
                        <div class="form-group">
                            <label>مسئول پیگیری</label>
                            <select class="form-control p-0"  name="followby_expert" >
                                <option disabled="disabled" selected >نتیجه را مشخص کنید</option>
                                @foreach($expert_followup as $item)
                                    <option value="{{$item->id}}" @if($item->id==Auth::user()->id) selected @endif >@if((strlen($item->fname))||(strlen($item->lname))>0) {{$item->fname}} {{$item->lname}}@else{{$item->tel}}@endif</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 px-1">
                        <div class="form-group">
                            <label>تاریخ پیگیری</label>
                            <input type="text" class="form-control"  id="dateFollow"  name="date_fa" value="{{$today}}" />
                        </div>
                    </div>
                    <div class="col-md-4 px-1">
                        <div class="form-group">
                            <label>ساعت پیگیری</label>
                            <input type="text" class="form-control" value="{{$timeNow}}" name="time_fa" id="time_fa" />
                        </div>
                    </div>
                    <div class="col-md-4 px-1">
                        <div class="form-group">
                            <label>تاریخ پیگیری بعد</label>
                            <input type="text" class="form-control"  value="{{$nextDayFollow}}" name="nextfollowup_date_fa" id="nextfollowup_date_fa" />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>توضیحات</label>
                            <textarea class="form-control textarea"  lang="fa" name="comment">{{old('comment')}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="update m-auto m-auto">
                        <button type="submit" class="btn btn-primary btn-round">ثبت پیگیری</button>
                    </div>
                </div>
        </form>
    </div>
</div>
