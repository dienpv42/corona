@extends("frontend.hometemplate")


@section('title', 'Admin & Dashboard')
@section('desc', 'Admin & Dashboard')
@section('keyword', 'Admin & Dashboard')

@section("css")
<link href="{{asset('assets/frontend')}}/assets/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{asset('assets/frontend')}}/assets/css/select2.min.css">
<link rel="stylesheet" type="text/css" href="{{asset('assets/frontend')}}/assets/css/select2-bootstrap-5-theme.min.css">
<link rel="stylesheet" type="text/css" href="{{asset('assets/frontend')}}/assets/css/select2-bootstrap-5-theme.rtl.min.css">
<link rel="stylesheet" href="{{asset('assets/frontend')}}/assets/css/plugin-collection.css">
<link rel="stylesheet" href="{{asset('assets/frontend')}}/assets/css/icofont.min.css">
<link rel="stylesheet" href="{{asset('assets/frontend')}}/assets/css/swiper.min.css">
<link rel="stylesheet" href="{{asset('assets/frontend')}}/assets/css/aos.css">
<link rel="stylesheet" href="{{asset('assets/frontend')}}/assets/css/app.css">
<link rel="stylesheet" href="{{asset('assets/frontend')}}/assets/css/dataTables.bootstrap5.min.css">
<style>
.section_head .active{
	background: #EEE;
    color: #2196F3;
}
</style>
@endsection
@section("js")
<script src="{{asset('assets/frontend')}}/assets/js/jquery-main.js"></script>
<script src="{{asset('assets/frontend')}}/assets/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('assets/frontend')}}/assets/js/jquery-migrate.js"></script>
<script src="{{asset('assets/frontend')}}/assets/js/jquery-ui.min.js"></script>
<script src="{{asset('assets/frontend')}}/assets/js/plugincollection.js"></script>
<script src="{{asset('assets/frontend')}}/assets/vendors/apexcharts-bundle/dist/apexcharts.min.js"></script>
<script src="{{asset('assets/frontend')}}/assets/js/select2.full.min.js"></script>
<script src="{{asset('assets/frontend')}}/assets/js/app.js"></script>
<script src="{{asset('assets/frontend')}}/assets/js/admin.js"></script>
<script src="{{asset('assets/frontend')}}/assets/js/jquery.dataTables.min.js"></script>
<script src="{{asset('assets/frontend')}}/assets/js/dataTables.bootstrap5.min.js"></script>
<script>
$('.select2').select2();
$(document).on('click', '.remove_all', function() {
	$("#table_product").html('');
});
$(document).on('click', '.remove_t', function() {
	$(this).parent().parent().remove();
});
$(document).on('click', '.add_product', function() {
	if($("#product_id").val()){
		if($("#tr"+$("#product_id").val()).length === 0){
			var html="<tr id='tr"+$("#product_id").val()+"'><td><input type='hidden' class='list_id' value='"+$("#product_id").val()+"'/>"+$("#product_id option:selected").data('name')+"</td><td><input type='text' class='form-control list_price mask_number' value='"+$("#product_id option:selected").data('price')+"'/></td><td><input type='text' class='form-control list_pricevat mask_number' value='"+$("#product_id option:selected").data('pricevat')+"'/></td><td><input type='text' value='1' min='1' class='form-control list_quantity' onkeypress='return event.charCode >= 48 && event.charCode <= 57'/></td><td><a href='javascript:void(0)' class='remove_t'><i class='icofont-trash'></i></a></td></tr>";
			$("#table_product").append(html);
			$('.mask_number').maskNumber({float:true});
		}else{
			toastr.error('Đã có sản phẩm này', ''); 
		}
	}else{
		toastr.error('Chưa chọn sản phẩm', ''); 
	}
	if($("#table_product > tr").length>0){
		$('#user_id').attr('disabled', 'disabled');
	}
});
$(document).on('change', '#product_id', function() {
	
});
$("#user_id").change(function(){
	if($(this).val()){
		$("#partner").val($("#user_id option:selected").data('partner'));
		$.ajaxSetup({
		  headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		  }
		});
		$.ajax({
			url: "{{route('post-product-order')}}",
			type: 'POST',
			dataType: 'html',
			data: {id:$(this).val()},	
			success: function (msg, textStatus, jqXHR) {
				$("#product_id").html(msg);
			}
		});
	}else{
		$("#partner").val('');
		$("#product_id").html('');
	}
});
$(".add_order").click(function(){
	$.ajaxSetup({
	  headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});
	var list_id=[];
	var list_price=[];
	var list_pricevat=[];
	var list_quantity=[];
	$(".list_id").each(function(){
		list_id.push($(this).val());
	});
	$(".list_price").each(function(){
		list_price.push($(this).val());
	});
	$(".list_pricevat").each(function(){
		list_pricevat.push($(this).val());
	});
	$(".list_quantity").each(function(){
		list_quantity.push($(this).val());
	});
	$.ajax({
		url: "{{route('post-add-order')}}",
		type: 'POST',
		dataType: 'json',
		data: {list_id:list_id,list_price:list_price,list_pricevat:list_pricevat,list_quantity:list_quantity,id:$("#user_id").val()},	
		success: function (msg, textStatus, jqXHR) {
			if(msg.check==0){
				toastr.error(msg.content, ''); 
			}else{				
				toastr.success(msg.content, ''); 
				location.reload();
			}
		}
	});
});

