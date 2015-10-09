<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Users extends MX_Controller {
    /**
     * @see https://bitbucket.org/wiredesignz/codeigniter-modular-extensions-hmvc/src#markdown-header-features
     */
    public $autoload = array(
        'helper' => array('form', 'url', 'security', 'language', 'file'),
        'libraries' => array('session', 'form_validation')
    );

    public function __construct() {
        parent::__construct();
        $this->form_validation->set_error_delimiters(
            '<div class="alert alert-warning" role="alert">',
            '</div>'
        );
        $this->load->model('Users_model');
        $this->load->model('Password_model');
        $this->lang->load('en_admin', 'english');

        if (false == $this->session->userdata('logged_in') ||
            1 != $this->session->userdata('usr_access_level')) {
            redirect('users/signin');
        }
    }

    public function index() {
        $data['page_heading'] = 'Viewing users';
        $data['query'] = $this->users_model->get_all_users();
        // $this->load->view('common/header', $data);
        // $this->load->view('nav/top_nav', $data);
        $this->load->view('users/users/view_all_users', $data);
        // $this->load->view('common/footer', $data);
    }

    public function new_user() {
    }
}
