<div class="sidebar-wrapper">
    <ul class="nav">
        <li >
            <a href="/panel">
                <i class="nc-icon nc-bank"></i>
                <p>صفحه اصلی</p>
            </a>
        </li>
        <li class="active ">
            <a href="/panel/profile">
                <i class="nc-icon nc-badge"></i>
                <p>اطلاعات شخصی</p>
            </a>
        </li>
        <li>
            <a href="/panel/messages/">
                <i class="nc-icon nc-send"></i>
                <p>پیام ها</p>
            </a>
        </li>
        @if(Auth::user()->tel_verified==1)
            <li>
                <a href="#">
                    <i class="nc-icon nc-user-run"></i>
                    <p>دوره ها (به زودی)</p>
                </a>
            </li>
            <li>
                <a href="#" class="text-muted">
                    <i class="nc-icon nc-money-coins"></i>
                    <p>مالی (به زودی)</p>
                </a>
            </li>
            <li>
                <a href="/panel/introduced" >
                    <i class="nc-icon nc-circle-10"></i>
                    <p>سفیر کوچینگ</p>
                </a>
            </li>
            <li>
                <a href="/panel/products">
                    <i class="nc-icon nc-caps-small"></i>
                    <p>محصولات</p>
                </a>
            </li>
            <li>
                <a href="/panel/documents">
                    <i class="fas fa-file"></i>
                    <p>فایل ها</p>
                </a>
            </li>
            <li>
                <a href="/panel/freepackages">
                    <i class="nc-icon nc-caps-small"></i>
                    <p>دوره رایگان آموزش کوچینگ</p>
                </a>
            </li>
            <li>
                <a href="/panel/post">
                    <i class="fas fa-blog"></i>
                    <p>بلاگ</p>
                </a>
            </li>
        @endif
    </ul>
</div>
