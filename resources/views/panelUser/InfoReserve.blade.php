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
