
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
        <img src="{{asset('images/white-logo.png')}}" alt="فراکوچ لگو" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">پنل کاربری فراکوچ</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @if(is_null(Auth::user()->personal_image))
                    <img class="img-circle elevation-2" src={{asset("/images/default-avatar.jpg")}} alt="..." />
                @else
                    <img class="img-circle elevation-2" src={{asset("/documents/users/".Auth::user()->personal_image)}} alt="..." />
                @endif

            </div>
            <div class="info">
                <a href="/panel/profile" class="d-block">{{Auth::user()->fname}} {{Auth::user()->lname}}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="/panel" class="nav-link @if(request()->is('panel')) active  @endif">
                        <i class="nav-icon fas fa-home"></i>
                        <p>                            صفحه اصلی
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/panel/profile" class="nav-link @if(request()->is('panel/profile*')) active  @endif">
                        <i class="nav-icon fas fa-users"></i>
                        <p>پروفایل</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/panel/messages#" class="nav-link @if(request()->is('panel/messages*')) active  @endif">
                        <i class="nav-icon fas fa-comment"></i>
                        <p>
                            پیام ها

                            <!-- <span class="badge badge-info right">6</span>-->
                        </p>
                    </a>
                </li>
                @if(Auth::user()->tel_verified==1)

                    <li class="nav-item">
                        <a href="/panel/introduced" class="nav-link @if(request()->is('panel/introduced*')) active  @endif">
                            <i class="nav-icon fas fa-file"></i>
                            <p>سفیر کوچینگ</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/panel/products" class="nav-link @if(request()->is('panel/products*')) active  @endif">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>محصولات</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/panel/documents" class="nav-link @if(request()->is('panel/documents*')) active  @endif">
                            <i class="fas fa-chalkboard-teacher"></i>
                            <p>فایلها</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/panel/freepackages" class="nav-link @if(request()->is('panel/freepackages*')) active  @endif">
                            <i class="fas fa-chalkboard"></i>
                            <p>دوره رایگان آموزش کوچینگ</p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview ">
                        <a href="#" class="nav-link @if(request()->is('panel/post*')||request()->is('panel/categoryposts*')||request()->is('panel/comments*')) active  @endif">
                            <i class="fas fa-blog"></i>
                            <p>بلاگ</p>
                            <i class="right fas fa-angle-left"></i>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/panel/post" class="nav-link @if(request()->is('panel/post*')) active  @endif">
                                    <i class="fas fa-blog"></i>
                                    <p>پست ها</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/panel/categoryposts" class="nav-link @if(request()->is('panel/categoryposts*')) active  @endif">
                                    <i class="fas fa-blog"></i>
                                    <p>دسته بندی مطالب</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/panel/comments" class="nav-link @if(request()->is('panel/comments*')) active  @endif">
                                    <i class="fas fa-comments"></i>
                                    <p>دیدگاه ها</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

