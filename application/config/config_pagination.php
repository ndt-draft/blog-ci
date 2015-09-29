<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['pagination'] = array(
    'base_url'        => site_url() . '/blog/index',
    'per_page'        => 3,
    'full_tag_open'   => '<ul class="pagination">',
    'full_tag_close'  => '</ul>',
    'cur_tag_open'    => '<li class="active"><span>',
    'cur_tag_close'   => '</span></li>',
    'num_tag_open'    => '<li>',
    'first_tag_open'  => '<li>',
    'next_tag_open'   => '<li>',
    'prev_tag_open'   => '<li>',
    'last_tag_open'   => '<li>',
    'first_tag_close' => '</li>',
    'num_tag_close'   => '</li>',
    'next_tag_close'  => '</li>',
    'prev_tag_close'  => '</li>',
    'last_tag_close'  => '</li>',
);
