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
$(document).on('click', '.order_remove', function() {
	$("#modalConfirm_id").val($(this).data('id'));
	$("#modalConfirm").modal('show');	
});
$(document).on('click', '.btn-remove', function() {
	$.ajaxSetup({
	  headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});
	$.ajax({
		url: "{{route('post-delete-order')}}",
		type: 'POST',
		dataType: 'json',
		data: {id:$("#modalConfirm_id").val()},	
		success: function (msg, textStatus, jqXHR) {
			if(msg.check==0){
				toastr.error(msg.content, ''); 
			}else{
				location.reload();
			}
		}
	});
});
$(document).on('click', '.order_redirect', function() {
	$.ajaxSetup({
	  headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});
	var id=$(this).data('id');
	var type=$(this).data('type');
	$.ajax({
		url: "{{route('post-redirect-order')}}",
		type: 'POST',
		dataType: 'json',
		data: {id:id,type:type},	
		success: function (msg, textStatus, jqXHR) {
			if(msg.check==0){
				toastr.error(msg.content, ''); 
			}else{
				window.location.replace(msg.content);
			}
		}
	});
});
$(document).on('click', '.order_active', function() {
	$.ajaxSetup({
	  headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});
	var id=$(this).data('id');
	$.ajax({
		url: "{{route('post-active-order')}}",
		type: 'POST',
		dataType: 'json',
		data: {id:id},	
		success: function (msg, textStatus, jqXHR) {
			if(msg.check==0){
				toastr.error(msg.content, ''); 
			}else{
				toastr.success(msg.content, ''); 
			}
		}
	});
});
$(document).on('click', '.order_note', function() {
	$.ajaxSetup({
	  headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});
	var id=$(this).data('id');
	if($("#note_order_"+id).val()){
		$.ajax({
			url: "{{route('post-note-order')}}",
			type: 'POST',
			dataType: 'html',
			data: {id:id,value:$("#note_order_"+id).val()},	
			success: function (msg, textStatus, jqXHR) {				
				toastr.success('Đã lưu', ''); 				
			}
		});
	}else{
		toastr.error('Chưa nhập ghi chú', ''); 
	}
});
$(document).on('click', '.edit_order_detail', function() {
	$("#modalEdit_id").val($(this).data('id'));	
	$(".name-data").html($(this).data('name'));
	$("#price").val($(this).data('price'));
	$("#quantity").val($(this).data('quantity'));
	$("#table_id").val($(this).data('tableid'));
	$("#record_id").val($(this).data('recordid'));
	$("#st").prop('checked', false);
});
$(document).on('click', '.btn-save', function() {
	$.ajaxSetup({
	  headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});
	var status=0;
	if($("#st").is(":checked")){
		status=1;
	}
	$.ajax({
		url: "{{route('post-edit-order')}}",
		type: 'POST',
		dataType: 'json',
		data: {id:$("#modalEdit_id").val(),price_no_vat:$("#price").val(),price_vat:$("#price_vat").val(),quantity:$("#quantity").val(),status:status},	
		success: function (msg, textStatus, jqXHR) {
			if(msg.check==0){
				toastr.error(msg.content, ''); 
			}else if(msg.check==1){				
				$('#subtable1-'+$("#record_id").val()).DataTable().destroy();
				sub_DataTable1($("#table_id").val(),$("#record_id").val());
				$("#modalEdit").modal('hide');
			}else{
				$("#modalConfirm_id").val(msg.id);
				$("#modalEdit").modal('hide');
				$("#modalConfirm").modal('show');
			}
		}
	});
});
fill_datatable();

