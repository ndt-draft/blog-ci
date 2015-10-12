<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Users extends MX_Controller {
    /**
     * @see https://bitbucket.org/wiredesignz/codeigniter-modular-extensions-hmvc/src#markdown-header-features
     */
    public $autoload = array(
        'helper' => array('form', 'url', 'security', 'language', 'file', 'menus', 'options'),
        'libraries' => array('session', 'form_validation')
    );

    public function __construct() {
        parent::__construct();
        $this->form_validation->set_error_delimiters(
            '<div class="alert alert-warning" role="alert">',
            '</div>'
        );
        $this->load->model('users_model');
        $this->load->model('password_model');
        $this->lang->load('en_admin', 'english');

        if (false == $this->session->userdata('logged_in') ||
            1 != $this->session->userdata('usr_access_level')) {
            redirect('users/signin');
        }
    }

    public function index() {
        $data['page_heading'] = 'Viewing users';
        $data['query'] = $this->users_model->get_all_users();
        $this->load->view('blog/header', $data);
        // $this->load->view('nav/top_nav', $data);
        $this->load->view('users/users/view_all_users', $data);
        $this->load->view('blog/footer', $data);
    }

    public function new_user() {
        // set validation rules
        $this->form_validation->set_rules('usr_fname', $this->lang->line('usr_fname'), 'required|min_length[1]|max_length[125]');
        $this->form_validation->set_rules('usr_lname', $this->lang->line('usr_lname'), 'required|min_length[1]|max_length[125]');
        $this->form_validation->set_rules('usr_uname', $this->lang->line('usr_uname'), 'required|min_length[1]|max_length[125]');
        $this->form_validation->set_rules('usr_email', $this->lang->line('usr_email'), 'required|min_length[1]|max_length[255]|valid_email|is_unique[users.usr_email]');
        $this->form_validation->set_rules('usr_confirm_email', $this->lang->line('usr_confirm_email'), 'required|min_length[1]|max_length[255]|valid_email|matches[usr_email]');
        $this->form_validation->set_rules('usr_add1', $this->lang->line('usr_add1'), 'required|min_length[1]|max_length[125]');
        $this->form_validation->set_rules('usr_add2', $this->lang->line('usr_add2'), 'required|min_length[1]|max_length[125]');
        $this->form_validation->set_rules('usr_add3', $this->lang->line('usr_add3'), 'required|min_length[1]|max_length[125]');
        $this->form_validation->set_rules('usr_town_city', $this->lang->line('usr_town_city'), 'required|min_length[1]|max_length[125]');
        $this->form_validation->set_rules('usr_zip_pcode', $this->lang->line('usr_zip_pcode'), 'required|min_length[1]|max_length[125]');
        $this->form_validation->set_rules('usr_access_level', $this->lang->line('usr_zip_pcode'), 'min_length[1]|max_length[125]');
        $this->form_validation->set_rules('usr_is_active', $this->lang->line('usr_is_active'), 'min_length[1]|max_length[1]|integer|is_natural');

        $data['page_heading'] = 'New user';

        if ($this->form_validation->run() == false) {
            $data['usr_fname'] = array(
                'name'       => 'usr_fname',
                'class'      => 'form-control',
                'id'         => 'usr_fname',
                'value'      => set_value('usr_fname', ''),
                'max_length' => '100',
                'size'       => '35'
            );
            $data['usr_lname'] = array(
                'name'       => 'usr_lname',
                'class'      => 'form-control',
                'id'         => 'usr_lname',
                'value'      => set_value('usr_lname', ''),
                'max_length' => '100',
                'size'       => '35'
            );
            $data['usr_uname'] = array(
                'name'       => 'usr_uname',
                'class'      => 'form-control',
                'id'         => 'usr_uname',
                'value'      => set_value('usr_uname', ''),
                'max_length' => '100',
                'size'       => '35'
            );
            $data['usr_email'] = array(
                'name'       => 'usr_email',
                'class'      => 'form-control',
                'id'         => 'usr_email',
                'value'      => set_value('usr_email', ''),
                'max_length' => '100',
                'size'       => '35'
            );
            $data['usr_confirm_email'] = array(
                'name'       => 'usr_confirm_email',
                'class'      => 'form-control',
                'id'         => 'usr_confirm_email',
                'value'      => set_value('usr_confirm_email', ''),
                'max_length' => '100',
                'size'       => '35'
            );
            $data['usr_add1'] = array(
                'name'       => 'usr_add1',
                'class'      => 'form-control',
                'id'         => 'usr_add1',
                'value'      => set_value('usr_add1', ''),
                'max_length' => '100',
                'size'       => '35'
            );
            $data['usr_add2'] = array(
                'name'       => 'usr_add2',
                'class'      => 'form-control',
                'id'         => 'usr_add2',
                'value'      => set_value('usr_add2', ''),
                'max_length' => '100',
                'size'       => '35'
            );
            $data['usr_add3'] = array(
                'name'       => 'usr_add3',
                'class'      => 'form-control',
                'id'         => 'usr_add3',
                'value'      => set_value('usr_add3', ''),
                'max_length' => '100',
                'size'       => '35'
            );
            $data['usr_town_city'] = array(
                'name'       => 'usr_town_city',
                'class'      => 'form-control',
                'id'         => 'usr_town_city',
                'value'      => set_value('usr_town_city', ''),
                'max_length' => '100',
                'size'       => '35'
            );
            $data['usr_zip_pcode'] = array(
                'name'       => 'usr_zip_pcode',
                'class'      => 'form-control',
                'id'         => 'usr_zip_pcode',
                'value'      => set_value('usr_zip_pcode', ''),
                'max_length' => '100',
                'size'       => '35'
            );
            $data['usr_access_level_options'] = array(
                1 => 1,
                2 => 2,
                3 => 3,
                4 => 4,
                5 => 5,
            );
            $data['usr_access_level'] = set_value('usr_access_level', '');
            $data['usr_is_active'] = set_value('usr_is_active', '');

            $this->load->view('blog/header', $data);
            // $this->load->view('nav/top_nav', $data);
            $this->load->view('users/users/new_user', $data);
            $this->load->view('blog/footer', $data);
        } else {
            $password = random_string('alnum', 8);
            $hash = $this->encrypt->sha1($password);

            $data = array(
                'usr_fname' => $this->input->post('usr_fname'),
                'usr_lname' => $this->input->post('usr_lname'),
                'usr_uname' => $this->input->post('usr_uname'),
                'usr_email' => $this->input->post('usr_email'),
                'usr_hash'  => $hash,
                'usr_add1' => $this->input->post('usr_add1'),
                'usr_add2' => $this->input->post('usr_add2'),
                'usr_add3' => $this->input->post('usr_add3'),
                'usr_town_city' => $this->input->post('usr_town_city'),
                'usr_zip_pcode' => $this->input->post('usr_zip_pcode'),
                'usr_access_level' => $this->input->post('usr_access_level'),
                'usr_is_active' => $this->input->post('usr_is_active'),
            );

            if ($this->users_model->process_create_user($data)) {
                $file = read_file('../views/email_scripts/welcome.txt');
                $file = str_replace('%usr_fname%', $data['usr_fname'], $file);
                $file = str_replace('%usr_lname%', $data['usr_lname'], $file);
                $file = str_replace('%password%', $data['password'], $file);
                redirect('users');
            }
        }
    }

    public function edit_user() {
         // set validation rules
        $this->form_validation->set_rules('usr_id', $this->lang->line('usr_id'), 'required|min_length[1]|max_length[125]');
        $this->form_validation->set_rules('usr_lname', $this->lang->line('usr_lname'), 'required|min_length[1]|max_length[125]');
        $this->form_validation->set_rules('usr_uname', $this->lang->line('usr_uname'), 'required|min_length[1]|max_length[125]');
        $this->form_validation->set_rules('usr_email', $this->lang->line('usr_email'), 'required|min_length[1]|max_length[255]|valid_email|is_unique[users.usr_email]');
        $this->form_validation->set_rules('usr_email', $this->lang->line('usr_email'), 'required|min_length[1]|max_length[255]|valid_email|matches[usr_email]');
        $this->form_validation->set_rules('usr_add1', $this->lang->line('usr_add1'), 'required|min_length[1]|max_length[125]');
        $this->form_validation->set_rules('usr_add2', $this->lang->line('usr_add2'), 'required|min_length[1]|max_length[125]');
        $this->form_validation->set_rules('usr_add3', $this->lang->line('usr_add3'), 'required|min_length[1]|max_length[125]');
        $this->form_validation->set_rules('usr_town_city', $this->lang->line('usr_town_city'), 'required|min_length[1]|max_length[125]');
        $this->form_validation->set_rules('usr_zip_pcode', $this->lang->line('usr_zip_pcode'), 'required|min_length[1]|max_length[125]');
        $this->form_validation->set_rules('usr_access_level', $this->lang->line('usr_zip_pcode'), 'min_length[1]|max_length[125]');
        $this->form_validation->set_rules('usr_is_active', $this->lang->line('usr_is_active'), 'min_length[1]|max_length[1]|integer|is_natural');

        if ($this->input->post()) {
            $id = $this->input->post('usr_id');
        } else {
            $id = $this->uri->segment(3);
        }

        // empty id, return immediately
        if (!$id) {
            redirect('users');
        }

        $data['page_heading'] = 'Edit user';

        if (false == $this->form_validation->run()) {
            $query = $this->users_model->get_user_details($id);

            foreach ($query->result() as $row) {
                $usr_id = $row->usr_id;
                $usr_fname = $row->usr_fname;
                $usr_lname = $row->usr_lname;
                $usr_uname = $row->usr_uname;
                $usr_email = $row->usr_email;
                $usr_add1 = $row->usr_add1;
                $usr_add2 = $row->usr_add2;
                $usr_add3 = $row->usr_add3;
                $usr_town_city = $row->usr_town_city;
                $usr_zip_pcode = $row->usr_zip_pcode;
                $usr_access_level = $row->usr_access_level;
                $usr_is_active = $row->usr_is_active;
            }

            $data['usr_fname'] = array(
                'name'       => 'usr_fname',
                'class'      => 'form-control',
                'id'         => 'usr_fname',
                'value'      => set_value('usr_fname', $usr_fname),
                'max_length' => '100',
                'size'       => '35'
            );
            $data['usr_lname'] = array(
                'name'       => 'usr_lname',
                'class'      => 'form-control',
                'id'         => 'usr_lname',
                'value'      => set_value('usr_lname', $usr_lname),
                'max_length' => '100',
                'size'       => '35'
            );
            $data['usr_uname'] = array(
                'name'       => 'usr_uname',
                'class'      => 'form-control',
                'id'         => 'usr_uname',
                'value'      => set_value('usr_uname', $usr_uname),
                'max_length' => '100',
                'size'       => '35'
            );
            $data['usr_email'] = array(
                'name'       => 'usr_email',
                'class'      => 'form-control',
                'id'         => 'usr_email',
                'value'      => set_value('usr_email', $usr_email),
                'max_length' => '100',
                'size'       => '35'
            );
            $data['usr_confirm_email'] = array(
                'name'       => 'usr_confirm_email',
                'class'      => 'form-control',
                'id'         => 'usr_confirm_email',
                'value'      => set_value('usr_confirm_email', $usr_email),
                'max_length' => '100',
                'size'       => '35'
            );
            $data['usr_add1'] = array(
                'name'       => 'usr_add1',
                'class'      => 'form-control',
                'id'         => 'usr_add1',
                'value'      => set_value('usr_add1', $usr_add1),
                'max_length' => '100',
                'size'       => '35'
            );
            $data['usr_add2'] = array(
                'name'       => 'usr_add2',
                'class'      => 'form-control',
                'id'         => 'usr_add2',
                'value'      => set_value('usr_add2', $usr_add2),
                'max_length' => '100',
                'size'       => '35'
            );
            $data['usr_add3'] = array(
                'name'       => 'usr_add3',
                'class'      => 'form-control',
                'id'         => 'usr_add3',
                'value'      => set_value('usr_add3', $usr_add3),
                'max_length' => '100',
                'size'       => '35'
            );
            $data['usr_town_city'] = array(
                'name'       => 'usr_town_city',
                'class'      => 'form-control',
                'id'         => 'usr_town_city',
                'value'      => set_value('usr_town_city', $usr_town_city),
                'max_length' => '100',
                'size'       => '35'
            );
            $data['usr_zip_pcode'] = array(
                'name'       => 'usr_zip_pcode',
                'class'      => 'form-control',
                'id'         => 'usr_zip_pcode',
                'value'      => set_value('usr_zip_pcode', $usr_zip_pcode),
                'max_length' => '100',
                'size'       => '35'
            );
            $data['usr_access_level_options'] = array(
                1 => 1,
                2 => 2,
                3 => 3,
                4 => 4,
                5 => 5,
            );
            $data['usr_access_level'] = set_value('usr_access_level', $usr_access_level);
            $data['usr_is_active'] = set_value('usr_is_active', $usr_is_active);
            $data['id'] = array('usr_id' => set_value('usr_id', $usr_id));

            $this->load->view('blog/header', $data);
            // $this->load->view('nav/top_nav', $data);
            $this->load->view('users/users/edit_user', $data);
            $this->load->view('blog/footer', $data);
        } else {
            $data = array(
                'usr_fname' => $this->input->post('usr_fname'),
                'usr_lname' => $this->input->post('usr_lname'),
                'usr_uname' => $this->input->post('usr_uname'),
                'usr_email' => $this->input->post('usr_email'),
                'usr_add1' => $this->input->post('usr_add1'),
                'usr_add2' => $this->input->post('usr_add2'),
                'usr_add3' => $this->input->post('usr_add3'),
                'usr_town_city' => $this->input->post('usr_town_city'),
                'usr_zip_pcode' => $this->input->post('usr_zip_pcode'),
                'usr_access_level' => $this->input->post('usr_access_level'),
                'usr_is_active' => $this->input->post('usr_is_active'),
            );

            if ($this->users_model->process_update_user($id, $data)) {
                redirect('users');
            }
        }
    }

    public function delete_user() {
        $this->form_validation->set_rules('id', $this->lang->line('usr_id'), 'required|min_length[1]|max_length[11]|integer|is_natural');

        if ($this->input->post()) {
            $id = $this->input->post('id');
        } else {
            $id = $this->uri->segment(3);
        }

        $data['page_heading'] = 'Confirm delete?';

        if ($this->form_validation->run() == false) {
            $data['query'] = $this->users_model->get_user_details($id);
            // $this->load->view('common/header', $data);
            // $this->load->view('nav/top_nav', $data);
            $this->load->view('users/users/delete_user', $data);
            // $this->load->view('common/footer', $data);
        } else {
            if ($this->users_model->delete_user($id)) {
                redirect('users');
            }
        }
    }

    public function pwd_email() {
        $id = $this->uri->segment(3);
        send_email($data, 'reset');
        redirect('users');
    }
}
