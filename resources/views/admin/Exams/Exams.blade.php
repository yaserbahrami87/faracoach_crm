@extends('admin.master.index')

@section('content')
    <div class="col-12">
        <a href="/admin/exam/create" class="btn btn-primary mb-3">آزمون جدید</a>
        <div class="card border">
            <div class="card-header">لیست آزمون ها</div>
            <div class="card-body table-responsive">
                <table class="table table-striped">
                    <tr class="text-center">
                        <th>عنوان آزمون</th>
                        <th>مدرک قبولی </th>
                        <th>حداقل نمره قبولی </th>
                        <th>تعداد سوالات </th>
                        <th>وضعیت </th>
                        <th>ایجاد کننده </th>
                        <th>سوالات </th>
                        <th>ویرایش </th>
                        <th>حذف </th>
                    </tr>

                    @foreach($Exams as $Exam)

                        <tr class="text-center">
                            <td>{{$Exam->exam}}</td>
                            <td>{{$Exam->certificate_id}}</td>
                            <td>{{$Exam->pass}}</td>
                            <td>{{($Exam->exam_questions->count())}}</td>
                            <td>{{$Exam->status}}</td>
                            <td>{{$Exam->user_id}}</td>
                            <td>
                                <a href="/admin/exam/{{$Exam->id}}/questions" class="btn btn-primary">نمایش</a>
                            </td>
                            <td>
                                <a href="/admin/exam/{{$Exam->id}}/edit">
                                    <button class="btn btn-warning"><i class="bi bi-pencil-square"></i></button>
                                </a>
                            </td>
                            <td>
                                <form method="post" action="/admin/exam/{{$Exam->id}}" onsubmit="return window.confirm('آیا از حذف آزمون اطمینان دارید؟')">
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
