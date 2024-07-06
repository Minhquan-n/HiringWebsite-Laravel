<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>

    {{-- Css --}}
    <link rel="stylesheet" href="{{ asset('css/Admin/layouts.css') }}" type="text/css" media="all">
    <link rel="stylesheet" href="{{ asset('css/Admin/danhmuc/tintuyendung.css') }}" type="text/css" media="all">
    <link rel="stylesheet" href="{{ asset('css/Admin/danhmuc/post_form.css') }}" type="text/css" media="all">
    <link rel="stylesheet" href="{{ asset('css/Admin/danhmuc/phongban_chinhanh.css') }}" type="text/css" media="all">
    <link rel="stylesheet" href="{{ asset('css/Admin/noidung/ungvien.css') }}" type="text/css" media="all">
    <link rel="stylesheet" href="{{ asset('css/Client/taikhoan/profiles/profile.css') }}" type="text/css" media="all">

    {{-- Font-awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    {{-- Jquery --}}
    <script src="{{ asset('jquery.js') }}"></script>

    {{-- Cac xu ly Javascript --}}
    <script src="{{ asset('js/admin/layout.js') }}"></script>
    <script src="{{ asset('js/admin/danhmuc/phongban-chinhanh/phongban.js') }}"></script>
    <script src="{{ asset('js/admin/danhmuc/phongban-chinhanh/chinhanh.js') }}"></script>

</head>
<body>
    <header>
            <span id="avatar">
                <div id="avatar_img"><i class="fa-solid fa-circle-user"></i></div>
            </span>
            <div class="dropdown_menu">
                <div class="dropdown_menu_headline {{ request()->is('trangchu')? 'dropdown_menu_active' : '' }}">
                    <a href="/trangchu" class="dropdown_menu_headline_icon">
                        <i class="fa-solid fa-house"></i>
                    </a>
                    <a href="/trangchu" class="dropdown_menu_headline_name">&nbsp;
                        Trang chủ
                    </a>
                </div>
            </div>
            <span class="menu_line"></span>
            <div class="dropdown_menu" id="menu_headline_taikhoancanhan">
                @if (request()->is('taikhoancanhan*'))
                    <div class="dropdown_menu_headline {{ request()->is('taikhoancanhan*')? 'dropdown_menu_active' : '' }}">
                @else
                    <div onclick="click_dropdown_menu('menu_headline_taikhoancanhan')"
                        class="dropdown_menu_headline {{ request()->is('taikhoancanhan*')? 'dropdown_menu_active' : '' }}">
                @endif
                    <div class="dropdown_menu_headline_icon">
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <div class="dropdown_menu_headline_name">&nbsp;
                        Tài khoản cá nhân
                        &nbsp; <i class="fa-solid fa-caret-down"></i>
                    </div>
                </div>
                <div class="dropdown_item" style="display: {{ request()->is('taikhoancanhan*')? 'flex' : '' }};">
                    <a href="/taikhoancanhan/thongtincanhan" class="{{ request()->is('taikhoancanhan/thongtincanhan')? 'dropdown_menu_item_active' : '' }}">
                        Thông tin cá nhân
                    </a>
                    <a href="/taikhoancanhan/thongtintaikhoan" class="{{ request()->is('taikhoancanhan/thongtintaikhoan*')? 'dropdown_menu_item_active' : '' }}">
                        Thông tin tài khoản
                    </a>
                </div>
            </div>
            <div class="dropdown_menu" id="menu_headline_noidung">
                @if (request()->is('noidung*'))
                    <div class="dropdown_menu_headline {{ request()->is('noidung*')? 'dropdown_menu_active' : '' }}">
                @else
                    <div onclick="click_dropdown_menu('menu_headline_noidung')"
                        class="dropdown_menu_headline {{ request()->is('noidung*')? 'dropdown_menu_active' : '' }}">
                @endif
                    <div class="dropdown_menu_headline_icon">
                        <i class="fa-solid fa-check-to-slot"></i>
                    </div>
                    <div class="dropdown_menu_headline_name">&nbsp;
                        Quản lý nội dung
                        &nbsp; <i class="fa-solid fa-caret-down"></i>
                    </div>
                </div>
                <div class="dropdown_item" style="display: {{ request()->is('noidung*')? 'flex' : '' }};">
                    <a href="/noidung/ungvien" class="{{ request()->is('noidung/ungvien*')? 'dropdown_menu_item_active' : '' }}">
                        Danh sách ứng viên
                    </a>
                    <a href="/noidung/phongvan" class="{{ request()->is('noidung/phongvan*')? 'dropdown_menu_item_active' : '' }}">
                        Danh sách mời phỏng vấn
                    </a>
                    <a href="/noidung/nhanviec" class="{{ request()->is('noidung/nhanviec*')? 'dropdown_menu_item_active' : '' }}">
                        Danh sách nhận việc
                    </a>
                </div>
            </div>
            <div class="dropdown_menu" id="menu_headline_danhmuc">
                @if (request()->is('danhmuc*'))
                    <div class="dropdown_menu_headline {{ request()->is('danhmuc*')? 'dropdown_menu_active' : '' }}">
                @else
                    <div onclick="click_dropdown_menu('menu_headline_danhmuc')"
                        class="dropdown_menu_headline {{ request()->is('danhmuc*')? 'dropdown_menu_active' : '' }}">
                @endif
                    <div class="dropdown_menu_headline_icon">
                        <i class="fa-solid fa-list"></i>
                    </div>
                    <div class="dropdown_menu_headline_name">&nbsp;
                        Quản lý danh mục
                        &nbsp; <i class="fa-solid fa-caret-down"></i>
                    </div>
                </div>
                <div class="dropdown_item" style="display: {{ request()->is('danhmuc*')? 'flex' : '' }};">
                    <a href="/danhmuc/tintuyendung" class="{{ request()->is('danhmuc/tintuyendung')? 'dropdown_menu_item_active' : '' }}">
                        Danh sách tin tuyển dụng
                    </a>
                    <a href="/danhmuc/phongban" class="{{ request()->is('danhmuc/phongban*')? 'dropdown_menu_item_active' : '' }}">
                        Danh sách phòng ban
                    </a>
                    <a href="/danhmuc/chinhanh" class="{{ request()->is('danhmuc/chinhanh*')? 'dropdown_menu_item_active' : '' }}">
                        Danh sách chi nhánh
                    </a>
                </div>
            </div>
            <div class="dropdown_menu" id="menu_headline_taikhoan">
                @if (request()->is('taikhoan*'))
                    <div class="dropdown_menu_headline {{ request()->is('taikhoan*')? 'dropdown_menu_active' : '' }}">
                @else
                    <div onclick="click_dropdown_menu('menu_headline_taikhoan')"
                        class="dropdown_menu_headline {{ request()->is('taikhoan*')? 'dropdown_menu_active' : '' }}">
                @endif
                    <div class="dropdown_menu_headline_icon">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <div class="dropdown_menu_headline_name">&nbsp;
                        Quản lý tài khoản
                        &nbsp; <i class="fa-solid fa-caret-down"></i>
                    </div>
                </div>
                <div class="dropdown_item" style="display: {{ request()->is('taikhoan*')? 'flex' : '' }};">
                    <a href="/taikhoan/quyentruycap" class="{{ request()->is('taikhoan/quyentruycap')? 'dropdown_menu_item_active' : '' }}">
                        Quyền truy cập
                    </a>
                    <a href="/taikhoan/nhanvien" class="{{ request()->is('taikhoan/nhanvien*')? 'dropdown_menu_item_active' : '' }}">
                        Tài khoản nhân viên
                    </a>
                    <a href="/taikhoan/khach" class="{{ request()->is('taikhoan/khach*')? 'dropdown_menu_item_active' : '' }}">
                        Tài khoản khách
                    </a>
                </div>
            </div>
            <span class="menu_line"></span>
            <div class="dropdown_menu">
                <div class="dropdown_menu_headline">
                    <a href="/logout" class="dropdown_menu_headline_icon">
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </a>
                    <a href="/logout" class="dropdown_menu_headline_name">&nbsp;
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
