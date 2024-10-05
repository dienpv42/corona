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
				<h3>Trang chủ</h3>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{route('dashboard-index')}}">Dashboard</a></li>
					<li class="breadcrumb-item active">Trang chủ</li>
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
											<label class="form-label">Tiêu đề</label>	
											<?php
											$value_lang = '';
											foreach ($data as $key => $value) {
												if ($key == 'setting_home1_section8_' . $item->id) {
													$value_lang = $value;
												}
											}
											?>
											{{Form::text('setting_home1_section8_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
										</div>
									</div>
									<div class="col-12 col-lg-6">
										<div class="mb-3">
											<label class="form-label">Số tiền vay</label>	
											<?php
											$value_lang = '';
											foreach ($data as $key => $value) {
												if ($key == 'setting_home2_section8_' . $item->id) {
													$value_lang = $value;
												}
											}
											?>
											{{Form::text('setting_home2_section8_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
										</div>
									</div>		
									<div class="col-12 col-lg-6">
										<div class="mb-3">
											<label class="form-label">Số tiền</label>	
											<?php
											$value_lang = '';
											foreach ($data as $key => $value) {
												if ($key == 'setting_home4_section8_' . $item->id) {
													$value_lang = $value;
												}
											}
											?>
											{{Form::text('setting_home4_section8_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
										</div>
									</div>	
									<div class="col-12 col-lg-6">
										<div class="mb-3">
											<label class="form-label">Thành viên</label>	
											<?php
											$value_lang = '';
											foreach ($data as $key => $value) {
												if ($key == 'setting_home5_section8_' . $item->id) {
													$value_lang = $value;
												}
											}
											?>
											{{Form::text('setting_home5_section8_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
										</div>
									</div>		
									<div class="col-12 col-lg-6">
										<div class="mb-3">
											<label class="form-label">Số thành viên</label>	
											<?php
											$value_lang = '';
											foreach ($data as $key => $value) {
												if ($key == 'setting_home6_section8_' . $item->id) {
													$value_lang = $value;
												}
											}
											?>
											{{Form::text('setting_home6_section8_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
										</div>
									</div>	
									<div class="col-12 col-lg-12">
										<div class="mb-3">
											<label class="form-label">Đánh giá</label>	
											<?php
											$value_lang = '';
											foreach ($data as $key => $value) {
												if ($key == 'setting_home7_section8_' . $item->id) {
													$value_lang = $value;
												}
											}
											?>
											{{Form::text('setting_home7_section8_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
										</div>
									</div>	
									<div class="col-12 col-lg-12">
										<div class="mb-3">
											<label class="form-label">Ảnh đánh giá</label>	
											<?php
											$value_lang = '';
											foreach ($data as $key => $value) {
												if ($key == 'setting_home3_section8_' . $item->id) {
													$value_lang = $value;
												}
											}
											?>		
											<input style="display:none" class="form-control file_upload_server_custom" id="label_setting_home3_section8_{{$item->id}}" type="file" data-id="setting_home3_section8_{{$item->id}}" data-url="{{route('dashboard-upload-one')}}" accept="image/*">
											<div class="input-group"><label style="margin-bottom:0px;" class="input-group-text" for="label_setting_home3_section8_{{$item->id}}">Upload file</label>
												{{Form::text('setting_home3_section8_'.$item->id,$value_lang,array('class'=>'form-control input-group-air ','id'=>'setting_home3_section8_'.$item->id))}}
											</div>
										</div>
									</div>
									<div class="col-12 col-lg-6">
										<div class="mb-3">
											<label class="form-label">Xem thêm</label>	
											<?php
											$value_lang = '';
											foreach ($data as $key => $value) {
												if ($key == 'setting_home8_section8_' . $item->id) {
													$value_lang = $value;
												}
											}
											?>
											{{Form::text('setting_home8_section8_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
										</div>
									</div>	
									<div class="col-12 col-lg-6">
										<div class="mb-3">
											<label class="form-label">Link xem thêm</label>	
											<?php
											$value_lang = '';
											foreach ($data as $key => $value) {
												if ($key == 'setting_home9_section8_' . $item->id) {
													$value_lang = $value;
												}
											}
											?>
											{{Form::text('setting_home9_section8_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
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