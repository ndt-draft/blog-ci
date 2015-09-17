<?php

class Blog extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('posts_model');
	}

	public function index() {
		$this->load->helper(array('url'));

		$data['posts'] = $this->posts_model->get_posts();
		$data['teaser'] = true;

		$this->load->view('blog/header');
		$this->load->view('blog/index', $data);
		$this->load->view('blog/footer');
	}

	/*public function search($query = '') {
		$this->load->helper(array('form', 'url'));

		if ( $this->input->get('search') ) {
			redirect('blog/search/' . urlencode($this->input->get('search')), 'refresh');
			exit();
		}

		if (empty($query)) {
			$this->load->view('blog/header');
			$this->load->view('blog/form-search');
			$this->load->view('blog/footer');
		} else {
			$query = urldecode($query);
			$data['posts'] = $this->posts_model->search_posts($query);
			$data['teaser'] = true;
			$this->load->view('blog/header');
			$this->load->view('blog/index', $data);
			$this->load->view('blog/footer');
		}
	}*/

	public function search() {
		$this->load->helper(array('form', 'url'));

		$keyword = urldecode($this->input->get('search'));

		if (empty($keyword)) {
			$this->load->view('blog/header');
			$this->load->view('blog/form-search');
			$this->load->view('blog/footer');
		} else {
			$data['posts'] = $this->posts_model->search_posts($keyword);
			$data['teaser'] = true;
			$this->load->view('blog/header');
			$this->load->view('blog/index', $data);
			$this->load->view('blog/footer');
		}
	}

	public function create() {
		$this->load->helper(array('form'));
		$this->load->library('form_validation');

		$data = array(
			'title'   => '',
			'content' => '',
			'slug' => ''
		);

		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('content', 'Content', 'required');
		$this->form_validation->set_rules('slug', 'Slug', 'required|is_unique[posts.slug]');

		if ( $this->form_validation->run() === false ) {
			$this->load->view('blog/header');
			$this->load->view('blog/create', $data);
			$this->load->view('blog/footer');
		} else {
			$this->posts_model->set_posts();
			redirect('/blog', 'refresh');
		}

	}

	public function update($slug = '') {
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');

		if ( '' == $slug ) {
			redirect('/blog', 'refresh');
		}

		// default
		$data = $this->posts_model->get_posts($slug);
		$data['data'] = $data[0];

		// no rows affected
		if (empty($data[0])) {
			redirect('/blog', 'refresh');
		}

		// get original slug
		$id = $data['data']['id'];
		$original_slug = $data['data']['slug'];

		// form validation if submit
		if ('POST' == $this->input->server('REQUEST_METHOD')) {
			/**
			 * @see http://stackoverflow.com/a/13694798
			 */
			$is_unique = '|is_unique[posts.slug]';
			$new_slug = url_title($this->input->post('slug'), 'dash', true);
			if ( $new_slug == $original_slug ) {
				$is_unique = '';
			}

			$this->form_validation->set_rules('title', 'Title', 'trim|required');
			$this->form_validation->set_rules('content', 'Content', 'trim|required');
			$this->form_validation->set_rules('slug', 'Slug', 'trim|required|alpha_dash'.$is_unique);
			
			// fail
			if ( $this->form_validation->run() === false ) {
				$data['data'] = array(
					'title'   => $this->input->post('title'),
					'content' => $this->input->post('content'),
					'slug'    => $this->input->post('slug'),
				);

			// pass
			} else {
				$this->posts_model->update_posts($id);
				redirect('/blog', 'refresh');
			}
		}

		$this->load->view('blog/update', $data);
	}

	public function delete($slug = '') {
		$this->load->helper(array('form', 'url'));

		if ( $this->input->post('delete') ) {
			$this->posts_model->delete_posts($slug);
			redirect('/blog', 'refresh');
		} elseif ( $this->input->post('cancel') ) {
			redirect('/blog', 'refresh');
		}

		$this->load->view('blog/delete');
	}

	public function show($slug = '') {
		$this->load->helper(array('url'));

		$data['posts'] = $this->posts_model->get_posts($slug);
		$data['teaser'] = false;
		$this->load->view('blog/header');
		$this->load->view('blog/index', $data);
		$this->load->view('blog/footer');
	}
}
