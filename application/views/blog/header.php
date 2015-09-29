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
        <nav class="navigation">
            <ul class="main-navigation nav nav-tabs">
                <li class="<?php echo isset($is_home) ? 'active' : ''; ?>">
                    <?php echo anchor('blog', 'Home'); ?>
                </li>
                <li class="<?php echo isset($is_create) ? 'active' : ''; ?>">
                    <?php echo anchor('blog/create', 'Create'); ?>
                </li>
                <li class="<?php echo isset($is_search) ? 'active' : ''; ?>">
                    <?php echo anchor('blog/search', 'Search'); ?>
                </li>
            </ul> <!-- .main-navigation -->
        </nav> <!-- .navigation -->