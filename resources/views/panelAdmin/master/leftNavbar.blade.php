<div class="sidebar-wrapper">

    <ul class="nav">
        <li @if(request()->is('panel*')) class="active"  @endif>
            <a href="/panel">
                <i class="nc-icon nc-bank"></i>
                <p>صفحه اصلی</p>
            </a>
        </li>
        <li @if(request()->is('admin/user*')) class="active"  @endif>
            <a href="/admin/users">
                <i class="nc-icon nc-badge"></i>
                <p>کاربرها</p>
            </a>
        </li>
        <li @if(request()->is('admin/message*')) class="active"  @endif>
            <a href="/admin/messages/">
                <i class="nc-icon nc-send"></i>
                <p>پیام ها</p>
            </a>
        </li>
        <li>
            <a href="#">
                <i class="nc-icon nc-user-run"></i>
                <p>دوره ها</p>
            </a>
        </li>
        <li>
            <a href="#">
                <i class="nc-icon nc-money-coins"></i>
                <p>مالی</p>
            </a>
        </li>
        <li @if(request()->is('admin/filemanager*')) class="active"  @endif>
            <a href="/admin/filemanager">
                <i class="nc-icon nc-album-2"></i>
                <p>مدیریت فایلها</p>
            </a>
        </li>
        @if(Auth::user()->type==2)
            <li @if(request()->is('admin/setting*')) class="active"  @endif>
                <a href="/admin/settings/">
                    <i class="nc-icon nc-settings"></i>
                    <p>تنظیمات</p>
                </a>
            </li>
        @endif
        <li @if(request()->is('admin/report*')) class="active"  @endif>
            <a href="/admin/reports/">
                <i class="nc-icon nc-settings"></i>
                <p>گزارش گیری</p>
            </a>
        </li>


    </ul>
</div>
