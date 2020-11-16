@extends('panelAdmin.master.index')
@section('rowcontent')
    <div class="col-12">
        <div class="card card-chart">
            <div class="card-header">
                <h5 class="card-title">پیام ها</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="/admin/messages/send">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="subjectMessage">موضوع</label>
                        <input type="text" class="form-control" id="subjectMessage" name="subject" lang="fa" />
                    </div>
                    <div class="form-group">
                        <label for="listMessage">بخش/فرد</label>
                        <select class="form-control" id="listMessage" name="user_id_recieve">
                            <option disabled selected>انتخاب کنید</option>
                            @if(strlen($introduced)>0)
                                <option value="{{$introduced->id}}">معرف شما - {{$introduced->fname}} {{$introduced->lname}}</option>
                            @endif
                            <option value="3">مالی</option>
                            <option value="4">آموزش</option>
                            <option value="2">مدیریت</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="commentMessage">متن</label>
                        <textarea class="form-control" id="commentMessage" rows="3" name="comment" lang="fa"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">ارسال پیام</button>

                </form>
            </div>
        </div>
    </div>
@endsection
