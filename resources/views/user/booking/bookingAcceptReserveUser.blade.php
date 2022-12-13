@extends('user.master.index')
@section('headerScript')
    <link href="{{asset('/dashboard/assets/css/buttons.dataTables.min.css')}}" rel="stylesheet" />
    <link href="{{asset('/dashboard/assets/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
@endsection

@section('content')
    <div class="col-md-12 mt-3 table-responsive">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr class="text-center">
                    <th>کد جلسه</th>
                    <th scope="col">مشخصات</th>
                    <th scope="col">تاریخ شروع</th>
                    <th scope="col">ساعت شروع</th>
                    <th scope="col">ساعت پایان</th>
                    <th scope="col">مدت جلسه</th>
                    @if(Auth::user()->status_coach==1)
                        <th scope="col">وضعیت</th>
                    @endif
                    @if(Auth::user()->status_coach==1)
                        <th scope="col">حذف</th>
                    @else
                        <th>لغو جلسه</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($reserves as $item)
                    @switch($item['status'])
                        @case('1')   <tr class="table-warning clickable-row "  data-href='/panel/reserve/{{$item->id}}'>
                        @break
                        @case('0')   <tr class="table-success clickable-row"  data-href='/panel/reserve/{{$item->id}}'>
                        @break
                        @case('4')   <tr class="table-danger">
                        @break
                        @default    <tr>
                            @break
                            @endswitch


                            <td class="text-center">
                                @if($item->status==1 || $item->status==3)
                                    {{$item->booking->id}}
                                @else
                                    {{$item->booking->id}}
                                @endif

                            </td>
                            <td>
                                @if($item->status==1 || $item->status==3)
                                    <a href="/panel/reserve/{{$item->id}}">{{$item->booking->coach->user->fname.' '.$item->booking->coach->user->lname}}</a>
                                @else
                                    {{$item->booking->coach->user->fname.' '.$item->booking->coach->user->lname}}
                                @endif

                            </td>
                            <td class="text-center">
                                    @if($item->status==1 || $item->status==3)
                                        <a href="/panel/booking/{{$item->id}}">{{$item->booking->start_date}}</a>
                                    @else
                                        {{$item->booking->start_date}}
                                    @endif
                            </td>
                            <td class="text-center">{{$item->booking->start_time}}</td>
                            <td class="text-center">{{$item->booking->end_time}}</td>
                            <td class="text-center">{{$item->duration_booking}}</td>
                            @if(Auth::user()->status_coach==1)
                                <td>{{$item->caption_status}}</td>
                            @endif



                            <td>
                                @if((($item->booking->start_date>$dateNow && Auth::user()->status_coach==1) && (($item['status'])!=0)&&($item['status']!=4)))
                                        <form method="post" action="/panel/booking/{{$item->id}}" onsubmit="return confirm('آیا از حذف زمان رزرو اطمینان دارید؟');">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button  class="btn btn-danger" type="submit">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </form>
                                @elseif($item->booking->start_date>$dateNow && ($item['status']!=4))
                                        <form method="POST" action="/panel/booking/{{$item->booking_id}}" onsubmit="return confirm('آیا از لغو جلسه اطمینان دارید؟')">
                                            {{csrf_field()}}
                                            {{method_field('PATCH')}}
                                            <input type="hidden" name="status" value="4" />
                                            <button type="submit" class="btn btn-danger">لغو جلسه
                                                <i class="bi bi-x-lg"></i>
                                            </button>
                                        </form>
                                @endif
                            </td>
                        </tr>
                @endforeach
            </tbody>
        </table>
        {{$reserves->links()}}
    </div>

@endsection

@section('footerScript')
    <script>
        // jQuery(document).ready(function($) {
        //     $(".clickable-row").click(function() {
        //         window.location = $(this).data("href");
        //     });
        // });
    </script>



    <script src="{{asset('/dashboard/assets/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('/dashboard/assets/js/dataTables.bootstrap4.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                order: [[2, 'desc']],
            });
        } );
    </script>
@endsection
