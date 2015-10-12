<?php if (isset($login_fail)) : ?>
    <div class="alert alert-danger">
        <?php echo $this->lang->line('admin_login_error'); ?>
    </div>
<?php endif; ?>
<?php echo validation_errors(); ?>
<?php echo form_open('users/me/change_password', 'class="form-signin" role="form"'); ?>
    <h2 class="form-signin-heading"><?php echo $this->lang->line('forgot_pwd_header'); ?></h2>
    <p class="lead"><?php $this->lang->line('forgot_pwd_instruction'); ?></p>
    <div class="form-group">
        <?php echo form_input($usr_new_pwd_1); ?>
    </div>
    <div class="form-group">
        <?php echo form_input($usr_new_pwd_2); ?>
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit">
        <?php echo $this->lang->line('common_form_elements_go'); ?>
    </button>
    <br>
<?php echo form_close(); ?>