function fill_datatable() {
	var table = $('#orderTable').DataTable({
		"processing": true,
		"serverSide": true,
		"serverPaging": true,
		"serverFiltering": true,
		"serverSorting": true,
		"paging": true,
		"info": false,
		"searching": false,
		"lengthChange":false,
		createdRow: function(row, data, dataIndex) {
			$(row).addClass('table-row');
			$(row).attr('data-id',data.id);
		},
		"fnDrawCallback": function(oSettings) {
			if (oSettings._iDisplayLength == -1 || oSettings._iDisplayLength > oSettings.fnRecordsDisplay()) {
				$('.dataTables_paginate').hide();
			} else {
				$('.dataTables_paginate').show();
			}

		},
		ajax: {
			url: "{{route('post-data-order')}}",
			type: "POST",
			data: {
				_token: $('meta[name="csrf-token"]').attr('content'),filter_status:"<?php echo $s; ?>"
			}
		},
		"columns": [{
				data: "day",sortable: true
			},
			{
				data: 'total_price_no_vat',
				sortable: true
			},
			{
				data: 'total_price_vat',
				sortable: true
			},
			{
				data: 'total_quantity',
				sortable: true
			},
			{
				data: 'total_orders',
				sortable: true
			}
		],
		"order": [
			[0, "desc"]
		]
	});
	$.fn.dataTable.ext.errMode = 'throw';
	$('#orderTable tbody').on('click', 'tr[data-id]', function() {
		var tr = $(this);
		var row = table.row( tr );
		var record_id = $(this).data('id');
		var subtable_id = "subtable-"+record_id;
		$('#orderTable tbody tr.details-row').remove();
		$('#orderTable tbody tr').removeClass('shown selected');
		row.child( format(subtable_id),'details-row' ).show();
		tr.addClass('shown selected');		
		sub_DataTable(subtable_id,record_id);
		
	});
}
function sub_DataTable(table_id,record_id) {
	var subtable = $('table#'+table_id).DataTable({
		"processing": true,
		"serverSide": true,
		"serverPaging": true,
		"serverFiltering": true,
		"serverSorting": true,
		"searching": false,
		"lengthChange": false,
		"paging": true,
		"info": false,	
		createdRow: function(row, data, dataIndex) {
			//console.log(data.tstatus);
			//$(row).addClass('tr-success');
			$(row).attr('data-child-id',data.id);
		},
		ajax:  {
			url: "{{route('post-data_child-order')}}",
			type: "POST",
			data: {_token: $('meta[name="csrf-token"]').attr('content'),id:record_id}
		},	
		"columns": [	
			{ data: "user_name",sortable:false },
			{ data: "admin_name",sortable:false },
			{ data: "total_price_no_vat",sortable:false },
			{ data: "total_price_vat",sortable:true },
			{ data: "total_quantity",sortable:true },
			{ data: "total_products",sortable:true },
			{
				"data": null,
				sortable: false,
				"render": function(data, type, row, meta) {					
					return '<a href="javascript:void(0)" data-id="'+data.id+'" class="btn-action-icon order_remove"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M2.48096 4.85609L2.48119 4.85607L4.18119 4.68941L4.1829 4.68923C8.57083 4.24384 13.0263 4.41614 17.5086 4.85606L17.5089 4.85609C17.5717 4.86222 17.625 4.92242 17.6181 4.99324L17.618 4.99323L17.6172 5.00344C17.613 5.0584 17.5642 5.10846 17.4991 5.10846H17.499H17.4989H17.4988H17.4987H17.4986H17.4985H17.4984H17.4983H17.4982H17.4981H17.498H17.4979H17.4978H17.4977H17.4976H17.4975H17.4974H17.4973H17.4972H17.4971H17.497H17.4969H17.4968H17.4967H17.4966H17.4965H17.4964H17.4963H17.4962H17.4961H17.496H17.4959H17.4958H17.4956H17.4955H17.4954H17.4953H17.4952H17.4951H17.495H17.4949H17.4948H17.4947H17.4946H17.4945H17.4944H17.4943H17.4942H17.4941H17.494H17.4939H17.4937H17.4936H17.4935H17.4934H17.4933H17.4932H17.4931H17.493H17.4929H17.4928H17.4927H17.4926H17.4925H17.4923H17.4922H17.4921H17.492H17.4919H17.4918H17.4917H17.4916H17.4915H17.4914H17.4912H17.4911H17.491H17.4909H17.4908H17.4907H17.4906H17.4905H17.4903H17.4902H17.4901H17.49H17.4899H17.4898H17.4897H17.4896H17.4894H17.4893H17.4892H17.4891H17.489H17.4889H17.4888H17.4886H17.4885H17.4884H17.4883H17.4882H17.4881H17.488H17.4878H17.4877H17.4876H17.4875H17.4874H17.4873H17.4871H17.487H17.4869H17.4868H17.4867H17.4866H17.4864H17.4863H17.4862H17.4861H17.486H17.4859H17.4857H17.4856H17.4855H17.4854H17.4853H17.4851H17.485H17.4849H17.4848H17.4847H17.4845H17.4844H17.4843H17.4842H17.4841H17.4839H17.4838H17.4837H17.4836H17.4835H17.4833H17.4832H17.4831H17.483H17.4829H17.4827H17.4826H17.4825H17.4824H17.4822H17.4821H17.482H17.4819H17.4818H17.4816H17.4815H17.4814H17.4813H17.4811H17.481H17.4809H17.4808H17.4806H17.4805H17.4804H17.4803H17.4801H17.48H17.4799H17.4798H17.4796H17.4795H17.4794H17.4793H17.4791H17.479H17.4789H17.4788H17.4786H17.4785H17.4784H17.4783H17.4781H17.478H17.4779H17.4778H17.4776H17.4775H17.4774H17.4773H17.4771H17.477H17.4769H17.4767H17.4766H17.4765H17.4764H17.4762H17.4761H17.476H17.4758H17.4757H17.4756H17.4755H17.4753H17.4752H17.4751H17.4749H17.4748H17.4747H17.4745H17.4744H17.4743H17.4742H17.474H17.4739H17.4738H17.4736H17.4735H17.4734H17.4732H17.4731H17.473H17.4729H17.4727H17.4726H17.4725H17.4723H17.4722H17.4721H17.4719H17.4718H17.4717H17.4715H17.4714H17.4713H17.4711H17.471H17.4709H17.4707H17.4706H17.4705H17.4703H17.4702H17.4701H17.4699H17.4698H17.4697H17.4695H17.4694H17.4693H17.4691H17.469H17.4689H17.4687H17.4686H17.4685H17.4683H17.4682H17.4681H17.4679H17.4678H17.4677H17.4675H17.4674H17.4672H17.4671H17.467H17.4668H17.4667H17.4666H17.4664H17.4663H17.4662H17.466H17.4659H17.4658H17.4656H17.4655H17.4653H17.4652H17.4651H17.4649H17.4648H17.4647H17.4645H17.4644H17.4642H17.4641H17.464H17.4638H17.4637H17.4636H17.4634H17.4633H17.4631H17.463H17.4629H17.4627H17.4626H17.4625H17.4623H17.4622H17.462H17.4619H17.4618H17.4616H17.4615H17.4613H17.4612H17.4611H17.4609H17.4608H17.4607H17.4605H17.4604H17.4602H17.4601H17.46H17.4598H17.4597H17.4595H17.4594H17.4593H17.4591H17.459H17.4588H17.4587H17.4586H17.4584H17.4583H17.4581H17.458H17.4579H17.4577H17.4576H17.4574H17.4574C13.0385 4.66677 8.61105 4.49896 4.21614 4.94426C4.21587 4.94428 4.2156 4.94431 4.21533 4.94434L2.51834 5.11071C2.51819 5.11072 2.51804 5.11074 2.51789 5.11075C2.43772 5.11816 2.37846 5.06409 2.37182 4.99438C2.36451 4.91765 2.41487 4.86254 2.48096 4.85609Z" fill="#989B9F" stroke="#989B9F"/><path d="M7.06521 4.26674C7.06511 4.26674 7.06502 4.26674 7.06492 4.26673L7.06051 4.26596C7.03138 4.26086 7.00191 4.24322 6.98058 4.21327C6.95948 4.18363 6.9541 4.15312 6.9585 4.128L6.95908 4.12462L7.14241 3.03295L7.14251 3.03234C7.21257 2.612 7.2795 2.26939 7.48901 2.01054C7.67067 1.7861 8.03545 1.54181 8.90765 1.54181H11.091C11.9621 1.54181 12.3296 1.79321 12.5134 2.02408C12.725 2.28985 12.7903 2.63674 12.8558 3.03894L12.8558 3.03894L12.8563 3.0419L13.0397 4.12524L13.0398 4.12596C13.0455 4.15937 13.0374 4.19237 13.0181 4.21952C12.9986 4.24684 12.9736 4.26049 12.9501 4.26401L12.9501 4.26391L12.9402 4.26561C12.9068 4.27131 12.8738 4.26321 12.8466 4.24388C12.8193 4.22443 12.8056 4.19944 12.8021 4.17597L12.8022 4.17596L12.8006 4.16671L12.6177 3.08541L12.6153 3.07109C12.5887 2.90507 12.5612 2.73418 12.5203 2.58961C12.4765 2.43438 12.4026 2.25168 12.2456 2.10096C12.0859 1.9476 11.8934 1.87772 11.7099 1.84255C11.5326 1.80856 11.3259 1.80014 11.0993 1.80014H8.91598C8.6922 1.80014 8.48792 1.80687 8.31391 1.83756C8.1343 1.86923 7.93992 1.93405 7.77743 2.08614C7.61731 2.23601 7.54297 2.41993 7.49891 2.57404C7.45854 2.71526 7.43014 2.88404 7.40217 3.05026C7.40087 3.05797 7.39957 3.06568 7.39827 3.07338L7.20696 4.1547L7.20691 4.15469L7.20576 4.16177C7.19594 4.22236 7.14318 4.26681 7.08265 4.26681L7.06521 4.26674Z" fill="#989B9F" stroke="#989B9F"/><path d="M12.674 18.9585H7.32402C4.41569 18.9585 4.29902 17.3501 4.20735 16.0501L3.66569 7.65846C3.64069 7.31679 3.90735 7.01679 4.24902 6.99179C4.59902 6.97512 4.89069 7.23346 4.91569 7.57512L5.45735 15.9668C5.54902 17.2335 5.58235 17.7085 7.32402 17.7085H12.674C14.424 17.7085 14.4574 17.2335 14.5407 15.9668L15.0824 7.57512C15.1074 7.23346 15.4074 6.97512 15.749 6.99179C16.0907 7.01679 16.3574 7.30846 16.3324 7.65846L15.7907 16.0501C15.699 17.3501 15.5824 18.9585 12.674 18.9585Z" fill="#989B9F"/><path d="M11.3844 14.3751H8.60938C8.26771 14.3751 7.98438 14.0918 7.98438 13.7501C7.98438 13.4085 8.26771 13.1251 8.60938 13.1251H11.3844C11.726 13.1251 12.0094 13.4085 12.0094 13.7501C12.0094 14.0918 11.726 14.3751 11.3844 14.3751Z" fill="#989B9F"/><path d="M12.0846 11.0418H7.91797C7.5763 11.0418 7.29297 10.7585 7.29297 10.4168C7.29297 10.0751 7.5763 9.79181 7.91797 9.79181H12.0846C12.4263 9.79181 12.7096 10.0751 12.7096 10.4168C12.7096 10.7585 12.4263 11.0418 12.0846 11.0418Z" fill="#989B9F"/></svg></a>'
					
				}
			}
		],
		"order": [[5, "desc" ]]
	});
	$(subtable.table().container()).addClass('wrap_table_detail');
	$(subtable.table().body() )
		.addClass( 'table-detail-body' );
	$('table#'+table_id).on('click', 'tr[data-child-id]', function() {
		var tr = $(this);
		var row = subtable.row( tr );
		var record_id = $(this).data('child-id');
		var subtable_id = "subtable1-"+record_id;
		$('#'+table_id+' tbody tr.details-row').remove();
		$('#'+table_id+' tbody tr').removeClass('shown selected tr-success');
		row.child( format1(subtable_id),'details-row details-row-1 tr-success' ).show();
		tr.addClass('shown selected tr-success');		
		sub_DataTable1(subtable_id,record_id);
		
	});
}
function format(table_id) {
	return '<table id="'+table_id+'" class="table">'+
	'<thead>'+
	'<th>{{App\Models\CommonModel::get_lang("setting_order33")}}</th>'+
	'<th>{{App\Models\CommonModel::get_lang("setting_order32")}}</th>'+
	'<th>{{App\Models\CommonModel::get_lang("setting_order17")}}</th>'+
	'<th>{{App\Models\CommonModel::get_lang("setting_order18")}}</th>'+
	'<th>{{App\Models\CommonModel::get_lang("setting_order19")}}</th>'+
	'<th>{{App\Models\CommonModel::get_lang("setting_order31")}}</th>'+
	'<th></th>'+
	'</thead>'+
	'</table>';	
}

