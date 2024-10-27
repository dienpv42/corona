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
<script src="{{asset('assets/admin')}}/assets/tinymce/tinymce.min.js" type="text/javascript"></script>
<script>
tinymce.init({
	selector: '.tinymce_editor',
	menu : {
		file: {title: 'File', items: 'newdocument'},
		edit: {title: 'Edit', items: 'undo redo | cut copy paste pastetext | selectall'},
		insert: {title: 'Insert', items: 'image link media codesample'},
		format: {title: 'Format', items: 'bold italic underline strikethrough superscript subscript codeformat | formats blockformats fontsizes align | forecolor backcolor | removeformat'},
	},
	plugins: [
		'advlist autolink lists link charmap print preview hr anchor pagebreak',
		'searchreplace wordcount visualblocks visualchars code fullscreen',
		'insertdatetime nonbreaking save table contextmenu directionality',
		'template paste textcolor colorpicker textpattern imagetools toc help'
	],
	toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link unlink',
	toolbar2: 'print preview | forecolor backcolor fontsizeselect | help',
	image_advtab: true,
	fontsize_formats: "8px 10px 12px 14px 18px 24px 36px 72px",
	convert_urls: false,
	branding: false,
	height: 600,
	language: 'vi_VN'
});
$("input[name='radiobutton']").on('click', function () {
	tinymce.get('content').setContent($("#email_content"+$(this).val()).val());
});
$('.type-report').on('click', function () {
	$('.type-report').removeClass('active');
	$(this).addClass('active');
});
$('#selectAll').on('click', function () {
	var isChecked = $(this).is(':checked');
	if(isChecked){
		$(".partner-input").prop('checked',true);
	}else{
		$(".partner-input").prop('checked',false);
	}
});
$(document).on('click', '.btn-add', function() {
	var id=$(this).data('id');
	$.ajaxSetup({
	  headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});
	var list_id=[];
	$(".partner-input").each(function(){
		if($(this).is(':checked')){
			list_id.push($(this).val());
		}
	});
	$.ajax({
		url: "{{route('post-add-report')}}",
		type: 'POST',
		dataType: 'json',
		data: {id:$("#id").val(),type:$(".type-report.active").data('type'),name:$('#name').val(),content:tinymce.get('content').getContent(),list_id:list_id},	
		success: function (msg, textStatus, jqXHR) {
			if(msg.check==0){
				toastr.error(msg.content, ''); 
			}else{				
				location.reload();
				//toastr.success(msg.content, ''); 
			}
		}
	});
});
</script>
@endsection

