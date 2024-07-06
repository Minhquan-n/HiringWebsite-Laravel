@extends('layouts.user_layout')

@section('content')
    <div id="account_experience_form" class="account_page">
        <div id="back_to_profile" class="profile_back_button">
            <div onclick="back_to_profile_upadate()"><i class="fa-solid fa-arrow-left"></i><p id="profile_back_button_title" class="profile_back_button_title">&nbsp;&nbsp;  Hồ sơ cá nhân</p></div>
        </div>
        <form action="/taikhoan/hoso/kinhnghiem" method="POST" enctype="multipart/form-data" class="account_profile_field_form" id="basic_info_form">
            @csrf
            <div class="account_profile_field_form_lable profile_filed_large"><h2>Kinh nghiệm làm việc</h2></div>
            <div class="form_row">
                <div class="profile_input">
                    <label for="experience_work">Công việc hiện tại:</label>
                    <input type="text" name="experience_work" id="experience_work" value="{{ $exp['congviec'] }}" >
                </div>
                <div class="profile_select">
                    <label for="experience_start">Từ năm:</label>
                    <input type="text" name="experience_start" id="experience_start" value="{{ $exp['nambatdau'] }}">
                </div>
                <div class="profile_select">
                    <label for="experience_end">Đến năm:</label>
                    <input type="text" name="experience_end" id="experience_end" value="{{ $exp['namketthuc'] }}">
                </div>
                <div class="profile_input">
                    <label for="experience_company">Tên công ty:</label>
                    <input type="text" name="experience_company" id="experience_company" value="{{ $exp['tencty'] }}" >
                </div>
                <div class="profile_input">
                    <label for="experience_position">Vị trí, chức vụ:</label>
                    <input type="text" name="experience_position" id="experience_position" value="{{ $exp['vitri'] }}" >
                </div>
                <div class="profile_input">
                    <label for="experience_mission">Nhiệm vụ chính:</label>
                    <input type="text" name="experience_mission" id="experience_mission" value="{{ $exp['nvchinh'] }}" >
                </div>
                <div class="profile_select">
                    <label for="experience_cur_salary">Mức lương hiện tại:</label>
                    <input type="text" name="experience_cur_salary" id="experience_cur_salary" value="{{ $exp['luonghientai'] }}">
                </div>
                <div class="profile_select">
                    <label for="experience_wish_salary">Mức lương mong muốn:</label>
                    <input type="text" name="experience_wish_salary" id="experience_wish_salary" value="{{ $exp['luongmongmuon'] }}">
                </div>
            </div>
            <div class="account_profile_field_form_button">
                <button type="button" onclick="open_experience_update_form()">Phục hồi</button>
                <button type="submit">Lưu</button>
            </div>
        </form>
    </div>
@endsection
