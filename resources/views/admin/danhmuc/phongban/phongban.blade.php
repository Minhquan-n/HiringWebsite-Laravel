@extends('layouts.admin_layout')

@section('content')
    <div id="deparment_search" class="admin_search">
        <input type="text" id="deparment_search_input" class="admin_search_input" placeholder="Tìm kiếm">
        <button onclick="click_to_search()">Tìm kiếm</button>
    </div>
    <div id="department_status"></div>
    <div id="department_list">
        <div class="list">
            <div class="tieude">
                <div class="id"><p class="content">ID</p></div>
                <div class="ten"><p class="content">Tên phòng ban</p></div>
                <div class="button">
                    <button onclick="show_department_form({{ count($phongban)+1 }})" id="add_department_button">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                    <button onclick="hide_department_form()"
                            id="close_add_department_button">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
            </div>
            <div id="department">
                <div id="list">
                    @foreach ($phongban as $phong)
                        <div id="{{ $phong['id_phongban'] }}" class="noidung">
                            <div class="id"><p class="content">{{ $phong['id_phongban'] }}</p></div>
                            <div class="ten"><p class="content">{{ $phong['tenphongban'] }}</p></div>
                            <div class="button">
                                <button onclick="show_department_update('{{ $phong['id_phongban'] }}', '{{ $phong['tenphongban'] }}')" class="open_update_button" id="update_department_button{{ $phong['id_phongban'] }}">
                                    <i class="fa-solid fa-pen"></i>
                                </button>
                                <button onclick="hide_department_update()" class="close_update_button" id="close_update_department_button{{ $phong['id_phongban'] }}">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="department_form"
                    id="department_form">
                <div class="id"><input type="text" name="id" id="form_id"></div>
                <div class="ten"><input type="text" name="tenphongban" id="form_ten"></div>
                <div class="button"><button id="form_button"></button></div>
            </div>
        </div>
    </div>
@endsection
