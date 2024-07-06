@extends('layouts.user_layout')

@section('content')
    <div id="account_education_form" class="account_page">
        <div id="back_to_profile" class="profile_back_button">
            <div onclick="back_to_profile_upadate()"><i class="fa-solid fa-arrow-left"></i><p id="profile_back_button_title" class="profile_back_button_title">&nbsp;&nbsp;  Hồ sơ cá nhân</p></div>
        </div>
        <form action="/taikhoan/hoso/hocvan" method="POST" enctype="multipart/form-data" class="account_profile_field_form" id="basic_info_form">
            @csrf
            <div class="account_profile_field_form_lable profile_filed_large"><h2>Thông tin học vấn</h2></div>
            <div class="form_row">
                <div class="profile_input">
                    <label for="education_school">Tên trường</label>
                    <input type="text" name="education_school" id="education_school" value="{{ $edu['truong'] }}" >
                </div>
                <div class="profile_select">
                    <label for="education_level">Trình độ</label>
                    <select name="education_level" id="education_level">
                        <option value="0" {{ $edu['trinhdo'] == 0 ? 'selected' : '' }}>Chưa chọn trình độ</option>
                        <option value="THPT" {{ $edu['trinhdo'] == 'THPT' ? 'selected' : '' }}>THPT</option>
                        <option value="Trung cấp" {{ $edu['trinhdo'] == "Trung cấp" ? 'selected' : '' }}>Trung cấp</option>
                        <option value="Cao đẳng" {{ $edu['trinhdo'] == "Cao đẳng" ? 'selected' : '' }}>Cao đẳng</option>
                        <option value="Đại học" {{ $edu['trinhdo'] == "Đại học" ? 'selected' : '' }}>Đại học</option>
                        <option value="Thạc sĩ" {{ $edu['trinhdo'] == "Thạc sĩ" ? 'selected' : '' }}>Thạc sĩ</option>
                        <option value="Tiến sĩ" {{ $edu['trinhdo'] == "Tiến sĩ" ? 'selected' : '' }}>Tiến sĩ</option>
                    </select>
                </div>
                <div class="profile_select">
                    <label for="education_major">Chuyên ngành</label>
                    <input type="text" name="education_major" id="education_major" value="{{ $edu['chuyennganh'] }}" >
                </div>
                <div class="profile_select">
                    <label for="education_classification">Xếp loại</label>
                    <select name="education_classification" id="education_classification">
                        <option value="0" {{ $edu['trinhdo'] == 0 ? 'selected' : '' }}>Chưa chọn xếp loại</option>
                        <option value="Xuất sắc" {{ $edu['xeploai'] == 'Xuất sắc' ? 'selected' : '' }}>Xuất sắc</option>
                        <option value="Giỏi" {{ $edu['xeploai'] == "Giỏi" ? 'selected' : '' }}>Giỏi</option>
                        <option value="Khá" {{ $edu['xeploai'] == "Khá" ? 'selected' : '' }}>Khá</option>
                        <option value="Trung bình - khá" {{ $edu['xeploai'] == "Trung bình - khá" ? 'selected' : '' }}>Trung bình - khá</option>
                        <option value="Trung bình" {{ $edu['xeploai'] == "Trung bình" ? 'selected' : '' }}>Trung bình</option>
                    </select>
                </div>
                <div class="profile_select">
                    <label for="education_start">Từ năm</label>
                    <input type="text" name="education_start" id="education_start" value="{{ $edu['nambatdau'] }}">
                </div>
                <div class="profile_select">
                    <label for="education_end">Đến năm</label>
                    <input type="text" name="education_end" id="education_end" value="{{ $edu['namketthuc'] }}">
                </div>
            </div>
            <div class="account_profile_field_form_button">
                <button type="button" onclick="open_education_update_form()">Phục hồi</button>
                <button type="submit">Lưu</button>
            </div>
        </form>
    </div>
@endsection
