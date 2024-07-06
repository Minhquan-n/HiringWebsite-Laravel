@extends('layouts.user_layout')

@section('content')
    <div id="account_profile_update" class="account_page">
        <div id="back_to_profile" class="profile_back_button">
            <div onclick="back_to_profile()"><i class="fa-solid fa-arrow-left"></i><p id="profile_back_button_title" class="profile_back_button_title">&nbsp;&nbsp;  Hồ sơ cá nhân</p></div>
        </div>
        <h2>Thông tin cá nhân</h2>
        <p class="account_profile_update_note">*Bạn cần cung cấp đầy đủ thông tin tại các mục có <b>(*)</b> để ứng tuyển.</p>
        <div class="account_profile_field" onclick="open_profile_update_form()">
            <div class="account_profile_field_title">
                <!-- avatar, họ tên, email, sđt, ngày sinh, giới tính, nơi sinh.-->
                <p class="account_profile_field_title_name">Thông tin lý lịch <b>(*)</b></p>
                <p class="account_profile_field_title_note">*Thông tin ảnh hồ sơ, họ tên, email, số điện thoại, ....</p>
            </div>
            <div class="account_profile_field_status" id="ttcn_status">
                <p class="{{ $status['ttcn'] == 0 ? 'profile_status_success' : 'profile_status_fail' }}">
                    {{ $status['ttcn'] == 0 ? 'Đã cập nhật' : 'Chưa cập nhật' }}
                </p>
            </div>
            <i class="fa-solid fa-angle-right"></i>
        </div>
        <div class="account_profile_field" onclick="open_education_update_form()">
            <div class="account_profile_field_title">
                <!-- quốc tịch, địa chỉ thường trú, thông tin gia đình (thông tin cha mẹ ace) -->
                <p class="account_profile_field_title_name">Thông tin học vấn <b>(*)</b></p>
                <p class="account_profile_field_title_note">*Thông tin nơi đào tạo, trình độ, chuyên ngành, ....</p>
            </div>
            <div class="account_profile_field_status" id="tthv_status">
                <p class="{{ $status['tthv'] == 0 ? 'profile_status_success' : 'profile_status_fail' }}">
                    {{ $status['tthv'] == 0 ? 'Đã cập nhật' : 'Chưa cập nhật' }}
                </p>
            </div>
            <i class="fa-solid fa-angle-right"></i>
        </div>
        <div class="account_profile_field" onclick="open_skill_update_form()">
            <div class="account_profile_field_title">
                <!-- nơi sinh, quốc tịch, địa chỉ thường trú, thông tin gia đình (thông tin cha mẹ ace) -->
                <p class="account_profile_field_title_name">Kỹ năng <b>(*)</b></p>
                <p class="account_profile_field_title_note">*Thông tin về các kỹ năng đã được học hoặc đào tạo.</p>
            </div>
            <div class="account_profile_field_status" id="kn_status">
                <p class="{{ $status['ttkn'] == 0 ? 'profile_status_success' : 'profile_status_fail' }}">
                    {{ $status['ttkn'] == 0 ? 'Đã cập nhật' : 'Chưa cập nhật' }}
                </p>
            </div>
            <i class="fa-solid fa-angle-right"></i>
        </div>
        <div class="account_profile_field" onclick="open_experience_update_form()">
            <div class="account_profile_field_title">
                <!-- nơi sinh, quốc tịch, địa chỉ thường trú, thông tin gia đình (thông tin cha mẹ ace) -->
                <p class="account_profile_field_title_name">Kinh nghệm làm việc</p>
                <p class="account_profile_field_title_note">*Thông tin về công việc, vị trí, chức vụ đã đạt được, ....</p>
            </div>
            <div class="account_profile_field_status" id="knlv_status">
                <p class="{{ $status['ttexp'] == 0 ? 'profile_status_success' : 'profile_status_fail' }}">
                    {{ $status['ttexp'] == 0 ? 'Đã cập nhật' : 'Chưa cập nhật' }}
                </p>
            </div>
            <i class="fa-solid fa-angle-right"></i>
        </div>
        <div class="account_profile_field" onclick="open_parent_update_form()">
            <div class="account_profile_field_title">
                <!-- nơi sinh, quốc tịch, địa chỉ thường trú, thông tin gia đình (thông tin cha mẹ ace) -->
                <p class="account_profile_field_title_name">Thông tin người thân làm việc tại DHG Pharma</p>
                <p class="account_profile_field_title_note">*Thông tin người thân đang làm việc tại công ty.</p>
            </div>
            <div class="account_profile_field_status" id="ntDHG_status">
                <p class="{{ $status['ttnt'] == 0 ? 'profile_status_success' : 'profile_status_fail' }}">
                    {{ $status['ttnt'] == 0 ? 'Đã cập nhật' : 'Chưa cập nhật' }}
                </p>
            </div>
            <i class="fa-solid fa-angle-right"></i>
        </div>
    </div>
@endsection
