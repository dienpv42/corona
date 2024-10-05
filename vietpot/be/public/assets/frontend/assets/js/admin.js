
$(document).on('click','.action_table',function(){
	var url = $(this).data('url');
	$.ajaxSetup({
	  headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});
	$.ajax({
		url: url,
		type: 'POST',
		dataType: 'html',
		success: function (data, textStatus, jqXHR) {
			location.reload();
		}
	});
});

$(document).ready(function(){	
	$(".btn_upload_multi").click(function (l) {
		$('#file_select_image_multi').trigger('click');
	});
	$('#file_select_image_multi').on("change", function (event) {
		var url_upload = $(this).data('upload-url');
		var files = event.target.files;
		
		var data = new FormData();
		for (var i = 0; i < files.length; i++) {
			var file = files[i];
			if (file.size <= 20480000000) {
				data.append('image[]', file);
			}
		}
		data.append('_token', $('meta[name="csrf-token"]').attr('content'));
		if (typeof (url_upload) == "undefined") {
			url_upload = '';
		}
		$.ajax({
			url: url_upload,
			type: 'POST',
			dataType: 'json',
			data: data,
			processData: false, 
			contentType: false, 
			success: function (data, textStatus, jqXHR) {
				if (data.check == 0) {
					swal(data.content, "", "error");
				} else {
					var myarr = data.content;
					myarr.forEach(function (entry) {
						$('.image_upload_multi_content').append('<div class="col-12 col-lg-3 image_insert_caption"><img class="content-img" style="width: 100%;" src="' + entry.image + '"><input type="hidden" value="' + entry.image + '" name="image_upload_multi_file[]"><div data-repeater-delete="" class="btn-sm btn btn-danger m-btn m-btn--icon m-btn--pill remove_cache" onclick="$(this).closest(\'.image_insert_caption\').remove();"><span>Delete</span></div></div>');
					});
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {

			}
		});
		
		$(this).val('');
	});
	$(".btn_upload_slide").click(function (l) {
		$('#file_select_image_slide').trigger('click');
	});
	$('#file_select_image_slide').on("change", function (event) {
		var url_upload = $(this).data('upload-url');
		var files = event.target.files;
		if (files.length < 11) {
			var data = new FormData();
			for (var i = 0; i < files.length; i++) {
				var file = files[i];
				if (file.size <= 20480000000) {
					data.append('image[]', file);
				}
			}
			data.append('_token', $('meta[name="csrf-token"]').attr('content'));
			if (typeof (url_upload) == "undefined") {
				url_upload = '';
			}
			$.ajax({
				url: url_upload,
				type: 'POST',
				dataType: 'json',
				data: data,
				processData: false, 
				contentType: false, 
				success: function (data, textStatus, jqXHR) {
					if (data.check == 0) {
						swal(data.content, "", "error");
					} else {
						var myarr = data.content;
						myarr.forEach(function (entry) {
							$('.image_upload_multi_content').append('<div class="col-12 col-lg-3 image_insert_caption"><input type="number" value="0" name="list_slide_position[]" class="form-control mb-3" placeholder="Thứ tự" title="Thứ tự"/><input type="text" value="" name="list_slide_url[]" class="form-control" placeholder="URL" title="URL"/><img class="content-img" style="width: 100%;" src="' + entry.image + '"><input type="hidden" value="' + entry.image + '" name="list_slide_image[]"><div data-repeater-delete="" class="btn-sm btn btn-danger m-btn m-btn--icon m-btn--pill" onclick="$(this).closest(\'.image_insert_caption\').remove();"><span>Delete</span></div></div>');
						});
					}
				},
				error: function (jqXHR, textStatus, errorThrown) {

				}
			});
		} else {
			swal("Tối đa 10 ảnh", "", "error");
		}
		$(this).val('');
	});	
	$('.file_upload_server_custom').on("change", function (event) {
		var url_upload = $(this).data('url');
		var input = $(this).data('id');
		var file = event.target.files;
	
		var data = new FormData();
		data.append('image', file[0]);
		data.append('_token', $('meta[name="csrf-token"]').attr('content'));
		
		$.ajax({
			url: url_upload,
			type: 'POST',
			dataType: 'json',
			data: data,
			processData: false, 
			contentType: false, 
			success: function (data, textStatus, jqXHR) {
				if (data.check == 0) {
					swal(data.content, "", "error");
				} else {
					$("#"+input).val(data.content);
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {

			}
		});
	
		$(this).val('');
	});
	$('.file_upload_server_custom1').on("change", function (event) {
		var url_upload = $(this).data('url');
		var input = $(this).data('id');
		var img = $(this).data('img');
		var file = event.target.files;
	
		var data = new FormData();
		data.append('image', file[0]);
		data.append('_token', $('meta[name="csrf-token"]').attr('content'));
		
		$.ajax({
			url: url_upload,
			type: 'POST',
			dataType: 'json',
			data: data,
			processData: false, 
			contentType: false, 
			success: function (data, textStatus, jqXHR) {
				if (data.check == 0) {
					swal(data.content, "", "error");
				} else {
					$("#"+input).val(data.content);
					$("#"+img).attr('src',data.content);
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {

			}
		});
	
		$(this).val('');
	});
	$('.video_upload_server').on("change", function (event) {
		var url_upload = $(this).data('url');
		var input = $(this).data('id');
		var file = event.target.files;
	
		var data = new FormData();
		data.append('video', file[0]);
		data.append('_token', $('meta[name="csrf-token"]').attr('content'));
		
		$.ajax({
			url: url_upload,
			type: 'POST',
			dataType: 'json',
			data: data,
			processData: false, 
			contentType: false, 
			success: function (data, textStatus, jqXHR) {
				if (data.check == 0) {
					swal(data.content, "", "error");
				} else {
					$("#"+input).val(data.content);
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {

			}
		});
	
		$(this).val('');
	});
});