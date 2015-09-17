<h1>Are you sure you want to delete?</h1>
<p>This action can not be undone!</p>

<?php echo form_open(); ?>

	<?php echo form_submit('delete', 'Delete'); ?>

	<?php echo form_submit('cancel', 'Cancel'); ?>

<?php echo form_close(); ?>