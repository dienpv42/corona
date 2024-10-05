<?php
if (Session::has('admin_notify_success')) {
?>
<div class="alert alert-success alert-dismissible fade show mb-10" role="alert">
	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
	</button>
	{{Session::get('admin_notify_success')}}	
</div>
<?php } ?>

<?php
if (Session::has('admin_notify_error')) {
?>
<div class="alert alert-danger alert-dismissible fade show mb-10" role="alert">
	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
	</button>
	{{Session::get('admin_notify_error')}}	
</div>
<?php } ?>

<?php
if ($errors->any()) {
?>
<div class="alert alert-danger alert-dismissible fade show mb-10" role="alert">
	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
	</button>
	<ul>
		<?php
		foreach ($errors->all() as $errors_item) {
			echo $errors_item;
		}
		?>
	</ul>	
</div>
<?php } ?>