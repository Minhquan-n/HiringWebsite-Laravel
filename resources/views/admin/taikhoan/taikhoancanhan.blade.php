@extends('layouts.admin_layout')

@section('content')
    <div id="left_side">
        <span class="avatar">
            <div class="avatar_img"><i class="fa-solid fa-circle-user"></i></div>
            <p>Trương Minh Quân</p>
        </span>
        <span class="line"></span>
        <a href="/taikhoan/{id}" class="{{ request()->is('taikhoan/{id}')? 'active' : '' }}">
            <div><i class="fa-solid fa-user"></i> &nbsp;</div>
            <p>Thông tin cá nhân</p>
        </a>
        <a href="/taikhoan/{id}" class="{{ request()->is('taikhoan/{id}')? 'active' : '' }}">
            <p>&nbsp;&nbsp;Thông tin tài khoản</p>
        </a>
        <span class="line"></span>
        <a href="/danhmuc/phongban" class="{{ request()->is('danhmuc/phongban*')? 'active' : '' }}">
            <p>&nbsp;&nbsp;Quản lý quyền truy cập</p>
        </a>
        <a href="/danhmuc/chinhanh" class="{{ request()->is('danhmuc/chinhanh*')? 'active' : '' }}">
            <p>&nbsp;&nbsp;Quản lý tài khoản</p>
        </a>
    </div>
    <div id="right_side">

    </div>
@endsection
