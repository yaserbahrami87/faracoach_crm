@extends('admin.master.index')

@section('headerScript')
    <link href="{{asset('/pizza_chart/css/pizza.css')}}" rel="stylesheet" />
@endsection
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
                <th class="text-center">  مکالمات (ساعت)</th>
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

    <div class="col-12">
        <p>گزارش نحوه آشنایی </p>
    </div>
    <div class="col-12 table-responsive mb-2">
        <table class="table table-striped">
            <tr>
                <th class="text-center">نحوه آشنایی </th>
                <th class="text-center">  تعداد </th>
                <th class="text-center"> دانشجو</th>
                <th class="text-center"> پیگیری نشده</th>
                <th class="text-center"> تور پیگیری</th>
                <th class="text-center"> انصراف</th>
                <th class="text-center"> در انتظار تصمیم</th>
                <th class="text-center"> عدم پاسخگویی</th>
                <th class="text-center"> مارکتینگ</th>
                <th class="text-center"> جلسات</th>
                <th class="text-center"> رویداد</th>
                <th class="text-center"> لیست سیاه</th>
            </tr>
            @foreach($users->groupby('gettingknow') as $item)

                <tr>
                    <td class="text-center">
                        @if(!is_null($item[0]->get_gettingknow))
                            {{$item[0]->get_gettingknow['category']}}
                        @endif

                    </td>

                    <td class="text-center">
                        {{count($item)}}
                    </td>

                    <td class="text-center">
                        {{$item->where('type','=',20) ->count() }}
                    </td>
                    <td class="text-center">
                        {{$item->where('type','=',1) ->count() }}
                    </td>
                    <td class="text-center">
                        {{$item->where('type','=',11) ->count() }}
                    </td>
                    <td class="text-center">
                        {{$item->where('type','=',12) ->count() }}
                    </td>
                    <td class="text-center">
                        {{$item->where('type','=',13) ->count() }}
                    </td>
                    <td class="text-center">
                        {{$item->where('type','=',14) ->count() }}
                    </td>
                    <td class="text-center">
                        {{$item->wherein('type',[-1,-2,-3])->count() }}
                    </td>
                    <td class="text-center">
                        {{$item->where('type','=',30)->count() }}
                    </td>
                    <td class="text-center">
                        {{$item->where('type','=',40)->count() }}
                    </td>
                    <td class="text-center">
                        {{$item->where('type','=',0)->count() }}
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    <div class="col-12 border-top">
        <p>تفکیک جنسیت </p>
    </div>
    <div class="col-12">
        <div class="row">
            <div class="col-4 " >
                <ul data-pie-id="svg">

                    @foreach($users->groupby('sex') as $item)

                        @switch($item[0]->sex)
                            @case ("1")
                                <li data-value="{{count($item)}}"> مرد ({{count($item)}})</li>
                            @break
                            @case ("0")
                                <li data-value="{{count($item)}}"> زن ({{count($item)}})</li>
                            @break
                            @default
                                <li data-value="{{count($item)}}"> نامشخص ({{count($item)}})</li>
                            @break
                        @endswitch
                    @endforeach
                </ul>
            </div>
            <div class="col-4">
                <div id="svg"></div>
            </div>
        </div>
    </div>
    <div class="col-12 border-top">
        <p>تفکیک تحصیلات </p>
    </div>
    <div class="col-12">
        <div class="row">
            <div class="col-4 " >
                <ul data-pie-id="svgEducation">
                    @foreach($users->groupby('education') as $item)
                            <li data-value="{{count($item)}}"> {{$item[0]->education."(".count($item).")"}}</li>
                    @endforeach
                </ul>
            </div>
            <div class="col-4">
                <div id="svgEducation"></div>
            </div>
        </div>
    </div>




@endsection

@section('footerScript')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="{{asset('/pizza_chart/js/vendor/snap.svg.js')}}" ></script>
    <script src="{{asset('/pizza_chart/js/pizza.js')}}" ></script>
    <script>
        $(window).load(function() {
            Pizza.init( );
        })
    </script>

@endsection
