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
$(document).on('click', '.logs', function() {
	var id=$(this).data('id');
	$.ajaxSetup({
	  headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});
	$.ajax({
		url: "{{route('post-logs-partner-account')}}",
		type: 'POST',
		dataType: 'html',
		data: {id:id,type:$(this).data('type')},	
		success: function (msg, textStatus, jqXHR) {
			$("#table_logs").html(msg);
		}
	});
});
$(document).on('click', '.history', function() {
	var id=$(this).data('id');
	$.ajaxSetup({
	  headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});
	$.ajax({
		url: "{{route('post-history-partner-account')}}",
		type: 'POST',
		dataType: 'html',
		data: {id:id,type:$(this).data('type')},	
		success: function (msg, textStatus, jqXHR) {
			$("#table_history").html(msg);
		}
	});
});
$(document).on('click', '.note', function() {
	var t =$(this);
	var id=$(this).data('id');
	$.ajaxSetup({
	  headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});
	$.ajax({
		url: "{{route('post-note-partner-account')}}",
		type: 'POST',
		dataType: 'json',
		data: {id:id,value:$(".note_"+id).val()},	
		success: function (msg, textStatus, jqXHR) {
			if(msg.check==0){
				toastr.error(msg.content, ''); 
			}else{				
				toastr.success(msg.content, ''); 
				$(".note_"+id).val('');
			}
		}
	});
});
$(document).on('change', '.edit_data', function() {
	$("#eid").val($(this).data('id'));
	$.ajaxSetup({
	  headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});
	$.ajax({
		url: "{{route('post-edit-partner-account')}}",
		type: 'POST',
		dataType: 'json',
		data: {id:$(this).data('id'),type:$(this).data('type'),value:$(this).val()},	
		success: function (msg, textStatus, jqXHR) {
			if(msg.check==0){
				toastr.error(msg.content, ''); 
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
		url: "{{route('post-add-partner-account')}}",
		type: 'POST',
		dataType: 'json',
		data: {name:$("#name").val(),position:$("#position").val(),email:$("#email").val(),password:$("#password").val(),partner_id:$("#partner_id").val(),phone:$("#phone").val()},	
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

function fill_datatable() {
	var table = $('#partnerAccountTable').DataTable({
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
			url: "{{route('post-data-partner-account')}}",
			type: "POST",
			data: {
				_token: $('meta[name="csrf-token"]').attr('content')
			}
		},
		"columns": [{
				data: 'number',
				sortable: true
			},
			{
				data: 'name',
				sortable: true
			},
			{
				data: 'pname',
				sortable: true
			},
			{
				data: 'position',
				sortable: true
			},{
				data: 'last_login',
				sortable: true
			}
		],
		"order": [
			[4, "desc"]
		]
	});
	$.fn.dataTable.ext.errMode = 'throw';
	$('#partnerAccountTable tbody').on('click', 'tr.table-row', function() {
		var tr = $(this);
		var row = table.row( tr );
		var id = row.data().id;		
		$('#partnerAccountTable tbody tr.details-row').remove();
		$('#partnerAccountTable tbody tr').removeClass('selected');
		$(this).addClass('selected');
		let detailRow = '<tr class="details-row"><td colspan="5"><div class="wrap_tr_detail wrap_tr_full"><div class="wrap_form"><div class="wrap_form_flex"><div class="wrap_form_flex_left"><div class="form-group"><div class="form-label">Tên đối tác</div><div class="group"><input type="text" class="edit_data form-control" data-type="name" data-id="'+row.data().id+'" value="'+row.data().name+'"/></div></div><div class="form-group"><div class="form-label">Tên công ty</div><div class="group"><div class="text-data">'+row.data().pname+'</div></div></div><div class="form-group"><div class="form-label">Chức vụ</div><div class="group"><input type="text" class="edit_data form-control" data-type="position" data-id="'+row.data().id+'" value="'+row.data().position+'"/></div></div></div><div class="wrap_form_flex_right"><div class="form-group"><div class="form-label">Số điện thoại</div><div class="group"><input type="text" class="edit_data form-control" data-type="phone" data-id="'+row.data().id+'" value="'+row.data().phone+'"/></div></div><div class="form-group"><div class="form-label">Email</div><div class="group"><input type="text" class="edit_data form-control" data-type="email" data-id="'+row.data().id+'" value="'+row.data().email+'"/></div></div><div class="form-group"><div class="form-label">Lịch sử đăng nhập</div><div class="group"><div class="text-data"><a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#modalLogs" data-id="'+id+'" data-type="login" class="logs">'+row.data().last_login+'</a></div></div></div></div></div><div class="form-group"><div class="form-label">Ghi chú</div><div class="group group_input_btn_flex"><div class="group_input_btn"><input type="text" class="form-control note_'+id+'" placeholder="Nhập ghi chú"><a href="javascript:void(0)" data-id="'+id+'" class="lb-xxsmall-primary note">Nhớ ghi chú</a></div><a href="#" class="lb-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><img src="/assets/frontend/assets/images/icon/setting-1.png" alt=""></a><ul class="dropdown-menu" style=""><li><a class="dropdown-item history" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#modalHistory" data-type="note" data-id="'+id+'"><span>Lịch sử</span></a></li><li><a class="dropdown-item btn-action-table" href="javascript:void(0)" data-url="'+row.data().url_delete+'"><span>Xoá</span></a></li></ul></div></div></div></div></td></tr>';
		$(this).closest('tr').after(detailRow);
	});
}

</script>
@endsection

@section("content")
@include('frontend.header_bottom')
<div class="modal fade modal-custom" id="modalLogs" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> {{App\Models\CommonModel::get_lang('setting_partner25')}}</h5>
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
							  <th scope="col"> {{App\Models\CommonModel::get_lang('setting_partner23')}}</th>
							  <th scope="col"> {{App\Models\CommonModel::get_lang('setting_partner24')}}</th>
							</tr>
						</thead>
						<tbody id="table_logs">
							
						</tbody>
					</table>
				</div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade modal-custom" id="modalHistory" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> {{App\Models\CommonModel::get_lang('setting_partner21')}}</h5>
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
							  <th scope="col"> {{App\Models\CommonModel::get_lang('setting_partner22')}}</th>
							  <th scope="col"> {{App\Models\CommonModel::get_lang('setting_partner23')}}</th>
							  <th scope="col"> {{App\Models\CommonModel::get_lang('setting_partner24')}}</th>
							</tr>
						</thead>
						<tbody id="table_history">
							
						</tbody>
					</table>
				</div>
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
                            Email
                        </div>
                        <div class="group">
							<input type="text" class="form-control" id="email">
                        </div>
                    </div> 
					<div class="form-group">
                        <div class="form-label">
                            {{App\Models\CommonModel::get_lang('setting_user7')}}
                        </div>
                        <div class="group">
							<input type="password" class="form-control" id="password">
                        </div>
                    </div>  
					 <div class="form-group">
                        <div class="form-label">
                            {{App\Models\CommonModel::get_lang('setting_partner2')}}
                        </div>
                        <div class="group">
                            <input type="text" class="form-control" id="name">
                        </div>
                    </div>
					 <div class="form-group">
                        <div class="form-label">
                            {{App\Models\CommonModel::get_lang('setting_partner16')}}
                        </div>
                        <div class="group">
                            <input type="text" class="form-control" id="phone">
                        </div>
                    </div>
					<div class="form-group">
                        <div class="form-label">
                            {{App\Models\CommonModel::get_lang('setting_partner15')}}
                        </div>
                        <div class="group">
                            <input type="text" class="form-control" id="position">
                        </div>
                    </div>
					<div class="form-group">
                        <div class="form-label">
                            {{App\Models\CommonModel::get_lang('setting_partner14')}}
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
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="lb-xsmall-primary pd-s-100 pd-e-100 btn-add">{{App\Models\CommonModel::get_lang('setting_save')}}</button>
            </div>
        </div>
    </div>
</div>
<section class="section_data">
	<div class="container-main">
		<div class="section_title d-flex flex-row align-items-center justify-content-between">
			<div class="title">
				<h2>
					{{App\Models\CommonModel::get_lang('setting_navigation5')}}
				</h2>
			</div>
			<a data-bs-toggle="modal" data-bs-target="#modalAdd" class="lb-xsmall">
						<span>
							{{App\Models\CommonModel::get_lang('setting_partner12')}}
						</span>
				<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
					<path d="M9.99935 18.4584C5.33383 18.4584 1.54102 14.6656 1.54102 10.0001C1.54102 5.33456 5.33383 1.54175 9.99935 1.54175C14.6649 1.54175 18.4577 5.33456 18.4577 10.0001C18.4577 14.6656 14.6649 18.4584 9.99935 18.4584ZM9.99935 1.79175C5.47321 1.79175 1.79102 5.47394 1.79102 10.0001C1.79102 14.5262 5.47321 18.2084 9.99935 18.2084C14.5255 18.2084 18.2077 14.5262 18.2077 10.0001C18.2077 5.47394 14.5255 1.79175 9.99935 1.79175Z"
						  fill="#6D727B" stroke="#6D727B"/>
					<path d="M13.3327 10.125H6.66602C6.63587 10.125 6.60459 10.1127 6.57894 10.0871C6.5533 10.0614 6.54102 10.0301 6.54102 10C6.54102 9.96985 6.5533 9.93857 6.57894 9.91293C6.60459 9.88728 6.63587 9.875 6.66602 9.875H13.3327C13.3628 9.875 13.3941 9.88728 13.4198 9.91293C13.4454 9.93857 13.4577 9.96985 13.4577 10C13.4577 10.0301 13.4454 10.0614 13.4198 10.0871C13.3941 10.1127 13.3628 10.125 13.3327 10.125Z"
						  fill="#6D727B" stroke="#6D727B"/>
					<path d="M10 13.9584C9.65833 13.9584 9.375 13.6751 9.375 13.3334V6.66675C9.375 6.32508 9.65833 6.04175 10 6.04175C10.3417 6.04175 10.625 6.32508 10.625 6.66675V13.3334C10.625 13.6751 10.3417 13.9584 10 13.9584Z"
						  fill="#6D727B"/>
				</svg>
			</a>
		</div>
		<div class="section_content">
			<div class="wrap_head">
				<div class="wrap_list_action wrap_list_action_bw">
					<a href="{{route('view-partner-account')}}" class="lb-xsmall pd-s-32 pd-e-32">
						<span>
							{{App\Models\CommonModel::get_lang('setting_partner11')}}
						</span>
					</a>
				</div>
				<div class="wrap_content">
					<div class="wrap_table table-scroll table-responsive-lg">
						<table id="partnerAccountTable" class="table">
							<thead>
								<tr>
									<th scope="col">{{App\Models\CommonModel::get_lang('setting_partner13')}}</th>
									<th scope="col">{{App\Models\CommonModel::get_lang('setting_partner2')}}</th>
									<th scope="col">{{App\Models\CommonModel::get_lang('setting_partner14')}}</th>
									<th scope="col">{{App\Models\CommonModel::get_lang('setting_partner15')}}</th>
									<th scope="col">{{App\Models\CommonModel::get_lang('setting_partner20')}}</th>
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