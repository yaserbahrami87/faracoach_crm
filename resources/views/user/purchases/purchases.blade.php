@extends('user.master.index')
@section('content')
<div class="col-12">
    <table class="table text-center">
        <tr>
            <th>محصول</th>
            <th>نمایش</th>
        </tr>
        @foreach(Auth::user()->purchases->where('status',1) as $purchase)
            <tr>
                <td>{{$purchase->product->product}}</td>
                <td>
                    <a href="" class="btn btn-success">
                        نمایش
                    </a>
                </td>
            </tr>

        @endforeach
    </table>
</div>
@endsection
