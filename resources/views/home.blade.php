@extends('master.index')
@section('headerscript')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <style>
        .back{
            width:100%;
            height:380px;
            padding:0;
        }
        .services{
            width:100%;
            height:165px;
            background: rgba(2,1,19,.81);
            margin-top:-165px;
        }
        .back .rounded-circle{
            width:85px;
            height:85px;
            background: rgba(2,1,19,.81);
            float:left;
            margin: -40px 0px 0px 50px;
            padding:23px;
        }
        .bi{
            color: #ffff;
            font-size: 36px;
        }
        .bi:hover{
            color:orange;
        }
        i > p{
            color: #ffff;
            font-size: 16px;
            margin-top: 18px;
            width: 122px;
            margin-right: -36px;
            text-align: center;
        }
        i > p:hover{
            color:orange;
        }
        @media only screen and (max-width: 321px){
            .services{
                background:rgb(210 210 210);
                height:75px;
                padding:0;
            }
            .back .rounded-circle {
                width: 39px;
                height: 39px;
                background: rgb(222 222 222 / 97%);
                float: left;
                margin: -17px 4px 0;
                padding: 11px;
            }
            .bi{
                font-size: 16px;
                text-align:center;
                color:#31303f;
            }
            i > p {
                font-size: 11px;
                font-weight: bold;
                margin-top: 8px;
                width: 47px;
                margin-right: -17px;
                color:rgba(2,1,19,.81);
            }
        }
    </style>
@endsection
@section('row1')
    <div class="row" id="">
        <div class="col-md-12 back">
            <img src="{{asset('/images/coach1-1.png')}}" alt=""/>
            <div class="col-12 services d-md-flex justify-content-md-center">
                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-0">
                </div>
                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 ">
                    <div class= "rounded-circle ">
                        <i class="bi bi-cart3 ">
                            <p> خرید محصول </p>
                        </i>
                    </div>
                    <div class=" rounded-circle">
                        <i class="bi bi-book">
                            <p> خرید دوره </p>
                        </i>
                    </div>
                    <div class="rounded-circle">
                        <a href="{{asset('/coaches/all')}}">
                            <i class="bi bi-person">
                                <p> انتخاب کوچ </p>
                            </i>
                        </a>
                    </div>
                    <div class=" rounded-circle">
                        <a href="{{asset('/coaches/all')}}">
                            <i class="bi bi-calendar2-date">
                                <p> رزرو جلسه کوچینگ </p>
                            </i>
                        </a>
                    </div>
                    <div class="rounded-circle">
                        <i class="bi bi-display">
                            <p> وبینارها </p>
                        </i>
                    </div>
                    <div class="rounded-circle">
                        <a tel="02191091121" >
                            <i class="bi bi-telephone-outbound">
                                <p> سوالی دارید ؟ </p>
                            </i>
                        </a>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-0">
                </div>
            </div>
        </div>
    </div>
