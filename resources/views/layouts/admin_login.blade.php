<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DHG Pharma</title>

    {{-- Css --}}
    <link rel="stylesheet" href="{{ asset("css/Admin/admin_login.css") }}" type="text/css" media="all">
    <link rel="stylesheet" href="{{ asset('/css/Client/layout/signin-signup_form.css') }}" type="text/css" media="all">

    {{-- Font-awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    {{-- Jquery --}}
    <script src="{{ asset('jquery.js') }}"></script>

    {{-- Javascript --}}
    <script src="{{ asset('js/admin/admin_login.js') }}"></script>

</head>
<body>
    <main>
        <img src="{{ asset('storage/logo-en.jpg') }}" alt="">
        <div class="admin_login">
            <form action="/admin" method="POST" onsubmit="login(event)">
                @csrf
                <h3>WELCOME BACK</h3>
                <span class="input">
                    <label for="signin_email">Email:</label>
                    <input type="text" name="signin_email" id="admin_email" placeholder="Email" oninput="checkInput('admin_email')">
                    <i class="fa-solid fa-circle-exclamation status_icon" id="admin_email_status_icon"></i>
                    <div class="status" id="admin_email_status"></div>
                </span>
                <span class="input">
                    <label for="signin_password">Mật khẩu</label>
                    <input type="password" name="signin_password" id="admin_password" placeholder="Mật khẩu" oninput="checkInput('admin_password')">
                    <i class="fa-solid fa-circle-exclamation status_icon" id="admin_password_status_icon"></i>
                    <div class="status" id="admin_password_status"></div>
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
            </form>
        </div>
    </main>
</body>
</html>
