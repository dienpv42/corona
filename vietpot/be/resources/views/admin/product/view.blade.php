@extends("frontend.hometemplate")


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
<style>
.dropdown-vat .active{
	color:#2196F3;
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
<script src="{{asset('assets/frontend')}}/assets/js/app.js"></script>
<script src="{{asset('assets/frontend')}}/assets/js/admin.js"></script>
<script src="{{asset('assets/frontend')}}/assets/js/jquery.dataTables.min.js"></script>
<script src="{{asset('assets/frontend')}}/assets/js/dataTables.bootstrap5.min.js"></script>
<script>
$(".dropdown-vat").click(function(){
	$(".dropdown-vat").removeClass('active');
	$(this).addClass('active');
	$("#"+$(this).data('id')).val($(this).data('value'));
});
$(document).on('click', '.history', function() {
	var id=$(this).data('id');
	$.ajaxSetup({
	  headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});
	$.ajax({
		url: "{{route('post-product_history-product')}}",
		type: 'POST',
		dataType: 'html',
		data: {id:id,type:$(this).data('type')},	
		success: function (msg, textStatus, jqXHR) {
			$("#table_history").html(msg);
		}
	});
});
$(document).on('click', '.product_note', function() {
	var id=$(this).data('id');
	$.ajaxSetup({
	  headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});
	$.ajax({
		url: "{{route('post-product_note-product')}}",
		type: 'POST',
		dataType: 'json',
		data: {id:id,value:$(".note_"+id).val()},	
		success: function (msg, textStatus, jqXHR) {
			if(msg.check==0){
				toastr.error(msg.content, ''); 
			}else{				
				toastr.success(msg.content, ''); 
			}
		}
	});
});
$(document).on('click', '.pedit', function() {
	$("#eid").val($(this).data('id'));
	$.ajaxSetup({
	  headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});
	$.ajax({
		url: "{{route('edit-product')}}",
		type: 'POST',
		dataType: 'json',
		data: {id:$(this).data('id')},	
		success: function (msg, textStatus, jqXHR) {
			$("#ename").val(msg.name);
			$("#eunit").val(msg.unit);
			$("#eavatar").val(msg.avatar);
			$("#img_eavatar").attr('src',msg.avatar);
			$("#evat").val(msg.vat);
			$("#eprice_no_vat").val(msg.price_no_vat);
			$("#epartner_id").val(msg.partner_id);
			$("#ecate_id").val(msg.cate_id);
			$("#estatus").val(msg.status);
		}
	});
});
$(".btn-edit").click(function(){
	$.ajaxSetup({
	  headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});
	$.ajax({
		url: "{{route('post-edit-product')}}",
		type: 'POST',
		dataType: 'json',
		data: {id:$("#eid").val(),name:$("#ename").val(),status:$("#estatus").val(),unit:$("#eunit").val(),avatar:$("#eavatar").val(),vat:$("#evat").val(),price_no_vat:$("#eprice_no_vat").val(),partner_id:$("#epartner_id").val(),cate_id:$("#ecate_id").val()},	
		success: function (msg, textStatus, jqXHR) {
			if(msg.check==0){
				toastr.error(msg.content, ''); 
			}else{				
				location.reload();
			}
		}
	});
});
$(".btn-add").click(function(){
	$.ajaxSetup({
	  headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});
	$.ajax({
		url: "{{route('post-add-product')}}",
		type: 'POST',
		dataType: 'json',
		data: {name:$("#name").val(),code:$("#code").val(),status:$("#status").val(),avatar:$("#avatar").val(),unit:$("#unit").val(),price_no_vat:$("#price_no_vat").val(),vat:$("#vat").val(),cate_id:$("#cate_id").val(),partner_id:$("#partner_id").val()},	
		success: function (msg, textStatus, jqXHR) {
			if(msg.check==0){
				toastr.error(msg.content, ''); 
			}else{				
				location.reload();
			}
		}
	});
});
fill_datatable();
$(".filter_partner").click(function() {
	var filter_partner=[];
	$('.filter_partner:checked').each(function() {
		filter_partner.push($(this).val());
	});
	$('#partnerTable').DataTable().destroy();
	fill_datatable(filter_partner);

});

function fill_datatable(filter_partner = []) {
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
			url: "{{route('post-data-product')}}",
			type: "POST",
			data: {
				_token: $('meta[name="csrf-token"]').attr('content'),
				filter_partner: filter_partner
			}
		},
		"columns": [{
				data: "pname",
				sortable: false
			},
			{
				data: 'number',
				sortable: true
			},
			{
				data: 'name',
				sortable: true
			},
			{
				data: 'code',
				sortable: true
			},{
				data: 'unit',
				sortable: false
			},{
				data: 'price_no_vat',
				sortable: true
			},{
				data: 'price_vat',
				sortable: true
			},
			{
				"data": null,
				sortable: false,
				"render": function(data, type, row, meta) {					
					return data.status+'<br/><a href="javascript:void(0)" class="btn-show-tr"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M10.0003 13.5C9.54495 13.5 9.09018 13.3245 8.74548 12.9798L3.31215 7.54648C3.29062 7.52495 3.27734 7.49422 3.27734 7.45837C3.27734 7.42251 3.29062 7.39178 3.31215 7.37025C3.33367 7.34873 3.36441 7.33545 3.40026 7.33545C3.43611 7.33545 3.46685 7.34873 3.48837 7.37025L8.92171 12.8036C9.51697 13.3988 10.4836 13.3988 11.0788 12.8036L16.5121 7.37025C16.5337 7.34873 16.5644 7.33545 16.6003 7.33545C16.6361 7.33545 16.6668 7.34873 16.6884 7.37025C16.7099 7.39178 16.7232 7.42251 16.7232 7.45837C16.7232 7.49422 16.7099 7.52495 16.6884 7.54648L11.255 12.9798C10.9103 13.3245 10.4556 13.5 10.0003 13.5Z" fill="#6D727B" stroke="#6D727B"/></svg></a>'
					
				}
			}
		],
		"order": [
			[6, "desc"]
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
		let detailRow = '<tr class="details-row"><td colspan="8"><div id="productForm" class="wrap_tr_detail flex-p-16 wrap_tr_detail_4"><div class="w_tr_action"><a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#modalHistory" data-id="'+id+'" class="lb-xsmall history" data-type="price_no_vat">Lịch sử giá</a></div><div class="w_tr_action"><a href="javascript:void(0);" class="lb-xsmall">Thống kê</a></div><div class="form-group d-flex flex-row align-items-center tr_item_4"><div class="form-label">Ghi chú</div><div class="group_input_btn"><input type="text" class="form-control note_'+id+'" placeholder="Nhập ghi chú"><a href="javascript:void(0)" data-id="'+id+'" class="lb-xxsmall-primary product_note">Nhớ ghi chú</a></div></div><div class="w_tr_action_text"><a href="javascript:void(0)" data-id="'+id+'" data-bs-toggle="modal" data-bs-target="#modalEdit" class="lb-text-primary pedit">Chỉnh sửa</a></div></div></td></tr>';
		$(this).closest('tr').after(detailRow);
	});
}

