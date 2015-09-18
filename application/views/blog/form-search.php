<h1>Search</h1>

<form action="" method="get" class="form-inline">
	<div class="form-group">
		<?php echo form_input(array(
			'name' => 'search',
			'class' => 'form-control',
			'placeholder' => 'Enter keyword'
		)); ?>
	</div>

	<?php echo form_submit(array(
		'name' => 'submit',
		'class' => 'btn btn-primary', 
		'value' => 'Search'
	)); ?>
</form>