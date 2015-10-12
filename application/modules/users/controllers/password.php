<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Password extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('users_model');
        $this->load->helper(array(
            'url',
            'form',
            'file',
            'security',
            'menus',
            'options'
        ));
        $this->load->library(array('session', 'form_validation'));
        $this->lang->load('en_admin', 'english');
        $this->form_validation->set_error_delimiters('<div class="alert alert-warning">', '</div>');
    }

    public function index() {
        redirect('users/password/forgot_password');
    }

    public function forgot_password() {
        $this->form_validation->set_rules(
            'usr_email',
            $this->lang->line('signin_new_pwd_email'),
            'required|min_length[5]|max_length[125]|valid_email'
        );

        if ($this->form_validation->run() == false) {
            $this->load->view('blog/header');
            $this->load->view('users/users/forgot_password');
            $this->load->view('blog/footer');
        } else {
            $email = $this->input->post('usr_email');
            $num_res = $this->users_model->count_results($email);

            if ($num_res == 1) {
                $code = $this->users_model->make_code();
                $data = array(
                    'usr_pwd_change_code' => $code,
                    'usr_email' => $email
                );

                if ($this->users_model->update_user_code($data)) {
                    $result = $this->users_model->get_user_details_by_email($email);

                    foreach ($result->result() as $row) {
                        $usr_fname = $row->usr_fname;
                        $usr_lname = $row->usr_lname;
                    }

                    $link = base_url('users/password/new_password').'/'.$code;
                    $path = APPPATH . 'modules/users/views/email_scripts/reset_password.txt';
                    $file = read_file($path);
                    $file = str_replace('%usr_fname%', $usr_fname, $file);
                    $file = str_replace('%usr_lname%', $usr_lname, $file);
                    echo $file = str_replace('%link%', $link, $file);

                    if (mail($email, $this->lang->line('email_subject_reset_password'), $file, 'From: me@domain.com')) {
                        redirect('users/signin');
                    }
                } else {
                    redirect('users/password/forgot_password');
                }
            } else {
                redirect('users/password/forgot_password');
            }
        }
    }

    public function new_password() {
        $this->form_validation->set_rules(
            'code',
            $this->lang->line('signin_new_pwd_code'),
            'required|min_length[4]|max_length[8]'
        );
        $this->form_validation->set_rules(
            'usr_email',
            $this->lang->line('signin_new_pwd_email'),
            'required|min_length[5]|max_length[125]'
        );
        $this->form_validation->set_rules(
            'usr_password1',
            $this->lang->line('signin_new_pwd_pwd'),
            'required|min_length[5]|max_length[125]'
        );
        $this->form_validation->set_rules(
            'usr_password2',
            $this->lang->line('signin_new_pwd_confirm'),
            'required|min_length[5]|max_length[125]|matches[usr_password1]'
        );

        if ($this->input->post()) {
            $data['code'] = xss_clean($this->input->post('code'));
        } else {
            $data['code'] = xss_clean($this->uri->segment(4));
        }

        if ($this->form_validation->run() == false) {
            $data['usr_email'] = array(
                'name' => 'usr_email',
                'class' => 'form-control',
                'id' => 'usr_email',
                'type' => 'text',
                'value' => set_value('usr_email', ''),
                'max_length' => '100',
                'size' => '35',
                'placeholder' => $this->lang->line('signin_new_pwd_email')
            );
            $data['usr_password1'] = array(
                'name' => 'usr_password1',
                'class' => 'form-control',
                'id' => 'usr_password1',
                'type' => 'password',
                'value' => set_value('usr_password1', ''),
                'max_length' => '100',
                'size' => '35',
                'placeholder' => $this->lang->line('signin_new_pwd_pwd')
            );
            $data['usr_password2'] = array(
                'name' => 'usr_password2',
                'class' => 'form-control',
                'id' => 'usr_password2',
                'type' => 'password',
                'value' => set_value('usr_password2', ''),
                'max_length' => '100',
                'size' => '35',
                'placeholder' => $this->lang->line('signin_new_pwd_confirm')
            );

            $this->load->view('blog/header', $data);
            $this->load->view('users/users/new_password', $data);
            $this->load->view('blog/footer', $data);
        } else {
            $email = xss_clean($this->input->post('usr_email'));

            if (!$this->users_model->does_code_match($data, $email)) {
                redirect('users/forgot_password');
            } else {
                $password = $this->input->post('usr_password1');
                $hash = $this->encrypt->sha1($password);
                $data = array(
                    'usr_hash' => $hash,
                    'usr_email' => $email
                );
                if ($this->users_model->update_user_password($data)) {
                    $link = base_url('users/signin');
                    $result = $this->users_model->get_user_details_by_email($email);

                    foreach ($result->result() as $row) {
                        $usr_fname = $row->usr_fname;
                        $usr_lname = $row->usr_lname;
                    }

                    $path = APPPATH . 'modules/users/views/email_scripts/new_password.txt';
                    $file = read_file($path);
                    $file = str_replace('%usr_fname%', $usr_fname, $file);
                    $file = str_replace('%usr_lname%', $usr_lname, $file);
                    $file = str_replace('%password%', $password, $file);
                    $file = str_replace('%link%', $link, $file);
                    if (mail($email, $this->lang->line('email_subject_new_password'), $file, 'From: me@domain.com')) {
                        redirect('users/signin');
                    }
                }
            }
        }
    }
}