</script>
@endsection

@section("content")
@include('frontend.header_bottom')
<div class="modal fade modal-custom" id="modalHistory" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Lịch sử giá</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M9.99935 18.4583C5.33383 18.4583 1.54102 14.6655 1.54102 9.99996C1.54102 5.33444 5.33383 1.54163 9.99935 1.54163C14.6649 1.54163 18.4577 5.33444 18.4577 9.99996C18.4577 14.6655 14.6649 18.4583 9.99935 18.4583ZM9.99935 1.79163C5.47321 1.79163 1.79102 5.47382 1.79102 9.99996C1.79102 14.5261 5.47321 18.2083 9.99935 18.2083C14.5255 18.2083 18.2077 14.5261 18.2077 9.99996C18.2077 5.47382 14.5255 1.79163 9.99935 1.79163Z" fill="#6D727B" stroke="#6D727B"/>
                        <path d="M7.72861 12.4465L7.72251 12.4526L7.71663 12.4589C7.71335 12.4624 7.70628 12.4684 7.69236 12.4739C7.67775 12.4797 7.65941 12.4834 7.64049 12.4834C7.62281 12.4834 7.60729 12.4802 7.59397 12.4748C7.58111 12.4696 7.56706 12.4612 7.55238 12.4465C7.53085 12.425 7.51758 12.3942 7.51758 12.3584C7.51758 12.3225 7.53085 12.2918 7.55238 12.2703L7.19883 11.9167L7.55238 12.2703L12.269 7.5536L11.9191 7.20369L12.269 7.5536C12.2906 7.53208 12.3213 7.5188 12.3572 7.5188C12.393 7.5188 12.4237 7.53208 12.4453 7.5536C12.4668 7.57513 12.4801 7.60586 12.4801 7.64172C12.4801 7.67757 12.4668 7.7083 12.4453 7.72983L7.72861 12.4465Z" fill="#6D727B" stroke="#6D727B"/>
                        <path d="M12.3572 12.9834C12.1988 12.9834 12.0405 12.925 11.9155 12.8L7.19883 8.08338C6.95716 7.84172 6.95716 7.44172 7.19883 7.20005C7.44049 6.95838 7.84049 6.95838 8.08216 7.20005L12.7988 11.9167C13.0405 12.1584 13.0405 12.5584 12.7988 12.8C12.6738 12.925 12.5155 12.9834 12.3572 12.9834Z" fill="#6D727B"/>
                    </svg>
                </button>
            </div>
            <div class="modal-body">
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
							  <th scope="col">Người sửa</th>
							  <th scope="col">Chi tiết</th>
							  <th scope="col">Thời gian</th>
							</tr>
						</thead>
						<tbody id="table_history">
							<tr>
							  <th scope="row">1</th>
							  <td>Mark</td>
							  <td>Otto</td>
							</tr>
							
						</tbody>
					</table>
				</div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade modal-custom" id="modalEdit" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{App\Models\CommonModel::get_lang('setting_edit')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M9.99935 18.4583C5.33383 18.4583 1.54102 14.6655 1.54102 9.99996C1.54102 5.33444 5.33383 1.54163 9.99935 1.54163C14.6649 1.54163 18.4577 5.33444 18.4577 9.99996C18.4577 14.6655 14.6649 18.4583 9.99935 18.4583ZM9.99935 1.79163C5.47321 1.79163 1.79102 5.47382 1.79102 9.99996C1.79102 14.5261 5.47321 18.2083 9.99935 18.2083C14.5255 18.2083 18.2077 14.5261 18.2077 9.99996C18.2077 5.47382 14.5255 1.79163 9.99935 1.79163Z" fill="#6D727B" stroke="#6D727B"/>
                        <path d="M7.72861 12.4465L7.72251 12.4526L7.71663 12.4589C7.71335 12.4624 7.70628 12.4684 7.69236 12.4739C7.67775 12.4797 7.65941 12.4834 7.64049 12.4834C7.62281 12.4834 7.60729 12.4802 7.59397 12.4748C7.58111 12.4696 7.56706 12.4612 7.55238 12.4465C7.53085 12.425 7.51758 12.3942 7.51758 12.3584C7.51758 12.3225 7.53085 12.2918 7.55238 12.2703L7.19883 11.9167L7.55238 12.2703L12.269 7.5536L11.9191 7.20369L12.269 7.5536C12.2906 7.53208 12.3213 7.5188 12.3572 7.5188C12.393 7.5188 12.4237 7.53208 12.4453 7.5536C12.4668 7.57513 12.4801 7.60586 12.4801 7.64172C12.4801 7.67757 12.4668 7.7083 12.4453 7.72983L7.72861 12.4465Z" fill="#6D727B" stroke="#6D727B"/>
                        <path d="M12.3572 12.9834C12.1988 12.9834 12.0405 12.925 11.9155 12.8L7.19883 8.08338C6.95716 7.84172 6.95716 7.44172 7.19883 7.20005C7.44049 6.95838 7.84049 6.95838 8.08216 7.20005L12.7988 11.9167C13.0405 12.1584 13.0405 12.5584 12.7988 12.8C12.6738 12.925 12.5155 12.9834 12.3572 12.9834Z" fill="#6D727B"/>
                    </svg>
                </button>
            </div>
            <div class="modal-body">
				<input type="hidden" id="eid"/>
                <div class="wrap_form_modal">
                    <div class="form-group">
                        <div class="form-label">
                            Ảnh <img src="" width="100px" id="img_eavatar"/>
                        </div>
                        <div class="group">
							<input style="display:none" class="form-control file_upload_server_custom" id="label_eavatar" type="file" data-img="img_eavatar" data-id="eavatar" data-url="{{route('dashboard-upload-one')}}" accept="image/*">
							<div class="input-group"><label style="margin-bottom:0px;" class="input-group-text" for="label_eavatar"><i class="icofont-image"></i></label>
								{{Form::text('avatar','',array('class'=>'form-control input-group-air ','id'=>'eavatar'))}}
							</div>
						</div>
                    </div>
                    <div class="form-group">
                        <div class="form-label">
                            Nhóm sản phẩm
                        </div>
                        <div class="group">
                            <select class="form-control" id="ecate_id">
								@if(isset($category) && count($category)>0)
								@foreach($category as $item)
								<option value="{{$item->category_id}}">{{$item->name}}</option>
								@endforeach								
								@endif
							</select>
                        </div>
                    </div>
					<div class="form-group">
                        <div class="form-label">
                            Hãng
                        </div>
                        <div class="group">
                            <select class="form-control" id="epartner_id">
								@if(isset($partner) && count($partner)>0)
								@foreach($partner as $item)
								<option value="{{$item->partner_id}}">{{$item->name}}</option>
								@endforeach								
								@endif
							</select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-label">
                            Tên sản phẩm
                        </div>
                        <div class="group">
                            <input type="text" class="form-control" id="ename">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-label">
                           Số lượng/bịch/palet
                        </div>
                        <div class="group">
							<input type="text" class="form-control" id="eunit">
                        </div>
                    </div>   
					<div class="form-group">
                        <div class="form-label">
                            Giá chưa thuế
                        </div>
                        <div class="input-group">
                            <input type="text" class="form-control mask_number" id="eprice_no_vat" value="0" aria-label="Text input with dropdown button">
							<input type="number" class="form-control" id="evat" value="0"/>
                            <button class="btn dropdown-toggle text-vat" type="button" data-bs-toggle="dropdown" aria-expanded="false">% thuế</button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item dropdown-vat" data-id="evat" href="javascript:void(0)" data-value="7">7%</a></li>
                                <li><a class="dropdown-item dropdown-vat" data-id="evat" href="javascript:void(0)" data-value="19">19%</a></li>
                                <li><a class="dropdown-item dropdown-vat" data-id="evat" href="javascript:void(0)" data-value="0">Khác</a></li>
                            </ul>
                        </div>
                    </div>   
					<div class="form-group">
                        <div class="form-label">
                            Trạng thái
                        </div>
                        <div class="group">
                            <select class="form-control" id="estatus">								
								<option value="0">Sản phẩm mới</option>					
								<option value="1">Đang vận hành</option>				
								<option value="2">Ngừng bán</option>				
							</select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="lb-xsmall-primary pd-s-100 pd-e-100 btn-edit">{{App\Models\CommonModel::get_lang('setting_save')}}</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade modal-custom" id="modalAdd" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{App\Models\CommonModel::get_lang('setting_add')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M9.99935 18.4583C5.33383 18.4583 1.54102 14.6655 1.54102 9.99996C1.54102 5.33444 5.33383 1.54163 9.99935 1.54163C14.6649 1.54163 18.4577 5.33444 18.4577 9.99996C18.4577 14.6655 14.6649 18.4583 9.99935 18.4583ZM9.99935 1.79163C5.47321 1.79163 1.79102 5.47382 1.79102 9.99996C1.79102 14.5261 5.47321 18.2083 9.99935 18.2083C14.5255 18.2083 18.2077 14.5261 18.2077 9.99996C18.2077 5.47382 14.5255 1.79163 9.99935 1.79163Z" fill="#6D727B" stroke="#6D727B"/>
                        <path d="M7.72861 12.4465L7.72251 12.4526L7.71663 12.4589C7.71335 12.4624 7.70628 12.4684 7.69236 12.4739C7.67775 12.4797 7.65941 12.4834 7.64049 12.4834C7.62281 12.4834 7.60729 12.4802 7.59397 12.4748C7.58111 12.4696 7.56706 12.4612 7.55238 12.4465C7.53085 12.425 7.51758 12.3942 7.51758 12.3584C7.51758 12.3225 7.53085 12.2918 7.55238 12.2703L7.19883 11.9167L7.55238 12.2703L12.269 7.5536L11.9191 7.20369L12.269 7.5536C12.2906 7.53208 12.3213 7.5188 12.3572 7.5188C12.393 7.5188 12.4237 7.53208 12.4453 7.5536C12.4668 7.57513 12.4801 7.60586 12.4801 7.64172C12.4801 7.67757 12.4668 7.7083 12.4453 7.72983L7.72861 12.4465Z" fill="#6D727B" stroke="#6D727B"/>
                        <path d="M12.3572 12.9834C12.1988 12.9834 12.0405 12.925 11.9155 12.8L7.19883 8.08338C6.95716 7.84172 6.95716 7.44172 7.19883 7.20005C7.44049 6.95838 7.84049 6.95838 8.08216 7.20005L12.7988 11.9167C13.0405 12.1584 13.0405 12.5584 12.7988 12.8C12.6738 12.925 12.5155 12.9834 12.3572 12.9834Z" fill="#6D727B"/>
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <div class="wrap_form_modal">
                    <div class="form-group">
                        <div class="form-label">
                            Ảnh <img src="" width="100px" id="img_avatar"/>
                        </div>
                        <div class="group">
							<input style="display:none" class="form-control file_upload_server_custom" id="label_avatar" type="file" data-img="img_avatar" data-id="avatar" data-url="{{route('dashboard-upload-one')}}" accept="image/*">
							<div class="input-group"><label style="margin-bottom:0px;" class="input-group-text" for="label_avatar"><i class="icofont-image"></i></label>
								{{Form::text('avatar','',array('class'=>'form-control input-group-air ','id'=>'avatar'))}}
							</div>
						</div>
                    </div>
					<div class="form-group">
                        <div class="form-label">
                            Nhóm sản phẩm
                        </div>
                        <div class="group">
                            <select class="form-control" id="cate_id">
								@if(isset($category) && count($category)>0)
								@foreach($category as $item)
								<option value="{{$item->category_id}}">{{$item->name}}</option>
								@endforeach								
								@endif
							</select>
                        </div>
                    </div>
					<div class="form-group">
                        <div class="form-label">
                            Hãng
                        </div>
                        <div class="group">
                            <select class="form-control" id="partner_id">
								@if(isset($partner) && count($partner)>0)
								@foreach($partner as $item)
								<option value="{{$item->partner_id}}">{{$item->name}}</option>
								@endforeach								
								@endif
							</select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-label">
                            Tên sản phẩm
                        </div>
                        <div class="group">
                            <input type="text" class="form-control" id="name">
                        </div>
                    </div>
					<div class="form-group">
                        <div class="form-label">
                            Mã sản phẩm
                        </div>
                        <div class="group">
                            <input type="text" class="form-control" id="code">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-label">
                           Số lượng/bịch/palet
                        </div>
                        <div class="group">
							<input type="text" class="form-control" id="unit">
                        </div>
                    </div>   
					<div class="form-group">
                        <div class="form-label">
                            Giá chưa thuế
                        </div>
                        <div class="input-group">
                            <input type="text" class="form-control mask_number" id="price_no_vat" value="0" aria-label="Text input with dropdown button">
							<input type="number" class="form-control" id="vat" value="0"/>
                            <button class="btn dropdown-toggle text-vat" type="button" data-bs-toggle="dropdown" aria-expanded="false">% thuế</button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item dropdown-vat" data-id="vat" href="javascript:void(0)" data-value="7">7%</a></li>
                                <li><a class="dropdown-item dropdown-vat" data-id="vat" href="javascript:void(0)" data-value="19">19%</a></li>
                                <li><a class="dropdown-item dropdown-vat" data-id="vat" href="javascript:void(0)" data-value="0">Khác</a></li>
                            </ul>
                        </div>
                    </div>
					<div class="form-group">
                        <div class="form-label">
                            Trạng thái
                        </div>
                        <div class="group">
                            <select class="form-control" id="status">								
								<option value="0">Sản phẩm mới</option>					
								<option value="1">Đang vận hành</option>				
								<option value="2">Ngừng bán</option>				
							</select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="lb-xsmall-primary pd-s-100 pd-e-100 btn-add">{{App\Models\CommonModel::get_lang('setting_save')}}</button>
            </div>
        </div>
    </div>
