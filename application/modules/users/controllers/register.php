<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'form'));
        $this->load->helper(array('menus', 'options'));
        $this->lang->load('en_admin', 'english');
    }

    public function index() {
        $this->load->view('blog/header');
        /**
         * @see http://stackoverflow.com/q/6269330
         * look for hmvc module "users"
         * find users/ inside views/
         * and load register.php file
         */
        $this->load->view('users/users/register');
        $this->load->view('blog/footer');
    }
}
