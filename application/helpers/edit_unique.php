<?php

/**
 * Check unique on update
 *
 * @see http://stackoverflow.com/questions/13692473/is-unique-for-codeigniter-form-validation
 * @see http://stackoverflow.com/questions/15928650/codeigniter-edit-form-repopulating-with-edit-unique/15930074#15930074
 */
function edit_unique($value, $params)  {
    $CI =& get_instance();
    $CI->load->database();

    $CI->form_validation->set_message('edit_unique', "Sorry, that %s is already being used.");

    list($table, $field, $current_id) = explode(".", $params);

    $query = $CI->db->select()->from($table)->where($field, $value)->limit(1)->get();

    if ($query->row() && $query->row()->id != $current_id)
    {
        return FALSE;
    } else {
        return TRUE;
    }
}