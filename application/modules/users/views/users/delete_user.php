<div class="page-header">
    <h1><?php echo $page_heading; ?></h1>
</div>
<?php echo form_open('users/delete_user'); ?>
    <?php foreach ($query->result() as $row) : ?>
        <?php echo form_hidden('id', $row->usr_id); ?>
    <?php endforeach; ?>

    <button type="submit" class="btn btn-primary">Confirm</button>
    <?php echo anchor('users', 'Cancel'); ?>
<?php echo form_close(); ?>