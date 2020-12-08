@extends('panelUser.master.index')
@section('rowcontent')
    <div class="col-xs-12 col-sm-6 col-xl-6 col-lg-6">
    @if($user->followby_id=='2')
        @include('panelUser.insertFollowUp')
    @else
            <div class="alert alert-warning" role="alert">
                ثبت پیگیری توسط شما امکانپذیر نمی باشد
            </div>
    @endif
    </div>
    <div class="col-xs-12 col-sm-6 col-xl-6 col-lg-6">
        @include('panelUser.followups')
    </div>

@endsection
