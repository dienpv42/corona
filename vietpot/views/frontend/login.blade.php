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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="{{asset('assets/frontend')}}/assets/css/app.css">
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
<script src="{{asset('assets/frontend')}}/assets/js/app.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBMuTmH5CFgDsVjaw5CcUHvvYG_0Pwg7Bk&v=weekly&libraries=marker,places"></script>
<script>
$(document).on("click",'.btn-login', function () {
	$.ajaxSetup({
	  headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});	
	$.ajax({
		url: "{{route('default-login-post')}}",
		type: 'POST',
		dataType: 'json',
		data:{email:$("#email").val(),password:$("#password").val()},
		beforeSend: function ( xhr ) {
			$('body').loadingModal({text: 'Đang xử lý'});
			var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
			var time = 1000;
			delay(time).then(function() { $('body').loadingModal('animation', 'rotatingPlane').loadingModal('backgroundColor', 'gray'); return delay(time);})
		},	
		success: function (data, textStatus, jqXHR) {	
			if(data.check==0){
				toastr.error(data.content, ''); 
			}else{
				window.location.replace(data.content);
			}	
			var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
			var time = 1000;
			delay(time).then(function() { $('body').loadingModal('destroy') ;} );
		}
	});	
});
$(document).on("click",'.btn-register', function () {
	$.ajaxSetup({
	  headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});	
	$.ajax({
		url: "{{route('default-register-post')}}",
		type: 'POST',
		dataType: 'json',
		data:{email:$("#email1").val(),password:$("#password1").val(),repassword:$("#repassword1").val(),dic:$("#dic").val(),ico:$("#ico").val(),name:$("#name").val(),phone:$("#phone").val(),gps:$("#gps").val(),address:$("#address").val()},
		beforeSend: function ( xhr ) {
			$('body').loadingModal({text: 'Đang xử lý'});
			var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
			var time = 1000;
			delay(time).then(function() { $('body').loadingModal('animation', 'rotatingPlane').loadingModal('backgroundColor', 'gray'); return delay(time);})
		},	
		success: function (data, textStatus, jqXHR) {	
			if(data.check==0){
				toastr.error(data.content, ''); 
			}else{
				toastr.success(data.content, ''); 
				$("#frmr")[0].reset();
			}	
			var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
			var time = 1000;
			delay(time).then(function() { $('body').loadingModal('destroy') ;} );
		}
	});	
});
var markers=[];
async function initMap() {	
	var pos = new google.maps.LatLng(21.0226967, 105.8369637);
	const { Map,InfoWindow } = await google.maps.importLibrary("maps");
	const { AdvancedMarkerElement,PinElement } = await google.maps.importLibrary("marker");	
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
	
	var map = new Map(document.getElementById('map_canvas'), { 
		zoom: 13,  
		scrollwheel: false,
		center: pos,
		mapId: "DEMO_MAP_ID",
    }); 
	addMarker(pos);
	const input = document.getElementById("address");
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
		$('#gps').val(places[0].geometry.location);
        $("#address").val(places[0].formatted_address);
        map.fitBounds(bounds);
	});
	
	
	google.maps.event.addListener(map, 'click', function (event) {
		 //addMarker(event.latLng);
    });
	function addMarker(location) {
		clearMarkers();
		deleteMarkers();
		$('#gps').val(location);
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
@endsection

@section("content")
<div class="section_form_login">
	<div class="card_forms">
		
		<div class="card_title">
			Tài khoản
		</div>
		<div class="card_form">
			<form action="#" method="post">
			@csrf
				<div class="form-group">
					<label class="form-label">
						Email
					</label>
					{{Form::text('email','',array('class'=>'form-control','id'=>'email'))}}
				</div>
				<div class="form-group">
					<label ="form-label">
						{{App\Models\CommonModel::get_setting('setting_user7')}}
					</label>
					<input type="password" id="password" class="form-control">
					<a href="javascript:void(0)" class="text-forgot">
						Quên mật khẩu?
					</a>
				</div>
				<div class="form-group text-end">
					<button class="lb-small-success pd-e-60 pd-s-60 btn-login" type="button">
						Đăng nhập
					</button>
				</div>
			</form>
		</div>
	</div>
	<hr>
	<div class="card_forms">
		<div class="card_title">
			Đăng ký
		</div>
		<div class="card_label">
			Tạo tài khoản mới
		</div>
		<div class="card_form">
			<form action="" id="frmr">
				<div class="form-group">
					<div class="form-label">
					   {{App\Models\CommonModel::get_lang('setting_user2')}}
					</div>
					<div class="group">
						<input type="text" class="form-control" value="" id="address" placeholder="{{App\Models\CommonModel::get_lang('setting_user2')}}">
					</div>
				</div>
				<input id="gps" class="controls" type="hidden" value=""/>
				<div class="form-group">
					<div id="map_canvas"></div>
				</div>
				<div class="form-group">
					<label for="" class="form-label">
					{{App\Models\CommonModel::get_lang('setting_user6')}}
					</label>
					<input type="text" class="form-control" id="name">
				</div>
				<div class="form-group">
					<label for="" class="form-label">
					ICO
					</label>
					<input type="text" class="form-control" id="ico">
				</div>
				<div class="form-group">
					<label for="" class="form-label">
					DIC
					</label>
					<input type="text" class="form-control" id="dic">
				</div>
				<div class="form-group">
					<label for="" class="form-label">
						Email
					</label>
					<input type="text" class="form-control" id="email1">
				</div>
				<div class="form-group">
					<label for="" class="form-label">
						{{App\Models\CommonModel::get_lang('setting_user4')}}
					</label>
					<input type="text" class="form-control" id="phone">
				</div>
				<hr>
				<div class="form-group">
					<label for="" class="form-label">
						{{App\Models\CommonModel::get_lang('setting_user7')}}
					</label>
					<input type="password" class="form-control" id="password1">
				</div>
				<div class="form-group">
					<label for="" class="form-label">
						Nhập lại mật khẩu
					</label>
					<input type="password" class="form-control" id="repassword1">
				</div>
				<div class="form-group text-end">
					<button class="lb-small-success pd-e-60 pd-s-60 btn-register" type="button">
						Đăng ký
					</button>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection