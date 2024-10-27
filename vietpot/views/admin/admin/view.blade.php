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
$(document).on('click', '.pedit', function() {
	$("#eid").val($(this).data('id'));
	$.ajaxSetup({
	  headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});
	$.ajax({
		url: "{{route('edit-admin')}}",
		type: 'POST',
		dataType: 'json',
		data: {id:$(this).data('id')},	
		success: function (msg, textStatus, jqXHR) {
			$("#ename").val(msg.name);
			$("#ephone").val(msg.phone);
		}
	});
});
$(".btn-edit").click(function(){
	$.ajaxSetup({
	  headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});
	var status=1;
	if($("#editLockAccount").is(":checked")){
		var status=2;
	}
	$.ajax({
		url: "{{route('post-edit-admin')}}",
		type: 'POST',
		dataType: 'json',
		data: {id:$("#eid").val(),name:$("#ename").val(),password:$("#epassword").val(),phone:$("#ephone").val(),status:status},	
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
		url: "{{route('post-add-admin')}}",
		type: 'POST',
		dataType: 'json',
		data: {name:$("#name").val(),password:$("#password").val(),email:$("#email").val(),phone:$("#phone").val()},	
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
			url: "{{route('post-data-admin')}}",
			type: "POST",
			data: {
				_token: $('meta[name="csrf-token"]').attr('content'),
				filter_status: filter_status
			}
		},
		"columns": [{
				data: 'number',
				sortable: false
			},{
				data: 'name',
				sortable: true
			},
			{
				data: 'phone',
				sortable: true
			},
			{
				data: 'email',
				sortable: true
			},
			{
				data: 'last_login',
				sortable: false
			},
			{
				"data": null,
				sortable: false,
				"render": function(data, type, row, meta) {					
					return '<a href="javascript:void(0)" class="pedit" data-id="'+data.id+'" data-bs-toggle="modal" data-bs-target="#modalEdit"><img src="/assets/frontend/assets/images/icon/setting.png" alt="setting"></a>'
					
				}
			}
		],
		"order": [
			[3, "desc"]
		]
	});
	$.fn.dataTable.ext.errMode = 'throw';
}

</script>
@endsection

@section("content")
@include('admin.header_bottom')
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
                             {{App\Models\CommonModel::get_lang('setting_user6')}}
                        </div>
                        <div class="group">
                            <input type="text" class="form-control" id="ename">
                        </div>
                    </div>
					 <div class="form-group">
                        <div class="form-label">
                             {{App\Models\CommonModel::get_lang('setting_user4')}}
                        </div>
                        <div class="group">
                            <input type="text" class="form-control" id="ephone">
                        </div>
                    </div>
					<div class="form-group">
                        <div class="form-label">
                            {{App\Models\CommonModel::get_lang('setting_user7')}}
                        </div>
                        <div class="group">
                            <input type="password" class="form-control" id="epassword" placeholder="{{App\Models\CommonModel::get_lang('setting_notify4')}}">
                        </div>
                    </div>
					<div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="editLockAccount">
                            <label class="form-check-label" for="editLockAccount">
                                Khóa tài khoản
                            </label>
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
                            Email
                        </div>
                        <div class="group">
							<input type="text" class="form-control" id="email">
                        </div>
                    </div> 
					 <div class="form-group">
                        <div class="form-label">
                            {{App\Models\CommonModel::get_lang('setting_user6')}}
                        </div>
                        <div class="group">
                            <input type="text" class="form-control" id="name">
                        </div>
                    </div>
					 <div class="form-group">
                        <div class="form-label">
                            {{App\Models\CommonModel::get_lang('setting_user4')}}
                        </div>
                        <div class="group">
                            <input type="text" class="form-control" id="phone">
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
					{{App\Models\CommonModel::get_lang('setting_data')}}
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
							<a href="{{route('view-product')}}" class="lb-xsmall lb-link">
								{{App\Models\CommonModel::get_lang('setting_navigation11')}}
							</a>
						</li>
						<li class="list_link_item">
							<a href="{{route('view-partner')}}" class="lb-xsmall lb-link ">
								{{App\Models\CommonModel::get_lang('setting_navigation12')}}
							</a>
						</li>
						<li class="list_link_item">
							<a href="{{route('view-admin')}}" class="lb-xsmall lb-link active">
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
							<a href="{{route('dashboard-setting','navigation')}}" class="lb-xsmall lb-link">
								{{App\Models\CommonModel::get_lang('setting_navigation16')}}
							</a>
						</li>
						<li class="list_link_item">
							<a href="{{route('view-email-template')}}" class="lb-xsmall lb-link">
								Mẫu email
							</a>
						</li>
					</ul>
				</div>
				<div class="wrap_list_action wrap_list_action_bw">
					<a href="{{route('view-admin')}}" class="lb-xsmall">
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
				<div class="wrap_content">
					<div class="wrap_table table-scroll table-responsive-lg">
						<table id="partnerTable" class="table">
							<thead>
								<tr>
									<th scope="col">Số tài khoản</th>
									<th scope="col">{{App\Models\CommonModel::get_lang('setting_user6')}}</th>
									<th scope="col">{{App\Models\CommonModel::get_lang('setting_user4')}}</th>
									<th scope="col">Email</th>
									<th scope="col">{{App\Models\CommonModel::get_lang('setting_partner20')}}</th>
									<th scope="col"></th>
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