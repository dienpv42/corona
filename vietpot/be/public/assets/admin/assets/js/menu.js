function add_menu(form_add) {
    $('#' + form_add).submit(function (e){
	    var postData = $(this).serialize();
	    var formURL = $(this).attr("action");
		$.ajaxSetup({
		  headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		  }
		});
		$.ajax({
            url: formURL,
            type: "POST",
            data: postData,
            success: function (data, textStatus, jqXHR)
            {
                msg = JSON.parse(data);	
				if(msg.check==0){
					swal(msg.content, "", "warning");
				}else{
					$('#content_menu_edit').html(msg.content);
					$('.nestable_menu').nestable({
						maxDepth: 3
					}).on('change', updateOutput);
					$('#' + form_add)[0].reset();
					$('#menu_id_edit').val('');
					swal("Xử lý thành công !", "", "success");
					setTimeout(function(){ location.reload(); }, 1000);
				}
            }
        });
	  	e.preventDefault(); 
		$('#' + form_add).off();
    });
    $('#' + form_add).submit();
}
var updateOutput = function (e){
    var list = e.length ? e : $(e.target);
    var postData = window.JSON.stringify(list.nestable('serialize'));
    var group_id = $('#group_id').val();
    var formURL = $('#action_change').val();
	$.ajaxSetup({
	  headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});
	$.ajax({
		url: formURL,
        type: "POST",
        data: {group_id: group_id, data: postData},
        success: function (data, textStatus, jqXHR)
        {
           //swal("Cập nhật thành công !", "", "success");
        }
    });
}
function edit_menu(id, name, url, acton) {
    $('#menu_id_edit').val(id);
    $('#menu_name').val(name);
    $('#menu_name').focus();
    $('#menu_url').val(url);
}
function delete_menu(id, action, id_return) {
	$.ajaxSetup({
	  headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});
	 $.ajax({
        url: action,
        type: "POST",
        data: {id: id, group_id: $('#group_id').val()},
        success: function (data, textStatus, jqXHR)
        {			
			$('.nestable_menu').nestable({
				maxDepth: 3
			}).on('change', updateOutput);
			
			setTimeout(function(){ location.reload(); }, 1000);
		}
	});
}
$(function () {
    $('.nestable_menu').nestable({
        maxDepth: 3
    }).on('change', updateOutput);
	$('#name_group').change(function (e) {
        var name = $(this).val();
        var id = $('#group_id').val();
        var url = $(this).data('link');
		$.ajaxSetup({
		  headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		  }
		});
        $.ajax({
            url: url,
			type: "POST",
            data: {id: id, name: name},
            success: function (data, textStatus, jqXHR)
            {
				swal("Cập nhật thành công !", "", "success");
            }
        });
    });
});
function addquickmodal(id, id_modal) {  
	$('#' + id).submit(function (e)    {
		$('#' + id_modal).modal('hide');  
		var postData = $(this).serializeArray(); 
		var formURL = $(this).attr("action");    
		$.ajax({     
			url: formURL,       
			type: "POST",            
			data: postData, 
			dataType: 'json',            
			success: function (data, textStatus, jqXHR)     
			{							
				if(data.check==1){				
					$("#"+data.alert).append(data.content);
					
					$("#"+data.fill).append(data.data);
					swal(data.content, "", "success");
				}else if(data.check==0){		
					swal(data.content, "", "error");		
				}else if(data.check=='reload'){	
					setTimeout(function(){ location.reload(); }, 500);
				}				
				if(typeof data.form !== 'undefined'){
					$('#' + data.form)[0].reset();    
				}					
			},                     
		   error: function (jqXHR, textStatus, errorThrown)      
			{                            
			
			}              
		});         
		e.preventDefault(); 
		$('#' + id).off();
	});   
	$('#' + id).submit();
}