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
<link rel="stylesheet" type="text/css" href="{{asset('assets/admin')}}/assets/css/select2.css">
<link rel="stylesheet" type="text/css" href="{{asset('assets/admin')}}/assets/css/bootstrap.css">
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
<script src="{{asset('assets/admin')}}/assets/js/select2/select2.full.min.js"></script>
    <script src="{{asset('assets/admin')}}/assets/js/select2/select2-custom.js"></script>
<script src="{{asset('assets/admin')}}/assets/js/bootstrap/popper.min.js"></script>
<script src="{{asset('assets/admin')}}/assets/js/bootstrap/bootstrap.min.js"></script>
<script src="{{asset('assets/admin')}}/assets/js/datepicker/date-time-picker/moment.min.js"></script>
<script src="{{asset('assets/admin')}}/assets/js/datepicker/date-time-picker/tempusdominus-bootstrap-4.min.js"></script>
<script src="{{asset('assets/admin')}}/assets/js/datepicker/date-time-picker/datetimepicker.custom.js"></script>
<script src="{{asset('assets/admin')}}/assets/js/script.js"></script>
@endsection

@section("content")
<div class="container-fluid">
	<div class="page-header">
		<div class="row">
			<div class="col-sm-6">
				<h3>Tin tức</h3>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{route('dashboard-index')}}">Dashboard</a></li>
					<li class="breadcrumb-item"><a href="{{route('view-news')}}">Tin tức</a></li>
					<li class="breadcrumb-item active">Thêm</li>
				</ol>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid">
	<form class="form-wizard" method="post" action="{{route('post-add-news')}}" enctype="multipart/form-data">
		@csrf
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-body">
						@include('admin.alert')
						<div class="row">
							<div class="col-12 col-lg-4">
								<div class="mb-3">
									<label class="col-form-label pt-0">Ảnh  <img id="img_avatar" width="100px"/></label>	
									<input style="display:none" class="form-control file_upload_server_custom" id="label_avatar" type="file" data-id="avatar" data-img="img_avatar" data-url="{{route('dashboard-upload-one')}}" accept="image/*">
									<div class="input-group"><label style="margin-bottom:0px;" class="input-group-text" for="label_avatar">Upload file</label>
										{{Form::text('avatar','',array('class'=>'form-control input-group-air ','id'=>'avatar'))}}
									</div>
								</div>
							</div>
							<div class="col-12 col-lg-4">
								<div class="mb-3">
									<label class="col-form-label pt-0">Thời gian đăng</label>
									<div class="input-group date" id="dt-enab-disab-date" data-target-input="nearest">
										<input name="timepost" value="{{date('d/m/Y H:i:s',time())}}" class="form-control datetimepicker-input digits" type="text" data-target="#dt-enab-disab-date">
										<div class="input-group-text" data-target="#dt-enab-disab-date" data-toggle="datetimepicker"><i class="fa fa-calendar"></i></div>
									</div>
									
								</div>
							</div>			
							<div class="col-12 col-lg-4">
								<div class="mb-3">
									<label class="col-form-label pt-0">Danh mục</label>
									<select class="js-example-placeholder-multiple" name="cate_id">								
										@if(isset($category) && count($category)>0)
										@foreach($category as $item)
										<option value="{{$item->id}}">{{$item->name}}</option>
										@endforeach
										@endif
									</select>
									
								</div>
							</div>		
							
						</div>
						
					</div>
					<!--end::Form-->
				</div>
			</div>
		</div>
		<div class="row">

			<div class="col-lg-12">
				<div class="m-portlet">
					<div class="m-portlet__body">
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
															<label class="col-form-label pt-0">Tiêu đề</label>
															{{Form::text('name_'.$item->code,'',array('class'=>'form-control'))}}
														</div>
													</div>
													<div class="col-12 col-lg-12">
														<div class="mb-3">
															<label class="col-form-label pt-0">Mô tả</label>
															{{Form::textarea('description_'.$item->code,'',array('class'=>'form-control'))}}
														</div>
													</div>
													<div class="col-12 col-lg-12">
														<div class="mb-3">
															<label class="col-form-label pt-0">Nội dung</label>
															{{Form::textarea('content_'.$item->code,'',array('class'=>'form-control tinymce_editor','data-upload-url'=>route('dashboard-storage-upload-temp')))}}
														</div>
													</div>													
												</div>
												<div class="row">
													<div class="col-12 col-lg-12">
														<div class="mb-3">
															<label class="form-label">Seo title</label>
															{{Form::text('seo_title_'.$item->code,'',array('class'=>'form-control'))}}
														</div>
													</div>
													<div class="col-12 col-lg-12">
														<div class="mb-3">
															<label class="form-label">Seo description</label>
															{{Form::text('seo_description_'.$item->code,'',array('class'=>'form-control'))}}
														</div>
													</div>
													<div class="col-12 col-lg-12">
														<div class="mb-3">
															<label class="form-label">Seo keyword</label>
															{{Form::text('seo_keyword_'.$item->code,'',array('class'=>'form-control'))}}
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-12 col-lg-12">
														<div class="mb-3">
															<label class="form-label">Facebook title</label>
															{{Form::text('fb_title_'.$item->code,'',array('class'=>'form-control'))}}
														</div>
													</div>
													<div class="col-12 col-lg-12">
														<div class="mb-3">
															<label class="form-label">Facebook description</label>
															{{Form::text('fb_description_'.$item->code,'',array('class'=>'form-control'))}}
														</div>
													</div>
													<div class="col-12 col-lg-12">
														<div class="mb-3">
															<label class="form-label">Facebook image </label>	
															<input style="display:none" class="form-control file_upload_server_custom" id="label_fb_image_{{$item->code}}" type="file" data-id="fb_image_{{$item->code}}" data-url="{{route('dashboard-upload-one')}}" accept="image/*">
															<div class="input-group"><label style="margin-bottom:0px;" class="input-group-text" for="label_fb_image_{{$item->code}}">Upload file</label>
																{{Form::text('fb_image_'.$item->code,'',array('class'=>'form-control input-group-air ','id'=>'fb_image_'.$item->code))}}
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<?php } ?>
							<div class="row">
								<div class="col-12 col-lg-12">
									<div class="mb-4">
										<button type="submit" class="btn btn-primary w-md">Thêm</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
@endsection