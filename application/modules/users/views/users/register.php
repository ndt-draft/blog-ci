<div class="container-fluid">
    <div class="row">
        <?php echo validation_errors(); ?>
        <?php echo form_open('users/register/index', 'role="form" class="form-signin"'); ?>
            <h2 class="form-signin-heading">
                <?php echo $this->lang->line('register_page_title'); ?>
            </h2>
            <input type="text" class="form-control" name="usr_fname" autofocus
                placeholder="<?php echo $this->lang->line('register_first_name'); ?>">
            <input type="text" class="form-control" name="usr_lname"
                placeholder="<?php echo $this->lang->line('register_last_name'); ?>">
            <input type="email" class="form-control" name="usr_email"
                placeholder="<?php echo $this->lang->line('register_email'); ?>">
            <?php echo form_submit(
                'submit',
                'Register',
                'class="btn btn-lg btn-primary btn-block"'
            ); ?>
        <?php echo form_close(); ?>
    </div>
</div>
