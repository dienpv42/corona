@extends("admin.layout.hometemplate")

@section('title', 'Admin & Dashboard')
@section('desc', 'Admin & Dashboard')
@section('keyword', 'Admin & Dashboard')

@section("css")
<link rel="stylesheet" type="text/css" href="{{asset('assets/admin')}}/assets/css/fontawesome.css">
<!-- ico-font-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/admin')}}/assets/css/icofont.css">
<!-- Themify icon-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/admin')}}/assets/css/themify.css">
<!-- Flag icon-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/admin')}}/assets/css/flag-icon.css">
<!-- Feather icon-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/admin')}}/assets/css/feather-icon.css">
<!-- Plugins css start-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/admin')}}/assets/css/datatables.css">
<!-- Bootstrap css-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/admin')}}/assets/css/bootstrap.css">
<!-- App css-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/admin')}}/assets/css/style.css">
<link id="color" rel="stylesheet" href="{{asset('assets/admin')}}/assets/css/color-1.css" media="screen">
<!-- Responsive css-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/admin')}}/assets/css/responsive.css">
<style type="text/css">

	.dd { position: relative; display: block; margin: 0; padding: 0; list-style: none; font-size: 13px; line-height: 20px; }

	.dd-list { display: block; position: relative; margin: 0; padding: 0; list-style: none; }
	.dd-list .dd-list { padding-left: 30px; }
	.dd-collapsed .dd-list { display: none; }

	.dd-item,
	.dd-empty,
	.dd-placeholder { display: block; position: relative; margin: 0; padding: 0; min-height: 20px; font-size: 13px; line-height: 20px; }

	.dd-handle { display: block;
				 height: 30px;
				 margin: 5px 0; 
				 padding: 4px 10px; 
				 color: #333; text-decoration: none; font-weight: bold; border: 1px solid #ccc;
				 background: #F5F6F7;
				 -webkit-border-radius: 3px;
				 border-radius: 3px;
				 box-sizing: border-box; -moz-box-sizing: border-box;
	}


	.dd-item > button { display: block; position: relative; cursor: pointer; float: left; width: 25px; height: 20px; margin: 5px 0; padding: 0; text-indent: 100%; white-space: nowrap; overflow: hidden; border: 0; background: transparent; font-size: 12px; line-height: 1; text-align: center; font-weight: bold; }
	.dd-item > button:before { content: '+'; display: block; position: absolute; width: 100%; text-align: center; text-indent: 0; }
	.dd-item > button[data-action="collapse"]:before { content: '-'; }

	.dd-placeholder,
	.dd-empty { margin: 5px 0; padding: 0; min-height: 30px; background: #f2fbff; border: 1px dashed #b6bcbf; box-sizing: border-box; -moz-box-sizing: border-box; }
	.dd-empty { border: 1px dashed #bbb; min-height: 100px; background-color: #e5e5e5;
				background-image: -webkit-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
					-webkit-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
				background-image:    -moz-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
					-moz-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
				background-image:         linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
					linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
				background-size: 60px 60px;
				background-position: 0 0, 30px 30px;
	}

	.dd-dragel { position: absolute; pointer-events: none; z-index: 9999; }
	.dd-dragel > .dd-item .dd-handle { margin-top: 0; }
	.dd-dragel .dd-handle {
		-webkit-box-shadow: 2px 4px 6px 0 rgba(0,0,0,.1);
		box-shadow: 2px 4px 6px 0 rgba(0,0,0,.1);
	}

	.action_menu .fa:first-child {
		margin-right: 5px;
	}
	.action_menu {
		border-left: 1px solid #ccc;
		float: right;
		width: 80px;
		padding-left: 20px;
	}
	.link_menu {
		border-left: 1px solid #ccc;
		float: right;
		padding: 0 5px 0px 15px;
		white-space: nowrap;
		width: 220px;
		overflow: hidden;
	}
	@media (max-width: 768px){

		.link_menu {
			display: none;
		}  
	}
	.dd3-content { display: block; height: 30px; margin: 5px 0; padding: 5px 10px 5px 40px; color: #333; text-decoration: none; font-weight: bold; border: 1px solid #ccc;
				   background: #fafafa;
				   background: -webkit-linear-gradient(top, #fafafa 0%, #eee 100%);
				   background:    -moz-linear-gradient(top, #fafafa 0%, #eee 100%);
				   background:         linear-gradient(top, #fafafa 0%, #eee 100%);
				   -webkit-border-radius: 3px;
				   border-radius: 3px;
				   box-sizing: border-box; -moz-box-sizing: border-box;
	}
	.dd3-content:hover {background: #fff; }

	.dd-dragel > .dd3-item > .dd3-content { margin: 0; }

	.dd3-item > button { margin-left: 30px; }

	.dd3-handle { position: absolute; margin: 0; left: 0; top: 0; cursor: pointer; width: 30px; text-indent: 100%; white-space: nowrap; overflow: hidden;
				  border: 1px solid #1DB399;
				  background: #23d4b5;
				  border-top-right-radius: 0;
				  border-bottom-right-radius: 0;
	}
	.dd3-handle:before { content: '≡'; display: block; position: absolute; left: 0; top: 3px; width: 100%; text-align: center; text-indent: 0; color: #fff; font-size: 20px; font-weight: normal; }
	.dd3-handle:hover { background: #23d4b5; }
</style>
<script>
    var url_update_position = "{{route('post-quick-edit')}}";
</script>
@endsection
@section("js")
<script src="{{asset('assets/admin')}}/assets/js/jquery-3.5.1.min.js"></script>
<!-- feather icon js-->
<script src="{{asset('assets/admin')}}/assets/js/icons/feather-icon/feather.min.js"></script>
<script src="{{asset('assets/admin')}}/assets/js/icons/feather-icon/feather-icon.js"></script>
<!-- Sidebar jquery-->
<script src="{{asset('assets/admin')}}/assets/js/sidebar-menu.js"></script>
<script src="{{asset('assets/admin')}}/assets/js/config.js"></script>
<!-- Bootstrap js-->
<script src="{{asset('assets/admin')}}/assets/js/bootstrap/popper.min.js"></script>
<script src="{{asset('assets/admin')}}/assets/js/bootstrap/bootstrap.min.js"></script>
<script src="{{asset('assets/admin')}}/assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('assets/admin')}}/assets/js/datatable/datatables/datatable.custom.js"></script>
<!-- Plugins JS start-->
<script src="{{asset('assets/admin')}}/assets/js/tooltip-init.js"></script>
<!-- Plugins JS Ends-->
<!-- Theme js-->
<script src="{{asset('assets/admin')}}/assets/js/script.js"></script>
<script src="{{asset('assets/admin')}}/assets/js/jquery.nestable.js"></script>
<script src="{{asset('assets/admin')}}/assets/js/menu.js"></script>
<script>
</script>
@endsection

@section("content")
<div class="container-fluid">
	<div class="page-header">
		<div class="row">
			<div class="col-sm-6">
				<h3>Menu</h3>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{route('dashboard-index')}}">Dashboard</a></li>
					<li class="breadcrumb-item"><a href="{{route('view-menu')}}">Menu</a></li>
					<li class="breadcrumb-item active">Sửa</li>
				</ol>
			</div>
			<div class="col-sm-6">
				
			</div>
		</div>
	</div>
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-body">
					@include('admin.alert')
					<div class="row">
						<div class="col-12 col-lg-12">
							<div class="mb-3">
								<input type="hidden" name="id_edit" id="id_edit">
								<label class="col-form-label pt-0">Tên menu</label>
								<input id="name_group" class="form-control" data-link="{{route('post-rename-group')}}" name="name_group" type="text" value="{{$data->name}}">
								
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group m-form__group row">
								<div class="col-lg-8" id="content_menu_edit">
									@include('admin.menu.ajax')
								</div>
								<div  class="col-lg-4">
									<h4>Thêm menu</h4>
									<form method="post" action="{{route('post-quick-add')}}" id="form_add_menu">
									@csrf
									<input type="hidden" id="group_id" name="group_id" value="{{$data->id}}"/>
									<input type="hidden" id="menu_id_edit" name="menu_id_edit" value=""/>
									<input type="hidden" id="action_change" name="action_change" value="{{route('post-quick-edit')}}"/>                            
									<div class="form-group">
										<label class="col-lg-12 control-label" for="menu_name">Title menu</label>
										<div class="col-lg-12">   
											{{Form::text('name', null, array('class'=>'bg-focus form-control', 'id'=>'menu_name'))}}
										</div> 
									</div>
									<div class="form-group">
										<label class="col-lg-12 control-label" for="urlselectoption" style="padding-top: 5px;">Chọn</label>
										<div class="col-lg-12">   
											<select id="urlselectoption" class="bg-focus form-control" onchange="$('#menu_url').val($(this).val())">
												<optgroup label="Trang chủ">
													<option value="">---------------------------</option>
													<option value="{{asset('')}}">Trang chủ</option>	
													<option value="{{route('about')}}">About</option>	
													<option value="{{route('investor')}}">Investor</option>
													<option value="{{route('contract')}}">Contract</option>
													<option value="{{route('howtoget')}}">How to get</option>
													<option value="{{route('news')}}">News</option>
													<option value="{{route('package')}}">Product</option>
													<option value="{{route('notification')}}">Notification</option>
													<option value="{{route('question-view')}}">Question</option>
											    
												<option value="{{route('job')}}">Opportunity</option>
												</optgroup> 
													<optgroup label="Trang tĩnh">
													@if(isset($page) && count($page)>0)
													@foreach($page as $item)
													<option value="{{route('page',$item->page_slug)}}">{{$item->page_name}}</option>													
													
													@endforeach
													@endif
												</optgroup> 
											</select>
										</div> 
									</div>
									<div class="form-group">
										<label class="col-lg-12 control-label" for="menu_url" style="padding-top: 5px;">URL</label>
										<div class="col-lg-12" style="margin-bottom:10px;">   
											{{Form::text('url', null, array('class'=>'bg-focus form-control', 'id'=>'menu_url'))}}
										</div> 
									</div>
									
									<div class="form-group">
										<div class="col-lg-12 pull-right m-top15"> 
											<a href="javascript:;" class="btn btn-primary" onclick="add_menu('form_add_menu')" > Áp dụng</a>
										</div>
									</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>	
		</div>
	</div>
</div>

@endsection