<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Register_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function register_user($data) {
        $result = $this->db->insert('users', $data);
        if ($result) {
            return true;
        }
        return false;
    }

}
