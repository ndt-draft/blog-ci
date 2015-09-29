<h2>Search</h2>

<form action="" method="get" id="form-search" class="form-inline">
	<div class="form-group">
		<?php echo form_input(array(
			'name' => 'search',
			'id' => 'search',
			'class' => 'form-control',
			'placeholder' => 'Enter keyword',
		)); ?>
	</div>

	<?php echo form_submit(array(
		'name' => 'submit',
		'id'    => 'submit',
		'class' => 'btn btn-primary', 
		'value' => 'Search',
	)); ?>
</form>

<div id="search-results"></div>