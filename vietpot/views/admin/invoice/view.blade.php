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
fill_datatable();

function fill_datatable() {
	var table = $('#invoiceTable').DataTable({
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
			url: "{{route('post-data-invoice')}}",
			type: "POST",
			data: {
				_token: $('meta[name="csrf-token"]').attr('content'),filter_type:"{{$t}}"
			}
		},
		"columns": [{
				data: "code",sortable: true
			},
			{
				data: 'name',
				sortable: false
			},
			{
				data: 'type',
				sortable: false
			},
			{
				data: 'create_date',
				sortable: true
			},{
				data: 'expired_date',
				sortable: true
			},{
				data: 'status',
				sortable: false
			},{
				data: 'price',
				sortable: true
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

<section class="section_data_customer">
	<div class="container-main">
		<div class="section_title d-flex flex-row align-items-center justify-content-between">
			<div class="title">
				<h2>
					{{App\Models\CommonModel::get_lang('setting_navigation4')}}
				</h2>
			</div>
			<div class="wrap_list_action_flex">
				<a href="#" class="lb-xsmall">
					<span>Thu và chi (không hóa đơn)</span>
				</a>
				<a href="{{route('add-invoice')}}" class="lb-xsmall">
						<span>
							Tạo hóa đơn mới
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
		</div>
		<div class="section_content">
			<div class="wrap_head">
				<div class="wrap_list_link_lb wrap_list_link_lb_bd">
					<ul class="list_link_lb justify-content-center">
						<li class="list_link_item">
							<a href="{{route('add-invoice')}}" class="lb-xsmall lb-link">
								Nhập hóa đơn
							</a>
						</li>
						<li class="list_link_item">
							<a href="{{route('view-invoice')}}" class="lb-xsmall lb-link dropdown-toggle active" data-bs-toggle="dropdown" aria-expanded="false">
								Danh sách hóa đơn và chi tiêu
							</a>
							<ul class="dropdown-menu">
								<li><a class="dropdown-item" href="{{route('view-invoice')}}">Danh sách tổng thể</a></li>
								<li><a class="dropdown-item" href="{{route('view-invoice',0)}}">Hóa đơn nhập</a></li>
								<li><a class="dropdown-item" href="{{route('view-invoice',1)}}">Hóa đơn xuất</a></li>
							</ul>
						</li>
						<li class="list_link_item">
							<a href="{{route('statistic-invoice')}}" class="lb-xsmall lb-link">
								Thống kê tài chính
							</a>
						</li>
					</ul>
				</div>
				<div class="wrap_content">
					<div class="wrap_table table-responsive-lg">
						<table id="invoiceTable" class="table table-bordered" style="width:100%">
							<thead>
								<tr>
									<th scope="col">Số hóa đơn</th>
                                    <th scope="col">Tên công ty</th>
                                    <th scope="col">Nhóm</th>
                                    <th scope="col">Ngày nhập hóa đơn</th>
                                    <th scope="col">Hạn trả tiền</th>
                                    <th scope="col">Tình trạng</th>
                                    <th scope="col">Tổng số tiền</th>
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