function sub_DataTable1(table_id,record_id) {
	
	var subtable1 = $('table#'+table_id).DataTable({
		"processing": true,
		"serverSide": true,
		"serverPaging": true,
		"serverFiltering": true,
		"serverSorting": true,
		"searching": false,
		"lengthChange": false,
		"paging": false,
		"info": false,			
		ajax:  {
			url: "{{route('post-data_child_detail-order')}}",
			type: "POST",
			data: {_token: $('meta[name="csrf-token"]').attr('content'),id:record_id}
		},	
		dom: '<"top"i>rCt<"footertable">',
		fnFooterCallback: function(nRow, aaData, iStart, iEnd, aiDisplay) {
			var api = this.api();	
			$('.footertable').html(api.ajax.json().html);
		},
		"columns": [	
			{
				"data": null,
				sortable: false,
				"render": function(data, type, row, meta) {					
					return data.status
					
				}
			},
			{ data: "name",sortable:false },
			{ data: "code",sortable:false },
			{ data: "unit",sortable:true },
			{ data: "price_no_vat",sortable:true },
			{ data: "price_vat",sortable:true },
			{ data: "quantity",sortable:true },
			{
				"data": null,
				sortable: false,
				"render": function(data, type, row, meta) {					
					return '<a href="javascript:void(0)" data-tableid="'+table_id+'" data-recordid="'+record_id+'" data-name="'+data.name+'" data-quantity="'+data.quantity+'" data-price="'+data.price_no_vat+'" data-pricevat="'+data.price_vat+'" data-id="'+data.id+'" class="btn-action-icon edit_order_detail" data-bs-toggle="modal" data-bs-target="#modalEdit"><img src="/assets/frontend/assets/images/icon/setting-success.png" alt=""></a>'
					
				}
			}
		],
		"order": [[5, "desc" ]]
	});
	
	$(subtable1.table().container()).addClass('wrap_table_detail');
	$(subtable1.table().body() )
		.addClass( 'table-detail-body' );
}
function format1(table_id) {
	return '<table id="'+table_id+'" class="table">'+
	'<thead>'+
	'<th style="width: 52px"></th>'+
	'<th style="width: 160px">{{App\Models\CommonModel::get_lang("setting_product1")}}</th>'+
	'<th style="width: 160px">{{App\Models\CommonModel::get_lang("setting_product2")}}</th>'+
	'<th style="width: 160px">{{App\Models\CommonModel::get_lang("setting_product3")}}</th>'+
	'<th style="width: 160px">{{App\Models\CommonModel::get_lang("setting_order17")}}</th>'+
	'<th style="width: 160px">{{App\Models\CommonModel::get_lang("setting_order18")}}</th>'+
	'<th style="width: 160px">{{App\Models\CommonModel::get_lang("setting_order19")}}</th>'+
	'<th style="width: 52px"></th>'+
	'</thead>'+
	'</table>';	
}
</script>
@endsection

