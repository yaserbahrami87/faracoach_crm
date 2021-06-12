@extends('panelAdmin.master.index')
@section('headerScript')
    <link rel="stylesheet" href="{{asset('/dashboard/dist/css/bootstrap-select.css')}}" />
@endsection
@section('rowcontent')
    <div class="col-xs-12 col-md-8 col-lg-8 col-xl-8">
        <div class="card-body">
            <form method="post" action="/admin/coach/{{$coach->id}}" >
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
                    <input type="number" class="form-control" id="count_meeting" name="count_meeting" aria-describedby="count_meetingHelp" min="0" max="10000" value="{{$coach->count_meeting}}"/>
                    <small id="count_meetinglHelp" class="form-text text-muted"> تعداد ساعت جلساتی که تاکنون گذرانده اید را وارد کنید</small>
                </div>
                <div class="form-group">
                    <label for="customer_satisfaction">تعداد رضایت مشتریان *</label>
                    <input type="number" class="form-control" id="customer_satisfaction" name="customer_satisfaction" aria-describedby="customer_satisfactiongHelp" min="0" max="1000" value="{{$coach->customer_satisfaction}}"/>
                    <small id="customer_satisfactionHelp" class="form-text text-muted"> تعداد افرادی که رضایت کامل از جلسات مشاوره داشته اند وارد کنید</small>
                </div>
                <div class="form-group">
                    <label for="change_customer">تعداد تبدیل مشتری *</label>
                    <input type="number" class="form-control" id="change_customer" name="change_customer" aria-describedby="change_customerHelp" min="0" max="1000" value="{{$coach->change_customer}}"/>
                    <small id="change_customerHelp" class="form-text text-muted"> تعداد افرادی که تبدیل به مشتری وفادارا شده اند را وارد کنید</small>
                </div>
                <div class="form-group">
                    <label for="count_recommendation">تعداد توصیه نامه *</label>
                    <input type="number" class="form-control" id="count_recommendation" name="count_recommendation" aria-describedby="count_recommendationHelp" min="0" max="1000" value="{{$coach->count_recommendation}}"/>
                    <small id="count_recommendationHelp" class="form-text text-muted"> تعداد توصیه نامه هایی که تاکنون داشته اید را وارد کنید</small>
                </div>
                <div class="form-group">
                    <label for="count_meeting">دسته بندی ها *</label>
                    <div class="form-group">
                        <select class="form-control selectpicker" multiple data-live-search="true" name="category[]" id="selectpicker" >
                            @foreach($categoryCoaches as $item)
                                    <option value="{{$item->id}}" >{{$item->category}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="status">وضعیت </label>
                    <select class="form-control" id="status" name="status">
                        <option disabled selected>انتخاب کنید</option>
                        <option value="1" @if($coach->status==1) selected @endif>کوچ حرفه ای</option>
                        <option value="-2" @if($coach->status==-2) selected @endif>رد درخواست</option>
                        <option value="2" @if($coach->status==2) selected @endif>غیرفعال</option>
                    </select>
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
