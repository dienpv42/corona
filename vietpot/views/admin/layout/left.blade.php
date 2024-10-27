<header class="main-nav">
    <div class="sidebar-user text-center"><a class="setting-primary" href="{{route('dashboard-profile')}}"><i data-feather="settings"></i></a>
    @if(\Auth::user()->avatar!='')
    <img class="img-90 rounded-circle" src="{{\Auth::user()->avatar}}" alt="">
    @else
    <img class="img-90 rounded-circle" src="{{asset('assets/admin')}}/assets/images/dashboard/1.png" alt="">
    @endif
    <a href="{{route('dashboard-profile')}}">
        <h6 class="mt-3 f-14 f-w-600">{{\Auth::user()->name}}</h6></a>
    </div>
    <nav>
    <div class="main-navbar">
        <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
        <div id="mainnav">           
        <ul class="nav-menu custom-scrollbar">
		
			<li class="sidebar-main-title">
            <div>
                <h6>Nội dung             </h6>
            </div>
            </li>
            <li><a class="nav-link menu-title link-nav" href="{{asset('dashboard')}}"><i data-feather="home"></i><span>Trang chủ</span></a></li>            
            <li><a class="nav-link menu-title link-nav" href="{{route('view-page')}}"><i data-feather="edit"></i><span>Trang tĩnh</span></a></li>				
            <li><a class="nav-link menu-title link-nav" href="{{route('view-menu')}}"><i data-feather="align-justify"></i><span>Menu</span></a></li>	
            <li><a class="nav-link menu-title link-nav" href="{{route('view-news')}}"><i data-feather="edit"></i><span>Tin tức</span></a></li>
            <li><a class="nav-link menu-title link-nav" href="{{route('view-news-cate')}}"><i data-feather="edit-2"></i><span>Nhóm tin tức</span></a></li>
			
            <li class="sidebar-main-title">
            <div>
                <h6>Tài khoản             </h6>
            </div>
            </li>
            <li><a class="nav-link menu-title link-nav" href="{{route('view-user')}}"><i data-feather="edit"></i><span>Khách hàng</span></a></li>				
            <li><a class="nav-link menu-title link-nav" href="{{route('view-user')}}"><i data-feather="align-justify"></i><span>Đối tác</span></a></li>	
			
			
            <li class="sidebar-main-title">
            <div>
                <h6>Cấu hình            </h6>
            </div>
            </li>
            <li><a class="nav-link menu-title link-nav" href="{{route('dashboard-setting','general')}}"><i data-feather="box"></i><span>Thông tin chung</span></a></li>
            <li><a class="nav-link menu-title link-nav" href="{{route('dashboard-setting','social')}}"><i data-feather="package"></i><span>Mạng xã hội</span></a></li>
            <li><a class="nav-link menu-title link-nav" href="{{route('dashboard-setting','website')}}"><i data-feather="layout"></i><span>Giao diện</span></a></li>
            <li><a class="nav-link menu-title link-nav" href="{{route('dashboard-setting','image')}}"><i data-feather="layout"></i><span>Ảnh/Logo</span></a></li>
			
			
        </ul>
        </div>
        <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
    </div>
    </nav>
</header>
