@extends("admin.layout.hometemplate")


@section('title', 'Admin & Dashboard')
@section('desc', 'Admin & Dashboard')
@section('keyword', 'Admin & Dashboard')


@section("css")
<link rel="stylesheet" type="text/css" href="{{asset('assets/admin')}}/assets/css/fontawesome.css">
<!-- ico-font-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/admin')}}/assets/css/icofont.css">
<!-- Themify icon-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/admin')}}/assets/css/themify.css">
<!-- Flag icon-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/admin')}}/assets/css/flag-icon.css">
<!-- Feather icon-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/admin')}}/assets/css/feather-icon.css">
<!-- Plugins css start-->
<!-- Plugins css Ends-->
<!-- Bootstrap css-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/admin')}}/assets/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="{{asset('assets/admin')}}/assets/css/date-picker.css">
<!-- App css-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/admin')}}/assets/css/style.css">
<link id="color" rel="stylesheet" href="{{asset('assets/admin')}}/assets/css/color-1.css" media="screen">
<!-- Responsive css-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/admin')}}/assets/css/responsive.css">
@endsection
@section("js")
<script src="{{asset('assets/admin')}}/assets/js/jquery-3.5.1.min.js"></script>
<!-- feather icon js-->
<script src="{{asset('assets/admin')}}/assets/js/icons/feather-icon/feather.min.js"></script>
<script src="{{asset('assets/admin')}}/assets/js/icons/feather-icon/feather-icon.js"></script>
<!-- Sidebar jquery-->
<script src="{{asset('assets/admin')}}/assets/js/sidebar-menu.js"></script>
<script src="{{asset('assets/admin')}}/assets/js/config.js"></script>
<!-- Bootstrap js-->
<script src="{{asset('assets/admin')}}/assets/js/bootstrap/popper.min.js"></script>
<script src="{{asset('assets/admin')}}/assets/js/bootstrap/bootstrap.min.js"></script>
<script src="{{asset('assets/admin')}}/assets/js/datepicker/date-picker/datepicker.js"></script>
<script src="{{asset('assets/admin')}}/assets/js/datepicker/date-picker/datepicker.en.js"></script>
<script src="{{asset('assets/admin')}}/assets/js/script.js"></script>
<script>

</script>
@endsection

