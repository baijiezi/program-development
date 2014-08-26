<?php

namespace Controller;

class ContactUs extends \PestMVC\Controller {

	public function index() {
		$this->render_front ( 'contactUs' );
	}
	
	public function foshan() {
		$this->render_front ( 'contactUs_foshan' );
	}
	
	public function maoming() {
		$this->render_front ( 'contactUs_maoming' );
	}
}
