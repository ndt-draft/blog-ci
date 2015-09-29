<?php

class Another extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('another_model');
	}

	public function index() {
		$result = $this->another_model->get_customers();
		echo 'from ci_db database:';
		print_r($result);

		$result = $this->another_model->get_posts();
		echo 'from blog database';
		print_r($result); 
	}
}
