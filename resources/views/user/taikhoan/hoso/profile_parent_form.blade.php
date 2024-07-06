@extends('layouts.user_layout')

@section('content')
    <div id="account_parent_form" class="account_page">
        <div id="back_to_profile" class="profile_back_button">
            <div onclick="back_to_profile_upadate()"><i class="fa-solid fa-arrow-left"></i><p id="profile_back_button_title" class="profile_back_button_title">&nbsp;&nbsp;  Hồ sơ cá nhân</p></div>
        </div>
        <form action="/taikhoan/hoso/nguoithan" method="POST" enctype="multipart/form-data" class="account_profile_field_form" id="basic_info_form">
            @csrf
            <div class="account_profile_field_form_lable profile_filed_large"><h2>Người thân làm việc tại DHG Pharma</h2></div>
            <p class="account_profile_update_note">*Nhập thông tin người thân đang làm việc tại DHG Pharma.</p>
            @foreach ($parent as $nt)
                <div class="form_row">
                    <div class="profile_input">
                        <label for="parent_name">Họ tên:</label>
                        <input type="text" name="parent_name" id="parent_name" value="{{ $nt['hoten_nguoithan'] }}" >
                    </div>
                    <div class="profile_input">
                        <label for="parent_relationship">Mối quan hệ:</label>
                        <input type="text" name="parent_relationship" id="parent_relationship" value="{{ $nt['mqh_nguoithan'] }}" >
                    </div>
                    <div class="profile_input">
                        <label for="parent_position">Nơi làm việc (Chức vụ):</label>
                        <input type="text" name="parent_position" id="parent_position" value="{{ $nt['noilamviec_nguoithan'] }}" >
                    </div>
                    <div class="profile_input">
                        <label for="parent_phone">Số điện thoại:</label>
                        <input type="text" name="parent_phone" id="parent_phone" value="{{ $nt['sdt_nguoithan'] }}" >
                    </div>
                </div>
            @endforeach
            <div class="account_profile_field_form_button">
                <button type="button" onclick="open_parent_update_form()">Phục hồi</button>
                <button type="submit">Lưu</button>
            </div>
        </form>
    </div>
@endsection
