<?php

namespace li3_dropbox\extensions;

use lithium\util\String;
use lithium\util\Inflector;

class Dropbox extends \lithium\core\Adaptable {

	protected static $_adapter;

	/**
	 * Path where to look for adapters.
	 *
	 * @var string
	 */
	protected static $_adapters = 'adapter';

	/**
	 * To be re-defined in sub-classes.
	 *
	 * @var object `Collection` of configurations, indexed by name.
	 */
	protected static $_configurations = array();

	public static function add(array $config = array()) {
		$config['adapter'] = 'Dropbox';
		static::$_configurations['default'] = $config;
		return static::$_configurations;
	}

	/**
	 * Gets the adapter, if a token exists then exposes dropbox api, else
	 * links via oAuth.
	 * @return [type] [description]
	 */
	public static function get(array $options = array()) {
		foreach($options as $key => $value){
			static::$_configurations['default'][$key] = $value;
		}
		return static::adapter('default');
	}

}

?>