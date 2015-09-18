<h2>Are you sure you want to delete?</h2>
<p>This action cannot be undone!</p>

<?php echo form_open(); ?>

	<?php echo form_submit(array(
		'class' => 'btn btn-danger',
		'name' => 'delete', 
		'value' => 'Delete'
	)); ?>

	<?php echo form_submit(array(
		'class' => 'btn btn-default',
		'name' => 'cancel', 
		'value' => 'Cancel'
	)); ?>

<?php echo form_close(); ?>