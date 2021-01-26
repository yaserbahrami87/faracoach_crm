@extends('panelAdmin.master.index')
@section('rowcontent')
    @include('panelAdmin.cardBox')
    <div class="col-12 table-responsive">
        <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Handle</th>
            </tr>
            </thead>
            <tbody>
            @foreach($usersEducation as $item)
                <tr>
                    <th scope="row">1</th>
                    <td>{{$item->fname}}</td>
                    <td>{{$item['cancelfollowup']}}</td>
                    <td>@mdo</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
