@extends('layouts.user_layout')

@section('content')
    <div id="account_new_post_page" class="account_page account_page_show">
        <h3>TIN TUYỂN DỤNG MỚI</h3>
        <div id="post_list" class="post_list">
            <div id="post" class="post">
                <div id="newpost_title">
                    <div class="thanhtieude">
                        <div class="id"><p class="content">STT</p></div>
                        <div class="tieudetin"><p class="content">Tiêu đề</p></div>
                        <div class="noilamviec"><p class="content">Nơi làm việc</p></div>
                        <div class="ngayhethan"><p class="content">Hạn nộp hồ sơ</p></div>
                        <div class="button"><p class="content">Nộp hồ sơ</p></div>
                    </div>
                </div>
                <div id="posts" class="posts"></div>
            </div>
            <div id="account_pagination" class="pagination"></div>
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