@section("content")
@include('admin.header_bottom')
<!-- confirm khi xoa don hang -->
<div class="modal fade modal-custom" id="modalConfirm" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Thông báo</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
					<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
						<path d="M9.99935 18.4583C5.33383 18.4583 1.54102 14.6655 1.54102 9.99996C1.54102 5.33444 5.33383 1.54163 9.99935 1.54163C14.6649 1.54163 18.4577 5.33444 18.4577 9.99996C18.4577 14.6655 14.6649 18.4583 9.99935 18.4583ZM9.99935 1.79163C5.47321 1.79163 1.79102 5.47382 1.79102 9.99996C1.79102 14.5261 5.47321 18.2083 9.99935 18.2083C14.5255 18.2083 18.2077 14.5261 18.2077 9.99996C18.2077 5.47382 14.5255 1.79163 9.99935 1.79163Z"
							  fill="#6D727B" stroke="#6D727B"/>
						<path d="M7.72861 12.4465L7.72251 12.4526L7.71663 12.4589C7.71335 12.4624 7.70628 12.4684 7.69236 12.4739C7.67775 12.4797 7.65941 12.4834 7.64049 12.4834C7.62281 12.4834 7.60729 12.4802 7.59397 12.4748C7.58111 12.4696 7.56706 12.4612 7.55238 12.4465C7.53085 12.425 7.51758 12.3942 7.51758 12.3584C7.51758 12.3225 7.53085 12.2918 7.55238 12.2703L7.19883 11.9167L7.55238 12.2703L12.269 7.5536L11.9191 7.20369L12.269 7.5536C12.2906 7.53208 12.3213 7.5188 12.3572 7.5188C12.393 7.5188 12.4237 7.53208 12.4453 7.5536C12.4668 7.57513 12.4801 7.60586 12.4801 7.64172C12.4801 7.67757 12.4668 7.7083 12.4453 7.72983L7.72861 12.4465Z"
							  fill="#6D727B" stroke="#6D727B"/>
						<path d="M12.3572 12.9834C12.1988 12.9834 12.0405 12.925 11.9155 12.8L7.19883 8.08338C6.95716 7.84172 6.95716 7.44172 7.19883 7.20005C7.44049 6.95838 7.84049 6.95838 8.08216 7.20005L12.7988 11.9167C13.0405 12.1584 13.0405 12.5584 12.7988 12.8C12.6738 12.925 12.5155 12.9834 12.3572 12.9834Z"
							  fill="#6D727B"/>
					</svg>
				</button>
			</div>
			<div class="modal-body">
				<input type="hidden" id="modalConfirm_id"/>
				<div class="wrap_confirm">
					Bạn đang thao tác xoá toàn bộ đơn hàng!
				</div>
			</div>
			<div class="modal-footer modal-footer-flex-1">
				<button type="button" class="lb-xsmall" data-bs-dismiss="modal">Huỷ</button>
				<button type="button" class="lb-xsmall-primary btn-remove">Tiếp tục</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade modal-custom" id="modalEdit" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Chỉnh sửa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path d="M9.99935 18.4583C5.33383 18.4583 1.54102 14.6655 1.54102 9.99996C1.54102 5.33444 5.33383 1.54163 9.99935 1.54163C14.6649 1.54163 18.4577 5.33444 18.4577 9.99996C18.4577 14.6655 14.6649 18.4583 9.99935 18.4583ZM9.99935 1.79163C5.47321 1.79163 1.79102 5.47382 1.79102 9.99996C1.79102 14.5261 5.47321 18.2083 9.99935 18.2083C14.5255 18.2083 18.2077 14.5261 18.2077 9.99996C18.2077 5.47382 14.5255 1.79163 9.99935 1.79163Z"
                                  fill="#6D727B" stroke="#6D727B"/>
                            <path d="M7.72861 12.4465L7.72251 12.4526L7.71663 12.4589C7.71335 12.4624 7.70628 12.4684 7.69236 12.4739C7.67775 12.4797 7.65941 12.4834 7.64049 12.4834C7.62281 12.4834 7.60729 12.4802 7.59397 12.4748C7.58111 12.4696 7.56706 12.4612 7.55238 12.4465C7.53085 12.425 7.51758 12.3942 7.51758 12.3584C7.51758 12.3225 7.53085 12.2918 7.55238 12.2703L7.19883 11.9167L7.55238 12.2703L12.269 7.5536L11.9191 7.20369L12.269 7.5536C12.2906 7.53208 12.3213 7.5188 12.3572 7.5188C12.393 7.5188 12.4237 7.53208 12.4453 7.5536C12.4668 7.57513 12.4801 7.60586 12.4801 7.64172C12.4801 7.67757 12.4668 7.7083 12.4453 7.72983L7.72861 12.4465Z"
                                  fill="#6D727B" stroke="#6D727B"/>
                            <path d="M12.3572 12.9834C12.1988 12.9834 12.0405 12.925 11.9155 12.8L7.19883 8.08338C6.95716 7.84172 6.95716 7.44172 7.19883 7.20005C7.44049 6.95838 7.84049 6.95838 8.08216 7.20005L12.7988 11.9167C13.0405 12.1584 13.0405 12.5584 12.7988 12.8C12.6738 12.925 12.5155 12.9834 12.3572 12.9834Z"
                                  fill="#6D727B"/>
                        </svg>
                    </button>
                </div>
				<input type="hidden" id="modalEdit_id"/>
				<input type="hidden" id="table_id"/>
				<input type="hidden" id="record_id"/>
                <div class="modal-body">
                    <div class="wrap_form_modal">
                        <div class="form-group">
                            <div class="form-label">
                                Tên sản phẩm
                            </div>
                            <div class="group">
                                <div class="text-data name-data">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-label">
                               Sửa giá
                            </div>
                            <div class="group">
                                <input type="text" id="price" class="form-control mask_number" value="0">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-label">
                                Sửa số lượng
                            </div>
                            <div class="group">
                                <input type="text" id="quantity" class="form-control" value="1" min="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="st">
                                <label class="form-check-label" for="st">
                                    Bỏ sản phẩm ra khỏi đơn
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer modal-footer-flex-1">
                    <button type="button" class="lb-xsmall" data-bs-dismiss="modal">Hủy</button>
                    <button type="button" class="lb-xsmall-primary btn-save">{{App\Models\CommonModel::get_lang('setting_save')}}</button>
                </div>
            </div>
        </div>
    </div>
