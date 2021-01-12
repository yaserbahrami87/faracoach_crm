@extends('panelAdmin.master.index')
@section('rowcontent')
    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
        <form method="post" action="/admin/settings/categorytags/update/{{$categoryTag->id}}">
            {{csrf_field()}}
            {{method_field('PATCH')}}
            <div class="form-group">
                <label for="category">نتیجه پیگیری</label>
                <input type="text" class="form-control" id="category" lang="fa" name="category"  value="{{$categoryTag->category}}"/>
            </div>
            <div class="form-group">
                <label for="statusProblem" >وضعیت</label>
                <select class="form-control p-0" id="statusProblem" name="status">
                    <option disabled="disabled" selected>انتخاب کنید</option>
                    <option value="1" @if($categoryTag->status==1) selected @endif >انتشار</option>
                    <option value="0" @if($categoryTag->status==0) selected @endif >عدم انتشار</option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">ذخیره</button>
            </div>

        </form>
    </div>
@endsection
