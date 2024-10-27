@extends("admin.hometemplate")


@section('title', 'Admin & Dashboard')
@section('desc', 'Admin & Dashboard')
@section('keyword', 'Admin & Dashboard')

@section("css")
<link href="{{asset('assets/frontend')}}/assets/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{asset('assets/frontend')}}/assets/css/plugin-collection.css">
<link rel="stylesheet" href="{{asset('assets/frontend')}}/assets/css/icofont.min.css">
<link rel="stylesheet" href="{{asset('assets/frontend')}}/assets/css/swiper.min.css">
<link rel="stylesheet" href="{{asset('assets/frontend')}}/assets/css/aos.css">
<link rel="stylesheet" href="{{asset('assets/frontend')}}/assets/css/app.css">
@endsection
@section("js")
<script src="{{asset('assets/frontend')}}/assets/js/jquery-main.js"></script>
<script src="{{asset('assets/frontend')}}/assets/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('assets/frontend')}}/assets/js/jquery-migrate.js"></script>
<script src="{{asset('assets/frontend')}}/assets/js/jquery-ui.min.js"></script>
<script src="{{asset('assets/frontend')}}/assets/js/plugincollection.js"></script>
<script src="{{asset('assets/frontend')}}/assets/js/app.js"></script>

@endsection

@section("content")
@include('admin.header_bottom')
    <section class="section_admin">
        <div class="container-main">
            <div class="section_title d-flex flex-row align-items-center justify-content-between">
                <div class="title">
                    <h2>
                        Admin
                    </h2>
                </div>
                <a href="#" class="text_link">Lịch sử đăng nhập</a>
            </div>
            <div class="section_content">
                <div class="wrap_content">
                    <div class="wrap_list_link_lb">
                        <ul class="list_link_lb">
                            <li class="list_link_item list_link_item_50">
                                <a href="#" class="lb-xsmall lb-link">
                                    Chỉnh sửa website
                                </a>
                            </li>
                            <li class="list_link_item list_link_item_50">
                                <a href="#" class="lb-xsmall lb-link">
                                    Danh sách tài khoản
                                </a>
                            </li>
							<li class="list_link_item list_link_item_50">
                                <a href="{{route('view-admin')}}" class="lb-xsmall lb-link">
                                   Tạo tài khoản nội bộ
								   <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
									<path d="M9.99935 18.4584C5.33383 18.4584 1.54102 14.6656 1.54102 10.0001C1.54102 5.33456 5.33383 1.54175 9.99935 1.54175C14.6649 1.54175 18.4577 5.33456 18.4577 10.0001C18.4577 14.6656 14.6649 18.4584 9.99935 18.4584ZM9.99935 1.79175C5.47321 1.79175 1.79102 5.47394 1.79102 10.0001C1.79102 14.5262 5.47321 18.2084 9.99935 18.2084C14.5255 18.2084 18.2077 14.5262 18.2077 10.0001C18.2077 5.47394 14.5255 1.79175 9.99935 1.79175Z" fill="#6D727B" stroke="#6D727B"/>
									<path d="M13.3327 10.125H6.66602C6.63587 10.125 6.60459 10.1127 6.57894 10.0871C6.5533 10.0614 6.54102 10.0301 6.54102 10C6.54102 9.96985 6.5533 9.93857 6.57894 9.91293C6.60459 9.88728 6.63587 9.875 6.66602 9.875H13.3327C13.3628 9.875 13.3941 9.88728 13.4198 9.91293C13.4454 9.93857 13.4577 9.96985 13.4577 10C13.4577 10.0301 13.4454 10.0614 13.4198 10.0871C13.3941 10.1127 13.3628 10.125 13.3327 10.125Z" fill="#6D727B" stroke="#6D727B"/>
									<path d="M10 13.9584C9.65833 13.9584 9.375 13.6751 9.375 13.3334V6.66675C9.375 6.32508 9.65833 6.04175 10 6.04175C10.3417 6.04175 10.625 6.32508 10.625 6.66675V13.3334C10.625 13.6751 10.3417 13.9584 10 13.9584Z" fill="#6D727B"/>
								</svg>
                                </a>
								
                            </li>
							<li class="list_link_item list_link_item_50">
                                <a href="{{route('dashboard-map')}}" class="lb-xsmall lb-link">
                                   Bản đồ khách hàng
                                </a>
                            </li>
                        </ul>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>

@endsection