@section("content")
<div class="container-fluid">
	<div class="page-header">
		<div class="row">
			<div class="col-sm-6">
				<h3>Giao diện</h3>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{route('dashboard-index')}}">Dashboard</a></li>
					<li class="breadcrumb-item active">Giao diện</li>
				</ol>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid">
	<form class="form-wizard" method="post" action="{{route('post-dashboard-setting')}}" enctype="multipart/form-data">
		@csrf
		@include('admin.alert')
		<ul class="nav nav-tabs" role="tablist">
			<?php
			foreach ($list_lang as $item1) {
				if ($item1->id == $setting->website_lang) {
			?>
			<li class="nav-item">
				<a class="nav-link active" id="m_tabs_{{$item1->id}}" data-bs-toggle="tab" href="#m1_tabs_{{$item1->id}}" role="tab" aria-controls="m_tabs_{{$item1->id}}" aria-selected="true">{{$item1->name}}</a>
			</li>
			<?php }} ?>
			<li class="nav-item dropdown"><a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Ngôn ngữ khác</a>
				<div class="dropdown-menu">
					<?php
					foreach ($list_lang as $item2) {
						if ($item2->id != $setting->website_lang) {
					?>
					<a class="dropdown-item" id="m_tabs_{{$item2->id}}" data-bs-toggle="tab" href="#m1_tabs_{{$item2->id}}" role="tab" aria-controls="m_tabs_{{$item2->id}}" aria-selected="false">{{$item2->name}}</a>
					<?php }} ?>
					
				</div>
			</li>
		</ul>
		<div class="tab-content">
			<?php
			foreach ($list_lang as $item) {							 
			?>
			<div class="tab-pane fade @if($item->id == $setting->website_lang) show active @endif " id="m1_tabs_{{$item->id}}" role="tabpanel" aria-labelledby="m_tabs_{{$item->id}}">
				<div class="row">
					<div class="col-sm-12">
						<div class="card">
							<div class="card-header pb-0">
								<h5>{{$item->name}}</h5>
							</div>
							<div class="card-body">
								<div class="row">
									<div class="col-12 col-lg-12">
										<div class="mb-3">
											<label class="form-label">Menu</label>	
											<?php
											$arrmenu = array();
											foreach ($menu as $i_menu) {
												$arrmenu = $arrmenu + array($i_menu->id => $i_menu->name);
											}
											$check = '';
											foreach ($data as $key => $value) {
												if ($key == 'setting_website_menu_' . $item->id) {
													$check = $value;
												}
											}
											?>
											{{Form::select('setting_website_menu_'.$item->id, $arrmenu,$check,['class'=>'form-control'])}}						
										</div>
									</div>
									<div class="col-12 col-lg-12">
										<div class="mb-3">
											<label class="form-label">Menu footer</label>	
											<?php
											$arrmenu = array();
											foreach ($menu as $i_menu) {
												$arrmenu = $arrmenu + array($i_menu->id => $i_menu->name);
											}
											$check = '';
											foreach ($data as $key => $value) {
												if ($key == 'setting_website_fmenu1_' . $item->id) {
													$check = $value;
												}
											}
											?>
											{{Form::select('setting_website_fmenu1_'.$item->id, $arrmenu,$check,['class'=>'form-control'])}}						
										</div>
									</div>
									<div class="col-12 col-lg-12">
										<div class="mb-3">
											<label class="form-label">Menu footer</label>	
											<?php
											$arrmenu = array();
											foreach ($menu as $i_menu) {
												$arrmenu = $arrmenu + array($i_menu->id => $i_menu->name);
											}
											$check = '';
											foreach ($data as $key => $value) {
												if ($key == 'setting_website_fmenu2_' . $item->id) {
													$check = $value;
												}
											}
											?>
											{{Form::select('setting_website_fmenu2_'.$item->id, $arrmenu,$check,['class'=>'form-control'])}}						
										</div>
									</div>
									<div class="col-12 col-lg-12">
										<div class="mb-3">
											<label class="form-label">Menu footer</label>	
											<?php
											$arrmenu = array();
											foreach ($menu as $i_menu) {
												$arrmenu = $arrmenu + array($i_menu->id => $i_menu->name);
											}
											$check = '';
											foreach ($data as $key => $value) {
												if ($key == 'setting_website_fmenu3_' . $item->id) {
													$check = $value;
												}
											}
											?>
											{{Form::select('setting_website_fmenu3_'.$item->id, $arrmenu,$check,['class'=>'form-control'])}}						
										</div>
									</div>
									<div class="col-12 col-lg-12">
										<div class="mb-3">
											<label class="form-label">Menu top nav</label>	
											<?php
											$arrmenu = array();
											foreach ($menu as $i_menu) {
												$arrmenu = $arrmenu + array($i_menu->id => $i_menu->name);
											}
											$check = '';
											foreach ($data as $key => $value) {
												if ($key == 'setting_website_topmenu_' . $item->id) {
													$check = $value;
												}
											}
											?>
											{{Form::select('setting_website_topmenu_'.$item->id, $arrmenu,$check,['class'=>'form-control'])}}						
										</div>
									</div>
									<div class="col-12 col-lg-12">
										<div class="mb-3">
											<label class="form-label">Tiêu đề website</label>	
											<?php
											$value_lang = '';
											foreach ($data as $key => $value) {
												if ($key == 'setting_website_title_' . $item->id) {
													$value_lang = $value;
												}
											}
											?>
											{{Form::text('setting_website_title_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
										</div>
									</div>
									<div class="col-12 col-lg-12">
										<div class="mb-3">
											<label class="form-label">Mô tả website</label>
											<?php
											$value_lang = '';
											foreach ($data as $key => $value) {
												if ($key == 'setting_website_desc_' . $item->id) {
													$value_lang = $value;
												}
											}
											?>
											{{Form::text('setting_website_desc_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
										</div>
									</div>
									<div class="col-12 col-lg-12">
										<div class="mb-3">
											<label class="form-label">Keyword</label>	
											<?php
											$value_lang = '';
											foreach ($data as $key => $value) {
												if ($key == 'setting_website_keyword_' . $item->id) {
													$value_lang = $value;
												}
											}
											?>
											{{Form::text('setting_website_keyword_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
										</div>
									</div>
									<div class="col-12 col-lg-12">
										<div class="mb-3">
											<label class="form-label">Link ios store</label>	
											<?php
											$value_lang = '';
											foreach ($data as $key => $value) {
												if ($key == 'setting_website_ios_' . $item->id) {
													$value_lang = $value;
												}
											}
											?>
											{{Form::text('setting_website_ios_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
										</div>
									</div>
									<div class="col-12 col-lg-12">
										<div class="mb-3">
											<label class="form-label">Link android store</label>	
											<?php
											$value_lang = '';
											foreach ($data as $key => $value) {
												if ($key == 'setting_website_android_' . $item->id) {
													$value_lang = $value;
												}
											}
											?>
											{{Form::text('setting_website_android_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
										</div>
									</div>
									<div class="col-12 col-lg-12">
										<div class="mb-3">
											<label class="form-label">Tìm kiếm</label>	
											<?php
											$value_lang = '';
											foreach ($data as $key => $value) {
												if ($key == 'setting_website_search_' . $item->id) {
													$value_lang = $value;
												}
											}
											?>
											{{Form::text('setting_website_search_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
										</div>
									</div>
									<div class="col-12 col-lg-12">
										<div class="mb-3">
											<label class="form-label">Đăng ký</label>	
											<?php
											$value_lang = '';
											foreach ($data as $key => $value) {
												if ($key == 'setting_website_register_' . $item->id) {
													$value_lang = $value;
												}
											}
											?>
											{{Form::text('setting_website_register_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
										</div>
									</div>
									<div class="col-12 col-lg-12">
										<div class="mb-3">
											<label class="form-label">Link đăng ký</label>	
											<?php
											$value_lang = '';
											foreach ($data as $key => $value) {
												if ($key == 'setting_website_link_register_' . $item->id) {
													$value_lang = $value;
												}
											}
											?>
											{{Form::text('setting_website_link_register_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
										</div>
									</div>
									<div class="col-12 col-lg-12">
										<div class="mb-3">
											<label class="form-label">Đăng nhập</label>	
											<?php
											$value_lang = '';
											foreach ($data as $key => $value) {
												if ($key == 'setting_website_login_' . $item->id) {
													$value_lang = $value;
												}
											}
											?>
											{{Form::text('setting_website_login_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
										</div>
									</div>
									<div class="col-12 col-lg-12">
										<div class="mb-3">
											<label class="form-label">Link đăng nhập</label>	
											<?php
											$value_lang = '';
											foreach ($data as $key => $value) {
												if ($key == 'setting_website_link_login_' . $item->id) {
													$value_lang = $value;
												}
											}
											?>
											{{Form::text('setting_website_link_login_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
										</div>
									</div>
									<div class="col-12 col-lg-12">
										<div class="mb-3">
											<label class="form-label">Liên hệ</label>	
											<?php
											$value_lang = '';
											foreach ($data as $key => $value) {
												if ($key == 'setting_website_contact_' . $item->id) {
													$value_lang = $value;
												}
											}
											?>
											{{Form::text('setting_website_contact_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
										</div>
									</div>
									<div class="col-12 col-lg-12">
										<div class="mb-3">
											<label class="form-label">Công ty</label>	
											<?php
											$value_lang = '';
											foreach ($data as $key => $value) {
												if ($key == 'setting_website_lcompany_' . $item->id) {
													$value_lang = $value;
												}
											}
											?>
											{{Form::text('setting_website_lcompany_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
										</div>
									</div>
									<div class="col-12 col-lg-12">
										<div class="mb-3">
											<label class="form-label">Địa chỉ</label>	
											<?php
											$value_lang = '';
											foreach ($data as $key => $value) {
												if ($key == 'setting_website_laddress_' . $item->id) {
													$value_lang = $value;
												}
											}
											?>
											{{Form::text('setting_website_laddress_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
										</div>
									</div>
									<div class="col-12 col-lg-12">
										<div class="mb-3">
											<label class="form-label">Thông báo</label>	
											<?php
											$value_lang = '';
											foreach ($data as $key => $value) {
												if ($key == 'setting_website_notification_' . $item->id) {
													$value_lang = $value;
												}
											}
											?>
											{{Form::text('setting_website_notification_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
										</div>
									</div>
									<div class="col-12 col-lg-12">
										<div class="mb-3">
											<label class="form-label">Thông báo khác</label>	
											<?php
											$value_lang = '';
											foreach ($data as $key => $value) {
												if ($key == 'setting_website_notification1_' . $item->id) {
													$value_lang = $value;
												}
											}
											?>
											{{Form::text('setting_website_notification1_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
										</div>
									</div>
									<div class="col-12 col-lg-12">
										<div class="mb-3">
											<label class="form-label">Ảnh banner  thông báo</label>	
											<?php
											$value_lang = '';
											foreach ($data as $key => $value) {
												if ($key == 'setting_website_banner_notification_' . $item->id) {
													$value_lang = $value;
												}
											}
											?>		
											<input style="display:none" class="form-control file_upload_server_custom" id="label_setting_website_banner_notification_{{$item->id}}" type="file" data-id="setting_website_banner_notification_{{$item->id}}" data-url="{{route('dashboard-upload-one')}}" accept="image/*">
											<div class="input-group"><label style="margin-bottom:0px;" class="input-group-text" for="label_setting_website_banner_notification_{{$item->id}}">Upload file</label>
												{{Form::text('setting_website_banner_notification_'.$item->id,$value_lang,array('class'=>'form-control input-group-air ','id'=>'setting_website_banner_notification_'.$item->id))}}
											</div>
										</div>
									</div>
									<div class="col-12 col-lg-12">
										<div class="mb-3">
											<label class="form-label">Xem thêm</label>	
											<?php
											$value_lang = '';
											foreach ($data as $key => $value) {
												if ($key == 'setting_website_readmore_' . $item->id) {
													$value_lang = $value;
												}
											}
											?>
											{{Form::text('setting_website_readmore_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
										</div>
									</div>
									<div class="col-12 col-lg-12">
										<div class="mb-3">
											<label class="form-label">Trang chủ</label>	
											<?php
											$value_lang = '';
											foreach ($data as $key => $value) {
												if ($key == 'setting_website_home_' . $item->id) {
													$value_lang = $value;
												}
											}
											?>
											{{Form::text('setting_website_home_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-12 col-lg-12">
						<div class="mb-4">
							<button type="submit" class="btn btn-primary w-md">Lưu</button>
						</div>
					</div>
				</div>
			</div>
			<?php } ?>
		</div>
	</form>
</div>
@endsection