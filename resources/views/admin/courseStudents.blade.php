@extends('admin.master.index')

@section('content')
    <div class="col-12">
        <table class="table table-striped">
            <tr>
                <th>نام و نام وخانوادگی</th>
            </tr>
            {{dd($students)}}
            @foreach($students as $item)
                <tr>
                    {{$item->fname." ".$item->lname}}
                </tr>
            @endforeach
        </table>
    </div>
@endsection
