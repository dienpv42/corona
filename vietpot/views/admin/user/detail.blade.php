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
<style>
#map_canvas {
    height: 400px; /* The height is 400 pixels */
    width: 100%; /* The width is the width of the web page */
}
#eaddress {
  background-color: #fff;
  font-family: Roboto;
  font-size: 15px;
  font-weight: 300;
  padding: 0 11px 0 13px;
  text-overflow: ellipsis;
  width: 100%;
}

#eaddress:focus {
  border-color: #4d90fe;
}
.pac-container { z-index: 100000 !important; }
.bounce {
    animation: bounce 2s infinite;
    -webkit-animation: bounce 2s infinite;
    -moz-animation: bounce 2s infinite;
    -o-animation: bounce 2s infinite;
}
 
@-webkit-keyframes bounce {
    0%, 20%, 50%, 80%, 100% {-webkit-transform: translateY(0);} 
    40% {-webkit-transform: translateY(-30px);}
    60% {-webkit-transform: translateY(-15px);}
}
 
@-moz-keyframes bounce {
    0%, 20%, 50%, 80%, 100% {-moz-transform: translateY(0);}
    40% {-moz-transform: translateY(-30px);}
    60% {-moz-transform: translateY(-15px);}
}
 
@-o-keyframes bounce {
    0%, 20%, 50%, 80%, 100% {-o-transform: translateY(0);}
    40% {-o-transform: translateY(-30px);}
    60% {-o-transform: translateY(-15px);}
}
@keyframes bounce {
    0%, 20%, 50%, 80%, 100% {transform: translateY(0);}
    40% {transform: translateY(-30px);}
    60% {transform: translateY(-15px);}
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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBMuTmH5CFgDsVjaw5CcUHvvYG_0Pwg7Bk&v=weekly&libraries=marker,places"></script>
<script>
var markers=[];
async function initMap() {	
	var pos = new google.maps.LatLng(21.0226967, 105.8369637);
	const { Map,InfoWindow } = await google.maps.importLibrary("maps");
	const { AdvancedMarkerElement,PinElement } = await google.maps.importLibrary("marker");
	<?php if($data->gps){ 
	$latlon = explode(',',substr(substr($data->gps,0,-1),1));
	?>
	var pos = new google.maps.LatLng(<?php echo $latlon[0]; ?>, <?php echo $latlon[1]; ?>);
	<?php }else{ ?>	
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(
			(position) => {					
				var pos = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
			},
			() => {
				alert("Geolocation is not supported by this browser.");
			}
		);
	} else { 
		alert("Geolocation is not supported by this browser.");
	}	
	<?php } ?>
	var map = new Map(document.getElementById('map_canvas'), { 
		zoom: 13,  
		scrollwheel: false,
		center: pos,
		mapId: "DEMO_MAP_ID",
    }); 
	addMarker(pos);
	const input = document.getElementById("eaddress");
	const searchBox = new google.maps.places.SearchBox(input);
	//map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
	searchBox.addListener("places_changed", () => {
		const places = searchBox.getPlaces();
		if (places.length == 0) {
            return;
        }
        for (var i = 0, marker; marker = markers[i]; i++) {
            marker.setMap(null);
        }
		markers = [];
        var bounds = new google.maps.LatLngBounds();
        for (var i = 0, place; place = places[i]; i++) {
            
            addMarker(place.geometry.location);
			if (place.geometry.viewport) {
			  bounds.union(place.geometry.viewport);
			} else {
			  bounds.extend(place.geometry.location);
			}
        }
		console.log(places);
		$('#egps').val(places[0].geometry.location);
        $("#eaddress").val(places[0].formatted_address);
        map.fitBounds(bounds);
	});
	
	
	google.maps.event.addListener(map, 'click', function (event) {
		 //addMarker(event.latLng);
    });
	function addMarker(location) {
		clearMarkers();
		deleteMarkers();
		$('#egps').val(location);
		const marker = new AdvancedMarkerElement({
			map,
			position: location,
			title:location.lat()+'-'+location.lng(),
			gmpClickable: true,
		});		
		marker.content.classList.add("bounce");
	}
	function setAllMap(map) {
		for (var i = 0; i < markers.length; i++) {
			markers[i].setMap(map);
		}
	}
	function clearMarkers() {
		setAllMap(null);
	}
	function showMarkers() {
		setAllMap(map);
	}

	function deleteMarkers() {
	  clearMarkers();
	  markers = [];
	}
}
initMap();
</script>
<script>
$(".btn-edit").click(function(){
	$.ajaxSetup({
	  headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});
	$.ajax({
		url: "{{route('post-edit-user')}}",
		type: 'POST',
		dataType: 'json',
		data: {id:$("#id").val(),name:$("#ename").val(),address:$("#eaddress").val(),ico:$("#eico").val(),phone:$("#ephone").val(),gps:$("#egps").val(),dic:$("#edic").val(),bank:$("#ebank").val()},	
		success: function (msg, textStatus, jqXHR) {
			if(msg.check==0){
				toastr.error(msg.content, ''); 
			}else{				
				location.reload();
			}
		}
	});
});
$(".btn-code").click(function(){
	$.ajaxSetup({
	  headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});
	$.ajax({
		url: "{{route('post-user_code-user')}}",
		type: 'POST',
		dataType: 'json',
		data: {id:$("#id").val(),partner_id:$("#partner_id").val(),code:$("#code").val()},	
		success: function (msg, textStatus, jqXHR) {
			if(msg.check==0){
				toastr.error(msg.content, ''); 
			}else{				
				location.reload();
			}
		}
	});
});
$(".update_code").change(function(){
	$.ajaxSetup({
	  headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});
	$.ajax({
		url: "{{route('post-update_code-user')}}",
		type: 'POST',
		dataType: 'html',
		data: {value:$(this).val(),id:$(this).data('id')},	
		success: function (msg, textStatus, jqXHR) {
		
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
			url: "{{route('post-data_order-user')}}",
			type: "POST",
			data: {
				_token: $('meta[name="csrf-token"]').attr('content'),
				filter_partner: "<?php echo $p; ?>",filter_user: "<?php echo $id; ?>"
			}
		},
		"columns": [{
				data: "created_at",
				sortable: true
			},
			{
				data: 'order_code',
				sortable: false
			},
			{
				data: 'total_price_no_vat',
				sortable: false
			},
			{
				data: 'total_price_vat',
				sortable: false
			},{
				data: 'profit',
				sortable: false
			}
		],
		"order": [
			[0, "desc"]
		]
	});
	$.fn.dataTable.ext.errMode = 'throw';
	$('#invoiceTable tbody').on('click', 'tr[data-id]', function() {
		var tr = $(this);
		var row = table.row( tr );
		var record_id = $(this).data('id');
		var subtable_id = "subtable-"+record_id;
		$('#invoiceTable tbody tr.details-row').remove();
		$('#invoiceTable tbody tr').removeClass('shown selected');
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
		ajax:  {
			url: "{{route('post-data_order_detail-user')}}",
			type: "POST",
			data: {_token: $('meta[name="csrf-token"]').attr('content'),id:record_id}
		},	
		dom: '<"top"i>rCt<"footertable">',
		fnFooterCallback: function(nRow, aaData, iStart, iEnd, aiDisplay) {
			var api = this.api();	
			$('.footertable').html(api.ajax.json().html);  
			$('#'+table_id+'>tbody').after(api.ajax.json().tr);  
		},
		"columns": [	
			{ data: "name",sortable:true },
			{ data: "code",sortable:false },
			{ data: "unit",sortable:false },
			{ data: "price_no_vat",sortable:true },
			{ data: "price_vat",sortable:true },
			{ data: "quantity",sortable:true }
		],
		"order": [[5, "desc" ]]
	});	
	$(subtable.table().container()).addClass('wrap_table_detail');
}
function format(table_id) {
	return '<table id="'+table_id+'" class="table">'+
	'<thead>'+
	'<th>{{App\Models\CommonModel::get_lang("setting_product1")}}</th>'+
	'<th>{{App\Models\CommonModel::get_lang("setting_product2")}}</th>'+
	'<th>{{App\Models\CommonModel::get_lang("setting_product3")}}</th>'+
	'<th>{{App\Models\CommonModel::get_lang("setting_order17")}}</th>'+
	'<th>{{App\Models\CommonModel::get_lang("setting_order18")}}</th>'+
	'<th>{{App\Models\CommonModel::get_lang("setting_order19")}}</th>'+
	'</thead>'+
	'</table>';	
}
</script>
@endsection

@section("content")
@include('admin.header_bottom')
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
				<input type="hidden" id="eid"/>
                <div class="wrap_form_modal">
					 <div class="form-group">
                        <div class="form-label">
                             {{App\Models\CommonModel::get_lang('setting_user9')}}
                        </div>
                        <div class="group">
                            <input type="text" class="form-control" id="code">
                        </div>
                    </div>
					 <div class="form-group">
                        <div class="form-label">
                             {{App\Models\CommonModel::get_lang('setting_partner')}}
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
                <button type="button" class="lb-xsmall-primary pd-s-100 pd-e-100 btn-code">{{App\Models\CommonModel::get_lang('setting_save')}}</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade modal-custom" id="modalEdit" aria-hidden="true">
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
                            <input type="text" class="form-control" id="ename" value="{{$data->name}}">
                        </div>
                    </div>
					 <div class="form-group">
                        <div class="form-label">
                             {{App\Models\CommonModel::get_lang('setting_user4')}}
                        </div>
                        <div class="group">
                            <input type="text" class="form-control" id="ephone" value="{{$data->phone}}">
                        </div>
                    </div>
					<div class="form-group">
                        <div class="form-label">
                            {{App\Models\CommonModel::get_lang('setting_user8')}}
                        </div>
                        <div class="group">
                            <input type="text" class="form-control" id="ebank" value="{{$data->bank}}">
                        </div>
                    </div>
					<div class="form-group">
                        <div class="form-label">
                            IČO
                        </div>
                        <div class="group">
                            <input type="text" class="form-control" id="eico" value="{{$data->ico}}">
                        </div>
                    </div>				
					
					<div class="form-group">
                        <div class="form-label">
                            DIČ
                        </div>
                        <div class="group">
                            <input type="text" class="form-control" id="edic" value="{{$data->dic}}">
                        </div>
                    </div>		
					<div class="form-group">
                        <div class="form-label">
                           {{App\Models\CommonModel::get_lang('setting_user2')}}
                        </div>
                        <div class="group">
                            <input type="text" class="form-control" value="{{$data->address}}" id="eaddress" placeholder="Search Box">
                        </div>
                    </div>
					<input id="egps" class="controls" type="hidden" value="{{$data->gps}}"/>
					<div class="form-group">
						<div id="map_canvas"></div>
					</div>
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="lb-xsmall-primary pd-s-100 pd-e-100 btn-edit">{{App\Models\CommonModel::get_lang('setting_save')}}</button>
            </div>
        </div>
    </div>
</div>
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
									<th scope="col">
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
									</th>
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
							<a href="{{route('detail-user',$data->id)}}" class="lb-xsmall lb-link active">
								{{App\Models\CommonModel::get_lang('setting_user12')}}
							</a>
						</li>
						<li class="list_link_item">
							<a href="{{route('statistic-user',$data->id)}}" class="lb-xsmall lb-link">
								{{App\Models\CommonModel::get_lang('setting_user13')}}
							</a>
						</li>
					</ul>
				</div>
				<div class="wrap_list_link_text">
					<ul class="list_link_lb_text justify-content-center">
						<li class="list_link_text_item">
							<a href="{{route('detail-user',array($id,$p))}}" class="lb-link-bd @if($p=='all') active @endif">
								{{App\Models\CommonModel::get_lang('setting_all')}}
							</a>
						</li>
						@if(isset($list_code) && count($list_code)>0)
						@foreach($list_code as $item)
						<li class="list_link_text_item">
							<a href="{{route('detail-user',array($id,$item['partner_id']))}}" class="lb-link-bd @if($p==$item['partner_id']) active @endif">
								{{$item['name']}}
							</a>
						</li>
						@endforeach
						@endif						
					</ul>
				</div>
				<div class="wrap_table table-responsive-lg">
					<table id="invoiceTable" class="table">
						<thead>
						<tr>
							<th>{{App\Models\CommonModel::get_lang('setting_user24')}}</th>
							<th>{{App\Models\CommonModel::get_lang('setting_user25')}}</th>
							<th>{{App\Models\CommonModel::get_lang('setting_user26')}}</th>
							<th>{{App\Models\CommonModel::get_lang('setting_user27')}}</th>
							<th>{{App\Models\CommonModel::get_lang('setting_user28')}}</th>
						</tr>
						</thead>
						<tbody>
						
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection