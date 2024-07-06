@extends('layouts.admin_layout')

@section('content')
    <div id="applicants_cv_page" class="applicant_cv_page">
        <h1>HỒ SƠ ỨNG VIÊN </h1>
        <div class="profile_field">
            <h3>THÔNG TIN CÁ NHÂN</h3>
            <span class="profile_line"></span>
            <div class="profile_row" id="basic_info">
                <div class="avatar_side">
                    <div class="avatar_holder"><img src="{{ asset($hinhdaidien) }}" alt=""></div>
                </div>
                <div class="basic_info_side">
                    <div class="profile_field_row_large">
                        <div class="profile_field_row_left"><strong>Họ tên:</strong></div>
                        <div class="profile_field_row_right"><p>{{ $user['hoten'] }}</p></div>
                    </div>
                    <div class="profile_field_row_large">
                        <div class="profile_field_row_left"><strong>Email:</strong></div>
                        <div class="profile_field_row_right"><p>{{ $user['email'] }}</p></div>
                    </div>
                    <div class="profile_field_row_large">
                        <div class="profile_field_row_left"><strong>Số điện thoại:</strong></div>
                        <div class="profile_field_row_right"><p>{{ $user['sdt'] }}</p></div>
                    </div>
                    <div class="profile_field_row_medium">
                        <div class="profile_field_row_left"><strong>Ngày sinh:</strong></div>
                        <div class="profile_field_row_right"><p>{{ DateTime::createFromFormat("Y-m-d", $user['ngaysinh'])->format("d/m/Y") }}</p></div>
                    </div>
                    <div class="profile_field_row_medium">
                        <div class="profile_field_row_left"><strong>Giới tính:</strong></div>
                        <div class="profile_field_row_right"><p>{{ $user['gioitinh'] }}</p></div>
                    </div>
                    <div class="profile_field_row_medium">
                        <div class="profile_field_row_left"><strong>Quốc tịch:</strong></div>
                        <div class="profile_field_row_right"><p>{{ $user['tenquocgia'] }}</p></div>
                    </div>
                    <div class="profile_field_row_medium">
                        <div class="profile_field_row_left"><strong>Dân tộc:</strong></div>
                        <div class="profile_field_row_right"><p>{{ $user['tendantoc'] }}</p></div>
                    </div>
                </div>
            </div>
            <span class="profile_line"></span>
            <div class="profile_row">
                <div class="profile_field_row_large">
                    <div class="profile_field_row_left"><strong>Địa chỉ thường trú:</strong></div>
                    <div class="profile_field_row_right"><p>{{ $user['diachithuongtru'] }}</p></div>
                </div>
                <div class="profile_field_row_large">
                    <div class="profile_field_row_left"><strong>Địa chỉ liên hệ:</strong></div>
                    <div class="profile_field_row_right"><p>{{ $user['diachilienhe'] }}</p></div>
                </div>
                <span class="profile_line"></span>
                <div class="profile_field_row_large">
                    <div class="profile_field_row_left"><strong>Tên người thân liên hệ (khẩn cấp):</strong></div>
                    <div class="profile_field_row_right"><p>{{ $user['tennguoithan'] }}</p></div>
                </div>
                <div class="profile_field_row_medium">
                    <div class="profile_field_row_left"><strong>Mối quan hệ:</strong></div>
                    <div class="profile_field_row_right"><p>{{ $user['mqh'] }}</p></div>
                </div>
                <div class="profile_field_row_medium">
                    <div class="profile_field_row_left"><strong>Số điện thoại:</strong></div>
                    <div class="profile_field_row_right"><p>{{ $user['sdt_nguoithan'] }}</p></div>
                </div>
            </div>
        </div>
        <div class="profile_field">
            <h3>THÔNG TIN HỌC VẤN</h3>
            <span class="profile_line"></span>
            <div class="profile_row">
                <div class="profile_field_row_medium">
                    <div class="profile_field_row_left"><strong>Trường:</strong></div>
                    <div class="profile_field_row_right"><p>{{ $edu['truong'] }}</p></div>
                </div>
                <div class="profile_field_row_medium">
                    <div class="profile_field_row_left"><strong>Trình độ:</strong></div>
                    <div class="profile_field_row_right"><p>{{ $edu['trinhdo'] }}</p></div>
                </div>
                <div class="profile_field_row_medium">
                    <div class="profile_field_row_left"><strong>Chuyên ngành:</strong></div>
                    <div class="profile_field_row_right"><p>{{ $edu['chuyennganh'] }}</p></div>
                </div>
                <div class="profile_field_row_medium">
                    <div class="profile_field_row_left"><strong>Xếp loại:</strong></div>
                    <div class="profile_field_row_right"><p>{{ $edu['xeploai'] }}</p></div>
                </div>
                <div class="profile_field_row_medium">
                    <div class="profile_field_row_left"><strong>Từ năm:</strong></div>
                    <div class="profile_field_row_right"><p>{{ $edu['nambatdau'] }}</p></div>
                </div>
                <div class="profile_field_row_medium">
                    <div class="profile_field_row_left"><strong>Đến năm:</strong></div>
                    <div class="profile_field_row_right"><p>{{ $edu['namketthuc'] }}</p></div>
                </div>
            </div>
        </div>
        <div class="profile_field">
            <h3>KỸ NĂNG</h3>
            <span class="profile_line"></span>
            @if ($ttkn == 0)
                <div class="profile_row">
                    <div class="profile_field_row_medium">
                        <div class="profile_field_row_left"><strong>Tin học:</strong></div>
                        <div class="profile_field_row_right"><p>{{ $skill['tinhoc'] }}</p></div>
                    </div>
                    <div class="profile_field_row_medium">
                        <div class="profile_field_row_left"><strong>Ngoại ngữ:</strong></div>
                        <div class="profile_field_row_right"><p>{{ $skill['ngoaingu'] }}</p></div>
                    </div>
                    <div class="profile_field_row_large">
                        <div class="profile_field_row_left"><strong>Chứng chỉ và kỹ năng khác:</strong></div>
                        <div class="profile_field_row_right"><p>{{ $skill['skillkhac'] }}</p></div>
                    </div>
                </div>
            @else
            <div class="profile_field_row_undefine">
                <p>Chưa có thông tin.</p>
            </div>
            @endif
        </div>
        <div class="profile_field">
            <h3>KINH NGHIỆM LÀM VIỆC</h3>
            <span class="profile_line"></span>
            @if ($ttexp == 0)
                <div class="profile_row">
                    <div class="profile_field_row_large">
                        <div class="profile_field_row_left"><strong>Công việc hiện tại:</strong></div>
                        <div class="profile_field_row_right"><p>{{ $exp['congviec'] }}</p></div>
                    </div>
                    <div class="profile_field_row_large">
                        <div class="profile_field_row_left"><strong>Tên công ty:</strong></div>
                        <div class="profile_field_row_right"><p>{{ $exp['tencty'] }}</p></div>
                    </div>
                    <div class="profile_field_row_large">
                        <div class="profile_field_row_left"><strong>Vị trí, chức vụ:</strong></div>
                        <div class="profile_field_row_right"><p>{{ $exp['vitri'] }}</p></div>
                    </div>
                    <div class="profile_field_row_large">
                        <div class="profile_field_row_left"><strong>Nhiệm vụ chính:</strong></div>
                        <div class="profile_field_row_right"><p>{{ $exp['nvchinh'] }}</p></div>
                    </div>
                    <div class="profile_field_row_medium">
                        <div class="profile_field_row_left"><strong>Thời gian làm việc:</strong></div>
                        <div class="profile_field_row_right"><p>{{ $exp['nambatdau'] }} - {{ $exp['namketthuc'] }}</p></div>
                    </div>
                    <div class="profile_field_row_medium">
                        <div class="profile_field_row_left"><strong>Mức lương hiện tại:</strong></div>
                        <div class="profile_field_row_right"><p>{{ $exp['luonghientai'] }}</p></div>
                    </div>
                    <div class="profile_field_row_medium">
                        <div class="profile_field_row_left"><strong>Mức lương mong muốn:</strong></div>
                        <div class="profile_field_row_right"><p>{{ $exp['luongmongmuon'] }}</p></div>
                    </div>
                </div>
            @else
            <div class="profile_field_row_undefine">
                <p>Chưa có thông tin.</p>
            </div>
            @endif
        </div>
        <div class="profile_field">
            <h3>NGƯỜI THÂN LÀM VIỆC TẠI DHG PHARMA</h3>
            <span class="profile_line"></span>
            @if ($ttnt == 0)
                @foreach ($parent as $nguoi)
                    <div class="profile_row">
                        <div class="profile_field_row_large">
                            <div class="profile_field_row_left"><strong>Họ tên:</strong></div>
                            <div class="profile_field_row_right"><p>{{ $nguoi['hoten_nguoithan'] }}</p></div>
                        </div>
                        <div class="profile_field_row_large">
                            <div class="profile_field_row_left"><strong>Chức vụ, nơi làm việc:</strong></div>
                            <div class="profile_field_row_right"><p>{{ $nguoi['noilamviec_nguoithan'] }}</p></div>
                        </div>
                        <div class="profile_field_row_medium">
                            <div class="profile_field_row_left"><strong>Mối quan hệ:</strong></div>
                            <div class="profile_field_row_right"><p>{{ $nguoi['mqh_nguoithan'] }}</p></div>
                        </div>
                        <div class="profile_field_row_medium">
                            <div class="profile_field_row_left"><strong>Số điện thoại liên hệ:</strong></div>
                            <div class="profile_field_row_right"><p>{{ $nguoi['sdt_nguoithan'] }}</p></div>
                        </div>
                    </div>
                @endforeach
            @else
            <div class="profile_field_row_undefine">
                <p>Chưa có thông tin.</p>
            </div>
            @endif
        </div>
    </div>
@endsection
