<?php

class Blog extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('posts_model');
	}

	public function index() {
		$this->load->helper(array('url'));
		$this->load->library('pagination');
		
		$config = array(
			'base_url' => site_url() . '/blog/index',
			'total_rows' => $this->posts_model->record_count(),
			'per_page' => 3,
			'full_tag_open' => '<ul class="pagination">',
			'full_tag_close' => '</ul>',
			'cur_tag_open' => '<li class="active"><span>',
			'cur_tag_close' => '</span></li>'
		);

		$config['num_tag_open'] =
			$config['first_tag_open'] = 
			$config['next_tag_open'] = 
			$config['prev_tag_open'] = 
			$config['last_tag_open'] = '<li>';

		$config['first_tag_close'] =
			$config['num_tag_close'] = 
			$config['next_tag_close'] = 
			$config['prev_tag_close'] = 
			$config['last_tag_close'] = '</li>';
		
		$this->pagination->initialize($config);

		$data['links'] = $this->pagination->create_links();
		$data['posts'] = $this->posts_model->get_posts(false, $config['per_page'], $this->uri->segment(3));
		$data['is_home'] = true;
		$data['teaser'] = true;

		$this->load->view('blog/header', $data);
		$this->load->view('blog/index', $data);
		$this->load->view('blog/footer');

		// when delete post, must clear
		$this->output->cache(1);

		$this->output->enable_profiler(true);
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

		$data['teaser'] = true;
		$data['is_search'] = true;

		/** Get the keyword **************************************************/
		// ajax
		if ($this->input->post('ajax')) {
			$keyword = urldecode(trim($this->input->post('keyword')));

		// normal reload
		} else {
			$keyword = urldecode(trim($this->input->get('search')));

			if (empty($keyword)) {
				$this->load->view('blog/header', $data);
				$this->load->view('blog/form-search');
				$this->load->view('blog/footer');
				return;
			}
		}

		/** Get search result ************************************************/
		// set cached key
		$cached_key = url_title($keyword, '_', true);
		
		// load driver
		$this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));

		// start caching here
		if ( ! $data['posts'] = $this->cache->get('search_' . $cached_key) ) {
			$data['posts'] = $this->posts_model->search_posts($keyword);
			$this->cache->save('search_' . $cached_key, $data['posts'], 60);
		}

		/** Handle the view **************************************************/
		// ajax
		if ( $this->input->post('ajax') ) {
			$this->load->view('blog/index', $data);
		
		// normal
		} else {
			$this->load->view('blog/header', $data);
			// $this->load->view('blog/form-search'); // must fix when go to search_url?search=?
			$this->load->view('blog/index', $data);
			$this->load->view('blog/footer');

			$this->output->enable_profiler(true);
		}
	}

	public function create() {
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');

		$data = array(
			'title'   => '',
			'content' => '',
			'slug' => ''
		);

		$data['is_create'] = true;

		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('content', 'Content', 'required');
		$this->form_validation->set_rules('slug', 'Slug', 'required|is_unique[posts.slug]');

		if ( $this->form_validation->run() === false ) {
			$this->load->view('blog/header', $data);
			$this->load->view('blog/create', $data);
			$this->load->view('blog/footer');
		} else {
			$this->posts_model->set_posts();
			$this->clear_all_cache();
			redirect('/blog', 'refresh');
		}

		$this->output->enable_profiler(true);
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
				$this->clear_all_cache();
				redirect('/blog', 'refresh');
			}
		}

		$this->load->view('blog/header');
		$this->load->view('blog/update', $data);
		$this->load->view('blog/footer');

		$this->output->enable_profiler(true);
	}

	public function delete($slug = '') {
		$this->load->helper(array('form', 'url'));

		if ( $this->input->post('delete') ) {
			$this->posts_model->delete_posts($slug);
			$this->clear_all_cache();
			redirect('/blog', 'refresh');
		} elseif ( $this->input->post('cancel') ) {
			redirect('/blog', 'refresh');
		}

		$this->load->view('blog/header');
		$this->load->view('blog/delete');
		$this->load->view('blog/footer');

		$this->output->enable_profiler(true);
	}

	public function show($slug = '') {
		$this->load->helper(array('url'));

		$data['posts'] = $this->posts_model->get_posts($slug);
		$data['teaser'] = false;
		$this->load->view('blog/header');
		$this->load->view('blog/index', $data);
		$this->load->view('blog/footer');

		// when delete post, must clear
		$this->output->cache(1);

		$this->output->enable_profiler(true);
	}

	/**
	 * @see http://stackoverflow.com/questions/7422013/how-is-clear-page-cache-in-the-codeigniter
	 */
	function delete_cache($uri_string=null) {
	    $CI =& get_instance();
	    $path = $CI->config->item('cache_path');
	    $path = rtrim($path, DIRECTORY_SEPARATOR);

	    $cache_path = ($path == '') ? APPPATH.'cache/' : $path;

	    $uri =  $CI->config->item('base_url').
	            $CI->config->item('index_page').
	            $uri_string;

	    $cache_path .= md5($uri);

	    return unlink($cache_path);
	}

	/**
	 * Clears all cache from the cache directory
	 * @see http://stackoverflow.com/questions/7422013/how-is-clear-page-cache-in-the-codeigniter
	 */
	public function clear_all_cache() {
	    $CI =& get_instance();
		$path = $CI->config->item('cache_path');

	    $cache_path = ($path == '') ? APPPATH.'cache/' : $path;

	    $handle = opendir($cache_path);
	    while (($file = readdir($handle))!== FALSE) 
	    {
	        //Leave the directory protection alone
	        if ($file != '.htaccess' && $file != 'index.html')
	        {
	           @unlink($cache_path.'/'.$file);
	        }
	    }
	    closedir($handle);
	}
}
