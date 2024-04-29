@extends('user.master.index')
@section('content')
    <div class="col-12 table-responsive card">
        <div class="card-header">مدارک صادر شده</div>
        <div class="card-body">
            <table class="table text-center">
                <tr>
                    <th>نام مدرک</th>
                    <th>مدرک</th>
                </tr>
                @if(!is_null(Auth::user()->scholarship))
                    @if(Auth::user()->scholarship->confirm_exam==1)
                        <tr class="p-2">
                            <td class="p-2">گواهی بورسیه</td>
                            <td class="p-2">
                                <a href="{{asset('/panel/scholarship/certificate/download')}}" class="btn btn-primary">دانلود گواهینامه</a>
                            </td>
                        </tr>
                    @endif
                @endif

                @if(Auth::user()->introduced_verified==2)
                    <tr  >
                        <td class="p-2">مدرک شناسایی سفیر</td>
                        <td class="p-2">
                            <a href="/panel/certificate/ambassador" class="btn btn-primary">دانلود مدرک</a>
                        </td>
                    </tr>
                @endif

                @foreach(Auth::user()->students as $student)
                    @if(($student->status==3)||($student->status==31))
                        <tr>
                            <td>{{$student->course->course}}</td>
                            <td>
                            @if(!is_null($student->code) && !is_null($student->date_gratudate) && ($student->status==3))
                                <form method="post" action="/panel/certificates/acsth/{{$student->id}}">
                                    {{csrf_field()}}
                                    <input type="hidden" value="{{$student->id}}" name="student" />
                                    <button class="btn btn-success"> مدرک ACSTH</button>
                                </form>
                            @elseif(!is_null($student->code) && !is_null($student->date_gratudate) && ($student->status==31))
                                <form method="post"  action="/panel/certificates/fc1/{{$student->id}}">
                                    {{csrf_field()}}
                                    <button class="btn btn-success" >مدرک FC1</button>
                                </form>
                            @endif
                            </td>
                        </tr>
                    @endif
                @endforeach

            </table>
        </div>

    </div>
@endsection