<section class="section_data_customer">
	<div class="container-main">
		<div class="section_title d-flex flex-row align-items-center justify-content-between">
			<div class="title">
				<h2>
					{{App\Models\CommonModel::get_lang('setting_order1')}}
				</h2>
			</div>
			<div class="wrap_list_action_flex">
				<a href="#" class="lb-xxsmall">
					<span>{{App\Models\CommonModel::get_lang('setting_order2')}}</span>
				</a>
				<a href="#" class="lb-xxsmall">
					<span>{{App\Models\CommonModel::get_lang('setting_order3')}}</span>
				</a>
				<a href="#" class="lb-xxsmall">
					<span>{{App\Models\CommonModel::get_lang('setting_order4')}}</span>
				</a>
			</div>
		</div>
		<div class="section_content">
			<div class="wrap_head">
				<div class="wrap_list_link_lb">
					<ul class="list_link_lb">
						<li class="list_link_item list_link_item_auto">
							<a href="{{route('view-order')}}" class="lb-xsmall lb-link">
								{{App\Models\CommonModel::get_lang('setting_order5')}}
							</a>
						</li>
						<li class="list_link_item list_link_item_auto">
							<a href="{{route('view-order',0)}}" class="lb-xsmall lb-link">
								{{App\Models\CommonModel::get_lang('setting_order6')}}
							</a>
						</li>
						<li class="list_link_item list_link_item_auto">
							<a href="{{route('view-order',2)}}" class="lb-xsmall lb-link">
								{{App\Models\CommonModel::get_lang('setting_order7')}}
							</a>
						</li>
					</ul>
				</div>
				<div class="wrap_content">
					<div class="wrap_table table-responsive-lg">
						<table id="orderTable" class="table">
							<thead>
								<tr>
									<th scope="col">{{App\Models\CommonModel::get_lang('setting_order29')}}</th>
                                    <th scope="col">{{App\Models\CommonModel::get_lang('setting_order8')}}</th>
                                    <th scope="col">{{App\Models\CommonModel::get_lang('setting_order9')}}</th>
                                    <th scope="col">{{App\Models\CommonModel::get_lang('setting_order10')}}</th>
                                    <th scope="col">{{App\Models\CommonModel::get_lang('setting_order11')}}</th>
								</tr>
							</thead>
							<tbody>	
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection