@extends('admin.master.index')

@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-header">لیست مدارک</div>
        <div class="card-body table-responsive">
            <table class="table table-striped">
                <tr>
                    <th>عنوان مدرک</th>
                    <th>وضعیت </th>
                    <th>ایجاد کننده </th>
                </tr>

                @foreach($certificates as $certificate)

                    <tr>
                        <td>{{$certificate->name}}</td>
                        <td>{{$certificate->status}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection
