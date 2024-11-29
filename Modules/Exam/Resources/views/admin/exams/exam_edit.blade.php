@extends('admin.master.index')

@section('content')
    <div class="col-12">
        <div class="card border">
            <div class="card-header">اضافه کردن آزمون جدید</div>
            <div class="card-body">
                <form method="post" action="/admin/exam/{{$Exam->id}}">
                    {{csrf_field()}}
                    {{method_field('PATCH')}}
                    <div class="form-group">
                        <label for="exam">نام آزمون</label>
                        <input type="text" class="form-control" id="exam" name="exam" value="{{old('exam',$Exam->exam)}}" >
                    </div>
                    <div class="form-group">
                        <label for="description">توضیحات ازمون</label>
                        <textarea class="form-control" id="description" rows="3" name="description">{{old('description',$Exam->description)}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="certificate_id">مدرک قبولی</label>
                        <select class="form-control" id="certificate_id" name="certificate_id">
                            <option>انتخاب کنید</option>
                            @foreach($Certificates as $certificate)
                                <option value="{{$certificate->id}}" @if($certificate->id==old('certificate_id',$Exam->certificate_id)) selected @endif >{{$certificate->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="pass">حداقل نمره قبولی:</label>
                        <input type="number" class="form-control" id="pass" name="pass" min="0" max="100" value="{{old('pass',$Exam->pass)}}">
                    </div>
                    <button type="submit" class="btn btn-primary">بروزرسانی</button>
                </form>
            </div>
        </div>

    </div>
@endsection
