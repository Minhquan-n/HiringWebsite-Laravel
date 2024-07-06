@extends('layouts.user_layout')

@section('content')
    <div id="account_profile_update_form" class="account_page">
        <div id="back_to_profile" class="profile_back_button">
            <div onclick="back_to_profile_upadate()"><i class="fa-solid fa-arrow-left"></i><p id="profile_back_button_title" class="profile_back_button_title">&nbsp;&nbsp;  Hồ sơ cá nhân</p></div>
        </div>
        <form action="/taikhoan/hoso/lylich" method="POST" enctype="multipart/form-data" class="account_profile_field_form" id="basic_info_form">
            @csrf
            <div class="account_profile_field_form_lable profile_filed_large"><h2>Thông tin lý lịch</h2></div>
            {{-- Các ô nhập thông tin cá nhân --}}
            <div class="account_profile_field_lable profile_filed_large"><p>1. Thông tin cá nhân</p></div>
            <div class="form_row" id="basic_info">
                <div id="avatar_side">
                    <div id="avatar_holder"><img src="{{ asset($hinhdaidien) }}" alt=""></div>
                    <label for="avatar_input">Chọn hình ảnh</label>
                    <input type="file" name="avatar_input" id="avatar_input" onchange="upload_avatar()">
                </div>
                <div id="basic_info_side">
                    <div class="profile_input">
                        <label for="personal_fullname">Họ tên</label>
                        <input type="text" name="personal_fullname" id="personal_fullname" value="{{ $user['hoten'] }}" >
                    </div>
                    <div class="profile_select">
                        <label for="personal_email">Email</label>
                        <input type="text" name="personal_email" id="personal_email" value="{{ $user['email'] }}">
                    </div>
                    <div class="profile_select">
                        <label for="personal_phone">Số điện thoại</label>
                        <input type="text" name="personal_phone" id="personal_phone" value="{{ $user['sdt'] }}" >
                    </div>
                    <div class="profile_select" id="profile_date_of_birth">
                        <label for="personal_date_of_birth">Ngày sinh</label>
                        <input type="date" name="personal_date_of_birth" id="personal_date_of_birth" value="{{ $user['ngaysinh'] }}" >
                    </div>
                    <div class="profile_select">
                        <label for="personal_sex">Giới tính</label>
                        <select name="personal_sex" id="personal_sex" >
                            <option value="Nam" {{ $user['gioitinh'] == 'Nam'? 'selected' : '' }}>Nam</option>
                            <option value="Nữ" {{ $user['gioitinh'] == 'Nữ'? 'selected' : '' }}>Nữ</option>
                        </select>
                    </div>
                    <div class="profile_select">
                        <label for="personal_country">Quốc tịch</label>
                        <select name="personal_country" id="personal_country" >
                            <option value="0" {{ $user['id_quoctich'] == 0 ? "selected" : "" }}>Chưa xác định</option>
                            @foreach ($quocgia as $quoctich)
                                <option value="{{ $quoctich['id_quoctich'] }}" {{ $user['id_quoctich'] == $quoctich['id_quoctich']? "selected" : "" }}>{{ $quoctich['tenquocgia'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="profile_select">
                        <label for="personal_nation">Dân tộc</label>
                        <select name="personal_nation" id="personal_nation" >
                            <option value="55" {{ $user['id_dantoc'] == 55 ? "selected" : "" }}>Chưa chọn dân tộc</option>
                            @foreach ($dantoc as $dt)
                                <option value="{{ $dt['id_dantoc'] }}" {{ $user['id_dantoc'] == $dt['id_dantoc']? "selected" : "" }}>{{ $dt['tendantoc'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            {{-- Các ô nhập thông tin thường trú --}}
            <div class="account_profile_field_lable"><p>2. Địa chỉ thường trú</p></div>
            <div class="form_row">
                <div class="profile_input">
                    <label for="personal_address">Số nhà, tên đường, khu vực</label>
                    <input type="text" name="personal_address" id="personal_address" value="{{ $user['dctr_sonha'] }}" >
                </div>
                <div class="profile_select">
                    <label for="personal_address_province">Tỉnh, thành phố</label>
                    <select name="personal_address_province" id="personal_address_province" onchange="open_district_list('personal_address')">
                        @foreach ($tinhthanh as $tinh)
                            <option value="{{ $tinh['id_tinhthanh'] }}" {{ $user['dctr_tinh'] == $tinh['id_tinhthanh']? "selected" : "" }}>{{ $tinh['tentinhthanh'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="profile_select">
                    <label for="personal_address_district">Quận, huyện</label>
                    <select name="personal_address_district" id="personal_address_district" onchange="open_ward_list('personal_address')">
                        @foreach ($dctr_quan_list as $dctr_quan)
                            <option value="{{ $dctr_quan['id_quanhuyen'] }}" {{ $user['dctr_quan'] == $dctr_quan['id_quanhuyen'] ? 'selected' : '' }}>{{ $dctr_quan['tenquanhuyen'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="profile_select">
                    <label for="personal_address_ward">Phường, xã</label>
                    <select name="personal_address_ward" id="personal_address_ward" >
                        @foreach ($dctr_phuong_list as $dctr_phuong)
                            <option value="{{ $dctr_phuong['id_phuongxa'] }}" {{ $user['dctr_phuong'] == $dctr_phuong['id_phuongxa']? 'selected' : '' }}>{{ $dctr_phuong['tenphuongxa'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            {{-- Các ô nhập địa chỉ liên hệ --}}
            <div class="account_profile_field_lable"><p>3. Địa chỉ liên hệ</p></div>
            <div class="form_row">
                <div class="profile_input">
                    <label for="personal_contact_address">Số nhà, tên đường, khu vực</label>
                    <input type="text" name="personal_contact_address" id="personal_contact_address" value="{{ $user['dclh_sonha'] }}" >
                </div>
                <div class="profile_select">
                    <label for="personal_contact_address_province">Tỉnh, thành phố</label>
                    <select name="personal_contact_address_province" id="personal_contact_address_province" onchange="open_district_list('personal_contact_address')">
                        @foreach ($tinhthanh as $tinh)
                            <option value="{{ $tinh['id_tinhthanh'] }}" {{ $user['dclh_tinh'] == $tinh['id_tinhthanh']? "selected": "" }}>{{ $tinh['tentinhthanh'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="profile_select">
                    <label for="personal_contact_address_district">Quận, huyện</label>
                    <select name="personal_contact_address_district" id="personal_contact_address_district" onchange="open_ward_list('personal_contact_address')">
                        @foreach ($dclh_quan_list as $dclh_quan)
                            <option value="{{ $dclh_quan['id_quanhuyen'] }}" {{ $user['dclh_quan'] == $dclh_quan['id_quanhuyen'] ? 'selected' : '' }}>{{ $dclh_quan['tenquanhuyen'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="profile_select">
                    <label for="personal_contact_address_ward">Phường, xã</label>
                    <select name="personal_contact_address_ward" id="personal_contact_address_ward" >
                        @foreach ($dclh_phuong_list as $dclh_phuong)
                            <option value="{{ $dclh_phuong['id_phuongxa'] }}" {{ $user['dclh_phuong'] == $dclh_phuong['id_phuongxa']? 'selected' : '' }}>{{ $dclh_phuong['tenphuongxa'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            {{-- Người liên hệ khẩn cấp --}}
            <div class="account_profile_field_lable"><p>4. Người thân liên hệ khẩn cấp (khi cần thiết)</p></div>
            <div class="form_row">
                <div class="profile_select">
                    <label for="personal_familiar_contact">Họ tên người thân</label>
                    <input type="text" name="personal_familiar_contact" id="personal_familiar_contact" value="{{ $user['tennguoithan'] }}" >
                </div>
                <div class="profile_select">
                    <label for="personal_familiar_contact_relationship">Mối quan hệ</label>
                    <input type="text" name="personal_familiar_contact_relationship" id="personal_familiar_contact_relationship" value="{{ $user['mqh'] }}" >
                </div>
                <div class="profile_select">
                    <label for="personal_familiar_contact_phone">Số điện thoại liên hệ</label>
                    <input type="text" name="personal_familiar_contact_phone" id="personal_familiar_contact_phone" value="{{ $user['sdt_nguoithan'] }}" >
                </div>
            </div>
            <div class="account_profile_field_form_button">
                <button type="button" onclick="open_profile_update_form()">Phục hồi</button>
                <button type="submit">Lưu</button>
            </div>
        </form>
    </div>
@endsection
