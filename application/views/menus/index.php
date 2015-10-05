<h1 class="page-title menu-title">Menus</h1>

<?php if (isset($is_create_menu)) : ?>
    <div class="alert alert-info">
        <?php echo 'Give your menu a name below, then click Save Menu.'; ?>
    </div>
    <?php echo form_error('menu-name', '<div class="alert alert-danger">', '</div>'); ?>
<?php else : ?>
    <div class="alert alert-info">
        <form class="form-inline form-menu-select" action="<?php echo base_url('menus/switch_menu'); ?>" method="post">
            <div class="form-group">
                <label for="select-menu-to-edit">Select a menu to edit:</label>
                <?php
                $attr = 'id="select-menu-to-edit" class="form-control"';
                echo form_dropdown('menu', $menu_options, $menu_slug, $attr);
                ?>
            </div>
            <div class="form-group">
                <button name="add-menu-item" class="btn btn-primary" type="submit" value="1">Select</button>
            </div>
            <div class="form-group">
                <span class="add-new-menu-action">
                    or <a href="<?php echo base_url('menus/create'); ?>">create a new menu</a>
                </span>
            </div>
        </form>
    </div>
<?php endif; ?>

<div class="row">
    <div class="menu-selection col-md-3">
        <form class="form-menu-item" action="#" method="post">
            <h3>Add New Item</h3>
            <fieldset class="new-item-fieldset" <?php echo isset($is_create_menu) ? 'disabled' : ''; ?>>
                <div class="form-group <?php echo form_error('menu-item[menu-item-url]') ? 'has-error' : ''; ?>">
                    <label for="">URL</label>
                    <input type="text" class="form-control" name="menu-item[menu-item-url]">
                    <?php echo form_error('menu-item[menu-item-url]', '<p class="text-warning">', '</p>'); ?>
                </div>
                <div class="form-group <?php echo form_error('menu-item[menu-item-title]') ? 'has-error' : ''; ?>">
                    <label for="">Link text</label>
                    <input type="text" class="form-control" name="menu-item[menu-item-title]">
                    <?php echo form_error('menu-item[menu-item-title]', '<p class="text-warning">', '</p>'); ?>
                </div>
                <div class="form-group">
                    <label for="">Parent item</label>
                    <?php
                    $attr = 'class="form-control"';
                    echo form_dropdown('menu-item[menu-item-parent]', $menu_parent_options, 0, $attr);
                    ?>
                </div>
                <div class="form-group">
                    <label for="">Weight</label> <span class="menu-help glyphicon glyphicon-question-sign" data-toggle="tooltip" data-placement="right" title="Menu links with smaller weights are displayed before links with larger weights."></span>
                    <?php
                    $attr = 'class="form-control"';
                    echo form_dropdown('menu-item[menu-item-weight]', $menu_weight_options, 0, $attr);
                    ?>
                </div>
                <div class="form-group clearfix">
                    <button name="add-new-menu-item" type="submit" value="1" class="btn btn-default pull-right add-new-menu-item">Add</button>
                </div>
            </fieldset> <!-- .new-item-fieldset -->
        </form> <!-- .form-menu-item -->
    </div> <!-- .menu-selection -->

    <div class="menu-edit col-md-9">
        <form class="form-menu" action="#" method="post">
            <div class="form-group">
                <div class="alert alert-info clearfix">
                    <input type="text" name="menu-name" class="form-control menu-name pull-left" value="<?php echo $menu_name; ?>" placeholder="Enter menu name here">
                    <input type="submit" name="save-menu" class="btn btn-primary pull-right" value="Save Menu">
                </div>
            </div>
            <?php if (!isset($is_create_menu)) : ?>
            <div class="menu-properties">
                <div class="menu-items">
                    <h3>Menu Structure</h3>
                    <p>Add menu items from the column on the left.</p>

                    <ul class="menu list-group">
                        <?php foreach ($menu_items as $menu_item) : ?>
                            <li id="menu-item-<?php echo $menu_item['menu_id']; ?>" class="menu-item list-group-item menu-item-depth-<?php echo $menu_item['depth']; ?> <?php echo $edit_menu_item == $menu_item['menu_id'] ? 'menu-item-edit-active' : ''; ?>">
                                <div class="menu-header">
                                    <?php echo $menu_item['menu_title']; ?> <div class="pull-right"><a class="item-edit" href="?edit-menu-item=<?php echo $menu_item['menu_id']; ?>#menu-item-<?php echo $menu_item['menu_id']; ?>"><i class="glyphicon glyphicon-triangle-bottom"></i></a></div>
                                </div> <!-- .menu-header -->
                                <div class="menu-body">
                                    <div class="form-group">
                                        <label for="">URL</label>
                                        <input name="menu-item-url[<?php echo $menu_item['menu_id']; ?>]" type="text" class="form-control" value="<?php echo $menu_item['menu_url']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Link text</label>
                                        <input name="menu-item-title[<?php echo $menu_item['menu_id']; ?>]" type="text" class="form-control" value="<?php echo $menu_item['menu_title']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Parent item</label>
                                        <?php
                                        $attr = 'class="form-control"';
                                        echo form_dropdown(
                                            'menu-item-parent['.$menu_item['menu_id'].']',
                                            $menu_parents_options[ $menu_item['menu_id' ] ],
                                            $menu_item['menu_parent'],
                                            $attr);
                                        ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Weight</label> <span class="menu-help glyphicon glyphicon-question-sign" data-toggle="tooltip" data-placement="right" title="Menu links with smaller weights are displayed before links with larger weights."></span>
                                        <?php
                                        $attr = 'class="form-control"';
                                        echo form_dropdown(
                                            'menu-item-weight['.$menu_item['menu_id'].']',
                                            $menu_weight_options,
                                            $menu_item['menu_weight'],
                                            $attr);
                                        ?>
                                    </div>
                                    <div class="menu-item-actions clearfix">
                                        <a href="?action=remove-menu-item&amp;menu-item=<?php echo $menu_item['menu_id']; ?>" class="item-delete text-danger">Remove</a>
                                    </div>
                                    <input type="hidden" name="menu-item-db-id[<?php echo $menu_item['menu_id']; ?>]" value="<?php echo $menu_item['menu_id']; ?>">
                                </div> <!-- .menu-body -->
                            </li> <!-- .menu-item -->
                        <?php endforeach; ?>
                    </ul> <!-- .menu -->
                </div>
                <hr>
                <div class="form-group">
                    <h3>Menu Settings</h3>
                    <div class="checkbox">
                        <label>
                            <?php echo form_checkbox(array(
                                'name'    => 'menu-locations[primary]',
                                'value'   => $menu_id,
                                'checked' => isset($primary_menu) ? true : false
                            )); ?> Use for main menu
                        </label>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <div class="form-group">
                <div class="alert alert-info clearfix">
                    <?php if (!isset($is_create_menu)) : ?>
                    <a class="btn btn-danger" href="<?php echo base_url('menus/delete/' . $menu_slug); ?>">Delete Menu</a>
                    <?php endif; ?>
                    <input type="submit" name="save-menu" class="btn btn-primary pull-right" value="Save Menu">
                </div>
            </div>
        </form>
    </div>
    <!-- /.menu-edit -->
</div>
