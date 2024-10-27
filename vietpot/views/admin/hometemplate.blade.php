<!DOCTYPE html>
<html lang="vi">
<head>
	 <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('desc')">
	<meta name="keywords" content="@yield('keyword')"/>
	<link rel="icon" href="/favico.png" type="image/png" sizes="50x50">
    <title>@yield('title')</title>
	@yield('facebooktag')
	@yield('css')
	<link rel="stylesheet" href="{{asset('assets/frontend')}}/assets/css/jquery.loadingModal.css">
	<link rel="stylesheet" href="{{asset('assets/frontend')}}/assets/css/toastr.min.css">
</head>
<body class="bl_home">
	@include('admin.header')
	<main class="main">
	@yield("content")
	</main>
	@include('admin.footer')
	<div class="bg_backgdrop"></div>
	@yield('js')	
	<script src="{{asset('assets/frontend')}}/assets/js/jquery.loadingModal.js"></script>
	<script src="{{asset('assets/frontend')}}/assets/js/toastr.min.js"></script>
	<script src="{{asset('assets/frontend')}}/assets/js/jquery.masknumber.js"></script>
	<script>
	$(document).ready(function(){	
		$('.mask_number').maskNumber({float:true});
		$('.mask_number').change(function(){
			if($(this).val() == ''){
				$(this).val(0);
			}
		});
	});
	$(document).on('click', '.btn-action-table', function() {
		$.ajaxSetup({
		  headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		  }
		});
		$.ajax({
			url: $(this).data('url'),
			type: 'POST',
			dataType: 'html',
			success: function (msg, textStatus, jqXHR) {
				location.reload();
			}
		});
	});
	</script>
</body>

</html>