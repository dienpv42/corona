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
var chartTotal = <?php echo json_encode($total_chart); ?>;
var chartCount = <?php echo json_encode($count_chart); ?>;
	var options = {
		series: chartTotal,
		chart: {
			type: 'area',
			stacked: false,
			height: 500,
			toolbar: false,
		},
		colors: <?php echo json_encode($list_color); ?>,
		dataLabels: {
		  enabled: false,
		},
		stroke: {
		  curve: 'smooth'
		},
		grid: {
		  borderColor: '#e7e7e7',
		  row: {
			colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
			opacity: 0.5
		  },
		},
		markers: {
		  size: 5
		},
		xaxis: {
			labels: {
				style: {
					fontSize: '12px',
					fontFamily: 'SVN-Gilroy, sans-serif',
				},
			},
			title: {
				text: 'Thời gian',
				style: {
					fontSize: '12px',
					 fontFamily: 'SVN-Gilroy, sans-serif',
					fontWeight: 700,
				},
			}
		},
		yaxis: {
			labels: {
				style: {
					fontSize: '12px',
					fontFamily: 'SVN-Gilroy, sans-serif',
				},
			},
			title: {
				text: 'Số tiền',
				style: {
					fontSize: '12px',
					 fontFamily: 'SVN-Gilroy, sans-serif',
					fontWeight: 700,
				},
			}
		},
		legend: {
			position: 'top',
			horizontalAlign: 'right',
			floating: true,
		},
		tooltip: {
			followCursor: true,
			custom: function ({series, seriesIndex, dataPointIndex, w}) {
				let title = w.globals.initialSeries[seriesIndex].name;
				let time = w.globals.initialSeries[seriesIndex].data[dataPointIndex].x;
				let amount = w.globals.initialSeries[seriesIndex].data[dataPointIndex].y;
				return `<div class="wrap_tooltip">
					<div class="title d-flex flex-row align-items-center">
						${title}
					</div>
					<div class="record">
						<b>${amount}</b>
					</div>
				</div>`;
			}
		}
	};

	var chart = new ApexCharts(document.querySelector("#chart"), options);
	chart.render();
	
	var options1 = {
		series: chartCount,
		chart: {
			type: 'area',
			stacked: false,
			height: 500,
			toolbar: false,
		},
		colors: <?php echo json_encode($list_color); ?>,
		dataLabels: {
		  enabled: false,
		},
		stroke: {
		  curve: 'smooth'
		},
		grid: {
		  borderColor: '#e7e7e7',
		  row: {
			colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
			opacity: 0.5
		  },
		},
		markers: {
		  size: 5
		},
		xaxis: {
			labels: {
				style: {
					fontSize: '12px',
					fontFamily: 'SVN-Gilroy, sans-serif',
				},
			},
			title: {
				text: 'Thời gian',
				style: {
					fontSize: '12px',
					 fontFamily: 'SVN-Gilroy, sans-serif',
					fontWeight: 700,
				},
			}
		},
		yaxis: {
			labels: {
				style: {
					fontSize: '12px',
					fontFamily: 'SVN-Gilroy, sans-serif',
				},
			},
			title: {
				text: 'Số lượng',
				style: {
					fontSize: '12px',
					 fontFamily: 'SVN-Gilroy, sans-serif',
					fontWeight: 700,
				},
			}
		},
		legend: {
			position: 'top',
			horizontalAlign: 'right',
			floating: true,
		},
		tooltip: {
			followCursor: true,
			custom: function ({series, seriesIndex, dataPointIndex, w}) {
				let title = w.globals.initialSeries[seriesIndex].name;
				let time = w.globals.initialSeries[seriesIndex].data[dataPointIndex].x;
				let amount = w.globals.initialSeries[seriesIndex].data[dataPointIndex].y;
				return `<div class="wrap_tooltip">
					<div class="title d-flex flex-row align-items-center">
						${title}
					</div>
					<div class="record">
						<b>${amount}</b>
					</div>
				</div>`;
			}
		}
	};

	var chart1 = new ApexCharts(document.querySelector("#chart1"), options1);
	chart1.render();
</script>
@endsection

@section("content")
@include('admin.header_bottom')

