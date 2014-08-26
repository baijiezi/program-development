<?php

namespace Controller;

class Main extends \PestMVC\Controller {
	public function index() {
		$this->redirect("index");
	}
	
	public function test() {
		$args = func_get_args();
		print_r($args);
	}
	
	public function edit(){
		echo 'xxxxxxx Main::edit';
	}
	
	public function notFound() {
		$this->render_front( "404" );
	}
	
	public function noAuth() {
		$this->render_front( "noAuth" );
	}
}
