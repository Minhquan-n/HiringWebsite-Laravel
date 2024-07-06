@extends('layouts.client_layout')

@section('content')
<div class="post_detail_main">
    <div class="post_detail" id="post_detail">
        <div class="post_detail_title">
            <h2>{{ $tin['tieude'] }}</h2>
            <p class="post_detail_place">{{ $tin['tenchinhanh'] }}</p>
        </div>
        <span class="post_line"></span>
        <div class="post_detail_candidate">
            <div class="post_detail_candidate_left">
                <p>Số lượng cần tuyển: {{ $tin['soluong'] }} </p>
                <p>Độ tuổi: {{ $tin['dotuoi'] }}</p>
                <p>Giới tính: {{ $tin['gioitinh'] }}</p>
            </div>
            <div class="post_detail_candidate_right">
                <p>Đơn vị quản lý: {{ $tin['tenphongban'] }}</p>
                <p>Hạn nộp hồ sơ: {{ DateTime::createFromFormat("Y-m-d", $tin['hannophoso'])->format("d/m/Y") }}</p>
            </div>
        </div>
        <span class="post_line"></span>
        <div class="post_detail_content">
            <h3 class="post_detail_content_title">Mô tả công việc:</h3>
            <div class="post_detail_content_content">
                <ul id="post_detail_description">
                    @foreach ($tin['chitietcv'] as $chitiet)
                        <li>{{ $chitiet }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="post_detail_content">
            <h3 class="post_detail_content_title">Yêu cầu công việc:</h3>
            <div class="post_detail_content_content">
                <ul id="post_detail_request">
                    @foreach ($tin['yeucaucv'] as $yeucau)
                        <li>{{ $yeucau }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="post_detail_content">
            <h3 class="post_detail_content_title">Quyền lợi:</h3>
            <div class="post_detail_content_content">
                <ul id="post_detail_benefit">
                    @foreach ($tin['quyenloi'] as $quyenloi)
                        <li>{{ $quyenloi }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="post_content">
            <h3 class="post_detail_content_title">Hướng dẫn ứng tuyển và liên hệ:</h3>
            <div class="post_content_content">
                <strong>Hướng dẫn ứng tuyển:</strong>
                <ul>
                    <li>Bước 1: Chọn phần đăng nhập tại thanh menu. Chọn phần đăng ký tài khoản trong hộp thoại đăng nhập và điền thông tin tạo tài khoản mới.</li>
                    <li>Bước 2: Đăng nhập và điền đầy đủ thông tin cá nhân để ứng tuyển.</li>
                    <li>Bước 3: Chọn tin ứng tuyển tại mục tin tuyển dụng và chọn nộp hồ sơ ứng tuyển.</li>
                    <li>Bước 4: Sau khi ứng tuyển, bạn vui lòng chờ kết quả thông báo từ Công ty qua email, website công ty hoặc điện thoại.</li>
                </ul>
            </div>
            <div class="post_content_content" id="post_detail_contact">
                <strong>Thông tin liên hệ:</strong>
                <ul>
                    <li>Địa chỉ: 288 Bis Nguyễn Văn Cừ, P. An Hòa, Q. Ninh Kiều, TP. Cần Thơ.</li>
                    <li>Số điện thoại: 02923.893.715</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="news_post">
        <h3>Tin mới</h3>
        <span class="post_line"></span>
            @for ($i = 0; $i <= 4; $i++)
                <div class="new_post" onclick="post({{ $post[$i]['id'] }})">
                    <strong class="new_post_title">{{ $post[$i]['vitrituyen'] }}</strong>
                    <p class="new_post_place"><i class="fa-solid fa-location-dot"></i> &nbsp; {{ $post[$i]['tenchinhanh'] }}</p>
                </div>
            @endfor
        <div class="home_seemore"><a href="/tuyendung">Xem thêm</a></div>
    </div>
</div>
@endsection
