@extends('admin.master.index')

@section('headerScript')
    <style>
        .card-counter{
            box-shadow: 2px 2px 10px #DADADA;
            margin: 5px;
            padding: 20px 10px;
            background-color: #fff;
            height: 100px;
            border-radius: 5px;
            transition: .3s linear all;
        }

        .card-counter:hover{
            box-shadow: 4px 4px 20px #DADADA;
            transition: .3s linear all;
        }

        .card-counter.primary{
            background-color: #99caff;
            color: #000000;
        }

        .card-counter.danger{
            background-color: #ef5350;
            color: #FFF;
        }

        .card-counter.success{
            background-color: #66bb6a;
            color: #FFF;
        }

        .card-counter.info{
            background-color: #26c6da;
            color: #FFF;
        }

        .card-counter.warning{
            background-color: #ffff99;
            color: #FFF;
        }

        .card-counter i{
            font-size: 5em;
            opacity: 0.2;
        }

        .card-counter .count-numbers{
            position: absolute;
            right: 35px;
            top: 20px;
            font-size: 25px;
            display: block;
        }

        .card-counter .count-name{
            position: absolute;
            right: 35px;
            top: 65px;
            text-transform: capitalize;
            opacity: 0.5;
            display: block;
            font-size: 18px;
        }
    </style>
@endsection
@section('content')

    <div class="col-md-3">
        <div class="card-counter primary">
            <span class="count-numbers text-dark">
                @if(is_null(Auth::user()->wallet))
                    0
                @else
                    {{Auth::user()->wallet->amount}}
                @endif
                تومان
            </span>
            <span class="count-name text-dark"> موجودی کیف</span>
        </div>
        <form method="post" action="/panel/order">
            {{csrf_field()}}
            <input type="hidden" value="کیف پول" name="payment_type" />
            <div class="form-group">
                <label for="amount">مبلغ شارژ:</label>
                <input type="number" class="form-control" id="amount" name="amount" />
                <small class="text-muted">به تومان وارد کنید</small>
            </div>
            <button type="submit" class="btn btn-primary">شارژ کیف پول</button>
        </form>
    </div>

@endsection
