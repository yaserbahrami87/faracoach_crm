<!-- *********** List moarefi shodeha -->
<div class="card">
    <div class="card-header">
        <h4 class="card-title">افراد دعوت شده</h4>
    </div>
    <div class="card-body">
        <ul class="list-unstyled team-members">
            @foreach($listIntroducedUser as $item)
            <li>
                <div class="row">
                    <div class="col-md-2 col-2">
                        <div class="avatar">
                            <img src={{asset("/documents/users/".$item->personal_image)}} class="img-circle img-no-padding img-responsive" />
                        </div>
                    </div>
                    <div class="col-md-7 col-7">{{$item->fname}} {{$item->lname}}
                        <br />
                        @switch($item->type)
                            @case('1')
                                <span class="text-warning"><small>بررسی نشده</small></span>
                                @break
                            @case('11')
                                <span class="text-primary"><small>در حال پیگیری</small></span>
                                @break
                            @case('12')
                                <span class="text-danger"><small>انصراف</small></span>
                                @break
                            @case('20')
                                <span class="text-success"><small>دانشجو</small></span>
                                @break
                            @default
                                <span class="text-dark"><small>نامشخص</small></span>
                        @endswitch
                    </div>

                    <div class="col-md-3 col-3 text-right">
                        <a href="/admin/user/{{$item->id}}" class="btn btn-sm btn-outline-success btn-round btn-icon text-success" ><i class="fa fa-group"></i></a>
                    </div>

                </div>
            </li>
            @endforeach
        </ul>
    </div>
</div>
