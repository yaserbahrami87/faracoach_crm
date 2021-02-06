@extends('master.index')
@section('row1')
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-4 col-lg-4 col-xl-4 mt-5" id="coach_profile">
                    <div class="card hovercard">
                        <div class="cardheader">

                        </div>
                        <div class="avatar">
                            <img alt="" src="{{asset('/documents/users/'.$coach->image)}}">
                        </div>
                        <div class="info">
                            <div class="title">
                                <a href="#">{{$coach->fname}} {{$coach->lname}}</a>
                            </div>
                            <div class="desc">{{$coach->education}}</div>
                            <div class="desc">{{$coach->type}}</div>
                            <div class="desc">شهر: {{$coach->city}}</div>
                        </div>
                        <div class="bottom">
                            <a class="btn btn-primary btn-twitter btn-sm" href="#">
                                <i class="fa fa-google-plus"></i>
                            </a>
                            <a class="btn btn-danger btn-sm" href="#">
                                <i class="fa fa-google-plus"></i>
                            </a>
                            <a class="btn btn-primary btn-sm"
                               href="mailto:{{$coach->email}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                                    <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383l-4.758 2.855L15 11.114v-5.73zm-.034 6.878L9.271 8.82 8 9.583 6.728 8.82l-5.694 3.44A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.739zM1 11.114l4.758-2.876L1 5.383v5.73z"/>
                                </svg>
                            </a>
                            <a class="btn btn-primary btn-twitter btn-sm" href="tel:{{$coach->tel}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
            </div>
            <div class="col-xs-12 col-md-8 col-lg-8 col-xl-8 mt-5 text-left pt-5" id="coach_profile_details">
                    {!! $coach->biography !!}
            </div>
        </div>
    </div>
@endsection