fill_datatable();
$("#filter_status").change(function() {
	$('#partnerTable').DataTable().destroy();
	fill_datatable($("#filter_status").val());

});

function fill_datatable(filter_status = '') {
	var table = $('#partnerTable').DataTable({
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
		},
		"fnDrawCallback": function(oSettings) {
			if (oSettings._iDisplayLength == -1 || oSettings._iDisplayLength > oSettings.fnRecordsDisplay()) {
				$('.dataTables_paginate').hide();
			} else {
				$('.dataTables_paginate').show();
			}

		},
		ajax: {
			url: "{{route('post-data-partner')}}",
			type: "POST",
			data: {
				_token: $('meta[name="csrf-token"]').attr('content'),
				filter_status: filter_status
			}
		},
		"columns": [{
				data: "name"
			},
			{
				data: 'total_product',
				sortable: true
			},
			{
				data: 'total_revenue',
				sortable: true
			},
			{
				data: 'total_customer',
				sortable: true
			},
			{
				"data": null,
				sortable: false,
				"render": function(data, type, row, meta) {					
					return '<a href="javascript:void(0)" class="btn-show-tr"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M10.0003 13.5C9.54495 13.5 9.09018 13.3245 8.74548 12.9798L3.31215 7.54648C3.29062 7.52495 3.27734 7.49422 3.27734 7.45837C3.27734 7.42251 3.29062 7.39178 3.31215 7.37025C3.33367 7.34873 3.36441 7.33545 3.40026 7.33545C3.43611 7.33545 3.46685 7.34873 3.48837 7.37025L8.92171 12.8036C9.51697 13.3988 10.4836 13.3988 11.0788 12.8036L16.5121 7.37025C16.5337 7.34873 16.5644 7.33545 16.6003 7.33545C16.6361 7.33545 16.6668 7.34873 16.6884 7.37025C16.7099 7.39178 16.7232 7.42251 16.7232 7.45837C16.7232 7.49422 16.7099 7.52495 16.6884 7.54648L11.255 12.9798C10.9103 13.3245 10.4556 13.5 10.0003 13.5Z" fill="#6D727B" stroke="#6D727B"/></svg></a>'
					
				}
			}
		],
		"order": [
			[3, "desc"]
		]
	});
	$.fn.dataTable.ext.errMode = 'throw';
	$('#partnerTable tbody').on('click', '.btn-show-tr', function() {
		var tr = $(this).closest('tr');
		var row = table.row( tr );
		var id = row.data().id;
		console.log(row.data().id);
		$('#partnerTable tbody tr.details-row').remove();
		$('#partnerTable tbody tr').removeClass('selected');
		$(this).closest('tr').addClass('selected');
		let detailRow = '<tr class="details-row"><td colspan="5"><div id="productForm" class="wrap_tr_detail wrap_tr_auto flex-p-16"><div class="w_tr_action"><a href="javascript:void(0);" class="lb-xsmall">Doanh thu theo kỳ</a></div><div class="w_tr_action"><a href="javascript:void(0);" class="lb-xsmall">Thống kê sản phẩm được bán</a></div><div class="w_tr_action"><a href="javascript:void(0);" class="lb-xsmall">Thống kê khách hàng đã mua</a></div><div class="w_tr_action"><a href="javascript:void(0);" class="lb-xsmall">Danh sách liên hệ</a></div><div class="w_tr_action_text"><a href="javascript:void(0)" data-id="'+id+'" data-bs-toggle="modal" data-bs-target="#modalEdit" class="lb-text-primary pedit">Chỉnh sửa</a></div></div></td></tr>';
		$(this).closest('tr').after(detailRow);
	});
}

