<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Password extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'form'));
        $this->load->helper(array('menus', 'options'));
        $this->lang->load('en_admin', 'english');
    }

    public function index() {
    }

    public function forgot_password() {
        $this->load->view('blog/header');
        $this->load->view('users/users/forgot_password');
        $this->load->view('blog/footer');
    }
}