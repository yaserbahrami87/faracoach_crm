@extends('admin.master.index')

@section('content')

    <div class="col-12">
        <a href="/admin/exam/{{$exam->id}}/questions/create" class="btn btn-primary mb-3">سوال جدید</a>
        <div class="card border">
            <div class="card-header">لیست سوالات</div>
            <div class="card-body table-responsive">
                <table class="table table-striped">
                    <tr class="text-center">
                        <th>ردیف</th>
                        <th>سوال</th>
                        <th>نمره </th>
                        <th>ویرایش </th>
                        <th>حذف </th>
                    </tr>

                    @foreach($exam->exam_questions->where('is_question',1) as $question)
                        <tr class="text-center">
                            <td>
                                {{$loop->iteration}}
                            </td>
                            <td>
                                <b>
                                    <i class="bi bi-question-circle-fill"></i>
                                    {{$question->title}}
                                </b>
                                @foreach($question->answers as $answer)
                                    <p class="m-0 @if($answer->is_correct) text-success @else text-danger @endif">
                                        @if($answer->is_correct)
                                            <i class="bi bi-check-lg"></i>
                                        @else
                                            <i class="bi bi-x-lg"></i>
                                        @endif
                                        {{$answer->title}}

                                    </p>
                                @endforeach

                            </td>
                            <td>{{$question->score}}</td>
                            <td>
                                <a href="/admin/examQuestion/{{$question->id}}/edit">
                                    <button class="btn btn-warning"><i class="bi bi-pencil-square"></i></button>
                                </a>
                            </td>
                            <td>
                                <form method="post" action="/admin/examQuestion/{{$question->id}}" onsubmit="return window.confirm('آیا از حذف سوال اطمینان دارید؟')">
                                    {{csrf_field()}}
                                    {{method_field('DELETE')}}
                                    <button type="submit" class="btn btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
