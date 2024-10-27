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
$('#selectAll').on('click', function () {
	var isChecked = $(this).is(':checked');
	if(isChecked){
		$(".user-input").prop('checked',true);
	}else{
		$(".user-input").prop('checked',false);
	}
});
fill_datatable();
$("#filter_search").keyup(function(){
	$('#customerETable').DataTable().destroy();
	fill_datatable($("#filter_search").val());
});
function fill_datatable(filter_search='') {
	var table = $('#customerETable').DataTable({
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
			$(row).attr('data-id',data.url_detail);
		},
		"fnDrawCallback": function(oSettings) {
			if (oSettings._iDisplayLength == -1 || oSettings._iDisplayLength > oSettings.fnRecordsDisplay()) {
				$('.dataTables_paginate').hide();
			} else {
				$('.dataTables_paginate').show();
			}

		},
		ajax: {
			url: "{{route('post-data-interact')}}",
			type: "POST",
			data: {
				_token: $('meta[name="csrf-token"]').attr('content'),filter_search:filter_search
			}
		},
		"columns": [{
				data: "number",sortable: false
			},{
				data: "address",sortable: false
			},{
				data: "gname",sortable: false
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
				data: 'last_order',
				sortable: false
			},
			{
				"data": null,
				sortable: false,
				"render": function(data, type, row, meta) {					
					return '<input class="form-check-input user-input" type="checkbox" class="row-select" value="'+data.id+'">'
					
				}
			}
		],
		"order": [
			[4, "desc"]
		]
	});
	$.fn.dataTable.ext.errMode = 'throw';
	
}

</script>

@endsection

@section("content")
@include('admin.header_bottom')

<section class="section_data">
	<div class="container-main">
		<div class="section_title d-flex flex-row align-items-center justify-content-between">
			<div class="title">
				<h2>
					{{App\Models\CommonModel::get_lang('setting_navigation8')}}
				</h2>
			</div>
		</div>
		<div class="section_form_search">
			<div class="wrap_content">
				<div class="wrap_search">
					<div class="form-group">
						<input type="text" id="filter_search" class="form-control search" placeholder="Tìm kiếm">
					</div>
				</div>
				<div class="wrap_send_social">
					<div class="w_social">
						<a href="javascript:void(0)" class="lb-btn-social">
							<img src="{{asset('assets/frontend')}}/assets/images/social/messenger.png" alt="" class="messenger">
						</a>
						<a href="javascript:void(0)" class="lb-btn-social">
							<img src="{{asset('assets/frontend')}}/assets/images/social/viper.png" alt="" class="viper">
						</a>
						<a href="javascript:void(0)" class="lb-btn-social">
							<img src="{{asset('assets/frontend')}}/assets/images/social/whatsapp.png" alt="" class="whatsapp">
						</a>
						<a href="javascript:void(0)" class="lb-btn-social">
							<img src="{{asset('assets/frontend')}}/assets/images/social/zalo.png" alt="" class="zalo">
						</a>
						<a href="javascript:void(0)" class="lb-btn-social">
							<img src="{{asset('assets/frontend')}}/assets/images/social/gmail.png" alt="" class="gmail">
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="section_content">
			<div class="wrap_head">
				<div class="wrap_head_title d-flex flex-row align-items-center justify-content-between">
					<div class="title">
						<h3>Tương tác danh sách tùy chọn</h3>
					</div>
					<a href="#" class="text_link">
						Xem danh sách khách hàng đã chọn
					</a>
				</div>
			</div>
			<div class="wrap_content">
				<div class="wrap_table table-scroll table-responsive-lg">
					<table id="customerETable" class="table table-bordered" style="width:100%">
						<thead>
						<tr>
							<th scope="col">{{App\Models\CommonModel::get_lang('setting_user1')}}</th>
							<th scope="col">{{App\Models\CommonModel::get_lang('setting_user2')}}</th>
							<th scope="col">{{App\Models\CommonModel::get_lang('setting_user3')}}</th>
							<th scope="col">{{App\Models\CommonModel::get_lang('setting_user4')}}</th>
							<th scope="col">Email</th>
							<th scope="col">{{App\Models\CommonModel::get_lang('setting_user5')}}</th>
							<th scope="col">
								<input class="form-check-input" type="checkbox" id="selectAll">
								<label class="form-check-label" for="selectAll"></label>
							</th>
						</tr>
						</thead>
						<tbody>
						
						</tbody>
					</table>
				</div>
				<div class="wrap_action_table">
					<div class="wrap_send_social">
						<div class="label">
							Chọn nền tảng gửi cho khách hàng
						</div>
						<div class="w_social">
							<a href="javascript:void(0)" class="lb-btn-social">
								<img src="{{asset('assets/frontend')}}/assets/images/social/messenger.png" alt="" class="messenger">
							</a>
							<a href="javascript:void(0)" class="lb-btn-social">
								<img src="{{asset('assets/frontend')}}/assets/images/social/viper.png" alt="" class="viper">
							</a>
							<a href="javascript:void(0)" class="lb-btn-social">
								<img src="{{asset('assets/frontend')}}/assets/images/social/whatsapp.png" alt="" class="whatsapp">
							</a>
							<a href="javascript:void(0)" class="lb-btn-social">
								<img src="{{asset('assets/frontend')}}/assets/images/social/zalo.png" alt="" class="zalo">
							</a>
							<a href="javascript:void(0)" class="lb-btn-social">
								<img src="{{asset('assets/frontend')}}/assets/images/social/gmail.png" alt="" class="gmail">
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection