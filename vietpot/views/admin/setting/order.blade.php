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
<link rel="stylesheet" href="{{asset('assets/frontend')}}/assets/css/dataTables.bootstrap5.min.css">
@endsection
@section("js")
<script src="{{asset('assets/frontend')}}/assets/js/jquery-main.js"></script>
<script src="{{asset('assets/frontend')}}/assets/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('assets/frontend')}}/assets/js/jquery-migrate.js"></script>
<script src="{{asset('assets/frontend')}}/assets/js/jquery-ui.min.js"></script>
<script src="{{asset('assets/frontend')}}/assets/js/plugincollection.js"></script>
<script src="{{asset('assets/frontend')}}/assets/vendors/apexcharts-bundle/dist/apexcharts.min.js"></script>
<script src="{{asset('assets/frontend')}}/assets/js/app.js"></script>
<script src="{{asset('assets/frontend')}}/assets/js/admin.js"></script>
<script src="{{asset('assets/frontend')}}/assets/js/jquery.dataTables.min.js"></script>
<script src="{{asset('assets/frontend')}}/assets/js/dataTables.bootstrap5.min.js"></script>
<script>

</script>
@endsection

@section("content")
@include('admin.header_bottom')
<section class="section_data_customer">
	<div class="container-main">
		<div class="section_title d-flex flex-row align-items-center justify-content-between">
			<div class="title">
				<h2>
					Cấu hình
				</h2>
			</div>
		</div>
		<div class="section_content">
			<div class="wrap_head">
				<div class="wrap_list_link_lb wrap_list_link_lb_bd">
					<ul class="list_link_lb">
						<li class="list_link_item">
							<a href="{{route('view-user')}}" class="lb-xsmall lb-link">
								{{App\Models\CommonModel::get_lang('setting_navigation10')}}
							</a>
						</li>
						<li class="list_link_item">
							<a href="{{route('view-product')}}" class="lb-xsmall lb-link">
								{{App\Models\CommonModel::get_lang('setting_navigation11')}}
							</a>
						</li>
						<li class="list_link_item">
							<a href="{{route('view-partner')}}" class="lb-xsmall lb-link ">
								{{App\Models\CommonModel::get_lang('setting_navigation12')}}
							</a>
						</li>
						<li class="list_link_item">
							<a href="{{route('view-admin')}}" class="lb-xsmall lb-link">
								{{App\Models\CommonModel::get_lang('setting_navigation13')}}
							</a>
						</li>
						<li class="list_link_item">
							<a href="{{route('view-product-category')}}" class="lb-xsmall lb-link">
								{{App\Models\CommonModel::get_lang('setting_navigation14')}}
							</a>
						</li>
						<li class="list_link_item">
							<a href="{{route('view-group-user')}}" class="lb-xsmall lb-link">
								{{App\Models\CommonModel::get_lang('setting_navigation15')}}
							</a>
						</li>
						<li class="list_link_item">
							<a href="{{route('dashboard-setting','navigation')}}" class="lb-xsmall lb-link active">
								{{App\Models\CommonModel::get_lang('setting_navigation16')}}
							</a>
						</li>
					</ul>
				</div>
				<div class="wrap_list_action wrap_list_action_bw">
					<a href="{{route('dashboard-setting','partner')}}" class="lb-xsmall">
						<span>
							{{App\Models\CommonModel::get_lang('setting_navigation17')}}
						</span>
					</a>
					
				</div>
				<div class="wrap_content">
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
											<div class="card-body">
												<div class="row">
													<div class="col-12 col-lg-12">
														<div class="mb-3">
															<label class="form-label">Đơn hàng</label>	
															<?php
															$value_lang = '';
															foreach ($data as $key => $value) {
																if ($key == 'setting_order1_' . $item->id) {
																	$value_lang = $value;
																}
															}
															?>
															{{Form::text('setting_order1_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
														</div>
													</div>		
													<div class="col-12 col-lg-12">
														<div class="mb-3">
															<label class="form-label">Thống kê theo số lượng đơn</label>	
															<?php
															$value_lang = '';
															foreach ($data as $key => $value) {
																if ($key == 'setting_order2_' . $item->id) {
																	$value_lang = $value;
																}
															}
															?>
															{{Form::text('setting_order2_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
														</div>
													</div>		
													<div class="col-12 col-lg-12">
														<div class="mb-3">
															<label class="form-label">Thống kê theo tiền</label>	
															<?php
															$value_lang = '';
															foreach ($data as $key => $value) {
																if ($key == 'setting_order3_' . $item->id) {
																	$value_lang = $value;
																}
															}
															?>
															{{Form::text('setting_order3_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
														</div>
													</div>		
													<div class="col-12 col-lg-12">
														<div class="mb-3">
															<label class="form-label">Thống kê theo số lượng hàng</label>	
															<?php
															$value_lang = '';
															foreach ($data as $key => $value) {
																if ($key == 'setting_order4_' . $item->id) {
																	$value_lang = $value;
																}
															}
															?>
															{{Form::text('setting_order4_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
														</div>
													</div>		
													<div class="col-12 col-lg-12">
														<div class="mb-3">
															<label class="form-label">Danh sách đơn hàng</label>	
															<?php
															$value_lang = '';
															foreach ($data as $key => $value) {
																if ($key == 'setting_order5_' . $item->id) {
																	$value_lang = $value;
																}
															}
															?>
															{{Form::text('setting_order5_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
														</div>
													</div>		
													<div class="col-12 col-lg-12">
														<div class="mb-3">
															<label class="form-label">Đơn hàng chưa gửi</label>	
															<?php
															$value_lang = '';
															foreach ($data as $key => $value) {
																if ($key == 'setting_order6_' . $item->id) {
																	$value_lang = $value;
																}
															}
															?>
															{{Form::text('setting_order6_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
														</div>
													</div>		
													<div class="col-12 col-lg-12">
														<div class="mb-3">
															<label class="form-label">Đơn hàng đã huỷ</label>	
															<?php
															$value_lang = '';
															foreach ($data as $key => $value) {
																if ($key == 'setting_order7_' . $item->id) {
																	$value_lang = $value;
																}
															}
															?>
															{{Form::text('setting_order7_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
														</div>
													</div>		
													<div class="col-12 col-lg-12">
														<div class="mb-3">
															<label class="form-label">Tổng tiền trước thuế</label>	
															<?php
															$value_lang = '';
															foreach ($data as $key => $value) {
																if ($key == 'setting_order8_' . $item->id) {
																	$value_lang = $value;
																}
															}
															?>
															{{Form::text('setting_order8_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
														</div>
													</div>		
													<div class="col-12 col-lg-12">
														<div class="mb-3">
															<label class="form-label">Tổng tiền sau thuế</label>	
															<?php
															$value_lang = '';
															foreach ($data as $key => $value) {
																if ($key == 'setting_order9_' . $item->id) {
																	$value_lang = $value;
																}
															}
															?>
															{{Form::text('setting_order9_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
														</div>
													</div>	
													<div class="col-12 col-lg-12">
														<div class="mb-3">
															<label class="form-label">Số lượng bịch</label>	
															<?php
															$value_lang = '';
															foreach ($data as $key => $value) {
																if ($key == 'setting_order10_' . $item->id) {
																	$value_lang = $value;
																}
															}
															?>
															{{Form::text('setting_order10_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
														</div>
													</div>	
													<div class="col-12 col-lg-12">
														<div class="mb-3">
															<label class="form-label">Số lượng đơn</label>	
															<?php
															$value_lang = '';
															foreach ($data as $key => $value) {
																if ($key == 'setting_order11_' . $item->id) {
																	$value_lang = $value;
																}
															}
															?>
															{{Form::text('setting_order11_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
														</div>
													</div>	
													<div class="col-12 col-lg-12">
														<div class="mb-3">
															<label class="form-label">Khách hàng</label>	
															<?php
															$value_lang = '';
															foreach ($data as $key => $value) {
																if ($key == 'setting_order12_' . $item->id) {
																	$value_lang = $value;
																}
															}
															?>
															{{Form::text('setting_order12_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
														</div>
													</div>	
													<div class="col-12 col-lg-12">
														<div class="mb-3">
															<label class="form-label">Tên công ty</label>	
															<?php
															$value_lang = '';
															foreach ($data as $key => $value) {
																if ($key == 'setting_order13_' . $item->id) {
																	$value_lang = $value;
																}
															}
															?>
															{{Form::text('setting_order13_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
														</div>
													</div>	
													<div class="col-12 col-lg-12">
														<div class="mb-3">
															<label class="form-label">Sản phẩm</label>	
															<?php
															$value_lang = '';
															foreach ($data as $key => $value) {
																if ($key == 'setting_order14_' . $item->id) {
																	$value_lang = $value;
																}
															}
															?>
															{{Form::text('setting_order14_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
														</div>
													</div>	
													<div class="col-12 col-lg-12">
														<div class="mb-3">
															<label class="form-label">Chọn sản phẩm</label>	
															<?php
															$value_lang = '';
															foreach ($data as $key => $value) {
																if ($key == 'setting_order15_' . $item->id) {
																	$value_lang = $value;
																}
															}
															?>
															{{Form::text('setting_order15_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
														</div>
													</div>	
													<div class="col-12 col-lg-12">
														<div class="mb-3">
															<label class="form-label">Chọn khách hàng</label>	
															<?php
															$value_lang = '';
															foreach ($data as $key => $value) {
																if ($key == 'setting_order16_' . $item->id) {
																	$value_lang = $value;
																}
															}
															?>
															{{Form::text('setting_order16_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
														</div>
													</div>	
													<div class="col-12 col-lg-12">
														<div class="mb-3">
															<label class="form-label">Giá trước thuế</label>	
															<?php
															$value_lang = '';
															foreach ($data as $key => $value) {
																if ($key == 'setting_order17_' . $item->id) {
																	$value_lang = $value;
																}
															}
															?>
															{{Form::text('setting_order17_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
														</div>
													</div>	
													<div class="col-12 col-lg-12">
														<div class="mb-3">
															<label class="form-label">Giá sau thuế</label>	
															<?php
															$value_lang = '';
															foreach ($data as $key => $value) {
																if ($key == 'setting_order18_' . $item->id) {
																	$value_lang = $value;
																}
															}
															?>
															{{Form::text('setting_order18_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
														</div>
													</div>	
													<div class="col-12 col-lg-12">
														<div class="mb-3">
															<label class="form-label">Số lượng</label>	
															<?php
															$value_lang = '';
															foreach ($data as $key => $value) {
																if ($key == 'setting_order19_' . $item->id) {
																	$value_lang = $value;
																}
															}
															?>
															{{Form::text('setting_order19_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
														</div>
													</div>	
													<div class="col-12 col-lg-12">
														<div class="mb-3">
															<label class="form-label">Bổ sung</label>	
															<?php
															$value_lang = '';
															foreach ($data as $key => $value) {
																if ($key == 'setting_order20_' . $item->id) {
																	$value_lang = $value;
																}
															}
															?>
															{{Form::text('setting_order20_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
														</div>
													</div>	
													<div class="col-12 col-lg-12">
														<div class="mb-3">
															<label class="form-label">Bổ sung thêm hàng</label>	
															<?php
															$value_lang = '';
															foreach ($data as $key => $value) {
																if ($key == 'setting_order21_' . $item->id) {
																	$value_lang = $value;
																}
															}
															?>
															{{Form::text('setting_order21_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
														</div>
													</div>	
													<div class="col-12 col-lg-12">
														<div class="mb-3">
															<label class="form-label">Tách đơn</label>	
															<?php
															$value_lang = '';
															foreach ($data as $key => $value) {
																if ($key == 'setting_order22_' . $item->id) {
																	$value_lang = $value;
																}
															}
															?>
															{{Form::text('setting_order22_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
														</div>
													</div>	
													<div class="col-12 col-lg-12">
														<div class="mb-3">
															<label class="form-label">Bonus</label>	
															<?php
															$value_lang = '';
															foreach ($data as $key => $value) {
																if ($key == 'setting_order23_' . $item->id) {
																	$value_lang = $value;
																}
															}
															?>
															{{Form::text('setting_order23_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
														</div>
													</div>	
													<div class="col-12 col-lg-12">
														<div class="mb-3">
															<label class="form-label">Thông báo</label>	
															<?php
															$value_lang = '';
															foreach ($data as $key => $value) {
																if ($key == 'setting_order24_' . $item->id) {
																	$value_lang = $value;
																}
															}
															?>
															{{Form::text('setting_order24_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
														</div>
													</div>	
													<div class="col-12 col-lg-12">
														<div class="mb-3">
															<label class="form-label">Xác nhận đơn</label>	
															<?php
															$value_lang = '';
															foreach ($data as $key => $value) {
																if ($key == 'setting_order25_' . $item->id) {
																	$value_lang = $value;
																}
															}
															?>
															{{Form::text('setting_order25_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
														</div>
													</div>	
													<div class="col-12 col-lg-12">
														<div class="mb-3">
															<label class="form-label">Gửi đơn hàng</label>	
															<?php
															$value_lang = '';
															foreach ($data as $key => $value) {
																if ($key == 'setting_order26_' . $item->id) {
																	$value_lang = $value;
																}
															}
															?>
															{{Form::text('setting_order26_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
														</div>
													</div>	
													<div class="col-12 col-lg-12">
														<div class="mb-3">
															<label class="form-label">Nội dung</label>	
															<?php
															$value_lang = '';
															foreach ($data as $key => $value) {
																if ($key == 'setting_order27_' . $item->id) {
																	$value_lang = $value;
																}
															}
															?>
															{{Form::text('setting_order27_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
														</div>
													</div>	
													<div class="col-12 col-lg-12">
														<div class="mb-3">
															<label class="form-label">Ghi chú</label>	
															<?php
															$value_lang = '';
															foreach ($data as $key => $value) {
																if ($key == 'setting_order28_' . $item->id) {
																	$value_lang = $value;
																}
															}
															?>
															{{Form::text('setting_order28_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
														</div>
													</div>	
													<div class="col-12 col-lg-12">
														<div class="mb-3">
															<label class="form-label">Ngày</label>	
															<?php
															$value_lang = '';
															foreach ($data as $key => $value) {
																if ($key == 'setting_order29_' . $item->id) {
																	$value_lang = $value;
																}
															}
															?>
															{{Form::text('setting_order29_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
														</div>
													</div>	
													<div class="col-12 col-lg-12">
														<div class="mb-3">
															<label class="form-label">Chi tiết</label>	
															<?php
															$value_lang = '';
															foreach ($data as $key => $value) {
																if ($key == 'setting_order30_' . $item->id) {
																	$value_lang = $value;
																}
															}
															?>
															{{Form::text('setting_order30_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
														</div>
													</div>	
													<div class="col-12 col-lg-12">
														<div class="mb-3">
															<label class="form-label">Số sản phẩm</label>	
															<?php
															$value_lang = '';
															foreach ($data as $key => $value) {
																if ($key == 'setting_order31_' . $item->id) {
																	$value_lang = $value;
																}
															}
															?>
															{{Form::text('setting_order31_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
														</div>
													</div>	
													<div class="col-12 col-lg-12">
														<div class="mb-3">
															<label class="form-label">Người tạo đơn</label>	
															<?php
															$value_lang = '';
															foreach ($data as $key => $value) {
																if ($key == 'setting_order32_' . $item->id) {
																	$value_lang = $value;
																}
															}
															?>
															{{Form::text('setting_order32_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
														</div>
													</div>	
													<div class="col-12 col-lg-12">
														<div class="mb-3">
															<label class="form-label">Tên khách hàng</label>	
															<?php
															$value_lang = '';
															foreach ($data as $key => $value) {
																if ($key == 'setting_order33_' . $item->id) {
																	$value_lang = $value;
																}
															}
															?>
															{{Form::text('setting_order33_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
														</div>
													</div>	
												</div>
											</div>
										</div>
									</div>
									<div class="col-12 col-lg-12">
										<div class="mb-4">
											<button type="submit" class="btn btn-primary w-md">{{App\Models\CommonModel::get_lang('setting_save')}}</button>
										</div>
									</div>
								</div>
							</div>
							<?php } ?>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection