<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Password_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function does_code_match($code, $email) {
        $query = "SELECT COUNT(*) AS count
                  FROM users
                  WHERE usr_pwd_change_code = ?
                  AND usr_email = ? ";

        $res = $this->db->query($query, array($code, $email));

        foreach ($res->result() as $row) {
            $count = $row->count;
        }

        if (1 == $count) {
            return true;
        }

        return false;
    }

}