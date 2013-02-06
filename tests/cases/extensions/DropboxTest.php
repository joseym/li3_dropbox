<?php

namespace li3_dropbox\tests\cases\extensions;

use li3_dropbox\extensions\Dropbox;

class DropboxTest extends \lithium\test\Unit {

	function setUp() {}

	function tearDown() {}

	function testAdd(){

		$this->adapter = Dropbox::add(array(
			'key' => 'abc',
			'secret' => 'defg'
		));

		$name = array_keys($this->adapter);
		$this->name = $name[0];

		$this->assertTrue(!empty($this->adapter));
		$this->assertEqual('default', $this->name);
		$this->assertEqual('Dropbox', $this->adapter['default']['adapter']);
		
	}

}