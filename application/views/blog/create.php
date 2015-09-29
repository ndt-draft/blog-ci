<h2>Create new post</h2>

<?php echo form_open('blog/create'); ?>

	<?php $this->view('blog/form'); ?>

<?php echo form_close(); ?>
