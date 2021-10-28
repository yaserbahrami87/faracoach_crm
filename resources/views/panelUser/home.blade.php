@extends('panelUser.master.index')
@section('rowcontent')
    <div class="col-xs-12 col-md-4 col-lg-4 col-xl-4">
        @include('panelUser.boxProfile')
        @if(! is_null($bookoff))
            <div class="alert alert-warning text-center">
                کد تخفیف خرید کتاب 'کوچینگ چیست':
                <b>FARABOOK</b>
                <a href="https://faracoach.com/product/%DA%A9%D8%AA%D8%A7%D8%A8-%DA%A9%D9%88%DA%86%DB%8C%D9%86%DA%AF/" class="btn btn-success mt-3" target="_blank">لینک خرید</a>
            </div>
        @endif
    </div>
    <div class="col-xs-12 col-md-8 col-lg-8 col-xl-8">
        <div class="row">
            @include('panelUser.cardBox')
        </div>
    </div>
@endsection
