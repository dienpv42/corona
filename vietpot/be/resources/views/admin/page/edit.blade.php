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
				<h3>Trang tĩnh</h3>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{route('dashboard-index')}}">Dashboard</a></li>
					<li class="breadcrumb-item"><a href="{{route('view-page')}}">Trang tĩnh</a></li>
					<li class="breadcrumb-item active">Sửa</li>
				</ol>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid">
	<form class="form-wizard" method="post" action="{{route('post-edit-page')}}" enctype="multipart/form-data">
							@csrf
	<!-- start page title -->
	<input type="hidden" name="id" value="{{$data->id}}"/>
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
		$c_data=[];
		foreach($data_lang as $item_data){
			if($item_data->langid==$item->id){	
				$c_data=$item_data;
			}
		}
		?>
		<input type="hidden" name="lang_id_{{$item->code}}" value="{{$item->id}}"/>
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
										$name='';
										if(!empty($c_data) && isset($c_data->page_name)){
											$name=$c_data->page_name;
										}
										?>
										{{Form::text('name_'.$item->code,$name,array('class'=>'form-control '))}}					
									</div>
								</div>
								<div class="col-12 col-lg-12">
									<div class="mb-3">
										<label class="form-label">Mô tả</label>		
										<?php 
										$description='';
										if(!empty($c_data) && isset($c_data->page_description)){
											$description=$c_data->page_description;
										}
										?>
										{{Form::textarea('description_'.$item->code,$description,array('class'=>'form-control '))}}							
									</div>
								</div>
								<div class="col-12 col-lg-12">
									<div class="mb-3">
										<label class="col-form-label pt-0">Nội dung</label>
										<?php 
										$content='';
										if(!empty($c_data) && isset($c_data->page_content)){
											$content=$c_data->page_content;
										}
										?>
										{{Form::textarea('content_'.$item->code,$content,array('class'=>'form-control tinymce_editor','data-upload-url'=>route('dashboard-upload-temp')))}}
									</div>
								</div>								
							</div>
							<div class="row">
								<div class="col-12 col-lg-12">
									<div class="mb-3">
										<label class="form-label">Seo title</label>
										<?php 
										$seo_title='';
										if(!empty($c_data) && isset($c_data->seo_title)){
											$seo_title=$c_data->seo_title;
										}
										?>
										{{Form::text('seo_title_'.$item->code,$seo_title,array('class'=>'form-control '))}}
									</div>
								</div>
								<div class="col-12 col-lg-12">
									<div class="mb-3">
										<label class="form-label">Seo description</label>
										<?php 
										$seo_description='';
										if(!empty($c_data) && isset($c_data->seo_description)){
											$seo_description=$c_data->seo_description;
										}
										?>
										{{Form::text('seo_description_'.$item->code,$seo_description,array('class'=>'form-control '))}}	
									</div>
								</div>
								<div class="col-12 col-lg-12">
									<div class="mb-3">
										<label class="form-label">Seo keyword</label>
										<?php 
										$seo_keyword='';
										if(!empty($c_data) && isset($c_data->seo_keyword)){
											$seo_keyword=$c_data->seo_keyword;
										}
										?>
										{{Form::text('seo_keyword_'.$item->code,$seo_keyword,array('class'=>'form-control '))}}
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-12 col-lg-12">
									<div class="mb-3">
										<label class="form-label">Facebook title</label>
										<?php 
										$fb_title='';
										if(!empty($c_data) && isset($c_data->fb_title)){
											$fb_title=$c_data->fb_title;
										}
										?>
										{{Form::text('fb_title_'.$item->code,$fb_title,array('class'=>'form-control'))}}	
									</div>
								</div>
								<div class="col-12 col-lg-12">
									<div class="mb-3">
										<label class="form-label">Facebook description</label>
										<?php 
										$fb_description='';
										if(!empty($c_data) && isset($c_data->fb_description)){
											$fb_description=$c_data->fb_description;
										}
										?>
										{{Form::text('fb_description_'.$item->code,$fb_description,array('class'=>'form-control'))}}	
									</div>
								</div>
								<div class="col-12 col-lg-12">
									<div class="mb-3">
										<label class="form-label">Facebook image</label>
										<?php 
										$fb_image='';
										if(!empty($c_data) && isset($c_data->fb_image)){
											$fb_image=$c_data->fb_image;
										}
										?>
										@if(isset($fb_image) && $fb_image!='')
										<div class="fileinput fileinput-exists" data-provides="fileinput">
											<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
												<img src="{{asset('assets/admin')}}/assets/images/noimage.png" alt="" /> </div>
											<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> 
												<img src="{{$fb_image}}" style="max-height: 140px;"/>
											</div>
											<div>
												<span class="btn default btn-file">
													<span class="fileinput-new"> Chọn ảnh </span>
													<span class="fileinput-exists"> Đổi ảnh </span>
													<input type="file" name="fb_image_{{$item->code}}"> <input type="hidden" name="hidden_f_{{$item->code}}" value="{{$fb_image}}"/></span>
												<a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Xóa </a>
											</div>
										</div>			
										@else 
										<div class="fileinput fileinput-new" data-provides="fileinput">
											<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
												<img src="{{asset('assets/admin')}}/assets/images/noimage.png" alt="" /> </div>
											<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
											<div>
												<span class="btn default btn-file">
													<span class="fileinput-new"> Chọn ảnh </span>
													<span class="fileinput-exists"> Đổi ảnh </span>
													<input type="file" name="fb_image_{{$item->code}}"> <input type="hidden" name="hidden_f_{{$item->code}}" value=""/></span>
												<a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Xóa </a>
											</div>
										</div>				
										@endif
									
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
					<button type="submit" class="btn btn-primary w-md">Cập nhật</button>
				</div>
			</div>
		</div>
	</div>
	</form>
</div>
@endsection