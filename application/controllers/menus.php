<?php

class Menus extends CI_Controller {
    public function index($id = '') {
        if ($id) {
            echo 'if id available, show it to edit or use edit/ to edit';
        } else {
            echo 'open latest menu';
        }
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
