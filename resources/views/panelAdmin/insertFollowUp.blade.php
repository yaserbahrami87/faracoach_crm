<div class="card card-user rounded">
    <div class="card-header">
        <h5 class="card-title">پیگیری جدید</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="/admin/followup/create" >
            {{csrf_field()}}
                <div class="row">
                    <input type="hidden" name="insert_user_id" value="{{$userAdmin->id}}" />
                    <input type="hidden" name="user_id" value="{{$user->id}}"/>
                    <div class="col-12">
                        @foreach($parentCategory as $item)
                            <a class="d-inline" data-toggle="collaps"  role="button" aria-expanded="false" aria-controls="collapseExample{{$item->id}}">
                                {{$item->category}}
                            </a>
                            <div id="collapseExample{{$item->id}}">
                                <div class="card card-body">
                                    <div class="form row">
                                        @foreach($tags as $tag)
                                            @if($tag->category_tags_id==$item->id)
                                                <div class="col-3 text-right">
                                                    <label class="form-check-label m-0 pr-0 mr-3 ml-2 float-right" for="tag{{$tag->id}}">{{$tag->tag}}</label>
                                                    <input class="form-check-input text-dark mr-2 " type="checkbox" value="{{$tag->id}}" id="tag{{$tag->id}}" name="tags[]" @if(is_array(old('tags')) && in_array($tag->id, old('tags'))) checked @endif  >
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>توضیحات</label>
                            <textarea class="form-control textarea"  lang="fa" name="comment">{{old('comment')}}</textarea>
                        </div>
                    </div>
                    <div class="col-md-4 px-1">
                        <div class="form-group">
                            <label>نتیجه پیگیری</label>
                            <select class="form-control p-0" id="exampleFormControlSelect1" name="status_followups" >
                                <option disabled="disabled" selected >وضعیت را انتخاب کنید</option>
                                <option  value="11" @if (old('status_followups') == '11') selected @endif>تور پیگیری</option>
                                <option  value="12" @if (old('status_followups') == '12') selected @endif> کنسل شد</option>
                                <option  value="13" @if (old('status_followups') == '13') selected @endif>در انتظار تصمیم</option>
                                <option  value="14" @if (old('status_followups') == '14') selected @endif>عدم پاسخگویی</option>
                                <option  value="20" @if (old('status_followups') == '15') selected @endif>مشتری</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 px-1">
                        <div class="form-group">
                            <label>کیفیت سنجی مشتری</label>
                            <select class="form-control p-0" id="exampleFormControlSelect1" name="followup" >
                                <option disabled="disabled" selected >نتیجه را مشخص کنید</option>
                                @foreach($problemFollowup as $item)
                                    <option value="{{$item->id}}"  @if (old('followup') == $item->id) selected @endif >{{$item->problem}}</option>
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
                </div>
                <div class="row">
                    <div class="col-12 px-1">
                        <div class="form-group">
                            <div class="form-group row mb-0">
                                <label for="sendSMS" class="col-md-4 col-form-label text-md-right  text-dark">ارسال پیامک</label>
                                <div class="col-md-6 mr-5">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="sms" id="sendsms1" value="0" checked>
                                        <label class="form-check-label  text-dark" for="sendsms1">
                                            ارسال نشود
                                        </label>
                                    </div>
                                    <div class="form-check">

                                        <input class="form-check-input" type="radio" name="sms" id="sendsms2" value="@if($user->sex==1)جناب آقای@elseif($user->sex==0)سرکارخانم@elseجناب آقای/سرکارخانم@endif <br> فایل آموزشی درخواستی شما در سایت در دسترس شما قرار گرفت.جهت پیگیری در تاریخ {nextDate} منتظر تماس ما باشید  <br> مشاور اختصاصی شما:{{Auth::user()->fname }}{{Auth::user()->lname}} <br> باشگاه مشتریان فراکوچ" >
                                        <label class="form-check-label  text-dark" for="sendsms2">
                                            @if($user->type==1)
                                                جناب آقای
                                            @elseif($user->type==0)
                                                سرکارخانم
                                            @else
                                                جناب آقای/سرکارخانم
                                            @endif
                                            <br/>
                                            فایل آموزشی درخواستی شما در سایت در دسترس شما قرار گرفت.
                                            جهت پیگیری در تاریخ {nextDate} منتظر تماس ما باشید<br/>
                                            مشاور اختصاصی شما:{{Auth::user()->fname }}{{Auth::user()->lname}}<br/>
                                            باشگاه مشتریان فراکوچ
                                        </label>
                                    </div>
                                </div>
                            </div>
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
