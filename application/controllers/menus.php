<?php

class Menus extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('menus_model');
        $this->load->library('session');
    }

    /**
     * Handle save menu properties and items
     */
    private function save_menu($menu_id) {
        if ($this->input->post('save-menu')) {
            $this->load->library('form_validation');

            $data['menu_name']         = $this->input->post('menu-name');
            $data['menu_locations']    = $this->input->post('menu-locations');
            $data['menu_item_ids']     = $this->input->post('menu-item-db-id');
            $data['menu_item_urls']    = $this->input->post('menu-item-url');
            $data['menu_item_titles']  = $this->input->post('menu-item-title');
            $data['menu_item_parents'] = $this->input->post('menu-item-parent');
            $data['menu_item_weights'] = $this->input->post('menu-item-weight');

            $this->form_validation->set_rules('menu-name', 'Menu name', 'trim|required');

            if ($this->form_validation->run()) {
                return $this->menus_model->save_menu($menu_id, $data);
            }
        }
        return false;
    }

    /**
     * Handle add new menu item
     */
    private function add_new_menu_item($menu_id) {
        if ($this->input->post('add-new-menu-item')) {
            $this->load->helper('url');
            $this->load->library('form_validation');

            $this->form_validation->set_rules('menu-item[menu-item-url]', 'URL', 'trim|prep_url|required');
            $this->form_validation->set_rules('menu-item[menu-item-title]', 'Link text', 'trim|required');

            $menu_item = $this->input->post('menu-item');

            if ($this->form_validation->run()) {
                return $this->menus_model->add_new_menu_item($menu_id, $menu_item);
            }
        }

        return false;
    }

    /**
     * Handle remove menu item
     */
    private function remove_menu_item() {
        if ('remove-menu-item' === $this->input->get('action')) {
            $item_id = $this->input->get('menu-item');
            return $this->menus_model->remove_menu_item($item_id);
        }

        return false;
    }

    /**
     * Menu edit
     */
    private function edit_menu($context) {
        $menu_id    = 0;
        $menu_name  = '';
        $menu_slug  = '';
        $menu_items = array();
        $menu_options = array();
        $menu_parent_options = array();
        $menu_weight_options = range(-50, 50);
        $menu_weight_options = array_combine($menu_weight_options, $menu_weight_options);

        if ('index' == $context) {
            $menu = $this->menus_model->get_latest_menu();

            if (!$menu) {
                redirect('menus/create');
            }
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

        // handle save all menu items and properties
        $this->save_menu($menu_id);

        // handle add new menu item here
        $this->add_new_menu_item($menu_id);
        $this->remove_menu_item();

        // finally, print to edit
        if ($menu_id) {
            $menu_items = $this->menus_model->get_menu_items($menu_id);
        }

        if ($menu_items) {
            $menu_items = menus_sort_level_weight($menu_items);
            $menu_items = menus_items_depth($menu_items);
        }

        // prepare data for view
        $menu_details = $this->menus_model->get_menus();

        foreach ($menu_details as $menu_detail) {
            $menu_options[ $menu_detail['slug'] ] = $menu_detail['name'];
        }

        // dynamic parents
        $first_parent_option = '&lt;'.$menu_name.'&gt;';
        $menu_parent_options = menus_parent_options($menu_items, $first_parent_option);
        $menu_parents_options = menus_items_parent_options($menu_items, $first_parent_option);

        // use for primary
        $locations = get_option('menu_locations');
        if (isset($locations['primary'])) {
            if ($menu_id == $locations['primary']) {
                $data['primary_menu'] = true;
            }
        }

        $data['menu_id'] = $menu_id;
        $data['menu_name']  = $menu_name;
        $data['menu_slug']  = $menu_slug;
        $data['menu_options'] = $menu_options;
        $data['menu_parent_options'] = $menu_parent_options;
        $data['menu_parents_options'] = $menu_parents_options;
        $data['menu_weight_options'] = $menu_weight_options;
        $data['menu_items'] = $menu_items;
        $data['edit_menu_item'] = $this->input->get('edit-menu-item');

        $this->load->view('blog/header');
        $this->load->view('menus/index', $data);
        $this->load->view('blog/footer');

        // when delete post, must clear
        if ('development' == ENVIRONMENT) {
            $this->output->enable_profiler(true);
        }
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
        $this->load->helper(array('menus', 'options'));

        $this->edit_menu('index');
    }

    /**
     * Handle all edit actions
     */
    public function edit($slug = '') {
        $this->load->helper(array('url', 'form'));
        $this->load->helper(array('menus', 'options'));

        $id = $this->menus_model->get_id_by_slug($slug);

        $this->edit_menu($id);
    }

    /**
     * Create new menu
     */
    public function create() {
        $this->load->helper(array('url', 'form'));
        $this->load->helper(array('menus', 'options'));
        $this->load->library('form_validation');

        if ($this->input->post('save-menu')) {
            $menu_name = $this->input->post('menu-name');

            $this->form_validation->set_rules(
                'menu-name',
                'Menu name',
                'trim|required|is_unique[terms.name]'.
                    '|menu_slug|is_unique[terms.slug]'
            );

            if ($this->form_validation->run()) {
                $slug = $this->menus_model->create_menu($menu_name);
                redirect('menus');
            }
        }

        // get newly slug
        $data['is_create_menu'] = true;
        $data['menu_name']  = '';
        $data['menu_parent_options'] = array();
        $data['menu_weight_options'] = array();

        $this->load->view('blog/header');
        $this->load->view('menus/index', $data);
        $this->load->view('blog/footer');
    }

    /**
     * Delete menu
     */
    public function delete($slug = '') {
        $this->load->helper('url');

        $id = $this->menus_model->get_id_by_slug($slug);
        $this->menus_model->delete_menu($id);
        redirect('menus');
    }
}
