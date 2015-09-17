<h2>Update post</h2>

<?php echo validation_errors(); ?>

<?php echo form_open(); ?>

	<?php $this->view('blog/form', $data);?> 

<?php echo form_close(); ?>
