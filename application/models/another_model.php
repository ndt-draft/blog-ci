<?php

class Another_model extends CI_Model {
	public function get_posts() {
		$db_1 = $this->load->database('default', true);
		$query = $db_1->get('posts');
		$db_1->close();
		return $query->result_array();
	}

	public function get_customers() {
		$db_2 = $this->load->database('ci', true);
		$query = $db_2->get('customers');
		$db_2->close();
		return $query->result_array();
	}
}
