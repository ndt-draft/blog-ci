<?php echo form_label('Title', 'title'); ?>
<?php echo form_input(array('id' => 'title', 'name' => 'title', 'value' => set_value('title', $title))); ?>

<br>

<?php echo form_textarea('content', set_value('content', $content)); ?>

<br>

<?php echo form_label('Slug', 'slug'); ?>
<?php echo form_input(array('id' => 'slug', 'name' => 'slug', 'value' => set_value('slug', $slug))); ?>

<br>

<?php echo form_submit('submit', 'Submit'); ?>
