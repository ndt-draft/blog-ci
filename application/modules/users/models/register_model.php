<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Register_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function register_user($data) {
        $result = $this->db->insert('users', $data)
        if ($result) {
            return true;
        }

        return false;
    }

}