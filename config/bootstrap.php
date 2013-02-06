<?php

use lithium\core\Environment;
use lithium\core\Libraries;

defined('LI3_DROPBOX_PATH') OR define('LI3_DROPBOX_PATH', Libraries::get('li3_dropbox', 'path'));

// Call my own autoloader
Libraries::add('Dropbox', array(
	'path' => LI3_DROPBOX_PATH . "/libraries/Dropbox/",
	'bootstrap' => false,
	'transform' => function($class){ return LI3_DROPBOX_PATH . "/libraries/Dropbox/" . str_replace('\\', '/', $class) . ".php"; }
));

?>