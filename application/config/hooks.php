<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	http://codeigniter.com/user_guide/general/hooks.html
|
*/

$hook['pre_system'] = array(
	'class'    => 'MyClass',
	'function' => 'Myfunction',
	'filename' => 'Myclass.php',
	'filepath' => 'hooks',
	'params'   => array('pre system')
);

$hook['pre_controller'] = array(
	'class'    => 'MyClass',
	'function' => 'Myfunction',
	'filename' => 'Myclass.php',
	'filepath' => 'hooks',
	'params'   => array('pre controller')
);

$hook['post_controller_constructor'] = array(
	'class'    => 'MyClass',
	'function' => 'Myfunction',
	'filename' => 'Myclass.php',
	'filepath' => 'hooks',
	'params'   => array('post controller constructor')
);

// // this will override all the output
// $hook['display_override'] = array(
// 	'class'    => 'MyClass',
// 	'function' => 'Myfunction',
// 	'filename' => 'Myclass.php',
// 	'filepath' => 'hooks',
// 	'params'   => array('display override')
// );

// this will override all the cache
$hook['cache_override'] = array(
	'class'    => 'MyClass',
	'function' => 'Myfunction',
	'filename' => 'Myclass.php',
	'filepath' => 'hooks',
	'params'   => array('cache override')
);

$hook['post_system'] = array(
	'class'    => 'MyClass',
	'function' => 'Myfunction',
	'filename' => 'Myclass.php',
	'filepath' => 'hooks',
	'params'   => array('post system')
);

/* End of file hooks.php */
/* Location: ./application/config/hooks.php */