<?php
class Hello extends CI_Controller {

    public function index() {
        // load a model from the current module
        // $this->load->model('local_model');

        // load a model from another module
        // $this->load->model('other_module/model');

        // HMVC example
        // $this->load->controller('module/controller/method', $params = array(), $return = FALSE);

    	$this->load->controller('specials/random', array('lovely specials'));
    }
}

