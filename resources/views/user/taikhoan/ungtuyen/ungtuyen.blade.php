@extends('layouts.user_layout')

@section('content')
    <div id="account_new_post_page" class="account_page account_page_show">
        <h3>DANH SÁCH ĐÃ ỨNG TUYỂN</h3>
        <div id="post_list" class="post_list">
            <div id="post" class="post">
                <div id="applied_title" class="posts">
                    <div class="thanhtieude">
                        <div class="id"><p class="content">STT</p></div>
                        <div class="vitriungtuyen"><p class="content">Vị trí ứng tuyển</p></div>
                        <div class="ngay"><p class="content">Ngày ứng tuyển</p></div>
                        <div class="trangthai"><p class="content">Trạng thái</p></div>
                        <div class="ngay"><p class="content">Ngày phỏng vấn</p></div>
                        <div class="thongbao"><p class="content">Thông báo từ DHG Pharma</p></div>
                    </div>
                </div>
                <div id="applied" class="posts"></div>
            </div>
            <div id="applied_pagination" class="pagination"></div>
        </div>
    </div>
    <div id="show_post">
        <div id="post_background" onclick="close_post_detail()"></div>
        <div id="post_details">
            <div id="post_detail_close"><i class="fa-solid fa-xmark" onclick="close_post_detail()"></i></div>
            <div id="post_detail_main"></div>
        </div>
    </div>
@endsection
