@extends("admin.hometemplate")


@section('title', 'Admin & Dashboard')
@section('desc', 'Admin & Dashboard')
@section('keyword', 'Admin & Dashboard')

@section("css")
<link href="{{asset('assets/frontend')}}/assets/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{asset('assets/frontend')}}/assets/css/select2.min.css">
<link rel="stylesheet" type="text/css" href="{{asset('assets/frontend')}}/assets/css/select2-bootstrap-5-theme.min.css">
<link rel="stylesheet" type="text/css" href="{{asset('assets/frontend')}}/assets/css/select2-bootstrap-5-theme.rtl.min.css">
<link rel="stylesheet" href="{{asset('assets/frontend')}}/assets/css/plugin-collection.css">
<link rel="stylesheet" href="{{asset('assets/frontend')}}/assets/css/icofont.min.css">
<link rel="stylesheet" href="{{asset('assets/frontend')}}/assets/css/swiper.min.css">
<link rel="stylesheet" href="{{asset('assets/frontend')}}/assets/css/aos.css">
<link rel="stylesheet" href="{{asset('assets/frontend')}}/assets/css/app.css">
<link rel="stylesheet" href="{{asset('assets/frontend')}}/assets/css/dataTables.bootstrap5.min.css">
<style>
.section_head .active{
	background: #EEE;
    color: #2196F3;
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
<script src="{{asset('assets/frontend')}}/assets/js/select2.full.min.js"></script>
<script src="{{asset('assets/frontend')}}/assets/js/app.js"></script>
<script src="{{asset('assets/frontend')}}/assets/js/admin.js"></script>
<script src="{{asset('assets/frontend')}}/assets/js/jquery.dataTables.min.js"></script>
<script src="{{asset('assets/frontend')}}/assets/js/dataTables.bootstrap5.min.js"></script>
<script>
$('.select2').select2();
$(document).on('change', '.change_detail', function() {
	var t=$(this);	
	var id = $(this).data('id');
	if($(this).data('type')=='price'){
		var vat = parseInt($("#pricevat_"+id).val());
		var price = parseFloat($(this).val());
		var price_vat = price+vat*price/100;
		$("#text_pricevat_"+id).text(price_vat.toFixed(2));
	}	
	$.ajaxSetup({
	  headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});
	$.ajax({
		url: "{{route('post-update_more-order')}}",
		type: 'POST',
		dataType: 'json',
		data: {id:id,value:$(this).val(),type:$(this).data('type')},	
		success: function (msg, textStatus, jqXHR) {
			if(msg.check==0){
				toastr.error(msg.content, ''); 
			}
		}
	});	
});
$(document).on('click', '.btn-remove', function() {
	$.ajaxSetup({
	  headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});
	var url = "{{route('view-order')}}";
	$.ajax({
		url: "{{route('post-delete-order')}}",
		type: 'POST',
		dataType: 'json',
		data: {id:$("#modalConfirm_id").val()},	
		success: function (msg, textStatus, jqXHR) {
			if(msg.check==0){
				toastr.error(msg.content, ''); 
			}else{
				window.location.replace(url);
			}
		}
	});
});
$(document).on('click', '.remove_t', function() {
	var t=$(this);
	var id = $(this).data('id');
	$.ajaxSetup({
	  headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});
	$.ajax({
		url: "{{route('post-remove_more-order')}}",
		type: 'POST',
		dataType: 'json',
		data: {id:id},	
		success: function (msg, textStatus, jqXHR) {
			if(msg.check==0){
				toastr.error(msg.content, ''); 
			}else if(msg.check==1){
				t.parent().parent().remove();
			}else{
				$("#modalConfirm_id").val(msg.id);
				$("#modalConfirm").modal('show');
			}
		}
	});	
});
$(document).on('click', '.add_product', function() {
	if($("#product_id").val()){
		if($("#tr"+$("#product_id").val()).length === 0){
			$.ajaxSetup({
			  headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			  }
			});
			$.ajax({
				url: "{{route('post-add_more-order')}}",
				type: 'POST',
				dataType: 'json',
				data: {id:$("#id").val(),product_id:$("#product_id").val()},	
				success: function (msg, textStatus, jqXHR) {
					if(msg.check==0){
						toastr.error(msg.content, ''); 
					}else{
						$("#table_product").append(msg.content);
						$('.mask_number').maskNumber({float:true});
					}
				}
			});			
		}else{
			toastr.error('Đã có sản phẩm này', ''); 
		}
	}else{
		toastr.error('Chưa chọn sản phẩm', ''); 
	}
});

</script>
@endsection

