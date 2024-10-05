<!-- Page Header Start-->
<div class="page-main-header">
    <div class="main-header-right row m-0">
        <div class="main-header-left">
        <div class="logo-wrapper"><a href="{{asset('dashboard')}}"><img class="img-fluid" src="{{asset('assets/admin')}}/assets/images/logo/logo.png" alt=""></a></div>
        <div class="dark-logo-wrapper"><a href="{{asset('dashboard')}}"><img class="img-fluid" src="{{asset('assets/admin')}}/assets/images/logo/dark-logo.png" alt=""></a></div>
        <div class="toggle-sidebar"><i class="status_toggle middle" data-feather="align-center" id="sidebar-toggle"></i></div>
        </div>
        <div class="left-menu-header col">
        <ul>
          
        </ul>
        </div>
        <div class="nav-right col pull-right right-menu p-0">
        <ul class="nav-menus">
            <li><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i data-feather="maximize"></i></a></li>
           
            <li class="onhover-dropdown p-0">
            <button class="btn btn-primary-light" type="button"><a href="{{route('dashboard-logout')}}"><i data-feather="log-out"></i>Đăng xuất</a></button>
            </li>
        </ul>
        </div>
        <div class="d-lg-none mobile-toggle pull-right w-auto"><i data-feather="more-horizontal"></i></div>
    </div>
    </div>
    <!-- Page Header Ends                              -->