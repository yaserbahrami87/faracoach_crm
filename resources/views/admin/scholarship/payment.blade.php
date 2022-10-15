@if(is_null($scholarship->financial) )
    <div class="alert alert-warning">
        پرداختی انجام نشده است
    </div>
@else
    <div class="alert alert-success">
        شماره فاکتور: {{$scholarship->financial}}
    </div>

@endif

