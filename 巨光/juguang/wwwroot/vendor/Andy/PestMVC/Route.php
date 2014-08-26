<?php
namespace PestMVC;

class Route {
	public $rule;
	public $http_method;
	public $controller;
	public $action;
	public $prefix;
	public $params = array ();

	public function __construct($rule, $params) {
		// 		var_dump('$rule = ' . $rule);
		// 		var_dump($params);

		// METHOD@/users/:id/edit
		$rule = explode ( '@', $rule );
		$this->http_method = $rule [0];
		$rule = $rule [1];

		// // TODO default mode
		$this->rule = $rule;
		$rules = preg_split ( '/\//', $rule );
		array_shift ( $rules ); // trim the first slash.

		foreach ( $rules as $param ) {
			if (strpos ( $param, ':' ) === 0) // param like ':id'
				array_push ( $this->params, $param );
		}

		$this->prefix = isset($params ['prefix']) ? $params ['prefix'] : "";
		unset ( $params ['prefix'] );

		// re-locate the controller. //TODO validate it.
		// $this->controller = ucwords ( strtolower ( $params ['controller'] ) );
		$this->controller = ucwords($this->prefix) . ucwords (  $params ['controller'] );
		unset ( $params ['controller'] );

		$this->action = strtolower ( $params ['action'] );
		unset ( $params ['action'] );
	}

	function regex_url($matches) {
		$key = str_replace ( ':', '', $matches [0] );
		return '([a-zA-Z0-9_\+\-%]+)';
	}
}









