@extends('admin.master.index')
@section('content')
    <div class="col-12">
        <form method="post" action="/admin/jashn/user/options/{{$landPage->id}}/update">
            {{csrf_field()}}
            {{method_field('PATCH')}}

            <table class="table">
                <tr>
                    <th>گزینه</th>
                    <th>وضعیت</th>
                </tr>
                @if(isset($landPage['options'][0]))
                    <tr>
                        <td>{{$landPage['options'][0]}}</td>
                        <td>
                            <select class="custom-select" name="resultoptions[]">
                                <option value="0" selected >انجام نشده</option>
                                <option @if($landPage['resultoptions'][0]==1) selected  @endif value="1">انجام شده</option>
                            </select>
                        </td>
                    </tr>
                @endif
                @if(isset($landPage['options'][1]))
                    <tr>
                        <td> {{$landPage['options'][1]}}</td>
                        <td>
                            @if($landPage['resultoptions'][1])
                                <select class="custom-select" name="resultoptions[]">
                                    <option value="0" selected >انجام نشده</option>
                                    <option @if($landPage['resultoptions'][1]==1) selected  @endif value="1">انجام شده</option>
                                </select>
                            @endif
                        </td>
                    </tr>
                @endif

            </table>
            <input type="submit" value="بروزرسانی" class="btn btn-success" />
        </form>

    </div>
@endsection
