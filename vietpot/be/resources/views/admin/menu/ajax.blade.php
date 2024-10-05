<div class="dd nestable_menu" id="nestable">
	<ol class="dd-list">
		<?php
		if(isset($menu) && count($menu)>0){
			foreach ($menu as $item) {
				if ($item->parent_id == 0) {
				?>
				<li class="dd-item dd3-item" data-id="{{$item->id}}">
					<div class="dd-handle dd3-handle"></div>
					<div class="dd3-content">
						{{$item->name}}
						<span class="action_menu">
							<a href="javascript:;" onclick="edit_menu({{$item->id}},'{{$item->name}}','{{$item->url}}','{{route('post-quick-add')}}')"><i class="fa fa-edit"></i></a>  
							<a href="javascript:;" onclick="delete_menu({{$item->id}},'{{route('post-quick-delete')}}','content_menu_edit')"><i class="fa fa-trash"></i></a>
						</span>
						<span class="link_menu">{{$item->url}}</span>											
					</div>
					<?php
					$check_child_1 = 0;
					foreach ($menu as $item_check) {
						if ($item_check->parent_id == $item->id) {
							$check_child_1++;
						}
					}
					if ($check_child_1 > 0) {
						echo '<ol class="dd-list">';
						foreach ($menu as $item1) {													
							if ($item1->parent_id == $item->id) {
								?>
							<li class="dd-item dd3-item" data-id="{{$item1->id}}">
								<div class="dd-handle dd3-handle"></div>
								<div class="dd3-content">
									
									{{$item1->name}}
									<span class="action_menu"><a href="javascript:;" onclick="edit_menu({{$item1->id}},'{{$item1->name}}','{{$item1->url}}','{{route('post-quick-add')}}')"><i class="fa fa-edit"></i></a>  
									<a href="javascript:;" onclick="delete_menu({{$item1->id}},'{{route('post-quick-delete')}}','content_menu_edit')"><i class="fa fa-trash"></i></a></span>
									<span class="link_menu">{{$item1->url}}</span>	
									
								</div>
								<?php
								$check_child_2 = 0;
								foreach ($menu as $item_check1) {
									if ($item_check1->parent_id == $item1->id) {
										$check_child_2++;
									}
								}
								if ($check_child_2 > 0) {
									echo '<ol class="dd-list">';
									foreach ($menu as $item2) {
										if ($item2->parent_id == $item1->id) {
											?>
										<li class="dd-item dd3-item" data-id="{{$item2->id}}">
											<div class="dd-handle dd3-handle"></div>
											<div class="dd3-content">
												
												{{$item2->name}}
												<span class="action_menu"><a href="javascript:;" onclick="edit_menu({{$item2->id}},'{{$item2->name}}','{{$item2->url}}','{{route('post-quick-add')}}')"><i class="fa fa-edit"></i></a>  
												<a href="javascript:;" onclick="delete_menu({{$item2->id}},'{{route('post-quick-delete')}}','content_menu_edit')"><i class="fa fa-trash"></i></a></span>
												<span class="link_menu">{{$item2->url}}</span>	
											
											</div>
										</li>
										<?php
									}
								}
								echo '</ol>';
							}
							?>
							</li>
							<?php
						}
					}
					echo '</ol>';
				}
				?>
				</li>
				<?php
				}	
			}
											
		}
		?>
	</ol>
</div>