<?php if (isset($login_fail)) : ?>
    <div class="alert alert-danger">
        <?php echo $this->lang->line('admin_login_error'); ?>
    </div>
<?php endif; ?>
<?php echo validation_errors(); ?>
<?php echo form_open('users/password/new_password', 'class="form-signin" role="form"'); ?>
    <h2 class="form-signin-heading"><?php echo $this->lang->line('forgot_pwd_header'); ?></h2>
    <p class="lead"><?php $this->lang->line('signin_new_pwd_instruction'); ?></p>
    <div class="form-group">
        <?php echo form_input($usr_email); ?>
    </div>
    <div class="form-group">
        <?php echo form_input($usr_password1); ?>
    </div>
    <div class="form-group">
        <?php echo form_input($usr_password2); ?>
    </div>
    <?php echo form_hidden('code', $code); ?>
    <button class="btn btn-lg btn-primary btn-block" type="submit">
        <?php echo $this->lang->line('common_form_elements_go'); ?>
    </button>
    <br>
<?php echo form_close(); ?>