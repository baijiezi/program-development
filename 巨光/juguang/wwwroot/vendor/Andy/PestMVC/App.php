<?php
namespace PestMVC;

class App {
	public $router;

	public function __construct() {
		$this->router = new \PestMVC\Router ();
	}

	public function get() {
		$args = func_get_args ();
		$args [0] = 'GET@' . $args [0];
		return $this->mapRoute ( $args );
	}

	public function post() {
		$args = func_get_args ();
		$args [0] = 'POST@' . $args [0];
		return $this->mapRoute ( $args );
	}

	public function put() {
		$args = func_get_args ();
		$args [0] = 'PUT@' . $args [0];
		return $this->mapRoute ( $args );
	}

	public function delete() {
		$args = func_get_args ();
		$args [0] = 'DELETE@' . $args [0];
		return $this->mapRoute ( $args );
	}
	
	protected function mapRoute($args) {
		$rule = array_shift ( $args );
		if (empty ( $args[0] )) {
			// simple mode, for example $mvc->get('/users');
			$defautl_param = $this->router->get_default_param ( $rule );
			array_push ( $args, $defautl_param );
		}
		$this->router->addRoute ( new \PestMVC\Route ( $rule, $args [0] ) );
	}

	/**
	 * Create default CRUD routes by resource name.
	 * @param unknown_type $resoure
	 */
	public function rest() {
		$args = func_get_args ();
		$resource = array_shift($args);
		$prefix = array_shift($args);

		// GET /users
		$this->get ( '/' . $resource, \PestMVC\Helper::route_param ( $resource, 'index', $prefix ) );
		// GET /users/add
		$this->get ( '/' . $resource . '/add', \PestMVC\Helper::route_param ( $resource, 'add', $prefix ) );
		// GET /users/:id
		$this->get ( '/' . $resource . '/:id', \PestMVC\Helper::route_param ( $resource, 'index', $prefix ) );
		// POST /users/create
		$this->post ( '/' . $resource . '/create', \PestMVC\Helper::route_param ( $resource, 'create', $prefix ) );
		// GET /users/:id/edit
		$this->get ( '/' . $resource . '/:id/edit', \PestMVC\Helper::route_param ( $resource, 'edit', $prefix ) );
		// PUT /users/:id
		$this->put ( '/' . $resource . '/:id', \PestMVC\Helper::route_param ( $resource, 'update', $prefix ) );
		// DELETE /users/:id
		$this->delete ( '/' . $resource . '/:id', \PestMVC\Helper::route_param ( $resource, 'delete', $prefix ) );
		// GET /users/:id/delete
		$this->get ( '/' . $resource . '/:id/delete', \PestMVC\Helper::route_param ( $resource, 'delete', $prefix ) );
	}


	public function run() {
		session_start();

		$this->fix_http_method ();
		$this->get ( '/', array (
				'controller' => 'main',
				'action' => 'index'
		) );
		$this->router->dispatch ( $_SERVER ['REQUEST_URI'], $_SERVER ['REQUEST_METHOD'] );
		// 		echo '<pre>';
		// 		print_r($this->router);
	}

	/**
	 * Fix httpMethod 'PUT' and 'DELETE'.
	 */
	public function fix_http_method() {
		if (isset ( $_POST ['_method'] )) {
			if ($_POST ['_method'] === 'PUT') {
				$_SERVER ['REQUEST_METHOD'] = 'PUT';
			} else if ($_POST ['_method'] === 'DELETE') {
				$_SERVER ['REQUEST_METHOD'] = 'DELETE';
			}
		}
	}

}

