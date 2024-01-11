@extends('user.master.index')

@section('headerScript')
    <style>
        #fff{
            border: 2px solid rgba(2,1,19,.81);
            border-radius:20px;
        }
        .progress
        {
            position:relative;
        }

        .progress span {
            position:absolute;
            left:0;
            width:100%;
            text-align:center;
            z-index:2;
            font-weigh:bold;
        }

        .progress{
            height: 25px;
            background: #262626;
            padding: 5px;
            overflow: visible;
            border-radius: 20px;
            border-top: 1px solid #000;
            border-bottom: 1px solid #7992a8;
            margin-top: 50px;
        }

        .progress .progress-bar{
            border-radius: 20px;
            position: relative;
            animation: animate-positive 2s;
        }

        .progress .progress-value{
            display: block;
            padding: 3px 7px;
            font-size: 13px;
            color: #fff;
            border-radius: 4px;
            background: #191919;
            border: 1px solid #000;
            position: absolute;
            top: -40px;
            right: -10px;
        }

        .progress .progress-value:after{
            content: "";
            border-top: 10px solid #191919;
            border-left: 10px solid transparent;
            border-right: 10px solid transparent;
            position: absolute;
            bottom: -6px;
            left: 26%;
        }

        .progress-bar.active{
            animation: reverse progress-bar-stripes 0.40s linear infinite, animate-positive 2s;
        }

        @-webkit-keyframes animate-positive{
            0% { width: 0; }
        }

        @keyframes animate-positive{
            0% { width: 0; }
        }

    </style>
@endsection

@section('content')
<div class="card-body" >
        <div class="container pb-4 mt-5">
            <div class="col-12 text-justify">
                <p>سلام به آزمون {{$exam->exam}} خوش آمدید </p>
                <p>{{$exam->description}}</p>

            </div>
        </div>
        <div class="container pb-4 mt-5 " id="fff">
            <div class=" d-flex justify-content-center">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12  progress">
                    <div class="progress-bar progress-bar-success progress-bar-striped active" style="width: 0%;">
                        <div class="progress-value">0%</div>
                    </div>
                </div>
            </div>
            <div class="container d-flex justify-content-center">
                <div class=" col-xl-6 col-lg-6 col-md-6 col-sm-12">
                    <form name="demo" id="demo" method="POST" action="/panel/exam/{{$exam->id}}" class="myBook mt-4">
                        {{csrf_field()}}
                        @foreach($exam->exam_questions->where('is_question',1) as $question)
                            <section >
                                <p>{{$loop->iteration.'-'.$question->title}}</p>

                                @foreach($question->answers as $answer)
                                    <input class="page-next" type="radio" id="vehicle{{$answer->id}}_{{$loop->iteration}}" name="answer{{$question->id}}" value="{{$answer->id}}" required />
                                    <label for="vehicle{{$answer->id}}_{{$loop->iteration}}">{{$answer->title}}</label><br>
                                @endforeach

                                <div class="col-12 text-center mt-3">
                                    <button type="button" class="page-prev btn btn-danger col-12 col-md-3">قبلی</button>
                                    <button type="button" class="page-next btn btn-primary col-12 col-md-3">بعدی</button>
                                </div>
                            </section>
                        @endforeach


                        <section class="page">
                            <!-- <a href="#">Terms of Service</a><br/>
                            <input type="checkbox" id="ts" name="ts" value="1" required />
                            <label for="ts"> I agree</label><br />
                            -->
                            <button type="button" class="page-prev btn btn-danger col-12 col-md-3">قبلی</button>
                            <button type="submit" class="page-next btn btn-success col-12 col-md-3" id="sendForm">ارسال پاسخ ها</button>
                        </section>
                        <!--
                        <section class="page" style="margin:auto;text-align:center">
                            فرم شما تکمیل شد.
                        </section>
                        -->
                    </form>
                </div>
            </div>
        </div>


</div>
@endsection

@section('footerScript')
    <script src="{{asset('/js/jquery.autotab.min.js')}}"></script>
    <script>
        $(function () {
            $('.code').autotab();
        });
    </script>
    <script src="{{asset('/js/jquery-3.5.1.min.js')}}" ></script>
    <script src="{{asset('/js/jquery-ui.min.js')}}" ></script>
    <script src="{{asset('/js/jquery-book.js')}}" ></script>
    <script src="{{asset('/js/jquery.validate.min.js')}}"></script>

    <script>
        $thing = $('#demo').book({
            onPageChange: updateProgress,
            speed:200}
        ).validate();


        function updateProgress(prevPageIndex, currentPageIndex, pageCount, pageName){
            t = (currentPageIndex / (pageCount-1)) * 100;
            $('.progress-bar').attr('aria-valuenow', t);
            $('.progress-bar').css('width', t+'%');
            //$('.progress span').text('Completed: '+Math.trunc(t)+'%');
            $('.progress-value').text(Math.trunc(t)+'%');
        }
    </script>
@endsection