@endsection
@section('row2')

    <div class="row mt-5">
        <div class="col-md-3 ">
            <article class="card mb-3" >
                <div class="card-body">
                    <h6 class="card-title pb-3 border-bottom">آخرین مقالات شما  </h6>
                    @foreach($posts as $item)
                    <div class="media border-bottom pb-2 pt-2">
                        <img src="{{$item->image}}" class="mr-3"  width="100px" alt="...">
                        <div class="media-body pt-3">
                            <a href="{{asset('/'.$item->username.'/post/'.$item->shortlink)}}" target="_blank">
                                <h6 class="mt-0 text-justify">{{$item->title}}</h6>
                            </a>
                            <small>منتشر شده توسط
                                <a href="{{asset('/'.$item->username)}}" target="_blank">
                                    <small>{{$item->username}}</small>
                                </a>
                            </small>
                        </div>
                    </div>
                    @endforeach
                </div>
            </article>
            <aside class="card" >
                <div class="card-body">
                    <h6 class="card-title pb-3 border-bottom">کاربرهای فعال</h6>
                    @foreach($last_users as $item)
                    <div class="avatar pb-3 d-inline">
                        @if(strlen($item->personal_image)>0)
                            <img src="{{asset('/documents/users/'.$item->personal_image)}}" class="border mr-3 rounded-circle"  width="50px" height="50px"  alt="{{$item->fname}} {{$item->lname}}" data-toggle="tooltip" data-placement="top" title="{{$item->fname}} {{$item->lname}}" />
                        @else
                            <img src="{{asset('/documents/users/default-avatar.png')}}" class="border mr-3 rounded-circle"  width="50px" height="50px"  alt="{{$item->fname}} {{$item->lname}}" title="{{$item->fname}} {{$item->lname}}" data-toggle="tooltip" data-placement="top" />
                        @endif
                    </div>
                    @endforeach
            </div>
        </aside>
    </div>
    <div class="col-md-6">
        <!--  <h3 class="pb-3 border-bottom mb-3">آخرین دلنوشته ها  </h3> -->
        @if(Auth::check())
                <div class="card-body p-0">
                    <div class="media pb-2 pt-2">
                        <img src="{{asset('/documents/users/'.Auth::user()->personal_image)}}" class="mr-3 rounded-circle"  width="50px" height="50px" alt="...">
                        <div class="media-body pt-3">
                            <div class="custom-file">
                                <button type="button" class="btn btn-block btn-secondary" data-toggle="modal" data-target="#exampleModal" >نوشته جدید</button>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">دلنوشته جدید</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post" id="tweetForm">
                                    {{csrf_field()}}
                                    <div id="div_error">

                                    </div>
                                    <textarea name="tweet" id="tweet"></textarea>

                                    <div class="form-group">
                                        <label for="status">نمایش برای</label>
                                        <select class="form-control" id="status" name="status">
                                            <option selected disabled>انتخاب کنید</option>
                                            <option value="0">فقط خودم</option>
                                            <option value="1">همه</option>
                                            <option value="2">اعضا</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" id="insert_tweet">انتشار</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
                            </div>
                        </div>
                    </div>
                </div>

        @endif
        <h6 class="card-title mt-4 pb-3 border-bottom">آخرین نوشته ها  </h6>
        @foreach($tweets as $item)
                        <article class="card mb-3" >
                            <div class="card-body">
                                <div class="media pb-2 pt-2">
                                    @if(strlen($item->personal_image)>0)
                                    <img src="{{asset('/documents/users/'.$item->personal_image)}}" class="mr-3 rounded-circle border"  width="50px" height="50px" alt="...">
                                    @else
                                        <img src="{{asset('/documents/users/default-avatar.png')}}" class="mr-3 rounded-circle border"  width="50px" height="50px" alt="...">
                                    @endif

                                    <div class="media-body pt-3">
                                        {!! $item->tweet !!}
                                        <small>منتشر شده توسط
                                            <a href="{{asset('/'.$item->username)}}" target="_blank">
                                                <small>{{$item->username}}</small>
                                            </a>
                                        </small>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-muted">
                                <div class="row">
                                    <div id="like{{$item->id}}" class="col-6">
                                    @if(Auth::check())
                                        @if($item->status_like==true)
                                            <!-- <a href="" class="dislikes" description="{{$item->like[0]->id}}" post="{{$item->id}}" >
                                                <i class="bi bi-heart-fill"></i>
                                            </a> -->
                                        @else
                                            <!--
                                            <a href='' class='likes' description='{{$item->id}}' >
                                                <i class='bi bi-heart'></i>
                                            </a>-->
                                        @endif
                                    @endif
                                    <!-- <small> {{count($item->like)}}} نفر پسندیدند</small>  -->
                                    </div>
                                    <div class="col-6">
                                        <small class="float-left">{{$item->time}} قبل</small>
                                    </div>
                                </div>

                            </div>
                        </article>
                        @endforeach
                    </div>
                    <div class="col-md-3">
                        <aside class="card position-sticky" >
                            <div class="card-body">
                                <h6 class="card-title pb-3 border-bottom">کوچ های فعال</h6>
                                @foreach($last_coaches as $item)
                                    <div class="avatar pb-3 d-inline">
                                        <a href="/coach/{{$item->username}}">
                                            @if(strlen($item->personal_image)>0)
                                                <img src="{{asset('/documents/users/'.$item->personal_image)}}" class="mr-3 rounded-circle border"  width="50px" height="50px"  alt="{{$item->fname}} {{$item->lname}}" data-toggle="tooltip" data-placement="top" title="{{$item->fname}} {{$item->lname}}" />
                                            @else
                                                <img src="{{asset('/documents/users/default-avatar.png')}}" class="mr-3 rounded-circle border"  width="50px" height="50px"  alt="{{$item->fname}} {{$item->lname}}" title="{{$item->fname}} {{$item->lname}}" data-toggle="tooltip" data-placement="top" />
                                            @endif
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </aside>
                    </div>
                </div>
        @endsection
@section('footerScript')
<script>
$('.likes').click(function (e)
{
e.preventDefault();
var id=$(this).attr('description');
var _token= $('meta[name="csrf-token"]').attr('content');
$.ajax({
    method:'POST',
    url:'/like',
    data:{post_id :id,_token: _token},
    success:function(data)
    {
        $("#like"+id).html(data);
    }
});
});

$('.dislikes').click(function (e)
{
console.log("DISLIKE");
e.preventDefault();
var id=$(this).attr('description');
var post=$(this).attr('post');
var _token= $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        method:'DELETE',
        url:'/like/'+id,
        data:{post_id :id,_token: _token},
        success:function(data)
        {
            console.log(post);
            $("#like"+post).html(data);
        }
    });
});



$('#insert_tweet').click(function()
{
    var loading = '<div class="col-12 text-center"><div class="spinner-border text-primary text-center" role="status"><span class="sr-only">Loading...</span></div></div>';
    $("#div_error").html(loading);
    var data=$('#tweetForm').serialize();
        $.ajax({
            type: 'POST',
            url: "/tweets" ,
            data:data,
            statusCode: {
                422: function() {
                    $("#div_error").html('<div class="alert alert-danger" role="alert">خطا 422</div>');
                },
                500:function()
                {
                    $("#div_error").html("خطا 500");
                }
            },
            success: function (data) {
                $("#div_error").html(data);
            },
            error:function(data)
            {
                $("#div_error").html(data);
            }
        });
});

$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})
</script>


<script src="{{asset('/trumbowyg-2.25.1/dist/trumbowyg.min.js')}}"></script>
<script src="{{asset('/trumbowyg-2.25.1/dist/langs/fa.js')}}"></script>
<script>
$('#tweet').trumbowyg({
lang:'fa',
btns: [
    ['undo', 'redo'], // Only supported in Blink browsers
    ['formatting'],
    ['strong', 'em', 'del'],
    ['superscript', 'subscript'],
    ['link'],
    ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
    ['unorderedList', 'orderedList'],
    ['horizontalRule'],
    ['removeformat'],
    ['fullscreen']
]
})
</script>

@endsection
