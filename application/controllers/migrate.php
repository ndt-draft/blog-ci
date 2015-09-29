<?php

defined("BASEPATH") or exit("No direct script access allowed");

/**
 * @see http://www.ignoredbydinosaurs.com/2012/05/database-migrations-codeigniter-101
 */
class Migrate extends CI_Controller {
    public function index() {
        if (ENVIRONMENT == 'development') {
            $this->load->library('migration');
            if ( ! $this->migration->latest()) {
                show_error($this->migration->error_string());
            } else {
                echo "success";
            }
        } else {
            echo "go away";
        }
    }

    public function rollback($version = 0) {
        if (ENVIRONMENT == 'development') {
            $this->load->library('migration');
            $this->migration->version($version);
            echo "rollback successfully";
        } else {
            echo "go away";
        }
    }
}
