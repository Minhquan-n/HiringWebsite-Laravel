<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>

    {{-- Css --}}
    <link rel="stylesheet" href="{{ asset('css/Client/layout/user_layout.css') }}" type="text/css" media="all">
    <link rel="stylesheet" href="{{ asset('css/Admin/danhmuc/tintuyendung.css') }}" type="text/css" media="all">
    <link rel="stylesheet" href="{{ asset('css/Client/taikhoan/taikhoan.css') }}" type="text/css" media="all">
    <link rel="stylesheet" href="{{ asset('css/Client/taikhoan/newpost.css') }}" type="text/css" media="all">
    <link rel="stylesheet" href="{{ asset('css/Client/taikhoan/applied.css') }}" type="text/css" media="all">
    <link rel="stylesheet" href="{{ asset('css/Client/taikhoan/profiles/profile.css') }}" type="text/css" media="all">
    <link rel="stylesheet" href="{{ asset('css/Client/taikhoan/profiles/profile_update.css') }}" type="text/css" media="all">
    <link rel="stylesheet" href="{{ asset('css/Client/taikhoan/profiles/profile_update_form.css') }}" type="text/css" media="all">
    <link rel="stylesheet" href="{{ asset('/css/Client/tuyendung/chitiettin.css') }}" type="text/css" media="all">

    {{-- Font-awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    {{-- Jquery --}}
    <script src="{{ asset('jquery.js') }}"></script>

    {{-- Cac xu ly Javascript --}}
    @if (request()->is('taikhoan/tinmoi'))
    <script src="{{ asset('js/client/taikhoan/newpost.js') }}"></script>
    @elseif (request()->is('taikhoan/ungtuyen'))
    <script src="{{ asset('js/client/taikhoan/appliedpost.js') }}"></script>
    @endif
    <script src="{{ asset('js/client/taikhoan/profiles/profile_personal_form.js') }}"></script>
    <script src="{{ asset('js/client/taikhoan/profiles/profile_update.js') }}"></script>
    <script src="{{ asset('js/client/taikhoan/taikhoan_trangchu.js') }}"></script>

</head>
<body>
    <header>
        <span id="avatar">
            <div id="avatar_img"><img src="{{ asset($hinhdaidien) }}" alt=""></div>
        </span>
        <span class="menu_line"></span>
        <div class="dropdown_menu" id="account_personal_profile">
            <div class="dropdown_menu_headline {{ request()->is('taikhoan/hoso*')? 'dropdown_menu_active' : ''  }}">
                <a href="/taikhoan/hoso" class="dropdown_menu_headline_icon">
                    <i class="fa-solid fa-address-card"></i>
                </a>
                <a href="/taikhoan/hoso" class="dropdown_menu_headline_name">&nbsp;
                    Hồ sơ cá nhân
                </a>
            </div>
        </div>
        <div class="dropdown_menu" id="account_new_post">
            <div class="dropdown_menu_headline {{ request()->is('taikhoan/tinmoi')? 'dropdown_menu_active' : ''  }}">
                <a href="/taikhoan/tinmoi" class="dropdown_menu_headline_icon">
                    <i class="fa-solid fa-newspaper"></i>
                </a>
                <a href="/taikhoan/tinmoi" class="dropdown_menu_headline_name">&nbsp;
                    Tin tuyển dụng mới
                </a>
            </div>
        </div>
        <div class="dropdown_menu" id="account_post_applied">
            <div class="dropdown_menu_headline {{ request()->is('taikhoan/ungtuyen')? 'dropdown_menu_active' : ''  }}">
                <a href="/taikhoan/ungtuyen" class="dropdown_menu_headline_icon">
                    <i class="fa-solid fa-list-ul"></i>
                </a>
                <a href="/taikhoan/ungtuyen" class="dropdown_menu_headline_name">&nbsp;
                    Ứng tuyển
                </a>
            </div>
        </div>
        <span class="menu_line"></span>
        <div class="dropdown_menu">
            <div class="dropdown_menu_headline">
                <a href="/dangxuat" class="dropdown_menu_headline_icon">
                    <i class="fa-solid fa-right-from-bracket"></i>
                </a>
                <a href="/dangxuat" class="dropdown_menu_headline_name">&nbsp;
                    Đăng xuất
                </a>
            </div>
        </div>
    </header>
    <main>
        @yield('content')
    </main>
</body>
</html>
