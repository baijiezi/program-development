<?php
namespace PestMVC;

class AuthException extends \Exception {
	public function __construct($msg) {
		parent::__construct ( $msg );
	}
}
