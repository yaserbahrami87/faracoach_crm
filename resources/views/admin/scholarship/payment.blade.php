@if(is_null($scholarship->financial) )
    <div class="alert alert-warning">
        پرداختی انجام نشده است
    </div>
    <div class="row">
        <div class="col-4 mx-auto text-center">
            <form method="post" action="/admin/scholarship/{{$scholarship->id}}/type_payment">
                {{csrf_field()}}
                <label for="exampleFormControlSelect1">روش پرداخت</label>
                <select class="form-control mb-1" name="type_payment">
                    <option value="0" @if($scholarship->type_payment==0) selected @endif >پرداخت عادی</option>
                    <option value="1" @if($scholarship->type_payment==1) selected @endif >پرداخت ویژه</option>
                </select>
                <input type="submit" class="btn btn-primary" value="ثبت نحوه پرداخت">
            </form>
        </div>
    </div>
@else
    <div class="alert alert-success">
        شماره فاکتور: {{$scholarship->financial}}
    </div>

@endif

