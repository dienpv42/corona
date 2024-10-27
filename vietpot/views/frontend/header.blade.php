<header class="header">
    <div class="container-main">
        <div class="wrapper d-flex flex-row align-items-center justify-content-between">
            <div class="wrap_left d-flex flex-row align-items-center">
                <a href="javascript:void(0)" class="btn-menu d-none">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.5 5H17.5M2.5 10H17.5M2.5 15H17.5" stroke="#706F6F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
                <a href="{{asset('')}}" class="logo">
                    <img src="{{asset('assets/frontend')}}/assets/images/png/logo.png" alt="">
                </a>
            </div>
            <div class="wrap_menu">
                <ul class="nav">
                    <li class="nav-item">
                        <a href="about.html" class="nav-link">
                            Vietpot
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="customer.html" class="nav-link">
                            Khách hàng
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="partner.html" class="nav-link">
                            Đối tác
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="cooperate.html" class="nav-link">
                            Hợp tác
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="data_admin.html" class="nav-link active">
                            Dữ liệu
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            Liên hệ
                        </a>
                    </li>
                </ul>
            </div>
            <div class="wrap_right d-flex flex-row align-items-center">
				@if(\Auth::check())
                <a href="{{route('default-logout')}}" class="btn">
                    Đăng xuất
                </a>
				@else
				<a href="{{route('default-login')}}" class="btn">
                    Đăng nhập
                </a>	
				@endif
                <div class="w_lang">
                    <a href="javascript:void(0);" class="btn_change_lang dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{asset('assets/frontend')}}/assets/images/png/flag_vn.png" alt="" class="flag">
                        <svg class="arrow" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <g clip-path="url(#clip0_8003_52)">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M12.7064 15.7071C12.5188 15.8946 12.2645 15.9999 11.9994 15.9999C11.7342 15.9999 11.4799 15.8946 11.2924 15.7071L5.63537 10.0501C5.53986 9.95785 5.46367 9.84751 5.41126 9.7255C5.35886 9.6035 5.33127 9.47228 5.33012 9.3395C5.32896 9.20672 5.35426 9.07504 5.40454 8.95215C5.45483 8.82925 5.52908 8.7176 5.62297 8.6237C5.71686 8.52981 5.82852 8.45556 5.95141 8.40528C6.07431 8.355 6.20599 8.32969 6.33877 8.33085C6.47155 8.332 6.60277 8.35959 6.72477 8.412C6.84677 8.46441 6.95712 8.54059 7.04937 8.6361L11.9994 13.5861L16.9494 8.6361C17.138 8.45394 17.3906 8.35315 17.6528 8.35542C17.915 8.3577 18.1658 8.46287 18.3512 8.64828C18.5366 8.83369 18.6418 9.0845 18.644 9.3467C18.6463 9.60889 18.5455 9.8615 18.3634 10.0501L12.7064 15.7071Z" fill="#989B9F"/>
                            </g>
                            <defs>
                                <clipPath id="clip0_8003_52">
                                    <rect width="24" height="24" fill="white" transform="translate(-0.000976562)"/>
                                </clipPath>
                            </defs>
                        </svg>
                    </a>
                    <ul class="dropdown-menu" style="">
                        <li>
                            <a class="dropdown-item" href="#">
                                <img src="{{asset('assets/frontend')}}/assets/images/png/flag_vn.png" alt="" class="flag">
                                <span>Tiếng Việt</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>