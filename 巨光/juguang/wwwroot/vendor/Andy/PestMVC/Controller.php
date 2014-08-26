<?php
namespace PestMVC;

class Controller {
	// 	private $response;
	private $_auth;

	// public function __construct($request, $response) {
	public function __construct() {
		// $this->response = $response;
		$this->_auth = new \Utils\Auth();
	}

	public function render_front($name, $param = null, $template = 'default') {
		if (isset($param)) {
			extract ( $param );
		}
		require_once VIEW_PATH_FRONT . $name . '.php';
	}
	
	public function render($name, $param, $template = 'default') {
		extract ( $param );

		switch ($template) {
			case 'login':
				require_once VIEW_BASE_PATH . 'admin/' . $name . '_body.php';
				break;
					
			default:
				require_once VIEW_BASE_PATH . 'admin/header.html';
				require_once VIEW_BASE_PATH . 'admin/body.html';
				require_once VIEW_BASE_PATH . 'admin/' . $name . '_body.php';
				require_once VIEW_BASE_PATH . 'admin/footer.html';
				break;
		}
		;
	}

	public static function redirect($url) {
		header ( "Location: " . $url );
	}

	// function index() {
	// }
	// function add() {
	// }
	// function get() {
	// }
	// function create() {
	// }
	// function edit() {
	// }
	// function update() {
	// }
	// function delete() {
	// }
}