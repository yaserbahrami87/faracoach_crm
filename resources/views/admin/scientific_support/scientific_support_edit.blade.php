@extends('admin.master.index')
@section('content')
    <div class="col-6">

        <div class="card-header bg-secondary">
            <h5 class="card-title text-light">درخواست همکاری پشتیبان علمی</h5>
        </div>
        <div class="card-body bg-secondary-light">
            <div class="alert alert-warning">
                پر کردن تمامی فیلدها اجباریست
            </div>
            <form method="post" action="/admin/scientific_support/{{$scientific_support->id}}/changestatus">
                {{csrf_field()}}
                {{method_field('PATCH')}}
                <div class="form-group">
                    <label for="level">در چه سطحی از کوچینگ هستید؟</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="level" id="level" value="1"  @if(old('level',$scientific_support->level)==1) checked  @endif disabled >
                        <label class="form-check-label" for="level">
                            سطح 1
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="level" id="level1" value="2"  @if(old('level',$scientific_support->level)==2) checked  @endif disabled >
                        <label class="form-check-label" for="level1">
                            سطح 2
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="experience">تجربه برگزاری کدام یک از جلسات کوچینگ را دارید؟</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="experience" id="experience" value="1" @if(old('experience',$scientific_support->experience)==1) checked  @endif disabled >
                        <label class="form-check-label" for="experience">
                            جلسات دانشجویی
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="experience" id="experience1" value="2"  @if(old('experience',$scientific_support->experience)==2) checked  @endif disabled >
                        <label class="form-check-label" for="experience1">
                            جلسات بیرونی
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="certificates">گواهینامه های خود را ذکر کنید:</label>
                    <textarea class="form-control" id="certificates" name="certificates" rows="3" disabled >{{old('certificates',$scientific_support->certificates)}}</textarea>
                </div>
                <div class="form-group">
                    <label for="resume">سوابق کاری خود را بنویسید:</label>
                    <textarea class="form-control" id="resume" name="resume" rows="3" disabled >{{old('resume',$scientific_support->resume)}}</textarea>
                </div>
                <div class="form-group">
                    <label for="educational_activity">فعالیت های آموزشی (دوره ها و کارگاه هایی که شرکت کرده اید)</label>
                    <textarea class="form-control" id="educational_activity" name="educational_activity" rows="3" disabled >{{old('educational_activity',$scientific_support->educational_activity)}}</textarea>
                </div>
                <div class="form-group">
                    <label for="know_icdl">میزان آشنایی خود با ICDL را وارد کنید؟</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="know_icdl" id="know_icdl" value="1" @if(old('know_icdl',$scientific_support->know_icdl)==1) checked  @endif disabled >
                        <label class="form-check-label" for="know_icdl">
                            خوب
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="know_icdl" id="know_icdl1" value="2" @if(old('know_icdl',$scientific_support->know_icdl)==2) checked  @endif disabled >
                        <label class="form-check-label" for="know_icdl1">
                            متوسط
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="know_icdl" id="know_icdl0" value="0" @if(old('know_icdl',$scientific_support->know_icdl)==0) checked  @endif disabled >
                        <label class="form-check-label" for="know_icdl0">
                            ضعیف
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="free_time">زمان های آزاد در طول هفته خود را بنویسید:</label>
                    <textarea class="form-control" id="free_time" name="free_time" rows="3" disabled>{{old('free_time',$scientific_support->free_time)}}</textarea>
                </div>
                <div class="form-group">
                    <label for="blooming_experience">سوابق فعالیت در مسیر شکوفایی خود را بنویسید:</label>
                    <textarea class="form-control" id="blooming_experience" name="blooming_experience" rows="3" disabled>{{old('blooming_experience',$scientific_support->blooming_experience)}}</textarea>
                </div>
                <div class="form-group">
                    <label for="status">وضعیت</label>
                    <select class="form-control" id="status" name="status">
                        <option disabled selected>انتخاب کنید</option>
                        <option value="0" @if(old('status',$scientific_support->status)==0) selected  @endif >در حال بررسی</option>
                        <option value="1" @if(old('status',$scientific_support->status)==1) selected  @endif >تایید همکاری</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success">ارسال درخواست</button>
            </form>
        </div>

    </div>
@endsection
