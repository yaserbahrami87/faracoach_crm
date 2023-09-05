@extends('clinic.master.index')

@section('content')
    <div class="container mb-5 pt-5" >
        <div class="row">
            <div class="col-12 col-md-8 mx-auto p-5  border border-1" id="filter_coach" >
                <form method="get" action="">
                    <div class="input-group mb-3 ">
                        <input type="text" class="form-control rounded-right" placeholder="نام یا نام خانوادگی وارد کنید" >
                        <div class="input-group-prepend">
                            <button class="btn btn-outline-secondary rounded-left" type="button" id="button-addon1">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </div>
                </form>

                <form method="get" action="">
                    <div class="row">
                        <div class="form-group col-12 col-md-3 text-right">
                            <label for="gender">جنسیت:</label>
                            <select class="form-control" id="gender">
                                <option disabled selected>انتخاب کنید</option>
                                <option value="1">مرد</option>
                                <option value="0">زن</option>
                                <option value="NULL">فرقی ندارد</option>
                            </select>
                        </div>


                        <div class="form-group col-12 col-md-3 text-right">
                            <label for="clinic_basic_info"> خدمات:</label>
                            <select class="form-control" id="clinic_basic_info" name="clinic_basic_info">
                                <option disabled selected>انتخاب کنید</option>
                                @foreach($clinic_basic_info->children as  $child)
                                    <option value="{{$child->id}}">{{$child->title}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-12 col-md-3 text-right">
                            <label for="clinic_basic_info"> استان:</label>
                            <select class="form-control" id="clinic_basic_info" name="clinic_basic_info">
                                <option disabled selected>انتخاب کنید</option>
                                @foreach($states as  $state)
                                    <option value="{{$state->id}}">{{$state->name}}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            @foreach($coaches as $coach)
                <div class="col-12 col-md-2 text-center">
                    <div class="row p-2" id="coaches">
                        <div class="col-12 border rounded-lg pt-3 coach">
                            <img src="/documents/users/{{$coach->user->personal_image}}" width="120px" height="120px" class="rounded-lg mb-3" />
                            <a href="" class="d-block">{{$coach->user->fname.' '.$coach->user->lname}}</a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
        <div class="row">
            <div class="col-12 col-md-4 mx-auto pt-5">
                {{$coaches->links()}}
            </div>
        </div>
    </div>
@endsection
