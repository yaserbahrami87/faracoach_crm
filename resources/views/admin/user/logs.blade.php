<div class="col-12 table-responsive mb-3">

    <table class="dataTable table table-striped table-bordered" style="width:100%">
        <thead>
        <tr>
            <th>#</th>
            <th>نوع فعالیت</th>
            <th>تاریخ</th>

        </tr>
        </thead>
        <tbody>

        @foreach($user->logs->where('log_type','=','login') as $item)
            <tr>
                <td>{{$loop->iteration}}</td>

                <td>
                    {{$item->log_date}}
                </td>
                <td>{{$item->log_type}}</td>
            </tr>
        @endforeach
        </tbody>


    </table>
</div>



