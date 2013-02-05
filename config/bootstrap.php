<?php

use lithium\core\Environment;
use lithium\core\Libraries;

defined('LI3_DROPBOX_PATH') OR define('LI3_DROPBOX_PATH', Libraries::get('li3_dropbox', 'path'));

$info = array('key' => 'j0c9s7ht5blqcos', 'secret' => 'k9hs8b7q1cqzpd7');

$token = "eSjZZVpb6eniQi7cb+U3Fy0ycdrfvhJrJRl7mGRzjyWoMIdMohz7i70NhMqK5ZFexs50hyunUofxTzScfHZZ7brx4kSxsJugRKreJWLOATxP7ZGLdmM2Tav9WpONVDmcjc3TU6gNaWVLyc3s6y7UZPRvtnZzqM+HA7zVjEycgy0yVeK8JxuRPOfSQyzRqqCWVmFPwaqodGX8MFYbRq96KA==";

// Call my own autoloader
Libraries::add('dropbox', array(
	'path' => LI3_DROPBOX_PATH . "/libraries",
	'bootstrap' => "dbox_autoload.php"
));

// Check whether to use HTTPS and set the callback URL
$callback = (!empty($_SERVER['HTTPS'])) ? 'https' : 'http' . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

$encrypter 	= new \Dropbox\OAuth\Storage\Encrypter('f783cf299faa2f66f59dce646e4646b3'); // napavalleybloonz

// Create the storage object, passing it the Encrypter object
$storage 	= new \Dropbox\OAuth\Storage\Manual($encrypter, $token);
$OAuth 		= new \Dropbox\OAuth\Consumer\Curl($info['key'], $info['secret'], $storage, $callback);
$dropbox 	= new \Dropbox\API($OAuth);

print_r($storage->token());
print_r($dropbox->accountInfo());
exit;

?>