<input type="hidden" id="id" value="{{$data->id}}"/>
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
							<a href="{{route('view-user')}}" class="lb-xsmall lb-link active">
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
							<a href="{{route('view-admin')}}" class="lb-xsmall lb-link">
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
					</ul>
				</div>
				<div class="wrap_list_action wrap_list_action_bw">
					<a href="{{route('view-user')}}" class="lb-xsmall">
						<span>
							{{App\Models\CommonModel::get_lang('setting_navigation17')}}
						</span>
					</a>
					<div class="lb-text">
						{{App\Models\CommonModel::get_lang('setting_user10')}}: <span>123</span>
					</div>
					<div class="lb-text">
						{{App\Models\CommonModel::get_lang('setting_user11')}}: <span>123</span>
					</div>
					<a href="javascript:void(0)" class="lb-xsmall" data-bs-toggle="modal" data-bs-target="#modalAdd">
						<span>
							{{App\Models\CommonModel::get_lang('setting_user20')}}
						</span>
						<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
							<path d="M9.99935 18.4584C5.33383 18.4584 1.54102 14.6656 1.54102 10.0001C1.54102 5.33456 5.33383 1.54175 9.99935 1.54175C14.6649 1.54175 18.4577 5.33456 18.4577 10.0001C18.4577 14.6656 14.6649 18.4584 9.99935 18.4584ZM9.99935 1.79175C5.47321 1.79175 1.79102 5.47394 1.79102 10.0001C1.79102 14.5262 5.47321 18.2084 9.99935 18.2084C14.5255 18.2084 18.2077 14.5262 18.2077 10.0001C18.2077 5.47394 14.5255 1.79175 9.99935 1.79175Z" fill="#6D727B" stroke="#6D727B"/>
							<path d="M13.3327 10.125H6.66602C6.63587 10.125 6.60459 10.1127 6.57894 10.0871C6.5533 10.0614 6.54102 10.0301 6.54102 10C6.54102 9.96985 6.5533 9.93857 6.57894 9.91293C6.60459 9.88728 6.63587 9.875 6.66602 9.875H13.3327C13.3628 9.875 13.3941 9.88728 13.4198 9.91293C13.4454 9.93857 13.4577 9.96985 13.4577 10C13.4577 10.0301 13.4454 10.0614 13.4198 10.0871C13.3941 10.1127 13.3628 10.125 13.3327 10.125Z" fill="#6D727B" stroke="#6D727B"/>
							<path d="M10 13.9584C9.65833 13.9584 9.375 13.6751 9.375 13.3334V6.66675C9.375 6.32508 9.65833 6.04175 10 6.04175C10.3417 6.04175 10.625 6.32508 10.625 6.66675V13.3334C10.625 13.6751 10.3417 13.9584 10 13.9584Z" fill="#6D727B"/>
						</svg>
					</a>
				</div>
			</div>
			<div class="wrap_content">
				<div class="wrap_card">
					<div class="wrap_card_head d-flex flex-row align-items-center justify-content-between">
						<div class="title">
							{{App\Models\CommonModel::get_lang('setting_user19')}}
						</div>
						<a href="javascript:void(0)" class="lb-text-link" data-bs-toggle="modal" data-bs-target="#modalEdit">
							<span>
								{{App\Models\CommonModel::get_lang('setting_user21')}}
							</span>
							<img src="{{asset('assets/frontend')}}/assets/images/png/edit.png" alt="">
						</a>
					</div>
					<div class="wrap_card_body">
						<div class="w_info">
							<div class="row">
								<div class="col-12 col-lg-5">
									<div class="info">
										<div class="label">
											{{App\Models\CommonModel::get_lang('setting_user6')}}
										</div>
										<div class="text">
										{{$data->name}}
										</div>
									</div>
									<div class="info">
										<div class="label">
											{{App\Models\CommonModel::get_lang('setting_user4')}}
										</div>
										<div class="text">
											{{$data->phone}}
										</div>
									</div>
									<div class="info">
										<div class="label">
											{{App\Models\CommonModel::get_lang('setting_user8')}}
										</div>
										<div class="text">
											{{$data->bank}}
										</div>
									</div>
									<div class="info">
										<div class="label">
											IČO
										</div>
										<div class="text">
											{{$data->ico}}
										</div>
									</div>
								</div>
								<div class="col-12 col-lg-7">
									<div class="info">
										<div class="label">
											{{App\Models\CommonModel::get_lang('setting_user2')}}
										</div>
										<div class="text">
											{{$data->address}}
										</div>
									</div>
									<div class="info">
										<div class="label">
											Email
										</div>
										<div class="text">
											{{$data->email}}
										</div>
									</div>
									<div class="info">
										<div class="label">
											GPS
										</div>
										<div class="text">
											{{$data->gps}}
										</div>
									</div>
									<div class="info">
										<div class="label">
											DIČ
										</div>
										<div class="text">
											{{$data->dic}}
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="w_send_social">
							<div class="form-group">
								<select name="" id="" class="form-select">
									<option value="">
										{{App\Models\CommonModel::get_lang('setting_user18')}}
									</option>
								</select>
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
						<div class="wrap_table_transparent table-responsive">
							<table class="table table-borderless">
								<thead>
								<tr>
									<th scope="col"></th>
									@if(isset($list_code) && count($list_code)>0)
									@foreach($list_code as $item)
									<th scope="col">{{$item['name']}}</th>
									@endforeach
									@endif
								</tr>
								</thead>
								<tbody>
								<tr>
									<td class="text-start fw-bold">{{App\Models\CommonModel::get_lang('setting_user9')}}</td>
									@if(isset($list_code) && count($list_code)>0)
									@foreach($list_code as $item)
									<td><input type="text" style="text-align:center" value="{{$item['code']}}" class="update_code" data-id="{{$item['id']}}"/></td>
									@endforeach
									@endif
								</tr>
								<tr>
									<td class="text-start fw-bold">{{App\Models\CommonModel::get_lang('setting_user22')}}</td>
									@if(isset($list_code) && count($list_code)>0)
									@foreach($list_code as $item)
									<td>{{$item['total']}}</td>
									@endforeach
									@endif
								</tr>
								<tr>
									<td class="text-start fw-bold">{{App\Models\CommonModel::get_lang('setting_user23')}}</td>
									@if(isset($list_code) && count($list_code)>0)
									@foreach($list_code as $item)
									<td>{{$item['total_order']}}</td>
									@endforeach
									@endif
								</tr>

								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="wrap_list_link_lb">
					<ul class="list_link_lb justify-content-center">
						<li class="list_link_item">
							<a href="{{route('detail-user',$data->id)}}" class="lb-xsmall lb-link ">
								{{App\Models\CommonModel::get_lang('setting_user12')}}
							</a>
						</li>
						<li class="list_link_item">
							<a href="{{route('statistic-user',$data->id)}}" class="lb-xsmall lb-link active">
								{{App\Models\CommonModel::get_lang('setting_user13')}}
							</a>
						</li>
					</ul>
				</div>
				<div class="wrap_chart">
					<div class="title">
						Đồ thị tổng số tiền hoá đơn
					</div>
					<div id="chart"></div>
				</div>
				<div class="wrap_chart">
					<div class="title">
						Đồ thị tổng số hoá đơn
					</div>
					<div id="chart1"></div>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection