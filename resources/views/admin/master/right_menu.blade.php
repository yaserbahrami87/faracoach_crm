
<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto">
                <a class="navbar-brand" href="/admin/user/{{Auth::user()->id}}">
                    <!--<div class="brand-logo"><img class="logo" src="{{ asset('/acckt/assets/img/logo.png') }}" width=""></div>-->
                    <div class="brand-logo">
                        @if(is_null(Auth::user()->personal_image))
                            <img class="round" src="{{asset('/panel_assets/images/profile/user-profile-thumbnail.png')}}" width="40">
                        @else
                            <img class="round" src="{{asset('/documents/users/'.Auth::user()->personal_image)}}" width="40">
                        @endif
                    </div>
                    <h5 class="brand-text mb-0" style="font-size: 1.2rem;">
                        {{Auth::user()->fname." ".Auth::user()->lname}}
                    </h5>
                </a>
            </li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation" data-icon-style="lines">
            <li class=" navigation-header"><span> پورتال فراکوچ</span></li>
            <li class=" nav-item"><a href="/panel"><span class="menu-title">داشبورد</span></a></li>
            <li class=" nav-item has-sub"><a href="#"><span class="menu-title" data-i18n="Email">کاربرها</span></a>
                <ul class="menu-content">
                    <li><a href="/admin/users"><i class="bx bx-left-arrow-alt"></i><span class="menu-item" data-i18n="Invoice List"> همه کاربرها</span></a></li>
                    <li><a href="/admin/add"><i class="bx bx-left-arrow-alt"></i><span class="menu-item" data-i18n="Invoice Add">کاربر جدید</span></a></li>
                    <li><a href="/admin/users/excel"><i class="bx bx-left-arrow-alt"></i><span class="menu-item" data-i18n="Invoice Add">اضافه کردن از طریق اکسل</span></a></li>
                </ul>
            </li>
            <li class=" nav-item has-sub "><a href="#"><span class="menu-title" data-i18n="Email">مدیریت فایل ها</span></a>
                <ul class="menu-content">
                    <!--<li><a href="/portal/inbox"><i class="bx bx-left-arrow-alt"></i><span class="menu-item" data-i18n="Invoice List">نامه های وارده</span></a></li>-->
                    <li><a href="/admin/filemanager" ><i class="bx bx-left-arrow-alt"></i><span class="menu-item" data-i18n="Invoice List">مشاهده همه فایلها</span></a></li>
                    <li><a href="/admin/documents" ><i class="bx bx-left-arrow-alt"></i><span class="menu-item" data-i18n="Invoice List">لیست فایل های آموزشی</span></a></li>
                    <li><a href=" nav-item has-sub "><i class="bx bx-left-arrow-alt"></i><span class="menu-item" data-i18n="Invoice Add">درخواست ها</span></a>
                        <ul class="menu-content">
                            <!--<li><a href="/portal/coworking_space_request"><i class="bx bx-left-arrow-alt"></i><span class="menu-item" data-i18n="Invoice List">فضای کار اشتراکی</span></a></li>-->
                            <li><a href="#" class="disabled"><i class="bx bx-left-arrow-alt"></i><span class="menu-item" data-i18n="Invoice List">فضای کار اشتراکی</span></a></li>
                            <li><a href="#" class="disabled"><i class="bx bx-left-arrow-alt"></i><span class="menu-item" data-i18n="Invoice Add">جلسه منتورینگ و کوچینگ</span></a></li>
                            <li><a href="#" class="disabled"><i class="bx bx-left-arrow-alt"></i><span class="menu-item" data-i18n="Invoice Add">گواهینامه و معرفی نامه</span></a></li>
                            <li><a href="#" class="disabled"><i class="bx bx-left-arrow-alt"></i><span class="menu-item" data-i18n="Invoice Add">سایر درخواست ها</span></a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class=" nav-item"><a href="#"><span class="menu-title" data-i18n="Chat">آموزش</span></a>
                <ul class="menu-content">
                    <li><a href="/admin/education/students" ><i class="bx bx-left-arrow-alt"></i><span class="menu-item" data-i18n="Invoice List">لیست دانشجویان</span></a></li>
                    <li><a href=" nav-item has-sub "><i class="bx bx-left-arrow-alt"></i><span class="menu-item" >دوره ها</span></a>
                        <ul class="menu-content">
                            <li><a href="/admin/courses" ><i class="bx bx-left-arrow-alt"></i><span class="menu-item" >همه دوره ها</span></a></li>
                            <!--<li><a href="/portal/certificates"><i class="bx bx-left-arrow-alt"></i><span class="menu-item" data-i18n="Invoice Add">دریافت شده از شتابدهنده</span></a></li>-->
                            <li><a href="/admin/coursetype" ><i class="bx bx-left-arrow-alt"></i><span class="menu-item" >دسته بندی دوره ها</span></a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class=" nav-item"><a href="#"><span class="menu-title" data-i18n="Chat">مالی</span></a>
                <ul class="menu-content">
                    <li><a href="/admin/checkout" ><i class="bx bx-left-arrow-alt"></i><span class="menu-item" data-i18n="Invoice List">پرداختی ها</span></a></li>
                </ul>
            </li>
            <li class=" nav-item"><a href="#"><span class="menu-title" data-i18n="Chat">کلینیک</span></a>
                <ul class="menu-content">
                    <li><a href=" nav-item has-sub "><i class="bx bx-left-arrow-alt"></i><span class="menu-item" >کوچ ها</span></a>
                        <ul class="menu-content">
                            <li><a href="/admin/coach" ><i class="bx bx-left-arrow-alt"></i><span class="menu-item" >همه کوچ ها</span></a></li>
                            <li><a href="/admin/coach/request" ><i class="bx bx-left-arrow-alt"></i><span class="menu-item" >درخواست های همکاری</span></a></li>
                            <li><a href="/admin/coach/reject" ><i class="bx bx-left-arrow-alt"></i><span class="menu-item" >درخواست های رد شده</span></a></li>
                        </ul>
                    </li>

                    <li><a href=" nav-item has-sub "><i class="bx bx-left-arrow-alt"></i><span class="menu-item" >موضوعات کوچ ها</span></a>
                        <ul class="menu-content">
                            <!--<li><a href="/portal/coworking_space_request"><i class="bx bx-left-arrow-alt"></i><span class="menu-item" data-i18n="Invoice List">فضای کار اشتراکی</span></a></li>-->
                            <li><a href="/admin/category_coach/" ><i class="bx bx-left-arrow-alt"></i><span class="menu-item" >موضوعات</span></a></li>
                            <li><a href="/admin/category_coach/create" ><i class="bx bx-left-arrow-alt"></i><span class="menu-item" >موضوعات جدید</span></a></li>
                        </ul>
                    </li>
                    <li><a href=" nav-item has-sub "><i class="bx bx-left-arrow-alt"></i><span class="menu-item" >جلسات</span></a>
                        <ul class="menu-content">
                            <li><a href="/admin/booking/"><i class="bx bx-left-arrow-alt"></i><span class="menu-item" data-i18n="Invoice List">لیست جلسات</span></a></li>
                            <li><a href="/admin/booking/accept"><i class="bx bx-left-arrow-alt"></i><span class="menu-item" data-i18n="Invoice List">جلسات رزرو شده</span></a></li>
                            <li><a href="/admin/reserve/waiting"><i class="bx bx-left-arrow-alt"></i><span class="menu-item" data-i18n="Invoice List">رزروهای ناقص</span></a></li>
                            <li><a href="/admin/booking/reportallcoach"><i class="bx bx-left-arrow-alt"></i><span class="menu-item" data-i18n="Invoice List">گزارش</span></a></li>
                        </ul>
                    </li>
                    <li><a href=" nav-item has-sub "><i class="bx bx-left-arrow-alt"></i><span class="menu-item" data-i18n="Invoice Add">کوپن تخفیف</span></a>
                        <ul class="menu-content">
                            <li><a href="/admin/coupon/" ><i class="bx bx-left-arrow-alt"></i><span class="menu-item" data-i18n="Invoice List">کوپن ها</span></a></li>
                            <li><a href="/admin/coupon/create" ><i class="bx bx-left-arrow-alt"></i><span class="menu-item" data-i18n="Invoice List">کوپن جدید</span></a></li>

                        </ul>
                    </li>
                </ul>
            </li>

            <!--<li class=" nav-item"><a href="/portal/news"><i class="menu-livicon" data-icon="notebook"></i><span class="menu-title" data-i18n="Chat">اخبار</span></a></li>-->
            <li class=" nav-item"><a href="#" class="disabled"><span class="menu-title" data-i18n="Chat">اخبار</span></a></li>

            <li class=" nav-item"><a href="#"><span class="menu-title" data-i18n="Invoice">رویدادها</span></a>
                <ul class="menu-content">
                    <li><a href="/admin/event/all"><i class="bx bx-left-arrow-alt"></i><span class="menu-item" data-i18n="Invoice List">همه رویدادها</span></a></li>
                    <li><a href="/admin/event/create"><i class="bx bx-left-arrow-alt"></i><span class="menu-item" data-i18n="Invoice List">ایجاد رویداد</span></a></li>
                </ul>
            </li>
            <li class=" nav-item"><a href="#"><span class="menu-title" data-i18n="Chat">پیامک ها</span></a>
                <ul class="menu-content">
                    <li><a href="/admin/sms/recieve" ><i class="bx bx-left-arrow-alt"></i><span class="menu-item" data-i18n="Invoice List">آخرین پیامک های دریافتی</span></a></li>
                    <li><a href="/admin/settings/answerline" ><i class="bx bx-left-arrow-alt"></i><span class="menu-item" >منشی پیامک</span></a></li>
                </ul>
            </li>







            <li class=" nav-item"><a href="#"><span class="menu-title" data-i18n="Chat">تنظیمات</span></a>
                <ul class="menu-content">
                    <li><a href="/admin/settings/" ><i class="bx bx-left-arrow-alt"></i><span class="menu-item" data-i18n="Invoice List">تنظیمات کلی</span></a></li>
                    <li><a href="/admin/settingscore" ><i class="bx bx-left-arrow-alt"></i><span class="menu-item" data-i18n="Invoice Add">امتیازات</span></a></li>
                    <li><a href="/admin/settingscore" disabled="disabled"><i class="bx bx-left-arrow-alt"></i><span class="menu-item" data-i18n="Invoice Add">قیمت جلسات</span></a></li>
                    <li><a href="/admin/settings/user_type" ><i class="bx bx-left-arrow-alt"></i><span class="menu-item" >کاربرها</span></a></li>


                </ul>
            </li>
            <li class=" nav-item"><a href="#"><span class="menu-title" data-i18n="Chat">تماس با ما</span></a>

                <ul class="menu-content">
                    <li><a href="/admin/message"><i class="bx bx-left-arrow-alt"></i><span class="menu-item" data-i18n="Invoice List">انتقادات و پیشنهادات</span></a></li>
                    <li><a href="/admin/message/create"><i class="bx bx-left-arrow-alt"></i><span class="menu-item" data-i18n="Invoice List">ثبت تیکت</span></a></li>
                    <li><a href="#" class="disabled"><i class="bx bx-left-arrow-alt"></i><span class="menu-item" data-i18n="Invoice Add">راه های ارتباطی</span></a></li>
                </ul>

            </li>
            <li class=" nav-item {% if this.page.id == 'panel-faq' %}sidebar-group-active{% endif %}"><a href="/portal/faq"><span class="menu-title" data-i18n="Chat">سوالات متداول</span></a></li>
            <!--<li class=" nav-item {% if this.page.id == 'panel-coming_soon' %}sidebar-group-active{% endif %}"><a href="/portal/coming_soon"><i class="menu-livicon" data-icon="loader-15"></i><span class="menu-title" data-i18n="Kanban">به زودی</span></a></li>-->
        </ul>
    </div>
</div>
<!-- END: Main Menu-->
