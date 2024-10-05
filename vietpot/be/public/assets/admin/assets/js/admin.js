let url_nav = window.location.href;
$('#mainnav .link-nav').each(function () {
	if ($(this).attr('href') === url_nav) {
		$(this).addClass('active');
	}

});
var change_nestable = function (e){   
	if(typeof url_update_position != "undefined"){
		var list = e.length ? e : $(e.target);
	    var postData = window.JSON.stringify(list.nestable('serialize'));
		$.ajaxSetup({
		  headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		  }
		});
		$.ajax({
	        url: url_update_position,
	        type: "POST",
	        data: {data: postData},
	        success: function (data, textStatus, jqXHR)
	        {
				swal({
					title: "Cập nhật!",
					text: "Cập nhật thành công",
					type: "success",
					timer: 1000
					});
			}
		});
	}
}
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
tinymce.init({
	selector: '.tinymce_editor',
	plugins: [
		'advlist autolink lists link charmap print preview hr anchor pagebreak',
		'searchreplace wordcount visualblocks visualchars code fullscreen',
		'insertdatetime nonbreaking save table contextmenu directionality',
		'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc help'
	],
	toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link unlink mybutton',
	toolbar2: 'print preview |forecolor backcolor fontsizeselect emoticons | codesample help',
	image_advtab: true,
	fontsize_formats: "8px 10px 12px 14px 18px 24px 36px 72px",
	convert_urls: false,
	branding: false,
	height: 600,
	language: 'vi_VN',
	setup: function (editor) {
		editor.on('change', function () {
			tinymce.triggerSave();
		});
		var inp = $('<input id="tinymce-uploader' + editor.id + '" type="file" multiple name="pic' + editor.id + '" accept="image/*" style="display:none">');

		var modal_in = $('<div class="modal fade" id="modal_tinymce_edit_image' + editor.id + '" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"><div class="modal-dialog modal-dialog-centered modal-lg" role="document"><div class="modal-content"><div class="modal-header"><h5 class="modal-title" id="exampleModalLongTitle">THÊM SỬA ẢNH</h5><button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close" data-bs-original-title="" title=""></button></div><div class="modal-body">	<div class="m-scrollable" data-scrollbar-shown="true" data-scrollable="true" data-height="300"></div></div><div class="modal-footer"><button type="button" class="btn btn-primary modal_add_image">Thêm ảnh</button></div></div></div></div>');
		$(editor.getElement()).parent().append(inp);
		$(editor.getElement()).parent().append(modal_in);

		$('.modal_add_image').click(function () {
			var this_modal = $(this).closest('#modal_tinymce_edit_image' + editor.id);
			this_modal.find('.image_insert_caption').each(function () {
				var c_img = $(this).find('img').attr('src');
				var c_img_caption = $(this).find('input[name=image_caption]').val();
				var c_img_width = $(this).find('input[name=image_width]').val();
				editor.insertContent('<figure><img width="' + c_img_width + '" class="content-img" src="' + c_img + '"/><figcaption>' + c_img_caption + '</figcaption></figure><p></p>');
			});
			this_modal.find('.m-scrollable').html('');
			this_modal.modal('hide');
		})
		var url_upload = $(editor.getElement()).data('upload-url');
		inp.on("change", function (event) {
			var files = event.target.files;
			if (files.length < 6) {
				var data = new FormData();
				for (var i = 0; i < files.length; i++) {
					var file = files[i];
					if (file.size <= 2048000) {
						data.append('image[]', file);
					}
				}
				data.append('_token', $('meta[name="csrf-token"]').attr('content'));
				if (typeof (url_upload) == "undefined") {
					url_upload = '';
				}
				$('#modal_tinymce_edit_image' + editor.id).find('.m-scrollable').html('');
			
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
							if(data.type=='multi'){
								myarr.forEach(function (entry) {								
									$('#modal_tinymce_edit_image' + editor.id).find('.m-scrollable').append('\
	<div class="image_insert_caption row"><div class="col-xl-3 col-lg-3" style="float: left;">\n\
	<img class="content-img" style="width: 100%;" src="' + entry.image + '"/>\n\
	</div> \n\
	<div class="col-xl-6 col-lg-6" style="float: left;">\n\
	<div class="form-group m-form__group">\n\
	<label for="image_caption' + entry.image + '">Caption</label>\n\
	<input type="text" name="image_caption" class="form-control form-control-sm m-input" id="image_caption' + entry.image + '" aria-describedby="emailHelp" placeholder="Nhập caption">\n\
	</div>\n\
	</div>\n\
	<div class="col-xl-3 col-lg-3" style="float: left;">\n\
	<div class="form-group m-form__group">\n\
	<label for="image_width' + entry.image + '">Rộng</label>\n\
	<input type="text" name="image_width" value="100%" class="form-control form-control-sm m-input" id="image_width' + entry.image + '" aria-describedby="emailHelp" placeholder="Nhập chiều rộng">\n\
	</div>\n\
	</div>\n\
	</div>');
								});
								$('#modal_tinymce_edit_image' + editor.id).modal('show');
							}
						}
					},
					error: function (jqXHR, textStatus, errorThrown) {

					}
				});
			} else {
				swal('Chỉ được tối đa 5 ảnh', "", "error");
			}
		});
		editor.ui.registry.addButton('mybutton', {
			text: 'Thêm ảnh',
			tooltip: 'Chèn ảnh vào nội dung',
			onAction: function (_) {
				inp.val("");
				inp.trigger('click');
			}
		});
	}
});
$(document).ready(function(){
	$('.nestable').nestable({
		maxDepth: 3
	}).on('change', change_nestable);
	if(typeof url_delete != "undefined"){
		$(".delete_row_table").click(function(){
			var this_row = $(this);
			var id = this_row.data('id');	
			$.ajaxSetup({
			  headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			  }
			});
			 $.ajax({
		        url: url_delete,
		        type: "POST",
		        data: {id: id},
		        success: function (data, textStatus, jqXHR)
		        {
					
					this_row.closest('li').remove().fadeOut();
				}
			});			
		});
	}
	$(".btn_upload_multi").click(function (l) {
		$('#file_select_image_multi').trigger('click');
	});
	$('#file_select_image_multi').on("change", function (event) {
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
							$('.image_upload_multi_content').append('<div class="col-12 col-lg-3 image_insert_caption"><img class="content-img" style="width: 100%;" src="' + entry.image + '"><input type="hidden" value="' + entry.image + '" name="image_upload_multi_file[]"><div data-repeater-delete="" class="btn-sm btn btn-danger m-btn m-btn--icon m-btn--pill" onclick="$(this).closest(\'.image_insert_caption\').remove();"><span>Delete</span></div></div>');
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
		var img = $(this).data('img');
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
	
});