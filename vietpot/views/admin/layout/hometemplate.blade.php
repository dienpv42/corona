<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('desc')">
	<meta name="keywords" content="@yield('keyword')"/>
    <title>@yield('title')</title>
	@yield('css')
	<link href="{{asset('assets/admin')}}/assets/css/jquery.tagsinput.css" rel="stylesheet" type="text/css" />
	<link href="{{asset('assets/admin')}}/assets/css/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
	<link href="{{asset('assets/admin')}}/assets/css/jquery.loadingModal.css" rel="stylesheet" type="text/css" />
	<style>
    .image_insert_caption {
		margin-bottom:5px;
	}
	.toast{
		z-index: 9999;
	}
    </style>
</head>

<body>
	<div class="page-wrapper" id="pageWrapper">
		@include('admin.layout.top')		
		<div class="page-body-wrapper horizontal-menu">
			@include('admin.layout.left')
			<div class="page-body">
				@yield("content")
				
			</div>
			@include('admin.layout.bottom')
		</div>
	</div>
	@yield('js')
	<script src="{{asset('assets/admin')}}/assets/js/jquery.nestable.js"></script>
	<script src="{{asset('assets/admin')}}/assets/js/jquery.loadingModal.js"></script>
	<script src="{{asset('assets/admin')}}/assets/js/jquery.tagsinput.min.js"></script>
	<script src="{{asset('assets/admin')}}/assets/js/bootstrap-fileinput.js"></script>
	<script src="{{asset('assets/admin')}}/assets/js/toastr.min.js"></script>
	<script src="{{asset('assets/admin')}}/assets/js/sweet-alert/sweetalert.min.js"></script>
	<script src="{{asset('assets/admin')}}/assets/js/jquery.masknumber.js"></script>
	<script src="{{asset('assets/admin')}}/assets/tinymce/tinymce.min.js" type="text/javascript"></script>
	<script src="{{asset('assets/admin')}}/assets/js/admin.js?v=1"></script>
	<script>
		$(document).ready(function(){			
			$(".btn.red").click(function(){
				$(this).parent().find("input[type='hidden']").val('');
			});
			$('.mask_number').maskNumber({integer:true});
			$('.tags_input').tagsInput();
			$('.mask_number').change(function(){
				if($(this).val() == ''){
					$(this).val(0);
				}
			});
		});
	</script>
	
</body>

</html>