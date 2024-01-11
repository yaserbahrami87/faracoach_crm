@extends('admin.master.index')

@section('content')

    <div class="col-12">
        <div class="card border">
            <div class="card-header">لیست سوالات</div>
            <div class="card-body table-responsive">
                <table class="table table-striped">
                    <tr class="text-center">
                        <th>ردیف</th>
                        <th>سوال</th>
                        <th>نمره </th>
                    </tr>



                    @foreach(Auth::user()->examResult_insert as $question)

                    @endforeach

                    @foreach($takeExam->exam->exam_questions->where('is_question',1) as $question)
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

                                    <p class="m-0 @if($answer->is_correct) text-success @else text-danger @endif ">
                                        @if($answer->is_correct)
                                            <i class="bi bi-check-lg"></i>
                                        @else
                                            <i class="bi bi-x-lg"></i>
                                        @endif

                                        @if(($answer->result_user->count()>0))
                                                {{('###'.$answer->result_user->where('user_id',$takeExam->user_id)->first()['user_id'])}}
                                        @endif

                                        {{$answer->title}}

                                    </p>
                                @endforeach

                            </td>
                            <td>{{$question->score}}</td>


                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
