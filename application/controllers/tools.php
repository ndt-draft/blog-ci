<?php

class Tools extends CI_Controller {
	public function message($to = 'Word') {
		echo "Hello {$to}!".PHP_EOL;
	}
}
