@extends('panelUser.master.index')

@section('headerScript')
    <link rel="stylesheet" href="{{asset('/dashboard/dist/css/bootstrap-select.css')}}" />
@endsection
@section('rowcontent')
    <div class="col-xs-12 col-md-8 col-lg-8 col-xl-8">
        <div class="card-header bg-info">
            <h5 class="card-title">درخواست همکاری به عنوان کوچ</h5>
        </div>
        <div class="card-body">
            <p>برای همکاری با فراکوچ به عنوان کوچ لطفا فرم زیر را کامل پر کنید</p>
            <div class="alert alert-warning" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                </svg>
               اطلاعات سوابق شما ممکن است براساس سوابق موجود در سیستم فراکوچ تغییر کند
            </div>
            <form method="post" action="/panel/coach" >
                {{csrf_field()}}
                <div class="form-group">
                    <label for="education_background">سوابق تحصیلی *</label>
                    <textarea class="form-control @error('education_background') is-invalid @enderror " name="education_background" id="education_background" rows="3">@if(old('education_background')) {{old('education_background')}}@endif</textarea>
                </div>
                <div class="form-group">
                    <label for="certificates">گواهینامه ها *</label>
                    <textarea class="form-control @error('certificates') is-invalid @enderror " name="certificates" id="certificates" rows="3">@if(old('certificates')) {{old('certificates')}}@endif</textarea>
                </div>
                <div class="form-group">
                    <label for="experience">سوابق کاری *</label>
                    <textarea class="form-control @error('experience') is-invalid @enderror " name="experience" id="experience" rows="3">@if(old('experience')) {{old('experience')}}@endif</textarea>
                </div>
                <div class="form-group">
                    <label for="skills">مهارت ها *</label>
                    <textarea class="form-control @error('skills') is-invalid @enderror " name="skills" id="skills" rows="3">@if(old('skills')) {{old('skills')}}@endif</textarea>
                </div>
                <div class="form-group">
                    <label for="researches">سوابق مقالات </label>
                    <textarea class="form-control @error('researches') is-invalid @enderror " name="researches" id="researches" rows="3">@if(old('researches')) {{old('researches')}}@endif</textarea>
                </div>
                <div class="form-group">
                    <label for="count_meeting">تعداد ساعت جلسات گذرانده شده *</label>
                    <input type="number" class="form-control" id="count_meeting" name="count_meeting" aria-describedby="count_meetingHelp" min="0" max="10000" @if(old('count_meeting')) value='{{old('count_meeting')}}' @endif/>
                    <small id="count_meetinglHelp" class="form-text text-muted"> تعداد ساعت جلساتی که تاکنون گذرانده اید را وارد کنید</small>
                </div>
                <div class="form-group">
                    <label for="customer_satisfaction">تعداد رضایت مشتریان *</label>
                    <input type="number" class="form-control" id="customer_satisfaction" name="customer_satisfaction" aria-describedby="customer_satisfactiongHelp" min="0" max="1000" @if(old('customer_satisfaction')) value='{{old('customer_satisfaction')}}' @endif />
                    <small id="customer_satisfactionHelp" class="form-text text-muted"> تعداد افرادی که رضایت کامل از جلسات مشاوره داشته اند وارد کنید</small>
                </div>
                <div class="form-group">
                    <label for="change_customer">تعداد تبدیل مشتری *</label>
                    <input type="number" class="form-control" id="change_customer" name="change_customer" aria-describedby="change_customerHelp" min="0" max="1000" @if(old('change_customer')) value='{{old('change_customer')}}' @endif />
                    <small id="change_customerHelp" class="form-text text-muted"> تعداد افرادی که تبدیل به مشتری وفادارا شده اند را وارد کنید</small>
                </div>
                <div class="form-group">
                    <label for="count_recommendation">تعداد توصیه نامه *</label>
                    <input type="number" class="form-control" id="count_recommendation" name="count_recommendation" aria-describedby="count_recommendationHelp" min="0" max="1000" @if(old('count_recommendation')) value='{{old('count_recommendation')}}' @endif />
                    <small id="count_recommendationHelp" class="form-text text-muted"> تعداد توصیه نامه هایی که تاکنون داشته اید را وارد کنید</small>
                </div>
                <div class="form-group">
                    <label for="category">دسته بندی ها *</label>
                    <div class="form-group">
                        <select class="form-control selectpicker" multiple data-live-search="true" id="category" name="category[]" >
                            @foreach($categoryCoaches as $item)
                                <option value="{{$item->id}}">{{$item->category}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="typecoach_id">سطح *</label>
                    <div class="form-group">
                        <select class="form-control" name="typecoach_id"  id="typecoach_id">
                            @foreach($typeCoach as $item)
                                <option value="{{$item->id}}">{{$item->type}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">انتشار</button>
            </form>
        </div>
    </div>
@endsection

@section('footerScript')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('/dashboard/dist/js/bootstrap-select.min.js')}}"></script>
    <script type="text/javascript">
        $(function () {
            $('select').selectpicker();
        });
    </script>
@endsection
