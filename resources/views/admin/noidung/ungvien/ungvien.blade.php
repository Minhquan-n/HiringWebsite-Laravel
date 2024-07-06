@extends('layouts.admin_layout')

@section('content')
<div id="applicant_search" class="admin_search">
    <input type="text" id="applicant_search_input" class="admin_search_input" placeholder="Tìm kiếm">
    <button onclick="click_to_search()">Tìm kiếm</button>
</div>
<div id="applicant_list" class="post_list">
    <div id="applicant_title" class="post">
        <div class="thanhtieude">
            <div class="id"><p class="content">STT</p></div>
            <div class="mahoso"><p class="content">Mã hồ sơ</p></div>
            <div class="vitrituyen"><p class="content">Vị trí ứng tuyển</p></div>
            <div class="tenungvien"><p class="content">Tên ứng viên</p></div>
            <div class="ngay"><p class="content">Ngày nộp hồ sơ</p></div>
            <div class="trangthai"><p class="content">Trạng thái</p></div>
            <div class="applicant_button"><button type="submit" onclick="refresh_applicants()" id="add_post_button" class="reload_button"><i class="fa-solid fa-rotate"></i></button></div>
        </div>
        <div id="applicants" class="posts"></div>
    </div>
    <div id="applicant_pagination" class="pagination"></div>
</div>
<div id="update_cv" class="show_on_top">
    <div class="show_background" onclick="close_update_cv_status()"></div>
    <div id="update_cv_form" class="show_content content_medium">
        <h3>THÔNG BÁO ĐẾN  </h3>
        <div class="cv_form_row">
            <div id="cv_status_input" class="input">
                <span class="title_name">Trạng thái:</span>
                <span class="class_input">
                    <select name="cv_status" id="cv_status">
                        <option value="Chờ xử lý">Chờ xử lý</option>
                        <option value="Hẹn phỏng vấn">Hẹn phỏng vấn</option>
                        <option value="Nhận việc">Nhận việc</option>
                        <option value="Kết thúc hồ sơ">Kết thúc hồ sơ</option>
                    </select>
                </span>
            </div>
            <div id="cv_interviewday_input" class="input">
                <span class="title_name">Ngày phỏng vấn:</span>
                <span class="class_input">
                    <input type="date" name="cv_interviewday" id="cv_interviewday">
                </span>
            </div>
        </div>
        <div class="cv_form_row">
            <div id="cv_notice_input" class="input">
                <span class="title_name">Nội dung thông báo:</span>
                <span class="class_input">
                    <textarea name="cv_notice" id="cv_notice"></textarea>
                </span>
            </div>
        </div>
        <div class="cv_form_row">
            <div id="submit_button">
                <button id="applicants_update_submit" type="button">Gửi</button>
            </div>
        </div>
    </div>
</div>
<div id="applicant_cv" class="show_on_top">
    <div class="show_background" onclick="close_cv()"></div>
    <div id="applicant_cv_show" class="show_content content_large"></div>
</div>

<script src="{{ asset('js/admin/noidung/ungvien/ungvien.js') }}"></script>
@endsection
