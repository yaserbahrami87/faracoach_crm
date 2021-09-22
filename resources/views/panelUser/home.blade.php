@extends('panelUser.master.index')
@section('rowcontent')
    <div class="col-xs-12 col-md-4 col-lg-4 col-xl-4">
        @include('panelUser.boxProfile')
        <div class="row">
            <div class="col-12">
                <a href="/panel/profile" class="shadow-lg btn btn-warning btn-block btn-lg text-justify">برای شرکت در قرعه کشی <span class="text-danger text-bold" style="font-size: 1.25rem">1 میلیون تومان </span>هدیه شرکت در دوره های آموزشی فراکوچ لطفا پروفایل خود را تکمیل فرمائید</a>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-md-8 col-lg-8 col-xl-8">
        <div class="row">
            @include('panelUser.cardBox')
        </div>
    </div>
@endsection
