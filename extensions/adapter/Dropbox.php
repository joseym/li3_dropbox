<?php

namespace li3_dropbox\extensions\adapter;
use \Dropbox\OAuth\Storage\Encrypter;
use \Dropbox\OAuth\Storage\Manual;
use \Dropbox\OAuth\Consumer\Curl;
use \Dropbox\API;


class Dropbox extends \lithium\core\Object {

	public $dropbox;
	protected $_key;
	protected $_secret;
	protected $_token;
	protected $_encrypter;
	protected $_store;
	protected $_oAuth;
	protected $_callback;

	protected $_autoConfig = array('secret', 'key', 'token', 'callback');

	public function __construct(array $config = array()) {

		$defaults = array(
			'hash' => 'f783cf299faa2f66f59dce646e4646b3', // napavalleybloonz
			'token' => null,
			'callback' => (!empty($_SERVER['HTTPS'])) ? 'https' : 'http' . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']
		);

		$config += $defaults;

		$this->_encrypter 	= new Encrypter($config['hash']);
		$this->_store 		= new Manual($this->_encrypter, $config['token']);
		$this->_oAuth 		= new Curl($config['key'], $config['secret'], $this->_store, $config['callback']);
		$this->dropbox 		= new API($this->_oAuth);

		if(!$config['token']) { $config['token'] = $this->_store->token(); }

		return parent::__construct($config);

	}

	/**
	 * Return the users oAuth token, to be stored for later call.
	 * @return string hashed user oAuth credentials
	 */
	public function token(){
		return $this->_token;
	}

	/**
	 * Decrypted user oAuth credentials
	 * @return object users oAuth key, secret and uid
	 */
	public function credentials(){
		return $this->_store->decrypt($this->_token);
	}

	/**
	 * Dropbox item metadata
	 * @param  string $path path to file/directory
	 * @return array       meta data for item/directory
	 */
	public function meta($path = null){
		return $this->dropbox->metaData($path);
	}

	/**
	 * Retrieves a file/directory from dropbox
	 * @param  string $path   path to file or directory to be read
	 * @param  string $output (optional) path to location to store file
	 * @return mixed         File returned from dropbox
	 */
	public function get($path = null, $output = false, $rev = null){
		return $this->dropbox->getFile($path, $output, $rev);
	}

	public function media($path){
		return $this->dropbox->media($path);
	}

	public function thumbnails($file, $format = 'JPEG', $size = 'small'){
		return $this->dropbox->thumbnails($file, $format, $size);
	}

    /**
     * Uploads a physical file from disk
     * Dropbox impose a 150MB limit to files uploaded via the API. If the file
     * exceeds this limit or does not exist, an Exception will be thrown
     * @param string $file Absolute path to the file to be uploaded
     * @param string|bool $filename The destination filename of the uploaded file
     * @param string $path Path to upload the file to, relative to root
     * @param boolean $overwrite Should the file be overwritten? (Default: true)
     * @return object stdClass
     */
	public function put($file, $filename = false, $path = '', $overwrite = true){
		return $this->dropbox->putFile($file, $filename, $path, $overwrite);
	}

	/**
	 * Users dropbox account details
	 * @return object
	 */
	public function account(){
		return $this->dropbox->accountInfo();
	}

}

?>