@extends('admin.master.index')

@section('content')
    <div class="col-12 table-responsive">
        <table class="table table-striped">
            <tr class="text-center">
                <th></th>
                <th>شرکت کننده</th>
                <th>آزمون</th>
                <th>نمره</th>
                <th>وضعیت</th>
                <th>نمایش آزمون</th>
                <th>تغییر وضعیت</th>
            </tr>
            @foreach($takeExams as $takeExam)
            <tr class="text-center">
                <td>{{$loop->iteration}}</td>
                <td>{{$takeExam->user->fname.' '.$takeExam->user->lname}}</td>
                <td>{{$takeExam->exam->exam}}</td>
                <td>{{$takeExam->score}} از {{$takeExam->exam->pass}}</td>

                @if($takeExam->status==0)
                    <td class="text-danger">
                        رد شده
                    </td>
                @elseif($takeExam->status==1)
                    <td class="text-warning">
                        قبول در انتظار تایید
                    </td>
                @endif
                <td>
                    <a href="/admin/takeExam/{{$takeExam->id}}" class="btn btn-success">
                        <i class="bi bi-eye-fill"></i>
                    </a>
                </td>
                <td>
                    <a href="" class="btn btn-warning">
                        <i class="bi bi-pencil-square"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
@endsection
