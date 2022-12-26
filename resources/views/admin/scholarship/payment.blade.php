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
                    <option value="2" @if($scholarship->type_payment==2) selected @endif >پرداخت 5 قسط</option>
                </select>
                <input type="submit" class="btn btn-primary" value="ثبت نحوه پرداخت">
            </form>
        </div>
    </div>
@else
    <div class="alert alert-success">
        شماره فاکتور: {{$scholarship->financial}}
    </div>
    <table class="table  table-striped table-hover table-bordered">
        <tr class="text-center">
            <th>دوره</th>
            <th>واریزی (تومان) </th>
            <th>وام</th>
            <th>تاریخ ثبت نام</th>
            <th>ساعت ثبت نام</th>
            <th>پیگیری</th>
        </tr>
        <tr class="text-center">
            <td>{{$scholarship->get_financial->scholarship_course->course}}</td>
            <td>{{$scholarship->get_financial->schoalrshipPayment->pre_payment}}</td>
            <td>%{{$scholarship->get_financial->schoalrshipPayment->loan}}</td>
            <td>{{$scholarship->get_financial->schoalrshipPayment->date_fa}}</td>
            <td>{{$scholarship->get_financial->schoalrshipPayment->time_fa}}</td>
            <td>{{$scholarship->financial}}</td>
        </tr>

    </table>

@endif

