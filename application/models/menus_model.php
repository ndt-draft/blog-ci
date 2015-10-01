<?php

class Menus_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }

    public function get_latest() {
        $this->db->order_by('term_id');
        $query = $this->db->get('terms', 1); // get 1 latest from terms
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

        // get all menu items
        $this->db->where_in('menu_id', $menu_ids);
        $query = $this->db->get('menus');
        return $query->result_array();
    }
}
