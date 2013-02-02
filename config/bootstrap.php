<?php

use lithium\core\Environment;
use lithium\core\Libraries;

defined('LI3_DROPBOX_PATH') OR define('LI3_DROPBOX_PATH', Libraries::get('li3_dropbox', 'path'));

$info = array(
	'key' => 'j0c9s7ht5blqcos',
	'secret' => 'k9hs8b7q1cqzpd7'
);

// Call my own autoloader
Libraries::add('dropbox', array(
	'path' => LI3_DROPBOX_PATH . "/libraries",
	'bootstrap' => "dbox_autoload.php"
));

// Check whether to use HTTPS and set the callback URL
$protocol = (!empty($_SERVER['HTTPS'])) ? 'https' : 'http';
$callback = $protocol . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

$encrypter = new \Dropbox\OAuth\Storage\Encrypter('f783cf299faa2f66f59dce646e4646b3'); // napavalleybloonz

// Create the storage object, passing it the Encrypter object
$storage = new \Dropbox\OAuth\Storage\Session($encrypter);

$OAuth = new \Dropbox\OAuth\Consumer\Curl($info['key'], $info['secret'], $storage, $callback);
$dropbox = new \Dropbox\API($OAuth);

// print_r($dropbox->accountInfo());exit;

?>