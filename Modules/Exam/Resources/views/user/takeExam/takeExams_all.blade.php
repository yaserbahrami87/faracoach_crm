@extends('user.master.index')

@section('content')
    <div class="col-12 table-responsive">
        <table class="table table-bordered table-striped text-center">
            <tr>
                <th>#</th>
                <th>نام آزمون</th>
                <th>وضعیت</th>
                <th>مدرک</th>
            </tr>
            @foreach($takeExams as $takeExam)
                <tr>
                    <td>{{($loop->iteration)}}</td>
                    <td>{{($takeExam->exam->exam)}}</td>
                    <td>
                        @if($takeExam->status==0)
                            رد آزمون
                        @elseif($takeExam->status==1)
                            قبول در انتظار تایید
                        @elseif($takeExam->status==2)
                            قبول
                        @endif
                    </td>
                    <td>
                        @if($takeExam->status==2)

                            <form method="post" action="/panel/takeExam/{{$takeExam->id}}/certificate/download">
                                {{csrf_field()}}

                                <button class="btn btn-primary">دانلود مدرک</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach

        </table>
    </div>
@endsection
