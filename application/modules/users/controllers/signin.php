<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Signin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url', 'security'));
        $this->load->library(array('session', 'form_validation'));
        $this->lang->load('en_admin', 'english');
        $this->form_validation->set_error_delimiters('<div class="alert alert-warning" role="alert">', '</div>');
    }

    public function index() {
        if ($this->session->userdata('logged_in') == true) {
            if ($this->session->userdata('usr_access_level') == 1) {
                redirect('users');
            } else {
                redirect('users/me');
            }
        } else {
            // set validations
            $this->form_validation->set_rules(
                'usr_email',
                $this->lang->line('signin_email'),
                'required|valid_email|min_length[5]|max_length[125]'
            );
            $this->form_validation->set_rules(
                'usr_password',
                $this->lang->line('signin_password'),
                'required|min_length[5]|max_length[30]'
            );

            if (false == $this->form_validation->run()) {
                // $this->load->view('common/login_header');
                $this->load->view('users/users/signin');
                // $this->load->view('common/footer');
            } else {
                $usr_email = $this->input->post('usr_email');
                $password = $this->input->post('usr_password');

                $this->load->model('signin_model');
                $query = $this->signin_model->does_user_exist($usr_email);

                if ($query->num_rows() == 1) {
                    foreach ($query->result() as $row) {
                        $this->load->library('encrypt');
                        $hash = $this->encrypt->sha1($password);

                        // see if the user is active or not
                        if ($row->usr_is_active != 0) {
                            // compare the generated hash with that in the database
                            if ($hash != $row->usr_hash) {
                                $data['login_fail'] = true;
                                // $this->load->view('common/login_header');
                                $this->load->view('users/users/signin', $data);
                                // $this->load->view('common/footer');
                            } else {
                                $data = array(
                                    'usr_id'           => $row->usr_id,
                                    'acc_id'           => $row->acc_id,
                                    'usr_email'        => $row->usr_email,
                                    'usr_access_level' => $row->usr_access_level,
                                    'logged_in'        => true,
                                );
                                // save data to session
                                $this->session->set_userdata($data);

                                if ($data['usr_access_level'] == 2) {
                                    redirect('users/me');
                                } elseif ($data['usr_access_level'] == 1) {
                                    redirect('users');
                                } else {
                                    redirect('users/me');
                                }
                            }

                        // user currently inactive
                        } else {
                            redirect('users/signin');
                        }
                    }
                }
            }
        }
    }

    public function signout() {
        $this->session->sess_destroy();
        redirect('users/signin');
    }
}
