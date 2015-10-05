<?php
class Options_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }

    public function get_option($key) {
        $this->db->select('option_value');
        $this->db->where('option_name', $key);
        $query = $this->db->get('options');
        $result = $query->result_array();

        $option_value = null;
        if (isset($result[0]['option_value'])) {
            $option_value = $result[0]['option_value'];
            return unserialize($option_value);
        }
        return $option_value;
    }
}