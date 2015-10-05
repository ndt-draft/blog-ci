<?php
/**
 * Get option from options table
 */
function get_option($key) {
    $CI = get_instance();
    $CI->load->model('options_model');
    $result = $CI->options_model->get_option($key);
    return $result;
}