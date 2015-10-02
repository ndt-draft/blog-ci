<?php

class Menus extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('menus_model');
    }

    /**
     * Handle add new menu item
     */
    private function add_new_menu_item($menu_id) {
        if ($this->input->post('add-new-menu-item')) {
            $menu_item = $this->input->post('menu-item');

            print_r($menu_item);
        }
    }

    /**
     * Menu edit
     */
    private function edit_menu($context) {
        $menu_id    = 0;
        $menu_name  = '';
        $menu_slug  = '';
        $menu_items = array();

        if ('index' == $context) {
            $menu = $this->menus_model->get_latest_menu();
        } else {
            $menu = $this->menus_model->get_menu($context);
        }

        // get menu properties
        if (isset($menu[0]['term_id'])) {
            $menu_id = $menu[0]['term_id'];
        }
        if (isset($menu[0]['name'])) {
            $menu_name = $menu[0]['name'];
        }
        if (isset($menu[0]['slug'])) {
            $menu_slug = $menu[0]['slug'];
        }

        // handle add new menu item here
        $this->add_new_menu_item($menu_id);

        // finally, print to edit
        if ($menu_id) {
            $menu_items = $this->menus_model->get_menu_items($menu_id);
        }

        if ($menu_items) {
            $menu_items = menus_sort_level_weight($menu_items);
            $menu_items = menus_items_depth($menu_items);
        }

        // prepare data for view
        $menu_options = array();
        $menu_details = $this->menus_model->get_menus();

        foreach ($menu_details as $menu_detail) {
            $menu_options[ $menu_detail['slug'] ] = $menu_detail['name'];
        }

        $data['menu_name']  = $menu_name;
        $data['menu_slug']  = $menu_slug;
        $data['menu_options'] = $menu_options;
        $data['menu_items'] = $menu_items;
        $data['edit_menu_item'] = $this->input->get('edit-menu-item');

        $this->load->view('blog/header');
        $this->load->view('menus/index', $data);
        $this->load->view('blog/footer');
    }

    /**
     * Redirect to menu edit page
     */
    public function switch_menu() {
        $this->load->helper('url');
        $slug = $this->input->post('menu');
        if ($slug) {
            redirect('menus/edit/' . $slug);
        }

        redirect('menus');
    }


    /**
     * Main edit page for menus
     */
    public function index() {
        $this->load->helper(array('url', 'form'));
        $this->load->helper('menus');

        $this->edit_menu('index');
    }

    /**
     * Handle all edit actions
     */
    public function edit($slug = '') {
        $this->load->helper(array('url', 'form'));
        $this->load->helper('menus');

        $id = $this->menus_model->get_id_by_slug($slug);

        $this->edit_menu($id);
    }

    /**
     * Create new menu
     */
    public function create() {
        echo 'create new menu';
        echo 'must validate slug';
    }

    /**
     * Delete menu
     */
    public function delete($slug = '') {
        echo 'delete ' . $slug;
    }
}
