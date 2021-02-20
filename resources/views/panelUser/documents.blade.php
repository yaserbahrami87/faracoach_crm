@extends('panelUser.master.index')
@section('rowcontent')
    <div class="col-12 table-responsive">

        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">عنوان</th>
                <th scope="col">تعداد کلیک</th>
                <th scope="col">تاریخ ثبت</th>
            </tr>
            </thead>
            <tbody>
            @foreach($documents as $item)
                <tr>
                    <th scope="row">1</th>
                    <td>
                        <a href="/panel/documents/{{$item->shortlink}}">
                            {{$item->title}}
                        </a>
                    </td>
                    <td>{{$item->clicks}}</td>
                    <td>{{$item->date_fa}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
