<div class="card card-user">
    <div class="card-header">
        <h5 class="card-title">پیگیری جدید</h5>
    </div>
    <div class="card-body">
        @if($errors->any())
            <div class="col-12">
                <div class="alert alert-danger" role="alert">
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </div>
            </div>
        @endif
        <form method="POST" action="/admin/followup/create/" >
            {{csrf_field()}}
                <div class="row">
                    <input type="hidden" name="insert_user_id" value="{{$userAdmin->id}}" />
                    <input type="hidden" name="user_id" value="{{$user->id}}"/>
                    <div class="col-md-4 pl-1">
                        <div class="form-group">
                            <label>نتیجه پیگیری</label>
                            <select class="form-control" id="exampleFormControlSelect1" name="followup" >
                                <option disabled="disabled" selected >نتیجه را مشخص کنید</option>
                                @foreach($problemFollowup as $item)
                                    <option value="{{$item->id}}" >{{$item->problem}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 pl-1">
                        <div class="form-group">
                            <label>وضعیت پس از پیگیری</label>
                            <select class="form-control" id="exampleFormControlSelect1" name="status_followups" >
                                    <option disabled="disabled" selected >وضعیت را انتخاب کنید</option>
                                    <option class="primary_bg_admin" value="11" >در حال پیگیری</option>
                                    <option class="danger_bg_admin" value="12" >انصراف</option>
                                    <option class="success_bg_admin" value="20" >دانشجو</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>توضیحات</label>
                            <textarea class="form-control textarea"  lang="fa" name="comment"></textarea>
                        </div>
                    </div>
                </div>
            <div class="row">
                <div class="col-md-4 pl-1">
                    <div class="form-group">
                        <label>تاریخ پیگیری</label>
                        <input type="text" class="form-control"  id="dateFollow"  name="date_fa" />
                    </div>
                </div>
                <div class="col-md-4 px-1">
                    <div class="form-group">
                        <label>ساعت پیگیری</label>
                        <input type="text" class="form-control" value="" name="time_fa" id="time_fa" />
                    </div>
                </div>
                <div class="col-md-4 pl-1">
                    <div class="form-group">
                        <label>تاریخ پیگیری بعد</label>
                        <input type="text" class="form-control"  value="" name="nextfollowup_date_fa" id="nextfollowup_date_fa" />
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
