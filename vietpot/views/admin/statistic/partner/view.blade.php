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

</script>
@endsection

@section("content")
@include('admin.header_bottom')
<section class="section_data_customer">
	<div class="container-main">
		<div class="section_title d-flex flex-row align-items-center justify-content-between">
			<div class="title">
				<h2>
					{{App\Models\CommonModel::get_lang('setting_navigation7')}}
				</h2>
			</div>
		</div>
		<div class="section_content">
			<div class="wrap_head">
				<div class="wrap_list_link_lb wrap_list_link_lb_bd">
					<ul class="list_link_lb">
						<li class="list_link_item">
							<a href="{{route('view-user')}}" class="lb-xsmall lb-link">
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
				
			</div>
			<div class="wrap_content">
				
				<div class="wrap_list_link_lb">
					<ul class="list_link_lb justify-content-center">
						<li class="list_link_item">
							<a href="#" class="lb-xsmall lb-link active">
								Thống kê và đồ thị theo hãng
							</a>
						</li>
						<li class="list_link_item">
							<a href="#" class="lb-xsmall lb-link ">
								Thống kê và đồ thị theo khách hàng
							</a>
						</li>
						<li class="list_link_item">
							<a href="#" class="lb-xsmall lb-link ">
								Thống kê và đồ thị theo sản phẩm
							</a>
						</li>
					</ul>
				</div>
				<div class="wrap_list_link_text">
					<ul class="list_link_lb_text justify-content-center">
						<li class="list_link_text_item">
							<a href="{{route('view-statistic')}}" class="lb-link-bd @if($p=='all') active @endif">
								{{App\Models\CommonModel::get_lang('setting_all')}}
							</a>
						</li>
						@if(isset($partner) && count($partner)>0)
						@foreach($partner as $item)
						<li class="list_link_text_item">
							<a href="{{route('view-statistic',$item->partner_id)}}" class="lb-link-bd @if($p==$item->partner_id) active @endif">
								{{$item->name}}
							</a>
						</li>
						@endforeach
						@endif						
					</ul>
				</div>
				<div class="wrap_chart">
					<div class="title">
						Đồ thị thống kê theo tài chính
					</div>
					<div id="chart_total"></div>
				</div>
				<div class="wrap_chart">
					<div class="title">
						Đồ thị thống kê theo số lượng đơn
					</div>
					<div id="chart_count"></div>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection