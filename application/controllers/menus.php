<?php

class Menus extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('menus_model');
    }

    public function index() {
        $this->load->helper(array('url'));

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

        // need menu items helper

        // sort for menu order
        for ($i = 0; $i < count($menu_items) - 1; $i++) {
            for ($j = $i + 1; $j < count($menu_items); $j++) {
                if ($menu_items[ $i ]['menu_order'] > $menu_items[ $j ]['menu_order']) {
                    $temp_item = $menu_items[ $i ];
                    $menu_items[ $i ] = $menu_items[ $j ];
                    $menu_items[ $j ] = $temp_item;
                }
            }
        }

        // determine depth
        for ($i = 0; $i < count($menu_items); $i++) {
            $depth = 0;
            $parent_id = $menu_items[ $i ]['menu_parent']; // parent = 4

            for ($j = 0; $j < count($menu_items); $j++) {
                if ($parent_id == $menu_items[ $j ]['menu_id']) {
                    $depth++; // = 1

                    // recursive algorithm
                    $parent_id = $menu_items[ $j ]['menu_parent'];
                    $j = 0;

                    if ($parent_id == 0) {
                        break;
                    }

                }
            }

            $menu_items[ $i ]['depth'] = $depth;
        }

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