@section("content")
@include('admin.header_bottom')
<div class="modal fade modal-custom" id="modalConfirm" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Thông báo</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
					<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
						<path d="M9.99935 18.4583C5.33383 18.4583 1.54102 14.6655 1.54102 9.99996C1.54102 5.33444 5.33383 1.54163 9.99935 1.54163C14.6649 1.54163 18.4577 5.33444 18.4577 9.99996C18.4577 14.6655 14.6649 18.4583 9.99935 18.4583ZM9.99935 1.79163C5.47321 1.79163 1.79102 5.47382 1.79102 9.99996C1.79102 14.5261 5.47321 18.2083 9.99935 18.2083C14.5255 18.2083 18.2077 14.5261 18.2077 9.99996C18.2077 5.47382 14.5255 1.79163 9.99935 1.79163Z"
							  fill="#6D727B" stroke="#6D727B"/>
						<path d="M7.72861 12.4465L7.72251 12.4526L7.71663 12.4589C7.71335 12.4624 7.70628 12.4684 7.69236 12.4739C7.67775 12.4797 7.65941 12.4834 7.64049 12.4834C7.62281 12.4834 7.60729 12.4802 7.59397 12.4748C7.58111 12.4696 7.56706 12.4612 7.55238 12.4465C7.53085 12.425 7.51758 12.3942 7.51758 12.3584C7.51758 12.3225 7.53085 12.2918 7.55238 12.2703L7.19883 11.9167L7.55238 12.2703L12.269 7.5536L11.9191 7.20369L12.269 7.5536C12.2906 7.53208 12.3213 7.5188 12.3572 7.5188C12.393 7.5188 12.4237 7.53208 12.4453 7.5536C12.4668 7.57513 12.4801 7.60586 12.4801 7.64172C12.4801 7.67757 12.4668 7.7083 12.4453 7.72983L7.72861 12.4465Z"
							  fill="#6D727B" stroke="#6D727B"/>
						<path d="M12.3572 12.9834C12.1988 12.9834 12.0405 12.925 11.9155 12.8L7.19883 8.08338C6.95716 7.84172 6.95716 7.44172 7.19883 7.20005C7.44049 6.95838 7.84049 6.95838 8.08216 7.20005L12.7988 11.9167C13.0405 12.1584 13.0405 12.5584 12.7988 12.8C12.6738 12.925 12.5155 12.9834 12.3572 12.9834Z"
							  fill="#6D727B"/>
					</svg>
				</button>
			</div>
			<div class="modal-body">
				<input type="hidden" id="modalConfirm_id"/>
				<div class="wrap_confirm">
					Bạn đang thao tác xoá toàn bộ đơn hàng!
				</div>
			</div>
			<div class="modal-footer modal-footer-flex-1">
				<button type="button" class="lb-xsmall" data-bs-dismiss="modal">Huỷ</button>
				<button type="button" class="lb-xsmall-primary btn-remove">Tiếp tục</button>
			</div>
		</div>
	</div>
</div>
<section class="section_data_customer">
	<div class="container-main">
		<div class="section_title d-flex flex-row align-items-center justify-content-between">
			<div class="title">
				<h2>
					{{App\Models\CommonModel::get_lang('setting_order21')}}
				</h2>
			</div>
		</div>
		<div class="section_content">
			<div class="wrap_head">
				<input type="hidden" id="id" value="{{$data->id}}"/>
				<div class="wrap_content">
					<div class="wrap_form">
						<div class="form-group">
							<div class="form-label">
								{{App\Models\CommonModel::get_lang('setting_order12')}}
							</div>
							<div class="group">
								<input type="text" readonly class="form-control" value="@if(isset($user) && !empty($user)){{$user->name}} - {{$user->phone}}@endif">
							</div>
						</div>
						<div class="form-group">
							<div class="form-label">
								{{App\Models\CommonModel::get_lang('setting_order13')}}
							</div>
							<div class="group">
								<input type="text" readonly class="form-control" value="@if(isset($partner) && !empty($partner)){{$partner->name}}@endif">
							</div>
						</div>
						<div class="form-group">
							<div class="form-label">
								{{App\Models\CommonModel::get_lang('setting_order14')}}
							</div>
							<div class="group">
								<select class="form-control select2" id="product_id">
									<option value="">{{App\Models\CommonModel::get_lang('setting_order15')}}</option>
									@if(isset($product) && count($product)>0)
									@foreach($product as $item)	
									<option value="{{$item->id}}">{{$item->name}}</option>
									@endforeach
									@endif
								</select>								
							</div>
						</div>
						<div class="form-group">
							<a href="javascript:void(0)" class="lb-xsmall-primary pd-s-100 pd-e-100 mt-5 add_product">Thêm sản phẩm</a>
						</div>
					</div>
					<div class="wrap_table table-scroll table-responsive-lg mt-5">
						<table class="table">
							<thead>
								<tr>
								  <th scope="col">{{App\Models\CommonModel::get_lang('setting_order14')}}</th>
								  <th scope="col">{{App\Models\CommonModel::get_lang('setting_order17')}}</th>
								  <th scope="col">{{App\Models\CommonModel::get_lang('setting_order18')}}</th>
								  <th scope="col">{{App\Models\CommonModel::get_lang('setting_order19')}}</th>
								  <th scope="col">
									
								  </th>
								</tr>
							</thead>
							<tbody id="table_product">
								@if(isset($detail) && count($detail)>0)
								@foreach($detail as $item)								
								<tr id="tr{{$item->product_id}}">
									<td>{{$item->name}}</td>
									<td><input type="hidden" id="pricevat_{{$item->id}}" value="{{$item->vat}}"/><input type="text" data-id="{{$item->id}}" data-type="price" class="form-control mask_number change_detail" value="{{$item->price_no_vat}}"></td>
									<td id="text_pricevat_{{$item->id}}">{{$item->price_vat}}</td>
									<td><input type="text" data-id="{{$item->id}}" data-type="quantity" value="{{$item->quantity}}" min="1" class="form-control change_detail" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57"></td>
									<td><a href="javascript:void(0)" data-id="{{$item->id}}" class="remove_t"><i class="icofont-trash"></i></a></td>
								</tr>
								@endforeach
								@endif
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection