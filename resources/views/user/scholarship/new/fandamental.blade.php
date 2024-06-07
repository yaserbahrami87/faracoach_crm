<style>
    #fundamental button
    {
        background-color: #ea5456;
        color: #FFFFFF;
        margin: auto auto;
    }
    button a
    {
        text-decoration: none;
        color: #FFFFFF;
        text-align: center;
        font-size: 18px;
    }

    button a:hover
    {
        text-decoration: none;
        color: #FFFFFF;
        text-align: center;
    }
</style>

<div class="container">
    <div class="col-12 col-md-12 mt-4">
        <a href="https://my.faracoach.com/product/fundamental"><img src="{{asset('/images/scholarship/fandamental.jpg')}}" class="img-fluid"></a>
    </div>
    <div class="col-12 col-md-9 mx-auto alert alert-warning text-center">شرکت در دوره فاندامنتال و قبولی در آزمون پایان دوره آن ، 050 امتیاز مستقیم برای بورسیه خواهد شد.</div>
    <div class="col-12 col-md-12 mt-4 text-right p-5">
        <h5> دانشپذیر عزیز سلام <br> شما تا این مرحله در دوره مقدماتی آموزش کوچینگ شرکت و آزمون آن را با موفقیت پشت سر گذاشته اید . اکنون شما مجاز به شرکت در دوره 20 ساعته فاندامنتال آموزش کوچینگ هستید . <br>
        لطفا جهت ثبت نام و مشاهده توضیحات بیشتر به صفحه ثبت نام این دوره مراجعه نماید. </h5>
    </div>

    @if(is_null(Auth::user()->purchases->where('product_id',3)->first()) || is_null(Auth::user()->purchases->where('product_id',120)->first()))
        <div class="col-12 col-md-12 mt-4 text-center" id="fundamental">
            <button class="btn mb-2"> <a href="https://my.faracoach.com/product/fundamental">برای ثبت نام نقدی دوره فاندامنتال کلیک کنید  </a></button>
            <button class="btn mb-2"> <a href="{{asset('/courses/فاندامنتال%201')}}">برای ثبت نام قسطی دوره فاندامنتال کلیک کنید  </a></button>
        </div>
    @else
        <div class="col-12 col-md-6 mx-auto mx-auto alert alert-success text-center" >شما با موفقیت دوره را خریداری کردید</div>
    @endif
</div>
