<?php
class Hello extends CI_Controller {

	public function index() {
		// load a model from the current module
		// $this->load->model('local_model');

		// load a model from another module
		// $this->load->model('other_module/model');

		// HMVC example
		// $this->load->controller('module/controller/method', $params = array(), $return = FALSE);

		echo 'hello from main controllers';

		$this->load->spark('example-spark/1.0.0');      # We always specify the full path from the spark folder
		$this->example_spark->printHello();             # echo's "Hello from the example spark!"
	}
}
