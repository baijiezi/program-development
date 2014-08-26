<?php
namespace PestMVC;

class CannotFoundException extends \Exception {
	public function __construct($msg) {
		parent::__construct ( $msg );
	}
}
