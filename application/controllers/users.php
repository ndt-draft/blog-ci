<?php
/**
 * user_access_level
 * 1 => administrator
 *          edit_posts
 *          manage_settings
 *          manage_users
 * 2 => editor
 * 3 => author
 * 4 => contributor
 * 5 => subscriber
 *          read_posts
 */
class Users extends CI_Controller {
    public function index() {
        echo 'check admin first';
        echo 'user list';
        echo 'pagination';
    }

    public function show($user_slug_or_id) {
        echo 'check admin first';
        echo 'single user';
        echo 'settings';

        echo 'if me, edit';
        echo 'if other user, not admin | show permission, not have, show deny message';
    }

    public function create() {

    }

    public function edit() {

    }

    public function delete() {

    }

    public function search() {

    }

    public function sign_up() {

    }

    public function sign_in() {

    }

    public function activate($code) {
    }

    public function reactivate() {
    }

    public function lost_password() {
    }
}
