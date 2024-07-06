@extends('layouts.admin_layout')

@section('content')
    <div id="deparment_search" class="admin_search">
        <input type="text" id="deparment_search_input" class="admin_search_input" placeholder="Tìm kiếm">
        <button onclick="click_to_search()">Tìm kiếm</button>
    </div>
    <div id="agency_status"></div>
    <div id="agency_list">
        <div class="list">
            <div class="tieude">
                <div class="id"><p class="content">ID</p></div>
                <div class="ten"><p class="content">Tên chi nhánh</p></div>
                <div class="button">
                    <button onclick="show_agency_form({{ count($chinhanh)+1 }})" id="add_agency_button">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                    <button onclick="hide_agency_form()"
                            id="close_add_agency_button">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
            </div>
            <div id="department">
                <div id="list">
                    @for ($i = 0; $i < count($chinhanh); $i++)
                        <div id="{{ $chinhanh[$i]['id_chinhanh'] }}" class="noidung">
                            <div class="id"><p class="content">{{ $i + 1 }}</p></div>
                            <div class="ten"><p class="content">{{ $chinhanh[$i]['tenchinhanh'] }}</p></div>
                            <div class="button">
                                <button onclick="show_agency_update('{{ $chinhanh[$i]['id_chinhanh'] }}', '{{ $chinhanh[$i]['tenchinhanh'] }}')" class="open_update_button" id="update_agency_button{{ $chinhanh[$i]['id_chinhanh'] }}">
                                    <i class="fa-solid fa-pen"></i>
                                </button>
                                <button onclick="hide_agency_update()" class="close_update_button" id="close_update_agency_button{{ $chinhanh[$i]['id_chinhanh'] }}">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
            <div class="agency_form"
                    id="agency_form">
                <div class="id"><input type="text" name="id" id="form_id"></div>
                <div class="ten"><input type="text" name="tenchinhanh" id="form_ten"></div>
                <div class="button"><button id="form_button"></button></div>
            </div>
        </div>
    </div>
@endsection
