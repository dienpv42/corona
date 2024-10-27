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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="{{asset('assets/frontend')}}/assets/css/app.css">
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
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<!-- Ngôn ngữ tiếng Việt -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/vn.js"></script>
<script>
 $(document).ready(function (){
	flatpickr("#datepicker", {
		dateFormat: "d-m-Y", 
		enableTime: false,   
		locale: "vn",       
	});
	flatpickr("#datepicker2", {
		dateFormat: "d-m-Y",
		enableTime: false,   
		locale: "vn",      
	});
	var url="{{route('dashboard-index')}}";
	$("#datepicker").change(function(){
		if($("#datepicker2").val()!=''){			
			window.location.replace(url+'/invoice/statistic/this_period/'+$("#datepicker").val()+'/'+$("#datepicker2").val());
		}
	});
	$("#datepicker2").change(function(){
		if($("#datepicker").val()!=''){
			window.location.replace(url+'/invoice/statistic/this_period/'+$("#datepicker").val()+'/'+$("#datepicker2").val());
		}
	});
	
	var chartTotal = <?php echo json_encode($list_total); ?>;
	var chartCount = <?php echo json_encode($list_count); ?>;
	const dataLabels = {
		enabled: false,
		style: {
			colors: ['#E6332A'],
			background: {
				borderRadius: 20,
				color: '#E6332A',
				borderColor: '#E6332A',
				borderWidth: 1,
				opacity: 1,
			},
			fontSize: '12px',
			fontFamily: 'SVN-Gilroy, sans-serif',
			fontWeight: 500,
			textAnchor: 'center',
		},
		background: {
			enabled: true,
			padding: 5,
			borderRadius: 6,
			borderWidth: 1,
			opacity: 0.9,
		},
		dropShadow: {
			enabled: false,
			top: 1,
			left: 1,
			blur: 1,
			opacity: 0.45,
			color: '#000'
		},
		shape: 'circle',
	};
	const optionsTotal = {
		colors: ['#EDEDED'],
		series: [{
			name: "Tổng tiền",
			data: chartTotal
		}],
		chart: {
			type: 'area',
			stacked: false,
			height: 500,
			toolbar: false,
		},
		grid: {
			show: false, // ẩn tất cả các đường line ngang
			strokeDashArray: 0
		},
		dataLabels: dataLabels,
		stroke: {
			width: 2,
			curve: 'straight',
			color: '#fff'
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
	var chartTotal = new ApexCharts(document.querySelector("#chart_total"), optionsTotal);
	
	const optionsCount = {
		colors: ['#EDEDED'],
		series: [{
			name: "Tổng hoá đơn",
			data: chartCount
		}],
		chart: {
			type: 'area',
			stacked: false,
			height: 500,
			toolbar: false,
		},
		grid: {
			show: false, // ẩn tất cả các đường line ngang
			strokeDashArray: 0
		},
		dataLabels: dataLabels,
		stroke: {
			width: 2,
                curve: 'straight',
                color: '#fff'
		},
		xaxis: {
			labels: {
				style: {
					fontSize: '12px',
					fontFamily: 'SegoeUIVariable, sans-serif',
				},
			},
			title: {
				text: 'Thời gian',
				style: {
					fontSize: '12px',
					fontFamily: 'SegoeUIVariable, sans-serif',
					fontWeight: 700,
				},
			}
		},
		yaxis: {
			labels: {
				style: {
					fontSize: '12px',
					fontFamily: 'SegoeUIVariable, sans-serif',
				},
			},
			title: {
				text: 'Số lượng',
				style: {
					fontSize: '12px',
					fontFamily: 'SegoeUIVariable, sans-serif',
					fontWeight: 700,
				},
			}
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
	var chartCount = new ApexCharts(document.querySelector("#chart_count"), optionsCount);
	chartTotal.render();
	chartCount.render();
});
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
							<a href="{{route('view-invoice')}}" class="lb-xsmall lb-link dropdown-toggle " data-bs-toggle="dropdown" aria-expanded="false">
								Danh sách hóa đơn và chi tiêu
							</a>
							<ul class="dropdown-menu">
								<li><a class="dropdown-item" href="{{route('view-invoice')}}">Danh sách tổng thể</a></li>
								<li><a class="dropdown-item" href="{{route('view-invoice',0)}}">Hóa đơn nhập</a></li>
								<li><a class="dropdown-item" href="{{route('view-invoice',1)}}">Hóa đơn xuất</a></li>
							</ul>
						</li>
						<li class="list_link_item">
							<a href="{{route('statistic-invoice')}}" class="lb-xsmall lb-link active">
								Thống kê tài chính
							</a>
						</li>
					</ul>
				</div>
				<div class="wrap_content">
					<div class="wrap_chart mb-48">
						<div class="wrap_filter_date">
							<div class="form-group">
								<div class="form-label">
									Từ
								</div>
								<div class="group">
									<input type="text" class="form-control date" value="@if($from!=''){{$from}}@endif" id="datepicker">
								</div>
							</div>
							<div class="form-group">
								<div class="form-label">
									Đến
								</div>
								<div class="group">
									<input type="text" class="form-control date" value="@if($to!=''){{$to}}@endif" id="datepicker2">
								</div>
							</div>
						</div>
						<div class="wrap_list_link_lb">
							<ul class="list_link_lb">
								<li class="list_link_item">
									<a href="{{route('statistic-invoice')}}" class="lb-xsmall lb-link @if($t=='this_month') active @endif">
										Tháng hiện tại
									</a>
								</li>
								<li class="list_link_item">
									<a href="{{route('statistic-invoice','last_month')}}" class="lb-xsmall lb-link @if($t=='last_month') active @endif">
										Tháng trước
									</a>
								</li>
								<li class="list_link_item">
									<a href="{{route('statistic-invoice','this_quarter')}}" class="lb-xsmall lb-link @if($t=='this_quarter') active @endif">
										Quý hiện tại
									</a>
								</li>
								<li class="list_link_item">
									<a href="{{route('statistic-invoice','this_year')}}" class="lb-xsmall lb-link @if($t=='this_year') active @endif">
										Năm nay
									</a>
								</li>
							</ul>
						</div>						
					</div>
					<div class="wrap_chart">
						<div class="title">
							Đồ thị tổng tiền hoá đơn
						</div>
						<div id="chart_total"></div>
					</div>
					<div class="wrap_chart">
						<div class="title">
							Đồ thị tổng số hoá đơn
						</div>
						<div id="chart_count"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection