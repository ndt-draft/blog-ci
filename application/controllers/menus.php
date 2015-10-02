<?php

class Menus extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('menus_model');
    }

    public function index() {
        $this->load->helper(array('url'));
        $this->load->helper('menus');

        $menu_id = 0;
        $menu_name = '';
        $latest = $this->menus_model->get_latest();
        if (isset($latest[0]['term_id'])) {
            $menu_id = $latest[0]['term_id'];
        }
        if (isset($latest[0]['name'])) {
            $menu_name = $latest[0]['name'];
        }

        if ($menu_id) {
            $menu_items = $this->menus_model->get_menu_items($menu_id);
        }

        $menu_items = menus_sort_level_weight($menu_items);
        $menu_items = menus_items_depth($menu_items);

        $data['menu_name'] = $menu_name;
        $data['menu_items'] = $menu_items;
        $data['edit_menu_item'] = $this->input->get('edit-menu-item');

        $this->load->view('blog/header');
        $this->load->view('menus/index', $data);
        $this->load->view('blog/footer');
    }

    public function edit($id = '') {
        echo 'ajax goes here or reload to edit';
    }

    public function delete($id = '') {
        echo 'delete ' . $id;
    }

    public function create() {
    }
}
