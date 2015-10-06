<?php
class Menus_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_latest_menu() {
        $this->db->order_by('term_id', 'desc');
        $query = $this->db->get('terms', 1); // get 1 latest from terms
        return $query->result_array();
    }

    public function get_id_by_slug($slug) {
        if (is_numeric($slug)) {
            return $slug;
        }

        $this->db->where('slug', $slug);
        $query = $this->db->get('terms');
        $data = $query->result_array();

        $id = $slug;
        if (isset($data[0]['term_id'])) {
            $id = $data[0]['term_id'];
        }

        return $id;
    }

    public function get_menu($menu_id) {
        $this->db->where('term_id', $menu_id);
        $query = $this->db->get('terms');
        return $query->result_array();
    }

    public function get_menu_items($menu_id) {
        // get all item ids
        $this->db->select('object_id');
        $this->db->where('term_id', $menu_id);
        $query = $this->db->get('term_relationships');
        $objects = $query->result_array();

        $menu_ids = array();
        foreach ($objects as $object) {
            $menu_ids[] = $object['object_id'];
        }

        // get all menu items, must verify
        if ($menu_ids) {
            $this->db->where_in('menu_id', $menu_ids);
            $query = $this->db->get('menus');
            return $query->result_array();
        }

        return $menu_ids;
    }

    public function get_menus() {
        $this->db->order_by('term_id', 'desc');
        $query = $this->db->get('terms');
        return $query->result_array();
    }

    public function save_menu($menu_id, $data) {
        // save menu name
        $this->db->set('name', $data['menu_name']);
        $this->db->where('term_id', $menu_id);
        $this->db->update('terms');

        // save menu locations
        $this->db->where('option_name', 'menu_locations');
        $query = $this->db->get('options');
        if ($data['menu_locations']) {
            $menu_locations = serialize($data['menu_locations']);
            if ($query->result_array()) {
                $this->db->set('option_value', $menu_locations);
                $this->db->where('option_name', 'menu_locations');
                $this->db->update('options');
            } else {
                $this->db->insert('options', array(
                    'option_name'  => 'menu_locations',
                    'option_value' => $menu_locations
                ));
            }
        }

        // save menu items
        if (isset($data['menu_item_ids']) && $data['menu_item_ids']) {
            foreach ($data['menu_item_ids'] as $item_id) {
                $this->db->set('menu_title', $data['menu_item_titles'][ $item_id ]);
                $this->db->set('menu_url', $data['menu_item_urls'][ $item_id ]);
                $this->db->set('menu_weight', $data['menu_item_weights'][ $item_id ]);
                $this->db->set('menu_parent', $data['menu_item_parents'][ $item_id ]);
                $this->db->where('menu_id', $item_id);
                $this->db->update('menus');
            }
        }
    }

    public function create_menu($menu_name) {
        $this->load->helper('url');

        $menu_name = trim($menu_name);
        $menu_slug = url_title($menu_name, 'dash', true);

        $this->db->insert('terms', array(
            'name' => $menu_name,
            'slug' => $menu_slug
        ));
    }

    public function delete_menu($menu_id) {
        $this->db->where('term_id', $menu_id);
        $this->db->delete('terms');

        $this->db->where('term_id', $menu_id);
        $this->db->delete('term_relationships');
    }

    public function add_new_menu_item($menu_id, $item) {
        $this->load->helper('url');

        $data = array(
            'menu_title'  => trim($item['menu-item-title']),
            'menu_url'    => prep_url(trim($item['menu-item-url'])),
            'menu_weight' => $item['menu-item-weight'],
            'menu_parent' => $item['menu-item-parent'],
        );
        $this->db->insert('menus', $data);
        
        $item_id = $this->db->insert_id();
        $data = array(
            'object_id' => $item_id,
            'term_id'   => $menu_id
        );
        return $this->db->insert('term_relationships', $data);
    }

    public function remove_menu_item($item_id) {
        $this->db->where('menu_id', $item_id);
        $this->db->delete('menus');

        $this->db->where('object_id', $item_id);
        $this->db->delete('term_relationships');
    }
}
