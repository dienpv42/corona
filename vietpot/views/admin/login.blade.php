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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
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
<div class="section_form_login">
	<div class="card_forms">
		<div class="card_title">
			Tài khoản
		</div>
		<div class="card_form">
			<form action="{{route('dashboard-login-post')}}" method="post">
			@csrf
				<div class="form-group">
					<label class="form-label">
						Email
					</label>
					{{Form::text('email','',array('class'=>'form-control'))}}
				</div>
				<div class="form-group">
					<label ="form-label">
						Mật khẩu
					</label>
					<input type="password" name="password" class="form-control">
					<a href="javascript:void(0)" class="text-forgot">
						Quên mật khẩu?
					</a>
				</div>
				@include('admin.alert')
				<div class="form-group text-end">
					<button class="lb-small-success pd-e-60 pd-s-60" type="submit">
						Đăng nhập
					</button>
				</div>
			</form>
		</div>
	</div>
	<hr>
	<div class="card_forms">
		<div class="card_title">
			Đăng ký
		</div>
		<div class="wrap_btn_full">
			<a href="javascript:void(0);" class="lb-small w-100 text-center">
				Tạo tài khoản mới
			</a>
		</div>
	</div>
</div>

@endsection