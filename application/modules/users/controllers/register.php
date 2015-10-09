<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'form'));
        $this->load->helper(array('menus', 'options'));
        $this->lang->load('en_admin', 'english');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="alert alert-warning" role="alert"', '</div>');
    }

    public function index() {
        $this->form_validation->set_rules(
            'usr_fname',
            $this->lang->line('first_name'),
            'required|min_length[1]|max_length[125]'
        );
        $this->form_validation->set_rules(
            'usr_lname',
            $this->lang->line('last_name'),
            'required|min_length[1]|max_length[125]'
        );
        $this->form_validation->set_rules(
            'usr_email',
            $this->lang->line('email'),
            'required|min_length[1]|max_length[255]|valid_email|is_unique[users.usr_email]'
        );

        if (false == $this->form_validation->run()) {
            // $this->load->view('common/login_header');
            /**
             * @see http://stackoverflow.com/q/6269330
             * look for hmvc module "users"
             * find users/ inside views/
             * and load register.php file
             */
            $this->load->view('users/users/register');
            // $this->load->view('common/footer');
        } else {
            // create hash from user password
            $password = random_string('alnum', 8);

            $hash = $this->encrypt->sha1($password);

            $data = array(
                'usr_fname' => $this->input->post('usr_fname'),
                'usr_lname' => $this->input->post('usr_lname'),
                'usr_email' => $this->input->post('usr_email'),
                'usr_is_active' => 1,
                'usr_access_level' => 2,
                'usr_hash' => $hash
            );

            if ($this->register_model->register_user($data)) {
                $file = read_file('../views/email_scripts/welcome.txt');
                $file = str_replace('%usr_fname%', $data['usr_fname'], $file);
                $file = str_replace('%usr_lname%', $data['usr_lname'], $file);
                $file = str_replace('%password%', $password, $file);
                redirect('users/signin');
            } else {
                redirect('users/register');
            }
        }
    }
}
