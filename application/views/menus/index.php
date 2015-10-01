<h1 class="page-title menu-title">Menus</h1>

<div class="alert alert-info">
    <form class="form-inline" action="" method="post">
        <div class="form-group">
            <label for="select-menu-to-edit">Select a menu to edit:</label>
            <select name="menu" id="select-menu-to-edit" class="form-control">
                <option value="1">Menu 1</option>
                <option value="2">Menu 2</option>
                <option value="3">Menu 3</option>
            </select>
        </div>
        <div class="form-group">
            <button class="btn btn-primary" type="submit">Select</button>
        </div>
        <div class="form-group">
            <span class="add-new-menu-action">
                or <a href="">create a new menu</a>
            </span>
        </div>
    </form>
</div>

<div class="row">
    <div class="menu-selection col-md-3">
        <form action="">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Enter title">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Enter url">
            </div>
            <div class="form-group clearfix">
                <button type="submit" class="btn btn-default pull-right">Add</button>
            </div>
        </form>
    </div> <!-- .menu-selection -->

    <div class="menu-edit col-md-9">
        <form action="">
            <div class="form-group">
                <div class="alert alert-info clearfix">
                    <input type="text" class="form-control menu-name pull-left" value="Menu Name" placeholder="Enter menu name here">
                    <input type="submit" name="save_menu" class="btn btn-primary pull-right" value="Save Menu">
                </div>
            </div>
            <div class="menu-properties">
                <div class="menu-items">
                    <h3>Menu Structure</h3>

                    <div class="alert alert-info">Home</div>
                    <div class="alert alert-info">Create</div>
                    <div class="alert alert-info">Search</div>
                    <div class="alert alert-info">About</div>
                </div>
                <hr>
                <div class="form-group">
                    <h3>Menu Settings</h3>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox"> Use for main menu
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="alert alert-info clearfix">
                    <input type="submit" class="btn btn-danger" value="Delete Menu">
                    <input type="submit" name="save_menu" class="btn btn-primary pull-right" value="Save Menu">
                </div>
            </div>
        </form>
        
    </div>
    <!-- /.menu-edit -->
</div>
