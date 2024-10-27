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
var locations = <?php echo json_encode($list) ?>;
async function initMap() {	
	const { Map,InfoWindow } = await google.maps.importLibrary("maps");
	const { AdvancedMarkerElement,PinElement } = await google.maps.importLibrary("marker");
	var map = new Map(document.getElementById('map_canvas'), { 
		zoom: 13,  
		scrollwheel: false,
		center: { lat: -33.9778791, lng: 22.4188544 },
		mapId: "DEMO_MAP_ID",
    }); 
	var markers=[];
	infoWindow = new InfoWindow();
	if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            (position) => {
                const pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude,
                };
                map.setCenter(pos);
				for (i = 0; i < locations.length; i++) {   
					const marker = new AdvancedMarkerElement({
					  position:new google.maps.LatLng(locations[i][2], locations[i][3]),
					  map:map,
					  title: locations[i][0]+"<br/>"+locations[i][1]+"<br/>"+locations[i][5],
					  gmpClickable: true
					});
					marker.addListener("click", ({ domEvent, latLng }) => {
					  const { target } = domEvent;

					  infoWindow.close();
					  infoWindow.setContent(marker.title);
					  infoWindow.open(marker.map, marker);
					});
					markers.push(marker);
				}   
				
            },
            () => {
                handleLocationError(true, infoWindow, map.getCenter());
            }
        );
    } else { 
        alert("Geolocation is not supported by this browser.");
    }	
	
}
initMap();
</script>
@endsection

@section("content")
@include('admin.header_bottom')
    <section class="section_admin">
        <div class="container-main">
            <div class="section_title d-flex flex-row align-items-center justify-content-between">
                <div class="title">
                    <h2>
                        Admin
                    </h2>
                </div>
                <a href="#" class="text_link">Lịch sử đăng nhập</a>
            </div>
            <div class="section_content">
                <div class="wrap_content">
                    <div class="wrap_list_link_lb">
                        <ul class="list_link_lb">
                            <li class="list_link_item list_link_item_50">
                                <a href="#" class="lb-xsmall lb-link">
                                    Chỉnh sửa website
                                </a>
                            </li>
                            <li class="list_link_item list_link_item_50">
                                <a href="#" class="lb-xsmall lb-link">
                                    Danh sách tài khoản
                                </a>
                            </li>
							<li class="list_link_item list_link_item_50">
                                <a href="{{route('view-admin')}}" class="lb-xsmall lb-link">
                                   Tạo tài khoản nội bộ
								   <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
									<path d="M9.99935 18.4584C5.33383 18.4584 1.54102 14.6656 1.54102 10.0001C1.54102 5.33456 5.33383 1.54175 9.99935 1.54175C14.6649 1.54175 18.4577 5.33456 18.4577 10.0001C18.4577 14.6656 14.6649 18.4584 9.99935 18.4584ZM9.99935 1.79175C5.47321 1.79175 1.79102 5.47394 1.79102 10.0001C1.79102 14.5262 5.47321 18.2084 9.99935 18.2084C14.5255 18.2084 18.2077 14.5262 18.2077 10.0001C18.2077 5.47394 14.5255 1.79175 9.99935 1.79175Z" fill="#6D727B" stroke="#6D727B"/>
									<path d="M13.3327 10.125H6.66602C6.63587 10.125 6.60459 10.1127 6.57894 10.0871C6.5533 10.0614 6.54102 10.0301 6.54102 10C6.54102 9.96985 6.5533 9.93857 6.57894 9.91293C6.60459 9.88728 6.63587 9.875 6.66602 9.875H13.3327C13.3628 9.875 13.3941 9.88728 13.4198 9.91293C13.4454 9.93857 13.4577 9.96985 13.4577 10C13.4577 10.0301 13.4454 10.0614 13.4198 10.0871C13.3941 10.1127 13.3628 10.125 13.3327 10.125Z" fill="#6D727B" stroke="#6D727B"/>
									<path d="M10 13.9584C9.65833 13.9584 9.375 13.6751 9.375 13.3334V6.66675C9.375 6.32508 9.65833 6.04175 10 6.04175C10.3417 6.04175 10.625 6.32508 10.625 6.66675V13.3334C10.625 13.6751 10.3417 13.9584 10 13.9584Z" fill="#6D727B"/>
								</svg>
                                </a>
								
                            </li>
							<li class="list_link_item list_link_item_50">
                                <a href="{{route('dashboard-map')}}" class="lb-xsmall lb-link active">
                                   Bản đồ khách hàng
                                </a>
                            </li>
                        </ul>
                    </div>

                    <hr class="hr-section">

                    <div class="section_map">
                        <div class="section_title section_title_s d-flex flex-column flex-lg-row align-items-start align-items-lg-center justify-content-lg-between">
                            <div class="title">
                                <h3>
                                    Bản đồ khách hàng
                                </h3>
                            </div>
                            <div class="wrap-action">
                                <div class="wrap_search">
                                    <div class="form-group">
                                        <input type="text" id="filter_search" class="form-control search" placeholder="Tìm kiếm" data-listener-added_c16d7b5e="true">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-lg-12">
                                <div class="ml-1">
                                    <div id="map_canvas"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection