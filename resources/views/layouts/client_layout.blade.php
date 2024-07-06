<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>

    {{-- Cai dat css --}}
    <link rel="stylesheet" href="{{ asset('/css/Client/layout/layout.css') }}" type="text/css" media="all">
    <link rel="stylesheet" href="{{ asset('/css/Client/layout/signin-signup_form.css') }}" type="text/css" media="all">
    <link rel="stylesheet" href="{{ asset('/css/Client/trangchu/trangchu.css') }}" type="text/css" media="all">
    <link rel="stylesheet" href="{{ asset('/css/Client/tuyendung/tuyendung.css') }}" type="text/css" media="all">
    <link rel="stylesheet" href="{{ asset('/css/Client/tuyendung/chitiettin.css') }}" type="text/css" media="all">
    <link rel="stylesheet" href="{{ asset('/css/Client/gioithieu-lienhe/gioithieu-lienhe.css') }}" type="text/css" media="all">

    {{-- Font-awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    {{-- Jquery --}}
    <script src="{{ asset('jquery.js') }}"></script>

    {{-- Cai dat javascript --}}
    <script src="{{ asset('js/client/layout/layout.js') }}"></script>
    <script src="{{ asset('js/client/layout/signin_signup.js') }}"></script>
    <script src="{{ asset('js/client/tuyendung/tuyendung.js') }}"></script>
    <script src="{{ asset('js/client/tuyendung/chitiettin.js') }}"></script>

</head>
<body>
    <header>
        <div id="logo">
            <img src="{{ asset('storage/logo-en.jpg') }}" alt="">
        </div>
        <ul id="navigation">
            <li>
                <a href="/" class="{{ request()->is('/')? 'isActive' : '' }}">TRANG CHỦ</a>
            </li>
            <li>
                <a href="/gioithieu" class="{{ request()->is('gioithieu')? 'isActive' : '' }}">GIỚI THIỆU</a>
            </li>
            <li>
                <a href="/tuyendung" class="{{ request()->is('tuyendung*')? 'isActive' : '' }}">TUYỂN DỤNG</a>
            </li>
            <li>
                <a href="/lienhe" class="{{ request()->is('lienhe')? 'isActive' : '' }}">LIÊN HỆ</a>
            </li>
            <li onclick="open_signin_form()">
                <div>ĐĂNG NHẬP</div>
            </li>
        </ul>
    </header>
    <main>
        <div id="form_signin_signup"
        @if (session('status'))
            style="display: flex"
        @endif>
            <div id="form_background" onclick="close_form()"></div>
            <div id="form">
                <div class="close_form"><i class="fa-solid fa-x" onclick="close_form()"></i></div>
                <form id="signin_form" action="/dangnhap" method="POST" onsubmit="login(event)"
                @if (session('status'))
                    style="display: flex"
                @endif>
                    @csrf
                    <h3>ĐĂNG NHẬP</h3>
                    <span class="input">
                        <label for="signin_email">Email:</label>
                        <input type="text" name="signin_email" id="signin_email" placeholder="Email" oninput="checkInput('signin_email')">
                        <i class="fa-solid fa-circle-exclamation status_icon" id="signin_email_status_icon"></i>
                        <div class="status" id="signin_email_status"></div>
                    </span>
                    <span class="input">
                        <label for="signin_password">Mật khẩu</label>
                        <input type="password" name="signin_password" id="signin_password" placeholder="Mật khẩu" oninput="checkInput('signin_password')">
                        <i class="fa-solid fa-circle-exclamation status_icon" id="signin_password_status_icon"></i>
                        <div class="status" id="signin_password_status"></div>
                    </span>
                    <div id="signinStatus"
                    @if (session('status'))
                        style="display: block"
                    @endif>
                        @if (session('status') == "fail")
                            <p>Email hoặc mật khẩu không đúng.</p>
                        @elseif (session('status') == 'unknow')
                            <p>Bạn chưa đăng nhập.</p>
                        @endif
                    </div>
                    <div id="forgot_password">Quên mật khẩu?</div>
                    <div class="button"><button type="submit">Đăng nhập</button></div>
                    <span class="form_line"></span>
                    <div class="signin_signup"><p>Bạn chưa có tài khoản? <b onclick="open_signup_form()">Đăng ký ngay.</b></p></div>
                </form>
                <div id="signup_form">
                    <h3>ĐĂNG KÝ</h3>
                    <span class="input">
                        <label for="signup_email">Email</label>
                        <input type="text" name="signup_email" id="signup_email" placeholder="Email" oninput="checkInput('signup_email')">
                        <i class="fa-solid fa-circle-exclamation status_icon" id="signup_email_status_icon"></i>
                        <div class="status" id="signup_email_status"></div>
                    </span>
                    <span class="input">
                        <label for="signup_password">Mật khẩu</label>
                        <input type="password" name="signup_password" id="signup_password" placeholder="Mật khẩu" oninput="checkInput('signup_password')">
                        <i class="fa-solid fa-circle-exclamation status_icon" id="signup_password_status_icon"></i>
                        <div class="status" id="signup_password_status"></div>
                    </span>
                    <span class="input">
                        <label for="signup_confilmpassword">Nhập lại mật khẩu</label>
                        <input type="password" name="signup_confilmpassword" id="signup_confilmpassword" placeholder="Nhập lại mật khẩu" oninput="checkInput('signup_confilmpassword')">
                        <i class="fa-solid fa-circle-exclamation status_icon" id="signup_confilmpassword_status_icon"></i>
                        <div class="status" id="signup_confilmpassword_status"></div>
                    </span>
                    <span class="input">
                        <label for="signup_fullname">Họ tên</label>
                        <input type="text" name="signup_fullname" id="signup_fullname" placeholder="Họ tên" oninput="checkInput('signup_fullname')">
                        <i class="fa-solid fa-circle-exclamation status_icon" id="signup_fullname_status_icon"></i>
                        <div class="status" id="signup_fullname_status"></div>
                    </span>
                    <span class="input">
                        <label for="signup_phone">Số điện thoại</label>
                        <input type="text" name="signup_phone" id="signup_phone" placeholder="Số điện thoại" oninput="checkInput('signup_phone')">
                        <i class="fa-solid fa-circle-exclamation status_icon" id="signup_phone_status_icon"></i>
                        <div class="status" id="signup_phone_status"></div>
                    </span>
                    <span class="input">
                        <label for="signup_sex">Giới tính</label>
                        <select name="signup_sex" id="signup_sex" >
                            <option value="Nam">Nam</option>
                            <option value="Nữ">Nữ</option>
                        </select>
                    </span>
                    <div id="signupStatus"></div>
                    <div id="note">*Chú ý:<br>Bạn hãy điền đầy đủ thông tin tạo tài khoản.<br>Sau khi tạo tài khoản thành công, bạn hãy đăng nhập và điền đầy đủ thông tin và nộp hồ sơ ứng tuyển.</div>
                    <div class="button"><button type="button" onclick="register()">Đăng ký</button></div>
                    <span class="form_line"></span>
                    <div class="signin_signup"><p>Bạn đã có tài khoản? <b onclick="open_signin_form()">Đăng nhập.</b></p></div>
                </div>
            </div>
        </div>
        @yield('content')
    </main>
    <footer>
        <div id="scrollTop" onclick="scrollToTop()"><i class="fa-solid fa-arrow-up"></i></div>
        <img src="{{ asset('storage/logo-en.jpg') }}" alt="">
        <p>228Bis, Nguyễn Văn Cừ, P. An Hòa, Q. Ninh Kiều, Tp. Cần Thơ<br>02923.893.751</p>
        <p id="footerMail">DHG PHARMA</p>
    </footer>
</body>
</html>