</script>
@endsection

@section("content")
@include('frontend.header_bottom')

<section class="section_data_customer">
	<div class="container-main">
		<div class="section_title d-flex flex-row align-items-center justify-content-between">
			<div class="title">
				<h2>
					{{App\Models\CommonModel::get_lang('setting_navigation1')}}
				</h2>
			</div>
		</div>
		<div class="section_content">
			<div class="wrap_head">
				
				<div class="wrap_content">
					<div class="wrap_form">
						<div class="form-group">
							<div class="form-label">
								{{App\Models\CommonModel::get_lang('setting_order12')}}
							</div>
							<div class="group">
								<select class="form-control select2" id="user_id">
									<option value="">{{App\Models\CommonModel::get_lang('setting_order16')}}</option>
									@if(isset($user) && count($user)>0)
									@foreach($user as $item)
									<option value="{{$item->id}}" data-partner="{{$item->pname}}">{{$item->name}} - {{$item->phone}} - {{$item->code}} - {{$item->pname}}</option>
									@endforeach								
									@endif
								</select>
							</div>
						</div>
						<div class="form-group">
							<div class="form-label">
								{{App\Models\CommonModel::get_lang('setting_order13')}}
							</div>
							<div class="group">
								<input type="text" readonly class="form-control" id="partner">
							</div>
						</div>
						<div class="form-group">
							<div class="form-label">
								{{App\Models\CommonModel::get_lang('setting_order14')}}
							</div>
							<div class="group">
								<select class="form-control select2" id="product_id">
									<option value="">{{App\Models\CommonModel::get_lang('setting_order15')}}</option>
									
								</select>								
							</div>
						</div>
						<div class="form-group">
							<a href="javascript:void(0)" class="lb-xsmall-primary pd-s-100 pd-e-100 mt-5 add_product">Thêm sản phẩm</a>
						</div>
					</div>
					<div class="wrap_table table-scroll table-responsive-lg mt-5">
						<table class="table">
							<thead>
								<tr>
								  <th scope="col">{{App\Models\CommonModel::get_lang('setting_order14')}}</th>
								  <th scope="col">{{App\Models\CommonModel::get_lang('setting_order17')}}</th>
								  <th scope="col">{{App\Models\CommonModel::get_lang('setting_order18')}}</th>
								  <th scope="col">{{App\Models\CommonModel::get_lang('setting_order19')}}</th>
								  <th scope="col">
									<a href="javascript:void(0)" class="btn-action-icon remove_all">
										<i class="icofont-trash"></i>
									</a>
								  </th>
								</tr>
							</thead>
							<tbody id="table_product">
								
							</tbody>
						</table>
					</div>
					<div class="form-group justify-content-end">
						<button type="button" class="lb-xsmall-primary pd-s-100 pd-e-100 add_order">{{App\Models\CommonModel::get_lang('setting_save')}}</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection