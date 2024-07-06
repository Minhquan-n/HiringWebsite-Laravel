@extends('layouts.client_layout')

@section('content')
<div id="search_place">
    <form action="tuyendung">
        <span class="position_search"><input type="text" placeholder="Vị trí, chuyên ngành" id="position_search_input"></span>
        <span class="department_search">
            <select name="timkiem_phongban" id="department_search_select">
                <option value="0">Tất cả - Phòng ban</option>
                @foreach ($department as $phong)
                    <option value="{{ $phong['id_phongban'] }}">{{ $phong['tenphongban'] }}</option>
                @endforeach
            </select>
        </span>
        <span class="agency_search">
            <select name="timkiem_chinhanh" id="agency_search_select">
                <option value="0">Tất cả - Chi nhánh</option>
                @foreach ($agency as $chinhanh)
                    <option value="{{ $chinhanh['id_chinhanh'] }}">{{ $chinhanh['tenchinhanh'] }}</option>
                @endforeach
            </select>
        </span>
        <button id="search_button">Tìm kiếm</button>
    </form>
</div>
<h2>Cơ hội nghề nghiệp tại Dược Hậu Giang</h3>
<div id="posts_place">
    <div id="page" class="page"></div>
    <div id="pagination" class="pagination"></div>
</div>
@endsection
