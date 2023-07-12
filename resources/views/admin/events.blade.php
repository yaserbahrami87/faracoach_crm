@extends('admin.master.index')

@section('headerScript')
    <link href="{{asset('/dashboard/assets/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
    <style>
        td{
            padding: 0px !important;
        }
    </style>
@endsection
@section('content')
    <div class="container bg-secondary-light p-5 shadow-lg">
        <div class="row">
            <div class="table-responsive overflow-auto">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th></th>
                            <th>رویداد</th>
                            <th>تاریخ رویداد</th>
                            <th>ساعت رویداد</th>
                            <th>برگزار کننده</th>
                            <th>فعال/غیرفعال</th>
                            <th>وضعیت</th>
                            <th>ویرایش</th>
                            <th>تعداد ثبت نام</th>
                            <th> شرکت کننده ها</th>
                            <th> خروجی</th>
                            <th>حذف</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($events as $item)
                        <tr>
                            <td>
                                <a href="{{asset('/event/'.$item->shortlink)}}">
                                    <img src="{{asset('/documents/events/'.$item->image)}}" class="img-circle"  width="50px" height="50px"/>
                                </a>
                            </td>
                            <td>
                                <a href="{{asset('/event/'.$item->shortlink)}}">
                                    {{$item->event}}
                                </a>
                            </td>
                            <td>
                                <a href="{{asset('/event/'.$item->shortlink)}}">
                                    {{$item->start_date}}
                                </a>
                            </td>
                            <td>
                                <a href="{{asset('/event/'.$item->shortlink)}}">
                                    {{$item->start_time}}
                                </a>
                            </td>
                            <td>
                                @if(!is_null($item->user))
                                    {{$item->user->fname.' '.$item->user->lname}}
                                @endif
                            </td>
                            <td>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input btn-sm" id="customSwitch{{$item->id}}" onchange="changeStatus(this)" value="{{$item->status}}"  title="{{$item->shortlink}}"  @if($item->status==1) checked @endif />
                                    <label class="custom-control-label" id="customSwitch{{$item->id}}Label" for="customSwitch{{$item->id}}">@if($item->status==1) فعال @else غیرفعال @endif</label>
                                </div>
                            </td>
                            <td>
                                @if($item->status_event=='در حال ثبت نام')
                                    <a href="{{asset('/event/'.$item->shortlink)}}" class=" btn btn-outline-primary btn-sm">{{$item->status_event}}</a>
                                @elseif($item->status_event=='تکمیل ظرفیت')
                                    <a href="{{asset('/event/'.$item->shortlink)}}" class=" btn btn-outline-warning btn-sm">{{$item->status_event}}</a>
                                @elseif($item->status_event=='برگزار شد')
                                    <a href="{{asset('/event/'.$item->shortlink)}}" class=" btn btn-outline-danger btn-sm">{{$item->status_event}}</a>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="/admin/event/{{$item->shortlink}}/edit" class="btn btn-warning" title="ویرایش رویداد" >
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                            </td>
                            <td class="text-center">
                                {{$item->count}} نفر
                            </td>
                            <td class="text-center">
                                <a href="/admin/event/{{$item->shortlink}}/users" class="btn btn-success" title="افراد شرکت کننده ها" >
                                    <i class="bi bi-people-fill" ></i>
                                </a>
                            </td>
                            <td class="text-center">
                                <a href="/admin/event/{{$item->shortlink}}/export" class="btn btn-success">
                                    <i class="bi bi-file-earmark-excel-fill"></i>
                                </a>
                            </td>
                            <td class="text-center">
                                <form method="post" action="/admin/event/{{$item->shortlink}}" onsubmit="return confirm('آیا از حذف رویداد مطمئن هستید؟');">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <button  class="btn btn-danger" type="submit">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>

            </div>
        </div>
    </div>
@endsection

@section('footerScript')
    <script src="{{asset('/dashboard/assets/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('/dashboard/assets/js/dataTables.bootstrap4.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            //$('#example').DataTable();

        } );

        function changeStatus(e)
        {
            if(document.getElementById(e.id).checked)
            {
                document.getElementById(e.id).value="1";
                document.getElementById(e.id+"Label").innerHTML="فعال";
            }
            else
            {
                console.log('1');
                document.getElementById(e.id).value="0";
                document.getElementById(e.id+"Label").innerHTML="غیرفعال";
            }


            $.ajax({
                type:'PATCH',
                data: {
                    "_token"    : "{{ csrf_token() }}",
                    "status"    : e.value,
                },
                url:"/admin/event/"+e.title+"/updateStatus",
                success:function(data)
                {
                    alert(data);
                },
                error:function(){
                    location.reload();
                }
            });
        }
    </script>
@endsection

