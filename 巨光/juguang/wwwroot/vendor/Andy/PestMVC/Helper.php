<?php
namespace PestMVC;

class Helper {
	public static function route_param($controller, $action, $prefix = '') {
		return array (
				'controller' => $controller,
				'action' => $action,
				'prefix' => $prefix
		);
	}

	public static function get_route_key($route) {
		if('' == $route->prefix ){
			return strtolower($route->rule);
		}else {
			return '/' . strtolower($route->prefix . $route->rule);
		}
	}

	public static function url($resource, $param = array()) {
		return '/' . $resource;
	}
}
