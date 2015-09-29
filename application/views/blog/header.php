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
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="<?php echo isset($is_home) ? 'active' : ''; ?>">
                            <?php echo anchor('blog', 'Home'); ?>
                        </li>
                        <li class="<?php echo isset($is_create) ? 'active' : ''; ?>">
                            <?php echo anchor('blog/create', 'Create'); ?>
                        </li>
                        <li class="<?php echo isset($is_search) ? 'active' : ''; ?>">
                            <?php echo anchor('blog/search', 'Search'); ?>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#">Sign up</a></li>
                        <li><a href="#">Sign in</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">User <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="">Signed in as <strong>john-doe</strong></a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#">Your Profile</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#">Sign out</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Admin <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="">Signed in as <strong class="text-danger">admin</strong></a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="<?php echo base_url('me'); ?>">Your Profile</a></li>
                                <li><a href="<?php echo base_url('users'); ?>">Users</a></li>
                                <li><a href="<?php echo base_url('menus'); ?>">Menus</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="<?php echo base_url('settings'); ?>">Settings</a></li>
                                <li><a href="<?php echo base_url('signout'); ?>">Sign out</a></li>
                            </ul>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>