<?php

class Posts_model extends CI_Model {
	
	public function __construct() {
		$this->load->database();
	}

	public function record_count() {
		return $this->db->count_all('posts');
	}

	public function get_posts($slug = false, $limit = 0, $start = 0) {
		if ($slug === false) {
			$this->db->limit($limit, $start);
			$query = $this->db->get('posts');
			return $query->result_array();
		}

		$query = $this->db->get_where('posts', array('slug' => $slug));
		return $query->result_array();
	}

	public function search_posts($keyword = '') {
		$this->db->like('title', $keyword);
		$query = $this->db->get('posts');

		return $query->result_array();
	}

	public function set_posts() {
		$this->load->helper('url');

		$slug = url_title($this->input->post('slug'), 'dash', true);

		$data = array(
			'title' => $this->input->post('title'),
			'slug'  => $slug,
			'content' => $this->input->post('content')
		);

		return $this->db->insert('posts', $data);
	}

	public function update_posts($id) {
		$this->load->helper('url');

		$slug = url_title($this->input->post('slug'), 'dash', true);

		$data = array(
			'title' => $this->input->post('title'),
			'slug' => $slug,
			'content' => $this->input->post('content')
		);

		$this->db->where('id', $id);
		$this->db->update('posts', $data);
	}

	public function delete_posts($slug) {
		$this->db->delete('posts', array('slug' => $slug));
	}
}