</div>
<section class="section_data_customer">
	<div class="container-main">
		<div class="section_title d-flex flex-row align-items-center justify-content-between">
			<div class="title">
				<h2>
					Dữ liệu
				</h2>
			</div>
		</div>
		<div class="section_content">
			<div class="wrap_head">
				<div class="wrap_list_link_lb wrap_list_link_lb_bd">
					<ul class="list_link_lb">
						<li class="list_link_item">
							<a href="{{route('view-user')}}" class="lb-xsmall lb-link ">
								{{App\Models\CommonModel::get_lang('setting_navigation10')}}
							</a>
						</li>
						<li class="list_link_item">
							<a href="{{route('view-product')}}" class="lb-xsmall lb-link active">
								{{App\Models\CommonModel::get_lang('setting_navigation11')}}
							</a>
						</li>
						<li class="list_link_item">
							<a href="{{route('view-partner')}}" class="lb-xsmall lb-link ">
								{{App\Models\CommonModel::get_lang('setting_navigation12')}}
							</a>
						</li>
						<li class="list_link_item">
							<a href="data_account.html" class="lb-xsmall lb-link">
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
							<a href="{{route('dashboard-setting','navigation')}}" class="lb-xsmall lb-link ">
								{{App\Models\CommonModel::get_lang('setting_navigation16')}}
							</a>
						</li>
					</ul>
				</div>
				<div class="wrap_list_action wrap_list_action_bw">
					<a href="{{route('view-product')}}" class="lb-xsmall">
						<span>
							{{App\Models\CommonModel::get_lang('setting_navigation17')}}
						</span>
					</a>
					<a data-bs-toggle="modal" data-bs-target="#modalAdd" class="lb-xsmall">
						<span>
							{{App\Models\CommonModel::get_lang('setting_navigation18')}}
						</span>
						<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
							<path d="M9.99935 18.4584C5.33383 18.4584 1.54102 14.6656 1.54102 10.0001C1.54102 5.33456 5.33383 1.54175 9.99935 1.54175C14.6649 1.54175 18.4577 5.33456 18.4577 10.0001C18.4577 14.6656 14.6649 18.4584 9.99935 18.4584ZM9.99935 1.79175C5.47321 1.79175 1.79102 5.47394 1.79102 10.0001C1.79102 14.5262 5.47321 18.2084 9.99935 18.2084C14.5255 18.2084 18.2077 14.5262 18.2077 10.0001C18.2077 5.47394 14.5255 1.79175 9.99935 1.79175Z" fill="#6D727B" stroke="#6D727B"/>
							<path d="M13.3327 10.125H6.66602C6.63587 10.125 6.60459 10.1127 6.57894 10.0871C6.5533 10.0614 6.54102 10.0301 6.54102 10C6.54102 9.96985 6.5533 9.93857 6.57894 9.91293C6.60459 9.88728 6.63587 9.875 6.66602 9.875H13.3327C13.3628 9.875 13.3941 9.88728 13.4198 9.91293C13.4454 9.93857 13.4577 9.96985 13.4577 10C13.4577 10.0301 13.4454 10.0614 13.4198 10.0871C13.3941 10.1127 13.3628 10.125 13.3327 10.125Z" fill="#6D727B" stroke="#6D727B"/>
							<path d="M10 13.9584C9.65833 13.9584 9.375 13.6751 9.375 13.3334V6.66675C9.375 6.32508 9.65833 6.04175 10 6.04175C10.3417 6.04175 10.625 6.32508 10.625 6.66675V13.3334C10.625 13.6751 10.3417 13.9584 10 13.9584Z" fill="#6D727B"/>
						</svg>
					</a>
				</div>
				<div class="wrap_list_checkbox mb-32">
					@if(isset($partner) && count($partner)>0)
					@foreach($partner as $item)
					<div class="form-group">
						<div class="form-check">
							<input class="form-check-input filter_partner" type="checkbox" value="{{$item->partner_id}}" id="productCompany{{$item->partner_id}}">
							<label class="form-check-label" for="productCompany{{$item->partner_id}}">
							{{$item->name}}
							</label>
						</div>
					</div>
					@endforeach
					@endif
				
				</div>
				<div class="wrap_content">
					<div class="wrap_table table-scroll table-responsive-lg">
						<table id="partnerTable" class="table">
							<thead>
								<tr>
									<th scope="col">Hãng</th>
									<th scope="col">Số sản phẩm</th>
									<th scope="col">Tên sản phẩm</th>
									<th scope="col">Mã sản phẩm</th>
									<th scope="col">Số lượng/bịch/palet</th>
									<th scope="col">Giá chưa thuế</th>
									<th scope="col">Giá có thuế</th>
									<th class="col"></th>
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