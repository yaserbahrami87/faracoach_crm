@extends('panelAdmin.master.index')
@section('rowcontent')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">اعضا</h4>
            </div>
            <div class="card-body" id="frmSearchUserAdmin">
                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4" >
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                        <div class="input-group-prepend">
                            <button class="btn btn-outline-secondary" type="button" id="button-addon1">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
                                    <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">

                    <table class="table">
                        <thead class=" text-dark">
                        <th>نام </th>
                        <th>نام خانوادگی </th>
                        <th>کد ملی </th>
                        <th>شماره تماس </th>
                        <th>نمایش </th>
                        </thead>
                        <tbody>
                            @foreach($users as $item)
                                @if($item->type==1)
                                    <tr class="bg-warning">
                                @elseif($item->type==11)
                                    <tr class="bg-primary">
                                @elseif($item->type==12)
                                    <tr class="bg-danger">
                                @elseif($item->type==20)
                                    <tr class="bg-success">
                                @endif
                                        <td>
                                            {{$item->fname}}
                                        </td>
                                        <td>
                                            {{$item->lname}}
                                        </td>
                                        <td>
                                            {{$item->codemelli}}
                                        </td>
                                        <td >
                                            <a href="tel:{{$item->tel}}">{{$item->tel}}</a>
                                        </td>
                                        <td>
                                            <a href="/admin/user/{{$item->id}}">
                                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                                    <path fill-rule="evenodd" d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

