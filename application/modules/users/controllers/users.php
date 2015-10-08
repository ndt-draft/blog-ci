<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Users extends MX_Controller {
    /**
     * @see https://bitbucket.org/wiredesignz/codeigniter-modular-extensions-hmvc/src#markdown-header-features
     */
    public $autoload = array(
        'helper' => array('form', 'url', 'security', 'language'),
        'libraries' => array('session', 'form_validation')
    );

    public function __construct() {
        parent::__construct();
        $this->form_validation->set_error_delimiters(
            '<div class="alert alert-warning" role="alert">',
            '</div>'
        );
        $this->lang->load('en_admin', 'english');
    }

    public function index() {
        $this->load->view('users/users/signin');
    }
}
