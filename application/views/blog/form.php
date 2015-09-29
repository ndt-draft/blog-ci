<div class="form-group <?php echo form_error('title') ? 'has-error' : ''; ?>">
    <?php echo form_label('Title', 'title'); ?>
    <?php echo form_input(array(
        'id' => 'title',
        'name' => 'title',
        'class' => 'form-control',
        'value' => set_value('title', $title)
    )); ?>
    <?php echo form_error('title', '<p class="text-warning">', '</p>'); ?>
</div>

<div class="form-group <?php echo form_error('content') ? 'has-error' : ''; ?>">
    <?php echo form_textarea(array(
        'id' => 'content', 
        'name' => 'content',
        'class' => 'form-control',
        'value' => set_value('content', $content)
    )); ?>
    <?php echo form_error('content', '<p class="text-warning">', '</p>'); ?>
</div>

<div class="form-group <?php echo form_error('slug') ? 'has-error' : ''; ?>">
    <?php echo form_label('Slug', 'slug'); ?>
    <?php echo form_input(array(
        'id' => 'slug', 
        'name' => 'slug', 
        'class' => 'form-control',
        'value' => set_value('slug', $slug)
    )); ?>
    <?php echo form_error('slug', '<p class="text-warning">', '</p>'); ?>
</div>

<?php echo form_submit(array(
    'name' => 'submit',
    'class' => 'btn btn-primary',
    'value' => 'Submit'
)); ?>
