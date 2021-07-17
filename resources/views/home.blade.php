@extends('master.index')

@section('headerscript')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
@endsection

@section('row1')
<div class="row mt-5">
    <div class="col-md-3 ">
        <article class="card mb-3" >
            <div class="card-body">
                <h6 class="card-title pb-3 border-bottom">آخرین مقالات  </h6>
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
        <h3 class="pb-3 border-bottom mb-3">آخرین دلنوشته ها  </h3>
        @if(Auth::check())
                <div class="card-body p-0">
                    <div class="media pb-2 pt-2">
                        <img src="{{asset('/documents/users/'.Auth::user()->personal_image)}}" class="mr-3 rounded-circle"  width="50px" height="50px" alt="...">
                        <div class="media-body pt-3">
                            <div class="custom-file">
                                <button type="button" class="btn btn-block btn-secondary" data-toggle="modal" data-target="#exampleModal" >دلنوشته جدید</button>
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
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" id="insert_tweet">انتشار</button>
                            </div>
                        </div>
                    </div>
                </div>

        @endif
        <h6 class="card-title mt-4 pb-3 border-bottom">آخرین دلنوشته ها  </h6>
        @foreach($tweets as $item)
            <article class="card mb-3" >
                <div class="card-body">
                    <div class="media pb-2 pt-2">
                        <img src="{{$item->image}}" class="mr-3 rounded-circle border"  width="50px" height="50px" alt="...">
                        <div class="media-body pt-3">
                            <h6 class="mt-0 text-justify">{{$item->title}}</h6>
                            <small>{{$item->time}} قبل</small>
                            <small>منتشر شده توسط
                                <a href="{{asset('/'.$item->username)}}" target="_blank">
                                    <small>{{$item->username}}</small>
                                </a>
                            </small>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-muted">
                    <a href="">
                        <i class="bi bi-suit-heart-fill"></i>
                    </a>
                    <a href="">
                        <i class="bi bi-suit-heart"></i>
                    </a>
                    <small>0 نفر پسندید</small>
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
        $('#insert_tweet').click(function()
        {
            console.log('asdasdads');
            var loading = '<div class="col-12 text-center"><div class="spinner-border text-primary text-center" role="status"><span class="sr-only">Loading...</span></div></div>';
            $("#div_error").html(loading);
            var data=$('#tweetForm').serialize();
            $.ajax({
                type: 'POST',
                url: "/tweets/" ,
                data:data,
                statusCode: {
                    // 422: function() {
                    //     $("#div_error").html('<div class="alert alert-danger" role="alert">لطفا تمامی فیلدها رو پر کنید</div>');
                    // },
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
    <script src="https://cdn.ckeditor.com/4.16.1/basic/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'tweet' ,
            {
                language:'fa'
            });
    </script>
@endsection