@section("content")
@include('admin.header_bottom')
<input type="hidden" id="id" value="{{$id}}"/>
<section class="section_data">
	<div class="container-main">
		<div class="section_title d-flex flex-row align-items-center justify-content-between">
			<div class="title">
				<h2>
					 {{App\Models\CommonModel::get_lang("setting_report1")}}
				</h2>
			</div>
			<a href="{{route('view-report')}}" class="text_link">
				 {{App\Models\CommonModel::get_lang("setting_report2")}}
			</a>
		</div>
		<div class="section_content mb-48">
			<div class="wrap_list_link_lb">
				<ul class="list_link_lb justify-content-center">
					@if(isset($partner) && count($partner)>0)
					@foreach($partner as $item)
					<li class="list_link_item">
						<a href="{{route('add-report',$item->partner_id)}}" class="lb-xsmall lb-link @if($item->partner_id == $id)active @endif">
							{{$item->name}}
						</a>
					</li>
					@endforeach
					@endif
				</ul>
			</div>
			<div class="wrap_content">
				<div class="wrap_table table-scroll table-responsive-lg">
					<table id="customerTable" class="table table-bordered" style="width:100%">
						<thead>
						<tr>
							<th scope="col" style="width: 50px">
								<input class="form-check-input" type="checkbox" id="selectAll">
								<label class="form-check-label" for="selectAll"></label>
							</th>
							<th scope="col">Email</th>
							<th scope="col"> {{App\Models\CommonModel::get_lang("setting_report13")}}</th>
							<th scope="col">{{App\Models\CommonModel::get_lang("setting_partner15")}}</th>
							<th scope="col">{{App\Models\CommonModel::get_lang("setting_partner16")}}</th>
						</tr>
						</thead>
						<tbody>
							@if(isset($account) && count($account)>0)
							@foreach($account as $item)
							<tr data-customer-id="{{$item->id}}">
								<td><input class="form-check-input row-select partner-input" value="{{$item->id}}" type="checkbox"></td>
								<td>{{$item->email}}</td>
								<td>{{$item->name}}</td>
								<td>{{$item->position}}</td>
								<td>{{$item->phone}}</td>
							</tr>
							@endforeach
							@endif
					
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<div class="section_content">
			<div class="wrap_head">
				<div class="wrap_head_title d-flex flex-row align-items-center justify-content-between">
					<div class="title">
						<h3> {{App\Models\CommonModel::get_lang("setting_report3")}}</h3>
					</div>
				</div>
			</div>
			<div class="wrap_list_link_lb">
				<ul class="list_link_lb justify-content-center">
					<li class="list_link_item list_link_item_auto">
						<a href="javascript:void(0)" data-type="0" class="type-report lb-xsmall lb-link active">
							 {{App\Models\CommonModel::get_lang("setting_report4")}}
						</a>
					</li>
					<li class="list_link_item list_link_item_auto">
						<a href="javascript:void(0)" data-type="1" class="type-report lb-xsmall lb-link">
							 {{App\Models\CommonModel::get_lang("setting_report5")}}
						</a>
					</li>
					<li class="list_link_item list_link_item_auto">
						<a href="javascript:void(0)" data-type="2" class="type-report lb-xsmall lb-link">
							 {{App\Models\CommonModel::get_lang("setting_report6")}}
						</a>
					</li>
					<li class="list_link_item list_link_item_auto">
						<a href="javascript:void(0)" data-type="3" class="type-report lb-xsmall lb-link">
							 {{App\Models\CommonModel::get_lang("setting_report7")}}
						</a>
					</li>
					<li class="list_link_item list_link_item_auto">
						<a href="javascript:void(0)" data-type="4" class="type-report lb-xsmall lb-link">
							 {{App\Models\CommonModel::get_lang("setting_report8")}}
						</a>
					</li>
				</ul>
			</div>
			<div class="wrap_form wrap_form_full">
				<div class="form-group">
					<div class="form-label">
						 {{App\Models\CommonModel::get_lang("setting_report9")}}
					</div>
					<div class="group">
						<input type="text" id="name" class="form-control" placeholder="{{App\Models\CommonModel::get_lang('setting_report9')}}">
					</div>
				</div>
				<div class="form-group">
					<div class="form-label">
						 {{App\Models\CommonModel::get_lang("setting_report10")}}
					</div>
					<div class="group">
						<div class="wrap_list_checkbox">
							@if(isset($template) && count($template)>0)
							@foreach($template as $item)
							<div class="form-group">
								<div class="form-check">
									<textarea id="email_content{{$item->id}}" style="display:none">{!!$item->content!!}</textarea>
									<input class="form-check-input" name="radiobutton" type="radio" value="{{$item->id}}" id="typeAccount{{$item->id}}">
									<label class="form-check-label" for="typeAccount{{$item->id}}">
									{{$item->name}}
									</label>
								</div>
							</div>
							@endforeach
							@endif
						</div>
					</div>
				</div>
				<div class="form-group">
					<textarea class="form-control tinymce_editor" name="" id="content" cols="30" rows="15"></textarea>
				</div>
				<div class="form-group justify-content-end">
					<a href="javascript:void(0)" class="lb-xsmall-primary pd-s-60 pd-e-60 btn-add"> {{App\Models\CommonModel::get_lang("setting_send")}}</a>
				</div>
			</div>
		</div>

	</div>
</section>

@endsection