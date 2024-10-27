<section class="section_link_data">
	<div class="container-main">
		<div class="wrapper">
			<div class="section_head">
				<div class="title text-center">
					<a href="{{route('add-order')}}" class="lb-large @if(isset($navigation) && $navigation=='order_add') active @endif">
						{{App\Models\CommonModel::get_lang('setting_navigation1')}}
					</a>
				</div>
			</div>
			<div class="section_content">
				<div class="wrap_list_link_lb">
					<ul class="list_link_lb">
						<li class="list_link_item">
							<a href="{{route('dashboard-index')}}" class="lb-small lb-link @if(isset($navigation) && $navigation=='admin') active @endif">
								{{App\Models\CommonModel::get_lang('setting_navigation2')}}
							</a>
						</li>
						<li class="list_link_item">
							<a href="{{route('view-user')}}" class="lb-small lb-link @if(isset($navigation) && $navigation=='data') active @endif">
								{{App\Models\CommonModel::get_lang('setting_navigation3')}}
							</a>
						</li>
						<li class="list_link_item">
							<a href="{{route('view-invoice')}}" class="lb-small lb-link @if(isset($navigation) && $navigation=='finance') active @endif">
								{{App\Models\CommonModel::get_lang('setting_navigation4')}}
							</a>
						</li>
						<li class="list_link_item">
							<a href="{{route('view-partner-account')}}" class="lb-small lb-link @if(isset($navigation) && $navigation=='partner') active @endif">
								{{App\Models\CommonModel::get_lang('setting_navigation5')}}
							</a>
						</li>
						<li class="list_link_item">
							<a href="{{route('view-order')}}" class="lb-small lb-link @if(isset($navigation) && $navigation=='order') active @endif">
								{{App\Models\CommonModel::get_lang('setting_navigation6')}}
							</a>
						</li>
						<li class="list_link_item">
							<a href="{{route('view-statistic')}}" class="lb-small lb-link @if(isset($navigation) && $navigation=='statistic') active @endif">
								{{App\Models\CommonModel::get_lang('setting_navigation7')}}
							</a>
						</li>
						<li class="list_link_item">
							<a href="{{route('view-interact')}}" class="lb-small lb-link @if(isset($navigation) && $navigation=='contact') active @endif">
								{{App\Models\CommonModel::get_lang('setting_navigation8')}}
							</a>
						</li>
						<li class="list_link_item">
							<a href="{{route('add-report')}}" class="lb-small lb-link @if(isset($navigation) && $navigation=='report') active @endif">
								{{App\Models\CommonModel::get_lang('setting_navigation9')}}
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>