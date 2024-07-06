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
    <h3>Cơ hội nghề nghiệp tại Dược Hậu Giang</h3>
    <div id="post_place">
        <div class="home_posts">
            @if (count($post) <= 6)
            @foreach ($post as $home_post)
                <a class="home_post" id="hone_post_{{ $home_post['id'] }}" onclick="post({{ $home_post['id'] }})">
                    <h4 class="home_post_position">{{ $home_post['vitrituyen'] }}</h4>
                    <p class="home_post_agency"><i class="fa-solid fa-location-dot"></i> &nbsp;{{ $home_post['tenchinhanh'] }}</p>
                    <p class="home_post_date"><i class="fa-solid fa-clock"></i> &nbsp; {{ DateTime::createFromFormat("Y-m-d", $home_post['hannophoso'])->format("d-m-Y") }}</p>
                </a>
            @endforeach
        @else
            @for ($i = 0; $i < 6; $i++)
                <a class="home_post" id="hone_post_{{ $post[$i]['id'] }}" onclick="post({{ $post[$i]['id'] }})">
                    <h4 class="home_post_position">{{ $post[$i]['vitrituyen'] }}</h4>
                    <p class="home_post_agency"><i class="fa-solid fa-location-dot"></i> &nbsp;{{ $post[$i]['tenchinhanh'] }}</p>
                    <p class="home_post_date"><i class="fa-solid fa-clock"></i> &nbsp; {{ DateTime::createFromFormat("Y-m-d", $post[$i]['hannophoso'])->format("d-m-Y") }}</p>
                </a>
            @endfor
        @endif
        </div>
    </div>
    <div class="home_seemore"><a href="/tuyendung">Xem thêm</a></div>
    <h3>Giới thiệu về Dược Hậu Giang</h3>
    <div class="intro_content">
        <div class="intro_content_paragraph_col">
            <div class="intro_content_text paragraph_justify">
                <p>Bốn thập kỷ xây dựng, phát triển và không ngừng đổi mới, Công ty Cổ phần Dược Hậu Giang (DHG Pharma) đã nhanh chóng khẳng định được thương hiệu của mình, trở thành một trong những doanh nghiệp dẫn đầu trong nghành công nghiệp dược phẩm Việt Nam.<br>Trải qua hơn 40 năm hình thành và phát triển, DHG Pharma đã và đang thực hiện mục tiêu hàng đầu của công ty với mong muốn cung cấp những sản phẩm cùng dịch vụ chất lượng cao nhằm mang lại một cuộc sống khỏe đẹp hơn cho người tiêu dùng. Hiện nay, DHG Pharma sở hữu nhiều nhà máy được chứng nhận phù hợp với yêu cầu của WHO - GMP/GLP/GSP.</p>
                <div class="home_seemore"><a href="/gioithieu">>>> Biết thêm về chúng tôi!</a></div>
            </div>
            <div class="intro_content_img">
                <img src="{{ asset('storage/dhg1.jpg') }}" alt="">
                <label>Logo Công ty Cổ phần Dược Hậu Giang</label>
            </div>
        </div>
    </div>
@endsection
