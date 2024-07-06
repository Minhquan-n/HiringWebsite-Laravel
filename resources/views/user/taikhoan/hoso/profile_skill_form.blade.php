@extends('layouts.user_layout')

@section('content')
    <div id="account_skill_form" class="account_page">
        <div id="back_to_profile" class="profile_back_button">
            <div onclick="back_to_profile_upadate()"><i class="fa-solid fa-arrow-left"></i><p id="profile_back_button_title" class="profile_back_button_title">&nbsp;&nbsp;  Hồ sơ cá nhân</p></div>
        </div>
        <form action="/taikhoan/hoso/kynang" method="POST" enctype="multipart/form-data" class="account_profile_field_form" id="basic_info_form">
            @csrf
            <div class="account_profile_field_form_lable profile_filed_large"><h2>Kỹ năng</h2></div>
            <div class="form_row">
                <div class="profile_input">
                    <label for="skill_computer">Tin học:</label>
                    <input type="text" name="skill_computer" id="skill_computer" value="{{ $skill['tinhoc'] }}" >
                </div>
                <div class="profile_input">
                    <label for="skill_language">Ngoại ngữ:</label>
                    <input type="text" name="skill_language" id="skill_language" value="{{ $skill['ngoaingu'] }}" >
                </div>
                <div class="profile_input">
                    <label for="skill_another">Chứng chỉ, kỹ năng khác:</label>
                    <textarea type="text" name="skill_another" id="skill_another" value="" >{{ $skill['skillkhac'] }}</textarea>
                </div>
            </div>
            <div class="account_profile_field_form_button">
                <button type="button" onclick="open_skill_update_form()">Phục hồi</button>
                <button type="submit">Lưu</button>
            </div>
        </form>
    </div>
@endsection
