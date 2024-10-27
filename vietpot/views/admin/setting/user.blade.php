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
					<a href="{{route('dashboard-setting','navigation')}}" class="lb-xsmall">
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
															<label class="form-label">Số khách hàng</label>	
															<?php
															$value_lang = '';
															foreach ($data as $key => $value) {
																if ($key == 'setting_user1_' . $item->id) {
																	$value_lang = $value;
																}
															}
															?>
															{{Form::text('setting_user1_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
														</div>
													</div>		
													<div class="col-12 col-lg-12">
														<div class="mb-3">
															<label class="form-label">Địa chỉ cửa hàng</label>	
															<?php
															$value_lang = '';
															foreach ($data as $key => $value) {
																if ($key == 'setting_user2_' . $item->id) {
																	$value_lang = $value;
																}
															}
															?>
															{{Form::text('setting_user2_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
														</div>
													</div>		
													<div class="col-12 col-lg-12">
														<div class="mb-3">
															<label class="form-label">Nhóm khách hàng</label>	
															<?php
															$value_lang = '';
															foreach ($data as $key => $value) {
																if ($key == 'setting_user3_' . $item->id) {
																	$value_lang = $value;
																}
															}
															?>
															{{Form::text('setting_user3_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
														</div>
													</div>		
													<div class="col-12 col-lg-12">
														<div class="mb-3">
															<label class="form-label">Số điện thoại</label>	
															<?php
															$value_lang = '';
															foreach ($data as $key => $value) {
																if ($key == 'setting_user4_' . $item->id) {
																	$value_lang = $value;
																}
															}
															?>
															{{Form::text('setting_user4_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
														</div>
													</div>		
													<div class="col-12 col-lg-12">
														<div class="mb-3">
															<label class="form-label">Lần cuối đặt hàng</label>	
															<?php
															$value_lang = '';
															foreach ($data as $key => $value) {
																if ($key == 'setting_user5_' . $item->id) {
																	$value_lang = $value;
																}
															}
															?>
															{{Form::text('setting_user5_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
														</div>
													</div>		
													<div class="col-12 col-lg-12">
														<div class="mb-3">
															<label class="form-label">Tên</label>	
															<?php
															$value_lang = '';
															foreach ($data as $key => $value) {
																if ($key == 'setting_user6_' . $item->id) {
																	$value_lang = $value;
																}
															}
															?>
															{{Form::text('setting_user6_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
														</div>
													</div>		
													<div class="col-12 col-lg-12">
														<div class="mb-3">
															<label class="form-label">Mật khẩu</label>	
															<?php
															$value_lang = '';
															foreach ($data as $key => $value) {
																if ($key == 'setting_user7_' . $item->id) {
																	$value_lang = $value;
																}
															}
															?>
															{{Form::text('setting_user7_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
														</div>
													</div>		
													<div class="col-12 col-lg-12">
														<div class="mb-3">
															<label class="form-label">Tài khoản bank</label>	
															<?php
															$value_lang = '';
															foreach ($data as $key => $value) {
																if ($key == 'setting_user8_' . $item->id) {
																	$value_lang = $value;
																}
															}
															?>
															{{Form::text('setting_user8_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
														</div>
													</div>		
													<div class="col-12 col-lg-12">
														<div class="mb-3">
															<label class="form-label">Mã số khách hàng</label>	
															<?php
															$value_lang = '';
															foreach ($data as $key => $value) {
																if ($key == 'setting_user9_' . $item->id) {
																	$value_lang = $value;
																}
															}
															?>
															{{Form::text('setting_user9_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
														</div>
													</div>	
													<div class="col-12 col-lg-12">
														<div class="mb-3">
															<label class="form-label">Tổng số khách hàng</label>	
															<?php
															$value_lang = '';
															foreach ($data as $key => $value) {
																if ($key == 'setting_user10_' . $item->id) {
																	$value_lang = $value;
																}
															}
															?>
															{{Form::text('setting_user10_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
														</div>
													</div>	
													<div class="col-12 col-lg-12">
														<div class="mb-3">
															<label class="form-label">Tổng số khách hàng đặt 90 ngày cuối</label>	
															<?php
															$value_lang = '';
															foreach ($data as $key => $value) {
																if ($key == 'setting_user11_' . $item->id) {
																	$value_lang = $value;
																}
															}
															?>
															{{Form::text('setting_user11_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
														</div>
													</div>	
													<div class="col-12 col-lg-12">
														<div class="mb-3">
															<label class="form-label">Danh sách đơn hàng</label>	
															<?php
															$value_lang = '';
															foreach ($data as $key => $value) {
																if ($key == 'setting_user12_' . $item->id) {
																	$value_lang = $value;
																}
															}
															?>
															{{Form::text('setting_user12_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
														</div>
													</div>	
													<div class="col-12 col-lg-12">
														<div class="mb-3">
															<label class="form-label">Thống kê và đồ thị theo đơn hàng</label>	
															<?php
															$value_lang = '';
															foreach ($data as $key => $value) {
																if ($key == 'setting_user13_' . $item->id) {
																	$value_lang = $value;
																}
															}
															?>
															{{Form::text('setting_user13_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
														</div>
													</div>	
													<div class="col-12 col-lg-12">
														<div class="mb-3">
															<label class="form-label">Ghi chú</label>	
															<?php
															$value_lang = '';
															foreach ($data as $key => $value) {
																if ($key == 'setting_user14_' . $item->id) {
																	$value_lang = $value;
																}
															}
															?>
															{{Form::text('setting_user14_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
														</div>
													</div>	
													<div class="col-12 col-lg-12">
														<div class="mb-3">
															<label class="form-label">Khiếu nại</label>	
															<?php
															$value_lang = '';
															foreach ($data as $key => $value) {
																if ($key == 'setting_user15_' . $item->id) {
																	$value_lang = $value;
																}
															}
															?>
															{{Form::text('setting_user15_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
														</div>
													</div>	
													<div class="col-12 col-lg-12">
														<div class="mb-3">
															<label class="form-label">Bonus</label>	
															<?php
															$value_lang = '';
															foreach ($data as $key => $value) {
																if ($key == 'setting_user16_' . $item->id) {
																	$value_lang = $value;
																}
															}
															?>
															{{Form::text('setting_user16_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
														</div>
													</div>	
													<div class="col-12 col-lg-12">
														<div class="mb-3">
															<label class="form-label">Gửi hoá đơn</label>	
															<?php
															$value_lang = '';
															foreach ($data as $key => $value) {
																if ($key == 'setting_user17_' . $item->id) {
																	$value_lang = $value;
																}
															}
															?>
															{{Form::text('setting_user17_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
														</div>
													</div>	
													<div class="col-12 col-lg-12">
														<div class="mb-3">
															<label class="form-label">Gửi tin cho khách hàng</label>	
															<?php
															$value_lang = '';
															foreach ($data as $key => $value) {
																if ($key == 'setting_user18_' . $item->id) {
																	$value_lang = $value;
																}
															}
															?>
															{{Form::text('setting_user18_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
														</div>
													</div>	
													<div class="col-12 col-lg-12">
														<div class="mb-3">
															<label class="form-label">Thẻ khách hàng</label>	
															<?php
															$value_lang = '';
															foreach ($data as $key => $value) {
																if ($key == 'setting_user19_' . $item->id) {
																	$value_lang = $value;
																}
															}
															?>
															{{Form::text('setting_user19_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
														</div>
													</div>	
													<div class="col-12 col-lg-12">
														<div class="mb-3">
															<label class="form-label">Khách hàng mới</label>	
															<?php
															$value_lang = '';
															foreach ($data as $key => $value) {
																if ($key == 'setting_user20_' . $item->id) {
																	$value_lang = $value;
																}
															}
															?>
															{{Form::text('setting_user20_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
														</div>
													</div>	
													<div class="col-12 col-lg-12">
														<div class="mb-3">
															<label class="form-label">Chỉnh sửa</label>	
															<?php
															$value_lang = '';
															foreach ($data as $key => $value) {
																if ($key == 'setting_user21_' . $item->id) {
																	$value_lang = $value;
																}
															}
															?>
															{{Form::text('setting_user21_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
														</div>
													</div>
													<div class="col-12 col-lg-12">
														<div class="mb-3">
															<label class="form-label">Tổng số tiền</label>	
															<?php
															$value_lang = '';
															foreach ($data as $key => $value) {
																if ($key == 'setting_user22_' . $item->id) {
																	$value_lang = $value;
																}
															}
															?>
															{{Form::text('setting_user22_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
														</div>
													</div>
													<div class="col-12 col-lg-12">
														<div class="mb-3">
															<label class="form-label">Tổng số đơn</label>	
															<?php
															$value_lang = '';
															foreach ($data as $key => $value) {
																if ($key == 'setting_user23_' . $item->id) {
																	$value_lang = $value;
																}
															}
															?>
															{{Form::text('setting_user23_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
														</div>
													</div>
													<div class="col-12 col-lg-12">
														<div class="mb-3">
															<label class="form-label">Ngày đặt hàng</label>	
															<?php
															$value_lang = '';
															foreach ($data as $key => $value) {
																if ($key == 'setting_user24_' . $item->id) {
																	$value_lang = $value;
																}
															}
															?>
															{{Form::text('setting_user24_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
														</div>
													</div>
													<div class="col-12 col-lg-12">
														<div class="mb-3">
															<label class="form-label">Số hoá đơn</label>	
															<?php
															$value_lang = '';
															foreach ($data as $key => $value) {
																if ($key == 'setting_user25_' . $item->id) {
																	$value_lang = $value;
																}
															}
															?>
															{{Form::text('setting_user25_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
														</div>
													</div>
													<div class="col-12 col-lg-12">
														<div class="mb-3">
															<label class="form-label">Tổng tiền trước thuế</label>	
															<?php
															$value_lang = '';
															foreach ($data as $key => $value) {
																if ($key == 'setting_user26_' . $item->id) {
																	$value_lang = $value;
																}
															}
															?>
															{{Form::text('setting_user26_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
														</div>
													</div>
													<div class="col-12 col-lg-12">
														<div class="mb-3">
															<label class="form-label">Tổng tiền sau thuế</label>	
															<?php
															$value_lang = '';
															foreach ($data as $key => $value) {
																if ($key == 'setting_user27_' . $item->id) {
																	$value_lang = $value;
																}
															}
															?>
															{{Form::text('setting_user27_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
														</div>
													</div>
													<div class="col-12 col-lg-12">
														<div class="mb-3">
															<label class="form-label">Lãi sau thuế</label>	
															<?php
															$value_lang = '';
															foreach ($data as $key => $value) {
																if ($key == 'setting_user28_' . $item->id) {
																	$value_lang = $value;
																}
															}
															?>
															{{Form::text('setting_user28_'.$item->id,$value_lang,array('class'=>'form-control'))}}						
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