<!-- *********** List moarefi shodeha -->
<div class="card">
    <div class="card-header">
        <h4 class="card-title">امتیازات</h4>
    </div>
    <div class="card-body">
        <ul class="list-unstyled team-members">
            <li>
                <div class="row">
                    <div class="col-md-7 col-7">
                        <p class="text-dark">افراد دعوت شده: {{$countIntroducedUser}} نفر</p>
                    </div>
                    <div class="col-md-5 col-5 text-right">
                        <p class="text-dark">{{$countIntroducedUser*5}} امتیاز</p>
                    </div>
                </div>
            </li>
            <li>
                <div class="row">
                    <div class="col-md-7 col-7">
                        <p class="text-dark">تایید شماره همراه:</p>
                    </div>
                    <div class="col-md-5 col-5 text-right">
                        <p class="text-dark">{{$verifyScore}} امتیاز</p>
                    </div>
                </div>
            </li>
            <li>
                <div class="row">
                    <div class="col-md-8 col-8">
                        <p class="text-dark">دانشجوی معرفی شده: {{$scoreSuccess}} نفر</p>
                    </div>
                    <div class="col-md-4 col-4 text-right">
                        <p class="text-dark">{{$scoreSuccess*10}} امتیاز</p>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>
