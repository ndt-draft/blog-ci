<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_all_users() {
        return $this->db->get('users');
    }

    public function process_create_user($data) {
        if ($this->db->insert('users', $data)) {
            return $this->db->insert_id();
        }
        return false;
    }

    public function process_update_user($id, $data) {
        $this->db->where('usr_id', $id);
        if ($this->db->update('users', $data)) {
            return true;
        }
        return false;
    }

    public function get_user_details($id) {
        $this->db->where('usr_id', $id);
        $result = $this->db->get('users');

        if ($result) {
            return $result;
        }
        return false;
    }

    public function get_user_details_by_email($email) {
        $this->db->where('usr_email', $email);
        $result = $this->db->get('users');

        if ($result) {
            return $result;
        }
        return false;
    }

    public function delete_user($id) {
        $this->db->where('usr_id', $id);
        $result = $this->db->delete('users');
        if ($result) {
            return true;
        }
        return false;
    }

    public function make_code() {
        do {
            $url_code = random_string('alnum', 8);

            $this->db->where('usr_pwd_change_code', $usr_code);
            $this->db->from('users');
            $num = $this->db->count_all_results();
        } while ($num >= 1);

        return $url_code;
    }

    public function count_results($email) {
        $this->db->where('usr_email', $email);
        $this->db->from('users');
        return $this->db->count_all_results();
    }

    public function update_user_password($data) {
        if (isset($data['usr_id'])) {
            $this->db->where('usr_id', $data['usr_id']);
        } elseif(isset($data['usr_email'])) {
            $this->db->where('usr_email', $data['usr_email']);
            unset($data['usr_email']);
        }
        $result = $this->db->update('users', $data);
        if ($result) {
            return true;
        }
        return false;
    }

    public function does_code_match($data, $email) {
        $query = 'SELECT COUNT(*) AS count
                  FROM users
                  WHERE usr_pwd_change_code = ?
                  AND usr_email = ? ';

        $res = $this->db->query($query, array($data['code'], $email));
        foreach ($res->result() as $row) {
            $count = $row->count;
        }

        if (1 == $count) {
            return true;
        }
        return false;
    }

    public function update_user_code($data) {
        $this->db->where('usr_email', $data['usr_email']);
        if ($this->db->update('users', $data)) {
            return true;
        }
        return false;
    }

}