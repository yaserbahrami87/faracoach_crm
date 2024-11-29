<div class="col-12 table-responsive mb-3">

    <table class="dataTable table table-striped table-bordered" style="width:100%">
        <thead>
        <tr>
            <th>#</th>
            <th>دوره</th>
            <th>تاریخ شروع</th>
            <th>استاد</th>
            <th>وضعیت</th>

        </tr>
        </thead>
        <tbody>

        @foreach($user->students as $item)

            <tr>
                <td>{{$loop->iteration}}</td>

                <td>
                    {{$item->course->course}}
                </td>
                <td>{{$item->course->start}}</td>


                <td>
                    @if(!is_null($item->course->teacher))
                        {{$item->course->teacher->user->fname.' '.$item->course->teacher->user->lname}}
                    @endif
                </td>
                <td>{{$item->get_status()}}</td>



            </tr>
        @endforeach
        </tbody>


    </table>
</div>



