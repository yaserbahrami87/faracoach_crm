@extends('admin.master.index')

@section('headerScript')
    <script src="{{asset('/panel_assets/intl_tel/js/intlTelInput.js')}}"></script>
    <script src="{{asset('/panel_assets/intl_tel/js/utils.js')}}"></script>
@endsection
@section('content')
    <div class="col-6">
        <form>
            <div class="form-group">
                <label for="tel">شماره همراه:</label>
                <input type="hidden" id="tel_org" value="{{ old('email') }}" name="email"/>
                <input id="tel" type="tel" class="form-control @error('email') is-invalid @enderror"  value="{{ old('email') }}" required autocomplete="email" autofocus>
            </div>
            <div class="form-group">
                <label for="tel">تاریخ ثبت نام</label>
                <input type="text" class="form-control" id="tel" />
            </div>
            <div class="form-group">
                <label for="date_fa">تاریخ ثبت نام</label>
                <input type="text" class="form-control" id="date_fa" />
            </div>
            <div class="form-group">
                <label for="status">وضعیت</label>
                <select class="form-control" id="status">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select>
            </div>


            <button type="submit" class="btn btn-primary">اضافه</button>
        </form>
    </div>
@endsection

@section('footerScript')
    <script>
        var input = document.querySelector("#tel");
        var intl=intlTelInput(input,{
            formatOnDisplay:false,
            separateDialCode:true,
            autoPlaceholder:'off',
            preferredCountries:["ir", "gb"]
        });

        input.addEventListener("countrychange", function() {
            document.querySelector("#tel_org").value=intl.getNumber();
        });

        $('#tel').change(function()
        {
            document.querySelector("#tel_org").value=intl.getNumber();
            tel=intl.getNumber();
            var data={
                tel:tel,
                _token: $('meta[name="csrf-token"]').attr('content'),
            }
            console.log(data);
            $.ajax({
                data: data,
                type:'post',
                url:'/admin/user/ajax/search',
            })
        });
    </script>
@endsection
