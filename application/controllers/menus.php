<?php

class Menus extends CI_Controller {
    public function index() {
        $this->load->helper(array('url'));
        $this->load->view('blog/header');
        $this->load->view('menus/index');
        $this->load->view('blog/footer');
    }

    public function edit($id = '') {
        echo 'ajax goes here or reload to edit';
    }

    public function delete($id = '') {
        echo 'delete ' . $id;
    }

    public function create() {
    }
}
