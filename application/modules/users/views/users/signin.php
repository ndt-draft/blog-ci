<?php if (isset($login_fail)) : ?>
    <div class="alert alert-danger">
        <?php echo $this->lang->line('admin_login_error'); ?>
    </div>
<?php endif; ?>
<div>
    <?php echo validation_errors(); ?>
    <?php echo form_open('users/signin/index', 'class="form-signin" role="form"'); ?>
        <h2 class="form-signin-heading">
            <?php echo $this->lang->line('admin_login_header'); ?>
        </h2>
        <div class="form-group">
            <input type="email" class="form-control" name="usr_email" required
            autofocus placeholder="<?php echo $this->lang->line('admin_login_email'); ?>">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="usr_password" required
                placeholder="<?php echo $this->lang->line('admin_login_password'); ?>">
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">
            <?php echo $this->lang->line('admin_login_signin'); ?>
        </button>
        <br>
        <?php echo anchor('users/password', $this->lang->line('signin_forgot_password')); ?>
    <?php echo form_close(); ?>
</div>
