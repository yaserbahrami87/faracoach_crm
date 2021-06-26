@extends('panelUser.master.index')
@section('headerScript')
    <link rel="stylesheet" href="{{asset('/dashboard/dist/css/bootstrap-select.css')}}" />
@endsection

@section('rowcontent')
    <div class="col-xs-12 col-md-8 col-lg-8 col-xl-8">
        <div class="card-body">
            <form method="post" action="@if($coach->status!=1) /panel/coach/{{$coach->id}}/newrequest @else /panel/coach/{{$coach->id}}/updateCoach @endif" >
                {{csrf_field()}}
                {{method_field('PATCH')}}

                <div class="form-group">
                    <label for="education_background">سوابق تحصیلی *</label>
                    <textarea class="form-control @error('education_background') is-invalid @enderror " name="education_background" id="education_background" rows="3">{{$coach->education_background}}</textarea>
                </div>
                <div class="form-group">
                    <label for="certificates">گواهینامه ها *</label>
                    <textarea class="form-control @error('certificates') is-invalid @enderror " name="certificates" id="certificates" rows="3">{{$coach->certificates}}</textarea>
                </div>
                <div class="form-group">
                    <label for="experience">سوابق کاری *</label>
                    <textarea class="form-control @error('experience') is-invalid @enderror " name="experience" id="experience" rows="3">{{$coach->experience}}</textarea>
                </div>
                <div class="form-group">
                    <label for="skills">مهارت ها *</label>
                    <textarea class="form-control @error('skills') is-invalid @enderror " name="skills" id="skills" rows="3">{{$coach->skills}}</textarea>
                </div>
                <div class="form-group">
                    <label for="researches">سوابق مقالات </label>
                    <textarea class="form-control @error('researches') is-invalid @enderror " name="researches" id="researches" rows="3">{{$coach->researches}}</textarea>
                </div>
                <div class="form-group">
                    <label for="count_meeting">تعداد ساعت جلسات گذرانده شده *</label>
                    <input type="number" class="form-control" id="count_meeting" @if($coach->status==1) disabled @else name="count_meeting" @endif aria-describedby="count_meetingHelp" min="0" max="10000" value="{{$coach->count_meeting}}"/>
                    <small id="count_meetinglHelp" class="form-text text-muted"> تعداد ساعت جلساتی که تاکنون گذرانده اید را وارد کنید</small>
                </div>
                <div class="form-group">
                    <label for="customer_satisfaction">تعداد رضایت مشتریان *</label>
                    <input type="number" class="form-control" id="customer_satisfaction" @if($coach->status==1) disabled @else name="customer_satisfaction" @endif aria-describedby="customer_satisfactiongHelp" min="0" max="1000" value="{{$coach->customer_satisfaction}}"/>
                    <small id="customer_satisfactionHelp" class="form-text text-muted"> تعداد افرادی که رضایت کامل از جلسات مشاوره داشته اند وارد کنید</small>
                </div>
                <div class="form-group">
                    <label for="change_customer">تعداد تبدیل مشتری *</label>
                    <input type="number" class="form-control" id="change_customer" @if($coach->status==1) disabled @else name="change_customer" @endif aria-describedby="change_customerHelp" min="0" max="1000" value="{{$coach->change_customer}}"/>
                    <small id="change_customerHelp" class="form-text text-muted"> تعداد افرادی که تبدیل به مشتری وفادارا شده اند را وارد کنید</small>
                </div>
                <div class="form-group">
                    <label for="count_recommendation">تعداد توصیه نامه *</label>
                    <input type="number" class="form-control" id="count_recommendation" @if($coach->status==1) disabled @else name="count_recommendation" @endif aria-describedby="count_recommendationHelp" min="0" max="1000" value="{{$coach->count_recommendation}}"/>
                    <small id="count_recommendationHelp" class="form-text text-muted"> تعداد توصیه نامه هایی که تاکنون داشته اید را وارد کنید</small>
                </div>
                <div class="form-group">
                    <label for="selectpicker">دسته بندی ها *</label>
                    <div class="form-group">
                        <select class="form-control selectpicker" multiple data-live-search="true" name="category[]" id="selectpicker" >
                            @foreach($categoryCoaches as $item)
                                <option value="{{$item->id}}" >{{$item->category}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="typecoach_id">سطح *</label>
                    <div class="form-group">
                        <select class="form-control"  name="typecoach_id" id="typecoach_id" >
                            <option selected disabled>انتخاب کنید</option>
                            @foreach($typeCoaches as $item)
                                <option value="{{$item->id}}" @if($item->id==$coach->typecoach_id) selected @endif >{{$item->type}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">بروزرسانی اطلاعات و در خواست مجدد</button>
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

        var a=$('#selectpicker option');
        @foreach($coach->category as $item)
            for(i=0;i<a.length ;i++)
            {
                if(a[i].value=={{$item}})
                {
                    a[i].setAttribute("selected","selected");
                }
            }
        @endforeach
    </script>
@endsection
