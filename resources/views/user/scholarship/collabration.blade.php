<form method="post" action="">
<div class="row">
    <div class="col-12 col-md-3">

    </div>
    <div class="col-12 col-md-9">
            <div class="row" id="collabration_category">
                @foreach($collabration_category as $item)
                    <div class="col-6 col-md-4  bg-primary p-1 rounded rounded-lg">
                        <button type="button" class="collabration_category btn btn-primary btn-block" data="{{$item->id}}" onclick="collabration_category({{$item->id}})" >{{$item->category}}</button>
                    </div>
                @endforeach
            </div>
    </div>




</div>
</form>
