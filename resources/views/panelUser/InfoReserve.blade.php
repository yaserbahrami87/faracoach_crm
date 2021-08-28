@extends('panelUser.master.index')
@section('rowcontent')
    <div class="col-md-6">
        <div class="card card-user">
            <div class="card-header bg-info">
                <h5 class="card-title">اطلاعات رزرو</h5>
            </div>
            <div class="card-body" id="infoProfile">
                <div class="row">
                    <div class="col-md-6 px-1">
                        <div class="form-group">
                            <label>موضوع رزرو</label>
                            <input type="text" class="form-control " placeholder="نام را وارد کنید" value="{{$user->subject}}"    disabled="disabled"  />
                        </div>
                    </div>
                    <div class="col-md-6 px-1">
                        <div class="form-group">
                            <label>نوع رزرو</label>
                            <input type="text" class="form-control " placeholder="نام را وارد کنید" value="{{$user->type_booking}}"    disabled="disabled"  />
                        </div>
                    </div>
                    <div class="col-md-12 px-1">
                        <div class="form-group">
                            <label>توضیحات</label>
                            <textarea class="form-control"rows="3" disabled="disabled">{{$user->details}}</textarea>
                        </div>
                    </div>

                    <div class="col-md-4 px-1">
                        <div class="form-group">
                            <label>تاریخ رزرو</label>
                            <input type="text" class="form-control " placeholder="نام را وارد کنید" value="{{$booking->start_date}}"    disabled="disabled"  />
                        </div>
                    </div>
                    <div class="col-md-4 px-1">
                        <div class="form-group">
                            <label>ساعت شروع</label>
                            <input type="text" class="form-control " placeholder="نام را وارد کنید" value="{{$booking->start_time}}"    disabled="disabled"  />
                        </div>
                    </div>
                    <div class="col-md-4 px-1">
                        <div class="form-group">
                            <label>ساعت پایان</label>
                            <input type="text" class="form-control " placeholder="نام را وارد کنید" value="{{$booking->end_time}}"    disabled="disabled"  />
                        </div>
                    </div>
                    <div class="col-md-12 px-1">
                        <div class="card">
                            <div class="card-body" id="div_show_fi">
                                <span class="float-right">قیمت </span>
                                <span class="float-left">{{number_format($booking->fi)}} تومان</span>
                                <br/>
                                <span class="float-right">کوپن تخفیف </span>
                                <span class="float-left">{{$booking->coupon}} </span>
                                <br/>
                                <span class="float-right">کد تخفیف </span>
                                <span class="float-left">{{$booking->off}} %</span>
                                <br/>
                                <span class="float-right">قیمت نهایی</span>
                                <span class="float-left">{{number_format($booking->final_off)}} تومان</span>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-user ">
            <div class="card-header  bg-info">
                <h5 class="card-title">گزارش  جلسه</h5>
            </div>
            <div class="card-body" >
                @if(($booking->start_date<$dateNow))
                    <form method="post" action="/panel/reserve/{{$booking->id}}/update" >
                        {{csrf_field()}}
                        {{method_field('PATCH')}}
                        <div class="form-group">
                            <label for="status">وضعیت جلسه *</label>
                            <select class="form-control" id="status" name="status" @if(!is_null($user->result_coach)) disabled  @endif>
                                <option disabled selected>انتخاب کنید</option>
                                <option value="3" @if($user->status==3) selected  @endif >برگزار شد</option>
                                <option value="4" @if($user->status==4) selected  @endif >کنسل شد</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>نتیجه جلسه *</label>
                            <textarea class="form-control"rows="5" name="result_coach" @if(!is_null($user->result_coach)) disabled @endif >{{$user->result_coach}}</textarea>
                            <small class="text-muted">این گزارش فقط برای خود کوچ جهت ثبت سوابق جلسات ثبت می شود</small>
                        </div>
                        <div class="form-group">
                            <label>به جلسه کوچینگ خود امتیاز دهید *</label>
                            @if(is_null($user->score))
                                @for($i=1;$i<=5;$i++)
                                    <input name="score" type="radio" class="star-demo" value="{{$i}}" />
                                @endfor
                            @else
                                @for($i=1;$i<=5;$i++)
                                    <input name="score" type="radio" class="star-demo" value="{{$i}}" disabled @if($i==$user->score) checked @endif disabled/>
                                @endfor
                            @endif
                        </div>
                        @if(is_null($user->result_coach) ||(is_null($user->score)))
                            <div class="form-group">
                                <button class="btn btn-success">ثبت</button>
                            </div>
                        @endif
                    </form>





                    <p>کوچ گرامی</p>
                    <p class="text-justify">یکی از مهم ترین مهارت های یک کوچ ارائه بازخورد سازنده است که توام با صداقت، صراحت و صمیمیت است.</p>
                    <p class="text-justify">فرم نظرسنجی شما توسط مراجعه کننده به شکل زیر پر شده است .</p>


                    <div class="form-group border-bottom">
                        <label>حس شما از شرکت در جلسه:*</label>
                        @if(is_null($feedback))
                            @for($i=1;$i<=5;$i++)
                                <input name="sense" type="radio" class="star-demo" value="{{$i}}" disabled @if(old('sense')==$i) checked @endif />
                            @endfor
                        @else
                            @for($i=1;$i<=5;$i++)
                                <input name="sense" type="radio" class="star-demo" value="{{$i}}" disabled @if($i==$feedback->sense) checked @endif disabled/>
                            @endfor
                        @endif
                    </div>
                    <div class="form-group border-bottom">
                        <label>میزان برآورده شدن انتظارات شما و اثر بخشی جلسه:*</label>
                        @if(is_null($feedback))
                            @for($i=1;$i<=5;$i++)
                                <input name="expectations" type="radio" class="star-demo" value="{{$i}}" disabled @if(old('expectations')==$i) checked @endif  />
                            @endfor
                        @else
                            @for($i=1;$i<=5;$i++)
                                <input name="expectations" type="radio" class="star-demo" value="{{$i}}" disabled @if($i==$feedback->expectations) checked @endif disabled/>
                            @endfor
                        @endif
                    </div>
                    <div class="form-group border-bottom">
                        <label>ایجاد اعتماد و فضای امن و مثبت توسط کوچ:*</label>
                        @if(is_null($feedback))
                            @for($i=1;$i<=5;$i++)
                                <input name="trust" type="radio" class="star-demo" value="{{$i}}" disabled  @if(old('trust')==$i) checked @endif />
                            @endfor
                        @else
                            @for($i=1;$i<=5;$i++)
                                <input name="trust" type="radio" class="star-demo" value="{{$i}}" disabled @if($i==$feedback->trust) checked @endif disabled/>
                            @endfor
                        @endif
                    </div>
                    <div class="form-group border-bottom">
                        <label>گوش دادن موثر کوچ:*</label>
                        @if(is_null($feedback))
                            @for($i=1;$i<=5;$i++)
                                <input name="listen" type="radio" class="star-demo" value="{{$i}}"  disabled @if(old('listen')==$i) checked @endif />
                            @endfor
                        @else
                            @for($i=1;$i<=5;$i++)
                                <input name="listen" type="radio" class="star-demo" value="{{$i}}" disabled @if($i==$feedback->listen) checked @endif disabled/>
                            @endfor
                        @endif
                    </div>
                    <div class="form-group border-bottom">
                        <label>درک احساسات و همدلی مناسب کوچ با شما:*</label>
                        @if(is_null($feedback))
                            @for($i=1;$i<=5;$i++)
                                <input name="emotions" type="radio" class="star-demo" value="{{$i}}" disabled  @if(old('emotions')==$i) checked @endif />
                            @endfor
                        @else
                            @for($i=1;$i<=5;$i++)
                                <input name="emotions" type="radio" class="star-demo" value="{{$i}}" disabled @if($i==$feedback->emotions) checked @endif disabled/>
                            @endfor
                        @endif
                    </div>
                    <div class="form-group border-bottom">
                        <label>عدم ارائه راهکارهای مستقیم به شما:*</label>
                        @if(is_null($feedback))
                            @for($i=1;$i<=5;$i++)
                                <input name="failure_provide" type="radio" class="star-demo" value="{{$i}}" disabled @if(old('failure_provide')==$i) checked @endif  />
                            @endfor
                        @else
                            @for($i=1;$i<=5;$i++)
                                <input name="failure_provide" type="radio" class="star-demo" value="{{$i}}" disabled @if($i==$feedback->failure_provide) checked @endif disabled/>
                            @endfor
                        @endif
                    </div>
                    <div class="form-group border-bottom">
                        <label>مدیریت زمان جلسه توسط کوچ (شروع و پایان به موقع):*</label>
                        @if(is_null($feedback))
                            @for($i=1;$i<=5;$i++)
                                <input name="time_management" type="radio" class="star-demo" value="{{$i}}" disabled @if(old('time_management')==$i) checked @endif />
                            @endfor
                        @else
                            @for($i=1;$i<=5;$i++)
                                <input name="time_management" type="radio" class="star-demo" value="{{$i}}" disabled @if($i==$feedback->time_management) checked @endif disabled/>
                            @endfor
                        @endif
                    </div>
                    <div class="form-group border-bottom">
                        <label>جمع بندی و ارائه بازخوردهای مناسب به شما:*</label>
                        @if(is_null($feedback))
                            @for($i=1;$i<=5;$i++)
                                <input name="proper_feedback" type="radio" class="star-demo" value="{{$i}}" disabled @if(old('proper_feedback')==$i) checked @endif />
                            @endfor
                        @else
                            @for($i=1;$i<=5;$i++)
                                <input name="proper_feedback" type="radio" class="star-demo" value="{{$i}}" disabled @if($i==$feedback->proper_feedback) checked @endif disabled/>
                            @endfor
                        @endif
                    </div>
                    <div class="form-group border-bottom">
                        <label>کمک به ترسیم اهداف کلی شما:*</label>
                        @if(is_null($feedback))
                            @for($i=1;$i<=5;$i++)
                                <input name="drawing_goals" type="radio" class="star-demo" value="{{$i}}" disabled @if(old('drawing_goals')==$i) checked @endif />
                            @endfor
                        @else
                            @for($i=1;$i<=5;$i++)
                                <input name="drawing_goals" type="radio" class="star-demo" value="{{$i}}" disabled @if($i==$feedback->drawing_goals) checked @endif disabled/>
                            @endfor
                        @endif
                    </div>
                    <div class="form-group border-bottom">
                        <label>کمک به بررسی ابعاد مختلف موضوع:*</label>
                        @if(is_null($feedback))
                            @for($i=1;$i<=5;$i++)
                                <input name="check_dimensions" type="radio" class="star-demo" value="{{$i}}" disabled  @if(old('check_dimensions')==$i) checked @endif />
                            @endfor
                        @else
                            @for($i=1;$i<=5;$i++)
                                <input name="check_dimensions" type="radio" class="star-demo" value="{{$i}}" disabled @if($i==$feedback->check_dimensions) checked @endif disabled/>
                            @endfor
                        @endif
                    </div>
                    <div class="form-group border-bottom">
                        <label>کمک به ارزیابی راهکارهای موجود و یافته شده:*</label>
                        @if(is_null($feedback))
                            @for($i=1;$i<=5;$i++)
                                <input name="solution_evaluation" type="radio" class="star-demo" value="{{$i}}" disabled @if(old('solution_evaluation')==$i) checked @endif />
                            @endfor
                        @else
                            @for($i=1;$i<=5;$i++)
                                <input name="solution_evaluation" type="radio" class="star-demo" value="{{$i}}" disabled @if($i==$feedback->solution_evaluation) checked @endif disabled/>
                            @endfor
                        @endif
                    </div>
                    <div class="form-group border-bottom">
                        <label>ارائه تکلیف و تمرین به شما:*</label>
                        @if(is_null($feedback))
                            @for($i=1;$i<=5;$i++)
                                <input name="homework" type="radio" class="star-demo" value="{{$i}}" disabled  @if(old('homework')==$i) checked @endif />
                            @endfor
                        @else
                            @for($i=1;$i<=5;$i++)
                                <input name="homework" type="radio" class="star-demo" value="{{$i}}" disabled @if($i==$feedback->homework) checked @endif disabled/>
                            @endfor
                        @endif
                    </div>
                    <div class="form-group border-bottom">
                        <label>جمع بندی نظرات شما در یک جمله:*</label>
                        @if(is_null($feedback))
                            @for($i=1;$i<=5;$i++)
                                <input name="summary_comments" type="radio" class="star-demo" value="{{$i}}" disabled @if(old('summary_comments')==$i) checked @endif  />
                            @endfor
                        @else
                            @for($i=1;$i<=5;$i++)
                                <input name="summary_comments" type="radio" class="star-demo" value="{{$i}}" disabled @if($i==$feedback->summary_comments) checked @endif disabled/>
                            @endfor
                        @endif
                    </div>
                    <div class="form-group border-bottom">
                        <label for="best_offer">بهترین پیشنهاد شما:</label>
                        <textarea class="form-control" id="best_offer" rows="3" name="best_offer" disabled >@if(old('best_offer')) {{old('best_offer')}} @elseif(!is_null($feedback)){{$feedback->best_offer}} @endif</textarea>
                    </div>
                    <div class="form-group border-bottom">
                        <label for="effective_criticism">موثر ترین انتقاد شما؟</label>
                        <textarea class="form-control" id="effective_criticism" rows="3" name="effective_criticism" disabled >@if(old('effective_criticism')) {{old('effective_criticism')}} @elseif(!is_null($feedback)){{$feedback->effective_criticism}} @endif</textarea>
                    </div>
                    <div class="form-group border-bottom">
                        <label for="achievement">از آخرین جلسه کوچینگ چه دستاوردی در راستای هدف خود به دست آورده اید؟</label>
                        <textarea class="form-control" id="achievement" rows="3" name="achievement"  disabled >@if(old('achievement')) {{old('achievement')}} @elseif(!is_null($feedback)){{$feedback->achievement}} @endif</textarea>
                    </div>
                    <div class="form-group border-bottom">
                        <label for="self_awareness">از آخرین جلسه کوچینگ چه آگاهی نسبت به خود پیدا کرده اید؟</label>
                        <textarea class="form-control" id="self_awareness" rows="3" name="self_awareness" disabled >@if(old('self_awareness')) {{old('self_awareness')}} @elseif(!is_null($feedback)){{$feedback->self_awareness}} @endif</textarea>
                    </div>
                    <div class="form-group border-bottom">
                        <label for="challenges">در حال حاضر با چه چالش ها و مشکلاتی رو به رو هستید؟</label>
                        <textarea class="form-control" id="challenges" rows="3" name="challenges" disabled >@if(old('challenges')) {{old('challenges')}} @elseif(!is_null($feedback)){{$feedback->challenges}} @endif</textarea>
                    </div>
                    <div class="form-group border-bottom">
                        <label for="opportunities_you">در حال حاضر چه فرصت هایی برای شما فراهم است؟</label>
                        <textarea class="form-control" id="opportunities_you" rows="3" name="opportunities_you" disabled >@if(old('opportunities_you')) {{old('opportunities_you')}} @elseif(!is_null($feedback)){{$feedback->opportunities_you}} @endif</textarea>
                    </div>
                    <div class="form-group border-bottom">
                        <label for="future_expectations">در جلسه آینده از کوچ خود چه انتظاراتی دارید؟</label>
                        <textarea class="form-control" id="future_expectations" rows="3" name="future_expectations" disabled >@if(old('future_expectations')) {{old('future_expectations')}} @elseif(!is_null($feedback)){{$feedback->future_expectations}} @endif</textarea>
                    </div>
                    <div class="form-group border-bottom">
                        <label for="suggestions_progress">چه پیشنهادهایی برای پیشرفت جلسات کوچینگ خود دارید؟</label>
                        <textarea class="form-control" id="suggestions_progress" rows="3" name="suggestions_progress" disabled >@if(old('suggestions_progress')) {{old('suggestions_progress')}} @elseif(!is_null($feedback)){{$feedback->suggestions_progress}} @endif</textarea>
                    </div>
                    <div class="form-group">
                        <label for="satisfaction">پیشنهاد این کوچ به دیگران *</label>

                        <select class="form-control" name="satisfaction" id="satisfaction" disabled>
                            <option disabled selected>انتخاب کنید</option>
                            <option class="bg-success" value="1" @if(old('satisfaction')==1) selected @elseif(!is_null($feedback)&&($feedback->satisfaction==1)) selected @endif>این کوچ را توصیه میکنم</option>
                            <option class="bg-danger" value="0" @if(!is_null($feedback)&&($feedback->satisfaction==0)) selected @endif>این کوچ را توصیه نمیکنم</option>
                        </select>
                        <small class="text-muted">این نظر در سوابق کوچ نمایش داده می شود</small>
                    </div>
                    <div class="form-group">
                        <label for="comment">نظر / پیشنهاد درباره کوچ یا جلسه</label>
                        <textarea class="form-control" id="comment" rows="3" name="comment" disabled >@if(old('comment')) {{old('comment')}} @elseif(!is_null($feedback)){{$feedback->comment}} @endif</textarea>
                        <small class="text-muted">این نظر در سوابق کوچ نمایش داده می شود</small>
                    </div>
                    @else
                    <div class="alert alert-warning">جلسه کوچینک هنوز انجام نشده است</div>

                @endif
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card card-user">
            <div class="card-header  bg-info">
                <h5 class="card-title">اطلاعات شخصی</h5>
            </div>
            <div class="card-body" id="infoProfile">
                <div class="row">
                    <div class="col-12 text-center mb-3">
                        <img  src="{{asset('/documents/users/'.$user->personal_image)}}" class="img-circle shadow-lg" width="150px" height="150px"/>
                    </div>
                    <div class="col-md-6 px-1">
                        <div class="form-group">
                            <label>نام</label>
                            <input type="text" class="form-control @if(strlen($user->fname)==0) is-invalid @endif"  value="{{$user->fname}}"    disabled="disabled"  />
                        </div>
                    </div>
                    <div class="col-md-6 px-1">
                        <div class="form-group">
                            <label>نام خانوادگی</label>
                            <input type="text" class="form-control @if(strlen($user->lname)==0) is-invalid @endif"  value="{{$user->lname}}"  disabled="disabled"/>
                        </div>
                    </div>
                    <div class="col-md-6 px-1">
                        <div class="form-group">
                            <label>تاریخ تولد</label>
                            <input type="text" class="form-control @if(strlen($user->datebirth)==0) is-invalid @endif"  value="{{$user->datebirth}}" id="datebirth" disabled="disabled"/>
                        </div>
                    </div>
                    <div class="col-md-12 px-1">
                        <div class="form-group">
                            <label>درباره من</label>
                            <textarea class="form-control @if(strlen($user->aboutme)==0) is-invalid @endif" id="aboutme"  rows="3" disabled="disabled">{{$user->aboutme}}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-user">
            <div class="card-header  bg-info">
                <h5 class="card-title">اطلاعات تماس</h5>
            </div>
            <div class="card-body" id="infoProfile">
                <div class="row">
                    <div class="col-md-6 px-1">
                        <div class="form-group">
                            <label>تلفن تماس</label>
                            <input type="text" class="form-control @if(strlen($user->tel)==0) is-invalid @endif"  @if(strlen($user->tel)>0) value="{{$user->tel}}" disabled @endif   />
                        </div>
                    </div>
                    <div class="col-md-6 pr-1">
                        <div class="form-group">
                            <label for="email">پست الکترونیکی</label>
                            <input type="email" class="form-control @if(strlen($user->email)==0) is-invalid @endif"  @if(strlen($user->email)>0) value="{{$user->email}}" disabled @endif id="email"  />
                        </div>
                    </div>


                    <div class="col-md-4 px-1">
                        <div class="form-group">
                            <label>اینستاگرام</label>
                            <input type="text" class="form-control @if(strlen($user->instagram)==0) is-invalid @endif"  value="{{$user->instagram}}" disabled="disabled"  />
                        </div>
                    </div>
                    <div class="col-md-4 px-1">
                        <div class="form-group">
                            <label>تلگرام</label>
                            <input type="text" class="form-control @if(strlen($user->telegram)==0) is-invalid @endif"  value="{{$user->telegram}}" disabled="disabled"  />
                        </div>
                    </div>
                    <div class="col-md-4 px-1">
                        <div class="form-group">
                            <label>لینکدین</label>
                            <input type="text" class="form-control @if(strlen($user->linkedin)==0) is-invalid @endif"  value="{{$user->linkedin}}" disabled="disabled"  />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-user">
            <div class="card-header  bg-info">
                <h5 class="card-title">اطلاعات قرارداد</h5>
            </div>
            <div class="card-body" id="infoProfile">
                <div class="row">
                    <div class="col-md-4 px-1">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">جنسیت</label>
                            <div class="form-group">
                                <select class="form-control p-0 @if(strlen($user->sex)==0) is-invalid @endif" id="exampleFormControlSelect1" disabled="disabled" >
                                    <option selected disabled>انتخاب کنید</option>
                                    <option value="0"  {{ $user->sex =="0" ? 'selected='.'"'.'selected'.'"' : '' }}>زن</option>
                                    <option value="1" {{ $user->sex =="1" ? 'selected='.'"'.'selected'.'"' : '' }}>مرد</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 pr-1">
                        <div class="form-group">
                            <label>تاهل</label>
                            <div class="form-group">
                                <select class="form-control p-0 @if(strlen($user->married)==0) is-invalid @endif" id="exampleFormControlSelect1" disabled="disabled" >
                                    <option selected disabled>انتخاب کنید</option>
                                    <option value="0" {{ $user->married =="0" ? 'selected='.'"'.'selected'.'"' : '' }}>مجرد</option>
                                    <option value="1" {{ $user->married =="1" ? 'selected='.'"'.'selected'.'"' : '' }}>متاهل</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-4 px-1">
                        <div class="form-group">
                            <label>تحصیلات</label>
                            <select class="custom-select @if(strlen($user->education)==0) is-invalid @endif" disabled="disabled"    id="education">
                                <option selected disabled>انتخاب کنید</option>
                                <option @if($user->education=='سیکل') selected   @endif>سیکل</option>
                                <option @if($user->education=='دیپلم') selected   @endif>دیپلم</option>
                                <option @if($user->education=='فوق دیپلم') selected   @endif>فوق دیپلم</option>
                                <option @if($user->education=='لیسانس') selected   @endif>لیسانس</option>
                                <option @if($user->education=='فوق لیسانس') selected   @endif>فوق لیسانس</option>
                                <option @if($user->education=='دکتری و بالاتر') selected   @endif>دکتری و بالاتر</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 pr-1">
                        <div class="form-group">
                            <label>رشته</label>
                            <div class="form-group">
                                <input type="text" class="form-control @if(strlen($user->reshteh)==0) is-invalid @endif"  value="{{$user->reshteh}}"    disabled="disabled"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 px-1">
                        <div class="form-group">
                            <label>شغل</label>
                            <div class="form-group">
                                <input type="text" class="form-control @if(strlen($user->job)==0) is-invalid @endif"  value="{{$user->job}}" disabled="disabled" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('footerScript')
    <link href="{{asset('/dashboard/assets/css/jquery.rating.css')}}" rel="stylesheet"/>
    <script src="{{asset('/dashboard/assets/js/jquery.rating.js')}}"></script>
    <script>
        $('.star-demo').rating({
            // configs here
        });
    </script>
@endsection
