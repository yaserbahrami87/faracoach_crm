@extends('admin.master.index')

@section('content')
    <div class="col-12 table-responsive mb-2 border border-bottom border-1">
        <table class="table table-striped">
           <tr>
               <th>استان</th>
               <th>  تعداد (نفر)</th>
               <th>  دانشجو (نفر)</th>
           </tr>
            @foreach($users->groupby('state') as $item)
                <tr>
                    <td>
                        @if(!is_null($item[0]->get_state))
                            {{$item[0]->get_state['name']}}
                        @endif

                    </td>

                    <td>
                        {{count($item)}}
                    </td>
                    <td>
                        {{$item->where('type','=',20)->count()}}
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    <div class="col-12">
        <p>گزارش پیگیری ها</p>
    </div>
    <div class="col-12 table-responsive">
        <table class="table table-striped">
            <tr>
                <th class="text-center">دوره پیگیری شده</th>
                <th class="text-center">  تعداد پیگیری </th>
                <th class="text-center">  مدت مکالمات (ساعت)</th>
                <th class="text-center"> دانشجو</th>
                <th class="text-center"> تور پیگیری</th>
                <th class="text-center"> انصراف</th>
                <th class="text-center"> در انتظار تصمیم</th>
                <th class="text-center"> عدم پاسخگویی</th>
                <th class="text-center"> مارکتینگ</th>
                <th class="text-center"> جلسات</th>
                <th class="text-center"> رویداد</th>
            </tr>
            @foreach($followups->groupby('course_id') as $item)

                <tr>
                    <td class="text-center">
                        @if(!is_null($item[0]->course))
                            {{$item[0]->course['course']}}
                        @endif

                    </td>

                    <td class="text-center">
                        {{count($item)}}
                    </td>
                    <td class="text-center">
                        {{(round($item->sum('talktime')/60))  }}
                    </td>
                    <td class="text-center">
                        {{$item->where('status_followups','=',20) ->count() }}
                    </td>
                    <td class="text-center">
                        {{$item->where('status_followups','=',11) ->count() }}
                    </td>
                    <td class="text-center">
                        {{$item->where('status_followups','=',12) ->count() }}
                    </td>
                    <td class="text-center">
                        {{$item->where('status_followups','=',13) ->count() }}
                    </td>
                    <td class="text-center">
                        {{$item->where('status_followups','=',14) ->count() }}
                    </td>
                    <td class="text-center">
                        {{$item->wherein('status_followups',[-1,-2,-3])->count() }}
                    </td>
                    <td class="text-center">
                        {{$item->where('status_followups','=',30)->count() }}
                    </td>
                    <td class="text-center">
                        {{$item->where('status_followups','=',40)->count() }}
                    </td>
                </tr>
            @endforeach
        </table>
    </div>




@endsection

@section('footerScript')


@endsection
