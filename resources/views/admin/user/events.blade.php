<div class="col-12 table-responsive mb-3">




    <table class="dataTable table table-striped table-bordered" style="width:100%">
        <thead>
        <tr>
            <th>#</th>
            <th>رویداد</th>
            <th>تاریخ برگزاری</th>
            <th>ساعت برگزاری</th>

        </tr>
        </thead>
        <tbody>

        @foreach($user->reserveEvent as $item)
            <tr>
                <td>{{$loop->iteration}}</td>

                <td>
                    {{$item->event->event}}
                </td>
                <td>{{$item->event->start_date}}</td>
                <td>{{$item->event->start_time}}</td>

            </tr>
        @endforeach
        </tbody>


    </table>
</div>



