<!DOCTYPE html>
<html>
<head>
    <title>Blog CRUD App</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
    <script id="helper-js">
        var site_url = "<?php echo site_url(); ?>";
    </script>
</head>
<body>
    <div class="site">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo base_url('blog'); ?>">Blog CI</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="main-nav">
                    <?php nav_menu('primary'); ?>
                    <ul class="nav navbar-nav navbar-right">
                        <?php if (!$this->session->userdata('logged_in')) : ?>
                            <li><?php echo anchor('users/register', 'Register'); ?></li>
                            <li><?php echo anchor('users/signin', 'Sign in'); ?></li>
                        <?php elseif ($this->session->userdata('usr_access_level') > 1) : ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">User <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo base_url('users/me'); ?>">Signed in as <strong><?php echo $this->session->userdata('usr_email'); ?></strong></a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><?php echo anchor('users/me', 'Your profile'); ?></li>
                                    <li><?php echo anchor('users/me/change_password', 'Change password'); ?></li>
                                    <li role="separator" class="divider"></li>
                                    <li><?php echo anchor('users/signin/signout', 'Sign out'); ?></li>
                                </ul>
                            </li>
                        <?php else : ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Admin <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo base_url('users/me'); ?>">Signed in as <strong><?php echo $this->session->userdata('usr_email'); ?></strong></a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="<?php echo base_url('users/me'); ?>">Your Profile</a></li>
                                    <li><a href="<?php echo base_url('users'); ?>">Users</a></li>
                                    <li><a href="<?php echo base_url('menus'); ?>">Menus</a></li>
                                    <li><?php echo anchor('users/me/change_password', 'Change password'); ?></li>
                                    <li role="separator" class="divider"></li>
                                    <li><?php echo anchor('users/signin/signout', 'Sign out'); ?></li>
                                </ul>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>