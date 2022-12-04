@if($scholarship->collabration==1)
    <p>مبلغ همکاری: {{$scholarship->user->->collabration_accept->remaining}}</p>
    <table class="table-bordered table table-hover table-striped">
        <tr class="text-center">
            <th>#</th>
            <th>زمینه همکاری</th>
            <th>قیمت پایه</th>
            <th>تعداد/تومان</th>
            <th>جمع</th>
            <th>وضعیت</th>
            <th>ویرایش</th>
        </tr>
    @foreach($scholarship->user->collabration_accept as $item)
        <tr class="text-center">
            <td>{{$loop->iteration}}</td>
            <td>{{$item->collabration_details->title}}</td>
            <td>
                @if(is_numeric($item->value))
                    {{number_format($item->value)}}
                @else
                    {{$item->value}}
                @endif
            </td>
            <td>{{$item->count}}</td>
            <td>
                @if(is_numeric($item->calculate))
                    {{number_format($item->calculate)}}
                @else
                    {{$item->calculate}}
                @endif
            </td>
            <td>
                @if($item->status==0)
                    تایید نشده
                @elseif($item->status==1)
                    تایید شده
                @endif
            </td>
            <td>
                <button type="button" class="btn btn-primary collabrationModal" data-toggle="modal" data-target="#collabrationModal" data-whatever="{{$item->id}}">
                    <i class="bi bi-pencil-square"></i>
                </button>
            </td>
        </tr>
    @endforeach
        <tr class="text-center">
            <td colspan="2">جمع کل</td>
            <td>
                @if(is_numeric($scholarship->user->collabration_accept->sum('value')))
                    {{number_format($scholarship->user->collabration_accept->sum('value'))}}
                @else
                    {{$scholarship->user->collabration_accept->sum('value')}}
                @endif
            </td>
            <td>
                @if(is_numeric($scholarship->user->collabration_accept->sum('count')))
                    {{number_format($scholarship->user->collabration_accept->sum('count'))}}
                @else
                    {{$scholarship->user->collabration_accept->sum('count')}}
                @endif
            </td>
            <td>
                @if(is_numeric($scholarship->user->collabration_accept->sum('calculate')))
                    {{number_format($scholarship->user->collabration_accept->sum('calculate'))}}
                @else
                    {{$scholarship->user->collabration_accept->sum('calculate')}}
                @endif
            </td>
            <td></td>
        </tr>
    </table>

    <div class="modal fade" id="collabrationModal" tabindex="-1" aria-labelledby="collabrationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Recipient:</label>
                            <input type="text" class="form-control" id="recipient-name">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Message:</label>
                            <textarea class="form-control" id="message-text"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Send message</button>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="alert alert-warning">
        لیست همکاری تکمیل و ارسال نشده است
    </div>
@endif
