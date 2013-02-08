<?php

namespace li3_dropbox\tests\cases\extensions\adapter;

use li3_dropbox\extensions\adapter\Dropbox,
	li3_dropbox\extensions\Dropbox as Adapter;

class DropboxTest extends \lithium\test\Unit {

	function setUp() {

		// $this->adapter = Adapter::add(array(
		// 	'key' => 'abc',
		// 	'secret' => 'defg'
		// ));

		// $this->oAuth = new \stdClass();
		// $this->oAuth->oauth_token_secret = '568a9t0yxdf4f71';
		// $this->oAuth->oauth_token = 'ja7zgiu58398o1a';
		// $this->oAuth->uid = 123456;

		// $this->dropbox = Adapter::get();

	}

	function tearDown() {}

	function testToken(){
		// print_r($this->dropbox->token($this->oAuth));
	}

}