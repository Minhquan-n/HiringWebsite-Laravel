@extends('layouts.admin_layout')

@section('content')
    <span id="tintuyendung_background" onclick="close_post_form()"></span>
    <div id="tintuyendung_form">
        <div id="post_form">
            <div id="title_input" class="input">
                <span class="title_name">
                    Tiêu đề tuyển dụng:
                </span>
                <span class="class_input"><input type="text" name="tieude" autocomplete="off" id="post_title"></span>
                <span class="warning" id="title_warning"></span>
            </div>
            <div id="deadline_input" class="input">
                <span class="title_name">
                    Hạn nộp hồ sơ:
                </span>
                <span class="class_input"><input type="date" name="hannophoso" id="post_deadline"></span>
                <span class="warning" id="deadline_warning"></span>
            </div>
            <div id="position_input" class="input">
                <span class="title_name">
                    Vị trí tuyển dụng:
                </span>
                <span class="class_input"><input type="text" name="vitrituyen" autocomplete="off" id="post_position"></span>
                <span class="warning" id="position_warning"></span>
            </div>
            <div id="agency_input" class="input">
                <span class="title_name">
                    Nơi làm việc:
                </span>
                <span class="class_input">
                    <select name="noilamviec" id="post_agency">
                        @foreach ($chinhanh as $noi)
                            <option value="{{ $noi['id_chinhanh'] }}">{{ $noi['tenchinhanh'] }}</option>
                        @endforeach
                    </select>
                </span>
            </div>
            <div id="department_input" class="input">
                <span class="title_name">
                    Phòng ban:
                </span>
                <span class="class_input">
                    <select type="text" name="phongban" id="post_department">
                        @foreach ($phongban as $phong)
                            <option value="{{ $phong['id_phongban'] }}">{{ $phong['tenphongban'] }}</option>
                        @endforeach
                    </select>
                </span>
            </div>
            <div id="salary_input" class="input">
                <span class="title_name">
                    Mức lương:
                </span>
                <span class="class_input">
                    <select type="text" name="mucluong" id="post_salary">
                        <option value="Lương thỏa thuận">Lương thỏa thuận</option>
                        <option value="5.000.000 - 8.000.000 VND">5.000.000 - 8.000.000 VND</option>
                        <option value="6.000.000 - 10.000.000 VND">6.000.000 - 10.000.000 VND</option>
                        <option value="10.000.000 - 12.000.000 VND">10.000.000 - 12.000.000 VND</option>
                    </select>
                </span>
            </div>
            <div id="quantity_input" class="input">
                <span class="title_name">
                    Số lượng:
                </span>
                <span class="class_input"><input type="number" name="soluong" id="post_quantity"></span>
                <span class="warning" id="quantity_warning"></span>
            </div>
            <div id="age_input" class="input">
                <span class="title_name">
                    Độ tuổi:
                </span>
                <span class="class_input"><input type="text" name="dotuoi" autocomplete="off" id="post_age"></span>
                <span class="warning" id="age_warning"></span>
            </div>
            <div id="sex_input" class="input">
                <span class="title_name">
                    Giới tính:
                </span>
                <span class="class_input">
                    <select type="text" name="gioitinh" id="post_sex">
                        <option value="Nam">Nam</option>
                        <option value="Nữ">Nữ</option>
                        <option value="Nam/Nữ">Nam/Nữ</option>
                    </select>
                </span>
            </div>
            <div id="description_input" class="input">
                <span class="title_name">
                    Mô tả công việc:
                </span>
                <span class="class_input"><textarea name="chitietcv" cols="100" rows="10" id="post_description"></textarea></span>
                <span class="warning" id="descripstion_warning"></span>
            </div>
            <div id="workrequest_input" class="input">
                <span class="title_name">
                    Yêu cầu công việc:
                </span>
                <span class="class_input"><textarea name="yeucaucv" cols="100" rows="10" id="post_workrequest"></textarea></span>
                <span class="warning" id="workrequest_warning"></span>
            </div>
            <div id="benefit_input" class="input">
                <span class="title_name">
                    Quyền lợi:
                </span>
                <span class="class_input"><textarea name="quyenloi" cols="100" rows="10" id="post_benefit"></textarea></span>
                <span class="warning" id="benefit_warning"></span>
            </div>
            <div id="submit_button">
                <button id="xoatatca" type="reset" onclick="reset_form()">Xóa tất cả</button>
                <button id="post_submit" type="submit"></button>
            </div>
        </div>
    </div>
    <div id="post_search" class="admin_search">
        <input type="text" id="post_search_input" class="admin_search_input" placeholder="Tìm kiếm">
        <button onclick="click_to_search()">Tìm kiếm</button>
    </div>
    <div id="post_status"></div>
    <div id="post_list" class="post_list">
        <div id="post" class="post">
            <div class="thanhtieude">
                <div class="id"><p class="content">STT</p></div>
                <div class="tieudetin"><p class="content">Tiêu đề</p></div>
                <div class="noilamviec"><p class="content">Nơi làm việc</p></div>
                <div class="ngayhethan"><p class="content">Hạn nộp hồ sơ</p></div>
                <div class="button"><button type="submit" onclick="open_post_form()" id="add_post_button" class="add_button">
                    <i class="fa-solid fa-plus"></i></button>
                </div>
            </div>
            <div id="posts" class="posts"></div>
        </div>
        <div id="account_pagination" class="pagination"></div>
    </div>

    <script src="{{ asset('js/admin/danhmuc/tintuyendung/tintuyendung.js') }}"></script>
@endsection
