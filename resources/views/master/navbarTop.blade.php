<nav class="navbar sticky-top navbar-expand-lg navbar-light" id="navbartop">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" dir="rtl" id="navbarTogglerDemo01">
      <a class="navbar-brand" href="/">
        <img src="{{asset('images/white-logo.png')}}" alt="" />
      </a>
      <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        <li class="nav-item dropdown">
              <a class="nav-link " href="/" id="navbarDropdownMenuLink1" >
                 صفحه اصلی
              </a>
        </li>
        <li class="nav-item ">
          <a class="nav-link" href="/blogs/newposts" id="navbarDropdownMenuLink" role="button">
           بلاگ کوچ
          </a>
          <!-- <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="#">پکیج رایگان آموزش کوچینگ</a>
            <a class="dropdown-item" href="#">درخواست کوچینگ سازمانی</a>
            <a class="dropdown-item" href="#">درخواست مشاوره دوره آموزش کوچینگ</a>
            <a class="dropdown-item" href="#">آموزش آنلاین کوچینگ و مزایای آن</a>
          </div>-->
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link " href="/coaches/all" id="navbarDropdownMenuLink1" >
           لیست کوچ ها
          </a>
        </li>
          <li class="nav-item dropdown">
              <a class="nav-link " href="/event" id="navbarDropdownMenuLink1" >
                  رویدادها
              </a>
          </li>

      @if(request()->is('coach/*') &&(Auth::check()))
              <li class="nav-item ">
                  <a class="nav-link"  href="/cart" >
                      <span class="badge badge-light">{{$cart->count()}}</span>
                      <i class="bi bi-cart-fill"></i>
                  </a>
              </li>
      @endif
          <!--
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           کوچینگ چیست
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink1">
            <a class="dropdown-item" href="#">کوچینگ چیست</a>
            <a class="dropdown-item" href="#">سفر کوچینگ</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           فراکوچ
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink1">
            <a class="dropdown-item" href="#">اخبار و اطلاعیه ها</a>
            <a class="dropdown-item" href="#">چشم انداز و بیانیه ماموریت</a>
            <a class="dropdown-item" href="#">درباره ما</a>
            <a class="dropdown-item" href="#">تیم فراکوچ</a>
            <a class="dropdown-item" href="#">فرصت‌های شغلی فراکوچ</a>
            <a class="dropdown-item" href="#">فرم بازخورد</a>
          </div>
        </li>-->
      </ul>
      <!--
      <a href="">
          <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-cart3" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
          </svg>
      </a>
      -->
      @if(Auth::check())
            <ul class="nav nav-pills">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        {{Auth::user()->fname}} {{Auth::user()->lname}}
                        <i class="bi bi-person-circle"></i>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="/panel">صفحه مدیریت</a>
                        <a class="dropdown-item" href="/panel/user/password">تغییر رمز </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/logout">خروج</a>
                    </div>
                </li>
            </ul>

            <!--
            <a href="/panel" class="btn btn-primary" role="button" aria-pressed="true" id="btnRegister">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="m-0 bi bi-person-circle" viewBox="0 0 16 16">
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                </svg>
                پنل مدیریت
            </a>
            -->
      @else
            <a href="/login" class="btn btn-primary" role="button" aria-pressed="true" id="btnRegister">ورود / ثبت نام</a>
      @endif

    </div>
  </nav>
