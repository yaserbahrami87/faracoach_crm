<div class="card-body" >
    <b>نمونه متن معرفی نامه:</b>

    <div class="border border-1 p-1 mb-2 mt-1 shadow-sm shadow">
        <p>نامه در سر برگ آن  موسسه  با شماره  و  تاریخ</p>
        <p class="text-center">بسمه تعالی</p>
        <p>مدیریت محترم آکادمی بین المللی فراکوچ</p>
        <p>با سلام،</p>
        <p class="text-justify">با عنایت به فرصت ایجاد شده توسط آن  مجموعه در راستای گسترش فرهنگ کوچینگ، احتراما خانم / آقای ......................... دارای کد ملی ............................  را جهت شرکت در طرح بورسیه آموزش مهارت کوچینگ (ویژه نخبگان و اساتید) و همکاریهای آتی، معرفی می نماید.</p>
        <p>علت این معرفی دارا بودن صلاحیتهای زیر است:</p>
        <ol>
            <li>...</li>
            <li>...</li>
            <li>...</li>
        </ol>
        <p class="text-justify">صدور این معرفی نامه به منزله تایید صلاحیت های ایشان توسط این ...... شرکت /  موسسه/ سازمان / دانشگاه  ..... می باشد. خواهشمند است همکاری لازم را به عمل آورید.</p>
        <p>پیشاپیش از همراهی شما سپاسگزارم</p>
        <p  class="text-right">با احترام</p>
        <p  class="text-right">مدیر مربوطه/عامل</p>
        <p  class="text-right">مهر وامضا</p>
    </div>

    @if(is_null($scholarship->introductionletter))
        <form method="POST" action="/panel/scholarship/introductionletter" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="form-group">
                <label for="introductionLetter_file">بارگذاری معرفی نامه:</label>
                <input type="file" class="form-control-file" id="introductionLetter_file" name="introductionletter">
                <small>فرمت های معتبر:PDF , DOC , JPG , JPEG , BMP , PNG</small>
            </div>
            <input type="submit" class="btn btn-success" value="ارسال معرفی نامه" />
        </form>
    @else
        <div class="alert alert-success">
            معرفی نامه شما بارگذاری شده است <a class="btn btn-primary" href="{{asset('/documents/scholarship/'.$scholarship->introductionletter)}}">دانلود</a>
        </div>
    @endif
</div>
